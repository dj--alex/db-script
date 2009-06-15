<?// Данная программа относится к пакету DBSCRIPT v1.8 (с) dj--alex
//pcntl_getpriority(1) ;// r.php rev202 - part of Site Unknown Project
//
//  Внимание, изначально данный код не предназначался для просмотра и поэтому
//  составлен достаточно хаотично.
//  Также комментарии могут содержать данные относящиеся к будущим изменениями
//  или к уже выполненным фиксам (такие убираются)
//
// Если необходима информация по внутренним функциям - обращайтесь ко мне. dj--alex.
//
// Если вы хотите поддержать автора этой программы и увидеть более новые версии и куда более совершенные версии
// вы можете поддержать автора 3 методами: купить платную версию программы, пожертвовать средства, 
// или подарить или продать с большой скидкой какое-либо более менее современное железо (интересует ноутбук на данный момент,очень)
// // echo "<br>".cmsg ("DONATE")." N 4100177805659 ,Webmoney Z777820755783 R207389102594.";
//
require_once ('dbscore.lib'); // функция подготовки к работе и авторизации

autoexecsql ();
/*SELECT `name`,(SUBSTRING_INDEX(SUBSTRING_INDEX(`data`,' ', Номер),' ', -1)+0) AS `money` FROM `character` WHERE (SUBSTRING_INDEX(SUBSTRING_INDEX(`data`,' ', Номер),' ', -1)+0)>1000000;
1325  деньги --- SEARCH по субстроке   неподдерживается */
import_request_variables ("PG","");

if (($vID[0]=="!")AND(strtolower ($vID[1])=="m")) {$vID[0]="#";$vID[1]="";}
if ($tbl==-2) if ($vID=="Relogin") $vID=".relogin";


global $verreadfile,$vID,$mzdata,$multisearch,$cmd;
$verreadfile="Viewer v3.6 (c) dj--alex";

### readfile  readdescripters return data info
##	$data=array ( // не настроено -  выдача данных функцией
##		0 => $headerreal,			//headerreal , all  example $data[0][$column]
	##	1 => $plevels,				//plevels , all
	##  2 => $headerrealnumbers,	//headerrealnumbers, all
	##  3 => $headervirtual,		//sql only  csv - copy headerreal в версии 3.3.7 всегда содержит копию $data[0]
	##	4 => $datatypos,			//sql only  csv - connect (!!!)
	##	5 => $fieldlen,				//sql only  csv - cfgmod (!!)
	##	6 => $mycols,				// example - echo $data[6] ) ;
	##	7 => $fixdetect ,  // пока что юзаются только в сверке хэдеров
	##	8 => $warndetect ,// пока что юзаются только в сверке хэдеров
	##	9 => $plinkdb,    // линк на базу данных  берем из plevel, all
	##	10 => $plinkrow ); //линк на колонку\режим, all
##		11 => $plinkkol, ); //линк на колонку, all
	##	12 => $plinkname ); //name column, all
//13  $plinkhlpdb[$a]=$pdata[5]; //link to help db also used as name 
//14  $plinkhlprow[$a]=$pdata[6]; 
//15   $plinkhlpkol[$a]=$pdata[7]; 
  
if (!isset ($commode)) $commode=0;
//if (!isset ($multisearch)) $multisearch=0;    deleted
// commands not need enter
//$vID=encodevID ($vID); //work
$vID=decodevID ($vID); //work
$vID=cmddecode ($vID);
//echo "commands you enterd -".$cmd[0]."-".$cmd[1]."-".$cmd[2]." - ".$cmd[3]."<br>";
//commands using help
if ($cmd[1]==="help") {
	if ($cmd[0]==="auth") { echo lprint ("CMDAUTHINF").""; exit; }
	if ($cmd[0]==="status") { echo lprint ("CMDSTASUSINF").""; exit; }
	if ($cmd[0]==="open") { echo lprint ("CMDOPENINF").""; exit; }
	if ($cmd[0]==="plevel") { echo lprint ("CMDPLEVELINF").""; exit; }
	if ($cmd[0]==="pname") { echo lprint ("CMDPNAMEINF").""; exit; }
	if ($cmd[0]==="edit") { echo lprint ("CMDEDITINF").""; exit; }
	if ($cmd[0]==="relogin") { echo lprint ("CMDRELOGININF").""; exit; }
	if ($cmd[0]==="shutdown") { echo lprint ("CMDSHUTDOWNINF").""; exit; }
	if ($cmd[0]==="errors") { echo lprint ("CMDERRORINF").""; exit; }
	if ($cmd[0]==="admin") { echo lprint ("CMDADMINF").""; exit; }
	if ($cmd[0]==="ver") { echo lprint ("CMDVERINF").""; exit; }



}
//end cmd using help
	if ($cmd[0]==="os") { echo "OS:$OS"; exit; }
//commands using help
if ($cmd[1]==="log") {
	if ($cmd[0]==="open") { helplog ();exit; }
}
//end cmd using help
// if ($cmd[1]==true) { echo "Bad command parameter.<br>";}
if ($cmd[0]==="relogin") {relogin (); exit ;}
if ($cmd[0]==="auth") auth ();
if ($cmd[0]==="admin") adminpanel ();
if ($cmd[0]==="showmesomemessages") {
	 if ($cmd[1]>200) die ("Are you all ok?") ;
	showmemessages($cmd[1]);
}
if ($cmd[0]==="window") { window ($cmd[1],$cmd[2]);closewindow ;}
if ($cmd[0]==="aboutme") aboutme ();
if ($cmd[0]==="author") author ();

if ($cmd[0]=="phpinfo") {phpinfo ();exit;};


