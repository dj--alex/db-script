<?php
// Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex // INITALIZING CONFIGS  --  функция подготовки к работе и авторизации
// Это закрытый модуль, не для распространения
// chmod -R  774  fold  chown -hR kingprizrak:www-data  fold

$openedwindows=0;
$coreSE=1;
// ajax test - <script>$.get("my.php",[],function(res) { alert("a") });</script>
// SE repo
$svn1="http://db-script.googlecode.com/svn/trunk/";
$svn2="http://db-script.googlecode.com/svn/trunk/";

$OS=$_ENV["OS"];//print_r ($_GET); echo $OS;exit;
$OSTYPE="LINUX";//$a.=$_SERVER["PATH"];// /usr/  /local - linux    // C:\ WINDOWS System32 винда.
	$winchk=$_SERVER["SystemRoot"] ; //есть только на винде
        $winchk.=$_SERVER["WINDIR"];//есть только на винде
        $winchk.=$_SERVER["COMSPEC"];//есть только на винде
//setlocale (LC_ALL, 'ru_RU.CP1251');  // CFG OPT FUTURE  TODO:    локаль выключена.
if ((strpos ($OS,"indows"))==true) $OSTYPE="WINDOWS";
if ($winchk==true) $OSTYPE="WINDOWS";
if ((strpos ($_SERVER["SERVER_SOFTWARE"],"Win32"))==true) $OSTYPE="WINDOWS";//;// содержит Win32 для windows 
$USERDAT=$_SERVER["HTTP_USER_AGENT"]; // OPT FUTURE    //print_R($_SERVER); hpinfo ();echo $OS ;exit;
//SHOW USER IP IN INFO
$testenable="beta";// "alpha"; "beta"; is reserved wordss
//CFG OPT FUTURE  TODO:- отметка о необходимости внесении изм в конфигурации при обновлении
global $verinit;$dbs_ip =$_SERVER['REMOTE_ADDR'];$dbs_ref= $_SERVER['HTTP_REFERER'];global $pgconn; // added for compactibility with postgresql
$msgexitcalled=0;
 $verchar="4.3.42";
$verinit="Core $verchar beta (c) dj--alex";// service hide
$programname="Dbscript "; $lastupdate="25.05.2011";$vernumb=4.342;
$verprogram=$verprogram.$verchar." LU ".$lastupdate; // версия программы   ядро!
$vercore=$verprogram;
$enterpoint=$verinit;
$xfgetlimit=4096; //xfgetcsv limit  0 - medlennee   4024 malo dlya trini global $GLOBALS['xfgetlimit'];
list($msec,$sec)=explode(chr(32),microtime()); 
 $HeadTime=$sec+$msec; 
//@set_magic_quotes_runtime(0);  // is deprecated??
register_shutdown_function ("onend");
if(isset($_FILES)) ob_start ();

// loading core config   sd[18] - nastr pamyati
$folderscript=getcwd ();// получаем абсолютный путь
$folderscript=str_replace ("\\","/",$folderscript);// ЭТО ВЕРНОЕ НАПИСАНИЕ **** STR_REPLACE
$fldup=$folderscript ; //FOR DEMO  отключение поддержки multiinstance

//if ($OSTYPE=="WINDOWS") $fldup=substr ( $folderscript ,0,strrpos ($folderscript,"\\"));// выч как лучше отрезать папку 
//if ($OSTYPE=="LINUX") $fldup=substr ( $folderscript ,0,strrpos ($folderscript,"/"));// выч как лучше отрезать папку 
//http://127.0.0.1/dj/site/r.php?tbl=40&mode=7&vID=#дра;ужа&go=Искать
//main config
$filbas="_conf/property.cfg";
@$desc=csvopen ($filbas,"r","0");$data=readfullcsv ($desc,"new");
$configpresent=file_exists ("_conf");
$pr=$data[0];
if (($pr[93])OR($pr[94])) ob_start ();// test added!!! may be not need
if (!$pr[40]) @set_time_limit(60); else @set_time_limit ($pr[40]);

if (!$coreloadskip) if ($data==-1) {bluescreen ("_Main configuration damaged ($filbas)");
@$f=csvopen ("_conf/property.cfg","restore",1); if ($f==1) { echo cmsg ("A_BCK_PR").cmsg ("A_BCK_REST")."<br>";}
	echo "Try run install.php first";
        exit;
    }
// loading core ends
// authorization zone 2// обработка авторизации-2


if ($_GET['crcignore']) { $_GET['crcignore']="";}   //unsafe vars must be resetted HERE !!! небезопасные здесь
if ($_GET['crc']) { $_GET['crc']=-1;}  //crcignore ?? not work?
//http://wow.chg.su/inside/w.php?vID=test&vID2=&tbl=293&z0=test&z1=7&z2=test&origid1=test&origid2=test&write=To+confirm+changes  protected  CRC false from GET


//@ import_request_variables ("PGC","");
//$_POST['ADM']=0;  //ignored? 
if ($_GET['ADM']) { header ("Location: r.php"); die ("R Tape loading error 0:1");}; // эта защита работает и ДО и ПОСЛЕ импорта
if ($_POST['ADM']) { header ("Location: r.php"); die ("R Tape loading error 0:1");};//  а вообще лучше плашку про защиту показать
//method http://wow.chg.su/inside/w.php?vID=test&vID2=&tbl=293&z0=test&z1=7&z2=test&crcignore=on&crc=1868026345&origid1=test&origid2=test&write=To+confirm+changes&ADM=1  protected ADM change
// bug confirmed by Kernelbug and fixed Dj--alex


/*
 * $x=($_SERVER['HTTP_REFERER']);
    $xx=strpos ($x,"u-mangos.ru");
//echo "x=$x  xx=$xx<br>";
if ($xx>0) { ob_clean (); header ("Location: http://wow.chg.su/f"); exit;}
ob_flush ();
 *  отправлять посетителей сайта на оп=ределенные адреса  сделать таблицу   CFG MOD FUTURE
 */
//
//$a=session_get_cookie_params ($GUID);
if ($pr[36]!=="on") {
//session_start ();  // дожна работать без всего лишнего
$timetoremember=36000; if ($forever) $timetoremember=360000000;

		if (!$coreloadskip) if (isset ($loginstate)) {
	
		//$_SESSION["SID"] = session_id(); // SID \ GUID
		//echo "SESSION SID=".$_SESSION["SID"]."  SID=".$_SESSION[SID]." <br>";
		if (isset ($dbs_log)) { $_SERVER['PHP_AUTH_USER']=$dbs_log;}
		if (isset ($dbs_psw)) { $_SERVER['PHP_AUTH_PW']=$dbs_psw; }
		$dbsa=a ( base64_encode($dbs_log."¦".$dbs_psw));
		setcookie ("dbsa",$dbsa,time ()+$timetoremember);
		//session_register ("dbsa");
		//session_commit ();
		}
				
		if (($_COOKIE['dbsa'])AND(!isset ($_SERVER['PHP_AUTH_USER']))) {
			$data=a (base64_decode ($_COOKIE['dbsa']));
			$authmass=explode ("¦",$data);
			$dbs_log=$authmass[0];$dbs_psw=$authmass[1];
			 $_SERVER['PHP_AUTH_USER']=$dbs_log;
		 $_SERVER['PHP_AUTH_PW']=$dbs_psw;
		}
		
		//sessiin
		if (($_SESSION['dbsa'])AND(!isset($_COOKIE['dbsa']))AND(!isset ($_SERVER['PHP_AUTH_USER']))) {
			echo "session receiving...$dbsa...".$_SESSION['dbsa'];
			$data=a (base64_decode ($_SESSION['dbsa']));
			$authmass=explode ("¦",$data);
			$dbs_log=$authmass[0];$dbs_psw=$authmass[1];
			 $_SERVER['PHP_AUTH_USER']=$dbs_log;
		 $_SERVER['PHP_AUTH_PW']=$dbs_psw;
		}
		//
}
	//echo "ses=".$_SESSION['dbsa'];//- don't work this trash	
function a ($a) {	return $a; }  // пустышка
//end auth zone 2

	if (isset ($resetcookie)OR($pr[36]=="on"))  {setcookie ("dbsa");
		//unset ($_SERVER['PHP_AUTH_USER']);unset ($_SERVER['PHP_AUTH_PW']);
		//@session_unset ($dbsa);
		//@session_destroy (); 
		}
//после этой строчки все работает
	
//loading cfgs - tbl

$filbas="_conf/gmdata.cfg";
@$gmdata=csvopen ($filbas,"r","0");$data=readfullcsv ($gmdata,"new");
$gmheader=$data[0];$gmplevel=$data[1];$prauth=$data[2];$prauthcnt=$data[3];
@fclose ($gmdata);
if (!$coreloadskip) if ($data==-1) {
		@$f=csvopen ("_conf/gmdata.cfg","restore",1); if ($f==1) { echo cmsg ("A_BCK_GM").cmsg ("A_BCK_REST")."<br>";
                     //msgexiterror   cfglost  window ("","");echo cmsg ("F_REST");closewindow();
                  
                     }
        if ($f<1) bluescreen ("_No user profiles db in $filbas");
		}
//autorestore
		
$filbas="_conf/pages.cfg";
@$pages=csvopen ($filbas,"r",0);$data=readfullcsv ($pages,"new");
$pgheader=$data[0];$pgplevel=$data[1];$pgcontent=$data[2];$pgcnt=$data[3];
@fclose ($pages);

if (!$coreloadskip) if ($data==-1) { 
$f=csvopen ("_conf/pages.cfg","restore",1); if ($f==1) { echo cmsg ("A_BCK_PG").cmsg ("A_BCK_REST")."<br>";
//msgexiterror ("init",$configordbname,"disable");
}
if ($f<1)bluescreen ("_No pages config db in $filbas");
		}

if (!$dbdataskip) {
$filbas="_conf/dbdata.cfg";
@$dbdata=csvopen ($filbas,"r","0");$data=readfullcsv ($dbdata,"new");
$dbheader=$data[0];$dbplevel=$data[1];$prdbdata=$data[2];$prdbdatacnt=$data[3];
@fclose ($dbdata);
}

if (!$pr[43]) $mainhostmysql=$prdbdata[1][6];// потом надо будет вывести в админку переменную 
if ($pr[43]) $mainhostmysql=$pr[43];

//if ($data==-1) bluescreen ("No DATABASE data in $filbas");
if (!$coreloadskip) if ($data==-1) errorlog ("E_CFG:Not found $filbas"); //layermsgprint


	
// RIGHTS MODULE

$ADM=0;$prauthen=1;$prauthcnt=1;
while ($prauth[$prauthcnt-1][0]==true)	{
	$dbuserpswd=($prauth[$prauthcnt][1]); // dbpsw
	$dbusername=strtolower($prauth[$prauthcnt][0]);
	$enteredname=strtolower($_SERVER['PHP_AUTH_USER']);
	$servpw=$_SERVER['PHP_AUTH_PW'];// Entered password
	$oldencenteredpswd=md5 (md5 ($servpw));
	$enteredpswd=hashgen ($servpw);
	if (($dbusername===$enteredname)AND($dbuserpswd===$oldencenteredpswd)) { $ADM=$prauthcnt ;};
	if (($dbusername===$enteredname)AND($dbuserpswd===$enteredpswd)) { $ADM=$prauthcnt ;};
	$prauthcnt++;
	}

 /*       if ($prauthcnt<3) {//  3 - eto 1 user  4 - 2  i  t d
  * $ADM=3;$_SERVER['PHP_AUTH_USER']=stripslashes ($LOGINUSER); $_SERVER['PHP_AUTH_PW']=$PASSWORDUSER;//added
  for ($a=0;$a<200;$a++) {
	$prauth[$ADM][$a]="0";
	if (($a>24)AND($a<37)) $prauth[$ADM][$a]="1";
}
 $prauth[$ADM][0]=stripslashes ($LOGINUSER); 			$prauth[$ADM][1]=hashgen ($PASSWORDUSER);$prauth[$ADM][42]=1;
$prauth[$ADM][15]=$prauth[$ADM][0];$prauth[$ADM][22]=$lang;
$prauth[$ADM][21]="Default";$prauth[$ADM][10]=10;
//echo "E_CORE:No users left. ";exit;
};
//END procedure install default user   CFG  TO FUTURE  RELEASE
*/

//LOADRIGHTS
if ($prauth[$ADM][42]) {
	echo"";// суперюзер обладает всеми правами	
	
	for ($x=2;$x<14;$x++) { 
		if (($x==11)OR($x==10)) continue;
		$prauth[$ADM][$x]=1 ;
	
	}for ($x=33;$x<38;$x++) {
		if (($x==37)OR($x==43)OR($x==44)) continue;
		$prauth[$ADM][$x]=1 ;

	} 
	for ($x=43;$x<46;$x++) {
		if (($x==45)OR($x==44)) continue;
		$prauth[$ADM][$x]=1 ;
	}
}

$filbas="_conf/sitedata.cfg";
@$site=csvopen ($filbas,"r","0");$data=readfullcsv ($site,"new");
$sd=$data[0];
@fclose ($site);
if ($prauth[$ADM][46]) { $shriftsize=$prauth[$ADM][46]; } else  { $shriftsize=$sd[3];}  //  sd29 - adjust?  outdated shit

if (!$coreloadskip) if ($data==-1) {
@$f=csvopen ("_conf/sitedata.cfg","restore",1); if ($f==1) echo cmsg ("A_BCK_SD").cmsg ("A_BCK_REST")."<br>";
if ($f<1)bluescreen ("_Main configuration damaged ($filbas)<br>Try run install.php first<br>");
exit;
		}

$silent=0;// yes messaging about  lost next data;
// $pr - contains script related data and cfg's + $prdbdata data per each db's
// $sd - contains site related data and cfg's + $prauth data per each user
 
$filbas="_conf/denywords.cfg";
@$deny=csvopen ($filbas,"r",0);$data=readfullcsv ($deny,"new");
$dnheader=$data[0];$dnplevel=$data[1];$dncontent=$data[2];$dncnt=$data[3];
$denywords=$dnheader;  // prdeny  prdenycnt
@fclose ($deny);

if (!$coreloadskip) if ($data==-1) errorlog ("E_CFG:Not found $filbas"); //layermsgprint

/*
$filbas="_conf/editor.cfg";
@$editor=csvopen ($filbas,"r",0);$data=readfullcsv ($editor,"new");
$edheader=$data[0];$edplevel=$data[1];$edcontent=$data[2];$edcnt=$data[3];
@fclose ($editor);
*/


$filbas="_conf/styles.cfg";
@$styles=csvopen ($filbas,"r",0);$data=readfullcsv ($styles,"new");
$stheader=$data[0];$stplevel=$data[1];$stcontent=$data[2];$stcnt=$data[3];
@fclose ($styles);

if (!$coreloadskip) if ($data==-1) errorlog ("E_CFG:Not found $filbas");// layermsgprint (

$filbas="_conf/langset.cfg";
@$langset=csvopen ($filbas,"r",0);$data=readfullcsv ($langset,"new");
$lsheader=$data[0];$lsplevel=$data[1];$lscontent=$data[2];$lscnt=$data[3];
@fclose ($langset);

if (!$coreloadskip) if ($data==-1) errorlog ("E_CFG:Not found $filbas");// layermsgprint (

   if ($OSTYPE=="LINUX") $addOSenter="\n"; //  исправление соединения строк  исп. для bans.cfg i chat.cfg i macros.cfg
if ($OSTYPE=="WINDOWS") $addOSenter="\r\n";

$sqlencodingdefault=$pr[76];


