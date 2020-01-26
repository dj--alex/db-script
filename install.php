<?php ob_start ();
//$writefullcfgdiscrwin=1;
// СКАЖЕМ НЕТ ШАБЛОНАМ, мы за оригинальное программирование!
// только ломая шаблоны и стереотипы можно добится чего то нового.
//if (!$languageprofile) $languageprofile="english";
$verinst="Install v4.5 (c) dj--alex";// service hide
//error_reporting (E_ALL);
//ini_set('error_reporting',E_ALL^E_NOTICE);
$ei="<img src=\"_ico/errorcritical.png\">";
echo "Starting install process dbscript. ";
echo "<a href=\"https://github.com/dj--alex/db-script/\"> Github</a>";
echo "<br> Module: $verinst<br>";

if ($_POST["step"]<1) {echo "Checking ini<br><div style=\"position:absolute; z-index:4;  top:0; right:0; color: #FFFFFF ; background: #0000aF \"><img src=\"_style/dbsDeusModuslogo.jpg\"></div>";
    //переписать msgexiterror  c учётом функции window и вообще сделать там наконец возможность менять размер окна и возможно перемещать его.
    $phpmem=ini_get ("memory_limit");if ($phpmem<100) echo "$ei settings php.ini memory_limit=$phpmem , recommend inscrease value at least 100M (for big files and dumps - higher)<br>";
    $phppost=ini_get ("post_max_size");if ($phppost<10) echo "$ei settings : php.ini : post_max_size=$phppost , recommend inscrease value at least 10mb (for big files and dumps - higher)<br>";
$phptag=ini_get ("short_open_tag"); //if (!$phptag) die ("$ei <font color=red>Fatal error</font>: settings : php.ini : dbscript requires short_open_tag=on ! This version unsupport work without it. Installation failed. ");
$phpsafe=ini_get ("safe_mode"); if ($phpsafe) echo "settings : php.ini : safe_mode is on. recommend off , it not allows use some inbuild settings and some operations you can get errors without it.<br>";
$phpglob=ini_get ("register_glogals"); if ($phpglob) echo"$ei notify: register globals is on. recommended off for security reasons.<br>";
$phpfunc=ini_get ("disable_function");if ($phpfunc) echo "$ei notify: disabled functions $phpfunc<br>";
if (!extension_loaded('iconv')) echo " $ei Warning : php extension iconv non-exist !  <br>";
if (!extension_loaded('mb_string')) echo "$ei Warning : php extension mb_string non-exist !  <br>";
if ( (!extension_loaded('mb_string')) AND (!extension_loaded('iconv'))) echo "$ei  Error: Dbscript need an php encoder - iconv or mb_string. Without it you cant use encoding functions and/or get bugs .<br>";
//require aa
if (!extension_loaded('Zend Optimizer')) {echo "$ei  notify: extension Zend optimizer not installed.<br> It requires for optimized versions<br>";
echo "Note: If you have Dbscript Open SE version , just ignore this message and click <Next>.";
 echo " If you need version without Zend optimizer - get not optimized version here <br>";
 echo "( <a href=\"https://github.com/dj--alex/db-script/\">Dbscript 4.5 SE</a>)<br>";
  echo "<b><br> <a href=\"install.php?nozend=1\">Next:: Restart as is (without encoder)</a><br></b>";
 echo "<br> <a href=\"install.php?lightcore=1\">event LC (only for dev)</a><br>";
//echo "fcuk";echo $_GET["lightcore"]; echo "<br>";
 if ($_GET["lightcore"]=="1") lightcore ();

 if ($_GET["nozend"]!=1) exit;

};

//$silent=1;
if ($phpsafe){ $phpmaxtime= ini_get ("max_execution_time"); if ($phpmaxtime<60) echo "safe_mode : settings : php.ini : max_execution time <60. Safe mode not allows me set time automatically. Change one of settiongs pleaxe.<br>";
}
//echo "<br>";
}
if ($_POST["step"]<1) {;};
echo "Loading core...";
//echo "step $step G ".$_GET["step"]." P".$_POST["step"]."<br>";;
if ($_GET["step"]>0) {echo "Invalid initializing..."; exit;}

$nomnu=1;//блокирует вывод интерфейса программы
$coreloadskip=1; //блокирует загрузку и проверку настроек ядром программы.
$debugmode=false;// отключение показа сообщений об ошибках
$installermode=1;// locks default language to english  выключает поддержку lang.cfg соответственно все коды возвращаемые им будут неверными.
$nolayer=1;// убираем внешние окошким
require ('dbscore.lib'); // i/o file  INCLUDED!