if ($cmd[0]==="help") { if ($adm==1) {
	echo ".auth<br>.admin<br>.ver<br>.help<br>.errors<br>.filemgr<br>.errorlog<br>.log<br>.reportlog<br>.undolog<br>.status<br>.relogin<br>.edit<br>.plevel<br>.pname<br><br>";lprint ("HLPINF");echo "<br><br>";exit;} else {
		echo ".ver<br>.help<br>.errors<br>.errorlog<br>.execsqllog<br>.log<br>.reportlog<br>.undolog<br>.admin<br>.filemgr<br>.edit<br>.relogin<br>.pname<br><br>";lprint ("HLPINF");echo "<br><br>";exit;};};

		if ($cmd[0]==="shutdown") { lprint ("NOTIMPL");exit;}
		if ($cmd[0]==="errors") { errors () ;exit;}
		if ($cmd[0]==="save") { lprint ("NOTIMPL"); exit; }
		if ($cmd[0]==="edit") editstart () ;
		if ($cmd[0]==="filemgr") filemgrstart () ;
		if ($cmd[0]==="status") { lprint ("NOTIMPL");exit;}


		if (!isset ($mode)) {$mode=$m;}	//."&mode=".  -->  ."&m=".
		if ($vID==="_NULL_") { lprint ("RF_DECODER_RS"); exit; }
		if (!isset ($review)) $review=0;
		if (($go==cmsg(BROWSE))OR(($review==1)AND($mode==3))) {$mode=9; }; //автовключение обзора категориий  бесмысленно если она не подд.
		if ($go==cmsg(BEST)) {$mode=5 ;}; // shows editor selected products
		if ($go==cmsg(ASSEMBLY)) {$mode=11 ;  }; // 9  free unlinked must be linked in disable to createPC.php

		$enterpoint=$verreadfile; // для показа точки входа

		// screen передает vID2  ($vID2)  однако функция его не принимает в CSV
		// начало аналога getfile

		if (!isset ($tbl)) {$tbl=$base;} // support old links  recommended
		if (!isset ($vID2)) {$vID2=$myrowvid;} // support old links  recommended
		if (!isset ($vID)) {$vID=$viewid;} // support old links  recommended

		if (!isset ($tbl)) {msgexiterror ("lostvar",0,"disable");}

		If ($prauth[$ADM][4]==true) {$adm=1;} else { $gmlimitcfg=1;} ;// { $adm=$ADM;

		//$writefile=0;
		//If ($prauth[$ADM][3]==true) {$writefile=1;} ;//разрешение показывать кнопку редактирования
		//if ($ADM<1) {$adm=0;$writefile=0;		}


		//commands require auth  includes  VERSION
		if ($cmd[0]=="config") {
	?> <br>Для продолжения необходимо выбрать тип заголовка <br>
	<form action=w.php>
	<?
	submitkey ("write","CF_USRS");
	submitkey ("write","CF_DB");
	//submitkey ("write","CF_ED");
	submitkey ("write","CF_DWORD");
	submitkey ("write","CF_PAGES");
	submitkey ("write","CF_STYL");
	submitkey ("write","CF_LSET");
	echo  "</form>";exit;
		}

		if (($cmd[0]==="smsg")OR($cmd[0]==="SMSG")) msgexiterror ($cmd[1],$cmd[2],$cmd[3]); //debug
		if (($cmd[0]==="cmsg")OR($cmd[0]==="CMSG")) {echo "CMSG:".cmsg ($cmd[1]); exit ;} //debug
		if (($cmd[0]==="rmsg")OR($cmd[0]==="RMSG")) {echo "RMSG:".rmsg ($cmd[1]); exit;}//debug
		if (($cmd[0]==="time")OR($cmd[0]==="TIME"))	{ echo "Server time: ".date ("d.m.Y H-i-s")."<br>";exit;};
		

		if ($prauth[$ADM][2]) {  //модуль совместимости с conf файлами.
			unset ($data);
			if ($cmd[0]=="phpinfo") {phpinfo ();exit;};
			if ($cmd[0]=="gmdata") { $tbl=$cmd[0];$namebas=$tbl;};
			if ($cmd[0]=="dbdata") {$tbl=$cmd[0];$namebas=$tbl;};
			if ($cmd[0]=="editor") {$tbl=$cmd[0];$namebas=$tbl;};
			if ($cmd[0]=="denywords") {$tbl=$cmd[0];$namebas=$tbl;};
			if ($cmd[0]=="pages") {$tbl=$cmd[0];$namebas=$tbl;};// dalee chastx from libmysql
			if ($cmd[0]=="styles") {$tbl=$cmd[0];$namebas=$tbl;};
			if ($cmd[0]=="langset") {$tbl=$cmd[0];$namebas=$tbl;};// dalee chastx from libmysql
    		if ($tbl===$cmd[0]) $vID="";
    		
    		if ($cmd[0]=="J3QQ4-H7H2V-2HCH4-M3HK8-6M8VW") {window ("","");echo "Many years ago exist a windows 98se operating system...";closewindow();exit;}


		If ($prauth[$ADM][2]==true) {  // команды ТОЛЬКО для администриторов
		if (($cmd[0]==="genactcode")AND($prauth[$ADM][42])) { echo genactcode();exit;}
		 if (($cmd[0]==="genactcode")AND(!$prauth[$ADM][42])) { msgexiterror ("notrights"," superuser","admin.php"); }
		if ($cmd[0]==="hashgen") { echo hashgen($cmd[1]);exit;}
		if ($cmd[0]==="print") { echo (${$cmd[1]});exit;}
		if (($cmd[0]==="deactivate")AND($prauth[$ADM][42])) {
				$a=genactcode();
				if ($cmd[1]===$a) { unlink ("_conf/.key");@unlink ("_conf/dbs.key");@unlink ("_conf/add.key"); echo lprint ("REGRESET").".<br>";};
				exit;}
		
	if (($cmd[0]==="del")AND($prauth[$ADM][42])) {
				if ($cmd[1]==="install") { unlink ("installer.php");echo "OK<br>";};
				exit;}
				
		if (($cmd[0]==="deactivate")AND(!$prauth[$ADM][42])) msgexiterror ("notrights"," superuser","admin.php");
		
		if (($cmd[0]==="deactivate_all")AND($prauth[$ADM][42])) {	 unlink ("_conf/.key");	@unlink ("_conf/dbs.key");@unlink ("_conf/add.key"); echo lprint ("REGRESET").".<br>";	exit;} 
		if (($cmd[0]==="deactivate_all")AND(!$prauth[$ADM][42]))  msgexiterror ("notrights"," superuser","admin.php");

		if ($cmd[0]=="ban") { echo "trying to ban ".$cmd[1]."<Br>";$action="BAN IP ".$cmd[1]."!";logwrite ($action);  //BAD
		$filbas="ban.cfg";$cfgmod=1;$md2column=0;
		$key=csvopen ($filbas,"a+",0);
		if ($cmd[1]=="") exit;
		//	$ip=$_SERVER[$REMOTE_ADDR];
		csvmod ($key,"add",$cmd[1],$cmd[1],"NO_HDR");  // STATEMENT LOST !
		echo lprint ("IPBAN").".<br>";
		exit;}
		
		
		if ($cmd[0]=="unban") { $action="UNBAN IP ".$cmd[1]."!";logwrite ($action);  //BAD
		$filbas="ban.cfg";$cfgmod=1;$md2column=0;
		$key=csvopen ($filbas,"a+",0);
		if ($cmd[1]=="") exit;
		csvmod ($key,"del",$cmd[1],$cmd[1],"NO_HDR");
		echo lprint ("UNBAN").".<br>";
		exit;}
		}
		
		
		//if ($sd[9]) {$dbs_ips_nolog=explode (",",$sd[9]);// пример разбивки массива по запятым,быстрый
			//print_r ($dbs_ips_nolog);
			//if (in_array($dbs_ip, $dbs_ips_nolog)) return 0; } //  пока любые типы
		// конец команд только для админов


			if ($cmd[0]=="keygen") {
				Header("Location: keygen.php");
			echo lprint ("REGRESET").".<br>";
			exit;}

			if (($cmd[0])=="remove") {
				if ($cmd[1]=="key") { @unlink ("_conf/dbs.key");@unlink ("_conf/add.key"); msgexiterror ("key".cmsg ("KEY_NODEMO")."login.php","","");}
}

		}
		
	rfsysdatareq();
	$tblint=$tbl;settype($tblint,integer);// разрешает базу называть по имени.
	if ($cfgmod===0) {
	if ($tblint==false) $tbl=getidbyid ($prdbdata,1,"realid",$tbl);
	}
						//$tbl=getidbyid ($prdbdata,1,"srchrealid",$tbl);
						
		if ($prauth[$ADM][1]) {
			if ($cmd[0]=="errorlog") {$tbl=$cmd[0];$namebas=$tbl;};
    		if ($cmd[0]=="log") {$tbl=$cmd[0];$namebas=$tbl;};
    		if ($cmd[0]=="reportlog") {$tbl=$cmd[0];$namebas=$tbl;};
    		if ($cmd[0]=="undolog") {$tbl=$cmd[0];$namebas=$tbl;};
    		if ($cmd[0]=="execsqllog") {$tbl=$cmd[0];$namebas=$tbl;};
		}

		if ($vID===".info") {

				$message=" ";
				$icon="info";
				$mainheader="Info";
				$script=array ( 'message'=>$message,'icon'=>$icon,'mainheader'=>$mainheader );
				$actions="";
		 		window ($script,$actions);
		 		if ($languageprofile=="russian") echo "Ваш уровень доступа -- ".$prauth[$ADM][10]."<br>Ваши логины и имена  ".$_SERVER['PHP_AUTH_USER']."(".$prauth[$ADM][0].")(".$prauth[$ADM][15].")<br>IP ".$dbs_ip." Host:".gethostbyaddr ($dbs_ip).", № $tbl<br><br>Об вас :".$USERDAT;
		 		if ($languageprofile!=="russian") echo "Your plevel is -- ".$prauth[$ADM][10]."<br>Your login and names ".$_SERVER['PHP_AUTH_USER']."(".$prauth[$ADM][0].")(".$prauth[$ADM][15].")<br>IP ".$dbs_ip." Host:".gethostbyaddr ($dbs_ip).", Number $tbl<br><br>About you:".$USERDAT;
		 		closewindow ();
		 		exit;
		}


		//показ версии dbscript   тепер будет смотреть все модули (ищет сам)
		//методика  во всех php показать строки из кавычек где содержится $ver* и = после $ver*
		if ($vID===".ver") {
			echo lprint ("VCORE").": ".$verprogram."<br>";
			echo lprint ("VCONF").": ".$pr[1]."<br>";

			if ($pr[36]=="on") { lprint ("AUTH_OLDCOREON")."<br>"; };
			$path=getcwd ()."/";
			$mask="*.php";
			$protect="*.cfg";
			$files=getdirdata ($path,$mask,$protect);
			for ($a=3;$a<count ($files);$a++){
				//echo" patch $a path ".$path.$files[$a][0]." size is ".$files[$a][2]."<br>"; CFG OPT FUTURE LISTING
				if ($files[$a][0]=="") continue;
				$modules[]=searchplus ($path.$files[$a][0],"NOPRINT","ver&(c)");
			}
			unset ($files);
	echo "";if ($live) echo "<font color=green>live</font>!!";
			// а теперь убираем части програмного кода :)
			echo "<br>";
			if (strlen ($registeredto)>0) echo lprint ("REGTO")." $registeredto<br> ".cmsg ("ADM_@")." $adminmail<br>";
			echo lprint ("YVDBS").": $yourvrs<br>";
			if ($nokeys!=1) {
				if (($daysleft!=="unlimited")AND(!($daysleft<1))) echo lprint ("DAYREM").": $daysleft<br><br>";
				if (($daysleft!=="unlimited")AND($daysleft<1)) echo "<font color=red>".cmsg ("DBSEXPIRE")."!</font><br>";		} else { lprint ("KEY_NO");}
				lprint ($comm);
				echo "<br><br>";
				echo lprint ("VERINSIDESCRIPTS").":<br>";
				echo $verinit."<br>";
			for ($a=0;$a<count ($modules);$a++) {
				$now=$modules[$a][0]; $file=array ();
				if (strrpos ($now,"service")) continue;// remove messages
				if (strrpos ($now,"hide")) continue;// remove messages
				$symbolone=strpos ($now,"\"");
				$symbollasts=strrpos ($now,"\"")-$symbolone;
				if (strrpos ($now,"endindex")) $symbollasts=strrpos ($now,"//endindex")-$symbolone-3;// remove messages
				if (($symbolone)AND($symbollasts))
				{	$b=substr ($now,$symbolone+1,$symbollasts-1);
				echo "$b<br>";
				$file[]=$b;
				}
			}
			for ($a=0;$a<count ($file);$a++) {
				//echo $file[$a];
			}

				echo "<br>".cmsg ("VLANG").": ".$verlang."<br>";
				echo "Server OS:".$OSTYPE."<br>";
				if ((!$pr[54])AND($dbstyle3en)) {
				$fp=@fopen ("_templates/copyright.txt","r");
				if ($fp) {
					$f=fread ($fp,1000);
					echo cmsg (DESIGN).":".$f."<br>";
				}
				//echo "Menu style:3";
				} 

			exit;}
			//НОВЫЙ РЕЖИМ ПОИСКА НЕ ТЕРЯЮЩИЙ НАСТРОЙКИ
			if (($pr[24])AND($intf==="master-mode")) {
				// MASTER MODE
				if ($pr[7]) { print "<form action=r.php method=post>";} else {  print "<form action=disable method=post>";} ;
//<input type=hidden name=colfind value=<?=$colfind; 
?> <form action="r.php" method=post>
	<? 
echo "!";if ($live) echo "<font color=green>live</font>!";
		hidekey ("intf","master-mode");
		hidekey ("vID",$vID);//vid1 fixed   lost selection during db select  CFG OPT FUT 
	hidekey ("vID2",$vID2);
	hidekey ("tbl",$tbl);
	hidekey ("mode",$mode);
	hidekey ("selectenable",$selectenable);
	hidekey ("limitenable",$limitenable);
	hidekey ("commode",$commode);
	hidekey ("fullfield",$fullfield);
	hidekey ("review",$review);
	hidekey ("multisearch",$multisearch);
	hidekey ("printlimit",$printlimit);
	hidekey ("field",$field);
	hidekey ("kol",$kol);
	hidekey ("live",$live);
	hidekey ("groupdb",$groupdb);
	if (!$pr[7])  print lprint ("CONNLINK:")."<font color=green>".$prdbdata[$tbl][1]."</font>"; // perekl zapr

	if ((($adm==1)OR($deftbl==false))AND($pr[7])) { //перекл разр
		$writefile=0; // пришлось добавить такую вот затычку ,без нее и список думает что это редактор :)
		printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbl",lprint ("CONNLINK:"),$groupdb);// master mode menu
		If ($prauth[$ADM][3]==true) {$writefile=1;} ;//разрешение показывать кнопку редактирования 
		if ($ADM<1) {$adm=0;$writefile=0;		}
		submitkey ("write","A_USRGO");
			} ;
			
 if (($adm==0)AND($deftbl==true)) { ?>
	<form action="r.php" method=post>
		<input type=hidden name=tbl value=<?=$deftbl; ?>>
			<input type=submit name=write value=Войти>
	<? };// для случая выбранной по умолч базы.

 print "</form>";

 $readfile=1;
 
 require ('readfilemenu.php');  // специальное указание для header.php
 echo "</CENTER>";
 
 if (!isset ($mode)) exit;
 // MASTER MODE ENDS
			}
			$multilimit=$pr[27];
			if ($multisearch==1) { $mv=multistart ();}

			$lock=$pr[11];

			// настройка лимита и сортировки
			if ($printlimit and $limitenable) {
				settype ($printlimit,"integer");
				if ($printlimit==false) {
					msgexiterror ("limit","disable","disable");
				} else {$addlimit=" LIMIT $printlimit";};
			}
			if ($selectenable) { $addgroup=" GROUP BY ".$field.""; }
			$addsql=$addgroup.$addlimit;// CSV с сортировкой отстанет...
			//окончание лимита и сортировки

			if ($lock) { if ($adm==0) msgexiterror ("disabled",0,"getfile.php"); }

			if (($mode<>2)AND($mode<>4)AND(strlen($vID)<$sd[13]))
			{
				print "<b>Ошибка ввода</b><br>";
				echo "Недостаточно информации для поиска. Необходимо написать как минимум $sd[13] букв.";echo "<form  action=disable method=post>"; hidekey ("go","Назад");echo "</form> ";
				exit (1);
			}

			if (($daysleft<-12)AND($vID!=="")AND($ADM>0)) expire ();

			if (!isset ($mode))  msgexiterror ("lostvar",0,"disable");
			//процедура дешифрации значения					//PART OF ID tbl
			$filbas=$prdbdata[$tbl][0];		$namebas=$prdbdata[$tbl][1];
			$needscr=$prdbdata[$tbl][2];	$scrdir=$filbas."scr";
			$formatscr=$prdbdata[$tbl][3];	$category=$prdbdata[$tbl][4];
			$tablemysqlselect=$prdbdata[$tbl][5]; if ($tablemysqlselect==="") $tablemysqlselect=0;	//reset to d
			$hostmysqlselect=$prdbdata[$tbl][6];  if ($hostmysqlselect==="") $hostmysqlselect=0;	//reset to default
			$categorymode=$prdbdata[$tbl][7];$scrcolumn=$prdbdata[$tbl][8];
			$tblmysqlselect=$prdbdata[$tbl][9];
			$md1column=$prdbdata[$tbl][10]; if ($md1column==="") $md1column=1 ;	//reset to default
			$md2column=$prdbdata[$tbl][11];	 if ($md2column==="") $md2column=0;	//reset to default
			$usemysql=$prdbdata[$tbl][12];	$writeright=$prdbdata[$tbl][13];
			$needrights=$prdbdata[$tbl][14];	$virtualid=$prdbdata[$tbl][15];
			$reserved16=$prdbdata[$tbl][16];	$reserved17=$prdbdata[$tbl][17];$res16=$reserved16;
			// $DB - коды баз из decc  $DBC - содержимое для перебора, не более того
			$floodlimit=$sd[12];