if ($configpresent) {
        //creation files.cfg and starting it
  $filescfg=csvopen ("_conf/files.cfg","rw",1);
    if ($filescfg==false) {
        $a=fopen ("_conf/files.cfg","w");//header generator - использовать как пример , рекомендуется!
        fwrite ($a,"ID¦Sharemode¦USRLIST¦PLVL¦HASH¦FILE¦rmvset¦comment¦data¦All download¦Last download¦Allow search¦HashDel¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"0¦0¦0¦0¦0¦0¦d¦d¦0¦0¦0¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦".$addOSenter);
        fclose ($a); $filescfg=csvopen ("_conf/files.cfg","rw",1);
    }
    $filesdata=readfullcsv ($filescfg,"new");
$filheader=$filesdata[0];$filplevels=$filesdata[1]; $filplevel=$filesdata[1]; $fildata=$filesdata[2];  $filcount=$filesdata[3]  ;// сука не возвращает это значение !!!
    //end files.cfg part
// FILPLEVELS _ WRONG!!!!!!!! $filplevel INSTEAD!!

if ($configpresent) {
        //creation filescript.cfg and starting it
  $filsccfg=csvopen ("_conf/filescript.cfg","rw",1);
    if ($filsccfg==false) {

        $a=fopen ("_conf/filescript.cfg","w");//header generator - использовать как пример , рекомендуется!
        fwrite ($a,"ID¦NAME¦Script¦Plevel¦keynames-icon¦russian¦english¦f1_russian¦f1_english¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"0¦d¦0¦0¦0¦0¦0¦d¦0¦0¦0¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦".$addOSenter);
        fclose ($a); $filsccfg=csvopen ("_conf/filescript.cfg","rw",1);
    }
    $filscdata=readfullcsv ($filsccfg,"new");
$filscheader=$filscdata[0];$filscplevels=$filscdata[1]; $filscplevel=$filscdata[1];$filsccount=$filscdata[3] ;$filscdata=$filscdata[2];    ;// сука не возвращает это значение !!!
    //end filescript.cfg part
}/*1
 * Пример использования.

ID¦NAME¦Script¦Plevel¦keynames-icon¦russian¦english¦f1_russian¦f1_english¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦
ID - идентификатор
Name - условное имя скрипта, отображается если не задано описания для нужного языка.
Plevel- проверка прав **
Script- собственно сам скрипт
Keynames - базовая иконка для скрипта.**
russian,english - название кнопки, в режиме utf8 рекомендуется воздержатся от кириллицы.
(хотя возможно это просто особенность работы моей версии php )

1¦¦mencoder %path%/%file% -oac mp3lame -ovc x264 -o %path%/%file%.avi¦0¦0¦перекодить в h264¦encode h264¦0¦0¦0¦0¦0

переменные работающие в модуле filemgr можно использовать через %var%
т.е. %path%- это взять текущий путь,  но %path2%  - это будет взять путь из второго файлового менеджера.
%file% - текущий файл
Заметьте знак "/" надо предусмотреть самостоятельно, за вас его в скриптах никто ставить не будет

(**пробная версия! графический редактор ещё не добавлен, команды работают только в режиме без иконок файлового менеджера и нет проверки прав)


*/

  //creation and starting it
  $cmcfg=csvopen ("_conf/cmdlines.cfg","rw",1);
    if ($cmcfg==false) { //не рекомендуется добавлять страницы и команды имеющие проблемы в безопасности
        $a=fopen ("_conf/cmdlines.cfg","w");//for edit req superuser\hoster rights
        fwrite ($a,"ID¦Command¦Parameters¦PLVL¦Info¦ReqPage¦ReqData¦ReqAutorun¦P¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"ID¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fclose ($a); $cmcfg=csvopen ("_conf/cmdlines.cfg","rw",1);
    }
    $cmdatax=readfullcsv ($cmcfg,"new");
$cmheader=$cmdatax[0];$cmplevels=$cmdatax[1];$cmdata=$cmdatax[2]; $cmcount=$cmdatax[3]  ;
   //end files.cfg part

//creation and starting it
  $srvcfg=csvopen ("_conf/srvlst.cfg","rw",1);
    if ($srvcfg==false) { //в будущем подсоединятся будем по ID сервера вместо хоста по желанию. через #  по моему уже работает.
        $a=fopen ("_conf/srvlst.cfg","w");
        fwrite ($a,"ID¦ServerIP¦Login¦Password¦Port¦DbType¦SysName¦Plvl¦Hide¦Info¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"ID¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fclose ($a); $srvcfg=csvopen ("_conf/srvlst.cfg","rw",1);
    }
    $srvdatax=readfullcsv ($srvcfg,"new");
$srvheader=$srvdatax[0];$srvlevels=$srvdatax[1];$srvdata=$srvdatax[2]; $srvcount=$srvdatax[3]  ;
  //end files.cfg part

}
//checking and restore dir structure

@$onloadlocal=opendir ("_local"); if ($onloadlocal==false) @$errcrtdir=mkdir ("_local");@closedir ($a);

if (($onloadlocal==true)OR($errcrtdir==true)){
@$a=opendir ("_local/scrcomm"); if ($a==false) mkdir ("_local/scrcomm");@closedir ($a);

$userfolder="_local/usr/".$prauth[$ADM][0];// bug with no exist fdb fixed //for best (izbrannoe) using this must be enabled!!
//if ($pr[47]) {
@$a=opendir ("_local/usr"); if ($a==false) mkdir ("_local/usr");@closedir ($a);
@$a=opendir ($userfolder); if ($a==false) mkdir ($userfolder);@closedir ($a);
$userfilesfolder=$userfolder."/files";
@$a=opendir ($userfilesfolder); if ($a==false) mkdir ($userfilesfolder);@closedir ($a);

//}

//@$a=opendir ("_conf/usr"); if ($a==false) mkdir ("_conf/usr");@closedir ($a);
@$a=opendir ("_logs");if ($a==false) { mkdir ("_logs");
//log checking available  and create header module
        $a=fopen ("_logs/log.dat","w");
        fwrite ($a,"id¦datecurrent¦usr¦dbs_ip¦shost¦act¦referal¦baseID¦hostIP¦error¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fclose ($a); 
        $a=fopen ("_logs/execsqllog.dat","w");
        fwrite ($a,"id¦datecurrent¦usr¦dbs_ip¦shost¦act¦referal¦baseID¦hostIP¦error¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fclose ($a); 
        $a=fopen ("_logs/log.dat","w");
        fwrite ($a,"id¦datecurrent¦usr¦dbs_ip¦shost¦act¦referal¦baseID¦hostIP¦error¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fclose ($a); 
        $a=fopen ("_logs/access.dat","w");
        fwrite ($a,"id¦datecurrent¦usr¦dbs_ip¦shost¦act¦referal¦baseID¦hostIP¦error¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fclose ($a);
       $a=fopen ("_logs/undolog.dat","w");
        fwrite ($a,"id¦datecurrent¦usr¦dbs_ip¦action¦restoreaction¦referal¦baseID¦hostIP¦error¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fwrite ($a,"¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦".$addOSenter);
        fclose ($a);
}
@closedir ($a);
// end log checking header module

@$a=opendir ("_data");if ($a==false) mkdir ("_data"); @closedir ($a);
$username=trim ($prauth[$ADM][0]);
//@$a=opendir ("_conf/usr/$username"); if ($a==false) mkdir ("_conf/usr/$username");@closedir ($a);
}
//if ($data==-1) msgexiterror ("errorcfg","noexit",$filbas);

if (!$pr[54]) {
	@$a=opendir ("_templates"); if ($a==false) mkdir ("_templates");@closedir ($a);
  	$a=csvopen ("_templates/head.php","r",0);
  	$dbstyle3en=$a;  if (($a)AND(!$pr[46])) { $pr[46]=1; $pr[44]=20; //автоматическое выключение меню если работает DeusModus menu $pr[45]=1;
  	} 
  	@fclose ($a);	
  }
if (($pr[54])) {$pr[46]=0; $pr[44]=130; //автоматическое выключение меню если работает DeusModus menu  $pr[45]=0;
}

$totalbas = $prdbdatacnt;
##загрузка определений стиля и языка

$styletemplateuser=$prauth[$ADM][21];
$laststyle=count ($stcontent);
if (($ADM==false)OR($prauth[$ADM][21]=="")) $laststyle=2;// если без логина будет стиль по умолчанию
//$stcontent  $stcnt    $prauth $$prauthcnt
for ($a=0;$a<$laststyle;$a++) { //$stcontent[выбранный юзером стиль][колонка соотв параметру]
$stylename=$stcontent[$a][0];
$grafictemp=$stcontent[$a][1];
$rgbfon=$stcontent[$a][2];
$rgbtext=$stcontent[$a][3];
if  ($stylename==$styletemplateuser) break;
}
//ssecho "adm21=".$prauth[$ADM][21]." ADM=$ADM svif  ($stylename==$styletemplateuser) break;";

$languagetemplateuser=$prauth[$ADM][22];
$lastlanguage=count ($lscontent);
if (($ADM==false)OR($prauth[$ADM][22]=="")) 
	{// if ($pr[28]=="default") $pr[28]="russian"; // A_LP_DEF pr28- не используется - так зачем он нужен ?
		$lastlanguage=2; //sysdefault $pr[28]
	}

        //print_r ($lscontent);
for ($a=0;$a<count ($lscontent);$a++) {// lastlanguage
$languagename=$lscontent[$a][0];
$languageprofile=$lscontent[$a][1];  // !!!
if ($languagename=="default") $defaultlanguage=$languageprofile; // для незарегистрированных пользователей и умолчание если есть у рег
if ($languagename=="system") $systemlanguage=$languageprofile; // 1
if  ($languagename==$languagetemplateuser) break;
}

if (!$installermode) if (!$languageprofile) $languageprofile=$defaultlanguage; // язык по умолчанию если не выбран при установке.
////loading language db languageprofile

$langdb=csvopen ("_langdb/".$languageprofile.".cfg","r",1); //is selected language!!s

if ($langdb===false) {
    
	if ($coreloadskip) { $languageprofile=$lang;
            if (!$lang) $languageprofile="english";

            $langdb=csvopen ("_langdb/".$languageprofile.".cfg","r",1); }//
	if (!$coreloadskip) echo "E_CORE:CMSG ".$languageprofile."_IS_INACCESSIBLE.<br>";
}


//echo "zagrujaetsya $languageprofile<br>";

$data=readfullcsv ($langdb,"ZZOLD");// old type encoding, no new format cache 
if ($data===false) echo "E_CORE:CMSG ".$languageprofile."_IS_WRONG!<br>";
$langdbcontent=$data[1];$langdbcount=$data[3];
$verlang=$data[0][0];
unset ($data);

$verlang=iconvx("windows-1251","utf-8",$verlang);

$encoder="";
function iconvx ($from,$to,$var) {
    global $sd,$encoder;
//$verlang=$data[0][0];
  if (extension_loaded('iconv')) {
       if ($sd[19]=="utf-8") { $verlang=iconv($from,$to,$var); $encoder="iconv"; }
  } elseif (extension_loaded('mb_string')) {
      if ($sd[19]=="utf-8") {$verlang=mb_convert_encoding($var,$from,$to); $encoder="mb_string";}
      } else
      { $encoder="php iconv not installed";
//$verlang=win_utf8($verlang);
      $verlang=$var;
  };
  return $verlang;
}


//on some versions PHP - this function is NOT EXIST !!!!!

if (!$pr[8]) $debugmode=1;
 if ($coreloadskip) { $debugmode=0;}
//окончание загрузки стилей и языков
//   DEFAULT VARIABLES FOR ALL FILES  ****************
$limits = array(32,64,128,256,512,1024,2048,3000,4000,5000,6000,7000,8000);
if(in_array($sd[18], $limits)) { ini_set( "memory_limit",$sd[18].'M' ); $memlim="lsd=". $limits[$sd[18]]."sd=".$sd[18].",[8000max]<br>";}
//..echo "$memlim";
$trafeconom=$prauth[$ADM][24];
//   END DEF VAR FOR ALL             *****************
//end loading   module to print in mainlib - lprint , cmsg
#####################################################
//только после этого места можно использовать CMSG
######################################################33
#############################################################################333
##USER CONFIGS LOADED (LOCAL MODE)
################################################################################
  
 

if ($pr[47]) {
$filbas=$userfolder."/macros.cfg";
@$macros=csvopen ($filbas,"r",0); 
$data=readfullcsv ($macros,"new");
//SUKA if ($macros==false) {$data[0][0]="CMD";$data[0][1]="EXECUTING"; $data[1][0]="0";$data[1][1]="0";}
$macrosheader=$data[0];$macrosplevel=$data[1];$macroscontent=$data[2];$macroscnt=$data[3];
@fclose ($macros);	



$filbas=$userfolder."/best.cfg";  // возможно будет дб в initse  с созданием шапки если файла вообще нет
@$best=csvopen ($filbas,"r",0);
// SUKA if ($best==false) {$data[0][0]="Table";$data[0][1]="List"; $data[1][0]="0";$data[1][1]="0";}
$data=readfullcsv ($best,"new");
$bestheader=$data[0];$bestplevel=$data[1];$bestcontent=$data[2];$bestcnt=$data[3];
@fclose ($best);  //  поточнее проверить

/*
$filbas=$userfolder."/files.cfg";  // возможно будет дб в initse  с созданием шапки если файла вообще нет  ufiles   CFG OPT FUTURE  TODO: - fast path
@$uf=csvopen ($filbas,"r",0);
// SUKA if ($best==false) {$data[0][0]="Table";$data[0][1]="List"; $data[1][0]="0";$data[1][1]="0";}
$data=readfullcsv ($uf,"new");
$ufheader=$data[0];$ufplevel=$data[1];$ufcontent=$data[2];$ufcnt=$data[3];
@fclose ($best); //почему то нет.
*/

}
if (!$pr[47]) { $macrosdisabled=1; $usermarkedfilesdisabled=1; };

$enablewin32enctooldmenu=$sd[39];
//WIN32MNUINUTF8
//Enable recode csv and configs data temporary from utf-8 to win32 for view and edit
############################################################## #
## END LOADING USER CONFIGS
#############################################################33


if ($errcrtdir==true){
// checking core starts counter
$file_counter = "_logs/counter.log";


if (file_exists($file_counter)) {
    $fp = fopen($file_counter, "r");
    if ($fp) flock($fp,LOCK_EX);
    @$counter = fread($fp, filesize($file_counter));
    fclose($fp);
		} else { $counter = 0;
		}
$counter++;
$fp = fopen($file_counter, "w");

@fwrite($fp, $counter);
flock($fp,LOCK_UN);
@fclose($fp);
$activitycounter=$counter;

$logtblname="_logs/activity.log";
if (@filesize($logtblname)>100500) unlink ($logtblname);
          	$w=csvopen ($logtblname,"a+",1);
                //flock($w,LOCK_EX);
          $activitylog=date("d.m.Y H¦i")."¦".$prauth[$ADM][0]."\n";
          @fwrite ($w,$activitylog);
          flock($w,LOCK_UN);
          @rewind ($w);
$active=readfullcsv ($w,"new");
$onlineusers=array ();
//$activelist=$active[2];
$activecount=count ($active[2]);
for ($a=0;$a<$activecount;$a++){

 if ($active[2][$a][0]==date("d.m.Y H")) $onlineusers[]=$active[2][$a][2];
}
$onlineusers=array_unique($onlineusers);
 //@fclose ($w);


unset ($active);
unset ($activelist);
}

// Проверка реферера на вшивость
//if(!$_FILES) {
$referer=($_SERVER['HTTP_REFERER']);
$srvdname=($_SERVER['SERVER_NAME']); // откуда юзер пришёл.

  if (($sd[33])AND($sd[35])) { $reflist=explode (",",$sd[33]);$xx=array_search ($referer,$reflist);}//  $xx=strpos ($referer,"u-mangos.ru");
  if (($sd[34])AND($sd[36])) { $srvdlist=explode (",",$sd[34]);$yy=array_search ($srvdname,$srvdlist);}//$yy=strpos ($srvname,"owcasual.ru");

//echo "ref = $referer srvd=$srvdname <br>sd33=".$sd[33].".sd34=".$sd[34]." <br>";
//echo "xx=$xx $reflist="; print_r ($reflist); echo " y <br>y=$yy  $srvdlist="; print_r ($srvdlist);echo "<br>";

if ($pr[93]) if (($sd[33])AND($sd[35])) if ($xx!==false) {; ob_clean ();header ("Location: ".$sd[35].""); } // die ("1 $sd[35]")
if ($pr[94]) if (($sd[34])AND($sd[36])) if ($yy!==false) { ;ob_clean (); header ("Location: ".$sd[36]."");} //die ("2 $sd[36]")
//}

         function print_massive ($m){
             if (!$m) return false;
             print_r ($m);
             //..echo $m[$a]."!=".end($m)."<br>";
             for ($a=0;$m[$a]!=end($m);$a++) {
//               /echo "a=$a,".$m[$a]."!=".end($m)."<br>";
                if ($m[$a]!="") $x.=$m[$a].",";
             }
              if ($m[$a]==end($m)) $x.=$m[$a].""; // последний цикл почему то выпал , пришлось так
             return $x;
         }
         
if ($pr[51]) { 
	$a1=(strrpos ($dbs_ref,"login.php"))+(strrpos ($dbs_ref,"admin.php"))+(strrpos ($dbs_ref,"login.php")) ;
	if (!$a1) {echo "<red><bb><ii>"; lprint (OVERLOAD); echo "</red></bb></ii>";exit (1);}
}

//sd3 eto shrift,  pradm55 - usersh
if (!$pr[78]) {
        $systemshrift=$sd[3];
if ($prauth[$ADM][55]) $systemshrift=$prauth[$ADM][55];
$buttonshrift=$sd[28];
$tableshrift=$sd[29];
}
//    CFG OPT FUTURE  TODO:




 $activation=1;$codekey=6;$daysleft=50;$finalcodekey=$codekey;$finalactivation=$activation;



//=======================================
$silent=0;  //set on messaging on error;  //CHANGED@@
//version check proprty
$vercfg=$pr[0];

if ($vercfg==255) $vercfg=2.30;$file="property";
$vpropcheck=$vercfg-$vernumb;

if ($pr[37]) $list=groupdbdetect($prdbdata);//ready to groupoperations

// при использовании с разными версиями конфигов будет выдаваться предупреждение, при разнице более
// одного ядра программа полностью блокируется.


//end check

$yourvrs=cmsg ($codekey."DBS_");
$enrestmenu=1; //CFG OPT FUTURE  TODO:
  if ($nomnu) { $enrestmenu=false;$menuloaded=false;}
  
require ("head.php");  // CSS HERE !!!   tbody добавлен но толку что то не вижу
//END OF RIGHTS MODULE

  
if (!$pr[46]) if (($enrestmenu)AND($menuloaded!==1)){  //always on
?><div id="menu" style="position:absolute; width:<?php echo $pr[44] ; ?>; z-index:0; left: 0px; top: 0px;"><?
require_once("indexmenu.php");
if ($dbstyle3en) echo "</div>";  // эти данные не должны выдаваться никаким образом вперед <head <meta
}



if (($fileed)AND($go==cmsg("SAVE"))) simpleedit($fileed,0);



function onend ()
{
    global $write,$pr,$enterpoint,$prauth,$ADM,$sd,$codekey,$frameoldcore,$msgexitcalled,$menuloaded,$enrestmenu,$finalcodekey,$activation,$finalactivation,$exitpoint,$shriftsize;
if (isset($_FILES[$name])) ob_start ();

//надо бы будет сделать createwin i printwin ($id,$msg)
// сообщение о некорректном файле dbscript
if ($codekey) if ((!$exitpoint)) if (($codekey!==$finalcodekey)OR($activation!==$finalactivation)) { 
	window (array ("icon"=>"warning","color"=>"yellow"),"");
	if ($languageprofile=="russian") echo "Your version dbscript contains non-recommended changes.Contact with author please.";else echo "Ваша версия dbscript содержит нерекомендуемые изменения.Пожалуйста свяжитесь с автором.";
	echo "<br>Script:$enterpoint<br>";
	if ($codekey!==$finalcodekey)echo "Error code:#0";
	if ($activation!==$finalactivation)echo "Error code:#1";
	//echo "($exitpoint)";
	//if $exitpoint!=="exitpoint") echo "Error code:#2";
		closewindow();}


require_once ("footer.php");

if (($codekey==10)OR($codekey==8)) testinfo ();
if (($codekey==9)OR($codekey==7)) demoinfo ();


if (isset($_FILES[$name]))  ob_clean ();


	
}

   if (1==0)  if ($prauthcnt<3) {//  3 - eto 1 user  4 - 2  i  t d
 //   echo $prauthcnt; from procedure install default user (install.php)   also can be used for open registration

$script=array ( //  Для special режима иконка задаетс как параметр data
		'color' => "red" ,
                'icon' => "warn" ,
      'mainheader' => "configuration error");

//msgexiterror ("init",$configordbname,"disable");
window ($script , $action );
////window (array ("icon"=>"warning","color"=>"red"),"");
echo cmsg (NOUSRS); 
closewindow();
}


$realpage=$_GET["pagenow"];
#########################################################
#
# ####    #  ###	# #  # # ###
# #		 # # #		# ## # #  #
# ##	 # # ###    # # ## #  #
# #      # # #		# #  # #  #
# #		 # # #		# #  # #  #
# ####	  #  #
#
##########################################################


#########################################################
#   Encode key functions and  key install\add			#
#########################################################
// проверка времени


  function datechangedetect () { return 1; }
  function writeencdat ($file,$actcode,$stroka){ return 1; }
  function readencdat ($file,$actcode){ return 1; }
  //
  //
  function installnewkey ($key) { return 1; }
  function addnewkey ($key){ return 1; }
  function genactcode (){ return 1; }
 function dmck ($serial){ return 1; }
  function checkserial ($serial){ return 1; }
  function loadserial () { return 1; }
  function writeserial ($serial){ return 1; }



#####################№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№
##########NON PROTECTED FUNCTIONS  #############################3
#################################################################3
#####################№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№
##########NON PROTECTED FUNCTIONS  #############################3
#################################################################3

#####################№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№
##########NON PROTECTED FUNCTIONS  #############################3
#################################################################3

#####################№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№
##########NON PROTECTED FUNCTIONS  #############################3
#################################################################3

#####################№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№№
##########NON PROTECTED FUNCTIONS  #############################3
#################################################################3

 //SYSTEM
 function hashgen ($pasw)
 {
 	$a=md5 ($pasw);$b=$a;
 	for ($c=0;$c<strlen ($pasw);$c=$c+2) {
 	$a[c]=$b[strlen ($pasw)-c];//mix
 	}
 	$newpasw="!".md5 ($a);
 	return $newpasw;
 }

function dispref ()
{
?>	<form method=post><?php	submitkey ("ref","REF");echo "</form>";
}



function layermsgprint ($a)
{ //bugged - only one message  написана из за некор работы msgexiter   печатает сообщение в левом верхнем угле. поверх всего.
	print "<div id:1; style=\"position:absolute; color=FF0000;  z-index:5;\">".$a."</div>";
}


 ######################################################################
  ##    $vermainlib="Mainlib v3.3.0 beta partial version";     ##
######################################################################
######################################################################
  ##    $verlibmysql="Libmysql v3.2.1 last partial version";     ##
######################################################################
//
 function splitcfgline1 ($line) {
 	global $OSTYPE;
 	if (is_array($line)==false) {
 	if ($OSTYPE=="LINUX") $line.="\n";
 	//if ($OSTYPE=="WINDOWS")	$line.="\r\n";
 	$line=explode ("¦",$line);
 	return $line;
 	}
 	if (is_array($line)==true) {
 			for ($a=0;$a<count ($line);$a++)
 			{  if ($OSTYPE=="LINUX") $line[$a].="\n";
		// 		if ($OSTYPE=="WINDOWS")	$line[$a].="\r\n";
 				$line[$a]=explode ("¦",$line[$a]);
 			}
 	}
 	return $line;
 }

// Данная программа относится к пакету DBSCRIPT v1.8 (с) dj--alex
//функция вывода без буферизации 
function lprint ($msg){
    	if ($msg=="") return "<br>";
	echo cmsg ($msg);}

/*
Функции преобразования кодировок
Часто встречается ситуация, когда нам требуется преобразовать строку из одной кодировки кириллицы в другую. Например, мы в программе сменили локаль: была кодировка windows, а стала — KOI8-R. Но строки-то остались по-прежнему в кодировке WIN-1251, а значит, для правильной работы с ними нам нужно их перекодировать в KOI8-R. Для этого и служит функция преобразования кодировок.

convert_cyr_string(string $str, char $from, char $to);

Функция переводит строку $str из кодировки $from в кодировку $to. Конечно, это имеет смысл только для строк, содержащих "русские" буквы, т. к. латиница во всех кодировках выглядит одинаково. Разумеется, кодировка $from должна совпадать с истинной кодировкой строки, иначе результат получится неверным. Значения $from и $to — один символ, определяющий кодировку:

k — koi8-r  w — windows-1251 i — iso8859-5 a — x-cp866 d — x-cp866 m — x-mac-cyrillic
Функция работает достаточно быстро, так что ее вполне можно применять, скажем, для перекодировки писем в нужную форму перед их отправкой по электронной почте.
*/

//функция вывода с буферизацией
//langdbcontent - база данных с списком языков и соответствия их названий файлам языков в _lang
//langdbcount - список всех языков
//languageprofile - профиль языка выбранный юзернеймом
//sd19 - utf 8 ili ne utf-8?

function cmsg ($msg)
{
  global $langdbcontent,$langdbcount,$languageprofile,$pr,$OS,$silent;
 // echo "global $langdbcontent,$langdbcount,$languageprofile,$pr,$OS,$silent;<br>";
//echo $langdbcount;echo $languageprofile;
  // cmsg 4.3.33 будет пропускать значения начинающиеся с точки
  // cmddecode можно ещё для такой штуки юзать  . тоже уберет.
  if ($msg[0]==".") { $msg[0]=" "; $msg=trim ($msg)."1";//..if  ($msg[0]==" ") die ( "probel detekted");
                            $x=detectencoding ($msg);//      echo "Encoded : ".$x."<br>?";
                           if (($x!=="utf-8")AND($sd[19]=="utf-8")) $msg=iconvx("windows-1251","utf-8",$msg);
                            return $msg ;};
  for ($a=0;$a<$langdbcount;$a++)
	{ 
			if ($langdbcontent[$a][0]==$msg) {
                            $returnedmessage=trim ($langdbcontent[$a][1]);
                            global $sd;
                            $x=detectencoding ($returnedmessage);//      echo "Encoded : ".$x."<br>?";
                            if (($x!=="utf-8")AND($sd[19]=="utf-8")) $returnedmessage=iconvx("windows-1251","utf-8",$returnedmessage);
                            //if ($sd[19]=="utf-8") $returnedmessage=iconvx("windows-1251","utf-8",$returnedmessage);
                            //convert_cyr_string($returnedmessage, "w", "k");
                            //$returnedmessage="";
                            return $returnedmessage;}
 	}
	$errmsg="CMSG:KEY_`".$msg."`_NOT_DEF_IN_".$languageprofile.".<br>";
	if (!$silent) errorlog ($errmsg);
	
	return "<red>?$msg</red>";
}


//функция ввода по собщению с буферизацией  обратная от cmsg
function rmsg ($msg)
{
  global $langdbcontent,$langdbcount,$languageprofile,$pr,$sd;
  
  //echo "checking $msg<br>";
  for ($a=0;$a<$langdbcount;$a++)
	{ 
		//$msgdbline=$langdbcontent[$a][1]//echo $langdbcontent[$a][1]."<br>";
                if ($sd[19]=="utf-8") $langdbcontent[$a][1]=iconvx("windows-1251","utf-8",$langdbcontent[$a][1]);
			if ($langdbcontent[$a][1]==$msg) {  return trim ($langdbcontent[$a][0]);} 
			if (trim ($langdbcontent[$a][1])==$msg) {  return trim ($langdbcontent[$a][0]);} 
	}
	$errmsg="RMSG:WORD_`".$msg."`_NOT_HAVE_KEY_IN_".$languageprofile.".<br>";
	errorlog ($errmsg);
	return "$msg"; 
}





// проверяет prauth запись номера админа, если админ возвращает да
function testadmin ($prauth,$id)
{	for ($a=0;$a<count ($prauth);$a++) {
		if ($prauth[$a][0]==$id) if ($prauth[$a][2]==1) return 1;
	}
	return 0 ;
}


 function dbs_genericnumlist ($result,$mycols) {
            $field=" (";$mycols=dbs_num_fields ($result,"");

			for ($i = 0; $i < $mycols; $i++) {
						   $mycol[]= dbs_field_name($result, $i) ;
						   $headerrealnumbers[]=$i;
						   $datatypes[]= dbs_field_type ($result, $i) ;
						   $fieldlen[]=dbs_field_len($result, $i);
						   $flags[]=dbs_field_flags($result, $i);
				  $field.=$mycol[$i];
                                if ($i<$mycols-1) $field.=",";
//							echo "$mycol[$i] - type $datatypos[$i] $fieldlen[$i] - $mycols<br>";
							//if ($ff!==false) { $mzdata[]=$zdata[$a];$a++;};
					}

               $field.=") ";
               $data2["fieldlist"]=$field;
               $data2["mycol"]=$mycol;
               $data2["datatypes"]=$datatypes;
               $data2["headerrealnumbers"]=$headerrealnumbers;
               $data2["fieldlen"]=$fieldlen;
               $data2["flags"]=$flags;
               return $data2;
            }


// changes mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17])
// universal DB module connect, autodetect table type by alias
function dbs_connect ($host,$login,$pass,$dbtype) {
global $pr,$sd;// get type database requires connect  , typical is mysql
global $encode,$sqlencodingdefault,$debug,$silent;
if ($dbtype=="") echo ">>fixme>>dbs_connect - Dbtype not set.<br>";
if ($dbtype=="fdb") {echo ">>fixme>>dbs_connect - Dbtype given incorrect, as fdb, changing to default - mysql.<br>"; $dbtype="mysql";}
// if $host  non ip  ,have #  to use srvlst.cfg for host,login,pass,dbtype from there
 if ($debug) echo "HAVE $host, $login, $pass, $dbtype from srvlist<br>";
if ($host[0]==="#") {  //gethost srvlst.cfg
                    $newhost=substr($host,1);global $srvdata;
                    //echo "ibane newhost=$newhost $srvdata ".count($srvdata)."<br>";
                    for ($a=0;$a<count($srvdata);$a++) {
                                               if ($newhost==$srvdata[$a][6]) { $host=$srvdata[$a][1];
                                                    $login=$srvdata[$a][2];
                                                    $pass=$srvdata[$a][3];
                                                    $dbtype=$srvdata[$a][5];
                                                    if ($debug) echo "Set $host, $login, $pass, $dbtype from srvlist<br>";
                                                    //continue;
                                                    }
                                    }
}
if ($dbtype=="mysql") {

if (!extension_loaded('mysql')) { echo " $ei Warning : php extension mysql non-exist !  <br>"; return false; };
$connect=mysqli_connect ($host,$login,$pass);
//echo "blyat silent $silent <br>";
if (!$silent) sqlerr ($connect);


 //mysqli_set_charset ("utf8",$connect); echo ">>bug>>set charset =$x";return false;
///////     mysqli_query("SET NAMES `cp1251`", $connect); //  НЕ ЗАБЫТЬ СДЕЛАТЬ ОПЦИЮ НАФИГ""!""!!!latin1  utf8 cp1251 (joomla) работает только для простых запросов.
//echo "EPT a=$a---($host,$login,$pass)";
if ($connect===false) {
                         if ($debug) echo "server ".$host." is not available... trying use default server ".$pr[43]."<br>";
                          if ($debug) if (!$pr[43]) {echo "Default server undefined. Fail.<br>";die ("");}
                          $connect = mysqli_connect ($pr[43], $sd[14] , $sd[17]);};
   if ($connect===false) { if ($debug) echo "default server not connected<br>"; return false;}
               if (($sqlencodingdefault)AND(!$encode)) mysqli_query("SET NAMES `$globalencode`", $connect);
               if ($encode) mysqli_query("SET NAMES `$encode`", $connect);
    return $connect;
}

if ($dbtype=="pg") {
    global $pgconn;
$pgconn="host=$host user=$login password=$pass port=5432";
$connect=pg_pconnect ($pgconn); //  port=5432 dbname=1

//echo "ibane pgconn dbsconnect = $pgconn<br>";
pgerr ($connect);//echo "EPT a=$a---($host,$login,$pass)";5432
if ($connect===false) { echo "server ".$host." is not available... trying use default server ".$pr[43]."<br>";
                          if (!$pr[43]) {echo "Default server undefined. Fail.<br>";die ("");}
                          $connect = pg_connect ("host=".$pr[43]." port=5432 user=".$sd[14]." password=".$sd[17]."");};
   if ($connect===false) { echo "default server not connected<br>"; return false;}
    return $connect;
}

if ($dbtype=="ibase") {
$connect=ibase_connect ($host,$login,$pass);
ibaseerr ($connect);
//echo "EPT a=$a---($host,$login,$pass)"; firebird   fbd base_connect  ([ string $database  [, string $username  [, string $password  [, string $charset  [, int $buffers  [, int $dialect  [, string $role  [, int $sync  ]]]]]]]] )
if ($connect===false) { echo "server ".$host." is not available... trying use default server ".$pr[43]."<br>";
                          if (!$pr[43]) {echo "Default server undefined. Fail.<br>";die ("");}
                          $connect = ibase_connect ($pr[43], $sd[14] , $sd[17]);};
   if ($connect===false) { echo "default server not connected<br>"; return false;}
    return $connect;
}

if ($dbtype=="oci") {
$connect=oci_connect ($host,$login,$pass);
ocierr ($connect);
//echo "EPT a=$a---($host,$login,$pass)"; firebird   fbd base_connect  ([ string $database  [, string $username  [, string $password  [, string $charset  [, int $buffers  [, int $dialect  [, string $role  [, int $sync  ]]]]]]]] )
if ($connect===false) { echo "server ".$host." is not available... trying use default server ".$pr[43]."<br>";
                          if (!$pr[43]) {echo "Default server undefined. Fail.<br>";die ("");}
                          $connect = oci_connect ($pr[43], $sd[14] , $sd[17]);};
   if ($connect===false) { echo "default server not connected<br>"; return false;}
    return $connect;
}

//oci_connect - using on Oracle resource oci_connect  ( string $username  , string $password  [, string $db  [, string $charset  [, int $session_mode  ]]] )

}

//settings for abstraction layer   слой для преобразования команд здесь
// if dbtype is not set - it becomes mysqli
function dbs_query ($cmd,$connect,$dbtype) {
    global $debug;
if ($dbtype=="") echo ">>fixme>>dbs_query - Dbtype not set.<br>";
if ($debug) if ($dbtype=="fdb") {echo ">>fixme>>dbs_query - fdb given!<br>";$dbtype="mysql";}
   if (($dbtype=="pg")AND($cmd=="SHOW DATABASES")) $cmd="SELECT datname FROM pg_database";
   if (($dbtype=="pg")AND($cmd=="SHOW TABLES")) $cmd="SELECT relname FROM pg_class WHERE relname !~ '^pg_'";
    if ($dbtype=="mysql") {mysql_real_escape_string ($cmd);
                           return mysqli_query ($cmd,$connect);
    }
    if ($dbtype=="pg") {   pg_escape_string ($cmd);
                            return pg_query ($connect,$cmd);
    }
    if ($dbtype=="ibase") {return ibase_query ($cmd,$connect);

    }
    mysqli_real_escape_string ($cmd);
    return mysqli_query ($cmd,$connect);
}

function dbs_fetch_row ($a,$dbtype) { //changed all
    if (!$dbtype) global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_fetch_row - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_fetch_row ($a);
    if ($dbtype=="pg") return pg_fetch_row ($a);
    if ($dbtype=="ibase") return ibase_fetch_row ($a);
    return mysql_fetch_row ($a);
}

function dbs_list_fields ($a,$b) {
    global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_list_fields - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_list_fields ($a,$b);
    if ($dbtype=="pg") return pg_list_fields($a,$b);
    if ($dbtype=="ibase") return ibase_list_fields ($a,$b);
    return mysql_list_fields ($a,$b);
}




function dbs_fetch_array ($a,$dbtype) { //changed all
    if ($dbtype=="") echo ">>fixme>>dbs_fetch_array - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_fetch_array ($a);
    if ($dbtype=="pg") return pg_fetch_array ($a);
    if ($dbtype=="ibase") return ibase_fetch_array ($a);
    return mysql_fetch_array ($a);
}

function dbs_num_fields ($a) {
       global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_num_fields - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_num_fields ($a);
    if ($dbtype=="pg") return pg_num_fields ($a);
    if ($dbtype=="ibase") return ibase_num_fields ($a);
    return mysql_num_fields ($a);
}

function dbs_num_rows ($a) {
       global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_num_rows - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_num_rows ($a);
    if ($dbtype=="pg") return pg_num_rows ($a);
    if ($dbtype=="ibase") return ibase_num_rows ($a);
    return mysql_num_rows ($a);
}



//dbs_field_name
function dbs_field_name ($a,$i) {
       global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_field_name - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_field_name ($a,$i);
    if ($dbtype=="pg") return pg_field_name ($a,$i);
    if ($dbtype=="ibase") return ibase_field_name ($a,$i);
    return mysql_field_name ($a,$i);
}


//dbs_field_name
function dbs_field_type ($a,$i) {
       global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_field_type - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_field_type ($a,$i);
    if ($dbtype=="pg") return pg_field_type ($a,$i);
    if ($dbtype=="ibase") return ibase_field_type ($a,$i);
    return mysql_field_type ($a,$i);
}

//dbs_field_name
function dbs_field_len ($a,$i) {
       global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_field_len - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_field_len ($a,$i);
    if ($dbtype=="pg") return pg_field_len ($a,$i);
    if ($dbtype=="ibase") return ibase_field_len ($a,$i);
    return mysql_field_len ($a,$i);
}

//dbs_field_name
function dbs_field_flags ($a,$i) {
       global $dbtype;
    if ($dbtype=="") echo ">>fixme>>dbs_field_flags - Dbtype not set.<br>";
    if ($dbtype=="mysql") return mysql_field_flags ($a,$i);
    if ($dbtype=="pg") return pg_field_flags ($a,$i);
    if ($dbtype=="ibase") return ibase_field_flags ($a,$i);
    return mysql_field_flags ($a,$i);
}




function dbs_affected_rows () {
    global $dbtype;
     if ($dbtype=="") echo ">>fixme>>dbs_affected_rows - Dbtype not set.<br>";
    if ($dbtype=="mysql") return @mysql_affected_rows ($a);
    if ($dbtype=="pg") return @pg_affected_rows ($a);
    if ($dbtype=="ibase") return @ibase_affected_rows ($a);
    return mysql_affected_rows ($a);
}

function dbs_selectdb ($dbselected,$connect,$dbtype){
    if ($dbtype=="") echo ">>fixme>>dbs_selectdb - Dbtype not set.<br>";
    if ($dbtype=="mysql") { $result=mysql_selectdb ($dbselected,$connect);
                           if ($result) return (true);  else  return (false);
    }
    if ($dbtype=="pg") {    //$query = '\connect '.pg_escape_string ($dbselected);
                            global $pgconn;
                            echo "pgconn=$pgconn <br>";
                           $result=pg_connect ($pgconn.' dbname='.$dbselected);
                          ////....   $result = pg_select($connect,"dbname=".$dbselected,$_POST);// работает , но $pgconn был бы лучше
                        //if ($result = pg_query ($connect,$query))
                        if ($result) return (true);  else  return (false);
                           }
    if ($dbtype=="ibase") { $result=ibase_selectdb ($dbselected,$connect); // not sure
                           if ($result) return (true);  else  return (false);
    }
    return mysql_selectdb ($dbselected,$connect);
    }





//=========== abstraction layer end ============================//

//// универсальный модуль чтения заголовков + хедеров + plevel
  // зарегистрированные типы конфигураций и подстройки под них  НЕ СДЕЛАНО  //..НЕ СДЕЛАНО
//   задачи процесса -  подключится к б\д считать шапку и выдать ее учитывая уровни доступа, 
//  входные данные -- коннект и сведения о б\д
//  выходные данные -- хедеры, уровни доступа, виртуальные хедеры (sql)

## DESCRIBE VER script read headings of tables or DATABASEs and return its  by dj--alex
## in data  REQ: $prdbdata,$tbl,$silent,connect
## taking from  readfile or writefile vars      mycol,mycols,mzdata,zdata,mzcnt
## Out data (must be marked as global !) 
## mzdata     SQL  - mycol - headings , mycols - total count of col  return headings
## can use    CSV  mzdata   - headings,    mycols - count   return headings
## autodetect possible errors and warning   --mznumb is not here   or return -1 if an error

// теоретически достаточно параметров соединения с сервером и номера базы.
// однако функция написана с расчетом на "самовзятие"ресурсов нужных ей.
	function readdescripters () {
            

	global $prdbdata,$connect,$sd,$pr,$tbl,$mycol,$mycols;// namebas,filebas-dropped;// пров авториз
	global $mzdata,$zdata,$mzcnt,$plevels,$silent,$prauth,$ADM;  //added for compactiblity
	global $enabledataconnreturn,$nofilestreamallowed,$debugmode;

	
	$removeheader=$pr[25]; // удаление неверных хедеров!,обычно запрещено

	
	//global $tbl,$cfgmod,$filbas,$namebas,$md1column,$md2column,$dbtype,$prdbdata,$groupdb; ???
$filbas=rfsysdatareq ();// определения для системных заголовков
global $tbl,$cfgmod,$filbas,$namebas,$md1column,$md2column,$dbtype,$prdbdata,$tbl,$groupdb;
//if ($cfgmod>0){$groupdb="system"; $dbtype="fdb";$prdbdata[$tbl][12]="fdb";$md2column=0;}; //двойной занос-вынужденная мера,т.к. dbtype почти не используется.

//сразу решились проблемы с системными таблицами,если будут еще подсыпать немного Global для вкуса

global $writefile; if ($writefile) $silent=0;	// выдача сообщений для writefile
if ($cfgmod<1) {
	$filbas=$prdbdata[$tbl][0]; 		$namebas=$prdbdata[$tbl][1];} else {
	if ($cfgmod==1) if (!$prauth[$ADM][2]) msgexiterror ("notrights"," administrator","admin.php"); }
//	echo "BEFORE  prba $prdbdata prau $prauth tbl- $tbl FILBAS $filbas  PR-B-0 ".$prdbdata[$tbl][0]."<br>";
//	echo "BEFORE mycol0--".$mycol[0]." [[ mycol--$mycols [[ mznumb0 --".$mznumb[0]." [[ mzdata0						 --".$mzdata[0]."=====<br>";
// функция не универсальна, и когда нужно ее добавить для CSV - много очень проблем возникает
	//readdescripters sql
	if ($prdbdata[$tbl][12]!="fdb") {// if sql
           $dbtype=$prdbdata[$tbl][12];// бля где же он его умудляется потерять?  ну ладно считаем заново из таблицы. не пройдет сука
            
			$mycol= array ();$mycols=0;
	
	  $findid=strpos(strtolower($prdbdata[$tbl][9]),"mysql");// hacktest - mojet uprostitx?
	if ($findid!==false) msgexiterror ("SQLhack",$prdbdata[$tbl][9]." LNK ".$prdbdata[$tbl][1],"admin.php");

		  $findid=strpos(strtolower($prdbdata[$tbl][9]),"information");
	if ($findid!==false) msgexiterror ("SQLhack",$prdbdata[$tbl][9]." LNK ".$prdbdata[$tbl][1],"admin.php");

			 $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],"mysql");
			 if (($ADM==0)AND(!$connect)) $silent=0;// на php 4 без авторизации окно не видно :( 
			if (!$silent)if (!$connect) msgexiterror ("SQLdown",$prdbdata[$tbl][6],"admin.php");
			$a=@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
		$res1=@dbs_list_fields ($prdbdata[$tbl][9],$prdbdata[$tbl][5]);
			$res=@dbs_num_fields($res1,""); $mycols=$res; // кол-во полей с результата
			  if ($res1===false) { //fixed 4.1.8 msgs
					if (!$silent) echo "$mserror E_DB: SQL_LINK_".$prdbdata[$tbl][5]."_NOT_CONNECTED!<br>";return -1;
					};

    global $mycol;  // method 2   вычисление содержимого?
    $data2=dbs_genericnumlist ($res1,$mycols,$mycol);
    $mycol=$data2["mycol"];
    $headerrealnumbers=$data2["headerrealnumbers"];
    $datatypos=$data2["datatypos"];
    $fieldlen=$data2["fieldlen"];
    $flags=$data2["flags"];



		$silent=1;
		$ff=csvopen ("_data/".$filbas,"r",1);
		$data=readfullcsv ($ff,"new"); if ($data==-1) { 
			// файла вообще нет - ++ работает верно.
				$fixdetect="В $filbas не обнаружен dat заголовок - добавляется новый<br>";
				if (!$silent) echo $fixdetect;
				$z=array();$new=1;$cnt=count ($mycol);$a=0;
				$abort="0";
				if ($pr[34]) $abort==="0g";
				$fx=csvopen ("_data/".$filbas,"a+",$abort);$add="";$plevels=""; //mode reselect to general (m-inst)
				if ($fx===false) {
					@fclose ($ff); $fx=csvopen ("_data/".$filbas,"a+",$abort);
					//trying to skip bug with some providers
					if ($fx===false) if ($debugmode) echo "E_DB:HEADER_CREATE_UNSUPPORTED_OR_NO_ACCESS.($filbas)<br>";
					}
				for($a=0;$a<$cnt;$a++) {
				$add=$add.$mycol[$a]."¦";$z[$a]=$mycol[$a]."¦";$plevels.="0¦";};
				@fwrite($fx,$add."\n");
				@fwrite($fx,$plevels); 
				@fclose ($fx);
				$ff=csvopen ("_data/".$filbas,"r",0);
				$data=readfullcsv ($ff,"new");
		}

		$csvheader=$data[0];$csvplevel=$data[1];$csvdata=$data[2];$csvcnt=$data[3];
		if (count ($csvheader)==1)
				{	$fixdetect="В $filbas обнаружена устаревшая версия dat заголовка, обновлено<br> ";
					if (!$silent) echo $fixdetect;
					fclose ($ff);$a=updatedb230 ($filbas); if ($a==-1) echo "updating failure";
							@$ff=csvopen ("_data/".$filbas,"r",1);
							$data=readfullcsv ($ff,"new");
							$csvheader=$data[0];$csvplevel=$data[1];$csvdata=$data[2];$csvcnt=$data[3];
				}
			// проверка на старую версию CSV
	if ((count ($csvheader)!==$mycols+1)OR(count ($csvplevel)!==$mycols+1)) {
	//if ((count ($csvheader)!==$mycols+1)) {
			$warndetect= "dathd ".count ($csvheader)."!=sqlhd ".($mycols+1)."!=datpl ".count ($csvplevel)." или число колонок или число уровей доступа $filbas sql не соответствует заголовку!<br>";
				if ($silent) if ($debugmode) echo $warndetect;
				if ($removeheader) { fclose ($ff);unset ($warndetect);
				@$ff=csvopen ("_data/".$filbas,"delete",1); $fixdetect="заголовок $filbas <red>удален</font><br>"; echo $fixdetect; readdescripters ();
				}// а здесь мы юзаем рекурсию :))
				$enablemodifyheader=1;//AUTO ON
			//	if ((count ($csvheader)==$mycols+1)AND(count ($csvplevel)!==$mycols+1)) $enablemodifyheader=0;//No IF ONLY PLVL CHANGED
	if ($enablemodifyheader) { fclose ($ff);unset ($warndetect); // UNRELEASED
		 $fixdetect="заголовок $filbas sql structure adapted.<br>";// echo $fixdetect;
		 if (!$silent) echo $fixdetect;
		$newplevel=array (); // CFG OPT FUTURE  TODO:   alternative plevel updating method 
		$newplevel=$csvplevel; 
		for ($a=0;$a<$mycols;$a++) {
			for ($b=0;$b<count ($csvheader);$b++) {
				if ($mycol[$a]==$csvheader[$b]) $newplevel[$a]=$csvplevel[$b];
				if ($newplevel[$a]==="") $newplevel[$a]="0";
			}
		if (count ($newplevel)<count ($csvheader)) {
			echo "newplevel".count ($newplevel)."==csvheader".count($csvheader)."mycols=".$mycols."<br>";
			for ($a=count ($newplevel);$a<count($csvheader);$a++){
			$newplevel[$a-1]="00";	//echo "newplevel $a assigned;";	-1 не убирать
			}
			
		}
		// если добавить поле firstusedname механизм будет работатьидеально
				$abort="0";
				if ($pr[34]) $abort==="0g";
				$fx=csvopen ("_data/".$filbas,"w",$abort);$add="";$plevels=""; //mode reselect to general (m-inst)
				if ($fx===false) {
					@fclose ($ff); $fx=csvopen ("_data/".$filbas,"w",$abort);
					if ($fx===false) echo "E_DB:HEADER_CREATE_UNSUPPORTED_OR_NO_ACCESS.($filbas).TMP_USED.<br>";
					}
	//..	if ($debugmode) echo "aft^newplevel".count ($newplevel)."==csvheader".count($csvheader)."mycols=".$mycols."<br>";
				for($a=0;$a<$mycols;$a++) {
				 $add=$add.$mycol[$a]."¦";//if ($a<count ($csvheader)+1)
				 $z[$a]=$mycol[$a]."¦";
				$plevels.=$newplevel[$a]."¦";
				};
				@fwrite($fx,$add."\n"); // не будет ли кросс линукс-виндового глюка с пустой строкой? выше еще подобное есть.
				@fwrite($fx,$plevels); 
				@fclose ($fx);
				$ff=csvopen ("_data/".$filbas,"r",0);
				$data=readfullcsv ($ff,"new");
		
		}
		$csvheader=$mycol;$csvplevel=$newplevel;
// как сделать переборку заголовка // 2 массива - один новый другой старый
// из них собирается третий сначала но названиям второго но местам первого,  (если они есть в первом конечно же)
//а потом уже доставляются новые элементы из первого
				}// а здесь мы юзаем рекурсию :))

		}			// проверка на соответствие CSV SQL  - сделать изменения в админке!
		} else {$errno=1;} ; //endif  sql 
//readdescripters sqlend
	//  после всей этой sqlcsv параши останется только б\д конфиги  
	//  главное чтобы выводы остались прежними параллельно с новым, а то число изменений будет велико
	
	//readdescripters csv  &	//readdescripters cfg
	// похоже что в CSV части вообще ничего толкового нет
 if ($prdbdata[$tbl][12]=="fdb") {
	// $connect - файл!  т.к. в csv эта переменная все равно не юзается
	$mycol= array ();$mycols=0;
	if ($cfgmod<1) {	@$ff=csvopen ("_data/".$filbas,"r","0");} 
	if ($cfgmod==1) { @$ff=csvopen ("_conf/".$filbas,"r","0") ;}
	if ($cfgmod==2) { @$ff=csvopen ("_logs/".$filbas,"r","0") ;}
//	echo "<font color=ff3f3f>Configuration - $filbas</font> <br>";
		if ($ff===false) {
			if ($prdbdata[$tbl][0]==true) {
				if (!$silent) echo "$mserror E_DB: DAT_LINK_".$prdbdata[$tbl][0]."_NOT_CONNECTED!<br>";
			$errno=1;return -1; }
		}
		@$zdata=xfgetcsv ($ff,$GLOBALS['xfgetlimit'],"¦"); $plevels=xfgetcsv ($ff,$GLOBALS['xfgetlimit'],"¦");
		if (count ($zdata)==1)
				{	$fixdetect="В линке $filbas обнаружена устаревшая версия dat , обновлено<br> ";
			if (!$silent) echo $fixdetect;
					fclose ($ff);$a=updatedb230 ($filbas); if ($a==-1) echo "updating failure";
if ($cfgmod<1) {	@$ff=csvopen ("_data/".$filbas,"r","0");} 
if ($cfgmod==1) { @$ff=csvopen ("_conf/".$filbas,"r","0") ;}
if ($cfgmod==2) { @$ff=csvopen ("_logs/".$filbas,"r","0") ;}

				@$zdata=xfgetcsv ($ff,$GLOBALS['xfgetlimit'],"¦"); $plevels=xfgetcsv ($ff,$GLOBALS['xfgetlimit'],"¦");
				}
//	 echo "Counting dat header -- ".count ($zdata)."<br>";
	$mzcnt=count ($zdata);$mycols=$mzcnt;
		//	while ($z[$a]==true) {		echo "$a -- ".$zdata[$a]."<br>";$a++;	}
$connect=$ff;  //жалкая попытка вернуть в качестве коннекта ссылку на файл				@fclose ($ff); 
// работать то работает а вот не из за нее ли на ЧТК не пашет изменение хедеров в реальном времени
for ($i=0;$i<$mzcnt;$i++) { $headerrealnumbers[]=$i;}
	}
	//readdescripters csvend //readdescripters cfgend

if ($prdbdata[$tbl][12]=="mysql") { 
		$headerreal=$mycol;	
		$plevels=$csvplevel;	
		$headervirtual=$csvheader; 
		
if (1==0) { // CFG OPT FUTURE  TODO: - enable\disable show virtual headers in mysql tables  сейчас ВЫКЛ - рекомендуется
	$headervirtual=$headerreal;
}
}

if (($cfgmod==1)) { 
	//echo "namebas=$namebas  fil=$filbas<br>";
  		$extenscfg=confdetect ($filbas);
		if (!$extenscfg) printf ("CORE_ERROR:Extension undefined in initalizeSE::confdetect($filbas).<br>");
		$silent=1; // no error CMSG's
	for ($a=0;$a<count ($zdata);$a++) {
		$headervirtual[$a]=cmsg ($extenscfg.$a);
	}
	$silent=0;	
	if (1==1) $zdata=$headervirtual;  	//CFG OPT FUTURE  TODO:-enable\dis show virtual headers on configs  сейчас ВКЛ - рекомендуется
	//if () $extensioncfg=  Ignore config header data (no recommended)

}// SQL RETURNED DATA CAN CONTAIN CSVHEADER
//выкорчевываем линки из plevel
  //to extract
 for ($a=0;$a<count ($plevels);$a++) {
  $pdata=explode ("#",$plevels[$a]);
  $plevels[$a]=$pdata[0]; 
  $plinkdb[$a]=$pdata[1]; 
  $plinkrow[$a]=$pdata[2];
  $plinkkol[$a]=$pdata[3];
  $plinkname[$a]=$pdata[4];
  $plinkhlpdb[$a]=$pdata[5]; //link to help db also used as name 
  $plinkhlprow[$a]=$pdata[6]; 
  $plinkhlpkol[$a]=$pdata[7]; 
  
 };// virtual id

  //if ($enabledataconnreturn!==1)
 @fclose ($ff);// может это влияет на исключ блокировку?   может вызвать ОШИБКУ!!!
if ($nofilestreamallowed) fclose ($connect);// не попортит ли это некоторые другие функции
// ВСЕГДА ВО ИЗБ ИСКЛ БЛОК ЗАКРЫВАТЬ ЭТОТ ПОТОК ДЛЯ ДАТ ТАБЛИЦ  вот так:$ff=$data[4];fclose ($ff);
 if ($prdbdata[$tbl][12]=="fdb"){ //  return $mycol;
			$headerreal=$zdata;
			if ($cfgmod!==1) $headervirtual=$headerreal;
			$datatypos=$connect; 
			$fieldlen=$cfgmod;
			if (!$pr[8]) echo "DEBUG Всего заголовков $mzcnt <br>"; // CSV RETURNED DATA
				;};  //  return $zdata;


	$returndata=array ( // не настроено -  выдача данных функцией
		0 => $headerreal,			//headerreal , all  example $data[0][$column]
		1 => $plevels,				//plevels , all
		2 => $headerrealnumbers,	//headerrealnumbers, all
		3 => $headervirtual,		//sql only  csv - copy headerreal
		4 => $datatypos,			//sql only  csv - connect (!!!)
		5 => $fieldlen,				//sql only  csv - cfgmod (!!)
		6 => $mycols,				// example - echo $data[6] ) ;	
		7 => $fixdetect ,  // пока что юзаются только в сверке хэдеров
		8 => $warndetect ,// пока что юзаются только в сверке хэдеров
		9 => $plinkdb,    // линк на базу данных  берем из plevel, all
		10 => $plinkrow,  //линк на режим, all
		11 => $plinkkol,  //линк на колонку, all
		12 => $plinkname, //name column, all
		13 => $plinkhlpdb, // ссылка на базу данных (имя)
		14 => $plinkhlprow, // ссылка на режим
		15 => $plinkhlpkol,  // колонку
		16 => $plinkhlpname  // name  not used
		); 
	return $returndata;
}
// возвращаемые коды ошибок, полезно для silent режима
//  -1  not connected
 
function backupsql($connect,$prdbdata,$tbl)
{
	global $dbtype;
        //## Если не созданы нужные таблицы то выполняется иначе пропускать
	## end of creating tables
		$query="CREATE DATABASE IF NOT EXISTS `dbscriptbk`;";
	$silent=0;dbs_query ($query,$connect,$dbtype);
	$query="DROP TABLE IF EXISTS `dbscriptbk`.`".$prdbdata[$tbl][5]."`;";// чтобы структуру уловить.
	dbs_query ($query,$connect,$dbtype);
	$query="CREATE TABLE `dbscriptbk`.`".$prdbdata[$tbl][5]."` LIKE `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`;";
	dbs_query ($query,$connect,$dbtype);
	$query="CREATE TABLE `dbscriptbk`.`_dbs30id` ( `table` varchar (80)  , `data` timestamp NOT NULL default CURRENT_TIMESTAMP )		;";
	dbs_query ($query,$connect,$dbtype);
	$query="DELETE FROM `dbscriptbk`.`_dbs30id` WHERE `table` LIKE '".$prdbdata[$tbl][9].$prdbdata[$tbl][5]."';";
	dbs_query ($query,$connect,$dbtype);
	$query="REPLACE INTO `dbscriptbk`.`_dbs30id` VALUES ( '".$prdbdata[$tbl][9].$prdbdata[$tbl][5]."','".date ("d.m.Y H:i:s")."');";
	dbs_query ($query,$connect,$dbtype);dbserr ();// inserting data about
 if (!$pr[8])	echo "DEBUG $query.<br>";
	$query="REPLACE INTO `dbscriptbk`.`".$prdbdata[$tbl][5]."` SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`;";
	$a=dbs_query ($query,$connect,$dbtype); dbserr ();
 if (!$pr[8])	echo "DEBUG $query.<br>";
	return $a;
 }


function restoresql($connect,$prdbdata,$tbl)
{ 	global $dbtype;
        $query="CREATE DATABASE IF NOT EXISTS `".$prdbdata[$tbl][9]."`;";
	$silent=0;dbs_query ($query,$connect,$dbtype);
	$query="CREATE TABLE `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` LIKE `dbscriptbk`.`".$prdbdata[$tbl][5]."`;";
	dbs_query ($query,$connect,$dbtype);
 if (!$pr[8])	echo "DEBUG $query.<br>";
	$query="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` SELECT * FROM `dbscriptbk`.`".$prdbdata[$tbl][5]."`;";
	$a=dbs_query ($query,$connect,$dbtype); dbserr ();
 if (!$pr[8])	echo "DEBUG $query.<br>";
  return $a;
}

function infrestsql($connect,$prdbdata,$tbl)
{ $query="SELECT * FROM `dbscriptbk`.`_dbs30id` WHERE `table` LIKE '".$prdbdata[$tbl][9].$prdbdata[$tbl][5]."';";
	global $dbtype;
        @$a=dbs_query ($query,$connect,$dbtype); if ($a==false) return -1;
	@$backupdata=dbs_fetch_row ($a,$dbtype);
	echo cmsg (DBS_TBL_BCK).$backupdata[1].")<br>";
 return $backupdata;
}

function structsqlx($action,$field,$fieldexch,$newname)  {
echo "Not implemented" ; 
return false;
}


function copydatabase ($source,$dest,$connect) {
	global $debugmode,$dbtype;
	//if ($debugmode) echo "DEBU";
	$query="CREATE DATABASE IF NOT EXISTS `$dest`;";
	$silent=0;dbs_query ($query,$connect,$dbtype);
	//generate table list
	echo "CMD:$source-->$dest<br>";
	dbs_selectdb ($source,$connect,$dbtype);  //one for program mysql_selectdb?
$cmd="SHOW TABLES";
$a=dbs_query ($cmd,$connect,$dbtype);
while ($result=dbs_fetch_row ($a,$dbtype)) {
	$tablelist[]=$result[0];$cnt++;//echo "table added to list ::".$result[0]."<br>";
	}
for ($a=0;$a<count ($tablelist);$a++) {
 $query="CREATE TABLE `$dest`.`".$tablelist[$a]."` LIKE `".$source."`.`".$tablelist[$a]."`;";
	$e=dbs_query ($query,$connect,$dbtype);
	if ($debugmode)	echo "DEBUG $query.<br>";
	$query="REPLACE INTO `$dest`.`".$tablelist[$a]."` SELECT * FROM `".$source."`.`".$tablelist[$a]."`;";
	$e=dbs_query ($query,$connect,$dbtype); dbserr ();
	if (($e==false)) $err++;
	if ($e==0) $skipped++;
 if ($debugmode)	echo "DEBUG $query.<br>";
}
 echo cmsg ("BCK_TBL+")."$cnt<br>";
 echo cmsg ("BCK_SKIP").$skipped."<br>";
 echo cmsg ("BCK_ERR").$err."<br>";
 return $err;
}



function updatedb230 ($filbas)  // работает
{
global $silent; // поддержка "тихого" режима без вывода мессаг
	// эта функция обновляет базы до версии 2.3 возможно работает и выше

	@$f=csvopen ("_data/".$filbas,"r",0);
	 		@$frewrite=csvopen ("_data/".$filbas.".txt","w+",0);
	if ($f==false) { if ($silent==0) {msgexiterror ("filenf",$filbas,"disable");fclose ($frewrite);unlink ("_data/".$filbas.".txt");	}return -1;	}
				  $row=xfgetcsv ($f,$GLOBALS['xfgetlimit'],";");
				  $cols=count ($row);
				  $findrecords=0;
			if ($cols<2) {fclose ($frewrite);unlink ("_data/".$filbas.".txt");return -2;};// no msg
				$rowdata=implode ($row,"¦"); 
				$plevels="";
				for ($a=0;$a<$cols;$a++) { $plevels.="¦"; } //  plevel
				@fwrite ($frewrite, $rowdata."\n");  
				@fwrite ($frewrite, $plevels."\n"); 	
				 for ($a=0;$dbc=xfgetcsv ($f,$GLOBALS['xfgetlimit'],";");$a++) {
					  $k = count($dbc); $rowdata=implode ($dbc,"¦"); 
							@fwrite ($frewrite, $rowdata."\n");
				} 
@fclose ($f);@fclose ($frewrite);
		$f=csvopen ("_data/".$filbas,"backup",0);			
		$f=csvopen ("_data/".$filbas,"delete",0);		
		$f=csvopen ("_data/".$filbas.".txt","rename","_data/".$filbas);		

//		$f=csvopen ("_data/".$filbas,"restore",0);			
	return $f;
}


function updatedb326 ($filbas)  // TEMP   REDIR TO LIBS!
{  global $silent,$prdbdata,$tbl;
$data=readdescripters ();$ff=$data[4];
$category=$prdbdata[$tbl][4]; $categorymode=$prdbdata[$tbl][7];
if ($categorymode===false) msgexiterror ("nocategory",$mode,"disable");
$ex=explode (".",$categorymode);
$categorymode=$ex[0];$category2=$ex[1];
$source=csvopen ("_data/".$filbas,"r",1);
$dest=csvopen ("_data/".$filbas."_conv326","w",1);
if ($source==false) { if ($silent==0) {msgexiterror ("filenf",$filbas,"disable");fclose ($frewrite);unlink ("_data/".$filbas."_conv326");	}return -1;	}
  csvopen ("_data/".$filbas,"backup",0);// create autobackup	
  $hdr=xfgetcsv ($source,$GLOBALS['xfgetlimit'],"¦");
  $plvl=xfgetcsv ($source,$GLOBALS['xfgetlimit'],"¦");
  $cols1=count ($hdr);  $cols2=count ($plvl);
  if ($cols2>$cols1) {$cols=$cols2;} else {$maxcols=$cols1;};
  $maxcols++;
if ($categorymode==1) {  $hdr[$maxcols]="group";  $plvl[$maxcols]="group";};
  $hdr=implode ($hdr,"¦")."\r\n"; //win32 enter not unix
  $plvl=implode ($plvl,"¦")."\r\n";
  		//if ($OSTYPE=="WINDOWS") if ($a+1<$counter) $dat=$dat."\r\n";
		 //if ($OSTYPE=="LINUX") if ($a+1<$counter) $dat=$dat."\n";
  echo "  HD=$hdr  PLVL=$plvl categorymode=$categorymode category2=$category2";
  fwrite ($dest,$hdr);
  fwrite ($dest,$plvl);
  

if ($categorymode==1) { //работает! :) 
for ($a=0;$myrow=xfgetcsv ($source,$GLOBALS['xfgetlimit'],"¦");$a++) {
	$content1=strtolower ($myrow[$category]);
	$content2=strtolower ($myrow[($category2)]); 
	$content1integer=$content1;settype ($content1integer,integer);
	if  (($content1integer==false)AND($content1integer==$content1)) {$groupname=$content1;}
	$myrow[$maxcols]=$groupname;
	$writedata=implode ($myrow,"¦")."\r\n";
	  		//if ($OSTYPE=="WINDOWS") if ($a+1<$counter) $dat=$dat."\r\n";
		 //if ($OSTYPE=="LINUX") if ($a+1<$counter) $dat=$dat."\n";
	fwrite ($dest,$writedata);
	}
}


if ($categorymode==2) { //раб,  если категория 2.х то х- это номер колонки для аналогичной операции с 2-й.
for ($a=0;$myrow=xfgetcsv ($source,$GLOBALS['xfgetlimit'],"¦");$a++) {
		$content1=strtolower ($myrow[$category]);
	$content2=strtolower ($myrow[($category2)]); 
	if ($myrow[$category]!=="") { $remember[$category]=$myrow[$category];}
	if ($myrow[$category]=="") { $myrow[$category]=$remember[$category];}
	if ($category2) {
		if ($myrow[$category2]!=="") { $remember[$category2]=$myrow[$category2];}
		if ($myrow[$category2]=="") {$myrow[$category2]=$remember[$category2];}
		}
	$writedata=implode ($myrow,"¦")."\r\n";
	  		//if ($OSTYPE=="WINDOWS") if ($a+1<$counter) $dat=$dat."\r\n";
		 //if ($OSTYPE=="LINUX") if ($a+1<$counter) $dat=$dat."\n";

	fwrite ($dest,$writedata);
}
}
fclose ($source);
fclose ($dest);
fclose ($ff);
//temporary writing end
		$f=csvopen ("_data/".$filbas,"backup",0);			
		$f=csvopen ("_data/".$filbas,"delete",0);		
		$f=csvopen ("_data/".$filbas."_conv326","rename","_data/".$filbas);	
		//if ($f==false) echo "OHH FUCK!";
		return $f;
		
//  вообще сделать работу так - автопреобразование только таблиц помеченых как категория
//  и режим катергии - repair_1 repair_2 и .т.д аналогично.  в противнос случае работать как с уже преобразованными
// признаки необходимости ремонта - назначение категории и одной из колонок поиска на одну колонку
}






// чистка массивов от ""
function Clear_array_empty($array) 
{
$ret_arr = array();
foreach($array as $val)
{
    if (!empty($val))
    {
        $ret_arr[] = trim($val);
    }
}
return $ret_arr;
} 


##cmd and prefix interpreter 
##in stroke vID
##out decoded f and data
##function returns number of selected field(s) without prefix
##and prefix as categorymode , it can be presetted
##preset 1,2,3 just set mode    1.1 indata gets selected fields and m1   -1  indata gets field no chngs

function prefixdecode ($indata)
{
 	global $presettedmode,$categorymode,$m6field,$m6count,$mode,$fields;//декодирование строки
	global $selectedfield,$multisearch;  global $pr; // for DEBUG MSGS
//	if	(!$pr[8]) {echo "START presettedmode=$presettedmode  categorymode=$categorymode res16=$indata <br>";}
	if ($indata==="") $indata="!3"; // если ничего не назначено , значит можно показывать все поля.
	$fields=strpos ($indata,"!");
  if ($indata[0]=="!") { 
				$categorymode=$indata[1] ; 
//				echo "DEBUG Working type : $categorymode<br>";
				$indata[0]=" ";$indata[1]=" "; $indata=trim ($indata); 
				} else { $categorymode="1";
						}
	if ($presettedmode==-1) {global $field;$indata=$field;// по какой то причине оказалось проще выставить mode7=1;
	echo "Field activated first $field<br>"; $presettedmode=0;//TO DELETE AFTER
};	if ($presettedmode==3) {$categorymode=3;} //  возможно всетаки нужно одно = ищет по всем полям
	if ($presettedmode==2) {$categorymode=2;}
	if ($presettedmode==1) {$categorymode=1;}
	if ($presettedmode==1.1) {$categorymode=1;$indata=$selectedfield;
				$indata[0]=" ";$indata[1]=" "; $indata=trim ($indata); $mode=7;}

	if	(!$pr[8]) {echo "DEBUG Working type : $categorymode <br>";}
	$fields=strpos ($indata,"!");
	$m6field= explode (",",$indata); $m6count=count ($m6field);
//	echo "m60=$m6field[0] m60=$m6field[1] m60=$m6field[2]"; зн перед верно
	if	(!$pr[8]) {echo "DEBUG Fields:$m6count  Selected field=$indata <br>";}
	//окончание декодирования строки
// if	(!$pr[8]) {echo "ENDING PREPARE presettedmode=$presettedmode  categorymode=$categorymode res16=$indata <br>";}
	return ($indata);
}



## Обработка командной строки
##in stroke vID   ##out decoded vID
## options    ## # - multisearch    ## !S - unserialize and urldecodedmode  ## html coded
function cmddecode ($vID)
{
global $cmd; $fields=strpos ($vID,".");

 if (($vID[0]==="#")AND ($vID[1]===".")) { echo "Undefined descriptor<br>";return ("_NULL_");}; // cant be cmd 
 if ($vID[0]==="#") { global $multisearch; $multisearch=1;return ($vID); }; // set multi
 if ($vID[0]===";") { echo "Undefined descriptor<br>";return ("_NULL_"); }; // undefined
 if ($vID[0]==="/") { echo "Undefined descriptor<br>";return ("_NULL_"); }; // undefined
 if ($vID[0]==="\'") { echo "Undefined descriptor<br>";return ("_NULL_"); }; // undefined
 if ($vID[0]==="\"") { echo "Undefined descriptor<br>";return ("_NULL_"); }; // undefined
 if ($vID[0]==="/") { echo "Undefined descriptor<br>";return ("_NULL_"); }; // undefined
 if (($vID[0]==="!")AND ($vID[1]==="S")) { $vID[0]=" ";$vID[1]=" "; trim ($vID); unserialize ($vID);urldecode ($vID);} //  !S - unserialize and urldecodedmode
 if ($fields===false) {return ($vID); }; // no command
 if ($fields===0) {   // standart . command
//  $vID[0]=" "; $vID=trim ($vID);
//string iconv_substr (string str, int start [, int length [, string charset]])
//Возвращает часть строки str определяемую началом start и числом символов length. 
  $includings=substr_count($vID," ");
  $id=$vID;
//  echo "Cmd parameters:".$includings." <bR>";
  if ($includings>4) { echo "_CMDDECODE_TOO_MANY_PARAMETERS ($includings)"; exit; } 
  $cmd=explode (" ",$vID);
  $cmd[0][0]=" "; $cmd[0]=trim ($cmd[0]);
 };

   return ($vID);

}





##decodecols ()

function decodecols ()
{
	global $categorymode,$mode;
	global $mode6,$m6field,$m6count; // $m6count; - kakogo hera ne peredan
	global $mycols,$mycol,$del,$res16,$presettedmode,$selectedfield;
	global $partquery,$vID,$fields,$multisearch;
	global $mznumb; 
	global $mzcnt; //added for csv mode;

//if (!$pr[8]) { echo "BEFORE START categorymode=$categorymode,mode=$mode,m6count=$m6count,	 mode6=$mode6,m6field=$m6field,mycols=$mycols,mycol=$mycol,del=$del,partquery=$partquery,vID=$vID<br>";}
##possible to libmysql decodecols ()
if ($categorymode==1) {	for ($aa=0;$aa<$m6count;$aa++)
	{ $mode6[]=$mycol[$m6field[$aa]];
	$mznumb[]=$m6field[$aa];// test!!!  возвращается для совместимости, непроверена
	// echo $mycol[$m6field[$aa]].",";
}

};


//  m6count - число искомых значений
//  $mode6d[] - массив полей для вывода
//	$mycol[a] список всех полей
//  $mznumb  номера только нужных полей
if ($categorymode==2) {
		$mode6=array ();$mznumb=array ();
		for ($bb=0;$bb<$mycols;$bb++)
			{ $mode6[]=$mycol[$bb]; // echo $mycol[$bb].",";
		$mznumb[]=$bb;// test!!!  возвращается для совместимости, непроверена
		}
		$del=0; 
		for ($aa=0;$aa<$m6count;$aa++)
			{ $ax=$mycol[$m6field[$aa]];// $mode6d[]=$ax;
		//echo "to del=".$mode6[$ax]."(".($m6field[$aa])."),";
		array_splice ($mode6, ($m6field[$aa]-$del), 1);
		array_splice ($mznumb, ($m6field[$aa]-$del), 1);$del++ ;
				
		//echo "ax=$m6field[$aa] - $ax , del?= ".$mode6[$ax]."!!!";
		//if (rand(0,1)>.5) { $aa--; };
		}
		//unset ($mode6[($m6field[$aa])]);
		; //array_splice ($mode6, $нужный_номер_элемента-кол-во удаленных элементов, 1);
			};

if ($categorymode==3) { for ($aa=0;$aa<$mycols;$aa++)
	{ $mode6[]=$mycol[$aa]; // echo $mycol[$aa].",";
		$mznumb[]=$aa; // возвращена для совм - в writefile была ошибка из за этого
}
	
	};
$mzcnt=count ($mode6);
$partquery="";// echo "count 6 ".count ($mode6);
 $vid="LIKE '%".$vID."%'";
 for ($aa=0;$aa<count ($mode6);$aa++)	{  //echo $aa."=".$mode6[$aa].",";
 $partquery=$partquery." `".$mode6[$aa]."` ".$vid." "; 
 if (($aa+1)<(count ($mode6))) { $partquery=$partquery." OR ";
	 }
//echo "<bR> stop <br>"; exit;
 }
  //`%".$m6counter."%` LIKE '%".$vID."%' " 
//if (!$pr[8]) { echo "BEFORE EXITING categorymode=$categorymode,mode=$mode,m6count=$m6count,	 mode6=$mode6,m6field=$m6field,mycols=$mycols,mycol=$mycol,del=$del,partquery=$partquery,vID=$vID<br>";}
//$m6counter="";exit;

// if	(!$pr[8]) {echo "DEBUG Query=$query<br>";}
//$sql="SELECT * FROM db_name ORDER BY field1,field2 ASC для режима 7	 LIMIT start,length 
 //  echo "DEBUG_VAR res16=$res16 displayed only 3 vars<br>";
 // echo "DEBUG_VAR m6field=$m6field[0] , $m6field[1] , $m6field[2] <br>";//поля указаны как в рес16
//   echo "DEBUG_VAR mode6=$mode6[0] , $mode6[1] , $mode6[2] <br>";// названия колонок учитывая режим верно
 //  echo "DEBUG_VAR mznumb=$mznumb[0] , $mznumb[1] , $mznumb[2] <br>";//номера колонок учитывая режим  верно
if (($categorymode>3)OR($categorymode<1))
{ 
  print "<red><bb>".cmsg (ER_CFG)."</bb><br></red>";
  echo cmsg (ER_CAT)."";echo "<form action=getfile.php method=post> <input type = Submit name = go  value =    OK > </form> ";
exit (1);
} 
return ($mznumb);
}


//html emulation :printselect,checkbox,submitkey,hiddenkey
//глоб оптимизация :csvopen

//example ==> checkbox ($testb5,"testb5");
//  varname содержит переменную-флаг  varforprint имя переменнойотправляемой в печать
// надо проверять наличие переменной а не ее значение!!   высылается либо on либо NULL
// грубо:  удаляем ==1  и заменяем ==0 на ! 
// full: if ($descr=="on") {включено} else { выключено;};
function checkbox ($varname,$varforprint)	{
if ($varname[0]=="#") { $selected=" checked";$varname[0]=" ";$varname=trim ($varname);} // добавить и в другие выборные функции эти параметры
if ($varname[0]=="!") { $selected=" selected";$varname[0]=" ";$varname=trim ($varname);} // добавить и в другие выборные функции эти параметры
if ($varname[0]=="%") { $selected=" disabled";$varname[0]=" ";$varname=trim ($varname);}
	if (!$varname) echo "<input type=checkbox name=".$varforprint." $selected>";
		if ($varname) echo "<input type=checkbox name=".$varforprint." value=1 checked$selected>";
		}
		
function checkboxcorrect ($varforprint,$varname)	{
if ($varname[0]=="#") { $selected=" checked";$varname[0]=" ";$varname=trim ($varname);} // добавить и в другие выборные функции эти параметры
if ($varname[0]=="!") { $selected=" selected";$varname[0]=" ";$varname=trim ($varname);} // добавить и в другие выборные функции эти параметры
if ($varname[0]=="%") { $selected=" disabled";$varname[0]=" ";$varname=trim ($varname);}
if (!$varname) echo "<input type=checkbox name=".$varforprint." $selected>";
		if ($varname) echo "<input type=checkbox name=".$varforprint." value=1 checked $selected>";
		}
// iz za oshibki  byli pereputany param mestami pri sozd funkcii nado potom popravit
		
function radio ($name,$value,$lprint) {
   if ($value=="default") {$selected=" selected"; $value=$lprint;};
if ($value[0]=="#") { $selected=" checked";$value[0]=" ";$value=trim ($value);} // добавить и в другие выборные функции эти параметры
if ($value[0]=="!") { $selected=" selected";$value[0]=" ";$value=trim ($value);} // добавить и в другие выборные функции эти параметры
if ($value[0]=="%") { $selected=" disabled";$value[0]=" ";$value=trim ($value);}

echo "<input type=\"radio\" name=\"$name\" value=\"$value\" $selected>";lprint ($lprint) ;
}

//function chkagr ($value) {
//return $value;
  //   }

function backkey () { //3157
	submitkey ("BACK_","BACK");
	submitkey ("CLOSE_","CLOSE");
	
}

// используется для вывода кнопок подтверждений, только с cmsg  usage=90%
function submitkey ($name,$cmsg)
{ global $trafeconom;  		// style=\"dbscriptstyles.css\"  //onDblClick
 if (!$trafeconom) { $idadd=" id=\"".$name."\" ";
 	$jsadd="onMouseOver=\"OM(this)\" onMouseOut=\"OMOut(this)\" onClick=\"AL(this)\"";};
  //if ($name=="BACK_") {$jsadd="onClick=\"javascript:window.history.back()\"";}; //onMouseOver=\"window.history.back()\"
 //if ($name=="CLOSE_") {$jsadd.="onClick=\"window.close()\"";};
 //if (!$nonewhelp2) {$hladd="onMouseOver=\"ShowTip(this)\" onMouseOut=\"HideTip(this)\" ";};
if ($name[0]=="#") { $selected=" selected";$name[0]=" ";trim ($name);} // checked ?? добавить и в другие выборные функции эти параметры
if ($name[0]=="%") { $selected=" disabled";$name[0]=" ";trim ($name);}

echo "<input type=submit $idadd class=buttonS name=\"".$name."\" value=\"".cmsg ($cmsg)."\" $jsadd $hladd $selected>"; //help !  alt=\"1231\"
//echo "<input type=submit class=buttonS name=\"".$name."\" value=\"".cmsg ($cmsg)."\" $jsadd >"; //help !  alt=\"1231\"
// Автоматическое нажатие отмены через 15 секунд ?:)   CFG OPT FUTURE  TODO:
if ($name=="AUTOBACK_") echo  "<SCRIPT>  window.setTimeout(\"window.history.back();\", 15000); </SCRIPT>";

}
// <INPUT onkeydown="" accesskey=""
//<span>Подсказка для ссылки</span>
function menukey ($name,$cmsg)
{ global $trafeconom;  		// style=\"dbscriptstyles.css\"  //onDblClick
 if (!$trafeconom) { //$idadd=" id=\"".$name."\" "; // зачем ?
 $jsadd="onMouseOver=\"OM(this)\" onMouseOut=\"OMOut(this)\" onClick=\"AL(this)\"";};
$value=cmsg ($cmsg);if ($value[0]=="<") $value=$cmsg;
 echo "<input type=submit $idadd class=buttonS name=\"".$name."\" value=\"".$value."\" $jsadd><br>";
}
 


// используется для скрытых кнопок, только с cmsg usage=70%
function hiddenkey ($name,$cmsg)
{	echo "<input type=hidden name=\"".$name."\" value=\"".cmsg ($cmsg)."\">";
}

// вариант для кнопок без cmsg  usage=70%
function hidekey ($name,$value)
{	echo "<input type=hidden name=\"".$name."\" value=\"".$value."\">";
}

//input, исп. если value надо вручную ставить  usage=0%
function inputtext ($name,$size,$value)
{ if (!$trafeconom) $idadd=" id=\"".$name."\" ";
	echo "<input type=text $idadd name=\"".$name."\" size=\"".$size."\" value=\"".$value."\">";
}

//поле для ввода принимает значение value автоматически по имени usage=50%
function inputtxt ($name,$size)
{ global ${$name};
  inputtext ($name,$size,${$name});
}

//поле для ввода принимает значение value автоматически по имени usage=3%
function txtarea ($name,$cols,$rows)
{ global ${$name};
if (!$trafeconom) $idadd=" id=\"".$name."\" ";
 echo "<textarea $idadd name=\"".$name."\" cols=$cols rows=$rows>".${$name}."</textarea>";
}

//example ==>  f ($stcontent,1,-1,"testb6",$testb6); 89269191051
//array - содержит коды в группе [a][1] идшники названия в [a][0]
//start,end  сколько пропустить от начала и конца
//varname какую переменную печатать :) 
//varfortest передача cодержимого varname для автовыбора если такой есть
// как пр  varname= varfortest по написанию
// colforsend номер колонки для передачи  colforprint колонка для показа (из массива)
// в сверке принимает участие именно отправляемая колонка (send)
 function printselect ($array,$start,$end,$varname,$varfortest,$colforsend,$colforprint){
		$endarray=count ($array); global $trafeconom,$sd;

		if (($codekey==9)or($codekey==7)) {
				lprint ("DEMO_2");print "30.<br>"; $floodlimit=30;};
if (!$trafeconom) $idadd=" id=\"".$varname."\" ";				
		echo "<SELECT $idadd name=".$varname." >";
    for ($a=$start;$a<$endarray-$end;$a++){
		$selected="";
		if ($varfortest==$array[$a][$colforsend]) $selected="selected";
                /*$x1=detectencoding($array[$a][$colforsend]);$x2=detectencoding($array[$a][$colforprint]);
               // может ли это вызвать новые ошибки? стиль от этого все равно не заработал - фтопку -в идеале сюда должны уже приходить кодированные данные echo $x1.$x2;
                 if (($x1!=="utf-8")AND($sd[19]=="utf-8")) $array[$a][$colforsend]=iconvx("windows-1251","utf-8",$array[$a][$colforsend]);
                 if (($x2!=="utf-8")AND($sd[19]=="utf-8")) $array[$a][$colforprint]=iconvx("windows-1251","utf-8",$array[$a][$colforprint]);*/
	    echo "<option value=\"".$array[$a][$colforsend]."\" ".$selected.">".$array[$a][$colforprint]."";
		  }
    echo "</SELECT>";
  }

/*&        $x=detectencoding($vd);
        echo "Encoded : ".$x."<br>?";
        if (($x!=="utf-8")AND($sd[19]=="utf-8")) $vd=iconvx("windows-1251","utf-8",$vd);&*/

function strunixtimetodbs ($date) {
 return date("d.m.Y H:i:s",$date);  //переводим юникс дату в дбс
}

function strdbstounixtime ($date) {
    //..$tempdate=date("d.m.Y H:i:s",1272436417);  //переводим юникс дату в дбс
//$dateinunix=strdbstounixtime ($date);// переводим обычную dbs дату в юникс
$date1=explode (" ",$date);
$datedmy=explode (".",$date1[0]);$datehis=explode (":",$date1[1]);

$hours = $datehis[0];
$minutes = $datehis[1];
$seconds = $datehis[2];
$month = $datedmy[1];
$day = $datedmy[0];
$year = $datedmy[2];
@$timestamp = mktime($hours,$minutes,$seconds,$month,$day,$year); //mktime() expects parameter 1 to be long, string given in
return $timestamp;
}




##in  globals,   data - from readdescripters
##out  none
##warning - do not use for CSV or SCP tables
function selectedprintsql ($data)
{	
	$linked="_ico/linked_table.png";
	$linked1="_ico/linked_table-yn.png";
	$linked2="_ico/linked_table-no.png";
	$wopros="_ico/wopros.png";
	global $query,$connect;	global $mzdata,$mycols,$myrow,$mycol;
	global $findrecords,$scrcolumn,$dbc,$commode;//,$k
	global $pr,$prdbdata,$mode,$tbl,$vID,$scrcolumn,$needscr,$scrnum ; // забытая в редакции 1.5 переменная, заменяет $db(c?)[0]
	global $scrdir,$db,$filbas,$formatscr,$writefile,$md1column,$myrow,$md2column,$trafeconom;
	global $oldvID;  // защита от повторной печати , гдето в др. функции ошибка
	global $prauth,$ADM;  // добавлено для правильной передачи логов и для обработки уровня доступа
	global $floodlimit,$fullfield;	global $codekey,$printlimit,$limitenable,$systemshrift,$pagenow,$page;
        global $dbtype ; // в поиске сильно флудит без этого
    if (($codekey==4)AND($floodlimit>50)) {
		lprint ("LIB_LIM_MAXSRCH");print "50.<br>"; $floodlimit=50;};
if (($codekey==9)or($codekey==7)) {
		lprint ("LIB_LIM_MAXSRCH");print "30.<br>"; $floodlimit=30;};
    echo "<form action=\"w.php\" method=\"post\" id=selprint>";
   if ($fullfield) { 
	$query=str_replace ("LIKE","=",$query); //не совсем корректно отправлять заранее LIKЕ позже стоит это исправить
	$query=str_replace ("%","",$query);
//	echo $query;
	}

if (!$printlimit) { $printlimit=20; $query=$query." LIMIT $printlimit";}

if (($printlimit)AND ($limitenable)) {
    
     $query2=$query; //SL указываение лимита через строку заранее тоже не самая лучшая идея, возможно позже стоит поправить
     $query=str_replace ("LIMIT $printlimit","LIMIT ".($printlimit*($pagenow+1)),$query);

 }

	$result = @dbs_query ($query, $connect,$dbtype);;
	$header=$data[0];
	$plevel=$data[1]; // не вездесрабатывает?  заменять в принципе оттуда можно взять и myrow (0) ,headerrealnumbers (2). headervirtual(4)
	$plinkdb=$data[9];              $plinkrow=$data[10];
	$plinkkol=$data[11];    	$plinkname=$data[12];
	$plinkhlpdb=$data[13]; //added hlpdb
	$plinkhlprow=$data[14];//added hlpdb
	$plinkhlpkol=$data[15];//added hlpdb

        if (($printlimit)AND ($limitenable)) {
                                             $skiplines=$printlimit*($pagenow);
                                             if ($debug) echo "skipping data lines $skiplines<br>";

                                            
                                             $query2=str_replace ("LIMIT $printlimit","",$query2);

                                             $result2=@dbs_query ($query2, $connect,$dbtype);;
                                             $totalresults=dbs_num_rows($result2,$dbtype)/$printlimit; // pagenumbers detection
                                             if ($debug) echo "totalresults=$totalresults <br>";
                                                    $totalrecords=$totalresults;
                                             for ($x=0;$x<$skiplines;$x++) {
                                                 $myrow = dbs_fetch_row ($result,$dbtype);
                                                              }
                                                                    //mysql module bldjaj  VID teryaet!!!
                                             if ($prdbdata[$tbl][12]=="fdb") $myrow=$dbc;
                                              global $realpage; echo "Your viewing page:".($realpage+1)." of ".$totalresults."<br>";
                                               if ($realpage+15<$totalrecords) $totalrecords=$realpage+15;
                                        if ($realpage-15>0) $startpage=$realpage-15;
                                         for ($mm=$startpage;$mm<($totalrecords);$mm++) {
                                            /*$fil="tbl=$tbl&vID=".$myrow[$md2column]."&m=$mode"; // нахер ибо страницы из за этого не раб
                                             if ($virtualid!==0) $fil=$fil."&vID2=".$myrow[$virtualid]; // вывод вторго ID если требуется */
                                                 $fil="tbl=$tbl&vID=".$vID."&m=$mode";
                                             if ($virtualid!==0) $fil=$fil."&vID2=".$vID2; // вывод вторго ID если требуется
                                             $commstr="_ico/link.png";
                                             if ($realpage==$mm) { $color="<bb><grn>";$endc="</bb></grn>";};
                                             echo "<a target=b1 href='r.php?$fil&write=$write&review=$review&intf=$intf&printlimit=$printlimit";
                                             if ($trafeconom) echo "&nomnu=1";
                                             echo "&field=$field&kol=$kol&groupdb=$groupdb&ipfilter=$ipfilter&pagenow=$mm&limitenable=$limitenable'>".$color.($mm+1).$endc."[<img src=$commstr border=0 title='".cmsg ("LINK")."'>]</a>";
                                             $color=""; $endc=""; } // page=mm removed!!!
                                             }


if ($debug) echo "[debug] $query <br>";
//	echo "mycols $mycols mz  $mzdata[1]";//if (!$pr[26]) if (count ($plevel)!=($mycols+1)) { echo "Error while getting Plevel...sorry...<br>";exit; };
	if ($result==true) {
		
		$namedlink=false; //инициализация определение named link
		for ($a=0;$a<$mycols;$a++) {
			$name=$plinkdb[$a];settype ($name,integer);
		if ((is_string ($plinkdb[$a]))AND(($name==false))) { $namedlink=$plinkdb[$a];  $plinkdb[$a]=getidbyid ($prdbdata,0,"realid",$namedlink);
                    if ($plinkdb[$a]==false) $plinkdb[$a]=getidbyid ($prdbdata,1,"realid",$namedlink);  //edited for 4.2.
			if (($plinkname[$a]==false)AND($plinkdb[$a])) $plinkname[$a]=getidbyid ($prdbdata,1,"srchrealid",$plinkdb[$a]); 
						continue;
				}
		if ($namedlink) { $plinkdb[$a]=getidbyid ($prdbdata,0,"realid",$namedlink); //edited for 4.2.
                    if ($plinkdb[$a]==false) $plinkdb[$a]=getidbyid ($prdbdata,1,"realid",$namedlink); // добавляет где то дубликат в шапку - внимательно 
                    unset ($namedlink);
                }; //namedlink moved inside cycle  may cause bug?
		if (($plinkname[$a]==false)AND($plinkdb[$a])) $plinkname[$a]=getidbyid ($prdbdata,1,"srchrealid",$plinkdb[$a]); 
		//if ($a<10) echo "pnam=$plinkname($a](".$plinkname[$a].")=get ($prdbdata,$a,srrlid,pdb=$plinkdb($a](".$plinkdb[$a]."); <br>";
		}// если линк нашелся то выполнить функцию определения
		
		// стиль таблиц buttonS экономичней  // font: bold 75% - покуй  он не видит
                

		echo "<font class=text><tbody><table id=myTable border=3 width=100% bordercolor=#206621 style=\" color: #".$rgbtext.";  \"  >";
                                echo "<tr>"; //font : $systemshrift; не помогает
                                
		for ($a=0;$a<$mycols;$a++)
				{
					if (strpos ($plevel[$a],"d")!==false)  continue;
					if ((strpos ($plevel[$a],"a")!==false)AND($prauth[$ADM][2]===0)) { continue;}else {//$plevel[$a]=0;
								};// для чего там эта команда? чтобы не выводились уровни? - тупо,  удалим.
					//echo "сравнение a=$a; plevel=".($plevel[$a]).">pauth=".$prauth[$ADM][10]."<br>";
					if ($plevel[$a]>$prauth[$ADM][10]) continue;
					$addtoprint="";
					if ($plinkdb[$a]!=false) { $addtoprint.="[<img src=$linked border=0 title='".$plinkname[$a]."'>]";}//added hlpdb	&
					
					if ($plinkhlpdb[$a]!=false) {
								if (($plinkhlprow[$a]==7)AND($plinkhlpkol)) $kkol="&kol=".$plinkhlpkol[$a];
								$plinkhlpdbid[$a]=getidbyid ($prdbdata,1,"realid",$plinkhlpdb[$a]);
								$b="<a target=help href='r.php?tbl=".$plinkhlpdbid[$a]."&m=".$plinkhlprow[$a].$kkol."&vID=".$header[$a]."&vID2='>";
								$addtoprint.="[$b<img src=$wopros border=0 title='".$plinkhlpdb[$a]."'></a>]";} //added hlpdb	&
					if ($mzdata[0]==false) {echo "<td><bb>".$mycol[$a].$addtoprint."</bb></td>";} else
					{echo "<td><bb>".$mzdata[$a].$addtoprint."</bb></td>";}//это не подд CSV просто кое где исп такие заголовки
				}

        if (($prauth[$ADM][4])AND($cfgmod!==2)) {
        $commstr="_ico/add.png";$fil=$tbl.";".$dbc[$md2column];
                            if ($virtualid!==0) $fil=$fil.";".$dbc[$virtualid]; // вывод вторго ID если требуется
        echo "<td><a href='w.php?cmd=add&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_ADD")."'></a></td>";
        }

	if (($prauth[$ADM][6])AND($cfgmod!==2)) { $fil=$tbl.";".$dbc[$md2column];
	$commstr="_ico/header.png";
	echo "<td><a href='w.php?cmd=hdr&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_HEAD")."'></a></td>";
	}
			echo "</tr>\n</tr>"; echo "";
		//module recalculate links patch 3.2.2 
		//module DATA display ..;/
if ($prdbdata[$tbl][18]) {
	echo "pdb18 ".$prdbdata[$tbl][18];
	$datacols=explode (",",$prdbdata[$tbl][18]);
$datafilehdr=explode (",",$prdbdata[$tbl][19]);
$datasplitters=explode (",",$prdbdata[$tbl][20]);
///echo "datacol ".$datacols[0]."filehdr ".$datafilehdr[0]."  datasplit ".$datasplitters[0]."<br>";

}
				//module end    http://dj.chg.su/data/
				while ($myrow = dbs_fetch_row ($result,$dbtype))  // DECLINED BY FALSE RESULT
										{
										for ($a=0;$a<$mycols;$a++)
											{
					if (strpos ($plevel[$a],"d")!==false)  continue;
					if ((strpos ($plevel[$a],"a")!==false)AND($prauth[$ADM][2]===0)) { continue;}else {//$plevel[$a]=0;
};
					if ($plevel[$a]>$prauth[$ADM][10]) continue; // линковка данных  plevel#db#mode
					echo "<td>";if (($plinkrow[$a]==7)AND($plinkkol)) $kkol="&kol=".$plinkkol[$a];
			if (($plinkdb[$a]>0)AND($plinkrow[$a]>0)AND($myrow[$a]!=false)) { echo "<a target=blank href='r.php?tbl=".$plinkdb[$a]."&m=".$plinkrow[$a].$kkol."&vID=".$myrow[$a]."&vID2='><img src=$linked border=0></a>"; 
									//fixed  search by name a ne kodu
									}; // &vID2= добавлен могло ли вызвать ошибки?
				unset ($kkol);	 
				//if (in_array ($datacols,$a)) {echo "FIELD TYPE DATA";continue;} // надо вывести кнопку для редактирования дата вместо него
				//NEW UNCONFIGURED OPTIONy
				//http://localhost/dj/site/w.php?cmd=ed&fil=dbdata;$dbname!!!;  zagolowok
			if (($prdbdata[$tbl][18])AND($prdbdata[$tbl][20])) for ($b=0;$b<count ($datacols);$b++) { $fil=$tbl.";".$myrow[$md2column].";;".$datacols[$b]."";
				if ($a==$datacols[$b]) {if (!$trafeconom) echo "<red>";
				 echo "DATA<a href='w.php?cmd=dat&fil=$fil'><img src='_ico/linked_table-yn.png' border=0 title='".cmsg ("KEY_HEAD")."'></a></color>";$myrow[$a]="";continue;}
			}
				echo $myrow[$a]."</td>";
											}
										$scrnum=$myrow[$scrcolumn];$findrecords++; screen ();
							//			echo "scrnum $scrnum  scrcolmn $scrcolumn";
							/*if (($findrecords>$printlimit)AND($limitenable)) { 
								echo "printlimit activated..."; 
								echo "<form method=post>";
								hidekey ($printlimit,"printlimit");								hidekey ($limitenable,"limitenable");
								hidekey ($tbl,"tbl");								hidekey ($vID,"vID");
								hidekey ($vID2,"vID2");								submitkey ($page,"2");
								echo"</form>";
								exit;
							// лимит печати и переключатель страниц
							}*/
						if ($findrecords>$floodlimit) { echo "Flood protect activated...</tr></table></tbody></div>"; exit;}
											echo "</tr>";
										}	
			
			//exit ;//непроверен вызов screen
			echo "</tbody></table><br>";
			if (!$trafeconom) {
 ?>	<script type="text/javascript">
//Подсветка по клику и при наведении мышки на ряд, множественный выбор по клику разрешен
highlightTableRows("myTable","hoverRow",0);
function checkAll(onoff)
{
$('#selprint input:checkbox').each(
function(){
if($(this).attr('name').substr(0,3) == 'bxt') $(this).attr("checked", (onoff ? "checked" : ""));
});
}
</script>
<?php
			}
	
	} ; 
			if (!$pr[8]) dbserr (); // вывод сигналов о ошибкаx
				  if ($findrecords==false) {
			msgexiterror ("notfound","noexit","disable");
				} else { echo "".cmsg ("TOTAL").": $findrecords<br><br> ";
				$enablecbx=$prauth[$ADM][45];	
hidekey ("tbl",$tbl);  //tbl можно и так передать , он ведь всегда одинаковый , потом убрать его передачу из ред и удал. (остав в ссылках)
		if ($enablecbx) {
hidekey ("masstbl",$tbl);

if (!$pr[97]) {?>
<input type="radio" name="total" value="checkbox" onClick="checkAll(true)">check all
<input type="radio" name="total" value="checkbox" onClick="checkAll(false)">uncheck all
<? } else { echo "Check all locked - please enable jQuery";};//for (var i=0; i < oForm[cbName].length; i++) oForm[cbName][i].checked = checked;





submitkey ("write","KEY_MASS_OPER");
		}
		echo "</form>";
				return; }
}





//show already connected list of databases     requires name for menu and displayed title  (may cmsg-ed)
//name - название меню,  title - заголовок этой выборки
function directselectsqldb ($connect,$name,$title) { //name==dest always!,
            global $dbtype;
	 if (!$trafeconom) $idadd=" id=\"".$name."\" ";
					$cmd="SHOW DATABASES";
			echo"<br>$title:";$a=dbs_query ($cmd,$connect,$dbtype);
			if ($a==false) echo "connection die";
			echo "<select $idadd name=$name>";
			while ($result=dbs_fetch_row ($a,$dbtype)) {
				if ($result[0]=="information_schema") continue;
				if ($result[0]=="mysql") continue;
				echo "<option>".$result[0]."";
				}
			echo "</select><br>";
			return $result;
			}
			
			
			
			

// analog selectedsqlprint  TEST MODE    поменять везде  $mycol  на $data из исправленных дескрипторов.
// сделать к readdesc функцию чтения-записи умеющую выполнять задачи с базой
// вставить удалить изменить  выполняющую их с определенным условием (eval)  !!1 НЕ СДЕЛАНО27.07.2007
// read desc - returns data header     libcsv ($command,$uslovie)

function selectedprintcsv ($data,$mycol,$selected)
{
	$linked="_ico/linked_table.png";
	$linked1="_ico/linked_table-yn.png";
	$linked2="_ico/linked_table-no.png";
	$wopros="_ico/wopros.png";
	global $mzdata,$mycols,$myrow,$mycol;	global $findrecords,$scrcolumn;
	global $dbc,$commode,$pr,$prdbdata,$mode,$tbl,$vID,$scrcolumn,$needscr ;//,$k/
	global $scrnum ; // забытая в редакции 1.5 переменная, заменяет $db(c?)[0]
	global $scrdir,$db,$filbas,$formatscr,$writefile,$md1column,$myrow,$md2column;
	global $oldvID;  // защита от повторной печати , гдето в др. функции ошибка
	global $prauth,$ADM;  // добавлено для правильной передачи логов  еще нужно для выборки полей  НЕ СДЕЛАНО
	global $floodlimit,$fullfield;	global $codekey,$cfgmod,$pagenow,$page,$systemshrift,$printlimit,$limitenable;
if (($codekey==4)AND($floodlimit>50)) {
			lprint ("LIB_LIM_MAXSRCH");print "50.<br>"; $floodlimit=50;};
if (($codekey==9)or($codekey==7))if ($cfgmod==0)  {
		lprint ("LIB_LIM_MAXSRCH");print "30.<br>"; $floodlimit=30;};
echo "<form action=\"w.php\" method=\"post\" id=selprint>";

if (!$printlimit) { $printlimit=20; $query=$query." LIMIT $printlimit";}

if (($printlimit)AND ($limitenable)) {
  // SQL code !!!
  $dbtype="fdb";
     $query2=$query; // указываение лимита через строку заранее тоже не самая лучшая идея, возможно позже стоит поправить
     $query=str_replace ("LIMIT $printlimit","LIMIT ".($printlimit*($pagenow+1)),$query);

 }

	$mycol=$data[0];	$plevel=$data[1];$headerrealnumbers=$data[2];   // все данные прин из data, других не надо!!
	$mycols=$data[6];
	$plinkdb=$data[9];   // линк на базу данных  берем из plevel
	$plinkrow=$data[10]; 
	$plinkkol=$data[11]; 
	$plinkname=$data[12];
	$plinkhlpdb=$data[13]; //added hlpdb
	$plinkhlprow=$data[14];//added hlpdb
	$plinkhlpkol=$data[15];//added hlpdb


        if (($printlimit)AND ($limitenable)) {
                                             $skiplines=$printlimit*($pagenow);
                                             if ($debug) echo "skipping data lines $skiplines<br>";
                                             $query2=str_replace ("LIMIT $printlimit","",$query2);
                                          //  $result2=@dbs_query ($query2, $connect,$dbtype);;  // зачем тут SQL код ???
                                          //   $totalresults=dbs_num_rows($result2,$dbtype)/$printlimit; // pagenumbers detection
                                             if ($debug) echo "totalresults=$totalresults <br>";
                                             for ($x=0;$x<$skiplines;$x++) {
                                            //     $myrow = dbs_fetch_row ($result,$dbtype);
                                                              }
                                             }
//телефон 100 пудов Корольков - 48722
//составить техническое задание по 1) сайт для показа видеофайлов (желательно очередями)
// 2 составить техническое задачие по сайту дружбы народов     каждый по 10к
//  глобализация как и все взята из соседней функции
//if (!$pr[26]) if (count ($plevel)!=($mycols+1)) { echo "Error while getting Plevel...sorry...<br>";exit; };
global $limitenable,$field,$printlimit,$selectenable,$systemshrift,$sd,$encode,$enablewin32enctooldmenu ; // сорт  лимит
//    global $selected;
	$mycols=count ($mycol);$mzdata=$mycol;
	$totalselected=count ($selected);//  maybe error
//	echo "MYCOLS $mycols TOTAL ROWS $totalselected";
	if (1==1) { // заголовки
		$namedlink=false; //инициализация определение named link
		//print_r ($plinkdb);// процедура выдает все остальне значенияза 0-е

             

		for ($a=0;$a<$mycols;$a++) {
			$name=$plinkdb[$a];settype ($name,integer);
			$copyofplinkdb[$a]=$plinkdb[$a]; //защита от вшивости с переносом на следующие колонки.
		if ((is_string ($plinkdb[$a]))AND(($name==false))) { $namedlink=$plinkdb[$a];$plinkdb[$a]=getidbyid ($prdbdata,0,"realid",$namedlink);
                    if ($plinkdb[$a]==false) $plinkdb[$a]=getidbyid ($prdbdata,1,"realid",$namedlink);  //edited for 4.2
			if (($plinkname[$a]==false)AND($plinkdb[$a])) $plinkname[$a]=getidbyid ($prdbdata,1,"srchrealid",$plinkdb[$a]); 
			continue;
			}
		if (($plinkname[$a]==false)AND($plinkdb[$a]==true)) $plinkname[$a]=getidbyid ($prdbdata,1,"srchrealid",$plinkdb[$a]); 
		if (($namedlink)AND($copyofplinkdb[$a]==true)) { $plinkdb[$a]=getidbyid ($prdbdata,0,"realid",$namedlink);
                    if ($plinkdb[$a]==false) $plinkdb[$a]=getidbyid ($prdbdata,1,"realid",$namedlink);  //edited for 4.2

                    unset ($namedlink);} //namedlink moved inside cycle  may cause bug?
	if (($plinkname[$a]==false)AND($plinkdb[$a])) $plinkname[$a]=getidbyid ($prdbdata,1,"srchrealid",$plinkdb[$a]); 
		}		// если линк нашелся то выполнить функцию определения
		//print_r ($plinkdb);

		echo "<font class=text><tbody><table id=myTable border=3 width=100% bordercolor=#206621 style=\" color: #".$rgbtext."; font : $systemshrift;\" >"; echo "<tr>";
		for ($a=0;$a<$mycols;$a++)
				{
					if (strpos ($plevel[$a],"d")!==false)  continue;
					if ((strpos ($plevel[$a],"a")!==false)AND($prauth[$ADM][2]===0)) { continue;}else {//$plevel[$a]=0;
									};
					if ($cfgmod<1)if ($plevel[$a]>$prauth[$ADM][10]) continue; // линковка данных  plevel#db#mode
					$addtoprint="";
					if ($plinkdb[$a]!=false) { $addtoprint.="[<img src=$linked border=0 title='".$plinkname[$a]."'>]";}//added hlpdb	&
					if ($plinkhlpdb[$a]!=false) {
								if (($plinkhlprow[$a]==7)AND($plinkhlpkol)) $kkol="&kol=".$plinkhlpkol[$a];
								$plinkhlpdbid[$a]=getidbyid ($prdbdata,1,"realid",$plinkhlpdb[$a]);
								$b="<a target=help href='r.php?tbl=".$plinkhlpdbid[$a]."&m=".$plinkhlprow[$a].$kkol."&vID=".$header[$a]."&vID2='>";
							$addtoprint.="[$b<img src=$wopros border=0 title='".$plinkhlpdb[$a]."'></a>]";} //added hlpdb	&
                                              
					if ($mzdata[0]==false) {echo "<td><bb>".$mycol[$a].$addtoprint."</bb></td>";} else
					{echo "<td><bb>".$mzdata[$a].$addtoprint."</bb></td>";}
				}


        if (($prauth[$ADM][4])AND($cfgmod!==2)) {
        $commstr="_ico/add.png";$fil=$tbl.";".$dbc[$md2column];
                            if ($virtualid!==0) $fil=$fil.";".$dbc[$virtualid]; // вывод вторго ID если требуется
        echo "<td><a href='w.php?cmd=add&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_ADD")."'></a></td>";
        }

	if (($prauth[$ADM][6])AND($cfgmod!==2)) { $fil=$tbl.";".$dbc[$md2column];
	$commstr="_ico/header.png";
	echo "<td><a href='w.php?cmd=hdr&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_HEAD")."'></a></td>";
	}
		echo "</tr>\n</tr>"; echo "";
                //header printing ending
		//module recalculate links patch 3.2.2 
		
		//module end

                        if (($printlimit)AND ($limitenable)) {
                            //if ($prdbdata[$tbl][12]=="fdb") {$myrow=$dbc; echo "Apply $dbc<br>";};
                            //echo "f=$findrecords<br>";
                            $totalrecords=$totalselected/$printlimit; // как его заранее определить???!!!
                            //echo "page=$page limitenable=$limitenable printlimit=$printlimit skip=$skiplines totalrecords=$totalrecords";
                        global $realpage; echo "Your viewing page:".($realpage+1)." of ".$totalrecords."<br>";
                        if ($realpage+15<$totalrecords) $totalrecords=$realpage+15;
                        if ($realpage-15>0) $startpage=$realpage-15;
                            for ($mm=$startpage;$mm<($totalrecords);$mm++) {
                                 
                                            /*$fil="tbl=$tbl&vID=".$myrow[$md2column]."&m=$mode";
                                             if ($virtualid!==0) $fil=$fil."&vID2=".$myrow[$virtualid]; // вывод вторго ID если требуется
                                  * какого хера тут $myrow $dbc??  они вообще сюда не доходят почемуто  один NULL - нахер удалить 2 строки
                                             * */
                                             $fil="tbl=$tbl&vID=".$vID."&m=$mode";
                                             if ($virtualid!==0) $fil=$fil."&vID2=".$vID2; // вывод вторго ID если требуется
                                             $commstr="_ico/link.png";
                                             echo "<a target=b1 href='r.php?$fil&write=$write&review=$review&intf=$intf&printlimit=$printlimit";
                                             if ($trafeconom) echo "&nomnu=1";
                                             if ($realpage==$mm) {$color="<bb><grn>";$endc="</bb></grn>"; };
                                             echo "&field=$field&kol=$kol&groupdb=$groupdb&ipfilter=$ipfilter&pagenow=$mm&limitenable=$limitenable'>".$color.($mm+1).$endc."[<img src=$commstr border=0 title='".cmsg ("LINK")."'>]</a>";
                                             $color=""; $endc="";}
                                               }

		if ($selectenable) { 
				$number=mycoltonumber ($mycol,$field);
				echo "Пытаемся отсортировать $field($number)<br>";//ksort ($selected,$number); фигня нуль};
				usort ($selected,"cmp");};
				//array_multisort ($selected[$number]);}; отстой
			   //echo "LBselectedprintcsv ($mycol,$selected)".$mycol[0].$selected[0]."--".$selected[0][0]."<br>";
				for ($b=0;$totalselected>$b;$b++)  // содержимое
										{
								if (($limitenable)AND($findrecords>($printlimit-1))) {	// added skiplines for printlimit - удалено .
								echo "".cmsg ("TOTAL").": $findrecords<br><br> ";exit;};
										$myrow=$selected[$b]; // выбор строки для отработки
	

	//FULLFIELD support only mode 1 если будет нужен то чем заменять md1column?
	//echo "sel-b".$selected[$b][$a]." myrow-a=".$myrow[$a]."==$vID)";
	if (($fullfield)AND($mode==1)) if (strtolower($myrow[$md1column])!==strtolower($vID)) break;
        if (($cfgmod==1)AND($myrow[0]==false)AND($myrow[1]!==false)) { continue;}; // где то тут при cfgmod==1 сыплются нолики...  просто тупо их не показываем.. потом найду откуда.
        	   //echo "LBselectedprintcsv ($mycol,$selected);
	   //.$mycol[0].$selected[0]."--".$selected[0][0]."<br>";
               if ($limitenable) if ($b<$skiplines) continue; //printlimit accept
										for ($a=0;$a<$mycols;$a++) // mycols надеюсь это myrows?
											{
                                                                                        
					if (strpos ($plevel[$a],"d")!==false)  continue;
					if ((strpos ($plevel[$a],"a")!==false)AND($prauth[$ADM][2]===0)) { continue;}else {//$plevel[$a]=0;
						};
					if ($cfgmod<1)if ($plevel[$a]>$prauth[$ADM][10]) continue; // линковка данных  plevel#db#mode
					echo "<td>";
                                        if (($plinkrow[$a]==7)AND($plinkkol)) $kkol="&kol=$plinkkol";
                                        
					if (($plinkdb[$a]>0)AND($myrow[$a]!=false)) { echo "<a  target=blank href='r.php?tbl=".$plinkdb[$a]."&m=".$plinkrow[$a].$kkol."&vID=".$myrow[$a]."&vID2='><img src=$linked border=0></a>";
									};				// &vID2= добавлен могло ли вызвать ошибки
                                                                        //patch for windows-1251 menu editing in utf-8 mode  ему похер, видимо не там меняю
                                            if ($enablewin32enctooldmenu) if (($sd[19]=="utf-8")AND($encode=="windows-1251")) $myrow[$a]=iconv("windows-1251","utf-8",$myrow[$a]);
										echo $myrow[$a]."</td>";
											}
									 $scrnum=$myrow[$scrcolumn];$findrecords++; screen ();//$b=1 do screen
						if ($findrecords>$floodlimit) { echo "Flood protect activated...</tr></table></tbody></div>"; exit;}
											echo "</tr>";
										}	
			//exit ;//непроверен вызов screen
			echo "</tbody></table><br>";
				if (!$trafeconom) { ?>	<script type="text/javascript">
//Подсветка по клику и при наведении мышки на ряд, множественный выбор по клику разрешен
highlightTableRows("myTable","hoverRow",0);
</script>
<?php
			}
	
	} ; 
			if (!$pr[8]) dbserr (); // вывод сигналов о ошибкаx
				  if ($findrecords==false) {
			msgexiterror ("notfound","noexit","disable");
				} else { echo "".cmsg ("TOTAL").": $findrecords<br><br> "; } //где то тут верстка глючит
				$enablecbx=$prauth[$ADM][45];	
hidekey ("tbl",$tbl);  //tbl можно и так передать , он ведь всегда одинаковый , потом убрать его передачу из ред и удал. (остав в ссылках)
				if ($enablecbx) {
hidekey ("masstbl",$tbl);
//Что бы не мучиться, можно с jquery
///jquery142.js checkall
// fucking noworkin jquery  CHK_LIC
?>
<script type="text/javascript">
function checkAll(onoff)
{
$('#selprint input:checkbox').each(
function(){
if($(this).attr('name').substr(0,3) == 'bxt') $(this).attr("checked", (onoff ? "checked" : ""));
});
}
</script><?
if (!$pr[97]) {?>
<input type="radio" name="total" value="checkbox" onClick="checkAll(true)">check all
<input type="radio" name="total" value="checkbox" onClick="checkAll(false)">uncheck all
<? } else { echo "Check all locked - please enable jQuery";};//for (var i=0; i < oForm[cbName].length; i++) oForm[cbName][i].checked = checked;

submitkey ("write","KEY_MASS_OPER");
		}
		echo "</form>";
	return;
}

// usort  functions
function cmp ($a, $b)
{    if ($a == $b) return 0;
    return ($a < $b) ? -1 : 1;
}

function cmpstroke ($a, $b)  {    return strcmp($a["q"], $b["q"]);}

//удаляет косые и подозрительные символы
//function antikosye ($query){ 	return stripslashes ($query);		}


function granttest ($datatotest,$addiflist,$addifcmp) {	
	
	$sampletotest=explode (",",$addiflist);
	$sample=$addiflist;
	$csa=count ($sampletotest);
	echo " granttest (datatotest=$datatotest,addiflist=$addiflist(count=$csa),addifcmp=$addifcmp)";
	if (count ($sampletotest)>1) {
    	if (($addifcmp=="bolee")OR($addifcmp=="menee")) {
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}
    	for ($a=0;$a<count ($sampletotest);$a++) {
    	if ($addifcmp=="rawno") { $addifgrants=strpos ($datatotest,$sample[$a]); break;}
		if ($addifcmp=="nerawno") {$addifgrants=strpos ($datatotest,$sample[$a]);break ;}
    	}
    	if ($addifcmp=="bolee") $addifgrants=$datatotest>$sample;
		if ($addifcmp=="menee") $addifgrants=$datatotest<$sample;
    	}
	if (count ($sampletotest)==1) {
	if ($addifcmp=="rawno") $addifgrants=strpos ($datatotest,$addiflist);
	if ($addifcmp=="nerawno") $addifgrants=strpos ($datatotest,$addiflist);
	if ($addifcmp=="bolee") $addifgrants=$datatotest>$addiflist;
	if ($addifcmp=="menee") $addifgrants=$datatotest<$addiflist;
	}
	//if (($addifenable)AND($addifgrants!==false)) { echo "found in massive!"; } ; 
	if (($addifcmp=="nerawno")AND($addifgrants===true)) return false;
	if (($addifcmp=="nerawno")AND($addifgrants===0)) return false;
	if (($addifcmp=="nerawno")AND($addifgrants===false)) return true;
	if ($addifgrants==true) echo "grant=true,";	
	if ($addifgrants===false) echo "grant=false,";
	echo "$addifgrants<br>";
	return $addifgrants;
}



function executesql ($query,$connect,$kosye)
{
//  если в качестве запретных слов передан "" то проверять их не надо - removed!
// должно быть уже установлено соединение с SQL
//query- ваш запрос, также он будет проверен на запретные слова, connect - ваше соединение к базе, 
// kosye  - 0 - obychnyj execut ,  1 - filtr \ `  2 - filtr + noprint
//  типичное применение    1,2 как при обычном query 3 пустое,  4 = 2
// возвращает количество выполненных запросов или -1 если не удалось их выполнить
	 set_time_limit(0);
	 global $printing,$disableprint,$dncontent,$dncnt,$ADM,$prauth,$dbtype,$prdbdata,$pr;// включение списка запрещенных слов и уровней доступа к ним
	if ($kosye) {
            echo "BEFORE pregreplace-kosye1-off!!-$query<br>";
			$patterns[0]="/`/" ;$replacements[0]=" ";//4.1
			$patterns[1]="/\\\'/" ;$replacements[1]="`";//4.1
			$patterns[2]="/\'`/" ;$replacements[2]="''";		//4.1
//			$patterns[2]="//\n/" ;$replacements[2]="";// remove enters
			$query=preg_replace ($patterns,$replacements, $query);//4.1

                       if (!$pr[92]) $query = preg_replace("#--(.+)\\n#isU", '', $query); // убираем однострочные комментарии     не видел комментов.
                       if (!$pr[92]) $query = preg_replace("#/\*(.+)\*/#isU", '', $query); // убираем многострочные комментарии
                       if ($pr[91]) $query = str_replace("\n", '', $query); // убираем переносы строк (в < дампе > запросы могут быть разбиты на несколько строк, что нам никак не нужно сейчас)


                        ;
			if ($kosye>2) {	
                          echo "BEFORE kosye2-on!!-$query<br>";
                          str_replace ($query , "\\\\"," "); 	$query=stripslashes ($query);		////4.1
					str_replace ($query , "`","'"); 			////4.1
                                        ;
					};
			}
        if ($debug) echo "BEFORE EXECUTING--<font color=gray>$query</font><br>";
        if ($debug) echo "warning  kosye is ignored !!! <Br>";
        //if (!$kosye) $query=mysql_real_escape_string($query); //4.1 for test it on  disabled tmp   БЭКАПЫ ТУТ ГЛЮЧАТ
        //ненужно ибо dbs_query сам исполняет real_escape
	$denywords2[]="information_schema";	$denywords2[]="mysql";		$denywords2[]="grant";
	$deny=0;
	for ($a=0;$a<count ($denywords2);$a++) {
		$deny=$deny+strpos (strtolower($query),$denywords2[$a]);
	}
		for ($a=1;$a<$dncnt;$a++) {
			//echo "$dncnt $query ".$dncontent[$a][0].";".$dncontent[$a][1]."-- ".$prauth[$ADM][10]."<br>";	
			if ($dncontent[$a][0]=="") continue;
			$strinfo=strpos (strtolower($query),strtolower($dncontent[$a][0]));
			if ($strinfo!==false) $strinfo++;
			//if ($strinfo===false) echo "STRPOS FAIL WITH:$query , CNT=".$dncontent[$a][0]."<br>";
			//echo "$strinfo=strpos (".strtolower($query).",strtolower(".$dncontent[$a][0]."));";
		if (($dncontent[$a][1]-$prauth[$ADM][10])>-1) { 
			$lastword=$dncontent[$a][0]; $deny=$deny+$strinfo;};
		if (!$prauth[$ADM][42]) if ($deny>0) break;
		//CFG OPT SUPER USER
		}

                //add infocheck of aliases of databases  $prdbdata

	if (!$prauth[$ADM][42]) if ($deny>0) { msgexiterror ("denyword", $lastword, "disable");return -1 ;};

        if ($debug) echo "AFTER REAL ESCAPE and DENYWORDS BEFORE EXECUTING--<font color=magenta>$query</font><br>";
        // после реального escape
	$result =dbs_query ($query,$connect,$dbtype);;
        IF ($result==false) { $errno=dbserr ();};
	if ($result==-1) { $errno=dbserr ();};
	if ($result>0) {
	if ($kosye==2) {  echo "<br>".cmsg ("WF_QUECOMP")." ".dbs_affected_rows ()." ".cmsg ("WF_Q1")."<br>"; }else { echo "";};//..Result sended.
	};
        if ($disableprint) unset ( $printing);
	if ($printing) {
		@$res1=dbs_list_fields ();
			echo "header unsupported<br>".$res1[0];
			echo "<font class=text><tbody><table id=execsql border=3 width=100% bordercolor=#602621 style=\" color: #".$rgbtext."; \" >";
			echo "<tr></tr>\n</tr>"; 
			while (@$myrow = dbs_fetch_row ($result,$dbtype))  // PRINTING IF SELECT USED!
										{
									//$mycols=mysql_list_fields ();
									//$res=mysql_num_fields($res1);
										for ($a=0;$a<dbs_num_fields($result);$a++)
											{	echo "<td>".$myrow[$a]."</td>";	}
										$findrecords++; 
											echo "</tr>";
										}
			}
	if ($debugmode) if ($prauth[$ADM][42]) echo "Denywords skipped by SU rights:$deny<br>";
	return (dbs_affected_rows ());
}


function dbserr ()
{
    global $dbtype;
    if ($dbtype=="") return cmsg ("DBNOTSET");
    if ($dbtype=="mysql") return sqlerr ();
    if ($dbtype=="pg") return pgerr ();
    if ($dbtype=="ibase") return ibaseerr ();
    return sqlerr ();  //no type specified
}

function sqlerr ()
{
	global $silent;  // 1-тихий режим, нет сообщений  0 -расшифровки из mysql
	@$errno= mysql_errno ();// 2 - расшифровки сервисом  не нужно
	@$error= mysql_error ();
	if (!$silent) if ($errno>0) echo "<red><bb>".cmsg("ERROR!")."</bb></red><br>".$errno." - ".$error."<br>";
/*	if ($silent==2) if ($errno>0) {		echo "<red><bb>";	if ($errno==1062) echo "Ячейка занята";	echo "</font><br></bb>";	} */
	return $errno;
}

function ibaseerr ()
{
	global $silent;  // 1-тихий режим, нет сообщений  0 -расшифровки из mysql
	@$errno= ibase_errcode ();// 2 - расшифровки сервисом  не нужно
	@$error= ibase_errmsg ();
	if (!$silent) if ($errno>0) echo "<red><bb>".cmsg("ERROR!")."</bb></red><br>".$errno." - ".$error."<br>";
	return $errno;
}

function ocierr ()
{
	global $silent;  // 1-тихий режим, нет сообщений  0 -расшифровки из mysql
	@$errno= "";// 2 - расшифровки сервисом  не нужно
	@$error= oci_error ();
	if (!$silent) if ($errno>0) echo "<red><bb>".cmsg("ERROR!")."</bb></red><br>".$errno." - ".$error."<br>";
	return $errno;
}

function pgerr ()
{
	global $silent;  // 1-тихий режим, нет сообщений  0 -расшифровки из mysql
	@$errno= pg_result_error ();// 2 - расшифровки сервисом  не нужно
	@$error= pg_result_error_field ();
	if (!$silent) if ($errno>0) echo "<red><bb>".cmsg("ERROR!")."</bb></red><br>".$errno." - ".$error."<br>";
	return $errno;
}


// кодирует каждый пробел в %20, а также добавляет префикс !H  добавить read - m7 - write - all vIDreq
// mixed preg_replace ( mixed pattern, mixed replacement, mixed subject [, int limit] )
function encodevID ($vID)
{
	$patterns[0]="/ /" ;$replacements[0]="%20";
	$vID=preg_replace ($patterns,$replacements, $vID);
	 $vID="!H".$vID; // echo "vID encoded as $vID<br>";
	return $vID;
}

// обратное действие
function decodevID ($vID)
{
	//echo "vID to decode  $vID<br>";
	if (($vID[0]==="!")AND ($vID[1]==="H")) { $vID[0]=" ";$vID[1]=" "; trim ($vID);
 	$patterns[0]="/%20/" ;$replacements[0]=" ";  // hex code \x25\x32\x30
	$vID=preg_replace ($patterns,$replacements, $vID);// echo "vID encoded as $vID<br>";
	}
	return $vID;
}


// желательно все часто употребляемые функции постепенно привести к такому виду
// (уменьшить число "суперфункций")
# получает массив mycol и имя которое надо в нем найти
# возвращает номер
// улучшенная версия дескрипторов удаляет необходимость в этой функции но она может использоватся.
function mycoltonumber ($mycol,$name)
{
	$mycols=count ($mycol);
	for ($a=0;$a<$mycols;$a++) { 
		$findid=strpos($mycol[$a],$name);
		//echo " 	$findid=strpos($mycol[$a],$name) === 	findid=strpos(mycol[$a],name); <br>";
		if ($findid!==false) return $a;
	}
	return false;
}

# получает массив mycol и номер который надо в нем найти
# возвращает имя
function numbertomycol ($mycol,$numb)
{
   	$name=$mycol[$numb];
	return $name;
}






function printfield ($data,$name) {
	
// выбор колонки из текущей базы - улучшенная версия модуля (contain)	
	// $name - передается имя для поля select
	// любое имя начинающееся с N переключит скрытый вывод списка заголовков на числа
// для корректного обновления баз SQL - лучше сделать дополнительный столбец после Plevel чтобы перевод мог сохранятся CFG OPT FUTURE  TODO:
	//global $presettedmode,$res16,;//	$ar=$selectedfield;
//	$datA добавлено т.к почти везде уже readdescripters работает
// соединение таблиц PLINK производится по названию отображаемому пользователю - напоминание.
//	added for function 1str
   global $mycols,$mycol,$prauth,$ADM,$mzdata,$field,$mznumb,$trafeconom;
$mycol=$data[0];$mycols=count ($mycol);$mzdata=$data[0];$mznumb=$data[2];$mzdata=$data[3];
if (!$trafeconom) $idadd=" id=\"".$name."\" ";
   //if ($name[0]=="n") {$numbmode=1; $name[0]="";}; // возможно вызовет проблему там где nfield вм field  xxx deleted
   if ($name[0]=="n") {$numbmode=1; $name=substr ($name,1);}; //nad vnesti v func возможно вызовет проблему там где nfield вм field
if ($name[0]=="_") {$numbmode=1; $name=substr ($name,1);}; //     echo $mznumb[3].$mycols; echo $res16; echo $a;
   if ($mycol[0]==false) { $mycol=$mzdata;$mycols=count ($mycol);}	// автоопределение CSV формата :)   size удален
$x="";  ?>	
		 <select <?php echo $idadd;?> name=<?php echo $name ; ?>> <?
	if ($prauth[$ADM][4]==0) 
	{		for ($a=0;$a<$mycols;$a++) {  $contain=$mycol[$a];// echo "ALARM!";lexit;
		 if (array_search ($a,$mznumb)!==false)
				 	if ($mycol[$a]==$field) {$sel="selected ";}else {$sel="";};
				 	 //echo $mycol[$a]."==".$field."<br>";
		//		 	 $x.="f".$a."==".$field."<br>";
			if ($numbmode) if ($a==$field) {$sel="selected ";}else {$sel="";};	 	 //echo "(field=$kol ";
		  if ($numbmode) echo "<option value=$a ".$sel.">".$contain.""; else
			 echo "<option value=$contain ".$sel.">".$contain."" ;//
		} 
	}
	if ($prauth[$ADM][4]==1)
	{		for ($a=0;$a<$mycols;$a++) { $contain=$mycol[$a];
				 	if ($mycol[$a]==$field) {$sel="selected";}else {$sel="";};
				 	//echo $mycol[$a]."==".$field."<br>";
		if ($numbmode) if ($a==$field) {$sel="selected ";}else {$sel="";};	 	 //echo "(field=$kol ";
		  if ($numbmode) echo "<option value=$a ".$sel.">".$contain.""; else
			 echo "<option value=$contain ".$sel.">".$contain."" ;//
		} 
	}
    echo "</select>";
	echo $buffer;
	//echo "x=".$x."endbuff<br>";
		return $field;
	//конец выбора колонки из текущей базы end
}

//±

function printcmp ($name){
?>
<select id=pcmp name =<?php echo $name ; ?>>
<option value=rawno>==
<option value=nerawno>!=
<option value=bolee>>>
<option value=menee><<
</select>
<?php
	return 1;
}


function groupdbdetect ($prdbdata) {
	$grouplist[]="Unsorted";
	$totalbas=count ($prdbdata)-1;
		for ($a=1;$a<$totalbas;$a++) {
			if ($prdbdata[$a][17]=="0") continue;
		if ($prdbdata[$a][17]!=="") $grouplist[]=$prdbdata[$a][17];
		}
	$grouplist=array_unique ($grouplist);
	$grouplist=array_values ($grouplist);	
	return $grouplist;
}

function groupdbfielddetect ($prdbdata,$fieldid) {
	$grouplist[]="Unsorted";
	$totalbas=count ($prdbdata)-1;
		for ($a=1;$a<$totalbas;$a++) {
			if ($prdbdata[$a][$fieldid]=="0") continue;
		if ($prdbdata[$a][$fieldid]!=="") $grouplist[]=$prdbdata[$a][$fieldid];
		}
	$grouplist=array_unique ($grouplist);
	$grouplist=array_values ($grouplist);
	return $grouplist;
}



//вывод списка групп. prdbdata - данные о выбранной базе, tbl - ее ID,  groupdb - текущая группа баз, nadpisx - название поля.
function groupdbprint ($grouplist,$nadpisx,$prdbdata,$tbl,$groupdb)
{	global $pr,$trafeconom,$groupdbthisname;		if (!$trafeconom) $idadd=" id=\"".$name."\" ";
        if (!$groupdbthisname) $groupdbthisname="groupdb";
	//print_r ($grouplist);echo"$groupdb=groupdb<br><br>";
	echo "$nadpisx <select $idadd name=\"$groupdbthisname\" size = ".$pr[2].">";
	for ($a=0;$a<count ($grouplist);$a++) {
		if ($grouplist[$a]==$groupdb) {$sel="selected";}else {$sel="";};//==prdbdata[$tbl][17]  groupdb - eto index!
		echo "<option value=\"".$grouplist[$a]."\" ".$sel.">".$grouplist[$a]."";
	}
	echo "</select>";
}


function printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,$resource,$nadpisx,$groupdb,$addfilter,$groupdbfield)
		{
	global $writefile,$pr,$trafeconom,$printalias;//  grouplist is used&&&???   removed after applying ipfilter is require!

        if (!$groupdbfield) $groupdbfield=17; // addfilter is groupdb2 renamed!!
	$totalbas=count ($prdbdata)-1;
	if (!$trafeconom) $idadd=" id=\"".$name."\" ";
  if ((count ($prdbdata))<3) { echo "<red>E_DB:Notning to connect.<br></red>"; return 0;};
echo "$nadpisx <select $idadd name = ".$resource." size = ".$pr[2].">";
	for ($a=1;$a<$totalbas;$a++) {
		if ($prdbdata[$a][0]=="") continue;
		if (($groupdb)) if ($groupdb!=="Unsorted") if ($prdbdata[$a][17]!==$groupdb) continue;
                if (($addfilter)) if ($addfilter!=="Unsorted") if ($prdbdata[$a][$groupdbfield]!==$addfilter) continue;
		if ($a==$tbl) {$sel="selected";}else {$sel="";};
		//echo "Your plvl=".$prauth[$ADM][10]." read=".$prdbdata[$a][14]." write=".$prdbdata[$a][13]."<br>";
	if (($printalias!=="name")AND($printalias!=="db+name")) {
            	if ($writefile==0) if ($prauth[$ADM][10]>=$prdbdata[$a][14]) {echo "<option value=$a ".$sel.">".$prdbdata[$a][1]."";}
		if ($writefile) if ($prauth[$ADM][10]>=$prdbdata[$a][13]) {echo "<option value=$a ".$sel.">".$prdbdata[$a][1]."";}
        }
	if ($printalias=="name") {
            	if ($writefile==0) if ($prauth[$ADM][10]>=$prdbdata[$a][14]) {echo "<option value=".$prdbdata[$a][5]." ".$sel.">".$prdbdata[$a][1]."";}
		if ($writefile) if ($prauth[$ADM][10]>=$prdbdata[$a][13]) {echo "<option value=".$prdbdata[$a][5]." ".$sel.">".$prdbdata[$a][1]."";}
        }//allows return name by printlink  //db+name allows return dbname.dbtable
        if ($printalias=="db+name") {
            	if ($writefile==0) if ($prauth[$ADM][10]>=$prdbdata[$a][14]) {echo "<option value=".$prdbdata[$a][9].".".$prdbdata[$a][5]." ".$sel.">".$prdbdata[$a][1]."";}
		if ($writefile) if ($prauth[$ADM][10]>=$prdbdata[$a][13]) {echo "<option value=".$prdbdata[$a][9].".".$prdbdata[$a][5]." ".$sel.">".$prdbdata[$a][1]."";}
        }
        // allows return name as field
		//если требуется редактирование уровень баз +1  
		} 
echo "	</select>";
	return ;
		}


function endtm ()
{ //считает сколько времени тратит скрипт на работу, выполняется автоматически.
	global $HeadTime,$verprogram,$pr;
	list($msec,$sec)=explode(chr(32),microtime()); 
if (!$pr[8]) echo "<br>[Dbscript core: $verprogram]<br>";
// Выводим время затраченное на выполнение скрипта // с 4 знаками после запятой (точки). 
echo "<br> ".cmsg ("ENDTMMSG")." ".round(($sec+$msec)-$HeadTime,4)." s.";
if(isset($_FILES["userfile"])) ob_end_clean() ;// SILENT CLEAN DATA IF FILE IS DOWNLOADED
}


######################################################################
  ##    $verfileio="Fileio v0.3.0 last partial version";         ##
######################################################################

## file io  is part of summator and dbscript project

//path - путь,  mask - список показ. масок,  protect - список запрещенных масок.<br>


/*При сохранении из textarea...
...нужно проверять get_magic_quotes_gpc(), например:
if (get_magic_quotes_gpc()) $settings = stripslashes($settings);
*/

function getdirdata ($path,$mask,$protect)
{
	global $prauth,$ADM,$sysreq;
$file=array();
 @$dir=opendir($path);

if (!$dir) { lprint ("F_IO_NODIR");return false;} ;
	for ($a=0;$d=readdir($dir);$a++)
	{
	if ($d===false) break;
	if (!is_array($mask)) {
		$file[$a][0]=$d;
		$file[$a][0]=maskapply ($d,$mask); 
	} else {
			$alwaysfalse=0;
			for ($c=0;$c<count($mask);$c++){
			$file[$a][0]=$d;
			$isdel=maskapply ($d,$mask[$c]); 
			if ($isdel==false) $alwaysfalse++;
			}
			if ($alwaysfalse==count ($mask)) $file[$a][0]=false;// mode or auto
	}
	if ($protect) { 
		for ($b=0;$b<count($protect);$b++){
			$testfile=$d;
			$testfile=maskapply ($testfile,$protect[$b]);
			if ($testfile==$d) $file[$a][0]=false;
		}
	}
	if ($sysreq!=1) if (($d==="fileio_hide")and(!$prauth[$ADM][14])) { lprint ("F_IO_HIDEDIR");return false;} ;
	if ($sysreq!=1)if (($d==="fileio_disable")and(!$prauth[$ADM][14])) { lprint ("F_IO_DISDIR");exit;} ;
	if (@opendir($path.$d)) $file[$a][1]=1;   //if directory this bit is on
	@$file[$a][2]=filesize($path."/".$d); // LINUx FIX MESSAGE
        @$file[$a][3]= date(filemtime($path."/".$d)); //date
        ///@$file[$a][3]= date("r", filemtime($path."/".$d)); //date
//	WARNING  MAYBE CREATE FOLDERS with LINUX names _local\scrcomm\skillline.datscr
	}
	closedir ($dir);
        //..asort ($file); // какого хера сортировки не видно
        //print_r ($file);exit;
return $file;
}

function maskapply ($filename,$mask){
	//echo "received command  maskapply ($filename,$mask) ";
if ($mask=="") return $filename; //'эта параша очищает поле из за вторго окна фмгр
if ($mask=="*.*") return $filename;
 $fileparts=explode (".",$filename);// нам надо только расширение
 $maskparts=explode (".",$mask);
 $a=count($fileparts);$b=count($maskparts);
 $extensionfile=$fileparts[$a-1];// berem ego
 $extensionmask=$maskparts[$b-1];
$namefilecutlen=strlen ($filename)-(1+(strlen ($extensionfile)));
$namemaskcutlen=strlen ($mask)-(1+(strlen ($extensionmask)));
 $namefile=substr ($filename,0,$namefilecutlen );// и отрезаем
 $namemask=substr ($mask , 0,$namemaskcutlen );
if ($extensionmask!=="*") if (@strpos($extensionfile,$extensionmask)===false) return false;
if ($namemask!=="*") if (@strpos($namefile,$namemask)===false) return false;
 return $filename;
 //конечно код намного больше чем glob() но не гавняется и делает дело


}

//не должна использоваться
function submitimg ($cmd,$name,$img) {
	$pid=substr ($name,strlen ($name)-1,1);if ($pid>0) $cmsgname=substr ($name,0,strlen ($name)-1);
	if ($pid==0) $cmsgname=$name;
 echo "<input name=\"".$name."\" type=image src=\"".$img."\" alt=\"".cmsg ($cmsgname)."\" title=\"".cmsg ($cmsgname)."\">";
}


 class download{

      var $properties = array(    'old_name' => "",
                                  'new_name' => "",
                                  'type' => "",
                                  'size' => "",
                                  'resume' => "",
                                  'max_speed' => ""
                                  );

      var $range = 0;

      function download($path, $name="", $resume=0, $max_speed=0){
   //echo "$path, $name=, $resume=0, $max_speed=0";exit;
         $name = ($name == "") ? substr(strrchr("/".$path,"/"),1) : $name;

          $file_size = @filesize($path);

          $this->properties =  array(
                                      'old_name' => $path,
                                      'new_name' => $name,
                                      'type'=> "application/force-download",
                                      'size' => $file_size,
                                      'resume' => $resume,
                                      'max_speed' => $max_speed
                                      );

              if ($this->properties['resume']) {

                  if(isset($_SERVER['HTTP_RANGE'])) {

                      $this->range = $_SERVER['HTTP_RANGE'];
                      $this->range = str_replace("bytes=", "", $this->range);
                      $this->range = str_replace("-", "", $this->range);

                  } else {

                          $this->range = 0;

                  }

                  if ($this->range > $this->properties['size']) $this->range = 0;

              } else {

                  $this->range = 0;

             }

      }


      function download_file(){

                  if ($this->range) {
                      header($_SERVER['SERVER_PROTOCOL']." 206 Partial Content");
                  } else {
                      header($_SERVER['SERVER_PROTOCOL']." 200 OK");
                  }
              header("Pragma: public");
              header("Expires: 0");
              header("Cache-Control:");
              header("Cache-Control: public");
              header("Content-Description: File Transfer");
              header("Content-Type: ".$this->properties["type"]);
              header('Content-Disposition: attachment; filename="'.$this->properties["new_name"].'";');
             header("Content-Transfer-Encoding: binary");

             if ($this->properties['resume']) header("Accept-Ranges: bytes");

              if ($this->range) {

              header("Content-Range: bytes {$this->range}-".($this->properties['size']-1)."/".$this->properties['size']);
              header("Content-Length: ".($this->properties['size']-$this->range));


              } else {

              header("Content-Length: ".$this->properties['size']);

              }

              @ini_set('max_execution_time', 0);
              @set_time_limit();
              $this->_download($this->properties["old_name"], $this->range);
      }

      function _download ($filename, $range=0)
      {
          @ob_end_clean();

          if (($speed = $this->properties['max_speed']) > 0)
             $sleep_time = (8 / $speed) * 1e6;
        else
            $sleep_time = 0;

          $handle = fopen($filename, 'rb');
       fseek($handle,$range);

         if ($handle === false)
          {
              return false;
          }

          while (!feof($handle))
          {
              print (fread($handle, 1024*8));
              ob_flush();
              flush();
              usleep($sleep_time);
        }

        fclose($handle);


        return true;
     }

   }

function xbasename ($file) {
    global $OSTYPE;
    $filename=substr ($file,0,strlen ($file)-strlen ($filename));
    if ($OSTYPE=="LINUX") $filename=strrchr ($file,"\\");
    if ($OSTYPE=="WINDOWS") $filename=strrchr ($file,"/");
    return $filename;
}


function onlypath ($file) {
    $filename=xbasename ($file);
    $onlypath=substr ($file,0,strlen ($file)-strlen ($filename));
    return $onlypath;
}
function sendfile ($file) {  // filepath must included ! file downloading!!
  global $sd,$prauth,$ADM;  //
 //ob_flush (); echo $file; exit; имя приходит нормальное.  UrlEncode(string $str) -setlocale('LC_CTYPE','cp1251'); FAILED
 @$download_size = filesize( $file );//tblname is refused ((   maybe check filesize in CFG OPT FUTURE  TODO:
 $setspeedlimit=$sd[37];
 if ($prauth[$ADM][56]) $setspeedlimit=$prauth[$ADM][56];
 //echo "setspeedlimit=$setspeedlimit";exit;
$filename=xbasename ($file);
$onlypath=onlypath ($file);  //  this is realpath function !!!!
 $check=@fopen ($file,"r") ; @fclose ($check);
 if (!$check) {lprint ("FILE_NOT") ;echo $file."<br>";die ("");}
   //echo "filename=$filename  fil=$file realpath= $onlypath";exit;  // print_r (get_class_methods(download)); //  print_r (get_class_vars(download));
       //$object = New download ($path, $name="", $resume=0, $max_speed=0);
       $object = New download ($file,$name=$filename, $resume=1, $max_speed=$setspeedlimit);
       //maxspeed  resume  CFG OPY FUTURE    as filesize
      // echo $object->name;
       $object->download_file ();
       exit;
}



function uploadfile ($uploaddir,$filename) {   // ,$limitsize,$limittypes,$enabletypes   затычка "any" убрать мусор
	if ($debugmode)echo "Upload file DEBUG MODE [on]<br>";
	global $OSTYPE,$dbs_ref,$pr,$prauth,$ADM,$redirecttoshare,$sd,$debugmode;
	$uploaddir=str_replace ("\\\\","\\",$uploaddir);  //kill kosye
	$uploaddir=str_replace ("\\\\","\\",$uploaddir);  //убиваем косые на всякий случай
	$uploaddir=str_replace ("\\\\","\\",$uploaddir);  //убиваем косые на всякий случай
	 if ($OSTYPE=="LINUX") $uploaddir=add_endslash ($uploaddir);
         if ($OSTYPE=="WINDOWS") $uploaddir=add_endslash ($uploaddir);// добавлено для WINDOWS / при заливке ключа терялась
         if ($debugmode) echo "Upl dir -$uploaddir";
		$tempname= $_FILES["userfile"]["tmp_name"];
//$tempsize=filesize ($_FILES["userfile"]["tmp_name"]) ;echo "размер временного файла:$tempsize <br>";// тоже 0 при >64k
//$temptype=mime_content_type($_FILES["userfile"]["tmp_name"]) ;echo "тип файла:$temptype <br>";// тоже 0 при >64k
        $userfile_name = $_FILES["userfile"]["name"];
        $userfile_size = $_FILES["userfile"]["size"];
        $userfile_type = $_FILES["userfile"]["type"];
        $error_flag = $_FILES["userfile"]["error"];
        $umaxfs=ini_get('upload_max_filesize');// не поверите добавил эти 4 строки в код и все заработало как надо
        $pmaxfs=ini_get("post_max_size");
      if ($codekey==6)  echo "upload_max_filesize=$umaxfs ; post_max_size=$pmaxfs<br>";
	$ext = substr($_FILES['userfile']['name'], 1 + strrpos($_FILES['userfile']['name'], "."));
	if ($pr[42]) $denied_ext=explode ($pr[42],",");
	if (!$prauth[$ADM][38]) $denied_ext[]="php"; else $denied_ext= array ();
        $ext=strtolower($ext);//$denied_ext=strtolower($denied_ext); это массив,его нельзя "уменьшить"
	if ($codekey!==6) if (in_array($ext, $denied_ext)) { echo "This type file not allowed. Неразрешенный тип файла для аплоада"; exit; }
	if (!$prauth[$ADM][51]) if ($pr[69]) if ($userfile_size>($sd[26]*1024*1024)) { echo "Size too big.Main profile.Dbscript side limit.";exit; }
        if ($prauth[$ADM][51]) if ($userfile_size>($prauth[$ADM][51]*1024*1024)) { echo "Size too big.User profile.Dbscript side limit.";exit; }
	 if (($_FILES['userfile']['name'])=="") return false; //не отвечаем на ошибочные вызовы
	  
 	
 	  //	 print_r ($_FILES);
 if ($filename=="original")$destinationfilename=$uploaddir.$_FILES['userfile']['name'];
 if ($filename!=="original") $destinationfilename=$uploaddir.$filename;
 $checkexist=is_readable ($destinationfilename);
 if ($checkexist) {  //механизм добавления параметра к уже существующему файлу
     $lasttochka=strrpos ($destinationfilename,".");

     for ($b=0;$b<100;$b++) { 
         $newdestfilename=substr ($destinationfilename,0,$lasttochka)."($b)".substr ($destinationfilename,$lasttochka,4);
         $checkexist2=is_readable ($newdestfilename);
        if (!$checkexist2) {$destinationfilename= $newdestfilename;break;} ;}
 }
  if ($debugmode) echo "destination filename=$destinationfilename<br>";  // как создавать файлы на русском языке через PHP??
  	 @$err=move_uploaded_file($_FILES['userfile']['tmp_name'], $destinationfilename);
	if (isset($_FILES["userfile"])) lprint ("F_SND");
	if (!isset($_FILES["userfile"])) lprint ("F_NO_SND");
        echo "<br>";
	if ($err) { 	echo cmsg ("F_HOSTED"); } else { echo ("F_NO_HOSTED");exit; }
if ($debugmode)	echo "<br>Destination point=".$destinationfilename."<br>";
 if ($error_flag==0) {
 	 $act="UPLOADED ".$destinationfilename;
 	 if ($pr[12])  logwrite ($act) ;
  if (!$pr[8]) print( cmsg ("F_S_NAME")." ".$tempname."<br>");
  			print(cmsg ("F_U_NAME").$userfile_name."<br>");
            //print ("Постоянный адрес файла на этом сервисе:"); // CFG OPT FUTURE  TODO:   InCONFIG
  if (!$pr[8]) print("MIME-filetype: ".$userfile_type."<br>");
  $filesizeinmb=round ($userfile_size/1024/1024);
            print(cmsg ("F_SIZE")." ".$filesizeinmb."Mb <br><br>");} else {
            echo "<br> ".cmsg ("E_MSG")." err=$err err_fl=$error_flag<br>"; };
if ($error_flag==1) { echo "UPLOAD_ERR_INI_SIZE  Размер файла слишком большой. Ограничение со стороны сервера.";exit;};
if ($error_flag==2) { echo "UPLOAD_ERR_FORM_SIZE Размер файла слишком большой. Ограничение программы.";exit;};
if ($error_flag==3) { echo "UPLOAD_ERR_PARTIAL  Загружаемый файл был получен только частично";exit;};
if ($error_flag==4) { echo "UPLOAD_ERR_NO_FILE Файл не был загружен.";exit;};
if ($pr[68]) {
    echo "</form><script language=\"JavaScript\">document.getElementByID(\"forma\").submit(go);</script>";
    echo "<form settimeout=\"forma\" onMouseover=\"forma\" href=\"javascript:document.getElementByID(\"forma\").submit(go)\"  action=filemgr.php>";
    submitkey ("go","SH_UPDD_FL"); // не удалось сделать переход для незарегистрированных на следующую вкладку по timeout 
    hidekey ("coreredir","SH_UPDD_FL");
    hidekey ("destinationfilename",$destinationfilename);
    hidekey ("filesizeinmb",$filesizeinmb);
    echo "</form>";


    //header ( "filemgr.php?"); ($cmd,$stroka,$path,$fileforaction,$mask,$pid

}//  nedodelano
if ($newdestfilename) return $newdestfilename;
	return $err;
}

 // function getlistfilesindir ($files,$mask,$nameselect,$) returns 
//./ $findid1=strpos($content,$vID1);} 
//объединение всех указанныx файлов соотв. маскам, и называние конечного $stroka
function joinfiles ($path,$mask,$protect,$stroka){ 
	global $pr,$OSTYPE;
if ($OSTYPE=="WINDOWS") if ((!$stroka)OR($stroka=="")) {$filetowrite="/result.dat";} else {$filetowrite="/".$stroka;};
if ($OSTYPE=="LINUX") if ((!$stroka)OR($stroka=="")) {$filetowrite="joined.csv";} else {$filetowrite="".$stroka;};
 $mask="*.*";
 $protect="*.php";
 echo cmsg ("F_IO_JOIN")."$filetowrite<br>";
 @unlink ($path.$filetowrite);
 $files=getdirdata ($path,$mask,$protect);
 	if (!$pr[8]) {echo "DEBUG Список обработанных файлов<br>";}
for ($a=0;$a<count ($files) ;$a++) {
	//echo $files[$a][0]."=".$files[$a][2]."<br>";
	if ($OSTYPE=="WINDOWS") $filename=$path."/".$files[$a][0];
	if ($OSTYPE=="LINUX") $filename=$path."".$files[$a][0];
	if (!$pr[8]) {echo "$filename<br>";}
	if ($filename===".") continue;
	if ($filename==="..") continue;
	if ($filename===false) continue;
	if ($files[$a][1]) continue;
	$readlink=fopen ($filename,"r");
	$b=file_get_contents ($filename); // зам на взятие целого файла
	$result.=$b;
//	echo "file $filename contain = ".$b."<bR><br>";
	}
	$wrlink=fopen ($path.$filetowrite,"w");
	fwrite ($wrlink,$result);
	fclose ($wrlink);

}




//ADDITIOn // удаляет непустой каталог
function kill_dir($dirname) 

{
  $dir = opendir($dirname);
  while ($file = readdir($dir))
  {
     $p = "$dirname/$file";
     if (is_dir($p)&&($file!="..")&&($file!=".")) 
     { 
        kill_dir($p);
     }
     else if (is_file($p))
     {
        unlink($p);
     }

  }
  closedir($dir);         
}


//показывает содержимое указаноой папки
function filesselect ($path,$mask,$protect,$nameselect,$regsz) {
			$files=getdirdata ($path,$mask,$protect);
					if ($files==false) echo "Folder not found.";;
		$buf="<form method=post>";
		$buf.="<select name=\"".$nameselect."[]\" multiple size=$regsz>";
		for ($a=1;$a<count ($files);$a++){  // ошибка в аналогичных процедурах - стоит не 1 а 2 или 3
				if ($files[$a][0]=="") continue;
				if ($regsz<10) $buf.="<option>".$files[$a][0]."";
				if ($regsz>9) $buf.="<option>".$files[$a][0]."(".$files[$a][1].")";
			}
			
$buf.="</select>";
if ($regsz>0) {echo $buf;}
 return $files;//unset ($files);

}



// если в конце пути нет слэша -- добавляет
function add_endslash($path)
{    global $OSTYPE;
    if ($OSTYPE=="LINUX") return (substr($path, -1) !== '/') ? $path.'/' : $path;
    if ($OSTYPE=="WINDOWS") return (substr($path, -1) !== '\\') ? $path.'\\' : $path;// добавлено из за незаливавшихся ибане ключей

}

// если в конце пути есть слэш -- убирает
function del_endslash($path)
{    global $OSTYPE;
    if ($OSTYPE=="LINUX") return (substr($path, -1) == '/') ? substr($path, 0, -1) : $path;
      if ($OSTYPE=="WINDOWS") return (substr($path, -1) == '\\') ? substr($path, 0, -1) : $path;// добавлено из за незаливавшихся ибане ключей

}

 //поиск в file или filetoaction строк. содержащих stroka с возможностью использовать логические И (&) , ИЛИ (+). сразу оба операнда - не принимает корректно.
 
function searchplus ($file,$filetoaction,$stroka) {

$array=array ();
$stroka=strtolower ($stroka);
if ($filetoaction=="NOPRINT") $retarray=1;
$filedesc=@fopen ($file,"r") ;
if ($filedesc==false) $filedesc=@fopen($filetoaction,"r") ; 
if ($filedesc==false) return false;

while ($filemassive[]=fgets ($filedesc,1280)) { echo "" ; } ;// массив 
if ($stroka==false) lprint ("F_NOSRCH")."<br>";
 $srchparts=explode ("+",$stroka);  // ili
 $srchparts2=explode ("&",$stroka);// i 
 if ($srchparts2>$srchparts) { $srchparts=$srchparts2;$mode="AND";};
//эта процедура умеет понимать нахождение сразу нескольких частей,было бы неплохо внедрить в ядро ее :)
// ищет по принципу или ; & - и не сделано
//array_search
 for ($a=0;$a<count ($filemassive);$a++) {
	$found=0;
	for ($b=0;$b<count ($srchparts);$b++) {
	 $findid=@strpos (strtolower ($filemassive[$a]),$srchparts[$b]);
	 if ($findid!==false)  $found++;
	 //if ($findid==false) $found=0; 
	 }
	 if ($mode=="AND") if ($found<count ($srchparts)) continue ;
	if ($found>0) if ($retarray!==1) { echo $filemassive[$a]."<br>";} else {$array[]=$filemassive[$a];};
	
}
return $array;

}

######################################################################
  ##    $verlibmyfile="Libmyfile v3.2.2 last partial version";     ##
######################################################################


#FUNCTIONS  JUST COPIED FROM UPDATE
# enter - descripter and type encoding  - support 2 styles old and new
# out - data contents with header,plevel,table  or old ver-header,oldtable,newtable (for conv)
#

function detectencoding ($string) {
if (preg_match('//u', $string)) { return "utf-8";} else { return "default";};
}

/* string mb_detect_encoding  (  string $str  [,  mixed $encoding_list = mb_detect_order()  [,  bool $strict = false  ]] )

Detects character encoding in string str .
*/
function simpleedit ($file,$limitsze)
	{
		global $codekey;
	global $pr,$prauth,$ADM,$go,$vd,$sd;
	if ($limitsze==0) {$limitsze=500000;}; // CFG OPT FUTURE  TODO: , NOW OFF
	if ($limitsze<0) {$limitsze=$limitsze*-1;$noexit=1;};
	 if ($go==cmsg ("SAVE"))
 {
	if (!$prauth[$ADM][10]) { lprint ("ACCDEN"); exit;};
	@$wr = fopen ($file,"w+"); 
	$act="$file edited"; 
	if ($wr==true) { echo cmsg ("FS_WR_OK")."<br>";} else { 
		$errt=cmsg ("FS_ERR"); $ermsg=cmsg ("FS_NODIR");//logwrite ($act) ;
				};
	$vd=stripslashes ($vd);
	@fwrite ($wr,$vd);  
	
    if ($pr[12]) {echo $act."<br>";	}; 
     logwrite ($act) ;
     echo "<br><br><br>";
     dispref ();
 }
	echo "File:$file";
	if (!$prauth[$ADM][10]) { lprint ("ACCDEN"); exit;};
	@ $wr = fopen ($file,"r");
	if ($wr==true) { echo "";} else { 	lprint ("FS_NEWFILE") ;};
	if ($go!==cmsg ("SAVE")) { @$vd=fread ($wr,$limitsze); @fseek ($wr,0);
	 //echo "<br>".cmsg ("-");
	echo "<form target=fileedit method=post>";
	hidekey("fileed",$file);
        $x=detectencoding($vd);
        echo "Encoded : ".$x."<br>?";
        if (($x!=="utf-8")AND($sd[19]=="utf-8")) $vd=iconvx("windows-1251","utf-8",$vd);
	echo "<textarea id=fileed name=vd cols=79 rows=25 >".$vd."</textarea><br>";
	submitkey ("go","SAVE");
	submitkey ("go","WF_UNDO"); echo "</form>";
 }
 if (!$noexit) exit;
 	} 

// xfgetcsv for unix - linux
function xfgetcsv ($filedescripter,$pgsize,$separator)
{		global $OSTYPE;

 if ($OSTYPE=="WINDOWS") {
 $result=@fgetcsv ($filedescripter,$pgsize,$separator);
 }
 if ($OSTYPE=="LINUX") {
		$zn=@fgets ($filedescripter,$pgsize);//LINUX FIX   выдает какую то чепуху.
		if ($zn==false) return false;
		$result=explode ($separator,$zn);
		//$cntres=count ($result);		//$lastznach=$result[$cntres-1];		 //$result[$cntres-1]=$lastznach;
	}
		return $result;
}




function readfullcsv ($filedescripter,$oldnew)
{	global $silent;		//$b;$b=0;
	global $filbas,$abort;
	
	if ($oldnew==="ZZOLD") { $oldnew="old"; $nocachetable=1;};// исп 1 раз для отключения преобразования ;
	$separator="¦"; if ($oldnew==="old") $separator=";"; 
					if ($oldnew==="comma") $separator=","; 
		$header=xfgetcsv ($filedescripter,$GLOBALS['xfgetlimit'],$separator); //OLDCORE

	if ($header==false) { if (($silent==0)AND($abort[0]==1)) {msgexiterror ("filenf",$filbas,"disable");} return -1 ;};
	$tableimpl=array ();
//	if (($oldnew==="old")AND(strpos("¦",$header)) {echo "Ваша версия конфигов уже обновлена.";exit;};
	$tableindexcnt=1;$table=array ();$table[0][0]="UNKNOWN";$table[0][10]="0";  // for compactiblity this start from 1
	if ($oldnew!=="old") {
	 $plevels=xfgetcsv ($filedescripter,$GLOBALS['xfgetlimit'],$separator);//oldcore
		}
	while (($table[$tableindexcnt-1][1]==true) OR ($table[$tableindexcnt-1][0]==true) OR ($table[$tableindexcnt-1][0]==="0"))	{  //decoding proc  from init
			$table[$tableindexcnt]=xfgetcsv ($filedescripter,$GLOBALS['xfgetlimit'],$separator);//oldcore
			
	if (($oldnew==="old")AND($nocachetable<1)) {
		$td=$table[$tableindexcnt];//echo "INDEX-$tableindexcnt-$td<br><br>";
		@$tableimpl[$tableindexcnt]=implode ($td,"¦"); // echo "container -- 
	}
	$tableindexcnt++;
	}// and lets go to packing data massive; 
	$dataout=array();
	if ($oldnew==="old") {	$dataout[1]=$table; $dataout[2]=$tableimpl; } else {
	$dataout[1]=$plevels;$dataout[2]=$table;	}
	$dataout[0]=$header;$dataout[3]=$tableindexcnt;
	unset ($table);unset ($tableimpl);// counter  общие данные
	return $dataout;
}


# detects extension of CFG FILE and return it   used for langpack
 function confdetect ($filbas) {
 	if (strpos ($filbas,"pages")!==false) $extenscfg="PGP_";
	if (strpos ($filbas,"langset")!==false) $extenscfg="LNP_";
	if (strpos ($filbas,"log")!==false) $extenscfg="LOG_";
	if (strpos ($filbas,"files")!==false) $extenscfg="FDP_";
	if (strpos ($filbas,"gmdata")!==false) $extenscfg="GMP_";
	if (strpos ($filbas,"dbdata")!==false) $extenscfg="DBP_";	
	if (strpos ($filbas,"deny")!==false) $extenscfg="DNP_";	
	if (strpos ($filbas,"macros")!==false) $extenscfg="MAC_";	
	if (strpos ($filbas,"style")!==false) $extenscfg="STP_";
        if (strpos ($filbas,"srvlst")!==false) $extenscfg="SRV_";
        if (strpos ($filbas,"cmdlines")!==false) $extenscfg="CMD_";
	return $extenscfg;
 }
	
 
 
 
##################################
##Pictogramm#
####################################
 
 function pictogramm ($imagefile,$link,$text) {
	echo "<a href=\"$link\"><img src=\""."_ico/$imagefile"."\" border=0 title='".$text."'><br>";
		echo "$text</a>";
}


##   userfolderopen "_conf/usr/
function userfolderopen ($name) {
global $fldup,$silent,$pr,$debug;

}
################################
# in - cfg or csvdb  mode  r or w or a   and abort type 1 if yes  no CAPS! add g for general settings
# out - descripter file only
# special using modes - delete,backup,restore - without parameters and copy-rename with parameter changes abort.
// сложная функция с разными режимами работы, аналогична командам fopen + дополнительные режимы:delete,backup,copy,exist,move,rename,restore.  Глобальность или локальность настроек определяют работу этой функции.


function csvopen ($configordbname,$mode,$abort)
{
	global $fldup,$silent,$pr,$debug,$debugmode;
	//Создание заголовков по умолчанию глобальными (мультиинст) - никак не обрабатывается !!!!  $pr[34]
	$locale="local";
	if ($abort[1]==="g") $locale="general" ; // parametes one for all   FOR DEMO- REMOVE 2 LINES!
	if ($pr[34]==true) $locale="general";
	@$filedescripter=fopen ($configordbname,"rb") ;// get data from sitedata (site)  //errormsg- disabled!!
        if ($filedescripter) $locale=""; //выключить переключение папки вверх если файл _УЖЕ _найден  4.1.77 новое изменение EXPErIMENTAL если будет глючить убратть
	if ($filedescripter) flock ($filedescripter, 3);
	$fileforaction=$configordbname;				$fileforcopy=$abort;//autoconfig for actions
if ($filedescripter==false) { 
		$configordbnamefldup=1;// будет потерян но это неважно т.к. подготовка записи тутже.
		 $fileforaction=$fldup."/".$configordbname;		 $fileforcopy=$fldup."/".$abort;//autoconfig for actions
	@$filedescripter=fopen ($fileforaction,"rb");// папка повыше   // b added  - может ли это вызвать баг?
       if ($filedescripter) flock ($filedescripter, 3);;// LOCK FIX
		 if (($filedescripter==false)AND($locale!=="general")) {  // по умолчанию параметры локальные  
				$configordbnamefldup=0;
				$fileforaction=$configordbname;				$fileforcopy=$abort;//autoconfig for actions
 if ($abort[0]==="1") msgexiterror ("init",$configordbname,"disable");}}
if ($mode!=="r") {
	if (strlen ($mode)>3) @fclose ($filedescripter);
	//if (strlen ($mode)>3) echo "fileforaction=$fileforaction,   fileforcopy=$fileforcopy<br>";
	//
	if ($mode=="delete") { $err=unlink ($fileforaction); }; //++
	if ($mode=="backup") { @unlink ($fileforaction.".backup.dat");
		$err=copy ($fileforaction,$fileforaction.".backup".date ("d.m.Y H-i-s").".dat");
		$err=copy ($fileforaction,$fileforaction.".backup.dat");
                logwrite ( "backup $fileforaction");
			};
	if ($mode=="copy") { $err=copy ($fileforaction,$fileforcopy); };
	if ($mode=="exist") { $err=file_exists ($fileforaction); };
	if ($mode=="move") { $err=copy ($fileforaction,$fileforcopy); $err=unlink ($fileforaction);};
	if ($mode=="rename") {@unlink ($fileforcopy) ;$err=rename ($fileforaction,$fileforcopy);};//++
        //echo "[debug]ubane UG :: rename: $err=rename ($fileforaction,$fileforcopy);<br>";
	if ($mode=="restore") { @unlink ($fileforaction);
            logwrite ( "restore $fileforaction");
		 @$err=copy ($fileforaction.".backup.dat",$fileforaction);	};  // убираем сообщение при неудачном восстановлении
	if ($err) { //всегда сообщает об ошибке?  удалено
		//if ($err==-1) echo "DEBUG error=$err locale=$locale<br>given command:csvopen ($configordbname,$mode,$abort)fullpath $mode ($fileforaction,$fileforcopy)<br>";
  		return $err;
	}
	@$filedescripter=fopen ($fileforaction,$mode);// если файла нигде нет создаст его локально.
        if ($filedescripter) flock ($filedescripter, 3); // LOCK FIX
		 if ($filedescripter==false) if ($abort[0]==="1") msgexiterror ("init",$configordbname,"disable");
			}	
	if ($debug==1) {
			echo "[DEBUG]fldup=$fldup locale=$locale configordbname=$configordbname fileforaction=$fileforaction abort=$abort fileforcopy=$fileforcopy ";
				if ($filedescripter==false) echo "NOT CONN";
				
			}
	//проверка на вшивость.
	return $filedescripter;// r w w+ a a+ b
}



#######################
// пишет в уже открытый канал филенаме все строки массива массивенаме  возвращает код последней вставки
function writefullcfg ($filename,$massivename)
{ global $OSTYPE,$writefullcfgdiscrwin; //задействована пост пока не трогать - фунция используется более высокоуровневой функцией.
	if ($filename==false) { echo "DB_CFG:File cannot be created<br>";return -1;}
	$counter=count ($massivename);
	// счас не работает тлко переборка с расширением из под линя   перевод строки как обычно и потеря данных.
	for ($a=0;$a<$counter;$a++)
		{ $dat=$massivename[$a];
	if (!$writefullcfgdiscrwin)	if ($OSTYPE=="WINDOWS") if ($a+1<$counter) $dat=$dat."\r\n"; //баг в инсталляторе!
	//	if ($OSTYPE=="LINUX") if ($a+1<$counter) $dat=$dat."\n";  //bug with GMDATA  pustye stroki  FIXED?
		if ($dat!=="") $b=fwrite ($filename,$dat); //echo "w $massivename[$a]<br>";
				};
		return $b;
}


###получает линк на файл от csvopen и производит запись данных из памяти
## на выводе - мессага о ошибке только
function writefullcsv ($filedescripter,$header,$plevel,$massive) {
	global $dbs,$OSTYPE,$debugmode,$testlinuxlinefeed;
//	if ($debugmode) {echo "DEBUG WRITING ALL ENTERED DATA!!!<br> "; // еще раз доказано что writefullcsv не для Линукса писан
    //debugcfgprint ($header,$plevel,$massive); - внимательно следить за наличием правильных хедеров при записи - без них сбоит!
//  echo "</font>КОНЕЦ АНАЛИЗА writefullcfg ()<br>";//	}  отключил т.к. работает.
  // печатать в режиме кк есть мб поможет разобраться т.е соединить все в массив с :  
  // ЗЫ 3 . почему каждый раз когда пытаюсь написать новую функцию с использованием этой получаю на выходе херню?
	$separator="¦";	if ($dbs=="3.x") $separator="¦";
	if ($dbs=="2.x") $separator=";";
	if ($filedescripter==false) { echo "DB_CSV:File cannot be created<br>";return -1;}
	$rewrite=array (); 
	 $rewrite[]=implode ($header,$separator); //if ($OSTYPE=="WINDOWS")
	//if ($OSTYPE=="LINUX") $rewrite[]=implode ($separator,$header);  //BUG Message from DMA 20'06'08
	 @$rewrite[]=implode ($plevel,$separator);//if ($OSTYPE=="WINDOWS")
	//$cnt=1;$cntmax=count ($massive); REMOVED   cnt--stroke
	
for ($stroke=1;$stroke<count($massive);$stroke++) {    // imploding
		//if ($OSTYPE=="LINUX") $a=implode ($separator,$massive[$cnt]);		//$tojoin=$massive[$stroke];
		@$a=implode ($massive[$stroke],$separator);//if ($OSTYPE=="WINDOWS")
		if ($testlinuxlinefeed) if ($OSTYPE=="LINUX") $a=$a."\n"; // Perewod stroki teryetsya ne tut//TEST MAY FIX BUG WITH TEST LINKS AND CAUSE BUG CONF EDIT
		//leaving THIS line is runs dblinker (remove bug) and adds some bugs in another places
		// echo $a."<br>"; possible error  msg with cfg user r	
		//if ($massive[$cnt]==false) break; WIN OK
        // и даже при внедрении files.cfg я снова был направлен багами сюда... не странно ли?
	//	if ($OSTYPE=="LINUX") { $a.="$separator\n";}  вызывал баг при сохранении ГМ конфига.
	//if ($debugmode) {echo "<font color=brown>rewrite(stroke=$stroke)=";print ($rewrite[$stroke]);echo "</font><br>";	}
		$rewrite[]=$a; 
		};
		
		//for ($a=0;$a<$cnt+1;$a=$a+1)		{ 	 //echo "$a=".$rewrite[$a];		}		//echo "<h6>";		print_r($rewrite);echo "</h6>";
		// тут произошла потеря при сохранении модифицированного gmdata через admin.php
		$b=writefullcfg ($filedescripter,$rewrite);
	if ($b===false) echo "<red>Write failure..$a</red><br>";
	return $b;
		}




//		csvmod ($file,$act,$values,$vID,$vID2) - подфункция, модификация таблицы CSV
//vID - это основой и виртуальный (второй) ID,  values - значения,  act - режим работы (edit,del,add) , file - целевой файл базы. 

function csvmod ($file,$act,$values,$vID,$vID2)
{ global $prdbdata,$tbl,$cfgmod,$crc,$crcignore,$md2column,$filbas,$OSTYPE;
$virtualid=$prdbdata[$tbl][15]; //echo "function csvmod ($file,$act,$values,$vID,$vID2) global $prdbdata,$tbl,$cfgmod,$crc,$crcignore,$md2column,$filbas;"; $file - ??
//if ($virtualid==$md2column) $virtualid++;  // fix error with same ids      temp not used   why? 
	fseek ($file, 0,SEEK_SET);
	while (!feof($file))
	{ @$originaldata[]=fgets ($file,15000); //echo $a - это весь файл
   };
   fclose ($file); 	
	$moddeddata=array ();// файл полностью в памяти в привычном формате
	$moddeddata[0]=$originaldata[0];	$moddeddata[1]=$originaldata[1];
// поиск указанного значения w massive   tests
$start_count=2;
if ($vID2=="NO_HDR") {$start_count=0;$vID2="";};
for ($cnt=$start_count;$cnt<count ($originaldata);$cnt++) {
	$moddeddata[$cnt]=$originaldata[$cnt];// уничтожаем для экономии памяти
    $nowline=explode ("¦",$originaldata[$cnt]);// это и есть данные для проверки

  if ($act=="edit") {
	if ($vID2==="") if ($nowline[$md2column]==$vID) {
	  	if (!$crcignore) { $crcnew=crc32(trim ($originaldata[$cnt]));
		if ($crcnew!=$crc) {lprint ("WF_CRCFAIL");  exit;} ;}; //crc32testfunction	
		$moddeddata[$cnt]=$values; 
		$undodata=$originaldata[$cnt];
		}
		
	
	if ($vID2!=="") if (($nowline[$md2column]==$vID)AND($nowline[$virtualid]==$vID2)) {
	  	if (!$crcignore) { $crcnew=crc32(trim ($originaldata[$cnt]));
		if ($crcnew!=$crc) { lprint ("WF_CRCFAIL"); exit;} ;}; //crc32testfunction
		$moddeddata[$cnt]=$values;  
		$undodata=$originaldata[$cnt];
		}
 }


 if ($act=="del") { //echo "nowline id1=".$nowline[$md2column]."nowline id2=".$nowline[$virtualid]."<br>;";
	if ($vID2==="") if ($nowline[$md2column]==$vID) $moddeddata[$cnt]="";
	if ($vID2!=="") if (($nowline[$md2column]==$vID)AND($nowline[$virtualid]==$vID2))  $moddeddata[$cnt]="";
	$undodata=$originaldata[$cnt];
 }
 
 if ($act=="add") {
 	if ($vID2==="") if ($nowline[$md2column]==$vID) { echo cmsg ("ZN")." $vID ".cmsg ("EXIST");exit;}
	if ($vID2!=="") if (($nowline[$md2column]==$vID)AND($nowline[$virtualid]==$vID2))  {echo cmsg ("ZN")."$vID-$vID2 ".cmsg ("EXIST");exit;};
        $undodata="DELETE IT";
 } // эффект был при DELETE_IS_REQUIRED - для масс замены перепроверить все.
 //тут какая то ошибка  myrowid почему то принимается - раз
 // во вторых новое значение все таки создается при комментировании - два - сейчас вроде недействительно.
  // три  просмотр почеум то не видит последние добавления после удаление - удаляет 

$originaldata[$cnt]="";



}
 if ($act=="add") $moddeddata[]=$values; 
//действие по $act 

//for ($a=0;$a<count ($moddeddata);$a++) {	echo $moddeddata[$a];}
//echo "Breakpoint 140 ";exit;
   	if (!$cfgmod) @$file=csvopen ("_data/".$filbas,"w","0");
	if ($cfgmod==1) @$file=csvopen ("_conf/".$filbas,"w","0");
for ($a=0;$a<count ($moddeddata);$a++) {
	$moddeddata[$a]=stripslashes ($moddeddata[$a]);//добавлена защита от косых
	fwrite ($file,$moddeddata[$a]);
	$moddeddata[$a]="";//tut mojno dly ekonomii pamyati dob    
}
	fclose ($file);
	$action=strtoupper($act);
	$act=$action."_DAT B $tbl (id,vid:$vID,$vID2) to $values";
        
	undolog ($act,$undodata,$tbl,"");
//	if ($pr[12]) {	echo "NEW CORE $act <br>";	logwrite ($act) ;};

}


//допустимые команды  addafter,addbefore,del,modify   fieldexch can= emptystroke to fill only heade
//поля  field  fieldexch  - номера колонок для действий  params - новой колонки
function structsql ($action,$field,$fieldexch,$params) {
	global $prdbdata,$tbl,$sd,$dbtype;// для коннекта
	global $views;// для показа текса запроса
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],"mysql");
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);  //добавлено недавно 11.09.2
	$res1=@mysql_list_fields ($prdbdata[$tbl][9],$prdbdata[$tbl][5]);
	$countsresult=@mysql_num_fields($res1); 
	  if ($countsresult===false) { //if (!$silent)
	 echo "E_DB: SQL_LINK_".$prdbdata[$tbl][5]."_NOT_CONNECTED!<br>";return -1;
		};
		for ($i = 0; $i < $countsresult; $i++) {
			   $flags[]=mysql_field_flags($res1, $i);
			   $fieldlen[]=mysql_field_len($res1, $i);
			   $mycol[]= mysql_field_name($res1, $i) ;
			   $datatypos[]= mysql_field_type ($res1, $i) ;
		}
	$newname=$params[0];
	if ($params[1]=="prototype") { $newlen=$fieldlen[$fieldexch];
								$newflags=$flags[$fieldexch];
								$newflags="";
								$newdatatype=$datatypos[$fieldexch];
	}
	if ($params[1]!=="prototype") {$newlen=$params[1];
								$newflags=$params[2];
								$newdatatype=$params[3];
	}
	$cmdadd=" $newdatatype ";
    if ($newlen)	$cmdadd.="($newlen)";
	$cmdadd.=" $newflags ";
	$addtablename=$prdbdata[$tbl][9].".";//не исп.
	if ($action=="modify") $cmd="ALTER TABLE `".$prdbdata[$tbl][5]."` CHANGE COLUMN `".$field."` `".$newname."` ".$cmdadd." ;";
	if ($action=="addafter") $cmd="ALTER TABLE `".$prdbdata[$tbl][5]."` ADD COLUMN `".$newname."` ".$cmdadd." AFTER `".$field."` ;";
	if ($action=="addbefore") $cmd="ALTER TABLE `".$prdbdata[$tbl][5]."` ADD COLUMN `".$newname."` ".$cmdadd." BEFORE `".$field."` ;";
	if ($action=="del") $cmd="ALTER TABLE `".$prdbdata[$tbl][5]."` DROP COLUMN `".$field."`;";
	 if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
	$result=dbs_query ($cmd,$connect,$dbtype);

	return $result;
}


