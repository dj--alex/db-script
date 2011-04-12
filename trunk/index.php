<?php ob_start (); // Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex
//header ("Location: main.php");   ЭТА ХЕРЬ ПОЧЕМУ ТО НЕ ПЕЧАТАЕТСЯ ИЗ ДРУГ  СКР <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><html>
//$nomnu=1;
$x=($_SERVER['HTTP_REFERER']);
$dbs_ip =$_SERVER['REMOTE_ADDR'];	$dbs_ref= $_SERVER['HTTP_REFERER'];
$y=($_SERVER['SERVER_NAME']);
    $xx=strpos ($x,"mho.ws");

if ($xx>0) { ob_clean (); header ("Location: http://dj.chg.su/mestatus.php"); exit;}
# ob_clean (); 
#header ("Location: http://wow.chg.su/wow/s",5); exit;
ob_flush ();


@$a=opendir ("_conf"); if ($a==false) Header("Location: install.php");
	require ('dbscore.lib'); // функция подготовки к работе и авторизации

if ($frameoldcore==0) {require_once ("main.php");}
?>
<b><h3><font color=red><a href="login.php"><?=cmsg ("ENTER"); ?></b></h></a>
<br>
<?
echo "</font>".date ("d.m.Y H-i-s")."<br>";
if ($frameoldcore==1) {
	autoexecsql (0);
  if (($go=="relogin")or($add<0)) {
   if (!isset($_SERVER['PHP_AUTH_USER']) ||
     ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
   authenticate();$add++;}  else {
   echo "<form action='{$_SERVER['PHP_SELF']}' METHOD='post'>\n";
   hiddenkey ("SeenBefore",1);$go=="0";
   hiddenkey ("OldAuth",$_SERVER['PHP_AUTH_USER']);
   submitkey ("write","AUTHEN");
   echo "<br><br>Если у вас IE то введите пароль в первый раз и нажимайте отмену при повторном запросе.<br>";
   echo "<br>Перед набором пароля проверяйте раскладку клавиатуры и Caps Lock<br><br>";
   echo "</form></p>\n";$add++;	
  }
}
?>

<frameset rows="*" COLS="15%, 85%" framespacing="0" frameborder="YES" border="0">
  <frame src="indexmenu.php" name="mainFrame" scrolling="NO" noresize>
  <frame src="main.php" name="rightFrame">
</frameset>
<noframes><body>Ваш браузер не поддерживает фреймы. Обновите его.
</noframes>
<?
}
?>