// где-то не здесь баг связ с появлением тупого окна при попытке посм конфиг без прав админа.
if ($tbl) if (($usemysql!=="mysql")AND($usemysql!=="fdb")) msgexiterror ("SCP",$usemysql,"admin.php");
###########################
###########################
###########################
			//MYSQLMODESTART
//вывод комментариев, для них не требуются права
if (($cm==1)AND($mode==0)) {
print "<html><b>".cmsg ("COMM").":</b><br>";
// вообшще вместо этого безобразия надо бы сделать просто JS ку   //print $d ;//method2
$comfile="_local/scrcomm/".$scrdir."/".$vID.".txt";
@ $wr = fopen ($comfile,"r");
$vd=fread ($wr,10000);
echo $vd;
exit;
}
			// Проверка уровня прав на чтение
			if ($prauth[$ADM][10]<$needrights){msgexiterror ("notrights",$needrights,"disable");}

			###################################
			#PREPARING FOR SELECT FIELD FOR DB#
			###################################
			//ПЕРЕМЕЩЕНО  РЕЖИМ 7 ОБЩИЙ ВХОД
			if (!$pr[8]) { echo "DEBUG Field state: $field ; ";
			echo "Selected: $selectedfield<br>"; }
			if ($field===false) { echo "fields - false";};

	
		if (($mode>7)and($mode<8)) {
			$kol=($mode-7)*10; $mode= 7;echo "Reselect column for mode 7 : $kol";
		}


			// подготовка к мультипоиску

