<!--startscript--><?php //help system link
// 3.6.06 edition
global $pr,$dbstyle3en,$pgcnt,$pgcontent,$pgheader,$pgplevel,$languageprofile,$enrestmenu,$menuloaded;
if (($enrestmenu)AND($menuloaded!==1)) if ((!$pr[54])AND($dbstyle3en)) {
	require_once("_templates/bottom.php");
} 

if ($enterpoint!=="help") {
	//DIVX - уплотняем DIVы. выглядит как панель баффов :) 
?><div id="help" style="position:absolute;  opacity:1; width: 90; height:40px; z-index:1; left: 500px; top: 5px;" class=div><h5><?



if (($prauth[$ADM][16]==false)AND($write==true) ) { //<?=cmsg ("F1_") ;
?><a target=help href="main.php?hlp=<?=$write;?>"><img src=_ico/wopros.png border=1 title="<?=cmsg (F1);?>"></a><?
}
if ($pr[49]) {
?><font color=red><a target=help href="main.php?rmsg=<?=rmsg ($write); ?>"><img src=_ico/bug1.png border=1 title="<?=cmsg (BUG)." ".$write?>"></a><?
}


if (!$pr[50]) {
?><font color=red><a href="login.php?rmsg=<?=$write; ?>"><img src=_ico/gearsofwar.png border=1 title="<?=$write;?>"></a><?
}
}
if (($prauth[$ADM][160]==true)) { //в будущем разделить??
	?><div Style = "POSITION: absolute; VISIBILITY: hidden; Z-INDEX: 200" id="DTip"></div>
<script src = "ToolTip.js"></script><?
	}

//  if (($frameoldcore==0)AND($msgexitcalled==0)AND(1==0)) {
  	//<a href="str0.php?p=0"><font color=green><?=cmsg ("F1_MNU") ;
  //}
		echo "<h".$shriftsize.">";	echo "</html><!--endscript-->";
if (($enrestmenu)AND(!$menuloaded)) echo "</div>";