@$onloadlocal=opendir ("_conf");
@$errcrtdir=mkdir ("_conf");// langset  styles  required

//echo "Language profile=$lang";

$debugmode=false;$pr[8]=1; //debug off
echo "".$verprogram."<br>";
if (($onloadlocal==false)AND($errcrtdir==false)) { echo "<font color=red>Fatal error</font>: Cannot write to program folder.<br>You must enable writing to user web-server or programm  ( Set rwxr--r-- for script.)";exit; };

if (!isset ($verprogram)) die ("Core loading failed!");
if (($vernumb<4.4)or($vernumb>4.9)) die ("Unsupported version core!");
if (!$step) echo "This version is supported by this installer<br>";

//теперь вся конфигурация загружается через initalizeSE //$fldup = get from init// выч как лучше отрезать папку 
//$languageprofile="russian";
$locale="";

if (!$lang) {$languageprofile="english"; 

$filbas="_conf/sitedata.cfg";
@$site=csvopen ($filbas,"r","0");$data=readfullcsv ($site,"new");
if ((!$step)AND($data!==-1)) { echo "Dbscript already installed. You must remove install.php<br>";window ("","") ;echo " <img src=\""."_ico/info.png"."\" border=0><br>   ";
  lprint (INST_CONF_PRES);closewindow();exit;}



?>
<link href="style.css" rel="stylesheet" type="text/css">
<div id="Layer1" style="position:relative;width:460px; height:115px; z-index:1; left:30%; top: 30%; margin:40 0 0;" class="author_text">
<FIELDSET>
<LEGEND><img src=_ico/wopros.png></img></LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<form action="install.php" method="post"><img src=_ico/install.png></img>
<TD WIDTH=75%>Select your language . (after install you can select any language) <br> Выберите предпочитаемый язык . (позже вы сможете выбрать любой) <br>
    </TD>
<TD WIDTH=30%>
<?php echo "<select name=lang>";
echo "<option value=english>english</option>";
echo "<option value=russian>русский</option>";
echo "<option value=deutsch>deutsch</option>";
echo "<option value=rustranslit>rustranslit</option>";
echo "</select>";
?>
</TD></TR></TABLE><CENTER>
<?php
hidekey ("step",1);
hidekey ("write","Installing Dbscript - 1");
submitkey ("loginstate","NEXT");
echo "</CENTER></form></FIELDSET></div>";
exit;}


//echo "languageprofile=$languageprofile lang=$lang<br>";
//  DIALOGUS System imago
if ($lang) { $languageprofile=$lang; }

//echo "languageprofile=$languageprofile lang=$lang<br>";
if ($step) {
	window (array ( 'message'=>"",'color'=> "",width=>'540',top=>'',left=>'' , height=>'', 'icon'=>"",'mainheader'=>"$step::".cmsg ("I_$step") ),"");
	echo "<form action=install.php method=post>";
        $st=$step+1;
        hidekey ("write",cmsg ("INST_DBS")." - $st");
	if ($step>0)hidekey ("lang",$lang);
	}
//============================================//
if ($step==1)
{ 	
	echo "".cmsg ("INST_SQL")."<br>";
	lprint ("A_LOG_DB");  inputtext ("LOGINSQL",15,"root");echo "<br>";
	lprint ("A_PS_DB"); inputtext ("PASSSQL",15,"");//echo "<br>";
	echo "<br>".cmsg ("INST_SQL2"); inputtext ("IPDEFSERVSQL",15,"localhost");
	echo "<br>".cmsg ("INST_SQL3");// echo "<br>";echo "<br>";
        echo "<br>";checkbox ("","NOMYSQL"); echo cmsg ("NOMYSQL")."<br>";
	submitkey ("loginstate","DALEE");
	hidekey ("step",2); 
	
}
if ($step>1) {
	hidekey ("LOGINSQL",$LOGINSQL); 
	hidekey ("PASSSQL",$PASSSQL); 
	hidekey ("IPDEFSERVSQL",$IPDEFSERVSQL);
        hidekey ("NOMYSQL",$NOMYSQL);
	}