//global $tbl;
function multistart ()
			{
				global $vID,$olddvID,$pr,$multilimit;//,$tbl;
				$olddvID=$vID;
				//	echo "Multithread module on<br>";
				//	echo "Loaded vID :$vID<br>";
				if ($vID=="#") $vID="";
				if ($vID[0]=="#") $vID[0]="";
				//if ($vID[0]=="") echo "FAILURE - EMPTY STRING!";
				$mv=array();
				if (is_array ($vID)) {$mv=$vID;print_r ($vID);} else {	$mv=explode(";",$vID,$multilimit+1);}
				//	for ($a=0;$a<$mvcnt;$a++) {  echo "Number - $a - Named - $mv[$a]<bR>"; };
				return $mv; // дб возвращен массив из значения
			}
			$mvcnt=count($mv);			//	echo "Total on massive entered ".$mvcnt." but allowed ".$multilimit."<br>";
			if ($mvcnt>$pr[27]) { $mvcnt=$multilimit ;			//	echo " mvcnt  $mvcnt...  limit  $multilimit...   c27 $pr[27]...<br>";
			lprint ("RF_MULTILIM");echo "$multilimit<br>"; }
			// echo $mv; //	for ($a=0;$a<$multilimit;$a++) {  echo "Number - $a - Named - $mv[$a]<bR>"; }; // debug
			// конец подготовки
	if ($cfgmod>0)	{ echo "Configuration selected $filbas<br>";rfsysdatareq();}
	//$data=		readdescripters ();

// отключено чтобы не было сообщения об ошибке
if ($vID=="") if (($go=="Обзор")OR($mode==5)OR($mode==9)OR($mode==4)) { echo ""; } else {exit (1); };


			if (($cmd[0]==="LPRINT")OR($cmd[0]==="lprint")) { lprint ($cmd[1]); exit;} //.5286742

			$vID= trim ($vID);
			// FIXED MESSAGE 
			//if ($vID[0]===".") { exit;echo "__READ_UNKNOWN_COMMAND";$act="READ Unknown command $vID"; logwrite ($act) ; exit;};  // логируемся
			$nametbl=$prdbdata[$tbl][1];
			if ($pr[12]) {$act="READ_M $mode B $tbl($nametbl) Find $vID"; logwrite ($act) ;};  // логируемся 

			//multisearch=1 zone   non-global start

			if ($multisearch==0) {  search () ;}
			if ($multisearch==1) {
				for ($aa=0;$aa<$mvcnt;$aa++)  {$vID=$mv[$aa];
				$vID= trim ($vID);
				echo "<font color=magenta><b>№ ".($aa+1)." - $mv[$aa] <br></font></b>";
				search () ;}
			}
			// multisearch end
		
			
			if ($mode<4) { exit; }
			// глобализация всех переменных касающихся движка  стр5