//допустимые команды  addafter,addbefore,del,exch   fieldexch can= emptystroke to fill only header
//поля  field  fieldexch  - номера колонок для действий  newname - имяновой колонки
function structdat ($action,$field,$fieldexch,$newname) {
	global $prdbdata,$tbl,$cfgmod; // а куда без этогоо :)  дата должен быть прочитан дескриптором
	// a для чего лишняя переменная? $data,
	$filbas=$prdbdata[$tbl][0];
	rfsysdatareq ();// определения для системных заголовков
	echo "операция с $filbas";
	if ($cfgmod!==1) {	$fre=csvopen ("_data/".$filbas,"r","0");} else { $fre=csvopen ("_conf/".$filbas,"r","0") ;};
	if ($fre==false) die ("Unable to connect $filbas");
	// млять опять требуется какое то разрешение, почему я вообще должен его спрашивать... permission denied мля ппц
	if ($cfgmod!==1) {	$fwr=@csvopen ("_data/".$filbas."tmp.cfg","delete","0");
						$fwr=csvopen ("_data/".$filbas."tmp.cfg","w+","0");
						} else { 
						$fwr=@csvopen ("_conf/".$filbas."tmp.cfg","delete","0") ;
						$fwr=csvopen ("_conf/".$filbas."tmp.cfg","w+","0") ;
						};
	if ($fwr==false) die ("Unable to connect $filbas temp");
	;
//	while (($z=xfgetcsv ($fre,4024,"¦"))!==false) { // $sfre -is error?
for ($stroke=0;$z=xfgetcsv($fre,$GLOBALS['xfgetlimit'],"¦");$stroke++) { //azooglerus а тоже саме  10 строк пропускает и типа занято!  вообще странно? - есть 2 кода перевода строки
//$z=explode ("¦",$zx);
for ($a=0;$a<count ($z);$a++) { 
//	echo chr ($z[$a]);  // тест находящий потерянный энтер  может потом добавить строку?
	if (($z[$a]=="/n")OR($z[$a]=="a")) echo "Возможная ошибка:enter обнаружен в строке $stroke, не может быть обработан.<Br></font>";
}  // ТУТ ИДЕТ РАБОТА!
	if ($z===false) break;
//		echo "print all $z !!! :  ";print_r ($z);
//$stroke++;
if (($fieldexch=="emptystroke")AND($stroke>1)) $newname="¦";
		if ($action=="exch") { 	
			$tmpfieldexch=$z[$fieldexch];	
			$tmpfield=$z[$field];
			$z[$fieldexch]=$tmpfield ;
			$z[$field]=$tmpfieldexch;
			}
		if ($action=="addafter") {
			$z[$field]=$z[$field]."¦".$newname;
		}
		if ($action=="addbefore") {
			$z[$field]=$stroke.$newname."¦".$z[$field];
			echo "<red>$stroke</red> $z[$field]<br><bR>";print_r ($z);
		}
		if ($action=="del") {			unset ($z[$field]);		}
// echo "test  z1 = ".$z[0]."<br>";
	$values=implode ($z,"¦");
	if ($OSTYPE=="LINUX") $values.="\n";  // это добавление , не трогать... сначала редактирование.
        $values.="\n";
	fwrite ($fwr,$values);
	}
	fclose ($fre);
	fclose ($fwr);
	Echo cmsg ("SUC")." $stroke ".cmsg ("STROKE")."<br>"; //непонятная ошибка при работе с шапкой  0 строк обр.
		if ($cfgmod!==1) {	
			$fwrtm=@csvopen ("_data/".$filbas,"delete","0");
			$fwrtm=@csvopen ("_data/".$filbas."tmp.cfg","rename","_data/".$filbas);
			} else { 
			$fwrtm=@csvopen ("_conf/".$filbas,"delete","0") ;
			$fwrtm=@csvopen ("_conf/".$filbas."tmp.cfg","rename","_conf/".$filbas) ;
			};
	if ($fwrtm==false) die ("Не удалось сохранить изменение структуры в $filbas");

}

 


