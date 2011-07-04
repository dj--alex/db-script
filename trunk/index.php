<?php ob_start (); // Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex
//header ("Location: main.php");   ЭТА ХЕРЬ ПОЧЕМУ ТО НЕ ПЕЧАТАЕТСЯ ИЗ ДРУГ  СКР <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"><html>
//$nomnu=1;
$x=($_SERVER['HTTP_REFERER']);
$dbs_ip =$_SERVER['REMOTE_ADDR'];	$dbs_ref= $_SERVER['HTTP_REFERER'];
$y=($_SERVER['SERVER_NAME']);
    $xx=strpos ($x,"mho.ws");

    
    //pre-rendered command   script /?VARNAME=parameter   filemgr.php reserved  $c,$i,$f   r.php   reserved  $r
    
    
    
if ($xx>0) { ob_clean (); header ("Location: http://dj.chg.su/mestatus.php"); exit;}
# ob_clean (); 
#header ("Location: http://wow.chg.su/wow/s",5); exit;
$q=($_SERVER['QUERY_STRING']);
if (($q[0]=="f")OR($q[0]=="c")OR($q[0]=="i")) { $redirectto="filemgr.php"; };  // typical  link  ?c=IDID
if (($q[0]=="a")OR($q[0]=="u")) { $redirectto="admin.php"; };
if (($q[0]=="r")OR($q[0]=="t")) { $redirectto="r.php"; }; // typical link ?tbl=6&m=2&vID=361&vID2=
if (($q[0]=="w")) { $redirectto="w.php"; };
$dest="$redirectto"."?"."$q";
//echo "r=".$redirectto."<br>q=".$q."<br>$q[0]==".$q[0]."<br><br>d=$dest"  ;

//exit;
if ($redirectto) header ("Location: ".$dest); 

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
   echo "<br><br>If you seen this message, you have a problem with run dbscript 4.<br>";
   echo "<br>If this is authorization problem, we recommend use standart authentication mechanism.<br><br>";
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

/*
 * <!--[if (gte IE 5.5)&(lt IE 10)]>
<div class="iedanger">Вы используете устаревшую версию браузера Internet Explorer, и данный сайт представлен для Вас в облегчённом варианте. Чтобы работали все функции сайтов вам необходимо обновить ваш браузер,мы рекомендуем <a href="http://getfirefox.com">Firefox 4 </a>, либо воспользуйтесь другими современными браузерами. Кроме того, использование устаревших версий Internet Explorer может негативно отразиться на безопасности Вашего компьютера (автозагрузка троянов,кража логинов паролей и кошельков, и другое.).</div>
<p><![endif]-->
 * 
 * javascript:R=0; x1=.1; y1=.05; x2=.25; y2=.24; x3=1.6; y3=.24; x4=300;
y4=200; x5=300; y5=200; DI=document.getElementsByTagName("img");
DIL=DI.length; function A(){for(i=0; i-DIL; i++){DIS=DI[ i ].style;
DIS.position='absolute'; DIS.left=(Math.sin(R*x1+i*x2+x3)*x4+x5)+"px";
DIS.top=(Math.cos(R*y1+i*y2+y3)*y4+y5)+"px"}R++}setInterval('A()',5);
void(0) 

введи это где нибудь на сайте с картинками в строке адреса вместо адреса сайта :)))

*/
?>

