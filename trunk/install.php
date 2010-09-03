<?php ob_start ();
//$writefullcfgdiscrwin=1;
// ÑÊÀÆÅÌ ÍÅÒ ØÀÁËÎÍÀÌ, ìû çà îğèãèíàëüíîå ïğîãğàììèğîâàíèå!
// òîëüêî ëîìàÿ øàáëîíû è ñòåğåîòèïû ìîæíî äîáèòñÿ ÷åãî òî íîâîãî.
//if (!$languageprofile) $languageprofile="english";
$verinst="Install v4.2.5 (c) dj--alex";// service hide
//error_reporting (E_ALL);
//ini_set('error_reporting',E_ALL^E_NOTICE);
$ei="<img src=\"_ico/error.gif\">";
echo "Starting install process dbscript. <br> Module: $verinst<br>";
if ($_POST["step"]<1) {echo "Checking ini<br><div style=\"position:absolute; z-index:4;  top:0; right:0; color: #FFFFFF ; background: #0000aF \"><img src=\"_style/dbsDeusModuslogo.jpg\"></div>";
    //ïåğåïèñàòü msgexiterror  c ó÷¸òîì ôóíêöèè window è âîîáùå ñäåëàòü òàì íàêîíåö âîçìîæíîñòü ìåíÿòü ğàçìåğ îêíà è âîçìîæíî ïåğåìåùàòü åãî.
    $phpmem=ini_get ("memory_limit");if ($phpmem<100) echo "$ei settings php.ini memory_limit=$phpmem , recommend inscrease value at least 100M (for big files and dumps - higher)<br>";
    $phppost=ini_get ("post_max_size");if ($phppost<10) echo "$ei settings : php.ini : post_max_size=$phppost , recommend inscrease value at least 10mb (for big files and dumps - higher)<br>";
$phptag=ini_get ("short_open_tag"); if (!$phptag) die ("$ei <font color=red>Fatal error</font>: settings : php.ini : dbscript requires short_open_tag=on ! This version unsupport work without it. Installation failed. ");
$phpsafe=ini_get ("safe_mode"); if ($phpsafe) echo "settings : php.ini : safe_mode is on. recommend off , it not allows use some inbuild settings and some operations you can get errors without it.<br>";
$phpglob=ini_get ("register_glogals"); if ($phpglob) echo"$ei notify: register globals is on. recommended off for security reasons.<br>";
$phpfunc=ini_get ("disable_function");if ($phpfunc) echo "$ei notify: disabled functions $phpfunc<br>";
if (!extension_loaded('iconv')) echo " $ei Warning : php extension iconv non-exist !  <br>";
if (!extension_loaded('mb_string')) echo "$ei Warning : php extension mb_string non-exist !  <br>";
if ( (!extension_loaded('mb_string')) AND (!extension_loaded('iconv'))) echo "$ei  Error: Dbscript need an php encoder - iconv or mb_string. Without it you cant use encoding functions and/or get bugs .<br>";
if (!extension_loaded('Zend Optimizer')) {echo "$ei <font color=red>Fatal error</font>: extension Zend optimizer not installed.<br> It requires to load core for Dbscript 4.x versions, and not for Dbscript 3.6<br>";
 echo "Note: Zend optimizer for php 5.3 is not exist<br>";
 echo "Try visit official Zend site or download from mirror your version<br>";
 echo "<a href=\"http://wow.chg.su/inside/filemgr.php?c=7ed44827378124d7394f207ba7eff8f3\" >Zend optimizer 3.3.9 32bit Linux</a> *";
 echo "<a href=\"http://wow.chg.su/dbs/filemgr.php?c=a263ea383a7feaaa052fbb91bb261db0\" >Zend optimizer 3.3.9 64bit Linux</a><br>";
 echo " If you need version without Zend optimizer - get open source version here ( <a href=\"http://wow.chg.su/dbs/filemgr.php?c=9b848fa952e76e70ce7ddf9a1c9e7593\">3.6.12</a>)<br>";
 if ($_GET["nozend"]!=1) exit;
 if ($_GET["lightcore"]==1) lightcore ();
// echo "<a href=\"http://wow.chg.su/inside/filemgr.php?c=7ed44827378124d7394f207ba7eff8f3\" >Zend optimizer 3.3.9 win32</a>";

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
$nomnu=1;$coreloadskip=1; $debugmode=false;
$installermode=1;// locks default language to english
$nolayer=1;// óáèğàåì âíåøíèå îêîøêèì

require ('dbscore.lib'); // i/o file  INCLUDED!

@$onloadlocal=opendir ("_conf");
@$errcrtdir=mkdir ("_conf");// langset  styles  required

//echo "Language profile=$lang";

$debugmode=false;$pr[8]=1; //debug off
echo "".$verprogram."<br>";
if (($onloadlocal==false)AND($errcrtdir==false)) { echo "<font color=red>Fatal error</font>: Cannot write to program folder.<br>You must enable writing to user web-server or programm  ( Set rwxr--r-- for script.)";exit; };

if (!isset ($verprogram)) die ("Core loading failed!");
if (($vernumb<4.1)or($vernumb>4.5)) die ("Unsupported version core!");
if (!$step) echo "This version is supported by this installer<br>";

//òåïåğü âñÿ êîíôèãóğàöèÿ çàãğóæàåòñÿ ÷åğåç initalizeSE //$fldup = get from init// âû÷ êàê ëó÷øå îòğåçàòü ïàïêó 
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
<TD WIDTH=75%>Select your language . (after install you can select any language) <br> Âûáåğèòå ïğåäïî÷èòàåìûé ÿçûê . (ïîçæå âû ñìîæåòå âûáğàòü ëşáîé) <br>
    </TD>
<TD WIDTH=30%>
<?php echo "<select name=lang>";
echo "<option value=english>english</option>";
echo "<option value=russian>ğóññêèé</option>";
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
	if (!$NOMYSQL) {@$connect=mysql_connect ($IPDEFSERVSQL, $LOGINSQL , $PASSSQL);
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
	$path=getcwd ()."/_langdb/"; //íàïîëíÿåì áàçó langset
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
{$p[]="0¦admin.php¦0¦Êîíôèãóğàöèÿ¦0¦Admin¦Êîíôèãóğàöèÿ";
$p[]="0¦admin.php¦0¦Êîíôèãóğàöèÿ¦0¦Admin¦Êîíôèãóğàöèÿ";// writefullcsv ïî÷åìó òî ãëîòàåò ïåğâóş ñòğîêó èíîîãäà
$p[]="1¦login.php¦0¦Âõîä¦0¦Enter¦Âõîä¦¦0¦1";
$p[]="2¦w.php¦0¦Ğåäàêòîğ¦0¦Editor¦Ğåäàêòîğ";
$p[]="3¦getfile.php¦0¦Ïîèñê¦0¦Search¦Ïîèñê";
$p[]="4¦r.php?viewid=.ver&base=0¦0¦Âåğñèÿ¦0¦Version¦Âåğñèÿ¦¦0¦1¦1¦";
//$p[]="5¦admin.php?cmd=note¦0¦áëîêíîò¦¦Shared notes¦Îáùèé áëîêíîò¦";
$p[]="5¦admin.php?cmd=test¦0¦Ñàìîòåñò¦¦Self-test¦Ñàìîòåñò¦¦0¦1¦1";
$p[]="6¦filemgr.php¦0¦Ôàéëû¦¦Filemanager¦Ôàéëû¦";
$p[]="8¦dblinker.php¦0¦Ìåíåäæåğ áàç¦0¦DB manager¦Ìåíåäæåğ áàç¦¦";
$p[]="14¦admin.php?cmd=myprof¦0¦Ìîé ïğîôèëü¦0¦My profile¦Ìîé ïğîôèëü¦¦1¦0¦0";
$p[]="9¦r.php?vID=.author&base=0¦0¦Î àâòîğå¦¦Author¦Î àâòîğå¦¦1¦0¦0";
$p[]="11¦r.php?viewid=.info&base=0¦¦Èíôî î ìíå¦¦About me¦Èíôî î ìíå¦¦1¦0¦0";
//$p[]="13¦r.php?vID=.aboutme&base=0¦0¦Ìîè äàííûå¦0¦User info¦Ìîè äàííûå";

}
if ($languageprofile!=="russian") 
{$p[]="0¦admin.php¦0¦Admin¦0¦Admin¦Êîíôèãóğàöèÿ";
$p[]="0¦admin.php¦0¦Admin¦0¦Admin¦Êîíôèãóğàöèÿ";// writefullcsv ïî÷åìó òî ãëîòàåò ïåğâóş ñòğîêó èíîîãäà
$p[]="1¦login.php¦0¦Âõîä¦0¦Enter¦Âõîä¦¦0¦1";
$p[]="2¦w.php¦0¦Ğåäàêòîğ¦0¦Editor¦Ğåäàêòîğ";
$p[]="3¦getfile.php¦0¦Ïîèñê¦0¦Search¦Ïîèñê";
$p[]="4¦r.php?viewid=.ver&base=0¦0¦Âåğñèÿ¦0¦Version¦Âåğñèÿ¦¦0¦1¦1¦";
//$p[]="5¦admin.php?cmd=note¦0¦áëîêíîò¦¦Shared notes¦Îáùèé áëîêíîò¦";
$p[]="5¦admin.php?cmd=test¦0¦Ñàìîòåñò¦¦Self-test¦Ñàìîòåñò¦¦0¦1¦1";
$p[]="6¦filemgr.php¦0¦Ôàéëû¦¦Filemanager¦Ôàéëû¦";
$p[]="8¦dblinker.php¦0¦Ìåíåäæåğ áàç¦0¦DB manager¦Ìåíåäæåğ áàç¦¦";
$p[]="14¦admin.php?cmd=myprof¦0¦Ìîé ïğîôèëü¦0¦My profile¦Ìîé ïğîôèëü¦¦1¦0¦0";
$p[]="9¦r.php?vID=.author&base=0¦0¦Î àâòîğå¦¦Author¦Î àâòîğå¦¦1¦0¦0";
$p[]="11¦r.php?viewid=.info&base=0¦¦Èíôî î ìíå¦¦About me¦Èíôî î ìíå¦¦1¦0¦0";
//$p[]="13¦r.php?vID=.aboutme&base=0¦0¦Ìîè äàííûå¦0¦User info¦Ìîè äàííûå";



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
$p[]="Default¦dbew_b¦ffffff¦000000¦¦"; // åñëè âåçäå ıòà îøèáêà ñ ãëîòàíèåì íóëåâîé ñòğîêè òî óáğàòü åå
$p[]="×åğíûé, ğóññêèé¦dbr_b¦333333¦ffffff¦¦";
$p[]="Áåëûé, ğóññêèé¦dbrw_b¦ffffff¦000000¦¦";
$p[]="White, English¦dbew_b¦ffffff¦000000¦¦";
$p[]="Black, English¦dbe_b¦333333¦ffffff¦¦";
$p[]="Ìàòğèöà, Ğóññêèé¦dbs_b¦333333¦00EE00¦¦";
$p[]="æåñòü¦dbrw_b¦ffff00¦dddd00¦¦";
$p[]="ïóñòîé¦ïóñòîé¦ffffff¦000000¦¦";
$p[]="êğàñíûé, ğóññêèé¦dbr_b¦aa0000¦ffffff¦¦";
$p[]="Ñèíèé, ğóññêèé¦dbr_b¦000066¦ffffff¦¦";
$p[]="cyan_blue_rus¦dbrw_b¦55AAEE¦000055¦¦";
$p[]="cyan_blue_eng¦dbew_b¦ccaa44¦441111¦¦";
$p[]="green_blue¦dbrw_b¦55AA00¦000055¦¦";
$p[]="contrast¦dbrw_b¦000000¦ffffff¦¦";
$p[]="salatov¦dbrw_b¦99FF22¦333333¦¦";
$p[]="fiolet¦dbrw_b¦4b5fac¦11ffff¦¦";
$p[]="desktoptree¦dbrw_b¦ccaa44¦441111¦¦";
$p[]="green_blue, English¦dbew_b¦55AA00¦000055¦¦";
$p[]="contrast, English¦dbew_b¦000000¦ffffff¦¦";
$p[]="salatov, English¦dbew_b¦99FF22¦333333¦¦";
$p[]="fiolet, English¦dbew_b¦4b5fac¦11ffff¦¦";
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

$filbas="_conf/gmdata.cfg";
@$gmdata=csvopen ($filbas,"r","0");$data=readfullcsv ($gmdata,"new");
if ($data==-1) {
//reading gmdata
$gmheader="LOGIN¦PASSWORD¦Àäìèíèñòğèğîâàíèå¦ğåäàêòèğîâàíèå¦ïğîäâèíóòûé ïîèñê¦ìàññ. óäàëåíèÿ¦Îïåğàöèè ñ çàãîëîâêàìè¦perm_4¦perm_5¦perm_6¦Óğîâåíü ïğàâ¦Èñòå÷åíèå ïğàâ* (-1,íåò)¦perm_9¦perm_10¦perm_11¦Çàğåãèñòğèğîâàííîå èìÿ¦Íå ïîêàçûâàòü èíñòğóêöèè¦Ğåäàêòîğ - íåòî÷íûå ñîâïàäåíèÿ¦Ğåäàêòîğ - ïîèñê ïî ëşáîìó ïîëş¦Âûâîäèòü ñîğòèğîâêó*¦Âûâîäèòü ïîñòğàíè÷íî*¦Ñòèëü¦ßçûê¦á22¦á23¦b25¦b26¦b27¦b28¦b29¦b30¦b31¦b32¦b33¦b34¦b35¦b36¦b37¦b38¦b39¦b40¦b41¦b42¦b43¦b44¦b45¦b46¦b47¦b48¦b49¦b50¦b51¦b52¦b53¦b54¦b55¦b56¦b57¦b58¦b59¦b60¦b61¦b62¦b63¦b64¦b65¦b66¦b67¦b68¦b69¦b70¦b71¦b72¦b73¦b74¦b75¦b76¦b77¦b78¦b79¦b80¦b81¦b82¦b83¦b84¦b85¦b86¦b87¦b88¦b89¦b90¦b91¦b92¦b93¦b94¦b95¦b96¦b97¦b98¦b99 ¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦";
$gmplevel="a¦d¦a¦a¦d¦d¦d¦d¦d¦d¦a¦d¦d¦d¦d¦a¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦";

$ADMM=0;
for ($a=0;$a<200;$a++) {
        $prauth[$ADMM][$a]="0";//debug
	if (($a>24)AND($a<37)) $prauth[$ADMM][$a]="1";
}
$prauth[$ADMM][0]=stripslashes ($LOGINUSER); 			$prauth[$ADMM][1]=hashgen ($PASSWORDUSER);$prauth[$ADMM][42]=1;
$prauth[$ADMM][15]=$prauth[$ADMM][0];$prauth[$ADMM][22]=$lang;
$prauth[$ADMM][21]="Default";$prauth[$ADMM][10]=10;

 //áëÿäü äà ÷òîæ òàêîå  ñóêà òóïîğûëûå ïåğåìåííûå íèõåğà íå æåëàşò íè÷åãî çàïîìèíàòü!!!!!!!!!!!
 if ($OSTYPE=="LINUX") $prauth[$ADMM][199].="sayfuck\n";
 //$prauth[$ADMM][198]=$prauth[$ADMM][198]."sayfuck2\n"; $prauth[$ADMM][199]="199sayfuck2\n"; $prauth[$ADMM][200]="200fuck\n";
$prauth[1]=$prauth[0];// eto i est sohranenie!!!!!!!!!!!!!!!!!!!!1111
//..$prauth="";// òóò äîáàâëÿåì íàøåãî şçåğà
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
$dbheader="File base¦Base visual name¦Ïîääåğæêà êàğòèíîê¦Tèï scr¦Ğåæèì 3 (Êàòåãîğèÿ)¦Òàáëèöà Mysql¦Õîñò Mysql ¦Òèï êàòåãîğèè¦Êîëîíêà êàğòèí¦Âûáèğàòü áàçó¦Ğåæèì 1 (Èìÿ)¦Ğåæèì 2 (Êîä)¦Use Mysql¦Ïğàâà íà çàïèñü¦Ïğàâà òğåáóåìûå áàçîé¦Òğåá. âèğòóàëüíûé ID¦Îòáîğ êîëîíîê¦reserved17¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd¦hd";
$dbplevel="d¦5¦d¦d¦d¦d¦d¦d¦d¦d¦a¦d¦a¦d¦5¦5¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦d¦dr";
$prdbdata="";//
	 @$tempdescr=csvopen ("_conf/dbdata.cfg","w",1);
$dbheader=splitcfgline ($dbheader);
 $dbplevel=splitcfgline ($dbplevel);
//$pgcontent=splitcfgline ($pgcontent);
$err.=writefullcsv ($tempdescr,$dbheader,$dbplevel,$prdbdata);$edit=0;
//writing dbdata
}
if ($languageprofile!=="russian") $sitedata="dbslogo.gif¦Welcome string.¦1¦80% Nimbus Roman No9 L¦by name¦by code¦by code2¦showall¦¦¦¦0¦999¦¦root¦localhost¦Dbscript¦¦512¦".$encodingforce."¦main fields¦select field¦all fields¦by comm¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
if ($languageprofile=="russian") $sitedata="dbslogo.gif¦Äîáğî ïîæàëîâàòü â íàø ñåğâèñ. Âûáåğèòå áàçó è ñïîñîá ïîèñêà è ââåäèòå íàçâàíèå îáúåêòà ïîèñêà.¦1¦80% Nimbus Roman No9 L¦ïî íàçâàíèş¦ïî êîäó ¦ïî íàçâàíèş2¦îòîáğàçèòü âñ¸¦mp3pereim.php¦127.0.0.1¦D:/system/www/dj/filemgr/¦0¦999¦¦root¦localhost¦Dbscript¦¦2048¦".$encodingforce."¦ïî âàæíûì ïîëÿì¦âûáğàòü ïîëå¦ïî âñåì ïîëÿì¦ïî êîììåíòàğèÿì¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
$property="4.0¦4.0¦1¦1¦1¦1¦¦1¦1¦¦¦¦1¦¦¦0¦¦¦¦¦¦¦1¦1¦1¦¦1¦50¦default¦1¦1¦1¦1¦1¦¦1¦¦1¦1¦/media/D/¦1000¦¦html,gif,bmp,png¦127.0.0.1¦20¦1¦1¦on¦¦on¦¦¦on¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦¦";
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
$err.=fwrite ($site,$sitedata);//ãîäèòñÿ ïîëí äëÿ îòêğûòîãî ïîòîêà è îäíîñòğî÷íîãî ôàéëà
fclose ($site);
$filbas="_conf/property.cfg";
$desc=csvopen ($filbas,"w",1);
$err.=fwrite ($desc,$property);
fclose ($site);
//echo "Error:$err<br>";
//if ($err>3) die ("Fatal error, configs skipped ,write protect>?");
	//åñëè íåò pages,styles ñîçäàşòñÿ ñ ñîäåğæèìûì çàğàíåå ñîõğàíåííûì òóò
	//langdb ôîğìèğóåòñÿ ïî ïàïêå,âñå çàãîëîâêè áåğóòñÿ îòñşäà
	//gm ñîäåğæèò òîëüêî 1 ÷åë, db,dn,ed -òîëüêî çàãîëîâêè
	//sitedata,property íèêóäà íå ïåğåìåùàşòñÿ,îñòàëüíûå ìîãóòü áûòü ïåğåìåùåíû ïîñëå ñîçäàíèÿ íà øàãå 5 
}
if ($step>4) {
	}


	
//============================================//

//echo "sh=$sharedconf !!!<br>";exit;
if (($step==5)AND(!$sharedconf)) $step=7;

if ($step==5)
{   if ($sharedconf) {
	lprint ("INST_SHARED_SEL");echo "<br>";
		// ôàéëû ê ıòîìó ìîìåíòó óæå äîëæíû áûòü ñãåíåğèğîâàíû è õîòÿ áû áûòü â íàëè÷èè
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
	if ($error==1) echo "<br>File write access denied $fldup/_conf/<br>Interrupted<br>"; // ïî÷åìó íàì íå äàëè ïğàâ?
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
exit;

///Ïîíÿòíî,÷òî ïğåäêè ïğèíîñèëè â æåğòâó äåâñòâåííèö Îíè áûëè íå äóğàêè, ÷òîáû æåğòâîâàòü òåìè êòî äà¸ò

function lightcore () { // íåïğîâåğåíî!!!  íå äîáàâëÿòü â ÿäğî!!
 if (!file_exists("adminc.php")) {copy ("admin.php","adminc.php");
 cleancodex ("admin.php","//SYSTEM KEY_START","//SYSTEM KEY_END");};
 if (!file_exists("dbscorec.lib")) { copy ("dbscore.lib","dbscorec.lib");
 cleancodex ("dbscore.lib","//SYSTEM KEY_START","//SYSTEM KEY_END");} ;

}
// Ìàëèãàí. ïîæàëóéñòà ñäåëàé âîçì õîòÿ áû ãëàâíóş è ğåãó ÷òîáû ìîæíî áûëî ñìîòğåòü íà àíãëèéñêîì ÿçûêå (êíîïêè ñ ôëàæêàìè è ïîïûòêà îáíàğóæèòü ïğèíàäëåæíîñòü IP ê ñòğàíå)
function cleancodex ($file,$from,$to) {
    // óäàëÿåò âñå óïîìèíàíèÿ î àêòèâàöèè è ñèñòåìå çàùèòû. äëÿ ñîçäàíèÿ îòêğûòîé âåğñèè.
$index = strip_tags (file_get_contents($file));

$cdestfile="";$d="";
$array=file($file) ;
$k = count($array) ; $a=0;
while ($a<$k) {
	//echo " ";
//	echo $a."--".$array[$a]; ;// âûäà÷à "â ÷èñòîì âèäå" äëÿ òåñòîâ
	$a++;// à íå ïğîïóñêàåò ëè îí ÷åãî?
	$b=$array[$a-1];$strleng=strlen ($b);

    if (strpos ($b,$from)!==false) { $startskipmode=1;	}
	if (strpos ($b,$to)!==false) {$startskipmode=0;continue;		}
                if ($startskipmode==0) $cdestfile=$cdestfile.$b ; continue;

	}
        //$cdestfile=."//cleaned by cleancode";
$datafile = fopen ($file,"w") or die ("Íå óäàëîñü çàïèñàòü, èçâèíèòå.");
@fwrite ($datafile ,$cdestfile);
@fflush ($datafile);
@fclose ($datafile);
//echo ("<a href=\"adminf.php\">Âàø ôàéë òóò.</a> Íå çàáóäüòå íàæàòü F5 äëÿ îáíîâëåíèÿ.");
}



?>