##register globals=on   start working
// example  $pageenter=getvar ('p');

function getvar ($p){
$name=$p;	if ( isset($_POST[$p]) || isset($_GET[$p]) )
{
	$p = ( isset($_POST[$p]) ) ? $_POST[$p] : $_GET[$p];
}
//echo "$p=".${p}."<br>";
 if ($p==$name) return false;  //  она возвращает пустышку но не удаляет переменную  фиксимюю..
//if ($p==$name) { unset ${$name};};
return $p;
}


// функция для поиска по базе значения по одной колонке и получения его по другой
// в варианте realid возвращается реальный ID строки в базе а не значение другой колонки
// srchrealid - returns a DATABASE data from idsrch
function getidbyid ($DATABASE,$idsrchcolumn,$idrescolumn,$string)
{
for ($a=0;$a<count ($DATABASE);$a++){
    //echo "$a realid=!".$DATABASE[$a][$idsrchcolumn]."=String $string<br>";
		if ($idrescolumn=="realidcontain") if (strpos(("!".$DATABASE[$a][$idsrchcolumn]),$string)==true) return $a;
                if ($idrescolumn!=="realid") if ($DATABASE[$a][$idsrchcolumn]==$string) return $DATABASE[$a][$idrescolumn];
		if ($idrescolumn=="realid") if ($DATABASE[$a][$idsrchcolumn]==$string) return $a;
                if ($idrescolumn=="srchrealid") if ($a==$string) return $DATABASE[$a][$idsrchcolumn];
	}
    return false;
}


