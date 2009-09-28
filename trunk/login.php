<?
$stx = $REMOTE_ADDR ;$st = substr ($stx,0,7);
$exitpoint="exitpoint";

$verlogin="Login manager 4.0 (c) dj--alex";
$enterpoint=$verlogin;
 require_once ('dbscore.lib'); // функция подготовки к работе и авторизации
// Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex
if ($prauth[$ADM][2]==false) echo "<br>";
if ($prauth[$ADM][0]=="UNKNOWN") echo "<br><br><br><br><br><br><br><br><br><br>";
if ($activation==false) echo "<br><br><br><br><br><br><br><br><br><br>";
if ($demo) $serial="demo";
if ($publicdemo) $serial="publicdemo";
if ($test) $serial=$testenable;

 if (isset($_FILES["userfile"])) { //проверяем посланный ключ //йух посылается , а не ключ... мдя интересно с какой это 
//	if ($go=="Send key") { //проверяем посланный ключ
		$uploaddir= "_conf";
		if ($size>700) { echo "Превышен hardcoded лимит в 300bytes";exit;};
if (uploadfile ($uploaddir,"add.key")) { lprint ("FS_FWR"); } else { lprint ("FS_FWRFAIL"); } 
//echo "2userfile=$userfile  go=$go path=$path (disabled) ";
Header("Location: login.php");//пофиксили баг с лишним обновлением.  не пересылаем заново временно пока херня не пройдет

    }
    

    
    
if (($prauth[$ADM][2]==false)AND(($prauth[$ADM][11]))) {lprint ("A_LOG_BAN");
?><form action="login.php" method="post"> <?
submitkey ("resetcookie","LOGOUT");
 echo "</form>";
exit;}  

//
 if ($pr[36]=="on")  { 
if (!isset($_SERVER['PHP_AUTH_USER']) ||
     ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
   authenticate();}  
 };
 
	 if (($pr[36]=="on")AND($ADM==0)) { lprint ("LG_OFF");   exit;};
$p=1;
       print "<h".$sd[3].">";
// LIMITATIONS
$gmlimitcfg=0;
if ($loginstate) if ($ADM==0) {msgexiterror ("notuser",0,"login.php");}// -inc pass or login

If (($_COOKIE['dbsa'])AND($ADM===0)) { echo "Your login as anonymous." ;
?><form action="login.php" method="post"> <?
submitkey ("resetcookie","LOGOUT");$anprinted=1;
 echo "</form>";

echo "<table border=0 ><tr><td>";pictogramm("search.png","getfile.php",cmsg ("MNU_3"));
echo "<td>";echo "<td>";pictogramm("key1.png","filemgr.php",cmsg ("MNU_7"));
echo "<td>";pictogramm("temp.png","r.php?viewid=.ver&base=0",cmsg ("MNU_4"));
echo "</tr></table>";

exit;}  

If (($dbsa)AND($ADM===0)) { echo "Your login as anonymous." ;
?><form action="login.php" method="post"> <?
if ($anprinted==false) submitkey ("resetcookie","LOGOUT");
 echo "</form>";
echo "<table border=0 ><tr><td>";pictogramm("search.png","getfile.php",cmsg (MNU_3));
echo "<td>";echo "<td>";pictogramm("key1.png","filemgr.php",cmsg (MNU_7));
echo "</tr></table>";
exit;}  

##начало проверка активации
dmck ($serial);  // включает демо или тест версию если выбрал пользователь.  изменено в 3.5.61
	
	



 $codekey2=loadserial ();
if ($codekey2) {	$codekey=$codekey2; $activate=true;}

##конец проверка активации
// все здешние HTML коды действуют только на эту страницу, нигде в других местах аналогичных окон не используется.
// это окно тоже можно как функцию сделать

if ($activate==false) {?><STYLE TYPE="TEXT/CSS">
<!--
body{
	overflow: auto;
}
td {
	font: 11px tahoma, verdana, arial;
	cursor: default;
}
inputx, selectx, divx {
	font: 11px times new roman, verdana, arial;
}
input.textx, selectx {
	width: 100%;
}
fieldset {
	margin-bottom: 10px;
}
-->
</STYLE>
<script language="JavaScript" type="text/JavaScript">
</script>
<link href="style.css" rel="stylesheet" type="text/css">
<div id="Layer1" style="position:absolute; width:400px; height:115px; z-index:1; left: 141px; top: 148px;" class="author_text">
<FIELDSET>
<LEGEND><img src=_ico/keyact.png></img></LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<form action="login.php" method="post">
<TD WIDTH=41%><? lprint ("ACT_CODE") ?>:</TD>
<TD WIDTH=59%><?=genactcode (); ?></TD>
</TR>
<TR>
<TD><? lprint ("S_N_ENT") ?>:</TD>
<TD><INPUT NAME=serial TYPE=text CLASS=text></TD>
</TR>
</TABLE><CENTER>
<? 
submitkey ("check","CHECK");
if ($OSTYPE=="WINDOWS") submitkey ("demo","DEMO");
if ($OSTYPE=="LINUX") submitkey ("demo","2DBS_");
if ($testenable) submitkey ("test","TEST");
submitkey ("publicdemo","7DBS_");
echo "</CENTER></form></FIELDSET></div>";
exit;}


