<?php // MAIN HEADER , loading automating delayed in FS ul-dl mode
//echo "Session=";print_r ($_SESSION);  	echo "dbsa=$dbsa"; //ept session
// EXTERNAL JAVASCRIPT  - ������� ��������� ������ ��� ��������� � ������ - ���������
// 3.6.06 edition    if (!$trafeconom) $idadd=" id=\"".$name."\" ";
 	global $verhead;	
$verhead="Header v3.6.1 (c) dj--alex"; //hide
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><html>
<head><meta http-equiv="Content-Type" content="text/html; charset=<?=$sd[19];?>">
<META NAME="KEYWORDS" CONTENT="<?=$sd[24]?>">
<title><? 
//<META NAME="KEYWORDS" CONTENT="News, news, New, new, Technology, technology, Headlines, headlines, Nuke, nuke, PHP-Nuke, phpnuke, php-nuke, Geek, geek, Geeks, geeks, Hacker, hacker, Hackers, hackers, Linux, linux, Windows, windows, Software, software, Download, download, Downloads, downloads, Free, FREE, free, Community, community, MP3, mp3, Forum, forum, Forums, forums, Bulletin, bulletin, Board, board, Boards, boards, PHP, php, Survey, survey, Kernel, kernel, Comment, comment, Comments, comments, Portal, portal, ODP, odp, Open, open, Open Source, OpenSource, Opensource, opensource, open source, Free Software, FreeSoftware, Freesoftware, free software, GNU, gnu, GPL, gpl, License, license, Unix, UNIX, *nix, unix, MySQL, mysql, SQL, sql, Database, DataBase, Blogs, blogs, Blog, blog, database, Mandrake, mandrake, Red Hat, RedHat, red hat, Slackware, slackware, SUSE, SuSE, suse, Debian, debian, Gnome, GNOME, gnome, Kde, KDE, kde, Enlightenment, enlightenment, Interactive, interactive, Programming, programming, Extreme, extreme, Game, game, Games, games, Web Site, web site, Weblog, WebLog, weblog, Guru, GURU, guru, Oracle, oracle, db2, DB2, odbc, ODBC, plugin, plugins, Plugin, Plugins">
if ($p!=0) $pagename=$pgcontent[$p+1][3];
echo $sd[16]." - ".$pagename." - ".$write; ?></title> <?
if (($enrestmenu)AND($menuloaded!==1)){?>
<div id="module" style="position:absolute; z-index:0; left: <?=$pr[44]+2 ; ?>px; top: 0px; background-color:<?=$rgbfon ; ?>; color:#<?=$rgbtext ; ?>;background:#<?=$rgbfon ; ?>; "><?
}
?>
<style type="text/css"><?
if (($pr[54])OR(!$dbstyle3en)) { // ������ �� ��������,  ��� � ����� ������� �� ����� � ��������
	?> body{color:#<?=$rgbtext ; ?>;background:#<?=$rgbfon ; ?>; }<?;
}?>
.buttonS
  { text-align:center; font-family:arial; font-size:<?=(13-$shriftsize); ?>pt; 
   background-color:<?=$rgbfon ; ?>; color:<?=$rgbtext ?> ; } 
<?
if ($prauth[$ADM][47]) { 
	echo ".hoverRow { background-color:#".$prauth[$ADM][47].";}"; } else  
		{echo ".hoverRow { background-color: yellow;}";}
?>
.clickedRow { background-color: orange; }
 </style>
<?  if (!$trafeconom) { ?>
<script>
function highlightTableRows(tableId, hoverClass, clickClass, multiple)
{
	var table = document.getElementById(tableId);
	if (typeof multiple == 'undefined') multiple = true;
	
	if (hoverClass)
	{
		var hoverClassReg = new RegExp("\\b"+hoverClass+"\\b");
		
		table.onmouseover = table.onmouseout = function(e)
		{
			if (!e) e = window.event;
			var elem = e.target || e.srcElement;
			while (!elem.tagName || !elem.tagName.match(/td|th|table/i)) elem = elem.parentNode;

			if (elem.parentNode.tagName == 'TR' && elem.parentNode.parentNode.tagName == 'TBODY')
			{
				var row = elem.parentNode;
				if (!row.getAttribute('clickedRow')) row.className = e.type=="mouseover"?row.className+" "+hoverClass:row.className.replace(hoverClassReg," ");
			}
		};
	}

}</script>
<? //
/*  wwww.tigir.com - 14.06.2006 - ������������ �������� ��� ������ ����� ���� - thx �������.
// �� ������������ �� ��������� ����������� . ������ ����� �� ������� ��������, ������� � ��� ���� � ����.
���������� hltable.js �� ������ "������������� ����� �������" - http://www.tigir.com/highlight_table_rows.htm*/
//if (typeof... ���� �� ��� ������� ��������� ��������, �� �� ��������� ��������� ��� ��� true
//if (hoverClass)...���������� ��������� ��� ������ ����� �������� �������� class ��������, ����� ������ ��������������� ��������� �� ��������� ���� �� ������.
//while (!elem.tagName |���� ������� ������� � ��������� TD ��� TH �� ������� TBODY
//var row = elem.parentNode var row = elem.parentNode;//��� ���������� ������ ������� � ������� ��������� �������
//--���� ������� ��� �� "���������" ���, �� � ����������� �� ������� ���� ��������� �����, �������� �����, ���� �������.
				
		//������ ���. ��������� ������������ � � ����������� onclick
// ������� ������  , ���������� ����� ����!!!
  // ��� ������ �������� ����  �����  </c�����>
  	/*
	if (clickClass) table.onclick = function(e)
	{
		if (!e) e = window.event;
		var elem = e.target || e.srcElement;
		while (!elem.tagName || !elem.tagName.match(/td|th|table/i)) elem = elem.parentNode;

		//���� ������� ������� � ��������� TD ��� TH �� ������� TBODY
		if (elem.parentNode.tagName == 'TR' && elem.parentNode.parentNode.tagName == 'TBODY')
		{
			//���������� ��������� ��� ������ ����� �������� �������� class ��������, ����� ������ ��������������� ��������� �� ����� �� ������.
			var clickClassReg = new RegExp("\\b"+clickClass+"\\b");
			var row = elem.parentNode;//��� ���������� ������ ������� � ������� ��������� �������
			
			//���� ������� ��� ��� ������� ������ ��� "���������"
			if (row.getAttribute('clickedRow'))
			{
				row.removeAttribute('clickedRow');//������� ���� ���� ��� ��� "�������"
				row.className = row.className.replace(clickClassReg, "");//������� ����� ��� ��������� ������
				row.className += " "+hoverClass;//��������� ����� ��� ��������� ������ �� ������� ����, �.�. ������ ���� � ������ ������ �� ������, � ��������� �� ����� ��� �����
			}
			else //��� �� ���������
			{
				//���� ������ ��������� �� ��������� �� ������, �� ������� �
				if (hoverClass) row.className = row.className.replace(hoverClassReg, "");
				row.className += " "+clickClass;//��������� ����� ��������� �� �����
				row.setAttribute('clickedRow', true);//������������� ���� ����, ��� ��� ������� � ���������
				
				//���� ��������� ��������� ������ ��������� ��������� ������
				if (!multiple)
				{
					var lastRowI = table.getAttribute("lastClickedRowI");
					//���� �� ������� ������ ���� �������� ������ ������, �� ������� � �� ��������� � ���� "�����������"
					if (lastRowI!==null && lastRowI!=='' && row.sectionRowIndex!=lastRowI)
					{
						var lastRow = table.tBodies[0].rows[lastRowI];
						lastRow.className = lastRow.className.replace(clickClassReg, "");//������� ��������� � ���������� ��������� ������
						lastRow.removeAttribute('clickedRow');//������� ���� "�����������" � ���������� ��������� ������
					}
				}
				//���������� ������ ���������� ���������� ����
				table.setAttribute("lastClickedRowI", row.sectionRowIndex);
			}
		}
	};
	 �������� ������ ������� ��� �������� ��������
	*/ 

}

//� ������ �������� �� ������������ ������� ���� ������  em {
//background-color:<?=$rgbtext ; ; color:<?=$rgbfon ; ;} 
//<link href="dbscriptstyles.css" rel="stylesheet" type="text/css"> em-invert
 if (!$trafeconom) { //require ("js.inc") ;
?> <script language="javascript" type="text/javascript">
function OM(button)
{button.style.color="<?=$rgbfon?>";
button.style.backgroundColor="<?=$rgbtext?>";
}
function OMOut(button)
{button.style.color="<?=$rgbtext?>";
button.style.backgroundColor="<?=$rgbfon?>";
}
function AL(button)
{button.style.color="00FF00";
}

</script>
<?
 };
	
	function initwindowactions ($enablepositioning) {  ?><SCRIPT LANGUAGE="javascript">
function win(id,trigger,lax,lay) {
if (trigger=="1"){
	if (document.layers) document.layers[''+id+''].visibility = "show"
	else if (document.all) document.all[''+id+''].style.visibility = "visible"
	else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"				
	}
else if (trigger=="0"){
	if (document.layers) document.layers[''+id+''].visibility = "hide"
	else if (document.all) document.all[''+id+''].style.visibility = "hidden"
	else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"				
	}
<? if ($enablepositioning) { // list of blocked functions  ���� ���������� ��� ������� ��������� ����������� ���� ������
?>// Set horizontal position	
if (lax){
	if (document.layers){document.layers[''+id+''].left = lax}
	else if (document.all){document.all[''+id+''].style.left=lax}
	else if (document.getElementById){document.getElementById(''+id+'').style.left=lax+"px"}
	}
// Set vertical position
if (lay){
	if (document.layers){document.layers[''+id+''].top = lay}
	else if (document.all){document.all[''+id+''].style.top=lay}
	else if (document.getElementById){document.getElementById(''+id+'').style.top=lay+"px"}
	}
	<? } ;?>
}
</SCRIPT><?
return true;
}


//unset ($dbstyle3en);// �������� ���� 3 ���������, �.�. ������� ������� � ��������� ���� 1 � ���� 2
if (($enrestmenu)AND($menuloaded!==1)) if ((!$pr[54])AND($dbstyle3en)) {
	require_once("_templates/head.php");
} else { echo "</head>";	echo "<h".$shriftsize.">"; }


//	function helpLayer(layerName)//{//	a="Msg for <?=$prauth[$ADM][0] "//	alert (a)//}
 //hidekey ("SID",$_SESSION["SID"]);//echo $SID."=SID=".$_SESSION["SID"];