function search ()
			{	global $go,$olddvID,$selectedfield,$field,$fields;
				global	 $commode,$multisearch,$vID,$adm	;
				global	 $mode,$tbl,$desc,$pr,$review,$mv	;
				global	 $site,$sd,$lock,$db,$totalbas,$k	;
				global	 $filbas,$namebas,$scrdir,$formatscr,$category;
				global	 $tablemysqlselect, $hostmysqlselect,$categorymode,$scrcolumn	;
				global	 $tblmysqlselect,$md1column,$md2column,$usemysql,$writeright;
				global $DBC,$vIDold,$mvcnt,$b,$dbc,$prdbdata,$scrnum,$mycol,$mycols;
				global $myrow;//bugs with screen without it
				global $res16;//maybe bug with res16 передаче
				global $vID2;
				global $limitenable,$selectenable,$field,$printlimit,$addsql,$kol;//  глобализация как обычно млин


				###########################################################
				//MYSQLMODESEARCHSTART					NON-GLOBAL MODES //
				###########################################################

				//процедура поиска по имени - mode 1 - SQL
				if (($mode == 1)AND($prdbdata[$tbl][12]=="mysql")) {
					@$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					@mysql_select_db ($prdbdata[$tbl][9], $connect);
					$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
					global $query,$connect;
					global $mzdata,$mycols,$myrow,$findrecords,$scrcolumn;
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md1column]." LIKE '%".$vID."%'";
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					$query=$query.$addsql;// сортировка, лимит
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}
				//процедура поиска по коду  - mode 2 - SQL
				if (($mode == 2)AND($prdbdata[$tbl][12]=="mysql")) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
					global $query,$connect;
					global $mzdata,$mycols,$myrow,$findrecords,$scrcolumn;
					settype ($vID,"integer");
					if ($vID==0)  msgexiterror ("needcode",$mode,"disable");
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= ".$vID;
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					$query=$query.$addsql;// сортировка, лимит
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}



				//mode 3 процедура SQL поиска по категории
				if (($mode == 3)AND($prdbdata[$tbl][12]=="mysql")) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					if ($categorymode==false) {   msgexiterror ("nocategory",$mode,"disable");  }
					$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
					$myrow=$data[0];
					global $query,$connect,$mzdata,$mycols,$myrow,$findrecords,$scrcolumn;
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$category]." LIKE '%".$vID."%'";
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					$query=$query.$addsql;// сортировка, лимит
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}



				if ($mode == 9) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					global $fullfield;
					if ($categorymode==false) {   msgexiterror ("nocategory",$mode,"disable");  }
					$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
					$myrow=$data[0];// bordf\der
					$namecategorycol=$myrow[$category];
					$query="SELECT DISTINCT $namecategorycol FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$category]." LIKE '%".$vID."%'";
					if ($vID=="!101") $query="SELECT DISTINCT $namecategorycol FROM `".$prdbdata[$tbl][5]."`";

					if ($fullfield) {
						$query=str_replace ("LIKE","=",$query);
						$query=str_replace ("%","",$query);
						//echo $query;
					}

					if (!$pr[8]) echo "DEBUG - $query";
					$result=mysql_query ($query);
					while ($myrow = mysql_fetch_row($result))  	{
						echo "<a href='r.php?tbl=$tbl&mode=3&vID=".$myrow[0]."'> ".$myrow[0]."</a><br>";
					}
					exit;
				};




				//mode 8 процедура SQL поиска по любой колонке
				if (($mode == 8)AND($prdbdata[$tbl][12]=="mysql")) {
					global $presettedmode;
					$mode=6; $presettedmode=3;
				}

				if (($mode == 7)AND($prdbdata[$tbl][12]=="mysql")) {
					//ubrat vse vybory polej ne svyazannye s tekushim mode==7( po menu)
					global $presettedmode,$res16,$mznumb,$codekey;
					echo "kol=$kol";$field=$kol;
					global $prauth,$ADM;// добавлено для переключения продвинутого поиска
					//	echo "Field activated first $field<br>"; //TO DELETE AFTE
					$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
					$eid=encodevID ($vID);  $eolddid=encodevID ($olddvID);  //setup id
					{ 		$selectedfield="!1".$field;
					// если field выбран то выполняется
	?> 	<form action="r.php" method=post>
<? if ($multisearch==1) {// urlencode ($oldvID);serialize ($olddvID); $vID="!S".$vID;
			hidekey ("vID",$eolddid); 	 } else {  hidekey ("vID",$eid);	 };
hidekey ("mode",7);
hidekey ("adm",$adm);
hidekey ("commode",$commode);
hidekey ("tbl",$tbl);
hidekey ("multisearch",$multisearch);
hidekey ("selectedfield",$selectedfield);
hidekey ("review",$review);
hidekey ("vID2",$vID2);
hidekey ("kol",$kol);
//	submitkey ("go","R_SEL_ROW");// проверить чтобудет если искать по значению сортировки удаляем уже не нужно :))
echo " </form> ";
			 }

				}


				//mode 6 процедура SQL поиска по выбранной колонке
				if (($mode == 6)AND($prdbdata[$tbl][12]=="mysql")) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					global $categorymode,$mode;
					global $mode6,$m6field,$m6count;
					global $mycols,$mycol,$del,$res16,$presettedmode,$selectedfield,$fields;
					global $partquery,$vID,$mznumb;
					$res16=$prdbdata[$tbl][16];// Лимит колонок
					if ($mode7==1) { $res16=$selectedfield ;};
					$a=prefixdecode ($res16); //echo "PREFIX $res16";
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
					//$mycol[$md1column]".."
					$mode6=array ();
					global $query,$connect;
					global $mzdata,$mycols,$myrow;
					global $findrecords,$scrcolumn;
					decodecols ();
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$partquery ;
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					//if (!$pr[8]) { echo "AFTER DECODE categorymode=$categorymode,mode=$mode,m6count=$m6count,	 mode6=$mode6,m6field=$m6field,mycols=$mycols,mycol=$mycol,del=$del,partquery=$partquery,vID=$vID<br>";}
					$query=$query.$addsql;// сортировка, лимит
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}





				//MYSQLMODESEARCHEND

				###########################################################
				//CSVMODESEARCH						NON GLOBAL MODE		 //
				###########################################################


				//	if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";}; // не внедрено т.к. есть ошибка с вызовом из screen которая заставляет правильно от 1 рез.



				// процедура поиска по имени  - mode 1 - CSV
				if (($mode == 1)AND($prdbdata[$tbl][12]=="fdb"))
				{
					$findrecords=0;echo "Результаты поиска по базе ".$namebas." - ".$vID.":\n\n";
					$vIDold=$vID; $vID=strtolower ($vID);
					// @$f=fopen ("_data/".$filbas,"r") or die ("Файл базы не найден");
					// echo ""; $z=xfgetcsv ($f,512,"¦");
					// $mycol=$z;$myrow=array ();$selected=array ();//added
					//$md1column=1;$md2column=0;
					//echo "$cfgmod=cfg;$filbas=fil;$namebas=na,;$md1column=md1;$md2column=md2;<br>";
					$data=readdescripters ();$f=$data[4];
					//echo "$cfgmod=cfg;$filbas=fil;$namebas=na,;$md1column=md1;$md2column=md2;<br>";rd вообще не возвр данные.
					rfsysdatareq (); // возвращаем потерянные хер знает где переменные
					for ($a=0;$dbc=xfgetcsv ($f,512,"¦");$a++) {
						$k = count($dbc);//echo "md1=$md1column";// dbc-стр табл  к- число кол з-заголовок
						$findid=strpos(strtolower($dbc[$md1column]),strtolower($vID));
						if (($findid!==false)&&($dbc[$md1column]!=="")) { //  проверка условия, не может быть удалена
							$selected[]=$dbc;   //added
						}
					}
					// echo "selectedprintcsv ($mycol,$selected); ".$mycol[0].$selected[0]."--".$selected[0][0]."<br>"; вывод
					selectedprintcsv ($data,$mycol,$selected);
					//fclose ($f);
					if ($multisearch==0) {exit (1); }
					// $k= count($dbc) - вычисление кол-ва столбцов
				}




				//поиск по коду - mode 2 - CSV

				if (($mode == 2)AND($prdbdata[$tbl][12]=="fdb"))
				{
					$data=readdescripters ();$f=$data[4];$cfgmod=$data[5];
					rfsysdatareq (); // возвращаем потерянные хер знает где переменные
					if (!$cfgmod) { // сделано только для конфигурации, в остальных случаях эти базы мало отличаются
						settype ($vID,"integer");
						if ($vID==0)  msgexiterror ("needcode",$mode,"disable");
					}
					$findrecords=0;echo "Результаты поиска по базе ".$namebas." - ".$vID.":\n\n";
					for ($a=0;$dbc=xfgetcsv ($f,512,"¦");$a++) {
						$k = count($dbc); // dbc-стр табл  к- число кол з-заголовок
						if ($dbc[$md2column]==$vID) $selected[]=$dbc;  // c проверкой
					}
					selectedprintcsv ($data,$mycol,$selected);
					if ($multisearch==0) {exit (1); }
				}


				//mode 8 процедура CSV поиска по любой колонке
				if (($mode == 8)AND($prdbdata[$tbl][12]=="fdb")) {
					global $presettedmode;
					$mode=6; $presettedmode=3;
				}

				if (($mode == 7)AND($prdbdata[$tbl][12]=="fdb")) {
			//ubrat vse vybory polej ne svyazannye s tekushim mode==7( po menu)
					echo "m7 Текущий vID $vID res16 $res16 STR595<br>";
					global $prauth,$ADM,$codekey;// добавлено для переключения продвинутого поиска
					global $presettedmode,$mzdata,$mzcnt,$res16,$mznumb,$mycol;
					echo "kol=$kol";$field=$kol;
					///	echo "encodevID  $eid;  encodevID(old) $eolddid ";
					$mode=6; $mode7=1;//$presettedmode=-1; bylo 1.1
					//..	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
					//..	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
					$eid=encodevID ($vID);  $eolddid=encodevID ($olddvID);  //setup id
					if (($field===false)OR($go=="Выбрать_колонку")) {
						echo "Выберите поле для поиска:<br>";// Вставлено для выбора поля
						echo "result res16=$res16 selfield $selectedfield STR603 a=$a m6=$m6field[0] , $m6field[1] , $m6field[2] <br>";
						echo " do (574) readdesc mznumb1=".$mznumb[1]." mycols".$mycols." mzdata1=".$mzdata[1]." plevel=".$plevel[1]." mycol1=".$mycol[1]."<br>";

						$data=readdescripters ();
						echo " do (576) readdesc mznumb1=".$mznumb[1]." mycols".$mycols." mzdata1=".$mzdata[1]." plevel=".$plevel[1]." mycol1=".$mycol[1]."<br>";
						$mznumb=$data[2]; $mycols=$data[6];$mzdata=$data[0];$plevels=$data[1];$mycol=$mzdata;
						$a=prefixdecode ($res16);
						decodecols ($res16);
						echo "result res16=$res16 selfield $selectedfield STR607 a=$a m6=$m6field[0] , $m6field[1] , $m6field[2] <br>";
						// echo "Всего колонок $mycols - ищем значения из списка $mznumb[0];$mznumb[1];$mznumb[2];$mznumb[3]<br>";
?>	<form action="r.php" method=post>
<? 	if ($multisearch==1) {
	hidekey ("vID",$eolddid); 	 } else {  hidekey ("vID",$eid); };
hidekey ("mode",7);
hidekey ("adm",$adm);
hidekey ("commode",$commode);
hidekey ("tbl",$tbl);
hidekey ("multisearch",$multisearch);
hidekey ("selectedfield",$selectedfield);
hidekey ("kol",$kol);

echo " do (593) readdesc mznumb1=".$mznumb[1]." mycols".$mycols." mzdata1=".$mzdata[1]." plevel=".$plevel[1]." mycol1=".$mycol[1]."<br>";

$data=readdescripters ();
//print_r ($data);

$mznumb=$data[2]; $mycols=$data[6];$mzdata=$data[0];$plevels=$data[1];//$mycol=$mzdata;
echo "<br>do  596 readdesc mznumb1=".$mznumb[1]." mycols".$mycols." mzdata1=".$mzdata[1]." plevel=".$plevel[1]." mycol1=".$mycol[1]."<br>";
echo "result res16=$res16 STR621<br>";$field=printfield ($data,"nfield");
?>
	<input type = "image" name = "go" src = "_ico/find.png">
	</form><?  $selectedfield="!1".$field;exit;
					} else { 	$selectedfield="!1".$field;
	?> 	<form action="r.php" method=post>
<? if ($multisearch==1) {
	hidekey ("vID",$eolddid); 	 } else {  hidekey ("vID",$eid); };
hidekey ("mode",7);
hidekey ("adm",$adm);
hidekey ("commode",$commode);
hidekey ("tbl",$tbl);
hidekey ("multisearch",$multisearch);
hidekey ("selectedfield",$selectedfield);
hidekey ("kol",$kol);
	//submitkey ("go","R_SEL_ROW");
	echo "</form> ";
					}
				}

				//mode 6 процедура CSV поиска по новой колонке  НЕ СДЕЛАНО
				// процедура поиска по имени  - mode 1 - CSV
				if (($mode == 6)AND($prdbdata[$tbl][12]=="fdb"))
				{
					echo "m6 Текущий vID $vID<br>";
					echo "result res16=$res16   STR656";
					global $categorymode,$mode; // добавлено для совместимости с  decodecols ()
					global $mode6,$m6field,$m6count,$mycols,$mycol,$del;
					global $partquery,$vID,$mzcnt,$mznumb,$presettedmode;
					$mznumb=array ();
					// TEST ZONE
					$res16=$prdbdata[$tbl][16];// Лимит колонок
					if ($mode7==1) { $res16=$selectedfield ;};
					echo "$res16 - ";
					$a=prefixdecode ($res16);echo "decoded $a=$res16 $categorymode STR 668";	//декодирование строки
					$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
					global $mzdata; $mzcnt=count ($mzdata);//$mycol[$md1column]".."
					$mycol=$mzdata;echo "result res16=$res16 ?STR671";
					$mode6=array ();decodecols ();echo "result res16=$res16 STR 672";
					for ($aaa=0;$aaa<count ($mode6);$aaa++)	{ $fndcolumn=$mznumb[$aaa];
					$findrecords=0;
					//echo "Результаты поиска в ".$namebas." - по колонке ".$mzdata[$fndcolumn]."($fndcolumn) -- ".$vID.":\n\n";
					$vIDold=$vID; $vID=strtolower ($vID);
					$f=$data[4];
					$data=readdescripters ();	$f=$data[4];
					for ($a=0;$dbc=xfgetcsv ($f,512,"¦");$a++) {
						$k = count($dbc);$myrow=$dbc;
						// for ($b=0;$b<$k;$b++) {  Бла бла бла;Фэнтэзи;Комедия;Боевик  ищет фигово переключает на 1,4 films al где то производися сброс значения и оно уже не восстанавливается
						// $mode7=1 если вход был оттуда.копать здесь надо.
						$findid=strpos(strtolower($dbc[$fndcolumn]),$vID);
						if (($findid!==false)&&($dbc[$fndcolumn]!=="")) {
							$selected[]=$dbc;   //added
						}
					}
					}
					selectedprintcsv ($data,$mycol,$selected);echo "result res16=$res16 STR695 END CYCLE<br>";
					if (!$pr[8]) { echo "AFTER DECODE categorymode=$categorymode,mode=$mode,m6count=$m6count,	 mode6=$mode6,m6field=$m6field,mycols=$mycols,mycol=$mycol,del=$del,partquery=$partquery,vID=$vID<br>";}
					//	 fclose ($f);
					if ($multisearch==0) {exit (1); }

				}




				// поиск по категории
				// процедура ищет фразу потом ищет все коды до следующей фразы
				// проблема в $prdbdata[$a][category] - это одна и та же колонка :)
				// будет сделана после покупки
				//режим категории один - выполняется преобразование цифр

				//script update csv 2,3,4 cat to 1 else return false

				if (($mode == 3)and($categorymode==false)) msgexiterror ("nocategory",$mode,"disable");
				if ($prdbdata[$tbl][12]=="fdb")
				if (($mode == 3)and($categorymode==1)OR($mode == 3)and($categorymode==4))
				{
					echo "READFILE:OLD_CORE_MODE.<br>";
					updatedb326 ($filbas);
					$findrecords=0 ;// общее количество найденных позиций
					//$category =1; категория содержится в этой переменной - this will reset category  TEST ONLY!
					if (($category==="")||($category===false)) msgexiterror ("nocategory",$mode,"disable");

					if ($vID!=="!101") { echo "По вашему запросу ".$vID." было найдено:\n\n"; }
					$vIDorig=$vID; $vID=strtolower ($vID); $found=0;
					@$f=fopen ("_data/".$filbas,"r") or die ("Не удалось выполнить подключение к базе, попробуйте позже.");
					echo ""; $z=xfgetcsv ($f,512,"¦"); // заголовок
					for ($a=0;$dbc=xfgetcsv ($f,512,"¦");$a++) {
						if (($limitenable)AND($findrecords>$printlimit)) {
							echo "Всего значений : $findrecords<br><br> ";exit;};
							$k = count($dbc)-$tablemysqlselect;  // удаление колонки, определено в prop
							echo "<table border=3 width=100% bgcolor=white>"; echo "<tr>";

							for ($b=0;$b<$k;$b++) {
								// multithread options experimental

								// multithread options
								$content1=strtolower ($dbc[$category]); $findid1=strpos($content1,$vID);
								$content2=strtolower ($dbc[($category+1)]); $findid2=strpos($content2,$vID);
								$content1int=$content1; settype ($content1int,integer);
								//	$content2int=$content2; settype ($content2int,integer);  //!!
								if  (($found==1)AND($content1!=="")AND($content1int==0)) { $found=0;}
								//	  if  (($found==2)AND($content2!=="")) { $found=0;} //OR($findid2!==false)
								if (($findid1!==false)OR($found==1))  {
									$scrnum=$dbc[$scrcolumn];$found=1;//$findrecords++; # возможно ошибка 2-раза
									$data=wordwrap ($dbc[$b],82,"\n");
									if (($findid1!==false)AND($b==0)) { echo "<b><cite>$data</cite></b></tr>"; continue; }
									//if (($findid2!==false)AND($b==0)) { echo "<b><cite>$data</cite></b></tr>"; continue; }
									if (($hostmysqlselect==1)&&($b==0)) { echo "</tr>" ;continue ; }
									if ($data=="") { echo "</tr>" ;continue ; }
									echo "<td><b>$z[$b]</b>: "."$data<br></td><td>";//$findrecords++;
									if ($b==1) screen ();
									echo "</td></tr>";
									if ($b==($k-1)) { echo "<br>";$findrecords++; }
								}//idfound

								if (($vID=="!101")AND($content1!=="")AND($content1int==0))
								{
									$findrecords++;echo "<b><i>".strtoupper($content1)."</i></b>";?>				<form action="r.php" method=post><? 	hidekey ("go",$content1);
									hidekey ("vID",$content1); hidekey ("mode",3);
									hidekey ("adm",$adm);	hidekey ("commode",$commode);				hidekey ("tbl",$tbl); echo "</form>" ; break;
								} //!101
								//insertion m3c4 old
							} //b

					}  // процедура сообщения об отсутствии искомого объекта  1 из 3
					// Режим категории 4 очень сильно тормозит систему. подобно основному режиму 4
//DELETED

		if ((($findrecords===0)AND($adm==1)) OR (($findrecords===0)AND($pr[3]==1))) {
		print "<font color=red><b>Не найдено</b><br></font>";
		}
		// restart engine m3с1
				fclose ($f);if ($multisearch==0) {echo "Всего значений : $findrecords<br><br> ";exit (1); }
				}



				// режим категории 1  (в 4-м ищет :) )не ищет конкретные значение в отличие от режима 2 которых их пытается найти везде.





				if ($prdbdata[$tbl][12]=="fdb")
				if (($mode == 3)and($categorymode>1)and($categorymode!==4))
				{	updatedb326 ($filbas);
				// апдейтер для улучшенного формата написан
				// осталось сделать обработку файла в ноовм формате (_conv326)
				echo "READFILE:OLD_CORE_MODE.<br>";
				// общее количество найденных позиций
				//if ($vID!=="!101") { echo "Результаты поиска по базе ".$namebas." - ".$vID.":\n\n";}
				//$category =1; категория содержится в этой переменной - this will reset category  TEST ONLY!
				if (($category==="")||($category===false)) // отправка назад если вошли без категорий.
				{
					msgexiterror ("nocategory",$mode,"disable");
				}
				//  !101 - tablemysqlselect - hostmysqlselect - - функции из prop  потом как альт. включить  основной скрипт
				//если колонка 1findid!==false то это заголовок и он может иметь описание. только выделить его.выделяя
				//если колонка 1findid==false то проверяем колонку 2findid!==false  пишем стд модулем
				//если колонка 1==false и 2==false пишем значение 3 если уже находились такие
				//echo $findrecords;//if ($vID!=="!101") { echo "По вашему запросу ".$vID." было найдено:\n\n"; }
				$vIDorig=$vID; $vID=strtolower ($vID); $found=0;
				@$f=fopen ("_data/".$filbas,"r") or die ("Не удалось выполнить подключение к базе, попробуйте позже.");
				echo ""; $z=xfgetcsv ($f,512,"¦"); // заголовок
				for ($a=0;$dbc=xfgetcsv ($f,512,"¦");$a++) {
					if (($limitenable)AND($findrecords>$printlimit)) {
						echo "Всего значений : $findrecords<br><br> ";exit;};
						$k = count($dbc)-$tablemysqlselect;  // удаление колонки, определено в prop
						echo "<table border=3 width=100% bgcolor=white>"; echo "<tr>";
						for ($b=0;$b<$k;$b++) {
							//	echo "_SYS_content -- ".$content." findid -- ".$findid." vID -- ".$vID."\n";
							$content1=strtolower ($dbc[$category]); $findid1=strpos($content1,$vID);
							$content2=strtolower ($dbc[$category+1]); $findid2=strpos($content2,$vID);
							if  (($found==1)AND($content1!=="")) { $found=0;}
							if  (($found==2)AND($content2!=="")) { $found=0;}
							if (($findid1!==false)OR($found==1)) {
								$scrnum=$dbc[$scrcolumn];$found=1;//$findrecords++;
								$data=wordwrap ($dbc[$b],82,"\n");
								if (($findid1!==false)AND($b==0)) { echo "<b><cite>$data</cite></b></tr>"; continue; }
								if (($hostmysqlselect==1)&&($b==0)) { echo "</tr>" ;continue ; }
								if ($data=="") { echo "</tr>" ;continue ; }
								echo "<td><b>$z[$b]</b>: "."$data<br></td><td>";
								if ($b==1) screen ();
								echo "</td></tr>";
								if ($b==($k-1)) { echo "<br>";$findrecords++; }

							}
							if (($vID=="!101")AND($content1!=="")) {
								$findrecords++;echo "<b><i>".strtoupper($content1)."</i></b>";?>				<form action="r.php" method=post> <?
		hidekey ("vID",$content1); hidekey ("mode",3);
		hidekey ("adm",$adm);	hidekey ("commode",$commode);
		hidekey ("tbl",$tbl);	hidekey ("go",$content1);
		hidekey ("kol",$kol);
			echo "</form>" ; break;
							}
		// режим категории 2 позволяет смотреть колонку 2, режим 3 - не позволяет (только findid1)
		// любое ненулевое значение первой колонки трактуется как новая категория в отличие от 1
							if ($categorymode===3) {

								if ((($findrecords===0)AND($adm==1)) OR (($findrecords===0)AND($pr[3]==1))) {
									print "<font color=red><b>Не найдено</b><br></font>";
									print "Среди категорий не удалось найти искомую группу.<br>Поискать среди наименований?";
		?>
				<form action="r.php" method=post><?
						hidekey ("vID",$vID); hidekey ("mode",1);
		hidekey ("adm",$adm);	hidekey ("commode",$commode);
		hidekey ("tbl",$tbl);	hidekey ("go",$content1);

	echo "<p align=center>";submitkey ("go","YES");echo "</p></form>";
	echo "<form action=disable method=post> 	<p align=center>";submitkey ("go","NO"); echo "</p></form>";			}
							}
							// restart engine m3с2
							if ($categorymode==2) {
								if (($findid2!==false)OR($found==2)) {
									$scrnum=$dbc[$scrcolumn];$found=2;
									$data=wordwrap ($dbc[$b],82,"\n");
									if (($findid1!==false)AND($b==0)) { echo "<b><cite>$data</cite></b></tr>"; continue; }
									if (($hostmysqlselect==1)&&($b==0)) { echo "</tr>" ;continue ; }
									if ($data=="") { echo "</tr>" ;continue ; }
									echo "<td><b>$z[$b]</b>: "."$data<br></td><td>";
									if ($b==1) screen ();
									echo "</td></tr>";
									if ($b==($k-1)) { echo "<br>"; $findrecords++;}
								}
							}
						}
				}
				if ((($findrecords===0)AND($adm==1)) OR (($findrecords===0)AND($pr[3]==1))) {
					print "<font color=red><b>Не найдено</b><br></font>";
						}


				// restart engine m3с3
				fclose ($f);if ($multisearch==0) {echo "Всего значений : $findrecords<br><br> ";exit (1); }  }

			}

			###########################################################
			//CSVMODESEARCHENDED				NON GLOBAL MODE END  //
			###########################################################



			###########################################################
			//				GLOBAL MODE								 //
			###########################################################

			//Искать все - режим 4 - global mode   SQL

			if (($mode == 4)AND($prdbdata[$tbl][12]=="mysql")) {
				global $query,$connect;
				global $mzdata,$mycols,$myrow;
				global $findrecords,$scrcolumn;
				$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
				mysql_select_db ($prdbdata[$tbl][9], $connect);
				$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
				$query = "SELECT * FROM `".$prdbdata[$tbl][5]."`";
				$query=$query.$addsql;// сортировка, лимит
				$oldvID=-1;
				selectedprintsql ($data);
			}

			
			
			if (($mode == 4)AND($prdbdata[$tbl][12]=="fdb"))
			{ echo "<u>Режим отображения всех данных.</u>";	$multisearch=0;
			$data=readdescripters ();$f=$data[4];
			//$f=$data[4];  ++$enabledataconnreturn=1; ошибка init 495
			for ($a=0;$dbc=xfgetcsv ($f,512,"¦");$a++) {
				$k = count($dbc);   $selected[]=$dbc;    }
				$oldvID=-1;
				selectedprintcsv ($data,$mycol,$selected);
				//fclose ($f);exit;
			}



			echo "<br>";
			//Мультипоиск по коду - режим 5 - global mode   CSV&SQL
			// Режим отображения предварительно настроенных кодов.





			if (($mode == 5)AND($pr[52]))
			{
			$activetable=$prdbdata[$tbl][1];
			//echo "Active table: $activetable [$tablemysqlselect'$tblmysqlselect]; Given data total:$boxcnt<br>";
			echo cmsg(A_BEST).".<br>";
			$filbas=$userfolder."/best.cfg";  // возможно будет дб в initse  с созданием шапки если файла вообще нет+++
  				@$best=csvopen ($filbas,"r",0);$data=readfullcsv ($best,"new");
 				// $data=readdescripters ();
   			$bestheader=$data[0];$bestplevel=$data[1];$bestcontent=$data[2];$bestcnt=$data[3];
  			$strokedata=$activetable."¦".$tablemysqlselect."¦".$tblmysqlselect."¦"; // FORMAT^    tablename;id1Xid2;id1Xid2
  			@fclose ($best);	
  
  /*//$editor=csvopen ("editor.cfg","r",1);
				//if ($editor===false) echo "Config cannot be loaded...";
				for ($a=0;$e=xfgetcsv ($editor,912,"¦");$a++) {
					if ($tbl==$e[0]) {$srch = count($e);  $selected= $e[0];echo "Лучшие товары по мнению редакции<br>"; break;}
				}
				*/
   for ($a=0;$a<$bestcnt;$a++) {
  	if ($bestcontent[$a]!=="") if (strpos (@implode ($bestcontent[$a],"¦"),$strokedata)!==false) {
  		$rewritecnt=$a;
  		//echo "Found $rewritecnt contains ".$bestcontent[$rewritecnt][0]."<br>";
 // 		echo "Already present, remove first please. Address:$rewritecnt of $bestcnt<br>";exit;
  	}
  	//проверка работает успешно , первая запись делается идеально правильно.
  }
  				if ($rewritecnt==false) msgexiterror ("nobest",$prdbdata[$tbl][1],"getfile.php");
 //$string=explode ("",$)

				$mode=2;$multisearch=1;// немного пользуемся мультипоиском :)
				for ($aa=3;$aa<count ($bestcontent[$rewritecnt]);$aa++)
				{ $string=explode ("+",$bestcontent[$rewritecnt][$aa]);
				$vID=$string[0];$vID2=$string[1];  //no +
				//echo  "$vID=$string[0];$vID2=$string[1];  //no +";
				 search ();
				//echo "$vID - is searching  this is  $dbc[0]<br>";
				}
			}






			//global mode 9 - no needs vID   (old 6)
			// возможно это была бы корзина покупок или по крайней мере личный список типа 5 режима
			if (($mode == 9)AND($prdbdata[$tbl][12]=="mysql")){ msgexiterror ("errorcfg",$mode,"admin.php");}
			if (($mode == 9)AND($prdbdata[$tbl][12]=="fdb")){ msgexiterror ("errorcfg",$mode,"admin.php");}


			// mode 10 - find comment  sql
			if ($mode == 10) {
				$scrdir="_local/scrcomm/".$scrdir;
				@$dircb=opendir ($scrdir);if (!$dircb) {echo "Для этой базы нет комментариев.";exit ;};
				//echo "Файл комментариев = $comfile ";
				while (($filescb[]=readdir($dircb))!==false) ;
				$dircntcb= count ($filescb)-1;
				$commcount=$dircntcb-2;
				for ($aa=2;$aa<$dircntcb;$aa++) {
					$comfile=$scrdir."/".$filescb[$aa];
					$findid=strpos(strtolower($comfile),"txt");
					if ($findid==false) { $commcount--;continue;}
					if (@fopen ($comfile,"r")) {
						echo "<br>";
						$comm=@file_get_contents ($comfile,"r");
						$aaa=strpos ($comm, $vID);
						if ($aaa!==false) echo "<font color=gray>".$filescb[$aa]." содержит </font><br>".$comm."<br><br>";
					}

				}
				echo "Всего комментариев в группе : ".$commcount."<br>";
				//	$scrnum; - то что нужно
				if ($multisearch==0) {exit (1); }
			}
			// mode 10 end sql find comment




			###########################################################
			//				GLOBAL MODE	END							 //
			###########################################################
			//Планируется для будущих режимов. вне пространства и времени


			if ($mode > 10) {msgexiterror ("errorcfg",$mode,"admin.php");}




			###########################################################
			//				FUNCTION ZONE							 //
			###########################################################
			// выводит рисунок если надо или ссылку на него и занимается отработкой комментариев если есть
			// для первых двух режимов вычисляется всегда по 0 колонке, для остальных по колонке категории



	function auth () { //old
	echo "<form  action=disable method=post> ";submitkey ("auth","AUTHEN");echo "</form>";exit;
			}

	function editstart () {		Header("Location: w.php");	exit;			}

	function filemgrstart () {		Header("Location: filemgr.php");	exit;			}

	function adminpanel () {		Header("Location: admin.php");	exit;			}

	function relogin ()
			{
				//global $tbl;
				$tbl=1;
				header('WWW-Authenticate: Basic realm="Модуль данных dbscript "');
				header('HTTP/1.0 401 Unauthorized');   echo "<form action='getfile.php' METHOD='post'>\n"; //{$_SERVER['PHP_SELF']}
				echo "<input type='hidden' name='SeenBefore' value='0' />\n";
				echo "<input type='hidden' name='OldAuth' value='{$_SERVER['PHP_AUTH_USER']}' />\n";
				submitkey ("auth","AUTHEN");
				echo "<br><br>Can be used only one times. Other way - is close and open your browser.";
				echo "</form></p>\n";
			}



			function errors () {
?>
 Данная информация могла устареть в вашей версии программы<br>
 Ошибка ввода - ошибка связанная с вводимыми пользователем данными.<br>
 Не найдено - в принципе ошибкой не является,может не отображатся вообще<br>
 Ошибка в настройках - неверная конфигурация.<br>
 Нет доступа (Сервис недоступен)- закрыт доступ администрацией .<br>
 * - в будущей версии.<br>
<?

			}

			function helplog ()
			{
			echo "Данная информация могла устареть в вашей версии программы<br>";
			echo "<a href='_logs'>Читать текущие логи (Общий,отмена,ошибки перевода, рапорты.</a><br>";
				print "Полная расшифровка полей есть в описании, здесь упомянуты важные данные:<br>";
				print "M - режим просмотра ";//1- по фамилии, 3 - по группе.<br>";
				print "B - подключаемая база  ";//0 - физические лица 1 - организации и юр.лица.<br>";
				print "Далее указывается какой IP и действие(я).<br>";
			}



			function aboutme () {
				global $languageprofile;//$message="";
				//$icon="info";
				$mainheader="<img src=_ico/conf.png>"."About me";
				$script=array ( 'message'=>$message,'icon'=>$icon,'mainheader'=>$mainheader );
				$actions="";
		 		window ($script,$actions);
		 		if ($languageprofile=="russian") {
		 			echo "<br>Dbscript (DBS) - программа для командной работы с базами данных с настраиваемыми гибкими ограничениями доступа";
		 			echo "<br>Автор программы: Фуфаев А.В. (aka Dj--alex)  Разработка:2006-2008";

		 		}
		 		if ($languageprofile!=="russian") {
		 			echo "Dbscript (DBS) - program for group work with DATABASEs + full controlled rights.";
		 			echo "<br>Author program: Fufaev A.V. (aka Dj--alex)   Developing:2006-2008";

		 		}
		 		closewindow ();
		 		exit;
			}

