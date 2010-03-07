<?// Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex
require_once ('dbscore.lib'); 
if ($pr[55]) { print ("Normal exit by config parameters"); exit ;} //additonal,   this is part str0.php
//echo "$goo=goo str=$str";

for ($a=0;$a<15;$a++) {
	if ($pgheader[$a]==$languageprofile) $thislanguagepagescolumn=$a;  // BUG??  а зачем это +1 тут стоит?
} 
 // пишем если фонта нет каким хотим...  не прописан в css font    -- это просто плашка логотипа для dbs3
?><div id="logo1" style="width:91px; height:55px; position:absolute; left:1px; top:1px; z-index:1;">
  <div align="left">
 <address><font face="Times New Roman">
 <? 
 if (!$pr[10]) { ?><a href="index.php?go=relogin" target="_top" ><img src="_style/<? echo $sd[0]; ?>" alt="" name="" border="0"></a><font face="Arial"></font></font>      </address>
 <? } ?> 
  </div>
</div>
<?  
if ($grafictemp!=="text") { // меню - не двигать желательно
 ?>
<div id="menu1" style="width:90px; height:537px; position:absolute; left:1px; top:28px; z-index:1;">
  <table border="0" cellpadding="0" cellspacing="0">
   <h6>
    <? for ($a=0;$a<$pgcnt;$a++) {
        if ($pr[81]) { break;};
    	if ($pgcontent[$a+1][1]=="") continue;
  $b=$a+1;
  $name=$grafictemp.$b;
  echo "<tr><td><p><a href=\"str0.php?p=$a\" target=\"_top\" "; //echo "onClick=\"MM";
 if (!$pr[46]) { if (!$pr[45])echo "onMouseOver=\"document.$name.src='_style/".$grafictemp."".$b."_over.png'\"";
 if (!$pr[45]) echo "onMouseOut=\"document.$name.src='_style/".$grafictemp."".$b.".png'\">";
if (!$pr[45]) { echo "<img src=\"_style/".$grafictemp."$b.png\" "; } // вывод графики
 }
 $printmenuoption=$pgcontent[$b][3];
 if ($thislanguagepagescolumn) $printmenuoption=$pgcontent[$b][$thislanguagepagescolumn];
 if ($sd[19]=="utf-8") $printmenuoption=iconv("windows-1251","utf-8",$printmenuoption);
 if ($pr[45]) echo ">$printmenuoption</a></p></td></tr>";  // отключение графики теперь корректно работает во всех браузерах
 if (!$pr[45]) echo "alt=\"".$printmenuoption."\" name=\"".$name."\" border=\"0\"></a></p></td></tr>";
   } 
?></h6>

   <?

if ($pr[81]) { // ничего не меняется? 2010-02  фрагмент не используется и не выводится покачто
?>    <br><br><table border="0" cellpadding="0" cellspacing="0">
  <? for ($a=0;$a<$pgcnt;$a++) {
  if ($pgcontent[$a+1][1]=="") continue;
 // hidekey ("str",$pgcontent[$a+1][0]);
 ?> <form action="str0.php?p=<?=$pgcontent[$a+1][0];?>"><?
 $name=$pgcontent[$a+1][3];
 if ($sd[19]=="utf-8") $name=iconv("windows-1251","utf-8",$name);
  	menukey ("goo",$name);
  echo "</form>";
  }
?></table>
  <? } ?>
      <br><br><br></table>
<?if (!$pr[10]) {
    ?> <h6 align="center">(c) 06-10 Dj--alex</h6><? } ?>
</div>
<? }


if (!$str0active) { ?></div>
<div id="module1" style="left:<?=$pr[44]; ?>px;top: 0px; background-color:<?=$rgbfon ; ?>; position:absolute; z-index:0; "> <?
}
//if ($str0active) { echo "</body></html>";};  // str0 сам подгрузит нужную страницу если он есть, если его нет это сделает dbscore

?>
