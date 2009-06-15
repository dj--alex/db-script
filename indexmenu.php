<?// ƒанна€ программа относитс€ к пакету DBSCRIPT v2.1 (с) dj--alex
require_once ('dbscore.lib'); 
if ($_POST[$goo]) {$addr="str0.php?p=".$_POST[$str];
header ($addr);
}
//echo "$goo=goo str=$str";
for ($a=0;$a<15;$a++) {
	if ($pgheader[$a]==$languageprofile) $thislanguagepagescolumn=$a;  // BUG??  а зачем это +1 тут стоит?
} 
 // пишем если фонта нет каким хотим...  не прописан в css font
?><div id="layer3" style="width:91px; height:55px; position:absolute; left:1px; top:1px; z-index:1;">
  <div align="left">
 <address><font face="Times New Roman">
 <? 
 if (!$pr[10]) { ?><a href="index.php?go=relogin" target="_top" ><img src="_style/<? echo $sd[0]; ?>" alt="" name="" border="0"></a><font face="Arial"></font></font>      </address>
 <? } ?> 
  </div>
</div>
<?  if ($grafictemp!=="text") { ?>
<div id="layer1" style="width:90px; height:537px; position:absolute; left:1px; top:28px; z-index:1;">
  <table border="0" cellpadding="0" cellspacing="0">
   <h6>
    <? for ($a=0;$a<$pgcnt;$a++) {
    	if ($pgcontent[$a+1][1]=="") continue;
  $b=$a+1;
  $name=$grafictemp.$b;
  echo "<tr><td><p><a href=\"str0.php?p=$a\" target=\"_top\" "; //echo "onClick=\"MM";
 if (!$pr[46]) { if (!$pr[45])echo "onMouseOver=\"document.$name.src='_style/".$grafictemp."".$b."_over.png'\"";
 if (!$pr[45]) echo "onMouseOut=\"document.$name.src='_style/".$grafictemp."".$b.".png'\">";
if (!$pr[45]) { echo "<img src=\"_style/".$grafictemp."$b.png\" "; } else { echo "<img "; }// вывод графики 
 }
 $printmenuoption=$pgcontent[$b][3];
 if ($thislanguagepagescolumn) $printmenuoption=$pgcontent[$b][$thislanguagepagescolumn];
 echo "alt=\"".$printmenuoption."\" name=\"".$name."\" border=\"0\"></a></p></td></tr>";
   } 
?></h6><tr>
</tr><tr>
</tr><tr><td>&nbsp;</td>
</tr><tr><p>&nbsp;</p><p>&nbsp;</p></td></tr></table>
<?if (!$pr[10]) { ?> <h6 align="center">(c) 2008 Dj--alex</h6><? } ?> 
</div>
<? }
if ($grafictemp=="text") { ?>
<div id="layer2" style="width:90px; height:537px; position:absolute; left:1px; top:78px; z-index:1;">
  <table border="0" cellpadding="0" cellspacing="0">
  <? for ($a=0;$a<$pgcnt;$a++) {
  if ($pgcontent[$a+1][1]=="") continue;
 // hidekey ("str",$pgcontent[$a+1][0]);
 ?> <form action="str0.php?p=<?=$pgcontent[$a+1][0];?>"><?
  	menukey ("goo",$pgcontent[$a+1][3]);
  echo "</form>";
  }
?></table>
</div>
<? }
?>
</body>
</html>
