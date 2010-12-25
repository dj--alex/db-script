<?php/*<html> <body>
 <!-- 2 необходимы строчки для создания подсказок -->
 <div Style = "POSITION: absolute; VISIBILITY: hidden; Z-INDEX: 200" id="DTip"></div>  <script src = "ToolTip.js"></script>
 <!-- ******************************************* -->
 <img width = "100" height = "100" onmouseout="HideTip()" onmouseover="ShowTip('Сюда отправляешь любой текст<br> или теги для его оформления, так<br> так если хочешь можно делать<br> рамки. Но лучше для них измени<br> content = msg; в файле скрипта')" />
 </body></html>*/
?><link href="msgerr.css" rel="stylesheet" type="text/css">
<div id="Layer2<?=($openedwindows); ?>" style="position:absolute; width:<?=$width?>px; height:21px; z-index:<?=(1+$openedwindows*2); ?>; left: <?=(61+$openedwindows*10); ?>px; top:<?echo ($changesize+68+$openedwindows*10);?>px; " class=<?=$class; ?>
	<?  echo ">".$mainheader;$leftactwin=$width-(506-419); ?>
	<div id="actwin" style="position:absolute; width:82px; height:0px; z-index:<?=(2+$openedwindows*2); ?>; left: <?=($leftactwin+1); ?>px; top: <?=(0); ?>px;" class=<?=$bgcolor; ?>>
<a HREF="javascript:window.history.back()"><img src="_ico/w_templ.png" border=0></a>
<a HREF="javascript:win('smsg<?=($openedwindows); ?>',0)"><img src="_ico/w_hide.png" border=0></a>
<a HREF="javascript:win('smsg<?=($openedwindows); ?>',1)"><img src="_ico/w_zoom_out.png" border=0></a><a HREF="javascript:win('Layer2<?=($openedwindows); ?>',0); win('smsg<?=($openedwindows); ?>',0)"><img src="_ico/w_close.png" border=0></a>
</div></div>
<div id="smsg<?=($openedwindows); ?>" style="position:absolute; width:<?=$width?>px; height:195px; z-index:<?=(1+$openedwindows*2);?>; left: <?=(61+$openedwindows*10); ?>px; top:<?echo ($changesize+90+$openedwindows*10);?>px;" class=<?=$bgcolor ;?>><?