//function returns tbl ID for existing alias string - is name or id return
function gettblidfromdbandtable ($DATABASE,$databasename,$tablename,$string)
{
for ($a=0;$a<count ($DATABASE);$a++){
                if ($string=="name") if (($DATABASE[$a][9]==$databasename)AND ($DATABASE[$a][5]==$tablename)) return $DATABASE[$a][0];
                if ($string=="name1") if (($DATABASE[$a][9]==$databasename)AND ($DATABASE[$a][5]==$tablename)) return $DATABASE[$a][1];
	        if ($string=="id") if (($DATABASE[$a][9]==$databasename)AND ($DATABASE[$a][5]==$tablename)) return $a;
	}
    return false;
}


/*
 *   $x=explode (".",$tablesource); // разделяем базу данных на базу и таблицу
  $databasedef=$x[0];
  $tabledef=$x[1];
Дети Зимы - Они пришли за мной.

В старом забытом храме Господнем
где солнца луч коснется их судьбы
сотни ангелов поднебесных вздымают крылья ,из пустоты
Шелест крыльев под куполами, взмах руки над алтарем.
Те кто видел своими глазами, навек уснули мертвым сном

Они пришли за мной
Они кружатся рядом
И манят за собой
Своим печальным взглядом
Мне не остаться здесь, я знаю это точно
Ведь ангельская сеть, свита довольно прочно

Смерти моей никто не узнает, никто не услышит послений мой вздох
Смерть свою я не отрицаю,ведь Божие слово - это закон
Так дайте же мне проститься с миром, в котором я , так недолго прожил
Так дайте же мне простится с теми кого на земле , грешной любил?

Аура  - Солнце Весна. 50%

 * я зарницы?? дождя, на ярком стекле
 * ты не помнишь меня лишь далеко
 * о тень даль в облаках,  вол гонит прочь
 * может, услышишь зов в эту ночь
 *
 * даже я такой Меченный судьбой
 * *** ???ночи без сна
 * лишь тебя зову,лишь тебя я жду,
 * лишь тебя зову, лишь тебя я жду,
 * ***?? ты моё Солнце -Весна
 *
 * что?*????????????????
 * что сделать хотел , не ***  ведь ?????????????????
 * пусть *** шагну во тьме,
 *  только укрыл этот путь в тениве ?*
 *
 *---
 * ***??
 * Солнца дни опротивятся тебе
 * Сохранишь ли ты **
 * Твоя любовь
 * Моя любовь (3)
 * <?php ob_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<?php $x=($_SERVER['HTTP_REFERER']);
    $xx=strpos ($x,"u-mangos.ru");
//echo "x=$x  xx=$xx<br>";
if ($xx>0) { ob_clean (); header ("Location: http://dj.chg.su/dbscript"); exit;}
ob_flush ();
?>
 * 
*/

