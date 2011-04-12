<?php // MAIN HEADER , loading automating delayed in FS ul-dl mode
//echo "Session=";print_r ($_SESSION);  	echo "dbsa=$dbsa"; //ept session
// EXTERNAL JAVASCRIPT  - задание каскадных стилей дл€ программы и кнопок - интерфейс
// 3.6.06 edition    if (!$trafeconom) $idadd=" id=\"".$name."\" ";
//<script src="http://code.jquery.com/jquery-latest.js"></script> полна€
//или <script src="jquery142.js"></script>
// воздушна€
 	global $verhead,$systemshrift,$buttonshrift,$tableshrift;
$verhead="Header v4.3.12 (c) dj--alex"; //hide
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><html>
<head><meta http-equiv="Content-Type" content="text/html; charset=<?php echo$sd[19];?>">
<META NAME="KEYWORDS" CONTENT="<?php echo$sd[24]?>">
<title><?php
if ($p!=0) $pagename=$pgcontent[$p+1][3];
$element=$vID; settype ($element, integer); if ($element=="0") unset ($element);
if ($sd[19]=="utf-8") $pagename=iconvx("windows-1251","utf-8",$pagename);
$titleout= $sd[16]." - ".$pagename." - ".$write." $element ";
echo $titleout ;
?></title>
 <? if ((!$pr[97])and (!$pr[98])) { echo "<script src=\"jquery142.js\"></script>" ; };
  if (($pr[98])AND(!$pr[97])) { echo "<script src=\"http://yandex.st/jquery/1.4.2/jquery.min.js\"></script>" ; };
if ($pr[83]) { echo "";;
     ?><!--head-->
<script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?3"></script><?php
// мл€ где переменна€ с координатами меню когда она здесь так нужна???
}

//этот модуль выводитьс€ только в стиле DM (4)
if ($dbstyle3en) if (($enrestmenu)AND($menuloaded!==1)){?>
<div id="module4" style="position:absolute; z-index:0; left: <?php echo$pr[44]+2 ; ?>px; top: 0px; background-color:<?php echo$rgbfon ; ?>; color:#<?php echo$rgbtext ; ?>;background:#<?php echo$rgbfon ; ?>; "><?php
} 
?>
<style type="text/css"><?php
if ($prauth[$ADM][47]) {       $colorfonbackgroundselect=$prauth[$ADM][47];

	echo ".hoverRow { background-color:#".$prauth[$ADM][47].";}"; } else
		{echo ".hoverRow { background-color: yellow;}";
                  $colorfonbackgroundselect="yellow";

                }
if ($prauth[$ADM][57]) {

                        $colortextmouseselect=$prauth[$ADM][57];
	 } else
		{  $colortextmouseselect="green";

                }
if ($prauth[$ADM][58]) {
                        $coloradselect=$prauth[$ADM][58];
	 } else
		{
                        $coloradselect="blue";
                }