//============================================//
if ($step==2)
{  //$mainhostmysql
	if (!$NOMYSQL) {@$connect=mysqli_connect ($IPDEFSERVSQL, $LOGINSQL , $PASSSQL);
	if ($connect===false) {sqlerr ();} else {echo "";}//lprint (SQLDOWN);
        }
	echo "".cmsg (INST_SU)."<br>"; 
	
	lprint ("LOGIN_SUSER");inputtext ("LOGINUSER",15,"TEST");echo "<br>";
	lprint ("PASS_SUSER"); inputtext ("PASSWORDUSER",15,"TEST");echo "<br>";
	//checkbox ($a,"oldenc");echo "".cmsg (INST_OLDENC)."<br>";
	submitkey ("loginstate","DALEE");
	hidekey ("step",3); 
}
if ($step>2) {
	hidekey ("LOGINUSER",$LOGINUSER); 
	hidekey ("PASSWORDUSER",$PASSWORDUSER); 
	}


//============================================//	
if ($step==3)
{
	// LOGINUSER 	PASSWORDUSER<br> autologin removed
	echo "<br>".cmsg ("INST_FMG_DEF_FLD")."<br>";inputtext ("fmgfldr",15,"");
	echo "<br>";checkbox ("","sharedconf"); echo cmsg ("INST_SHARED_1")."<br>";
	submitkey ("loginstate","DALEE");
	hidekey ("step",4); 
	
}
if ($step>3) {
	hidekey ("fmgfldr",$fmgfldr); 
	hidekey ("sharedconf",$sharedconf); 
	//if ($step==4)AND($sharedconf==false) $step=5;
	}

	