function gensqldirecteditwhere ($mycol,$myrow,$mycols) {
    /*echo "suka mycols=$mycols<br>";
    echo "suka count mycol ".count ($mycol)."<br>"; // suka 1 vsegda delaet toko urod*/
        for ($a=0;$a<$mycols;$a++) {
        if ($firsttime2) $directeditwhere.=" AND ";  // ?
        $directeditwhere.=" ".$mycol[$a]."='".$myrow[$a]."' ";
        $firsttime2=1;
        
             }
             return $directeditwhere;
}

function gensqlupdate ($table,$header,$from,$to) { //no WHERE part
            $updatecmd="UPDATE $table SET ";
            global $counterediteddata;
          //echo "suka count mycol header ".count ($header)."<br>"; // suka 1 vsegda delaet toko urod
            for ($a=0;$a<count ($header);$a++) {
                  if ($from[$a]!=$to[$a]) {
                              if ($firsttime) $updatecmd.=",";
                              $updatecmd.=" ".$header[$a]."='".$to[$a]."' ";
                                $counterediteddata++;  $firsttime=1;
                      };
            }
    return $updatecmd;
}


	function gennohdlog ($tablename,$myrow,$mycols,$fields){
		$insertone="(";
		for ($a=0;$a<$mycols;$a++)
			{
		$insertone.="'$myrow[$a]'";
		if ($a!==($mycols-1)) $insertone.=",";//$mycol[$a]
			}
		$insertone.=")";
		return $insertone;
	}

	function gencmdlog ($tablename,$myrow,$mycols,$fields){
		$insertone="REPLACE INTO $tablename ".$fields." VALUES (";
		for ($a=0;$a<$mycols;$a++)
			{
		$insertone.="'$myrow[$a]'";
		if ($a!==($mycols-1)) $insertone.=",";//$mycol[$a]
			}
		$insertone.=");";
		return $insertone;
	}

        function gencmdlogi ($tablename,$myrow,$mycols,$fields){
		$insertone="INSERT INTO $tablename ".$fields." VALUES (";
		for ($a=0;$a<$mycols;$a++)
			{
		$insertone.="'$myrow[$a]'";
		if ($a!==($mycols-1)) $insertone.=",";//$mycol[$a]
			}
		$insertone.=");";
		return $insertone;
	}


//error messaging sample
//	$errmsg="MESSAGING:DESCRIPTOR_".$msg."_NOT_DEFINED_IN_".$languageprofile.".<br>";
//	if (!$pr[8]) echo "DEBUGERROR: ".$errmsg;  pr 8 - is DEBUG code!
//	errorlog ($errmsg);

function errorlog ($action)
{	$dbs_ip =$_SERVER['REMOTE_ADDR'];	$dbs_ref= $_SERVER['HTTP_REFERER'];
	global $prauth,$ADM,$pr;
	$usr=$prauth[$ADM][15]."(".$_SERVER['PHP_AUTH_USER'].")";
	//table format  dat;usr;ip;action;script started
	$str=date("d.m.Y H:i:s")."¦".$usr."¦".$dbs_ip."¦".$action."\n";
		$w=csvopen ("_logs/errorlog.dat","a+",1);
                // добавить данные для dbs_error_log
	if ($w==false) {@mkdir ("_logs");
	$w=csvopen ("_logs/errorlog.dat","a+",1);}
		  { 		  @$a=fwrite ($w,$str);		  @fclose ($w);
		  }
		  $cmsgerr=strpos ($action, "_NOT_DEF_IN");
  if (!$cmsgerr) if (!$pr[8]) {echo "DEBUGERRORLOG::".$action."<br>";}
		  return $a;
}

function undolog ($action,$restoreaction,$baseID,$hostIP)
{	$dbs_ip =$_SERVER['REMOTE_ADDR'];	$dbs_ref= $_SERVER['HTTP_REFERER'];
	global $prauth,$ADM,$pr,$sd;
        $prefix=$sd[30];
	$usr=$prauth[$ADM][15]."(".$_SERVER['PHP_AUTH_USER'].")";
	if (strpos($dbs_ref,"dj.chg.su")!==false) $dbs_ref="local";
        if (strpos($dbs_ref,"127.0.0.1")!==false) $dbs_ref="local";
	//table format  dat;usr;ip;action;restoreaction
	$str=date("d.m.Y H:i:s")."¦".$usr."¦".$dbs_ip."¦".$action."¦".$restoreaction."¦".$baseID."¦".$hostIP."¦";
        $str=str_replace ("\n","<cr_lf>",$str);//enabling change \n to <cr_lf>
        $str=str_replace ("\r","<R>",$str);//enabling change \n to

        // добавить данные для dbs_sql_undo_log
        $str.="\n";
		$w=csvopen ("_logs/undolog.dat","a+",1);
	if ($w==false) {mkdir ("_logs");
	$w=csvopen ("_logs/undolog.dat","a+",1);}
		  {		  @$a=fwrite ($w,$str);		  @fclose ($w);  
		  }
                  if ($pr[82]) {
      logwritesql ("_dbs_".$prefix."_undo_logs",$datecurrent,$usr,$dbs_ip,$action,$restoreaction,"",$baseID,$hostIP,"");
                  }
//  if (!$pr[8]) {echo "DEBUGUNDOLOG_".$str."<br>";}
		  return $a;
}