?>
.clickedRow { background-color: green; }
td.hovered {
  background-color: yellow;
  color: #666;
}
?> #myTable { font:<?php echo$tableshrift ; ?> ; }  #Adminpanel { font:<?php echo$tableshrift ; ?> ; }
body { font:<?php echo$systemshrift ; ?>; <?php
if (($pr[54])OR(!$dbstyle3en)) { // примен€етс€ если стиль DeusModus неактивен
	?> color:#<?php echo$rgbtext ; ?>;background:#<?php echo$rgbfon ; ?>; }<?php;
}?>
.buttonS
  { text-align:center; font:<?php echo$buttonshrift ; ?>;
   background-color:<?php echo$rgbfon ; ?>; color:<?php echo$rgbtext ?> ; }
?></style>
<?php  if (!$trafeconom) { // куй а не размер кнопкам!
    // Jquery function hover for table  - no work!!!  background not implemented   дочерние классы поддерживаютс€ :)))
    ?>
<script type="text/javascript">
$('table').hover(function(){
  $(this).find('td').addClass('hovered');
}, function(){
  $(this).find('td').removeClass('hovered');
});
$(document).ready(function() {
$('#myTable').find('td').addGlow({ textColor: '<?=$colortextmouseselect;?>', haloColor: '<?=$coloradselect;?>', radius: 5 });
$('#myTable').find('tr').addGlow({ textColor: '<?=$coloradselect?>', haloColor: '<?=$colorfonbackgroundselect?>', radius: 5 });
$('#Adminpanel').find('td').addGlow({ textColor: '<?=$colortextmouseselect?>', haloColor: '<?=$colorfonbackgroundselect?>', radius: 50 });
$('red').addGlow({ textColor: '#dd00dd', haloColor: '#dd00dd', radius: 50 });
$('error').animate({ backgroundColor: "<?=$colorerrselect?>" }, 500 );
});
</script>
<script src="jquery.color.js" type="text/javascript"></script>
<script src="jquery-glowing.js" type="text/javascript"></script>
    <script type="text/javascript">
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
			while (!elem.tagName || !elem.tagName.match(/td|tr|table/i)) elem = elem.parentNode;

			if (elem.parentNode.tagName == 'TR' && elem.parentNode.parentNode.tagName == 'TBODY')
			{
				var row = elem.parentNode;
				if (!row.getAttribute('clickedRow')) row.className = e.type=="mouseover"?row.className+" "+hoverClass:row.className.replace(hoverClassReg," ");
			}
		};
	}

}</script>
<?php //
/*  wwww.tigir.com - 14.06.2006 - используетс€ частично ибо больше нафиг надо - thx авторам.
// не используетс€ ни подсветка выделенного . вообще можно ее удалить наверное, галочки и так есть у мен€.
Ѕиблиотека hltable.js из статьи "ѕодсвечивание строк таблицы" - http://www.tigir.com/highlight_table_rows.htm*/
//if (typeof... если не был передан четвертый аргумент, то по умолчанию принимаем его как true
//if (hoverClass)...регул€рное выражение дл€ поиска среди значений атрибута class элемента, имени класса обеспечивающего подсветку по наведению мыши на строку.
//while (!elem.tagName |≈сли событие св€зано с элементом TD или TH из раздела TBODY
//var row = elem.parentNode var row = elem.parentNode;//р€д содержащий €чейку таблицы в которой произошло событие
//--≈сли текущий р€д не "кликнутый" р€д, то в разисимости от событи€ либо примен€ем стиль, назнача€ класс, либо убираем.
				
		//ƒанное рег. выражение используетс€ и в обработчике onclick
// урезать скрипт  , обнаружено много букв!!!
  // был удален следущий элем  перед  </cкрипт>
  	

}

//в режиме экономии не используетс€ внешний файл стилей  em {
//background-color:<?php echo$rgbtext ; ; color:<?php echo$rgbfon ; ;}
//<link href="dbscriptstyles.css" rel="stylesheet" type="text/css"> em-invert
//<link href="menu.css" rel="stylesheet" type="text/css">
 if (!$trafeconom) { //require ("js.inc") ;
?> 
<script language="javascript" type="text/javascript">
function OM(button)
{button.style.color="<?php echo$rgbfon?>";
button.style.backgroundColor="<?php echo$rgbtext?>";
}
function OMOut(button)
{button.style.color="<?php echo$rgbtext?>";
button.style.backgroundColor="<?php echo$rgbfon?>";
}
function AL(button)
{button.style.color="00FF00";
}

</script>
<?php
 };
	
function initwindowactions ($enablepositioning) {  
        global $initwindowact;
        if ($initwindowact==1) return;
        $initwindowact=1;
        ?><SCRIPT LANGUAGE="javascript">

function win(id,trigger,lax,lay) {
if (trigger=="1"){
	if (document.layers) document.layers[''+id+''].visibility = "show"
	else if (document.all) {document.all[''+id+''].style.visibility = "visible"}
	else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "visible"				
	}
else if (trigger=="0"){
	if (document.layers) document.layers[''+id+''].visibility = "hide"
	else if (document.all) {document.all[''+id+''].style.visibility = "hidden"}
	else if (document.getElementById) document.getElementById(''+id+'').style.visibility = "hidden"				
	}
<?php if ($enablepositioning) { // list of blocked functions  этой переменной нет поэтому разрешить перемещение пока нельз€
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
	<?php } ;?>
}
</SCRIPT><?php
return true;
}


//unset ($dbstyle3en);// временно меню 3 отключено, т.к. проблем хватает с имеенмыми меню 1 и меню 2
if (($enrestmenu)AND($menuloaded!==1)) if ((!$pr[54])AND($dbstyle3en)) {
	require_once("_templates/head.php");
} else { echo "</head>";	echo ""; }// tut smena shrifta  echo "<style type=text/css> font:$systemshrift ;</style>"; kak obychno ne rabotaet



//	function helpLayer(layerName)//{//	a="Msg for <?php echo$prauth[$ADM][0] "//	alert (a)//}
 //hidekey ("SID",$_SESSION["SID"]);//echo $SID."=SID=".$_SESSION["SID"];