//============================================//
if ($step==4)
{
	echo "<br>".cmsg ("INST_CNF_CRT")."<br>";
        $encodingforce="utf-8";
        if ( (!extension_loaded('mb_string')) AND (!extension_loaded('iconv'))) {
            $encodingforce="windows-1251";
echo "You dont have iconv and mb string extensions , encoding forced to cp1251<br>";
            }

	submitkey ("loginstate","DALEE");
	hidekey ("step",5);
//$lscontent=splitcfgline ($lscontent);
 
 function splitcfgline ($line) {
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
 //echo "OSTYPE=$OSTYPE<br>";
closewindow();
 //$lsheader=splitcfgline ($lsheader);
 //$lsplevel=splitcfgline ($lsplevel);
 //$lscontent=splitcfgline ($lscontent);
 //  writefullcsv ($tempdescr,$lsheader,$lsplevel,$lscontent);$edit=0;	//reading langset 
	$filbas="_conf/langset.cfg";
	@$langset=csvopen ($filbas,"r",0);$data=readfullcsv ($langset,"new");
 if ($data==-1) {
	$lsheader="language¦selectprofile¦¦¦¦";
	$lsplevel="0¦0¦0¦0¦0¦";
	$lscontent[]="default¦".$lang."¦¦¦";
	$lscontent[]="default¦".$lang."¦¦¦";
	$path=getcwd ()."/_langdb/"; //наполняем базу langset
		$mask="*.cfg";	$protect[]=".";$nameselect="files";
		$files=filesselect ($path,$mask,$protect,$nameselect,0);
		for ($b=0;$b<count ($files);$b++) {//echo "b=$b, ".$files[$b][0]."==file<br>";
			if (strpos ($files[$b][0],".cfg")==true) {$x[]=str_replace(".cfg","",$files[$b][0]);}
		}
		for ($a=0;$a<count ($x);$a++) {
	$lscontent[]=$x[$a]."¦".$x[$a]."¦¦¦¦";
		}
 @$tempdescr=csvopen ("_conf/langset.cfg","w",1);
 $lsheader=splitcfgline ($lsheader);
 $lsplevel=splitcfgline ($lsplevel);
 $lscontent=splitcfgline ($lscontent);
   $err.=writefullcsv ($tempdescr,$lsheader,$lsplevel,$lscontent);$edit=0;

   //writing langset
 }
//reading pages
 $filbas="_conf/pages.cfg";
@$pages=csvopen ($filbas,"r",0);$data=readfullcsv ($pages,"new");
if ($data==-1) {
//$pgheader="1¦012345¦0-pageent1¦str1¦str2¦rus¦exchpage¦rus¦redirect0-no1-y2-sp¦reditime¦";
$pgheader="0-pageent1¦1page¦2¦russian¦4exchpage¦english¦6redirect0-no1-y2-sp¦7reditime¦8menulevel-1op-2cl¦9skipmenudmstyle¦10openmenu3";
$pgplevel="¦¦¦¦¦d¦d¦d¦d¦d¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
if ($languageprofile=="russian") 
{$p[]="0¦admin.php¦0¦Конфигурация¦0¦Admin¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="0¦admin.php¦0¦Конфигурация¦0¦Admin¦0¦0¦0¦0¦0¦0¦0¦0";// writefullcsv почему то глотает первую строку иноогда
$p[]="1¦login.php¦0¦Вход¦0¦Enter¦Вход¦¦0¦1¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="2¦w.php¦0¦Редактор¦0¦Editor¦Редактор¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="3¦getfile.php¦0¦Поиск¦0¦Search¦Поиск¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="4¦r.php?viewid=.ver&base=0¦0¦Версия¦0¦Version¦Версия¦¦0¦1¦1¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="5¦filemgr.php¦0¦Файлы¦¦Filemanager¦Файлы¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="6¦dblinker.php¦0¦Менеджер баз¦0¦DB manager¦Менеджер баз¦¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="7¦admin.php?cmd=myprof¦0¦Мой профиль¦0¦My profile¦Мой профиль¦¦1¦0¦Настройки¦0¦0¦0¦0";
$p[]="8¦r.php?viewid=.info&base=0¦¦Инфо о мне¦¦About me¦Инфо о мне¦¦0¦0¦0";
$p[]="9¦r.php?vID=.author&base=0¦0¦О авторе¦¦Author¦О авторе¦¦3¦0¦0";
$p[]="11¦news.php¦¦Блог¦¦Blog¦d¦d¦1¦0¦Beta¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="12¦nedit.php¦qwe¦Добавить новость¦¦Blog-edit¦d¦d¦0¦0¦¦0¦0¦0¦0";
$p[]="13¦admin.php?cmd=note¦0¦блокнот¦¦Shared notes¦Общий блокнот¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="14¦admin.php?cmd=test¦0¦Самотест¦¦Self-test¦Самотест¦¦0¦0¦0¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="15¦http://code.google.com/p/db-script/issues¦qweqwe¦Сообщить о баге в SVN¦1¦Send bug message¦3¦2¦d¦0¦0¦0¦0¦0";
//$p[]="13¦r.php?vID=.aboutme&base=0¦0¦Мои данные¦0¦User info¦Мои данные";
}
if ($languageprofile!=="russian") 
{$p[]="0¦admin.php¦0¦Admin¦0¦Admin¦Конфигурация¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="0¦admin.php¦0¦Admin¦0¦Admin¦Конфигурация¦0¦0¦0¦0¦0¦0¦0¦0";// writefullcsv почему то глотает первую строку иноогда
$p[]="1¦login.php¦0¦Вход¦0¦Enter¦Вход¦¦0¦1¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="2¦w.php¦0¦Редактор¦0¦Editor¦Редактор¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="3¦getfile.php¦0¦Поиск¦0¦Search¦Поиск¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="4¦r.php?viewid=.ver&base=0¦0¦Версия¦0¦Version¦Версия¦¦0¦1¦1¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="5¦filemgr.php¦0¦Файлы¦¦Filemanager¦Файлы¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="6¦dblinker.php¦0¦Менеджер баз¦0¦DB manager¦Менеджер баз¦¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="7¦admin.php?cmd=myprof¦0¦Мой профиль¦0¦My profile¦Мой профиль¦¦1¦0¦Settings¦0¦0¦0¦0";
$p[]="8¦r.php?viewid=.info&base=0¦¦Инфо о мне¦¦About me¦Инфо о мне¦¦0¦0¦0";
$p[]="9¦r.php?vID=.author&base=0¦0¦О авторе¦¦Author¦О авторе¦¦3¦0¦0";
$p[]="11¦news.php¦¦Блог¦¦Blog¦d¦d¦1¦0¦Beta¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="12¦nedit.php¦qwe¦Добавить новость¦¦Blog-edit¦d¦d¦0¦0¦¦0¦0¦0¦0";
$p[]="13¦admin.php?cmd=note¦0¦блокнот¦¦Shared notes¦Общий блокнот¦¦0¦0¦0¦0¦0¦0¦0¦0";
$p[]="14¦admin.php?cmd=test¦0¦Самотест¦¦Self-test¦Самотест¦¦¦0¦0¦0¦0¦0¦0¦0";
$p[]="15¦http://code.google.com/p/db-script/issues¦qweqwe¦Сообщить о баге в SVN¦1¦Send bug message¦3¦2¦d¦0¦0¦0¦0¦0";
//$p[]="13¦r.php?vID=.aboutme&base=0¦0¦Мои данные¦0¦User info¦Мои данные";



}
$pgcontent=$p;$p="";
	 @$tempdescr=csvopen ("_conf/pages.cfg","w",1);
 $pgheader=splitcfgline ($pgheader);
 $pgplevel=splitcfgline ($pgplevel);
$pgcontent=splitcfgline ($pgcontent);
 $err.=writefullcsv ($tempdescr,$pgheader,$pgplevel,$pgcontent);$edit=0;
//writing pages
}
//reading styles
$filbas="_conf/styles.cfg";
@$styles=csvopen ($filbas,"r",0);$data=readfullcsv ($styles,"new");
if ($data==-1) {
$stheader="style¦properties¦rgbfon¦rgbtext¦¦";
$stplevel="0¦0¦0¦0¦0¦";
$p[]="Default¦dbew_b¦ffffff¦000000¦¦";
$p[]="Default¦dbew_b¦ffffff¦000000¦¦"; // если везде эта ошибка с глотанием нулевой строки то убрать ее
$p[]="Black_r¦dbr_b¦333333¦ffffff¦¦";
$p[]="White_r¦dbrw_b¦ffffff¦000000¦¦";
$p[]="White¦dbew_b¦ffffff¦000000¦¦";
$p[]="Black¦dbe_b¦333333¦ffffff¦¦";
$p[]="Matrix¦dbs_b¦333333¦00EE00¦¦";
$p[]="O_o¦dbrw_b¦ffff00¦dddd00¦¦";
$p[]="empty¦пустой¦ffffff¦000000¦¦";
$p[]="red¦dbr_b¦aa0000¦ffffff¦¦";
$p[]="blue¦dbr_b¦000066¦ffffff¦¦";
$p[]="cyan_blue_r¦dbrw_b¦55AAEE¦000055¦¦";
$p[]="cyan_blue_e¦dbew_b¦ccaa44¦441111¦¦";
$p[]="green_blue¦dbrw_b¦55AA00¦000055¦¦";
$p[]="contrast¦dbrw_b¦000000¦ffffff¦¦";
$p[]="salatov¦dbrw_b¦99FF22¦333333¦¦";
$p[]="fiolet¦dbrw_b¦4b5fac¦11ffff¦¦";
$p[]="desktoptree¦dbrw_b¦ccaa44¦441111¦¦";
$p[]="green_blue¦dbew_b¦55AA00¦000055¦¦";
$p[]="contrast¦dbew_b¦000000¦ffffff¦¦";
$p[]="salatov¦dbew_b¦99FF22¦333333¦¦";
$p[]="fiolet¦dbew_b¦4b5fac¦11ffff¦¦";
$p[]="desktoptree, English¦dbew_b¦ccaa44¦441111¦¦";
$p[]="desktoptree_en¦ae¦ccaa44¦441111¦¦";
$p[]="desktoptree_ru¦ar¦ccaa44¦441111¦¦";

$stcontent=$p;$p="";

	 @$tempdescr=csvopen ("_conf/styles.cfg","w",1);
$stheader=splitcfgline ($stheader);
 $stplevel=splitcfgline ($stplevel);
$stcontent=splitcfgline ($stcontent);
$err.=writefullcsv ($tempdescr,$stheader,$stplevel,$stcontent);$edit=0;
//writing styles
}


//reading filescripts
$filbas="_conf/filescript.cfg";
@$filescripts=csvopen ($filbas,"r",0);$data=readfullcsv ($filescripts,"new");
if ($data==-1) {
$filescriptheader="ID¦NAME¦Script¦Plevel¦keynames-icon¦russian¦english¦f1_russian¦f1_english¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
$filescriptplevel="0¦d¦0¦0¦0¦0¦0¦d¦0¦0¦0¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d0¦0¦0¦0¦0¦";
$p[]="0¦¦mencoder %path%%file% -oac mp3lame -ovc x264 -o %path%%file%.avi¦0¦0¦перекодить в h264¦encode h264¦0¦0¦0¦0¦0¦";
$p[]="1¦¦mencoder %path%%file% -oac mp3lame -ovc x264 -o %path%%file%.avi¦0¦0¦перекодить в h264¦encode h264¦0¦0¦0¦0¦0¦";
$p[]="2¦¦mencoder %path%%file% -oac mp3lame -ovc mpg -o %path%%file%.avi¦0¦0¦перекодить в mpeg¦encode mpeg¦0¦0¦0¦0¦0¦0¦"; // если везде эта ошибка с глотанием нулевой строки то убрать ее
$filescriptcontent=$p;$p="";
//почему то данные не сохраняются в скрипте - только шапка - все остальное теряется.

	 @$tempdescr=csvopen ("_conf/filescripts.cfg","w",1);
$filescriptheader=splitcfgline ($filescriptheader);
 $filescriptplevel=splitcfgline ($filescriptplevel);
$filescriptcontent=splitcfgline ($filescriptcontent);
$err.=writefullcsv ($tempdescr,$filescriptheader,$filescriptplevel,$filescriptcontent);$edit=0;
//writing filescripts
}


$filbas="_conf/gmdata.cfg";
@$gmdata=csvopen ($filbas,"r","0");$data=readfullcsv ($gmdata,"new");
if ($data==-1) {
//reading gmdata
$gmheader="LOGIN¦PASSWORD¦Администрирование¦редактирование¦продвинутый поиск¦масс. удаления¦Операции с заголовками¦perm_4¦perm_5¦perm_6¦Уровень прав¦Истечение прав* (-1,нет)¦perm_9¦perm_10¦perm_11¦Зарегистрированное имя¦Не показывать инструкции¦Редактор - неточные совпадения¦Редактор - поиск по любому полю¦Выводить сортировку*¦Выводить постранично*¦Стиль¦Язык¦б22¦б23¦b25¦b26¦b27¦b28¦b29¦b30¦b31¦b32¦b33¦b34¦b35¦b36¦b37¦b38¦b39¦b40¦b41¦b42¦b43¦b44¦b45¦b46¦b47¦b48¦b49¦b50¦b51¦b52¦b53¦b54¦b55¦b56¦b57¦b58¦b59¦b60¦b61¦b62¦b63¦b64¦b65¦b66¦b67¦b68¦b69¦b70¦b71¦b72¦b73¦b74¦b75¦b76¦b77¦b78¦b79¦b80¦b81¦b82¦b83¦b84¦b85¦b86¦b87¦b88¦b89¦b90¦b91¦b92¦b93¦b94¦b95¦b96¦b97¦b98¦b99 ¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦";
$gmplevel="a¦d¦a¦a¦d¦d¦d¦d¦d¦d¦a¦d¦d¦d¦d¦a¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦";

$ADMM=0;
for ($a=0;$a<200;$a++) {
        $prauth[$ADMM][$a]="0";//debug
	if (($a>24)AND($a<37)) $prauth[$ADMM][$a]="1";
}
$prauth[$ADMM][0]=stripslashes ($LOGINUSER); 			$prauth[$ADMM][1]=hashgen ($PASSWORDUSER);$prauth[$ADMM][42]=1;
$prauth[$ADMM][15]=$prauth[$ADMM][0];$prauth[$ADMM][22]=$lang;
$prauth[$ADMM][21]="Default";$prauth[$ADMM][10]=10;

 
 if ($OSTYPE=="LINUX") $prauth[$ADMM][199].="sayfuck\n";
 //$prauth[$ADMM][198]=$prauth[$ADMM][198]."sayfuck2\n"; $prauth[$ADMM][199]="199sayfuck2\n"; $prauth[$ADMM][200]="200fuck\n";
$prauth[1]=$prauth[0];// eto i est sohranenie!!!!!!!!!!!!!!!!!!!!1111
//..$prauth="";// тут добавляем нашего юзера
 //$prauthimploded=implode ($prauth[$ADMM],"¦");
//if ($OSTYPE=="LINUX") $prauthimploded.="sayfuck\n";/
//$prauthimploded.="sayfuck2\n";
	 @$tempdescr=csvopen ("_conf/gmdata.cfg","w",1);
	 $gmheader=splitcfgline ($gmheader);
 $gmplevel=splitcfgline ($gmplevel);
//$prauth=splitcfgline ($prauthimploded);
   $err.=writefullcsv ($tempdescr,$gmheader,$gmplevel,$prauth);$edit=0;
//writing gmdata
}

$filbas="_conf/denywords.cfg";
@$deny=csvopen ($filbas,"r",0);$data=readfullcsv ($deny,"new");
if ($data==-1) { 
//reading denyword
$dnheader="word¦plevel¦special";
$dnplevel="4#1#1¦4¦";
	 @$tempdescr=csvopen ("_conf/denywords.cfg","w",1);
	 $dnheader=splitcfgline ($dnheader);
 $dnplevel=splitcfgline ($dnplevel);
$dncontent=splitcfgline ($dncontent);
   $err.=writefullcsv ($tempdescr,$dnheader,$dnplevel,$dncontent);$edit=0;
//writing denyword
}

$filbas="_conf/dbdata.cfg";
@$dbdata=csvopen ($filbas,"r","0");$data=readfullcsv ($dbdata,"new");
if ($data==-1) {
//reading dbdata
$dbheader="File base¦Base visual name¦Поддержка картинок¦Tип scr¦Режим 3 (Категория)¦Таблица Mysql¦Хост Mysql ¦Тип категории¦Колонка картин¦Выбирать базу¦Режим 1 (Имя)¦Режим 2 (Код)¦Use Mysql¦Права на запись¦Права требуемые базой¦Треб. виртуальный ID¦Отбор колонок¦reserved17¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd";
$dbplevel="d¦5¦d¦d¦d¦d¦d¦d¦d¦d¦a¦d¦a¦d¦5¦5¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦dr";
$prdbdata="";//
	 @$tempdescr=csvopen ("_conf/dbdata.cfg","w",1);
$dbheader=splitcfgline ($dbheader);
 $dbplevel=splitcfgline ($dbplevel);
//$pgcontent=splitcfgline ($pgcontent);
$err.=writefullcsv ($tempdescr,$dbheader,$dbplevel,$prdbdata);$edit=0;
//writing dbdata
}
if ($languageprofile!=="russian") $sitedata="dbslogo.gif¦Welcome string.¦1¦80% Nimbus Roman No9 L¦by name¦by code¦by code2¦showall¦¦¦¦0¦999¦¦root¦localhost¦Dbscript¦¦512¦".$encodingforce."¦main fields¦select field¦all fields¦by comm¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
if ($languageprofile=="russian") $sitedata="dbslogo.gif¦Добро пожаловать в наш сервис. Выберите базу и способ поиска и введите название объекта поиска.¦1¦80% Nimbus Roman No9 L¦по названию¦по коду ¦по названию2¦отобразить всё¦mp3pereim.php¦127.0.0.1¦D:/system/www/dj/filemgr/¦0¦999¦¦root¦localhost¦Dbscript¦¦2048¦".$encodingforce."¦по важным полям¦выбрать поле¦по всем полям¦по комментариям¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
   //patch for windows-1251 menu editing in utf-8 mode
//    ?/if (($encodingforce=="utf-8")AND(1==1)) $sitedata=iconv("windows-1251","utf-8",$sitedata);
    //if (($encodingforce=="utf-8")AND(1==1)) $sitedata=iconv("utf-8","windows-1251",$sitedata);// FUUUUU  ??????  или кракозябры - что лучше??
$property="".$verchar."¦".$verchar."¦1¦1¦1¦1¦¦1¦1¦¦¦¦1¦¦¦0¦¦¦¦¦¦¦1¦1¦1¦¦1¦50¦default¦1¦1¦1¦1¦1¦¦1¦¦1¦1¦/media/D/¦1000¦¦html,gif,bmp,png¦127.0.0.1¦20¦1¦1¦on¦¦on¦¦¦on¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
 //patch for windows-1251 menu editing in utf-8 mode
    //if (($encodingforce=="utf-8")AND(1==1)) $property=iconv("windows-1251","utf-8",$property);
$sd=explode ("¦",$sitedata);
$pr=explode ("¦",$property);
	$sd[14]=$LOGINSQL;
	$sd[17]=$PASSSQL; 
	$pr[43]=$IPDEFSERVSQL; 
	$pr[41]=$fmgfldr; 
	$pr[34]=$sharedconf;
	$pr[8]=1; //debug off
$sitedata=implode ("¦",$sd);
$property=implode ("¦",$pr);
$pr[34]=0;
$filbas="_conf/sitedata.cfg";
$site=csvopen ($filbas,"w",1);
$err.=fwrite ($site,$sitedata);//годится полн для открытого потока и однострочного файла
fclose ($site);
$filbas="_conf/property.cfg";
$desc=csvopen ($filbas,"w",1);
$err.=fwrite ($desc,$property);
fclose ($site);
//echo "Error:$err<br>";
//if ($err>3) die ("Fatal error, configs skipped ,write protect>?");
	//если нет pages,styles создаются с содержимым заранее сохраненным тут
	//langdb формируется по папке,все заголовки берутся отсюда
	//gm содержит только 1 чел, db,dn,ed -только заголовки
	//sitedata,property никуда не перемещаются,остальные могуть быть перемещены после создания на шаге 5 
}
if ($step>4) {
	}


	
//============================================//

//echo "sh=$sharedconf !!!<br>";exit;
if (($step==5)AND(!$sharedconf)) $step=7;

if ($step==5)
{   if ($sharedconf) {
	lprint ("INST_SHARED_SEL");echo "<br>";
		// файлы к этому моменту уже должны быть сгенерированы и хотя бы быть в наличии
		$path=getcwd ()."/_conf/";	//	$path2=$fldup."/_conf";$path3=getcwd ()."/_langdb/";
		$mask="*.cfg";	$protect[]="*.php";$nameselect="files";
		filesselect ($path,$mask,$protect,$nameselect,7);
		
		

	}
	// echo "<select namegetcwd ()."/_conf/";=files>";	for ($a=0;$a<8;$a++) {		echo "<option name=\"value\">".$file[$a]."</option>";	}	// echo "</select>";
	echo "<br>".cmsg ("")."<br>";
        if ($_ENV["NUMBER_OF_PROCESSORS"]==false) echo "";
	submitkey ("loginstate","DALEE");
	hidekey ("step",6); 
	
}
if ($step>5) {
	hidekey ("files",$files); 
	}

//============================================//



if ($step==6)
{  echo cmsg ("SHARED_CONF")."<br>";
	for ($a=0;$a<count ($files);$a++) {
	print ($files[$a]."<br>");	
	$pr[34]=0;
	echo "creating folder $fldup/_conf/<br>";
	$err=mkdir ($fldup."/_conf/");
	chmod ($fldup."/_conf/",777);
	echo $err."<br>";
	echo "move (_conf/".$files[$a]." to $fldup/_conf/".$files[$a].")<br>"; 
	
	//$err=csvopen ("_conf/".$files[$a],"move",$fldup."/_conf/".$files[$a]);
	$err=csvopen ("_conf/".$files[$a],"copy",$fldup."/_conf/".$files[$a]);
	$err=csvopen ($fldup."/_conf/".$files[$a],"r",1);//check
	if ($err==false) { $error=1;continue; }
	$err=csvopen ("_conf/".$files[$a],"move",$fldup."/_conf/".$files[$a]);
		}
	if ($error==1) echo "<br>File write access denied $fldup/_conf/<br>Interrupted<br>"; // почему нам не дали прав?
	echo "<br>".cmsg ("")."<br>";
	submitkey ("loginstate","DALEE");
	
	hidekey ("step",7); 
	
}
if ($step>6) {
	}

//============================================//
if ($step==7)
{ 
	echo "<br>".cmsg ("INST_NOTE_DB")."<br>";
	//echo "<br>".cmsg ("INST_RMV")."<br>";
	submitkey ("loginstate","DALEE");
	hidekey ("step",8); 
}
if ($step>7) {
	}

//============================================//
if ($step==8)
{	 
	echo "<br>".cmsg ("INST_READY")."<br>";
	echo "<br>".cmsg ("")."<br>";
	submitkey ("loginstate","FINISH");
	hidekey ("step",9);//   LAST STEP
}
if ($step>8) {
	}

	if ($step==9) {
		Header("Location: login.php");exit;
		if ($loginstate=="FINISH") {Header("Location: login.php");exit;}
		//if ($loginstate=="DBLINKER") Header("Location: w.php");
	}
if ($step) {echo "</form>";	closewindow();}
ob_flush ();

//============================================//

///Понятно,что предки приносили в жертву девственниц Они были не дураки, чтобы жертвовать теми кто даёт

function lightcore () { // проверено!!!  не добавлять в ядро!!
 //echo "Lightcore clean start <br>";
 if (!file_exists("adminc.php")) {copy ("admin.php","adminc.php");
 cleancodex ("admin.php","//SYSTEM KEY_START","//SYSTEM KEY_END");};
 if (!file_exists("dbscorec.lib")) { copy ("dbscore.lib","dbscorec.lib");
 cleancodex ("dbscore.lib","//SYSTEM KEY_START","//SYSTEM KEY_END");} ;

}
// Малиган. пожалуйста сделай возм хотя бы главную и регу чтобы можно было смотреть на английском языке (кнопки с флажками и попытка обнаружить принадлежность IP к стране)
function cleancodex ($file,$from,$to) {
 echo "<font color=red>cleancodex clean start $file<br></font>";   // удаляет все упоминания о активации и системе защиты. для создания открытой версии.
$index = strip_tags (file_get_contents($file));

$cdestfile="";$d="";
$array=file($file) ;
$k = count($array) ; $a=0;
while ($a<$k) {
	//echo " ";
//	echo $a."--".$array[$a]; ;// выдача "в чистом виде" для тестов
	$a++;// а не пропускает ли он чего?
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

if ($licenseprint) {
?><br><b><i>License info</i></b>
<br><br>
  <b>Dbscript 4 SE<br></b>
<br>
Special Edition is open source and licensed as MPL 1.1 . This means you can freely use, distribute and sell it. You can also add modifications with condition that these modifications are published under the same license. Also, you can embed it to bigger projects which can use other licenses.
<br>
The source code is manged at SVN or Github
<br>
We do not offer warranty or official support for CE but keep an eye on forum at all times.
Some versions have disabled support win32.
<br><br>


<?php }

?>
