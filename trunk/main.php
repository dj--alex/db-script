<?
// Данная программа относится к пакету DBSCRIPT v1.8 (с) dj--alex
$nomnu=1; //эта переменная должна задаваться если нужна до инициализации
require_once ('dbscore.lib'); // функция подготовки к работе и авторизации
echo "<CENTER>";
$enterpoint="help";// для показа точки входа
$hlp=getvar ('hlp');


if ($hlp!==false) {
	$messageid=rmsg ($hlp);//	echo "message $hlp  is key $messageid <br>";
	$msghelpid="F1_".$messageid;//	echo "msg for key $msghelpid is ".cmsg ($msghelpid)."<br>";
	lprint ($msghelpid);
exit (1);
}

// ПРИ НЕСООТВЕТСТВИИ LANGDB СЕРВЕР МОЖЕТ НЕ ПРИНЯТЬ ДАННЫЕ"!!

 	
 	$actcode=genactcode();
 		$dbs_ip =$_SERVER['REMOTE_ADDR'];
$rmsg=getvar ('rmsg');  //надо это делать в три шага 1- получение инфы. два подтверждение и отправка, 3 сохранение на сервере
//echo "rmsg=$rmsg go=$go inet=$inet str=$str <br>!!!!!!!!!!!!!!!!!1";
if ($rmsg!==false) {
	@$inet=fopen ("http://dj.chg.su/dbscript/update.txt","r");
	$authorreport=$prauth[$ADM][0];$keyword=$rmsg;
	echo " Report by $authorreport  (pressed last key ".$keyword."<br>";
	lprint ("REP_MSG");
	//if ($str) $go==cmsg ("SENDMSG");
	if ($inet==false) { lprint (NO_INET) ; echo "<form action=main.php method=post>";}
	if ($inet==true) { lprint (INETD) ; echo "<form action=\"http://dj.chg.su/dbscript/old/main.php\" method=post>";}
$str="Date:".date("m.d.y H:i:s")."¦User:".$authorreport."¦IP:".$dbs_ip."¦ACTCODE:".$actcode."¦CORE:".$verinit."¦REGTO:".$registeredto."¦ADMINMAIL:".$adminmail."¦REPORT:".$report." ";
	
	submitkey ("go","SENDMSG1");
	hidekey ("goID","SENDMSG1");
	inputtxt ("report",90);
	hidekey ("inet",$inet);
	hidekey ("str",$str);
	echo "</form>";
	exit (1);
}

$go=getvar ('go');  
if ($goID=="SENDMSG1") {
@$inet=fopen ("http://dj.chg.su/dbscript/update.txt","r");
echo "getting data $report <br>this ok?...<br>";
if ($inet==true) { lprint (INETD) ; echo "<form action=\"http://dj.chg.su/dbscript/old/main.php\" method=post>";}
	if ($inet==false) { lprint (NO_INET) ; echo "<form action=main.php method=post>";}
	submitkey ("go","SENDMSG");
	hidekey ("goID","SENDMSG");
	hidekey ("inet",$inet);
	hidekey ("str",$str.$report."\n\r");
	echo "</form>";
	exit;
  }

  
$go=getvar ('go');
if ($goID==("SENDMSG")) {
@$inet=fopen ("http://dj.chg.su/dbscript/update.txt","r");
echo "getting data $str... saving...<br>";
	$w=csvopen ("_logs/reportlog.dat","a+",1);
	if ($w==false) {mkdir ("_logs");
	$w=csvopen ("_logs/reportlog.dat","a+",1);}
	@$a=fwrite ($w,$str);		  @fclose ($w);
	if ($w==false) {echo "FAILED!!!";} else { lprint (BUGREPORT_OK);echo "Sending ... OK";}
	exit;
  }


if (!$pr[10])  {
	?> <img src=_style/<? echo $sd[0]; ?> align=middle></p><? 
}
echo $sd[1]."<br><br><br>"; 
{
echo cmsg ("AUTHOR")." Dj--alex  *";
echo cmsg ("EMAIL").":dj--alex@yandex.ru<br>";
echo "<br>".cmsg ("REGTO")." ".$registeredto."<br>";
echo "$yourvrs<br>";
if (($daysleft!=="unlimited")AND(!($daysleft<1))AND($daysleft<11)) echo "Дней осталось:$daysleft<br>";
if (($daysleft!=="unlimited")AND($daysleft<1)) echo "<font color=red>".cmsg ("DBSEXPIRE")."<br></font>";

	echo "<br>".$sd[2]."<br><br>";
	 if ($pr[35]!=="on") if (($daysleft>0)AND($daysleft<10)) trial ();
     if (($daysleft<1)AND($daysleft!=="unlimited")) expire ();
	 if ($sd[15]) autoexecsql ($sd[15],$sd[11],$timed);
	lprint ($comm);
	
}
