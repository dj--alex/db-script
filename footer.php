<!--startscript--><?php //help system link
// 3.6.06 edition     if (!$trafeconom) $idadd=" id=\"".$name."\" ";
global $pr,$dbstyle3en,$pgcnt,$pgcontent,$pgheader,$pgplevel,$languageprofile,$enrestmenu,$menuloaded,$coreloadskip,$installermode;
if (($enrestmenu)AND($menuloaded!==1)) if ((!$pr[54])AND($dbstyle3en)) {
	require_once("_templates/bottom.php");
}


if ($coreloadskip!=1) {
    if ($enterpoint!=="help") {


if ($pr[83]) {?><!--share button will be -->
<div id="module5vk" style="position:absolute;  left: <?php echo "330" ; ?>px; top: 5px;">
<script type="text/javascript"><!--
document.write(VK.Share.button(<?php
if (!$sd[31]) echo "false";
if ($sd[31]) echo "{url: \"".$sd[31]."\"}";
?> ,{type: "round", text: "<?php echo cmsg("SAVE");?>"}));
--></script></div><?php

}
	//DIVX - уплотняем DIVы. выглядит как панель баффов :)
?><div id="help" style="position:absolute;  opacity:1; width: 200; height:40px; z-index:1; left: 420px; top: 5px;" class=div><h5><?php

if (!$pr[84]) {
?> <a target=help href="http://navstar-gps.ru"><img src="_ico/navstar.ico" border=1 title="Navstar-gps"></a> <?php
;}
if ($pr[95]) { //куда нибудь бы закрепить эту рекламу чтоли.
?><script target=help type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t54.5;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров и"+
" посетителей за 24 часа' "+
"border='0' width='88' height='31'><\/a>")
//--></script><!--/LiveInternet--><?
}


// реклама - выше



if (($prauth[$ADM][16]==false)AND($write==true) ) { //<?php echo cmsg ("F1_") ;
?><a target=help href="main.php?hlp=<?php echo$write;?>"><img src=_ico/wopros.png border=1 title="<?php echo cmsg (F1);?>"></a><?php
}
if ($pr[49]) {
?><font color=red><a target=help href="main.php?rmsg=<?=rmsg ($write); ?>"><img src=_ico/bug1.png border=1 title="<?php echo cmsg (BUG)." ".$write?>"></a>
<font color=red><a target=help href="http://code.google.com/p/db-script/issues"><img src=_ico/bug1.png border=1 title="<?php echo cmsg (BUGDET)." ".$write?>"></a>
<?php  }


if (!$pr[50]) {
?><font color=red><a href="login.php?rmsg=<?php echo$write; ?>"><img src=_ico/gearsofwar.png border=1 title="<?php echo$write;?>"></a><?php
}
}
if (($prauth[$ADM][160]==true)) { //в будущем разделить??
	?><div Style = "POSITION: absolute; VISIBILITY: hidden; Z-INDEX: 200" id="DTip"></div>
<script src = "ToolTip.js"></script><?php
	}

//  if (($frameoldcore==0)AND($msgexitcalled==0)AND(1==0)) {
  	//<a href="str0.php?p=0"><font color=green><?php echo cmsg ("F1_MNU") ;
  //}
		echo "<h".$shriftsize.">";	echo "</html><!--endscript-->";
if (($enrestmenu)AND(!$menuloaded)) echo "</div>";
//только для тест версий - вывод надписи
if (($codekey==7)OR($codekey==9)) {
?><div id="menu" style="position:absolute; z-index:2; left: 10px; top: 16px;" ><h2><font color=red><bb>DEMO</bb></a></font></h2></div><?php
}
if (($codekey==8)OR($codekey==10))  {
?><div id="menu" style="position:absolute; z-index:2; left: 10px; top: 16px;" ><h2><font color=red><bb>TEST</bb></a></font></h2></div><?php
}
}
//memory_get_peak_usage