// undo 
// add -> delete     delete or edit -> edit\replace
// mass change - edit\replace changed col and id+vid
// mass copy - write all possible data to backup table sql server or dbscript
// если удастся проверить какие данные пойдут и в каком режиме возможно удастся упростить



###rewrite cfg end###

## sample of classic reading file -   WARNING - WITH PHP MEMORY <8Mb MAY BE FAILED
##   @$pages=csvopen ("_conf/pages.cfg","r",0);$data=readfullcsv ($pages,"new");
##	 $pgheader=$data[0];$pgplevel=$data[1];$pgcontent=$data[2];$pgcnt=$data[3];

## sample of classic writing file
##   @$tempdescr=csvopen ("_conf/gmdata.cfg","w",1);
##   writefullcsv ($tempdescr,$gmheader,$gmplevel,$prauth);
##
## module update end?


######################################################################
  ##    $verlogwrite="Logwrite v1.0 last partial version";      ##
######################################################################
// Данная программа относится к пакету DBSCRIPT v1.8 (с) dj--alex
// Входяшие
// $act - текущее действие пользователя
// $errt  ermsg - сообщение об ошибке! - важно - оно будет записано
// ЗАПИСЬ ВНУТРЕННИХ ЛОГОВ
// для логов ошибок будет сделана другая функция с другим файлом.

function logwrite ($act)
		{
		global $pr,$sd,$dbs_ip,$dbs_ref,$actscnd,$addtologmonthyear,$baseID,$hostIP,$debugmode;
		$addtologmonthyear=true;//CFG OPT FUTURE  TODO:
                $prefix=$sd[30];
	if (strpos($dbs_ref,"dj.chg.su")!==false) $dbs_ref="local"; //CFG OPT FUTURE  TODO:  SERVERSELF FILTER
	if (strpos($dbs_ref,"127.0.0.1")!==false) $dbs_ref="local";
	if (strpos($dbs_ref,"localhost")!==false) $dbs_ref="local";
	if (strpos($act,"log()")!==false) return;
	if (strpos($act,"EXECUTE")!==false) $executemod=1;
    if (strpos($act,"READ_M")!==false) $accessmod=1;
    if (strpos($act,"SHOW_PATCH_SQL")!==false) $accessmod=1;
    if (strpos($act,"SHOW PATCH SQL")!==false) $accessmod=1;
	//	$st = substr ($ip,0,7);  no subzones - unsupported - CFG OPT FUTURE  TODO:
		global $prauth,$ADM,$errt,$ermsg;
		if ($errt==true) { echo "<red><bb>".$errt."</bb></red><br>".$ermsg."<br>"; }
		if ($pr[21]) { 
			if ($sd[9]) {$dbs_ips_nolog=explode (",",$sd[9]);// пример разбивки массива по запятым,быстрый
			//print_r ($dbs_ips_nolog);
			if (in_array($dbs_ip, $dbs_ips_nolog)) return 0; } //  пока любые типы
			if ($sd[25]) {$logskipcmd=explode (",",$sd[25]);// пример разбивки массива по запятым,быстрый
	//	echo "act=$act";print_r ($logskipcmd);
			//if (in_array($act, $logskipcmd)) {echo "nashel ept!"; return ;} ;  SUKI BLYA NE DODELALI in_Array stroki ne obrabatyvaet (php5)
	  for ($a=0;$a<count ($logskipcmd);$a++) {// echo "strpos($act, ".$logskipcmd[$a]."=---<br>"; 
	  if (strpos($act, $logskipcmd[$a])!==false) return;} ;//  пока любые типы
		

			} //  пока любые типы

			};
			@$shost=gethostbyaddr($REMOTE_ADDR);
			$pw=$_SERVER['PHP_AUTH_PW'];
			$usr=$prauth[$ADM][15]."(".$_SERVER['PHP_AUTH_USER'].")";
		// встроить указатель модуля и данные улучшить , т.к глобальные все равно юзаются база 3(кричеры) наприм
		// table format   dat;usr;ip;host;action;referer
                $datecurrent=date("d.m.Y H:i:s");
			$str=$datecurrent."¦".$usr."¦".$dbs_ip."¦".$shost."¦".$act.$actscnd."¦".$dbs_ref."¦".$baseID."¦".$hostIP."¦";
                        if ($debugmode) if (!$pr[8]) {echo "DEBUGLOG_".$act.$actscnd."<br>";}
			if ($errt==true) {$finalerrormessage="!!ERROR!!:".$errt."=".$ermsg; $str=$str.$finalerrormessage; }
                        
                        $str=str_replace ("\n","<cr_lf>",$str);//enabling change \n to <cr_lf>
                          $str=str_replace ("\r","<R>",$str);//enabling change \n to
        		$str=$str."\n";
	// if ($addtologmonthyear) $addict="_".date("m.Y");    cannot be enabled to logs,undologs  - filename unsupported logger system
	// if ($addtologmonthyear) $addict="_".date("Y"); CFG OPT FUTURE  TODO:
 	$logtblname="_logs/log".$addict.".dat"; 
 	if ($executemod==1) $logtblname="_logs/execsqllog".$addict.".dat";
    if ($accessmod==1) $logtblname="_logs/access".$addict.".dat";

	$w=csvopen ($logtblname,"a+",1);
	if ($w==false) {@mkdir ("_logs");
	$w=csvopen ($logtblname,"a+",1);}
	  {		  @fwrite ($w,$str);  @fclose ($w);		  }
 if ($pr[82]) { /*$silent=1;
     	@$connect=dbs_connect ($pr[43],$sd[14] , $sd[17],"mysql");
        if ($connect)  {*/
//     echo "ebuchij execmod=$executemod  accessmod=$accessmod prefix=$prefix _dbs_".$prefix."_logs";
            if (($executemod==false)AND($accessmod==false)) logwritesql ("_dbs_".$prefix."_logs",$datecurrent,$usr,$dbs_ip,$shost,$act.$actscnd,$dbs_ref,$baseID,$hostIP,$finalerrormessage);
            if ($executemod==1) logwritesql ("_dbs_".$prefix."_exec_logs",$datecurrent,$usr,$dbs_ip,$shost,$act.$actscnd,$dbs_ref,$baseID,$hostIP,$finalerrormessage);
            // добавить данные для dbs_exec_sql_log
            if ($accessmod==1) logwritesql ("_dbs_".$prefix."_access_logs",$datecurrent,$usr,$dbs_ip,$shost,$act.$actscnd,$dbs_ref,$baseID,$hostIP,$finalerrormessage);
        //}
            // добавить данные для dbs_access_log
            //undolog add later?  can undo use mysql ? ^)
        }

        
}


//КОНЕЦ ЗАПИСЬ ВНУТРЕННИХ ЛОГОВ


//Дублирование лога в Mysql и функции поддержки и проверки.

function detectmysqlencoding ($tablename,$connect) {
        global $dbtype;
        $query="SHOW CREATE TABLE `$tablename`;";
        $silent=0;$result=dbs_query ($query,$connect,$dbtype);
        $myrow = dbs_fetch_row ($result,$dbtype);
        $charsetaddr=cutpartstroke ($myrow[1],"DEFAULT CHARSET="," ");
        return $charsetaddr;
        }
        

//отрезает часть строки между двумя фразами.
function cutpartstroke ($stroka,$do,$posle) {
$a1=strpos ($stroka,$do)+strlen ($do);
$a2=strpos(substr($stroka,$a1),$posle) ;
$res=substr ($stroka,$a1,$a2);
return $res;
}
//DEFAULT CHARSET=   esli nado smenit -/*!40101 SET NAMES koi8r */;


function detectrequirementID2 () {  // CFG OPT FUTURE  TODO:
 echo "Table have too many lines linked to ID and you must set ID2 column or correct any ID column address. Also you can enable directedit for alias.";
 return;
}

function checklogsql () {
    global $pr,$sd,$debug,$silent;
      $silent=1;
    if (!$pr[82]) return false ;         // CFG OPT FUTURE  TODO: disables script using checklogssql
    //if (!$pr[43]) {
        if ($debug) { errorlog ("DEBUG checklogsql:Connection failure. Default host not set or SQL off. trying 127.0.0.1.");       $pr[43]="127.0.0.1";        }
$dbtype="mysql";
    	@$connect=dbs_connect ($pr[43],$sd[14] , $sd[17],$dbtype);
	if ($connect==false) {  errorlog ("DEBUG checklogsql:Connection failure. Default host lost. $pr[43]");return false;}
        $mysqlanswer=1;
        $prefix=$sd[30];
        $query="SHOW CREATE TABLE `dbscriptbk`.`_dbs_".$prefix."_logs`;";
        $silent=0;$e=dbs_query ($query,$connect,$dbtype);
        if ($e==true) $mysqlanswer=true;
        if ($e==false) { echo "initalizing tables..._dbs_".$prefix."_logs...";
        	$query="CREATE DATABASE IF NOT EXISTS `dbscriptbk`;";
	$a=dbs_query ($query,$connect,$dbtype);
        if ($a==false) dbserr ();
	$query="CREATE TABLE `dbscriptbk`.`_dbs_".$prefix."_logs` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT,`datecurrent` text NOT NULL, `usr` text NOT NULL, `dbs_ip` text NOT NULL, `shost` text NOT NULL, `act` text NOT NULL, `referal`text NOT NULL, `baseID` text NOT NULL, `hostIP` text NOT NULL, `error` text NOT NULL,PRIMARY KEY (`id`));";
	$a=dbs_query ($query,$connect,$dbtype);
        $query="CREATE TABLE `dbscriptbk`.`_dbs_".$prefix."_access_logs` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT,`datecurrent` text NOT NULL, `usr` text NOT NULL, `dbs_ip` text NOT NULL, `shost` text NOT NULL, `act` text NOT NULL, `referal`text NOT NULL, `baseID` text NOT NULL, `hostIP` text NOT NULL, `error` text NOT NULL,PRIMARY KEY (`id`));";
        $a=dbs_query ($query,$connect,$dbtype);
        $query="CREATE TABLE `dbscriptbk`.`_dbs_".$prefix."_exec_logs` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT,`datecurrent` text NOT NULL, `usr` text NOT NULL, `dbs_ip` text NOT NULL, `shost` text NOT NULL, `act` text NOT NULL,  `referal`text NOT NULL, `baseID` text NOT NULL, `hostIP` text NOT NULL, `error` text NOT NULL, PRIMARY KEY (`id`));";
	$a=dbs_query ($query,$connect,$dbtype);
        $query="CREATE TABLE `dbscriptbk`.`_dbs_".$prefix."_undo_logs` ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT,`datecurrent` text NOT NULL, `usr` text NOT NULL, `dbs_ip` text NOT NULL, `action` text NOT NULL, `restoreaction` text NOT NULL,  `referal`text NOT NULL, `baseID` text NOT NULL, `hostIP` text NOT NULL, `error` text NOT NULL, PRIMARY KEY (`id`));";
	$a=dbs_query ($query,$connect,$dbtype);
//("_dbs_undo_logs",$datecurrent,$usr,$dbs_ip,$action,$restoreaction,"",$baseID,$hostIP,"");
        if ($a==false) { sqlerr (); $mysqlanswer=false;} else {$mysqlanswer=true;};
        // внимание записи ВСЕХ существующих копий дбскрипт будут попадать в эти базы- модификации названия таблиц и т.п. пока отсутствуют CFG OPT FUTURE  TODO:
## end of creating tables
        }
        return $mysqlanswer;

}

function logwritesql ($logtype,$datecurrent,$usr,$dbs_ip,$shost,$act,$dbs_ref,$baseID,$hostIP,$finalerrormessage) {
    //// задача - сохранить лог в sQl базе.
	global $dbtype,$pr,$sd,$debug;
        //echo $act;
        $silent=1;
        ini_set('magic_quotes_gpc', '0');
        if ($debug) echo "mqgpc=".get_magic_quotes_gpc();   // 1
        if ($debug) echo "mqrtm=".get_magic_quotes_runtime(); // 0
        if ($act=="") return false; // не слать пустые строки.
       
        // тут у нас где то размножаются косые и кавычки.
        //
        //## Если не созданы нужные таблицы то выполняется иначе пропускать
	$chk=checklogsql ();
        if ($chk==false) return false;
        $dbtype="mysql";
        $prefix=$sd[30];
        @$connect=dbs_connect ($pr[43],$sd[14] , $sd[17],$dbtype);
         $act=mysql_real_escape_string ($act);
        @$shost=mysql_real_escape_string ($shost); // dbs_ref -->shost    откуда тут локалхост выежает? закоментить нах
	if ($logtype!="_dbs_".$prefix."_undo_logs") $query="INSERT INTO `dbscriptbk`.`".$logtype."` (datecurrent,usr,dbs_ip,shost,act,referal,baseID,hostIP,error)VALUES ('$datecurrent','$usr','$dbs_ip','$shost','$act','$dbs_ref','$baseID','$hostIP','$finalerrormessage') ;";
        if ($logtype=="_dbs_".$prefix."_undo_logs")  $query="INSERT INTO `dbscriptbk`.`".$logtype."` (datecurrent,usr,dbs_ip,action,restoreaction,referal,baseID,hostIP,error)VALUES ('$datecurrent','$usr','$dbs_ip','$shost','$act','$dbs_ref','$baseID','$hostIP','$finalerrormessage') ;";
        //$query=mysql_real_escape_string ($query);
       //echo $query;
       //$e=mysql_query ($query,$connect);//,$dbtype);
	$e=dbs_query ($query,$connect,$dbtype);
        dbserr ();
 if (!$pr[8]) echo "DEBUG $query.<br>";
	return $a;
 }
// при редактировании использовать эту херню -  записывать только измененные значения , а не все подряд!  и в базу и в лог!
//end of duplicate mysql log

    // Функция экранирования переменных
function quote_smart ( $value )
{
    // если magic_quotes_gpc включена - используем stripslashes
if ( get_magic_quotes_gpc ()) {
$value = stripslashes ( $value );
}
    // Если переменная - число, то экранировать её не нужно
    // если нет - то окружем её кавычками, и экранируем
if ( ! is_numeric ( $value )) {
$value = "'" . mysql_real_escape_string ( $value ) . "'" ;
}
return $value ;
}

function showshortlog ()
{   $logtblname="_logs/access".$addict.".dat";
    global $activitycounter;
    echo cmsg(LOG_L_5)."<br>";
	@$w=fopen ($logtblname,"rt");
    if ($w==false) return;
    while ($a=@fgets ($w,1000)) {$countlog++;};
    //$countlog=count($w); // число строк в логе !!! не работает!
    
    fseek ($w,0);$a=0;
        while ($a<($countlog-5)) {fgets ($w,1000);$a++;};
    for ($a=0;$a<5;$a++) {
     $x=explode ("¦",fgets ($w,1000));
     echo " ".$x[1]." * ".$x[0]." ".$x[4]."<br>";
    }
   @fclose ($w);
   echo cmsg ("LOG_ALL")."$countlog<br>";
   echo cmsg ("CLICK").$activitycounter."<Br>";
 
}

// Образец для включения в програмы для записи логов
##	include "logwrite.php";		$pr=array(); $pr[8]=1;// отключаем вывод юзерам
##	$usr=$dbuser;$shost=$dbhost; 
##	global $pr;global $usr;global $shost;global $act; global $query;// глобализация
##	$ac8=$act; $act="EXECUTE:".$query; 
##	logwrite ();$act=$ac8;//  А ЗДЕСЬ МЫ ЛОВИМ ДАННЫЕ КОТОРЫЕ ЮЗЕР ОТПРАВИЛ


/*
 * запуск скрипта 1 раз в день или ежедневно
 * Вот примеры:
Код:
@daily /usr/local/bin/php file.php
@midnight /usr/local/bin/php file.php # то же, что и daily
0 0 * * * /usr/local/bin/php file.php


 */

######################################################################
  ##    $verscreen="Screen v3.1.5 last partial version";      ##
######################################################################

// Warning - OLD core function,   worked but resizing picture is not ideal
// 2- передавать не название команды а ее код - упростит задачу для больших ьаблиц
// Данная программа относится к пакету DBSCRIPT v1.8 (с) dj--alex
// RELATED to readfile module  and parts of dbselectedprint procedure

function screen ()
{
    	
        global $b,$commode,$pr,$prdbdata,$prauth,$needrights,$ADM; //added for test edit.gif  $k - deleted
	global $mode,$tbl,$vID,$scrcolumn,$needscr,$scrnum,$scrdir,$db,$filbas,$formatscr,$writefile,$md1column;
	global $myrow,$md2column,$oldvID,$trafeconom,$writeright,$cfgmod,$massoperscreen,$directedit;
        $directedit=$prdbdata[$tbl][22];
        //echo "блять да напиши жи те хоть что нибудь ! ".$prdbdata[$tbl][22]."<br>";    return;
    global $fildata;// для files.cfg  показ размера и удаление
	if ($oldvID==$vID) {return;};	// защита от повторной печати , гдето в др. функции ошибка
	$virtualid=$prdbdata[$tbl][15]; // virtual id
        if ($virtualid==$md2column) $virtualid++;  // fix error with same ids
        $directedit=$prdbdata[$tbl][22]; // почему то в упор не видит directedit
	$enablecbx=$prauth[$ADM][45];
        $scrc=$myrow[$scrcolumn];// fix for comment and imaging system
	if (($prdbdata[$tbl][12]=="fdb")AND($dbc[$md2column]=="")) { $dbc=$myrow ; };
rfsysdatareq ();// определения для системных заголовков  опять потерянные хз где
//..$writefile==1)
if (($prdbdata[$tbl][12]=="fdb")AND($prauth[$ADM][10]>=$writeright)) {	
	$fil=$tbl.";".$dbc[$md2column];
        if ($directedit) {$vID=implode ($dbc,"^^");
            if ($directedit==2) $vID=base64_encode ($vID);
            $fil=$tbl.";".$vID;
            }

if ($virtualid!==0) $fil=$fil.";".$dbc[$virtualid]; // вывод вторго ID если требуется
global $scriptpath;
if ($tbl=="files")
{
    if (file_exists ($dbc[5])){
        if (strlen ($dbc[14])>1) {$hashprint=$dbc[14];} else { $hashprint=$dbc[4];};
	$commstr="_ico/saveme.png";//.$dbc[$md1column]// возможная ошибка - не $dbc[0] а md2column  poprawil
echo "<td><a target=b3 href='$scriptpath?c=".$hashprint."'><img src=$commstr border=0 title='".cmsg ("FMG_DOWNLOAD")."'></a></td>";

$commstr="_ico/errorcritical.png";
$fileaddr=getidbyid ($fildata,4,5,$dbc[4]);
$fsizer="[".round (filesize ($fileaddr)/1024/1024,2)."Mb]";
echo "<td>".$fsizer ;//"гетид ($fildata,4,5,$dbc[4]) fileaddr=$fileaddr and size=".
if ($prauth[$ADM][2]==1) $dbc[12]="";
echo "<a target=b3 href='$scriptpath?c=".$hashprint."&d=a".$dbc[12]."'><img src=$commstr border=0 title='".cmsg ("PHYS_DEL")."'></a></td>";

}
else { $commstr="_ico/errorcritical-warningicon.png"; //     file size  file remove ability
   echo "<td><img src=$commstr border=0></a></td><td></td>";}

// функция для поиска по базе значения по одной колонке и получения его по другой
// в варианте realid возвращается реальный ID строки в базе а не значение другой колонки
// srchrealid - returns a DATABASE data from idsrch
//function getidbyid ($DATABASE,$idsrchcolumn,$idrescolumn,$string)

}


if ($cfgmod!==2) {
	$commstr="_ico/edit.png";//.$dbc[$md1column]// возможная ошибка - не $dbc[0] а md2column  poprawil
echo "<td><a href='w.php?write=".cmsg ("KEY_EDIT")."&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_EDIT")."'></a></td>";
$commstr="_ico/delete.png";//.$dbc[$md1column]
// возможная ошибка - не $dbc[0] а md2column  poprawil
echo "<td><a href='w.php?write=".cmsg ("KEY_DEL")."&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_DEL")."'></a></td>";}
}
if (($cfgmod==2)AND($tbl=="log")) {
 $skip=strpos ($dbc[4],"READ_M");
 $skip2=strpos ($dbc[4],"EXECUTE");
 $skip3=strpos ($dbc[4],"FILEMGR_CMD");
 
 $chto=substr ($dbc[4],0,40);
 $chtoulog=substr ($dbc[3],0,40);
 if (($skip===false)AND($skip2===false)AND($skip3===false)) {
		$commstr="_ico/undo.png";//.$dbc[$md1column]// возможная ошибка - не $dbc[0] а md2column  poprawil
		echo "<td><a target=b2 href='r.php?tbl=undolog&m=7&kol=3&vID=".$chto."'><img src=$commstr border=0 title='".cmsg ("WF_CANCSHOW")."'></a></td>";
		$commstr="_ico/undowarn.png";//.$dbc[$md1column]// возможная ошибка - не $dbc[0] а md2column  poprawil
		echo "<td><a target=b2 href='r.php?tbl=undolog&m=7&kol=0&vID=".$dbc[0]."'><img src=$commstr border=0 title='".cmsg ("WF_CANCSHOW")."'></a></td>";
 	}
}


if (($cfgmod==2)AND($tbl=="undolog")) {
	$commstr="_ico/linked_table-no.png";//.$dbc[$md1column]// возможная ошибка - не $dbc[0] а md2column  poprawil
echo "<td><a target=b3 href='w.php?write=".cmsg ("WF_UNDO")."&u0=".$dbc[0]."&u1=".$dbc[1]."&u3=".$dbc[3]."'><img src=$commstr border=0 title='".cmsg ("WF_UNDO")."'></a></td>";
}

//мешает  убирает кнопки с ссылок($writefile==1)
if (($prdbdata[$tbl][12]=="mysql")AND($prauth[$ADM][10]>=$writeright)) {	$fil=$tbl.";".$myrow[$md2column]; 
                                                                            if ($directedit) {$vID=implode ($myrow,"^^");
                                                                                    if ($directedit==2) $vID=base64_encode ($vID);
                                                                                    $fil=$tbl.";".$vID;
                                                                                    }

if ($virtualid!==0) $fil=$fil.";".$myrow[$virtualid]; // вывод вторго ID если требуется
$commstr="_ico/edit.png";
echo "<td><a href='w.php?cmd=ed&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_EDIT")."'></a></td>";
$commstr="_ico/delete.png";
echo "<td><a href='w.php?cmd=del&fil=$fil'><img src=$commstr border=0 title='".cmsg ("KEY_DEL")."'></a></td>";


}

if ($pr[24]==1) {
	 if ($prdbdata[$tbl][12]=="fdb") $myrow=$dbc;
	 $fil="tbl=$tbl&m=2&vID=".$myrow[$md2column]."";
	 if ($virtualid!==0) $fil=$fil."&vID2=".$myrow[$virtualid]; // вывод вторго ID если требуется
	$commstr="_ico/link.png";
if ($trafeconom) { echo "<td><a target=b1 href='r.php?$fil'><img src=$commstr border=0 title='".cmsg ("LINK")."'></a></td>";} else 
{ echo "<td><a target=blank1 href='r.php?$fil'> <img src=$commstr border=0 title='".cmsg ("SHOWONE")."'></a></td>";
}


}

 if ($cfgmod!==2)  if ($enablecbx) {	 $cbx="t".$myrow[$md2column]."";  //$bxt-
                                   if ($directedit) {$cbx="t".implode ($myrow,"^^"); }                                             // добавили директ едит
	 if (!$directedit) if ($virtualid!==0) $cbx=$cbx."+".$myrow[$virtualid]; // вывод вторго ID если требуется  fil --> cbx  +
	 echo "<td>";checkbox("","\"bx".$cbx."\"");echo "</td>";
  }

if ($commode==1) {echo "\n"; return ;}
if ($pr[8]==2) {

        
	$namebas=$prdbdata[$a][1]; 
	$scr=$scrdir."/".$scrc.$formatscr; // scrnum --> scrc
}
	if (($needscr==true)AND($formatscr)) 
		{ $scr=$scrdir."/".$scrc.$formatscr;
		 $scr="_local/scrcomm/".$scr;//  WARNING   IS NEEDED!!!!
			if ($mode<>4)
				{if (@fopen ($scr,"r")) {echo "<td><a href=\"$scr\"><img src=\"$scr\" border=0 height=80 width=60></a></td>";}
				// в будущем может займусь переразмеркой после корзины для покупок.счас ненужно
				// ecть js для увеличения картинки при наведении рульно
				
				}
			if ($mode==4)
				{if (@fopen ($scr,"r")) {echo "<td><a href=\"$scr\"><img src=\"$scr\" border=0 height=80 width=60></a></td>";} // CFG OPT FUTURE  TODO:!
				}
		}
   $comfile="_local/scrcomm/".$scrdir."/".$scrc.".txt";
    
   //echo " scrdir=$scrdir scr=$scr scrc=$scrc comfile .. $comfile";
		if ($scrdir!=="scr"){if (@fopen ($comfile,"r")) {
			echo "<br>";$comm=@file_get_contents ($comfile,"r");
			$dat=wordwrap (($comm),282,"\n");$commstr="_ico/commentfmg.png";
			echo "<td><a target=blank href='r.php?cm=1&nomnu=1&tbl=$tbl&scrc=$scrc&vID=$vID&m=0'><img src=$commstr border=0 title=\"".strip_tags ($dat)."\"></a></td>";}
			// или делать виспер или прикрыть ибо так оно не работает (dat)
					
		}
	
	//echo "\n\n";	//editor options//	echo $myrow[$md2column];
//end editor options//$oldvID=$vID;
	}

	
	

 function backupcfgs ()
 {
	global $codekey;
	if ($codekey==7) {echo "Public mode detected.Exit.";demo ();};
	$f=csvopen ("_conf/property.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_PR")."<br>";
 	 $f=csvopen ("_conf/sitedata.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_SD").cmsg ("A_BCK_CRT")."<br>";
 	 $f=csvopen ("_conf/gmdata.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_GM").cmsg ("A_BCK_CRT")."<br>";
	 $f=csvopen ("_conf/dbdata.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_DB").cmsg ("A_BCK_CRT")."<br>";
 	 $f=csvopen ("_conf/files.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_FL").cmsg ("A_BCK_CRT")."<br>";
         $f=csvopen ("_conf/filescript.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_FL").cmsg ("A_BCK_CRT")."<br>";
	 $f=csvopen ("_conf/denywords.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_DW").cmsg ("A_BCK_CRT")."<br>";
 	 $f=csvopen ("_conf/pages.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_PW").cmsg ("A_BCK_CRT")."<br>";
	 $f=csvopen ("_conf/styles.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_ST").cmsg ("A_BCK_CRT")."<br>";
	 $f=csvopen ("_conf/langset.cfg","backup",0); if ($f==1) echo cmsg ("A_BCK_LN").cmsg ("A_BCK_CRT")."<br>";
         $f=csvopen ("_conf/srvlst.cfg","backup",0);
         $f=csvopen ("_conf/cmdlines.cfg","backup",0);
?>	<form action=admin.php method=post>
<?php submitkey ("write","RETURN"); ?></form>
<?php
 }

 function restorecfgs ()
 {
	 $f=csvopen ("_conf/property.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_PR")."<br>";
 	 $f=csvopen ("_conf/sitedata.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_SD").cmsg ("A_BCK_REST")."<br>";
 	 $f=csvopen ("_conf/gmdata.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_GM").cmsg ("A_BCK_REST")."<br>";
	 $f=csvopen ("_conf/dbdata.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_DB").cmsg ("A_BCK_REST")."<br>";
 	 $f=csvopen ("_conf/files.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_FL").cmsg ("A_BCK_REST")."<br>";
         $f=csvopen ("_conf/filescript.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_FL").cmsg ("A_BCK_REST")."<br>";
	 $f=csvopen ("_conf/denywords.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_DW").cmsg ("A_BCK_REST")."<br>";
 	 $f=csvopen ("_conf/pages.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_PW").cmsg ("A_BCK_REST")."<br>";
	 $f=csvopen ("_conf/styles.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_ST").cmsg ("A_BCK_REST")."<br>";
	 $f=csvopen ("_conf/langset.cfg","restore",0); if ($f==1) echo cmsg ("A_BCK_LN").cmsg ("A_BCK_REST")."<br>";
         $f=csvopen ("_conf/srvlst.cfg","restore",0);
         $f=csvopen ("_conf/cmdlines.cfg","restore",0);
?>	<form action=admin.php method=post>
<? submitkey ("write","RETURN"); ?></form>
<?php

 }
 
 
	function autoexecsql ()
{ 
	global $sd,$msec;// global $sd,$msec;   // процедура при некторых непроверенных условиях неработ!"!
	
	$hostaexesql=$sd[15];
        $defaultsqlserver=$pr[43];// CFG OPT FUTURE  TODO: Optional use 
	$chastota=$msec*100;
	 if ($chastota>$sd[11]) return 0;
		$aexesql=@fopen ("_conf/autoexec.sql","r");
		if ($aexesql==false) return 0;
	while ($query=fgets ($aexesql,100000)) {
		$l=strrpos ($query,"#");$queryready=substr ($query,0,$l); //SQL_SRV_DEF pr43
                if ($queryready=="") $queryready=$query;
//обратная процедура чем в filemgr не оставляет хвост после \ а оставляет начало до №
// не хочет по нормальному выполнять строки с комментариями - будет по дебильному их выполнять.
	$dbtype="mysql";
        @$connect=dbs_connect ($hostaexesql,$sd[14] , $sd[17],$dbtype);
        if ($connect==false) {  errorlog ("Autoexecsql:Connection failure. Params:$hostaexesql,".$sd[14]."<br>");return false;}
	//echo "$queryready";
        if ($connect) @$result=dbs_query ($queryready,$connect,$dbtype);
	//echo "-----------------$queryready----------------------;";
	//if ($result==true)  {  $ok++;}	
	//if ($result==false) {  $error++;};
	};
	//dbserr ();	echo "<br>ok summary=$ok  error=$error <br>";
	fclose ($aexesql);
	if ($result==false) errorlog ("Autoexecsql:Result failure. To:$hostaexesql,".$sd[14]." Query:$queryready<br>");
	return $result;
}

// crash   part of dbscript
// script - is redirect to php

################################################
#   LAST VERSION INCLUDED FILE				####
#     $vercrash="Crash v3.2.1   dj--alex     ###
################################################



