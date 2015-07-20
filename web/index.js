String.prototype.format = String.prototype.f = function () {
    var args = arguments;
    return this.replace(/\{\{|\}\}|\{(\d+)\}/g, function (m, n) {
        if (m == "{{") { return "{"; }
        if (m == "}}") { return "}"; }
        return args[n];
    });
};
function addSitesToList() {
	var html = '<div class="site"><div class="itemDiv"><table width="100%"><tr><td><a href="javascript:void(0)" onClick="editSite({0})">{0}. {1}</a></td><td width="240"><a href="javascript:void(0)" onClick="loadPreview({0})" class="openBtn ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>Посмотреть</a> <a href="javascript:void(0)" onClick="deleteSite({0})" class="openBtn ui-state-default ui-corner-all"><span class="ui-icon ui-icon-trash"></span>Удалить</a></td></tr></table></div></div>';
	for (index = 0; index < siteList.length; ++index) {
		$('#content').append(html.format((index+1),siteList[index]));
	}
}
function loadPreview(index) {
	if (document.getElementById('hintSpan').style.display != 'none') {
		$('#hintSpan').fadeOut(500);
	}
	$('#previewFrameDiv').fadeOut(500,'',function () {
		$('#previewFrame').attr('src','/' + siteList[index-1] + '/');
		$('#previewFrameDiv').fadeIn(500);
	})
}
function initiate() {
	document.getElementById('no-script').style.display="none";
	addSitesToList();
	$( ".openBtn" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
	);
}
function editSite(index) {
	var postData = siteList[index-1];
	var postres = $.post('./',{action: 'editSite', sitename: postData});
	postres.done(function(data){
			postData = data.split("\r\n");
			$('#sitename').val(postData[0]);
			$('#sitehost').val(postData[1]);
			$('#siteport').val(postData[2]);
			$('#sitedescription').val(postData[3]);
			$( "#dialog" ).dialog( "open" );
		});
}
function deleteSite(index) {
	var postData = siteList[index-1];
	var postres = $.post('./',{action: 'delSite', sitename: postData});
	postres.done(function(data){
			if (data == 'ok') {location.reload()} else {alert('Ошибка при удалении!')}
		});
}
function restart() {
	var postData = siteList[index-1];
	var postres = $.post('./',{action: 'restart'});
	postres.done(function(data){
			alert('Перезапуск сервера в течение ' + data + ' минут!')
		});
}
function checkInput() {
	var postData = [];
	postData.push($('#sitename').val());
	postData.push($('#sitehost').val());
	postData.push($('#siteport').val());
	postData.push($('#sitedescription').val());
	var postres = $.post('./',{action: 'newSite', sitename: postData[0], sitehost: postData[1], siteport: postData[2], sitedescription: postData[3]});
	postres.done(function(data){
			if (data == 'ok') {location.reload()} else {alert('Произошла ошибка! Убедитесь, что такого имени сайта еще не существует!')}
		});
	return true;
}


$( "#restart" ).click(function(e) {
    restart();
});
$( "#siteport" ).spinner();
$( "#dialog" ).dialog({
	autoOpen: false,
	width: 500,
	buttons: [
		{
			text: "Сохранить",
			click: function() {
				if (checkInput()) {
					$( this ).dialog( "close" );
				}
			}
		},
		{
			text: "Отмена",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
	]
});

$( "#dialog-link" ).click(function( event ) {
	$( "#sitename" ).val('example.com');
	$( "#sitehost" ).val('example.com');
	$( "#siteport" ).val('80');
	$( "#dialog" ).dialog( "open" );
	event.preventDefault();
});