//http://dj.chg.su/dbscript/DBSCRIPTinstruction.doc

/* not include in  - не добавлено в руководство

	Для подключения сервиса.
Достаточно написать письмо с следующими пунктами.

1.Цели для которых будет применятся программа, и название для сервиса.
2.Выбранный план подключения,
3.Список баз данных и пользователей.
4.Базы данных в форматах sql принимаются как есть. Excel, Access, Csv базы данных конвертируются во внутреннее представление.
5.Желаемые названия кнопок в дизайне, окраска.

Важная заметка: Возможно подключение сервиса к вашему sql серверу, вам необходимо разрешить серверу dj.chg.su управлять вашим SQL, нам же от вас потребуются знание адреса, и логина и пароля для программы. Также потребуется схема подключения баз данных на вашем сервере (б\д и таблицы).

Важно: сервис является платным,т.к. хостинг, трафик и др. я вам бесплатно предоставить не могу
взамен - улучшенное техническое обслуживание.

Как подключится бесплатно или очень дешево - см документацию.


О расходе трафика сервисом:
Программа создавалась с расчетом на модемное соединение 28.8к
Т.е на модеме открытие одной страницы занимает 2 секунды.
Разумеется при первом входе или смене конфигурации время немного больше,т.к. кэшируется графика.
Для одной типовой операции поиск-чтение-изменение-сохранение расходуется около 70кб.
Есть опции экономии трафика.


Для владельцев серверов SQL:
Для работы программы с вашим сервером данных требуется доступ к mysql с сервера dj.chg.su.
Для ее работы создайте пользователя и необходимыми правами,и не забудьте настроить пароль.
Только вы будете видеть ваш пароль, а также те кого вы назначите администраторами сервиса.
Порт sql открывать только для этого сервера,иначе могут возникнуть проблемы с безопасностью.
Предоставляемые права: SELECT , INSERT, UPDATE,DELETE,CREATE,DROP, ALTER, SHOW DB.
Перснональные ограничения на выполнение команд есть встроенное.Рекомендуется использовать его а не ограничсивать на уровне сервиса.

PS.Cрок использования сервиса (если есть) теперь считается по количеству использованных дней а не прошедших.
Как подключить программную версию - рассказано подробно в руководстве.
все весьма просто, особенно если скачивать версию для новичков в соседней теме.

Для расширения возможностей программы нужно связатся со мной по адресу dj--alex@ya.ru.

Цены на некоммерческую и коммерческую версию довольно сильно отличаются в пользу первой. Т.е. если вы не планируете исп. в организациях dbscript - для вас это будет очень дешево. (подробнее - см. документацию).

*/

/*  Sample windows   он используется или нет? может удалить его и оставить window

	$script=array ( //  Для special режима иконка задаетс как параметр data
		'message' => "Сообщение",				// сообщение
		'icon' => "info" ,
      'mainheader' => "Главный хедер");

	$actions=array ( //  Для special режима иконка задаетс как параметр data
		'OK' => "r.php?tbl=22&mode=8&vID=118257",			// заголовок
		'Отмена' => "admin.php",				// сообщение
		'Повторить' => "admin.php?write=Импорт_Экспорт");

//window ($script,$actions);closewindow ();

			// SCRIPT WRITTEN BY DJ--ALEX
			#####################################################
			*/

endtm ();

?>
