<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Site;

class DefaultController extends Controller
{
	public $preffix = '/var/nginx/sites/';
	public $poolPreffix = '/var/nginx/sites/pool.d/';
	public $restartFile = '/var/nginx/sites/need_restart';
	public $userManageFile = '/var/nginx/sites/need_user_manage';
	private function getSites() {
		$em = $this->getDoctrine()->getManager();
		$files =  $em->getRepository('AppBundle:Site')->findAll();
		foreach ($files as &$file) {
			$file = '\''.$file->getName().'\'';
		}
		return implode(',',$files);
	}
	private function manageUser($action,$user,$pass = '') {
		if ($pass != '') {$pass = ' '.$pass;}
		try {
			if (!file_exists($this->userManageFile)) {
				$tmpFile = fopen($this->userManageFile, "w");
			} else {
				$tmpFile = fopen($this->userManageFile, "a");
			}
			fwrite($tmpFile,$action.' '.$user.$pass." \r\n");
		} catch(Exception $e) {};
		fclose($tmpFile);
	}
	private function initRestart() {
		if (!file_exists($this->restartFile)) {
			$tmpFile = fopen($this->restartFile, "w");
			fclose($tmpFile);
		}
		return 10;
	}
	private function createSite($siteName, $port, $domain, $description) {
		$result = false;
		function createDir($directory) {
			if (!file_exists($directory)) {mkdir($directory);};
		}
		function createConfigFile($configFileName, $siteName, $port, $domain, $defaults) {
			$result = false;
			try {
			$configFile = fopen($configFileName, "w") or die("Unable to open file!".' '.$configFileName);;
			$defaults = $defaults->render('default/nginx-location.twig',array('port' => $port, 'name' => $siteName, 'host' => $domain, 'sock' => 'unix:/var/run/php5-fpm-'.$siteName.'.sock'))->getContent();
			fwrite($configFile,$defaults);
			fclose($configFile);
			$result = true;
			} catch(Exception $e) {};
			return $result;
		}
		function createDefaultIndex($defaultFileName) {
			$defaultFile = fopen($defaultFileName, "w") or die("Unable to open file!".' '.$defaultFileName);
			fwrite($defaultFile,'<html><head><title>New Site</title></head><body>It\'s all white and it\'s all yours!</body></html>');
			fclose($defaultFile);
		}
		createDir($this->preffix.'www/'.$siteName);
		$path = $this->preffix.'server-configs/'.$siteName.'.inc';
		if (createConfigFile($path, $siteName, $port, $domain, $this)) {
			createDefaultIndex($this->preffix.'www/'.$siteName.'/index.html');
			$result = true;
			$this->createSiteInDB($siteName,$domain,$port,$siteName,$path,$description);
			$this->createPool($siteName,'www-data',$siteName,$this->poolPreffix.$siteName.'.conf');
			$this->manageUser('add',$siteName,$siteName.'_password');
			$this->initRestart();
		}
		return $result;
	}
	private function editSite($siteName) {
		$Site = $this->loadSiteFromDB($siteName);
		$result = $Site->getName()."\r\n".$Site->getHost()."\r\n".$Site->getPort()."\r\n".$Site->getDescription();
		return $result;
	}
	private function removeSite($siteName) {
		$result = false;
		function rrmdir($dir) { 
   			if (is_dir($dir)) { 
     		$objects = scandir($dir); 
     		foreach ($objects as $object) { 
       			if ($object != "." && $object != "..") { 
         			if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       				} 
     			} 
     		reset($objects); 
     		rmdir($dir); 
   			} 
 		}
		rrmdir($this->preffix.'www/'.$siteName);
		@unlink($this->preffix.'server-configs/'.$siteName.'.inc');
		@unlink($this->poolPreffix.$siteName.'.conf');
		$result = true;
		$this->removeFromDB($siteName);
		$this->manageUser('del',$siteName);
		$this->initRestart();
		return $result;
	}
	private function createSiteInDB($name,$host,$port,$user,$path,$description)
	{
		$em = $this->getDoctrine()->getManager();
		$Site = $em->getRepository('AppBundle:Site')->findOneBy(array('name' => $name));
		if (!$Site) {
			$Site = new Site();
		};
    	$Site->setName($name);
    	$Site->setHost($host);
		$Site->setPort($port);
		$Site->setUser($user);
		$Site->setSettingspath($path);
    	$Site->setDescription($description);

    	$em->persist($Site);
    	$em->flush();
	}
	private function loadSiteFromDB($name)
	{
		$em = $this->getDoctrine()->getManager();
		$Site = $em->getRepository('AppBundle:Site')->findOneBy(array('name' => $name));
		return $Site;
	}
	private function removeFromDB($name) {
		$em = $this->getDoctrine()->getManager();
		$Site = $em->getRepository('AppBundle:Site')->findOneBy(array('name' => $name));
		$em->remove($Site);
		$em->flush();
	}
    /**
     * @Route("/ap/index", name="phomepage");
	 * @Route("/", name="homepage");
	 * @Route("/ap/", name="fhomepage");
	 * @Method({"GET", "POST"});
     */
    public function indexAction()
    {
		if ($this->getRequest()->isMethod('POST')) {
			$postData = $this->get('request')->request->all();
			$action = $postData['action'];
			$result = 'error';
			switch ($action) {
				case 'newSite': 
				if ($this->createSite($postData['sitename'],$postData['siteport'],$postData['sitehost'],$postData['sitedescription'])) {$result = 'ok'; $code = 201;} else {$result = 'no'; $code = 400;};
				break;
		
				case 'delSite':
				if ($this->removeSite($postData['sitename'])) {$result = 'ok'; $code = 201;} else {$result = 'no'; $code = 400;};
				break;
		
				case 'restart':
				$result = $this->initRestart();
				$code = 200;
				break;
				
				case 'editSite':
				$result = $this->editSite($postData['sitename']);
				$code = 200;
				break;
			}
			return new Response($result,$code);
		} else {
			$files = $this->getSites();
        	return $this->render('default/index.html.twig',array('xfiles' => $files));
		}
    }
    private function createPool($user,$group,$pool,$destination)
	{
		$configFile = fopen($destination, "w");
		fwrite($configFile,$this->render('default/pool.twig',array('pool' => $pool, 'user' => $user, 'group' => $group))->getContent());
		fclose($configFile);
	}
}