function msgexiterror ($type,$data,$script)
{
    global $file,$enterpoint,$prauth,$ADM,$sd,$pr,$codekey,$msgexitcalled,$openedwindows,$write,$go;
    $openedwindows++;
	$msgexitcalled=1;//return; какого хрена тут return делает ??????
	 $msgwindw=cmsg ("ERR_STD");
//registered messages types = формирование заголовка сообщения - требуется его передать в window ()
	 if ($type=="Special") 	$msgwindw=$script[2]; 
	 if ($type=="filenf") 	$msgwindw=cmsg ("ERR_RW");
	 if ($type=="I/O")		$msgwindw=cmsg ("ERR_IO");
	 if ($type=="notuser")	$msgwindw=cmsg ("ERR_AUTH"); 	
	 if (($type=="init")OR($type=="filenf")OR($type=="SQLdown")) $msgwindw=cmsg ("ERR_CRIT");
	 if ($type=="disabled") $msgwindw=cmsg ("DISABLED");
	 if ($type=="errorcfg") $msgwindw=cmsg ("ERR_CFG");
	if ($type=="SCP") $msgwindw=cmsg ("NOTIMPL");
	if ($type=="notrights") $msgwindw=cmsg ("NOTRIGHTS");
	if ($type=="nomodule") $msgwindw=cmsg ("NOMODULE");
	if ($type=="expire") { $msgwindw=cmsg ("EXPIRE");	}
	if ($type=="demo") $msgwindw=cmsg ("DEMO");
	if ($type=="trial") {$msgwindw=cmsg ("TRIAL");}
	if ($type=="update") $msgwindw=cmsg ("UPDATE");
	if ($type=="ban") $msgwindw=cmsg ("BANNED");
	if (($type=="key")or($type=="info")) $msgwindw=cmsg ("INFO");
	//end of registered messages types
$class="header";
if (($type=="notrights")or($type=="notuser")or($type=="nomodule")or($type=="expire")or($type=="ban")) $class="headerred";
if (($type=="outdatedfunc")or($type=="update")) $class="headeryellow";
if ($type=="demo") $class="headergreen";

	if ($data!=="noexit")  if   (($type!=="notfound")AND($type!=="nobest")AND($type!=="nocategory")AND($type!=="needcode") AND($type!=="limit")AND($type!=="lostvar"))//no window 
		 {
$script=array ( //  Для special режима иконка задаетс как параметр data
		'message' => "",				// сообщение
		'color' => $class ,
                'icon' => "" ,
      'mainheader' => $msgwindw);

window ($script , $action );
$windowopen=1;

//require_once ("windowmserr.php") ;
} //  width +20  left-20
	if ($data==="nomsg") { return;};
	 echo "</CENTER><br>";
	$warning="<img src=_ico/warning.png border=0 title=Warning>";
	$criterror="<img src=_ico/errorcritical.png border=0 title=Error!>";
	$info="<img src=_ico/info.png border=0 title=Notify>";

//сообщения и окна с выбором ТРЕБУЕТСЯ передавать с помощью другой функции!!!!
//	$dataerr=array (   Для special режима иконка задаетс как параметр data
//		0 => "Преобразование",	 		// заголовок  REMOVED!!!
//		1 => "Уже преобразован или таблица не нуждается в разделителях!",				// сообщение
//		2 => "Ошибка в процессе") ;
if ($type=="Special") 
	{ echo $$data;
	 $header1=$script[0];
	 $message=$script[1];
	echo $message;
        closewindow ();
	exit;
	}

  if ($type=="init") 
	{ echo "$criterror";	lprint ("CR_ERR_CFG");echo "$data!";lprint ("REQ_A");
	$errmsg="CR_ERR_CFG - $data $script";
	errorlog ($errmsg);
	}
	
  if ($type=="filenf") 
	{echo "$criterror";    lprint ("CR_ERR_RW");echo "$data!";lprint ("REQ_A");
	$errmsg="CR_ERR_RW - $data $script";
	errorlog ($errmsg);
	}

	  if ($type=="outdatedfunc") 
	{echo "$info";	lprint ("CR_OUTDATEDFUNC"); echo "$data!<br>"; lprint ("CR_CONT");
	}

  if ($type=="nomodule") //from libmysql
	{echo "$warning"; 	lprint ("YOUR_VER"); echo "($data),"; lprint ("CR_LIMIT1"); echo "<br><br>";
	lprint ("CR_ADDINF"); lprint ("CR_SITELINK");
	$errmsg="CR_LIMIT1 - $data $script";
	errorlog ($errmsg);
	}

  if ($type=="demo") //from libmysql
	{echo "$warning";	lprint ("CR_DEMO");echo "<br><br>";lprint ("CR_ADDINF"); lprint ("CR_SITELINK");
	}

	
	if ($type=="ban") //from libmysql
	{echo "$criterror";	echo "($data)"; 
	
	lprint ("WHY_BAN");echo "<br>";
	//echo "DEBUG name=".$prauth[$A';DM][0].". ban level".$prauth[$ADM][48];
	lprint (REASON_BAN);echo $prauth[$ADM][48];
	if ($prauth[$ADM][48]==="") lprint(DEFAULT_BAN);
	;echo "<br><br>";
	}
	

  if ($type=="expire") //from libmysql
	{echo "$warning";		lprint ("CR_HONOR"); echo "$script, ";
		lprint ("CR_EXPIRETOCONT");  echo "($data)"; lprint ("CR_TOAUTHOR");
		lprint ("TIP1"); echo "<br><br>";lprint ("CR_ADDINF"); lprint ("CR_SITELINK");
		echo "<input name=data value=\"client=$script msg=dbscript expire, order new key\"type=hidden></input>";
		 	$script="mailto:dj--alex@chtc.ru";// order online
		 	//$script="http://dj.chg.su/dbscript/";
	}

	  if ($type=="trial") //from libmysql
	{echo "$warning";global $daysleft;	echo cmsg ("CR_TRIAL1")." ".($daysleft)." ".cmsg ("CR_TRIAL2").$data.cmsg ("CR_TRIAL3");
	echo cmsg ("TIP1")."<br><br>".cmsg ("CR_ADDINF"); lprint ("CR_SITELINK");
	 	$script="http://dj.chg.su/dbscript/";
	}

	if ($type=="errorcfg")
	{echo "$warning";
echo cmsg ("CR_NE_OPT").$data.cmsg ("CR_NE_OPT2");$errmsg="UNKNMODE - $data $script";errorlog ($errmsg);
	}
	
  if ($type=="update") //from libmysql
	{echo "$warning".cmsg ("CR_LIM_NUPD")."<br><br>".cmsg ("CR_ADDINF"); lprint ("CR_SITELINK");
	}

  if ($type=="anonymous") 
	{echo "$info";
lprint ("CR_NEEDAUTH");
	echo "<CENTER><form action=login.php method=post><br>";
	submitkey ("vID","OK");	echo" </form></CENTER>";
	}
	
	
  if ($type=="notuser") 
	{echo "$criterror";
	lprint ("CR_INCLOGPASS");
	 if ($pr[36]=="on") lprint ("CR_RELOGININF");
	lprint ("CR_LOGINFAIL");
	 if ($pr[36]=="on") echo "<CENTER><form action=r.php?tbl=-2 method=post><br><input type=Submit name=vID value=Relogin></input></form></CENTER>";
	}
	


 if (($type=="cfgoldcrit")OR($type=="cfgoldwarn"))
	{echo "$criterror";
	echo cmsg ("CR_CFG_F")."$file".cmsg ("CR_CFG_F_OUTDATED");
		$errmsg="CFGERR - $data $script";
	errorlog ($errmsg);
	}

if (($type=="cfgnewcrit")OR ($type=="cfgnewwarn") )
	{echo "$criterror";
	echo cmsg ("CR_CFG_F")."$file".cmsg ("CR_CFG_F_NEW");
		$errmsg="CFGERR - $data $script";
	errorlog ($errmsg);
	}
	 


 if ($type=="SQLdown")  
	{echo "$criterror";
	echo cmsg ("SRV_SQL")."(".$data.")".cmsg ("SRV_SQL_E");
			$errmsg="SQLERR - $data $script";
	errorlog ($errmsg);
	}

	 if ($type=="key")  
	{echo "$info";
	echo $data;
	}





 if ($type=="SQLhack")  
	{echo "$warning";
	echo cmsg ("SQL_HACK_SYS").$data.cmsg ("ASK_ADMIN_DEL");
			$errmsg="SQLHACK - $data $script";
	errorlog ($errmsg);
	}

  if ($type=="denyword")  
	{echo "$warning";
	echo cmsg ("SQL_HACK_DWORD").": ".$data;
			$errmsg="DWORD_TRY - $data $script";
	errorlog ($errmsg);
	}
	
	  if ($type=="nologsedit")  
	{echo "$warning";
	echo cmsg ("LOGS_NOEDIT")."($data)";
	errorlog ($errmsg);
	}
	

if ($type=="notfound") //no window 
	{ print "$info<red><bb>".cmsg ("NOT_FOUND")."</bb><br></red>";
	echo cmsg ("SRCH_FAIL")."<br>";
	}

if ($type=="nobest") //no window 
	{	print "$warning<red>".cmsg ("ERR_CFG").".</bb><br></red>";
  echo cmsg ("BEST_FAIL").$data;
	}
if ($type=="notrights") 
	{	echo "$warning";
	echo cmsg ("PLVL_LOW_TAB")."<br> (".cmsg ("REQ")." $data).";
	}
if ($type=="notright") 
	{	echo "$warning";
	echo cmsg ("PLVL_LOW_MOD")."<br> $data";
	}
	
if ($type=="nocategory") //no window 
	{ print "$warning<red><bb>".cmsg ("INP_ERR")."</bb><br></red>";
	lprint ("NO_CAT");
	}
if ($type=="needcode") //no window 
	{print "$info<red><bb>".cmsg ("INP_ERR")."</bb><br></red>";
  echo cmsg ("INV_TYPE_NUMB");
	}
if ($type=="limit") //no window 
	{	print "$info<red><bb>".cmsg ("INP_ERR")."</bb><br></red>";
	echo cmsg ("LIM_FAIL")."<br>";
	}
if ($type=="SCP")
	{	echo "$criterror";
	echo cmsg ("UNKN_DB1")."($data).".cmsg ("UNKN_DB2");
	}
if ($type=="disabled")
	{	echo "$criterror";
echo cmsg ("RES_DIS");
	}
if ($type=="lostvar") // no window
	{print "$warning<red><bb>".cmsg ("INP_ERR")."</bb><br></red>";
  echo cmsg ("NO_DATA");
  }

 if (($type!=="notfound")AND($type!=="nobest")AND($type!=="notrights")AND($type!=="nocategory")AND($type!=="needcode") AND($type!=="limit")AND($type!=="lostvar")) if ($prauth[$ADM][1]==true) { echo "<br>".cmsg ("ENTERPOINT").": $enterpoint <br>".cmsg ("DIRECTIVE").": $write , $go <br>";};


//$script["script"]="getfile.php";
$msgscript=$script["script"];

//echo "ms=|".$msgscript;
 if ($msgscript!=="disable") {
     if ($mgsscript=="") $msgscript="login.php";
     echo "<CENTER><form action=".$msgscript." method=post><br>";
 //backkey();

 submitkey ("go","OK");
//require_once ("windowmserr.php") ; echo "</form><br></CENTER></div> ";

 echo "</body><html></div>";  // а зачем тут "тело?"  удаление строки ничего не меняет
 }
if ($windowopen==1) closewindow ();
//нужно уточнить когда закрыть окно!
 if (($data!=="noexit")AND($data!=="windowexit")) {echo "";exit(0);};   //  fixed  OR to AND
}

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

одну из этих функций надо переписать чтобы не было двух одинаковых  и лучше на осове window проэмулировать msgexiterror.


*/

function window ($script,$actions)
{global $sd,$msgexitcalled,$openedwindows;
$msgexitcalled=1;$openedwindows++;
  initwindowactions (0);
//	$sizetopic=$shriftsize;
	 //if ($shriftsize<4) $sizetopic=4;
	//if ($sizetopic==6) $changesize=2;	if ($sizetopic==4) $changesize=-3;
 //echo "<h".$sizetopic.">";
    	$warning="<img src=_ico/warning.png border=0 title=Warning>";
	$criterror="<img src=_ico/errorcritical.png border=0 title=Error!>";
	$info="<img src=_ico/info.png border=0 title=Notify>";
        //if (is_array ($script)!==true) echo "11";
	 $message=$script['message'];
 	 $icon=$script['icon'];
	 $mainheader=$script['mainheader'];
	 $color=$script['color'];
         if (!$script['color']) $color="header";
         $class=$color;
         $bgcolor=$script['bgcolor'];// некорректно отрабатывается
         if (!$script['bgcolor'])$bgcolor="unnamed1";
         $txtcolor=$script['txtcolor'];// некорректно отрабатывается
	 $noclose=$script['noclose'];
         if ($script['width']) $width=$script['width'];
         if (!$script['width'])$width="506";
         if ($script['top']) $top=$script['top'];
         if ($script['height']) $height=$script['height'];
         if ($script['left']) $left=$script['left'];
	 if ($color=="") $class="unnamed1"; //blue
	 if ($color=="blue") $class="unnamed1"; //blue
	 if ($color=="red") $class="headerred"; //blue
	 if ($color=="green") $class="headergreen"; //blue
	 if ($color=="yellow") $class="headeryellow"; //blue

require ("window.php") ;
if ($icon) echo $$icon;	
if ($message)	echo $message."<br>"; // not succesfully tested

	if ($actions) {
            if (is_array ($action)==true) foreach ($actions as $key => $value) 	{
		echo "<CENTER><form action=".$value." method=post><br> ";
		submitkey ("go",$key);echo "</form><br></CENTER> "; 
	}}
 return 0;
}

function closewindow () {  //echo "</h>";
    echo "</div>";return 1;}

//функции сокращенного вызова ошибки для разных версий
function needupdate () 
	{ 	msgexiterror ("update",$yourvrs,"main.php"); 	}

 function needupgrade ()
	{
	global $yourvrs;
	msgexiterror ("nomodule",$yourvrs,"main.php");
	}
//SYSTEM
 function expire ()
	{
	global $yourvrs,$registeredto,$daysleft;
	if ($daysleft=="unlimited") return -1;  //	$daysleft=$daysleft*-1;
	msgexiterror ("expire",$yourvrs,$registeredto);
}


//SYSTEM
 function nokeys ($a)
	{// в принципе уже 3 раза повтор есть можно и функцию закачки сделать))  окно для загр ключа и сообщения 
	global $deleteactive,$dbstyle3en;
	if ($deleteactive) lprint ("DELACTKEYMSG");
	?><div id="download" style="position:absolute; width:290; height:35px; z-index:1; left: 280px; top: 10px;" class=div>
	<?php lprint ("KEY_UPL") ;echo "<br>";
	/*checkbox ($deleteactive,"deleteactive"); lprint ("DELACTKEY");  короче хренотень здесь!!  именно эта процедура никуда ключ не посылает, а та соотв. уже не принимает.
	откуда то лишний FORM вылез и все испортил... */
	?><br></form>
	<form enctype="multipart/form-data" action="login.php" method="post">
	<input name=userfile type=file class=buttonS size=10 > 
	<input type=submit name=go value="Send key" class=buttonS>
	<input type="hidden" name="MAX_FILE_SIZE" value="1000">
	</form></div><?php
	if ($a==1) msgexiterror ("key",(cmsg ("KEY_NO")."<br>".cmsg ("KEY_NO_INF")),"login.php");
}


//SYSTEM
 function trial ()
	{
	global $yourvrs,$daysleft;
	if ($daysleft=="unlimited") return -1;  //	$daysleft=$daysleft*-1;
	msgexiterror ("trial",$yourvrs,$daysleft);
}


// Держитесь за свои болты и гайки,  пришло время технического обслуживания!

 function demo ()
	{
	msgexiterror ("demo",$yourvrs,"main.php");
	}

	//конец списка сокращенных функций
if (!$exitpoint) if(($prauth[$ADM][2]==false)AND(($prauth[$ADM][11]))) { msgexiterror ("ban",$prauth[$ADM][0],"login.php");exit;}

	// BSOD simulator
function bluescreen ($message)
{ global $enterpoint,$verprogram,$coreloadskip; //height=999; width:999;
if ($coreloadskip) {return "Fatal error:$message <br>";};
echo "</div></div></div><div id=\"bs\" style=\"position:absolute; font-family:Courier terminal;  z-index:4;  top:0; left:0; color: #FFFFFF ; background: #0000aF \">";
echo "<h2><style> body {color: #FFFFFF ; background: #0000aF;  } </style>";
echo "A problem has been detected. <br>Site shutdown to prevent damage data or users.<br>";
echo "<br>Next information can help you:<br>".$message."<br>";
echo "<br>If this is the first time you've seen this stop error screen,<br> restart your browser, if this screen appears again,<br> follow these steps:<br><br>Please check your actions with manual<br>If problem persist contact with site administrator or author<br>";
echo "<br>DBS Core:$verprogram<br> Enterpoint:$enterpoint";
echo "</h2></div><br>
<br>
<br>
";
if ($message[0]!=="_") exit;
}

function authenticate() 
	  {	global $pr;
if (($pr[38]=="on")OR((!$pr[38])AND(isset ($_COOKIE['dbsa'])OR(isset ($_SESSION['dbsa']))))) return 1;
   header('WWW-Authenticate: Basic realm="Dbscript zone"');
   header('HTTP/1.0 401 Unauthorized');
	return ;
  }
  
  
  		function testinfo () {
  			//for ($b=0;$b<100;$b++) {  				$a=rand (0,100);  				echo "$a<br>";  			};
  			$a=rand (0,100);
  			if ($a<77) return false; //ускорение проверки)
				global $languageprofile,$pr;
				//if ($pr[35]==true) return;
 				echo "<font color=black id=blkfnt>";
				$icon="info";//$message="message";
				$mainheader="Testing info";
				$script=array ( 'message'=>$message,'icon'=>$icon,'mainheader'=>$mainheader );
				$actions="";
		 		window ($script,$actions);
		 		if ($languageprofile=="russian") {
		 			echo "Просим оставлять ваши отзывы об этой программе на этом форуме.<br>";
		 			echo "Если у вас есть пожелание,сообщение о ошибке, любые вопросы касательно программы,";
		 		echo "Просто зарегистрируйтесь и оставьте сообщение в моем разделе Dbscript <a href=\"http://www.mangos.ru/forum/showthread.php?t=10970&page=2\">Mangos Forum</a></font>.";

		 		}
		 		if ($languageprofile!=="russian") {
		 			echo "Please if you want send bug report, or have a question about program, register";
		 			echo "on this forum, on my section Dbscript. If you don't want to see this message disable it in config-cp. ";
		 			echo "<a href=\"http://www.mangos.ru/forum/showthread.php?t=10970&page=2\">Mangos Forum</a></font>.";

		 		}
		 		closewindow ();
		// author ();
		
			}
			
			function demoinfo () {
			$a=rand (0,100);
  			if ($a<77) return false; 
  			testinfo ();
			}
			
		function showmemessages ($a) {
			for ($b=0;$b<$a;$b++)
			{ testinfo (); } 
		}

			
			
		
		function author () {
				global $languageprofile,$sd;
				$icon="info";//$message="message";
				$mainheader="About author";
				$script=array ( 'message'=>$message,'icon'=>$icon,'mainheader'=>$mainheader );
				$actions="";
		 		window ($script,$actions);
		 		if ($languageprofile=="russian") {
		 			$a="Автор программы: Фуфаев А.В. (aka Dj--alex)  Разработка:2006-2009<br>";
		 			if (($codekey==0)OR($codekey>6)) {$a.="Если вам нравится эта программа пожалуйста купите ее и\или сделайте пожертвование."; }
		 			else { $a.="Если вам нравится эта программа пожалуйста,сделайте пожертвование.<br>";};
		 			$a.="Мои кошельки Яндекс N 4100177805659, Webmoney  .<br>"; //.. Z777820755783,R207389102594
		 			$a.="Если вы хотите узнать подробнее обо мне - зайдите <a href=\"http://dj-alex.ru\"> сюда</a>.";
                                         if ($sd[19]=="utf-8") $a=iconvx("windows-1251","utf-8",$a);
                                         echo $a;

		 		}
		 		if ($languageprofile!=="russian") {
		 			echo "Author program: Fufaev A.V. (aka Dj--alex)   Developing:2006-2009";
		 			if (($codekey==0)OR($codekey>6)) {echo "If you like this programm, please buy it or\and create donate!"; }
		 			else { echo "I need a donations to make this program more useful! Please help me if you can.<br>";};
		 			echo "My Yandex-money N 4100177805659, Webmoney .<br>";
		 			echo "If you interest more info about <a href=\"http://dj-alex.ru\"> me</a>.";

		 		}
		 		closewindow ();
		 		exit;
			}

			
			
  function iniparse ($filec,$mode)
{
//$filec = ;// TEST - must delete after end//$mode=0; // TEST - must delete after end


## mode 0 - просто загружает переменные без отображения 
## mode 1 - просто загружает переменные c простым отображением 
## mode 2 - выдает отображение формы с конфигурацией  - не сделано +макет сохранения
## mode 3 - получение отредактированных данных из формы и запись - не сделано
## 1х тоже самое , ini
## 2х тоже самое , scp
## out - выдает в качестве значения массив
## ; - будут проигнорированы полностью при исп. стандартной функции

// подготовка и чтение текущей конфигурации
if ($mode>10) {$rmv=1;$mode=$mode-10;};
if ($mode>10) {$rmv=2;$mode=$mode-10;};
if ($mode<3) {
if ($rmv<1) { $filereq = $filec;} ;
if ($rmv==1) { $filereq = $filec.".ini" ; };
if ($rmv==2) { $filereq = $filec.".scp" ; };// файл конфигурации указан всегда без ini,  wowemu
$filetmp = $filec.".pre";
$c="";
$readdata=file($filereq) ;
$writetmp=fopen($filetmp,"w") or die ("_INIPARSER_CANNOT_CREATE_TEMP_FILE");
$k = count($readdata) ; $a=0;
while ($a<$k) {
	echo " ";
//	echo $a."--".$array[$a]; ;// выдача "в чистом виде" для тестов
	$a++;	
	$b=$readdata[$a];
    if (strpos ($b,"//")===false) {
		$c=$c.$b ; continue; 
		}
	}
$c=$c.$d;
//echo "RESULT DELETING - $c";echo "ENDING RESULT";
@fwrite ($writetmp ,$c); 
@fflush ($writetmp);
@fclose ($writetmp);
// Разобрать без разделов

// модуль примитивного показа
//$ini_array = parse_ini_file($filetmp);

//print_r($ini_array);

// Разобрать с разделами

$ini_array = parse_ini_file($filetmp, TRUE);

if ($mode==1) { print_r($ini_array); };

 
##UNSUPPORTED
if ($mode<2) return ($ini_array); 
//echo $ini_array[RealmServer][Host]; - образец
  //  модуль визуального показа  ini - относится к первому блоку
 if ($mode==2) {
	 echo "_INIPARSER_NOT_IMPLEMENTED__AUTOFORM";
	 return ($ini_array); 
 }
}

##UNSUPPORTED
//  модуль редактирования ini - относится к отдельному блоку
if ($mode==3) {
echo "_INIPARSER_NOT_IMPLEMENTED__EDITOR";
	return 0;
//сохранение ini файла
$input = "";
$arr = array ($a);
// Только для записи БЕЗ КАТЕГОРИЙ
foreach( $arr as $k => $v )
 {  $input .= $k . " = " . $v . "\n";  }
// Только для записи C КАТЕГОРИЙ
foreach( $arr as $ck => $cv )
 {
  $input .= $ck . "\n";

  foreach( $cv as $k => $v )
   {  $input .= $k . " = " . $v . "\n";  }
 }
// Записываем как обычный файл
$f = fopen( "test.ini" , "w+" );
fwrite( $f , $input , strlen( $input ) );
fclose( $f );
}
echo "_INIPARSER_INCORRECT_DEFINED_MODE";
 return 0;
}




function debugcfgprint ($hdr,$plvl,$dbcontent) {
echo "=============DEBUGCFGPRINT===================<br> "; // еще раз доказано что writefullcsv не для Линукса писан
 echo "<br> <font color=blue id=bfnt>HEADER<BR>"; for ($a=0;$a<count ($hdr);$a++) {echo $hdr[$a]."¦";
 //	echo "HDR B=0<br><br>";for ($b=0;$b<strlen ($hdr[$a]);$b++) {
 		//echo "ind(b)=$b,a=$a)=,ascii=".$hdr[$a][$b].",code=".ord($hdr[$a][$b])."<bR>";
 	//}  //процедура покодового вывода 
 }
 echo "</font><br> <font color=gray id=dfnt>PLEVEL<BR>" ; for ($a=0;$a<count ($plvl);$a++) {echo $plvl[$a]."¦";;}
  echo "</font><br> <red>DATA(MASSIVE)<BR>" ;   //print_r ($massive);
if (is_array ($dbcontent)) {
		for ($stroke=0;$stroke<count($dbcontent);$stroke++) { echo "<br>STROKE $stroke<br>";
		for ($a=0;$a<count ($dbcontent[$stroke]);$a++) {
				//echo "($a]=".;
			echo $dbcontent[$stroke][$a]."¦";
		
		} }
}
echo "</font>=====================================<br>";
		//end debug out
}

// как сделать переборку заголовка
// 2 массива - один новый другой старый
// из них собирается третий сначала но названиям второго но местам первого,  (если они есть в первом конечно же)
//а потом уже доставляются новые элементы из первого


	function removecr ($c) {
		global $debugmode;
	for ($b=0;$b<strlen ($c);$b++) {
		if ($debugmode) echo "removecdmod:$b==$c[$b] (".ord ($c[$b]).")<br>"; //   /n=10  /r=13  perewod stroki 
		if (ord ($c[$b])==10) { $c[$b]=" "; if ($debugmode) echo "<font color=#CCBBAA><h1>10 detected!!<br></h1></font>";}
		if (ord ($c[$b])==13) { $c[$b]=" "; if ($debugmode) echo "<font color=#CCBBAA><h1>13 detected!!<br></h1></font>";}
	}
	return $c;
	}

	
// подстройка для системных таблиц	
function rfsysdatareq () {
	global $tbl,$cfgmod,$filbas,$namebas,$md1column,$md2column,$dbtype,$prdbdata,$groupdb;
        global $ADM,$prauth;
	if ($tbl=="gmdata") {$cfgmod=1;$filbas="gmdata.cfg";$namebas=cmsg ("CF_USRS");$md1column=0;}
    if ($tbl=="dbdata") {$cfgmod=1;$filbas="dbdata.cfg";$namebas=cmsg ("CF_DB");$md1column=1;}
    if ($tbl=="pages") {$cfgmod=1;$filbas="pages.cfg";$namebas=cmsg ("CF_PAGES");$md1column=1; }
    if ($tbl=="files") {$cfgmod=1;$filbas="files.cfg";$namebas=cmsg ("CF_FIL");$md1column=0; }
    if ($tbl=="styles") {$cfgmod=1;$filbas="styles.cfg";$namebas=cmsg ("CF_STYL");$md1column=0; }
    if ($tbl=="langset") {$cfgmod=1;$filbas="langset.cfg";$namebas=cmsg ("CF_LSET");$md1column=0; }
    if ($tbl=="denywords") {$cfgmod=1;$filbas="denywords.cfg";$namebas=cmsg ("CF_DWORD");$md1column=0; }
    if ($tbl=="srvlst") {$cfgmod=1;$filbas="srvlst.cfg";$namebas=cmsg ("CF_SRV");$md1column=0; }
    if ($prauth[$ADM][42]) if ($tbl=="cmdlines") {$cfgmod=1;$filbas="cmdlines.cfg";$namebas=cmsg ("CF_CMD");$md1column=0; }
    if ($prauth[$ADM][42]) if ($tbl=="filescript") {$cfgmod=1;$filbas="filescript.cfg";$namebas=cmsg ("CF_CMD");$md1column=0; }
    if ($tbl=="errorlog") {$cfgmod=2;$filbas="errorlog.dat";$namebas=$filbas;$md1column=0; }
    if ($tbl=="log") {$cfgmod=2;$filbas="log.dat";$namebas=$filbas;$md1column=0; }
    if ($tbl=="reportlog") {$cfgmod=2;$filbas="reportlog.dat";$namebas=$filbas;$md1column=0; }
    if ($tbl=="undolog") {$cfgmod=2;$filbas="undolog.dat";$namebas=$filbas;$md1column=0; }
    if ($tbl=="execsqllog") {$cfgmod=2;$filbas="execsqllog.dat";$namebas=$filbas;$md1column=0; }
    if ($cfgmod>0){$groupdb="system"; $dbtype="fdb";$prdbdata[$tbl][12]="fdb";$md2column=0;}; //двойной занос-вынужденная мера,т.к. dbtype почти не используется.
//	if ($namebas=="") { $namebas=$tbl;$filbas=$tbl.".cfg";$cfgmod=1;};
return $filbas;
}


// CFG OPT FUTURE  TODO:

// функции фиксации перевода строки для сохранения и возврата перевода обратно
function entsymb ($a) {
	str_replace ("\r\n","#crwin",$a);//hide
	str_replace ("\n","#crx",$a);//hide
}
function symbent ($a) {
	str_replace ("#crwin","\r\n",$a);//hide
	str_replace ("#crx","\r\n",$a);//hide
}



	
	//будет читать заголовки для тех таблиц для которых они есть , для остальных - будет показывать AS IS  с умолчанием. только для администратора.
function readdescripterslive (){

echo";";
}
function filemtime_remote ( $uri )
{
$uri = parse_url ( $uri );
$handle = @fsockopen ( $uri [ 'host' ], 80 );
if (! $handle )
return 0 ;

fputs ( $handle , "GET $uri[path] HTTP/1.1\r\nHost: $uri[host]\r\n\r\n" );
$result = 0 ;
while (! feof ( $handle ))
{
$line = fgets ( $handle , 1024 );
if (! trim ( $line ))
break;

$col = strpos ( $line , ':' );
if ( $col !== false )
{
$header = trim ( substr ( $line , 0 , $col ));
$value = trim ( substr ( $line , $col + 1 ));
if ( strtolower ( $header ) == 'last-modified' )
{
$result = strtotime ( $value );
break;
}
}
}
fclose ( $handle );
return $result ;
}
    // echo filemtime_remote(' );

function syncsvn ()
{
 global $svn1;
 $act="--------syncsvn from $verchar to new from $svn1 --------";
 logwrite ($act);
 syncsvnfiles ($svn1,getcwd ());
 echo "Language update<br>";
 syncsvnfiles ($svn1."_langdb/",getcwd ()."/_langdb");
}

function syncsvnfiles ($svn,$folder) {
    echo "Repository:$svn<br>";
    echo "Target dir:$folder<br>";
$svn1=$svn;
    @mkdir ("_backup");
    //global $svn1;// разрешить только если версия в SVN новее текущей.--
    //отчитаться об обновлении на официальный сервер dbscript --
    lprint ("SVN_UPD");echo "<br>SVN Update <form action=admin.php>";
		// файлы к этому моменту уже должны быть сгенерированы и хотя бы быть в наличии
		$path=$folder;	//	$path2=$fldup."/_conf";$path3=getcwd ()."/_langdb/";
		$mask="*.*";	$protect[]="update*.*";$nameselect="files"; // CFG OPT FUTURE  TODO:  - mask unfull support on project
                $protect[]="*.txt";$protect[]="~";$nameselect="files";
		$files=filesselect ($path,$mask,$protect,$nameselect,7);
             
                @$xx=fopen ("jquery.color.js","r");  //check jquery extension - checking newly required module
                @$yy=fopen ("jquery-glowing.js","r");  //check jquery extension
                if (!$xx) $files[]=array ( "jquery.color.js","0","1","1288799146" );
                if (!$yy) $files[]=array ( "jquery-glowing.js","0","1","1288799146" );
                //   print_r ($files);
                //die ("alarm");
                echo "</form>";
//print_r ($files) ;
echo "All files archiven in special folder _backup! Warn: Updated can be only existed files both repository and folder Dbscript installation.<br>";
//adding lang
for ($a=1;$a<count ($files);$a++) {
if ($files[$a][0]==".") continue;  // names
if ($files[$a][0]=="..") continue;  // names
if ($files[$a][0][0]=="_") continue;  // names
if ($files[$a][0]=="keygen.php") continue;  // skip keygen
if ($files[$a][0]=="keygen.php") continue;  // skip keygen
if ($files[$a][0]=="classAudioFile.php") continue;  // skip keygen
if ($files[$a][0]=="ajax.php") continue;  // skip keygen
if ($files[$a][0]=="money.php") continue;  // skip keygen
if ($files[$a][1]==1) continue;//folder skip
if ($files[$a][2]==0) continue;//length
                                // data last change !!&     

        if (strlen ($files[$a][0])>1) {
          //@$error=copy ($svn1.$files[$a][0],"_local/temp"); incorrect gives time !!!! not use!!! 
          @$error=filemtime_remote ($svn1.$files[$a][0]);
          if ($error!==false) {$dateremotefile= $error;$datsvn=strunixtimetodbs ($dateremotefile);// date remote file
            if ($dateremotefile==0) continue;
         //if ($error!==false) {$dateremotefile= date(filectime("_local/temp"));$datsvn=strunixtimetodbs ($dateremotefile);// date remote file
                $datethisfile=$files[$a][3]; $enable=1; $dnow=strunixtimetodbs ($datethisfile);
            } else {$enable=0;}
          
        
    }
 //$enable=checksvnfileanddate ($svn1,$files[$a][0],$files[$a][3]);

 if ($enable==1) {
     if ($dateremotefile==0) continue;
     echo "Checking: ".$files[$a][0]." [sz ".$files[$a][2]."b] dated SVN: [$datsvn]   THIS: [$dnow] <br>";//".."
     $raznica=$datethisfile-$dateremotefile;
     $check=false;
        if ($dateremotefile>$datethisfile) { @$db=copy ($files[$a][0],"_backup/".$files[$a][0]);  //too easy
           //echo "$db=copy (".$files[$a][0]." to _backup/".$files[$a][0]."<br>";
        @$check=copy ($svn1.$files[$a][0],$files[$a][0]);  //too easy
        //echo "$db=copy (".$svn1.$files[$a][0]." to ".$files[$a][0]."<br>;";
        } else { if ($raznica<20000) { //echo "Status:<font color=green id=xfnt>Identical</font><br>";
                 $skip++;continue;};
           if ($dateremotefile<$datethisfile) {$skip++;continue;};};//
if ($check) { echo "Status:<grn>Synchronized succesfully<grn><br>"; $ok++ ; } else { echo "Status:<red>Not updated</red><br>"; $fail++;};
ob_flush  ();
$enable=0;
} else { echo "" ;// skipped
    }
    
}
    echo "OK:$ok Fail:$fail Skip:$skip<Br>";
}

function autoupdatecfgs ($files) {
    //непроверено
global $fldup,$pr,$prauth,$ADM; //а что с этим будем делать , как тут синхронизировать?
$mirroraddress=$pr[96];
if (!$prauth[$ADM][2]) die ("E_CORE:Security error");
for ($a=0;$a<count ($files);$a++) {
	print ($files[$a]."<br>");
        if ($pr[34]) $targetdir="$fldup/_conf/";
        if (!$pr[34]) $targetdir="_conf/";

	 //disables global configuration 
	//echo "creating folder $fldup/_conf/<br>";	//$err=mkdir ($fldup."/_conf/");	//chmod ($fldup."/_conf/",777);	//echo $err."<br>";
	echo "copy (".$mirroraddress."_conf/".$files[$a]." to ".$targetdir.$files[$a].")<br>";
	//$err=csvopen ("_conf/".$files[$a],"move",$fldup."/_conf/".$files[$a]);
	$err=csvopen ($mirroraddress."_conf/".$files[$a],"copy",$targetdir.$files[$a]);
	$err=csvopen ($targetdir.$files[$a],"r",1);//check
	if ($err==false) { $error=1;continue; }
        if ($error==1){ echo "<br>File write access denied $targetdir<br>Interrupted<br>"; exit; } ; // почему нам не дали прав?
	//$err=csvopen ($mirroraddress."_conf/".$files[$a],"move",$fldup."/_conf/".$files[$a]);
		}
	
	echo "<br>".cmsg ("")."<br>";
}


//непроверено - реализация - в install.php
function cleancode ($file,$from,$to) {
    // удаляет все упоминания о активации и системе защиты. для создания открытой версии.
$index = strip_tags (file_get_contents($file));

$cdestfile="";$d="";
$array=file($file) ;
$k = count($array) ; $a=0;
while ($a<$k) {
	//echo " ";
//	echo $a."--".$array[$a]; ;// выдача "в чистом виде" для тестов
	$a++;
	$b=$array[$a-1];$strleng=strlen ($b);

    if (strpos ($b,$from)!==false) { $startskipmode=1;	}
	if (strpos ($b,$to)!==false) {$startskipmode=0;continue;		}
                if ($startskipmode==0) $cdestfile=$cdestfile.$b ; continue;

	}
        //$cdestfile=."//cleaned by cleancode";
$datafile = fopen ($file,"w") or die ("Не удалось записать, извините.");
@fwrite ($datafile ,$cdestfile);
@fflush ($datafile);
@fclose ($datafile);
//echo ("<a href=\"adminf.php\">Ваш файл тут.</a> Не забудьте нажать F5 для обновления.");
}


// лучше поздно чем никогда...

?>
