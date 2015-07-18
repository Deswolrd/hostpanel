<?php

/* default/nginx.twig */
class __TwigTemplate_9be7698335853abaee450f20370a30dce9e5543f0b770aabfb90366f4799ca43 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_60bf9e13bdaea3470cdb57d314553975f02815c324c8d62067bae49c76ef7a37 = $this->env->getExtension("native_profiler");
        $__internal_60bf9e13bdaea3470cdb57d314553975f02815c324c8d62067bae49c76ef7a37->enter($__internal_60bf9e13bdaea3470cdb57d314553975f02815c324c8d62067bae49c76ef7a37_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "default/nginx.twig"));

        // line 1
        echo "server {
\tlisten\t";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["port"]) ? $context["port"] : $this->getContext($context, "port")), "html", null, true);
        echo ";
\troot\t\t\t/var/nginx/sites/www/";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
        echo ";
\tindex\t\t\tindex.php index.html index.htm;
\tserver_name\t\t";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["host"]) ? $context["host"] : $this->getContext($context, "host")), "html", null, true);
        echo ";
\tlocation ~ \\.php\$ {
\t\ttry_files\t\$1 \$uri \$uri/ \$uri/index.php\t=404;
\t\tfastcgi_pass\t";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["sock"]) ? $context["sock"] : $this->getContext($context, "sock")), "html", null, true);
        echo ";
\t\tinclude fastcgi_params;
\t\tfastcgi_split_path_info\t\t\t^(.+?\\.php)(/.*)?\$;
\t\tfastcgi_param\tSCRIPT_FILENAME\t\t\$document_root\$fastcgi_script_name;
\t\tfastcgi_param\tPATH_TRANSLATED\t\t\$document_root\$fastcgi_script_name;
\t\tset\t\t\$path_info\t\t\$fastcgi_path_info;
\t\tfastcgi_param\tPATH_INFO\t\t\$path_info;
\t\tfastcgi_param\tSERVER_ADMIN\t\temail@example.com;
\t\tfastcgi_param\tSERVER_SIGNATURE\tnginx/\$nginx_version;
\t\tfastcgi_index\tindex.php;
\t}
}";
        
        $__internal_60bf9e13bdaea3470cdb57d314553975f02815c324c8d62067bae49c76ef7a37->leave($__internal_60bf9e13bdaea3470cdb57d314553975f02815c324c8d62067bae49c76ef7a37_prof);

    }

    public function getTemplateName()
    {
        return "default/nginx.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 8,  34 => 5,  29 => 3,  25 => 2,  22 => 1,);
    }
}