// первое окно
if (($prauth[$ADM][0]==false)OR(!$ADM)) {?><STYLE TYPE="TEXT/CSS">
<!--
body{
	overflow: auto;
}
td {
	font: 11px tahoma, verdana, arial;
	cursor: default;
}
inputx, selectx, divx {
	font: 11px times new roman, verdana, arial;
}
input.textx, selectx {
	width: 100%;
}
fieldset {
	margin-bottom: 10px;
}
-->
</STYLE>
<script language="JavaScript" type="text/JavaScript">
</script>
<link href="style.css" rel="stylesheet" type="text/css">
<div id="Layer1" style="position:absolute; width:200px; height:115px; z-index:1; left: 311px; top: 158px;" class="author_text">
<FIELDSET>
<LEGEND><img src=_ico/key.png></img></LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<form action="login.php" method="post">
<TD WIDTH=41%><? lprint ("A_USR_LG") ?>:</TD>
<TD WIDTH=59%><INPUT NAME=dbs_log TYPE=text CLASS=text></TD>
</TR>
<TR>
<TD><? lprint ("A_USR_PS") ?>:</TD>
<TD><INPUT NAME=dbs_psw TYPE=password CLASS=text></TD>
</TR>
</TABLE><CENTER>
<? 
checkbox ($forever,"forever"); lprint ("LOG_FOREVER");
submitkey ("loginstate","FMG_ENTER");
//submitkey ("anonymous","ANONYMOUS"); 
echo "</CENTER></form></FIELDSET></div>";
exit;}


//второе окно
##начало проверка ключа
if (($dbskeystate===false)AND($addkeystate===true)) $regresult=installnewkey ($key);
if (($dbskeystate===false)AND($addkeystate===false)) $nokeys=1;// тут затребовать загрузку add.key
if (($dbskeystate===true)AND($addkeystate===true)) $regresult=addnewkey ($key);

 	if ($regresult) msgexiterror ("key",$regresult,"login.php");
##конец проверка ключа



//END OF LIMITATIONS
	echo "<cite><p>".cmsg ("WELCOME!")." dbscript , {$_SERVER['PHP_AUTH_USER']}<br></cite>";   
	 if ($pr[36]=="on")  {    exit; };
	if ($prauth[$ADM][16]==0) {

//	echo "Предыдущий логин: {$_REQUEST['OldAuth']}<br><h6>";
print "<h".$sd[3].">";
if ($helpgo=="") lprint ("HELP_HELLO");
//echo " Вы можете запустить преобразование текущей базы в excel совместимый формат и скачать ее, но для обратного преобразования ее потребуется послать сюда dj--alex@yandex.ru.<br> внимание! не отделять продукт от его ID!.<br>";
} 
?><form method="post"> <?
submitkey ("resetcookie","LOGOUT");
echo "</form>";
echo "<table border=0 ><tr>";
echo "<td>";pictogramm("config.png","admin.php",cmsg ("MNU_0"));
echo "<td>";pictogramm("userprofile.png","admin.php?cmd=myprof",cmsg ("MNU_1"));
echo "<td>";pictogramm("search.png","getfile.php",cmsg ("MNU_3"));
echo "<td>";pictogramm("editor.png","w.php",cmsg ("MNU_2"));
echo "<td>";pictogramm("admin.png","dblinker.php",cmsg ("MNU_8"));
echo "<td>";pictogramm("key1.png","filemgr.php",cmsg ("MNU_7"));echo "</tr><tr>";
echo "<td>";pictogramm("temp.png","r.php?viewid=.ver&base=0",cmsg ("MNU_4"));
echo "<td>";pictogramm("temp.png","admin.php?cmd=note",cmsg ("MNU_5"));
echo "<td>";pictogramm("userinfo.png","r.php?viewid=.info&base=0",cmsg ("MNU_9"));
echo "<td>";pictogramm("admin.png","admin.php?cmd=test",cmsg ("MNU_6"));
echo "<td>";pictogramm("logoff.png","r.php?vID=.author&base=0",cmsg ("MNU_10"));
echo "</tr></table>";


?>
<br> 
  <form method="post"> <?
submitkey ("helpgo","HELP_EDIT");
submitkey ("helpgo","HELP_ADM");
//echo "</form>";


if ($helpgo==cmsg ("HELP_EDIT")) {
	echo "<br>";lprint ("WF_HELP"); echo "<br>";
	}

if ($helpgo==cmsg ("HELP_ADM")) {
	If ($prauth[$ADM][2]==true) {echo "<br>".cmsg ("A_HLP")."<br>";	}
	If ($prauth[$ADM][2]==false) echo "<br>".cmsg ("A_HLP2")."<br>"; 
	echo cmsg ("AB_HELP");
}

if ($prauth[$ADM][2]==true)  nokeys (0);
/*
Здесь вы можете настроить конфигурацию каждой базы в отдельности по очереди. Для категорий важен тип базы и колонка по которой ведется группировка. Режим 1 - Поиск по нечисловым значениям групп. Числа рассматриваются как данные, 2 - многоуровневый режим поиска, непустые ячейки рассматриваются как группы до 2 уровней вложенности. 3 - то же , но с 1 уровнем. Есть опции для режима 3
Заметка 0 и пусто - совершенно неравнозначные параметры.
При указании уровня доступа обратите внимание что изменения и запись будут разрешены только в случае если уровень редактора будет выше уровня базы. Другие пользователи не увидят высокоуровневых баз.
Для SQL должны быть указаны хост, логин , пароль один для всех в основной конфигурации, база и таблица. Разумеется необходимо разрешить SQL.
Отбор колонок действует для режимов 6 и 7. Cуществуют префиксы позволяющие гибко работать с ними !1 Все кроме,!2 Только эти,!3 Все возможные,указываются ID колонок. В редакторе их можно посмотреть.
*/
	//if ($pr[35]!=="on") if (($daysleft>0)AND($daysleft<10)) trial ();
	 // if (($daysleft<0)AND($daysleft!=="unlimited")) expire ();
 //$a="17.02.2009";	 $b="17.02.2008";	 if ($a<$b) echo "a menshe b";	 if ($a>$b) echo "a bolshe b";	 if ($a==$b) echo "a = b";  
//endcomm



