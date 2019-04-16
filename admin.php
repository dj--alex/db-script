<?php // Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex
$veradm="Admin v4.3.4 (c) dj--alex";
 //register_shutdown_function ("endtm");
require_once ('initalize.php'); // функция подготовки к работе и авторизации
 if ($cmd=="setconflic") {
    //generic activation table
     ////reading pages
 $filbas="_data/licenses.dat";
 } //else { echo "License list already set";exit; };

     //generic activation table
     //
 //У рекламы есть и хорошие стороны - теперь все знают, где женщины прячут свои крылышки<br>
autoexecsql (); 
if (!$activation) Header("Location: login.php");
   if (!isset($_SERVER['PHP_AUTH_USER']) ||
   ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
  authenticate ();}  
$pageenter=0;
if ($frameoldcore==1) $write=getvar ('write');//пока не нашел почему равные переменные не равны  write не сравнивается!!!
import_request_variables ("PG","");  // универсальное решение проблемы
     if ($write==cmsg("LST_SHA_FLS")) { header ("Location: r.php?tbl=files&m=4&vID=1&vID2="); };
        if ($write==cmsg("LST_SHA_FLS_DL")) { header ("Location: r.php?tbl=files&m=7.9&vID=!0"); };
        if ($write==cmsg("LST_SHA_FLS_NO")) { header ("Location: r.php?tbl=files&m=7.9&vID=0&fullfield=on"); };

if ($dbsaa) { 
	setcookie ("dbsa",$dbsaa,time ()+1000);
	Header("Location: admin.php?cmd=myprof");	exit;			}
$enterpoint=$veradm;
if ($encoder=="not installed") errorlog ("Dbscript need an php encoder - iconv or mb_string.");


 // настройка префиксов для работы с любым языкомым cmd
if ($cmd=="test") { testcfgs () ; exit; }
if ($cmd=="note") { bloknot (); exit; }
if ($cmd=="asql") { asqledit (); exit; }
if ($cmd=="cssed") { cssed (); exit; }
//RIGHTS LIMITATION
$gmlimitcfg=0;
if ($ADM==0) { msgexiterror ("notright","","disable");Header("Location: login.php");}
if ($prauth[$ADM][1]==false) { msgexiterror ("notright","","disable");exit;}
If ($prauth[$ADM][2]==false) { $gmlimitcfg=1;} else {$adm=1;};// { 
//RIGHT LIMITATION END

if ($cmd=="myprof") {$go=cmsg("A_MY_PROF"); displayconfigtblsd () ; exit; }

// CFG OPT FUTURE  TODO:
// Убирание меню в редакторе и поиске.  // nomnu=1 включать для unframedmode

//if (!$pr[8]) echo "DEBUG MODE:dont try to fix me im not broken<br>";
	echo "<cite>".cmsg("A_WELC").$prauth[$ADM][15]." <br></cite>";   

 if ($nokeys==1) nokeys (1);
 if ($daysleft<1) expire ();

   if ($write==1) {  $act="Write data";	logwrite ($act);write () ; dispref (); exit; }
   if ($write==2) { $act="Write tbldata $tbl";	logwrite ($act);writeconfigtbl () ; dispref (); exit;}
   if ($write==3) { $act="Write GMdata ".$prauth[$ADMM][0]." $ADMM ";	logwrite ($act); writeconfigtblsd () ; dispref ();exit;}

   if ($write==cmsg("SYNC")) { sync ("") ; exit; }
   if ($write==cmsg("SYNC_ST")) { autoupdatecfgs ($files) ; exit; }
   if ($write==cmsg("SVN_UPD")) { syncsvn ("") ; exit; }

function sync ($conf) {
global $mirroraddress,$pr;//$mirroraddress="http://la2.chg.su/dbs4/_conf/";
$mirroraddress=$pr[96];
if (!$mirroraddress) { echo "Mirror not found";exit;};
lprint ("SYNC_SEL");echo "<br><form action=admin.php>";
		// файлы к этому моменту уже должны быть сгенерированы и хотя бы быть в наличии
		$path=getcwd ()."/_conf/";	//	$path2=$fldup."/_conf";$path3=getcwd ()."/_langdb/";
		$mask="*.cfg";	$protect[]="*.php";$nameselect="files";
		filesselect ($path,$mask,$protect,$nameselect,7);
                submitkey ("write","SYNC_ST");
                echo "</form>";

}

   if (($go==cmsg("A_CNEW")) AND ($write==3)AND ($prauth[$ADM][10]>1)) { $act="Create GMdata".$prauth[$ADMM][0]." $ADMM ";	logwrite ($act); writeconfigtblsd () ; dispref ();exit;}
   if (($go==cmsg("A_CDEL")) AND ($write==3)AND ($prauth[$ADM][10]>1)) { $act="Delete GMdata".$prauth[$ADMM][0]." $ADMM ";	logwrite ($act); writeconfigtblsd () ; dispref ();exit;}
//..A_CNEW  bug create user
   if ($write==cmsg("A_TEST")) { testcfgs () ; exit; }
   if ($write==cmsg("DB_MGR")) { dbmgr () ; exit; }
   if ($write==cmsg("CHK_UPD")) { chkupd () ; exit; }
   if ($write==cmsg("CHK_LIC")) { chklic () ; exit; }
	if (($write==cmsg("A_NOTE"))or($go==cmsg("A_NOTEWR"))) { bloknot () ;exit; };
   

	//if (($write==cmsg("SAVE"))or($go==cmsg("SAVE"))) { bloknot () ;exit; };
	if (($write==cmsg ("A_ASQL_ED"))or($go==cmsg("A_ASQL_ED"))) { asqledit () ;exit; };
if (($write==cmsg ("A_ACSS_ED"))or($go==cmsg("A_ACSS_ED"))) { cssed () ;exit; };
	if ($go==cmsg("A_MY_PROF")) displayconfigtblsd () ; 
 if ($write==cmsg ("ADM_DEL_OFF_TABLES")) { deleteemptytables (); exit; };

   if (($write===cmsg("A_USR_CFG"))or($write==cmsg("A_USR_CN"))) { displayconfigtblsd () ; }
      if ($gmlimitcfg===1) { displayconfigtblsd () ; } //лимитировалка прав
    if ($write===cmsg("A_BCK_CFG")) { backupcfgs () ; }
	if ($write===cmsg("A_RES_CFG")) { restorecfgs () ; }
 	if ($prauth[$ADM][42]) {
		echo "<br>";
	if ($OSTYPE=="LINUX") { ;
				if ($write===cmsg ("MYSQL_STOP")) {
					$a=passthru ("/etc/init.d/mysql stop"); 
				echo $a."<br>";
					}
				if ($write===cmsg ("MYSQL_START")) {
					$a=passthru ("/etc/init.d/mysql start"); 
				echo $a."<br>";
				}
				if ($write===cmsg ("MYSQL_REBOOT")) {
				$a=passthru ("/etc/init.d/mysql restart");
				echo $a."<br>";
				}
				if ($write===cmsg ("APACHE_REBOOT")) {
				$a=passthru ("/etc/init.d/apache2 restart");
				echo $a."<br>";
				}
	
	}  ;
	if ($write===cmsg ("MYSQL_STOP")) { ; }  ;
	if ($write===cmsg ("MYSQL_REBOOT")) { ; } ; 
	if ($write===cmsg ("APACHE_REBOOT")) { ; } ; 
	if ($write===cmsg ("EXEC_SHELL_CMD")) { Header("Location: command.php");; } ; 
 	}
 	
   	echo $veradm."<br>";
	echo lprint ("VCONF").": ".$pr[1]."<br> ".cmsg("A_DOW_LOG")."<a href='_logs/log.dat'>Log</a>,<a href='_logs/errorlog.dat'>Errorlog</a>,<a href='_logs/undolog.dat'>Undolog</a>,<a href='_logs/reportlog.dat'>reportlog</a>,<a href='_logs/execsqllog.dat'>execsqllog</a>";
?>
    <a target=help href="http://code.google.com/p/db-script/issues"><img src=_ico/bug1.png border=1 title="<?php echo cmsg (BUGDET)." ".$write?>"></a>
    <br>
    <?php

if (($pr[54])OR(!$dbstyle3en)) { ?>	<a href="mailto:dj--alex@ya.ru">email author</a>
 <a href="http://dj.chg.su/dbscript/">Visit site</a>.

 <?php }
	for ($a=0;$a<count ($pr);$a++) { ${"pr".$a}=stripslashes ($pr[$a]);} //новое чтение конфигов,корректное
	for ($a=0;$a<count ($sd);$a++) { ${"sd".$a}=stripslashes ($sd[$a]);}  //PARTIAL EXCHANGE

	/*$pr2= stripslashes ($pr[2]);*/

        
$backupstate=@csvopen ("_conf/dbdata.cfg.backup.dat","r","0");
?><form action=admin.php method="post">
 <?php  submitkey ("go","A_MY_PROF");
 submitkey ("write","A_USR_CFG");
 
 ?>
</form>
	<form action="w.php" method=post>
<?php submitkey ("write","KEY_CFG");
?>
<input type= hidden name= tbl value=0>
</form>
<?php//   submitkey ("go","A_SQLRES"); hiddenkey ("write","KEY_S_EXEC	");hidekey ("tbl",1);hidekey ("vd","SHOW PROCESSLIST ;");
 // echo "<form action=w.php method=post>";  submitkey ("go","A_SQLDBS");  hiddenkey ("write","KEY_S_EXEC");hidekey ("tbl",1);hidekey ("vd","SHOW DATABASES ;"); echo "</form>";
  // echo "<form action=w.php method=post>";submitkey ("go","A_SQLCFG"); hiddenkey ("write","KEY_S_EXEC");hidekey ("tbl",1);hidekey ("vd","SHOW VARIABLES ;"); echo "</form>";
		?> <form action=admin.php method=post>
<?php  submitkey ("write","A_TEST");submitkey ("write","DB_MGR");submitkey ("write","CHK_UPD");submitkey ("write","CHK_LIC");?> </form>
<?php if ($prauth[$ADM][10]>1) { ?>
		<form action=admin.php method=post>

	<?php submitkey ("write","A_NOTE"); ?> <?php submitkey ("write","LST_SHA_FLS"); ?> <?php 
        submitkey ("write","LST_SHA_FLS_DL");
        submitkey ("write","LST_SHA_FLS_NO"); ?>
	<?php submitkey ("write","A_ASQL_ED"); ?>
	<?php if ($codekey==6) submitkey ("write","A_ACSS_ED"); ?>
		</form> <?php };  ?>
		<form action=admin.php method=post>
	<?php submitkey ("write","A_BCK_CFG"); ?>  <?php if ($backupstate) {print "<grn> Backup ok.</grn>";} else { print"<red> Backup not found!</red>";}; ?>
	<?php if ($backupstate) { submitkey ("write","A_RES_CFG");}  ?></form>
 
 		<?php if ($prauth[$ADM][42]) {?>
 		<form action=admin.php method=post>
	<?php echo "</red>";lprint (SRV_SU_MSG);echo "<br>";
	submitkey ("write","MYSQL_START"); 
	submitkey ("write","MYSQL_STOP"); 
	submitkey ("write","MYSQL_REBOOT"); 
	submitkey ("write","APACHE_REBOOT"); 
	submitkey ("write","EXEC_SHELL_CMD");

  submitkey ("write","SYNC");
  //submitkey ("write","SYNC_ST");
  

	?></form><?php 		}


	function firsttableelement () {echo "<tr >"; echo "<td>";};
 	function nextstrokeelement () { echo "</tr><tr>";	 echo "</td><td>";};
	function nextkolumnelement () {echo "</td><td>"; };
	function nextstrokeelement2 () { echo "</tr><tr>";	 echo "</td><td>";};
	
	hidekey ("write",1); echo "<br><ii><bb>";
		echo "<form action=admin.php method=post> ";
	echo "<table id=Adminpanel border=2 bordercolor=#402621 style=\" color: #".$rgbtext."; \" ;width=80%>"; //font : ".$systemshrift."; работать будет , но не надо этого

	 firsttableelement ();
	 hidekey ("write",1);
	 echo "<ii><bb>";lprint ("A_CFG_RF") ; echo "</ii></bb></bb>";
	  nextstrokeelement ();
	 lprint ("A_CFG_BSSIZ") ;nextkolumnelement (); inputtxt ("pr2",3);
	nextstrokeelement ();
	 lprint ("MENU_SPC") ;nextkolumnelement () ;inputtxt ("pr44",4);  echo "<br>";
	 nextstrokeelement ();
   lprint ("A_CFG_SRCHDEF") ; nextkolumnelement ();inputtxt ("pr15",4);  lprint ("A_CFG_DEF0") ; 
 //  echo "</tr></table>";
   nextstrokeelement ();
   lprint ("A_CFG_BSDEF") ; nextkolumnelement ();inputtxt ("pr16",4); lprint ("A_CFG_DEFEM") ; 
     nextstrokeelement ();
    lprint ("A_MIN_LETT") ;nextkolumnelement (); inputtxt ("sd13",4);
    nextstrokeelement ();
   lprint ("A_MIN_HLP") ; 
   nextstrokeelement ();
 echo "<ii><bb>";lprint ("A_INT_SERV") ; echo "</ii></bb></bb><br>";
  nextstrokeelement ();
 lprint ("A_LET_SIZE") ;nextkolumnelement (); inputtxt ("sd3",30);
   nextstrokeelement ();
   lprint ("A_BUTT_SIZE") ;nextkolumnelement (); inputtxt ("sd28",30);
   nextstrokeelement ();
   lprint ("A_TABL_SIZE") ;nextkolumnelement (); inputtxt ("sd29",30);
   nextstrokeelement ();
  lprint ("A_FIL_LOGO") ;nextkolumnelement (); inputtxt ("sd0",12);
    nextstrokeelement ();
  echo "<br>";lprint ("A_INC_MOD_FMGR") ;nextkolumnelement (); inputtxt ("sd8",14);  echo "<br>";
    nextstrokeelement ();
 echo"Host to autoexec sql :";nextkolumnelement ();inputtxt ("sd15",14); 
   nextstrokeelement ();
lprint ("A_EN_EV_SRCH_AEXEC");nextkolumnelement ();
 echo "<select name=sd11>";
	for ($a=0;$a<6;$a++) {
		if ($prdbdata[$a][0]=="") continue;
		if ((16*$a)==$sd[11]) {$sel="selected";}else {$sel="";};
	echo "<option value=".(16*$a)." $sel>".cmsg ("SEL_".$a)."</option>";}
 echo "</select>";
   nextstrokeelement ();
 echo "<br><ii><bb>";
  lprint ("A_HDR_NAM_MD") ; echo "</ii></bb></bb><br>";
    nextstrokeelement ();
  lprint ("A_HD_UP") ; nextkolumnelement ();txtarea ("sd1",70,2);  lprint ("");
    nextstrokeelement ();
  lprint ("A_HD_DW") ;nextkolumnelement (); ?><textarea name=sd2 cols=70 rows=2 ><?=$sd2; ?></textarea>  <br>
  <?php     nextstrokeelement ();
  lprint ("A_METATAG") ;nextkolumnelement (); ?><textarea name=sd24 cols=70 rows=2 ><?=$sd24; ?></textarea>  <br>
     <?php        nextstrokeelement ();
  lprint ("FMG_HELLO") ;nextkolumnelement (); ?><textarea name=sd27 cols=70 rows=2 ><?=$sd27; ?></textarea>  <br>
     <?php 
  nextstrokeelement ();
    lprint ("A_BRW_TITLE") ; nextkolumnelement ();inputtxt ("sd16",40);echo  "<br>";
     nextstrokeelement ();
  lprint ("A_FLD_LIM") ; nextkolumnelement ();inputtxt ("sd12",5);
    //nextstrokeelement ();
   lprint ("A_FLD_HLP") ;  
    nextstrokeelement ();
    lprint ("A_PAG_ENC") ;nextkolumnelement (); inputtxt ("sd19",14);//nextkolumnelement (); lprint ("A_PAG_HLP") ; 
     nextstrokeelement ();
 echo "<br><ii><bb>";lprint ("A_UNREG_EN") ; echo "</ii></bb></bb><br>";
   nextstrokeelement ();
checkbox ($pr[3],"pr3"); echo cmsg ("A_MODE")." 1 ";nextkolumnelement (); inputtxt ("sd4",20);
   nextstrokeelement ();
checkbox ($pr[4],"pr4"); echo cmsg ("A_MODE")." 2 "; nextkolumnelement ();inputtxt ("sd5",20);	 
   nextstrokeelement ();
checkbox ($pr[5],"pr5"); echo cmsg ("A_MODE")." 3 ";nextkolumnelement ();inputtxt ("sd6",20);
  nextstrokeelement ();
checkbox ($pr[6],"pr6"); echo cmsg ("A_MODE")." 4 ";nextkolumnelement ();inputtxt ("sd7",20);
  nextstrokeelement ();
checkbox ($pr[29],"pr29"); echo cmsg ("A_MODE")." 6 ";nextkolumnelement ();inputtxt ("sd20",20);
  nextstrokeelement ();
checkbox ($pr[30],"pr30"); echo cmsg ("A_MODE")." 7 ";nextkolumnelement ();inputtxt ("sd21",20);
  nextstrokeelement ();
checkbox ($pr[31],"pr31"); echo cmsg ("A_MODE")." 8 ";nextkolumnelement ();inputtxt ("sd22",20);
  nextstrokeelement ();
checkbox ($pr[32],"pr32"); echo cmsg ("A_MODE")." 10 ";nextkolumnelement ();inputtxt ("sd23",20);
  nextstrokeelement ();

   echo "<ii><bb>"; lprint ("A_PHP_CFG") ; ?></ii></bb></bb><br>
 <?php   nextstrokeelement ();
 if (($codekey==7)OR($codekey==7)OR($codekey==7)OR($codekey==7))
		{ echo cmsg ("A_DEM_NOSQL")."<br>" ;
		  if (1==1) {// потом позже поправлю чтобы даже уберхакеру было нельзя выдрать
					?><input type= hidden name=sd14 value="A_DEM_NOSQL"> <?php
					}
		} else {
			  nextstrokeelement ();
		 lprint ("A_LOG_DB");nextkolumnelement (); inputtxt ("sd14",12);
		   nextstrokeelement ();
		 lprint ("A_PS_DB"); nextkolumnelement ();inputtxt ("sd17",12);echo"<br>";
		   nextstrokeelement ();
		} ;
		  nextstrokeelement ();
 lprint ("A_PHP_MEM") ;  nextkolumnelement ();inputtxt ("sd18",4);echo "(32,64,128,256)<br>";
   nextstrokeelement ();
   echo cmsg ("SYNC_MIR");nextkolumnelement ();inputtxt ("pr96",32); //pr97 free
nextstrokeelement ();

  lprint ("PATH_DUMP") ;nextkolumnelement (); inputtxt ("pr39",14);  echo "<br>";
    nextstrokeelement ();
    lprint ("DEF_SQL_ENC") ;nextkolumnelement (); inputtxt ("pr76",14);  echo "<br>";
    nextstrokeelement ();
  lprint ("A_PHP_LEN_EXEC") ;nextkolumnelement (); inputtxt ("pr40",5);  echo "<br>";
    nextstrokeelement ();
lprint ("FMG_ROOT") ; nextkolumnelement ();inputtxt ("pr41",15);  echo "<br>";
  nextstrokeelement ();
lprint ("FMG_FREE") ;nextkolumnelement (); inputtxt ("sd10",15);  echo "<br>";
        nextstrokeelement ();
                checkbox ($pr[69],"pr69"); echo cmsg ("FILE_LIM");nextkolumnelement (); inputtxt ("sd26",6);  echo "Mb";
	nextstrokeelement ();
         echo cmsg ("MAXSPEED");nextkolumnelement (); inputtxt ("sd37",6);  echo "Kb\s";
	nextstrokeelement ();

lprint ("ADD_HDD") ;nextkolumnelement (); inputtxt ("pr79",27);  checkbox ($pr[80],"pr80"); echo cmsg ("ADD_HDD_SUM"); echo "(,)<br>";
        nextstrokeelement ();
        echo cmsg ("EN_UNREG");nextkolumnelement ();
        checkbox ($pr[66],"pr66"); echo cmsg ("FMG_SHARE");
        checkbox ($pr[67],"pr67"); echo cmsg ("FMG_DOWNLOAD");
        checkbox ($pr[71],"pr71"); echo cmsg ("FMG_UPLOAD");
        checkbox ($pr[72],"pr72"); echo cmsg ("NAVI");
        checkbox ($pr[73],"pr73"); echo cmsg ("HIDE_FLLST")."<br>";
        
  nextstrokeelement ();
lprint ("DENY_TYPES") ;nextkolumnelement (); inputtxt ("pr42",25);  echo "(,)<br>";
  nextstrokeelement ();
lprint ("SQL_SRV_DEF") ;nextkolumnelement (); inputtxt ("pr43",25);  echo "<br>";
  nextstrokeelement ();
 	    	     
echo "</td></tr></table>";
echo"<ii><bb> ";
 lprint ("A_AN_CFG") ; 
   nextstrokeelement ();echo "</ii></bb></bb>";
   
echo "<table id=Adminpanel border=2 width=80% style=\" color: #".$rgbtext."; \"  bordercolor=#403631 >";
 firsttableelement();
checkbox ($pr[7],"pr7"); echo cmsg ("A_DIRLINK")."<br>";
  nextstrokeelement ();
checkbox ($pr[8],"pr8"); echo cmsg ("A_NODEBUG");if ($codekey==8) lprint ("BLOCK");
  nextstrokeelement ();
checkbox ($pr[9],"pr9"); echo cmsg ("A_NOCOMM")."<br>";
  nextstrokeelement ();
checkbox ($pr[10],"pr10"); echo cmsg ("A_NOLOGO")."<br>";
  nextstrokeelement ();
  checkbox ($pr[11],"pr11"); echo cmsg ("A_NOUNREG")."<br>";
    nextstrokeelement ();
  checkbox ($pr[13],"pr13"); echo cmsg ("A_USR_REV");
//    nextstrokeelement ();
  checkbox ($pr[14],"pr14"); echo cmsg ("A_PERM");
  //  nextstrokeelement ();
  checkbox ($pr[17],"pr33"); echo cmsg ("A_ADDKEY")."<br>";
    nextstrokeelement ();
  //checkbox ($pr[18],"pr18"); echo cmsg ("A_ADDKEY")." ".cmsg ("A_M14")."<br>";
  checkbox ($pr[20],"pr20"); echo cmsg ("DIS_DBS_ARCH")."<br>";	
  nextstrokeelement ();
   checkbox ($pr[19],"pr19"); echo cmsg ("A_SRCHTYP")."";	
     nextstrokeelement ();
   checkbox ($pr[33],"pr33"); echo cmsg ("A_EN_FULFLD")."<br>";	
  nextstrokeelement ();
  //SYSTEM_KEY_START
	    checkbox ($pr[34],"pr34"); echo cmsg ("A_HDR_GLOBBYDEF")."<br>";	
	      nextstrokeelement ();
              //SYSTEM_KEY_END
 	    checkbox ($pr[12],"pr12"); echo cmsg ("A_EN_USRLOG");	cmsg ("READ");
 	nextstrokeelement ();
 	  checkbox ($pr[21],"pr21"); echo cmsg ("A_IP_FILTER"); inputtxt ("sd9",25);  echo "(,)";
 	    	      
	 echo cmsg ("A_CMD_FILTER"); inputtxt ("sd25",25);  echo "(,)";
 	    	      nextstrokeelement ();
    checkbox ($pr[22],"pr22"); echo cmsg ("A_EN_MULUSR")."";	
      //nextstrokeelement ();
    checkbox ($pr[23],"pr23"); echo cmsg ("A_PERM").";";	
	//  nextstrokeelement ();
?><?php lprint ("A_ML_LIM") ;
//nextkolumnelement (); 
inputtxt ("pr27",8);
    nextstrokeelement ();
   checkbox ($pr[24],"pr24"); echo cmsg ("A_MRF");	
     nextstrokeelement ();
   checkbox ($pr[25],"pr25"); echo cmsg ("A_HDR_INCDEL")."<br>";	
     nextstrokeelement ();
   checkbox ($pr[26],"pr26"); echo cmsg ("A_HDR_NOCHKROW")."<br>";	
     nextstrokeelement ();

	 checkbox ($pr[35],"pr35"); echo cmsg ("A_NOTRIALMSG")."<br>";	
	   nextstrokeelement ();
	 checkbox ($pr[36],"pr36"); echo cmsg ("A_NONEWAUTH")."<br>";	
	   nextstrokeelement ();
	 checkbox ($pr[37],"pr37"); echo cmsg ("A_EN_GRP")." ";	
	   //..nextstrokeelement ();
	 checkbox ($pr[38],"pr38"); echo cmsg ("A_GRP_ALW_SQL")."<br>";		 
	   nextstrokeelement ();
	 checkbox ($pr[47],"pr47"); echo cmsg ("A_USR_FLDR")."<br>";		
	   nextstrokeelement ();
checkbox ($pr[48],"pr48"); echo cmsg ("A_CMP_EN")."<br>";		 
  nextstrokeelement ();
checkbox ($pr[49],"pr49"); echo cmsg ("EN_BUG_REP")."<br>";		 
  nextstrokeelement ();
checkbox ($pr[50],"pr50"); echo cmsg ("DIS_MNU_KEY")."<br>";		 
  nextstrokeelement ();
checkbox ($pr[51],"pr51"); echo cmsg ("A_OVER_MSG")."<br>";		 
  nextstrokeelement ();
checkbox ($pr[52],"pr52"); echo cmsg ("A_EN_BEST")."<br>";		 
  nextstrokeelement ();
checkbox ($pr[53],"pr53"); echo cmsg ("A_SIM_LOCK")."<br>";		 
  nextstrokeelement ();
checkbox ($pr[54],"pr54"); echo cmsg ("MENU_DM_MD_3");		 
  nextstrokeelement ();
checkbox ($pr[55],"pr55"); echo cmsg ("LOCK_STR0")."<br>";
  nextstrokeelement ();
//  nextstrokeelement ();
	 checkbox ($pr[46],"pr46"); echo cmsg ("A_OFF_MENU");		 checkbox ($pr[45],"pr45"); echo cmsg ("A_OFF_MENU_IC")."<br>";		 
	   nextstrokeelement ();
	 	 echo cmsg ("USER_OPT1");
         checkbox ($pr[56],"pr56"); checkbox ($pr[57],"pr57"); checkbox ($pr[58],"pr58"); checkbox ($pr[59],"pr59"); checkbox ($pr[60],"pr60");
         checkbox ($pr[61],"pr61"); checkbox ($pr[62],"pr62"); checkbox ($pr[63],"pr63"); checkbox ($pr[64],"pr64"); checkbox ($pr[65],"pr65");
        nextstrokeelement ();
        checkbox ($pr[68],"pr68"); echo cmsg ("REDIR_UPL")."<br>";
	nextstrokeelement ();

        checkbox ($pr[70],"pr70"); echo cmsg ("EN_SMP_SHA")."<br>";
        nextstrokeelement ();
checkbox ($pr[74],"pr74"); echo cmsg ("DIS_FL_DWN_LNK")."<br>";
nextstrokeelement ();
checkbox ($pr[75],"pr75"); echo cmsg ("UPL_MOD")."<br>";
nextstrokeelement ();
checkbox ($pr[78],"pr78"); echo cmsg ("BL_SHR")."<br>";
nextstrokeelement ();
checkbox ($pr[81],"pr81"); echo cmsg ("DBS3_MNU_MKEYMODE")."<br>";
nextstrokeelement ();
checkbox ($pr[82],"pr82"); echo cmsg ("SQL_LOGS");echo " ".cmsg ("DBS#"); ;inputtxt ("sd30",6);  echo "<br>";
nextstrokeelement ();

checkbox ($pr[83],"pr83"); echo cmsg ("VK");echo " ".cmsg ("VKLNK"); ;inputtxt ("sd31",9);  echo "<br>";
nextstrokeelement ();
checkbox ($pr[84],"pr84"); echo cmsg ("REC");
nextstrokeelement ();
checkbox ($pr[85],"pr85"); echo cmsg ("LNK_DEL_EN");
nextstrokeelement ();

checkbox ($pr[86],"pr86"); echo cmsg ("A_AL_SRCH");checkbox ($pr[87],"pr87"); echo cmsg ("ALL!");
nextstrokeelement ();
checkbox ($pr[88],"pr88"); echo cmsg ("A_30_OLD_RMV");
nextstrokeelement ();
checkbox ($pr[89],"pr89"); echo cmsg ("A_FIL_OLD_RMV");  inputtxt ("sd32",4);
nextstrokeelement ();
checkbox ($pr[90],"pr90"); echo cmsg ("SH_MAX_FL");
nextstrokeelement ();
checkbox ($pr[91],"pr91"); echo cmsg ("REM_CR");
nextstrokeelement ();
checkbox ($pr[92],"pr92"); echo cmsg ("COMM_LEAV");
nextstrokeelement ();
checkbox ($pr[93],"pr93"); echo cmsg ("REDIR_REFERER");inputtxt ("sd33",12);echo "==>";inputtxt ("sd35",12);
nextstrokeelement ();
checkbox ($pr[94],"pr94"); echo cmsg ("REDIR_HOST");inputtxt ("sd34",12);echo "==>";inputtxt ("sd36",12);
nextstrokeelement ();
checkbox ($pr[95],"pr95"); echo cmsg ("C_LI");
nextstrokeelement ();
inputtxt ("sd38",12); echo cmsg ("MOD_BLOG_TABLEID"); // sd40  - swob
nextstrokeelement ();
checkbox ($pr[97],"pr97"); echo cmsg ("D_JQ");
nextstrokeelement ();
checkbox ($pr[98],"pr98"); echo cmsg ("Y_JQ");
nextstrokeelement ();
checkbox ($sd[39],"sd39");  echo cmsg ("WIN32MNUINUTF8"); // sd40  - swob
nextstrokeelement ();

checkbox ($pr[99],"pr99"); echo cmsg ("A_ONLY_SQL_FILES");
nextstrokeelement ();

checkbox ($pr[100],"pr100"); echo cmsg ("FMG_DIS_ICO");
nextstrokeelement ();
checkbox ($pr[101],"pr101"); echo cmsg ("KOS");
nextstrokeelement ();

hidekey ("pr0",$pr[0]);
hidekey ("pr1",$pr[1]);
submitkey ("go","A_CFG_SAVE");
echo "<br></td></table>";

echo "</ii></form>";
//===========================KEYS

	//echo cmsg ("A_LP_DEF"); 	printselect ($lscontent,1,1,"pr28",$pr[28],0,0); echo cmsg ("")."<br><br>";
	
//comm-- PAGESEDIT


function bloknot ()
	{
$comfile="_conf/bloknot.txt";	simpleedit($comfile,-10000);
 }

//}
function asqledit ()
	{
	global $codekey;if (($codekey==9)or($codekey==7)) demo ();
	$comfile="_conf/autoexec.sql";
        lprint ("ASQL_NOTE");
        simpleedit($comfile,-10000);
}

function cssed ()
	{
global $codekey;if (($codekey==9)or($codekey==7)) demo ();
$comfile="msgerr.css";simpleedit($comfile,-10000);
}

 ####################################################################
  ####################################################################
   ####################################################################
    ####################################################################
     ####################################################################
     

 ####################################################################
 #  Test all configs with autofix small errors 				
 ####################################################################
 
 function dbmgr () {		Header("Location: dblinker.php");	exit;			}
 function chkupd () {
 	global $vernumb;
 	$fp=@fopen ("http://dj.chg.su/dbscript/update.txt","r");
 	if ($fp==false) { lprint (UPD_NONE) ; dispref();exit;}
 	$f=fread ($fp,1000);
 	$v=explode (";",$f); 
 $vercharnew=$v[1];$vernumbnew=$v[0];$updatefile=$v[2];
 if ($vernumbnew>$vernumb) {lprint (UPD_NEED);echo $vercharnew;
     echo"<br><form action=admin.php>";submitkey ("write","SVN_UPD"); echo "<br></form>";
 		if ($updatefile) echo "<br>Download update: ".$updatefile;
  		exit;}
 if ($vernumbnew<$vernumb) {lprint (UPD_NONEED); exit;}
 }

function chklic () {
    // потом добавить скрипт который делает эту задачу прямо на сайте без клиентской части !
    // принять данные что и где искать,  отослать обратно данные что выводить - не делая это самостоятельно.
      $filbas="http://dj.chg.su/dbscript/old/_data/licenses.dat";global $actcod;
@$lic=fopen ($filbas,"r",0);
$datamassive=readfullcsv ($lic,"new");
  $lcontent=$datamassive[2];
  /*for ($a=0;$a<count ($lcontent);$a++) {  //realidcontain wam w pomosh!!
      echo "dm2a2=".$lcontent[$a][2]."";;// хер вам а не & posle akt koda ^)) скажем нет дермецовым глюкам
      $x=substr ($lcontent[$a][2],0,32);
      echo "now $x<br>";
      $lcontent[$a][2]=$x;
  }
   * 
   */
  // я не понял какого хера в ядре оказывается неисправленная версия базы данных?
  $licnumber=getidbyid ($lcontent,2,"realidcontain",$actcod);  // fix for lost license 4.1.8  what?? 
  //echo "($licnumber=getidbyid ($lcontent,2,0,$actcod))";
  //print_r ($lcontent);
echo "<br>".cmsg (LIC_I)."<br><br>";
if ($datamassive==-1) echo cmsg (LIC_F);
if (!$licnumber) echo cmsg (LIC_N) ;
if ($licnumber) echo cmsg ("LIC")."$licnumber ".cmsg (REG)." ".$lcontent[$licnumber][5]." for ".$lcontent[$licnumber][6]." at ".$lcontent[$licnumber][7]."." ;
}
//

 // КАКбЭ ВНИМАНЕ КОТЭ ОПАСНОСТЕ!  ПЫЩЬЬЬЬЬ!!!!111 ПЫЩЬ!!!!111111111111
function testcfgs ()
	{
	 global $sd,$pr,$mycol,$mycols,$ADM,$tbl;	global $gmheader,$gmplevel,$prauth,$prauthcnt;
	 global $dbheader,$dbplevel,$prdbdata,$prdbdatacnt;	global  $edheader,$edplevel,$edcontent,$edcnt;
	 global	$dnheader,$dnplevel,$dncontent,$dncnt; 	 global $pgheader,$pgplevel,$pgcontent,$pgcnt;
	global $stheader,$stplevel,$stcontent,$stcnt;	global $lsheader,$lsplevel,$lscontent,$lscnt;
        global $filheader,$filplevel,$fildata,$filcount;
	$error=0;$war=0; $fixed=0;//счетчик ошибок
#inside func
$mserror="<red>==></red>";
$mswar="<yel>==></yel>";
$msfixed="<grn>==></grn>";
echo "---------------------------<br>";


	// проверка dbdata.cfg
$tbl=1;$edit=0; // edit - флаг запуска записи
 $silent=0;global $silent;
while ($tbl<$prdbdatacnt-1) {
				$exist=1;
				 if ($prdbdata[$tbl][12]!="fdb") {
					$code=readdescripters ();
					 $fixmsg=$code[7];$warnmsg=$code[8];
					 if (strlen ($fixmsg)>15) { echo "$msfixed ".$fixmsg;$fixed++; };
				 	 if (strlen ($warnmsg)>15) { echo "$mswarn ".$warnmsg;$warn++; };
					if ($code==-1) { echo "$mserror SQL ".cmsg (A_T_DB)." ".$prdbdata[$tbl][0]," ".cmsg (NOREP)."<br>";$exist=0; $error++;
					$errortables[]=$prdbdata[$tbl];  //continue;//added cont  for test
									}
						}

				 if ($prdbdata[$tbl][12]=="fdb") {
			global $mzcnt;//		$filbas=$prdbdata[$tbl][0];
				$mycols=0;$code=readdescripters (); 
					 $fixmsg=$code[7];$warnmsg=$code[8];
					 if (strlen ($fixmsg)>15) { echo "$msfixed ".$fixmsg;$fixed++; };
					 if (strlen ($warnmsg)>15) { echo "$mswarn ".$warnmsg;$warn++; };
					 if ($code==-1) { echo "$mserror DAT  ".cmsg (A_T_DB)." ".$prdbdata[$tbl][0]." ".cmsg (NOREP)."<br>";$error++;//$tbl++; именно эта параша всё сбивала.
                                             $errortables[]=$prdbdata[$tbl];	//continue; remove as tes
								};
				$mycols=$mzcnt;   $mycolsreal=$code[6]; 
				}
// К этому моменту  уже должны быть базы обновлены
		
			if (($prdbdata[$tbl][12]=="1")) {  
		echo "$msfixed ".cmsg (TB)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_UDBT)." -sql-<br>";$prdbdata[$tbl][12]="mysql";$fixed++;$edit=1 ;}
		
			if (($prdbdata[$tbl][12]===false)OR($prdbdata[$tbl][12]==="0")) { 
		echo "$msfixed  ".cmsg (TB)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_UDBT)." -fdb-<br>";$prdbdata[$tbl][12]="fdb";$fixed++;$edit=1 ;}
		
		if (($prdbdata[$tbl][9]=="")AND($prdbdata[$tbl][12]=="mysql")) { 
		echo "$msfixed ".cmsg (TB)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_NC_DEF)." <br>";$prdbdata[$tbl][9]="default";$fixed++;$edit=1 ;}
		
	if (($prdbdata[$tbl][5]=="")AND($prdbdata[$tbl][1]!=="")) { 
		echo "$msfixed ".cmsg (A_SF_NAMTBL)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_CPY_MIRR)."<br>";$prdbdata[$tbl][5]=$prdbdata[$tbl][1];$fixed++;$edit=1 ;}
		
	if (($prdbdata[$tbl][1]=="")AND($prdbdata[$tbl][5]!=="")) { 
		echo "$msfixed ".cmsg (A_SF_NAMMIRR)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_CPY_NAMTBL)."<br>";$prdbdata[$tbl][1]=$prdbdata[$tbl][5];$fixed++;$edit=1 ;}

	if (($prdbdata[$tbl][0]=="")AND($prdbdata[$tbl][1]!=="")) { 
		echo "$msfixed ".cmsg (A_SF_NOFLNM)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_CPY_MIRR2)."<br>";$prdbdata[$tbl][0]=$prdbdata[$tbl][5];$fixed++;$edit=1 ;}


if (($prdbdata[$tbl][15]==$prdbdata[$tbl][11])AND($prdbdata[$tbl][15]!=="")) {
                $prdbdata[$tbl][15]++;
		echo "$msfixed ".$prdbdata[$tbl][1]." ".cmsg ("ID!=")." ".$prdbdata[$tbl][15]." <br>";$fixed++;$edit=1 ;}



		if ($exist==1) { 
	if (($prdbdata[$tbl][14]=="")OR($prdbdata[$tbl][14]<0)) { 
		echo "$msfixed ".cmsg (A_R_TB)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_DEF)."<br>";$prdbdata[$tbl][14]=0;$fixed++;$edit=1 ;}
	
	if ($prdbdata[$tbl][13]<$prdbdata[$tbl][14]) { $prdbdata[$tbl][13]=(($prdbdata[$tbl][14])+1);
		echo "$msfixed  ".cmsg (A_R_TB).cmsg (T_WR)." ".$prdbdata[$tbl][1]." ".cmsg (A_R_RW_ERR).cmsg (FIXED)."<br>";$fixed++;$edit=1 ;}
    $writerights=$prdbdata[$tbl][13];
    if ($writerights!=="d") {settype ($writerights,"integer");
		if ($writerights=="") { $prdbdata[$tbl][13]=(($prdbdata[$tbl][14])+1);
		echo "$msfixed ".cmsg (A_R_TB).cmsg (T_WR)." ".$prdbdata[$tbl][1]." ".cmsg (A_R_RW_ERR).cmsg (FIXED)."<br>";$fixed++;$edit=1 ;}
    }
		
	if (($prdbdata[$tbl][10])>$mycols) { echo "$mserror ".cmsg (A_T_FROW1).$prdbdata[$tbl][10].") ( ".cmsg (ITB)." ".$prdbdata[$tbl][1].cmsg (A_MCOLS)."$mycols <br>"; $error++;}
 	 if (($prdbdata[$tbl][11])>$mycols) { echo "$mserror  ".cmsg (A_T_CROW1).$prdbdata[$tbl][11].") ( ".cmsg (ITB)." ".$prdbdata[$tbl][1].cmsg (A_MCOLS)."$mycols <br>"; $error++;}
 	 if (($prdbdata[$tbl][4])>$mycols) { echo "$mserror  ".cmsg (A_T_CGROW1).$prdbdata[$tbl][4].") ( ".cmsg (ITB)." ".$prdbdata[$tbl][1].cmsg (A_MCOLS)."$mycols <br>"; $error++;}
	  if (($prdbdata[$tbl][8])>$mycols) { echo "$mswar  ".cmsg (A_T_SCROW1).$prdbdata[$tbl][8].")  ".cmsg (ITB)." ".$prdbdata[$tbl][1].cmsg (A_MCOLS)."$mycols <br>"; $warn++;}
 	  if (($prdbdata[$tbl][8]!==false)AND($prdbdata[$tbl][3]===false)) { echo "$mswar ".cmsg (A_T_SCRPRS).$prdbdata[$tbl][8].") ".cmsg (ITB)." ".$prdbdata[$tbl][1]." ".cmsg (A_F_EMP)."<br>"; $war++;}

 	  $fields=count($prdbdata[$tbl]);
if ($fields<199) { 
	//echo 
	echo "$mswar Registered table ".$prdbdata[$tbl][1]." have ".$fields." header fields but must have 202 , requires run update350.php or manual fix <br>";
	$warn++;	/*
	$fixadd="";
for ($a1=$fields-2;$a1++;$a1<202) {//$fixadd.="¦";// echo $a1." ";
	$prdbdata[$tbl][$a1]="0";
if ($a1==202) { if ($OSTYPE=="LINUX") $prdbdata[$tbl][$a1].="\n"; //  исправление соединения строк
				if ($OSTYPE=="WINDOWS") $prdbdata[$tbl][$a1].="\r\n";
				break;
}

//die ("a1==202 !!!!!!!!!!!!!!!!!!!!!"); возможно добавление WINDOWS вызовет баг - не проверено
//$ax++; if ($ax>700) { echo "a1=$a1; ax=$ax; fixadd=$fixadd";exit;}
} // FUCKING SHsIT   ВИСНЕТ"!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/
} 

//исправляем если конфиг слишком короткий. не знаю в чем дело - но автоисправление длины алиаса почему то не пашет как надо
//
		//$plinkname=$data[12];
                //.//...$exist=0;// чезахерня?
			};//end EXIST list
 	  //ho "prb ".$prdbdata[$tbl][17]." M<br>";
 	 			
 	 			//Временно отключено после расширения глючть не будет   writefullcsv вызывает ошибку если нет \n
 	 	if (count($prdbdata[$tbl])>40) {
 	 $a=$prdbdata[$tbl][17];//echo "ept 17=$a<br>";
 if ((strlen (trim ($a))<2)or($a===" ")) {$ungroup=1;}; if ((strlen (trim ($a))>1)) { $ungroup=0;};
  	  if (($ungroup==1)AND($prdbdata[$tbl][12]=="mysql")AND($prdbdata[$tbl][9]==true)) { 
		echo "$msfixed ".cmsg (A_SF_GRP_TBL)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_NO)." (".$prdbdata[$tbl][17].cmsg (A_DEF_GRP).$prdbdata[$tbl][9].")<br>";
		$prdbdata[$tbl][17]=$prdbdata[$tbl][9];
		$fixed++;$edit=1 ;$ungroup=0;}  //CFG OPT FUTURE  TODO:  отключаемое 2 реж 1-база может отличатся от 2-база вс=базе.

     if ($pr[38]) if (($prdbdata[$tbl][12]=="mysql")AND($prdbdata[$tbl][9]!==$prdbdata[$tbl][17])) { 
		echo "$msfixed ".cmsg (A_SF_GRP_TBL)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_GRP_DECL)." ".$prdbdata[$tbl][17].")-->(".$prdbdata[$tbl][9].")<br>";
		$prdbdata[$tbl][17]=$prdbdata[$tbl][9];
		$fixed++;$edit=1 ;$ungroup=0;} 
     
		if (($ungroup==1)AND($prdbdata[$tbl][12]=="fdb")) { 
		echo "$msfixed ".cmsg (A_SF_GRP_TBL)." ".$prdbdata[$tbl][1]." ".cmsg (A_SF_NO)." (".$prdbdata[$tbl][17].cmsg (A_DEF_GRP)."fdb)<br>";
		$prdbdata[$tbl][17]="fdb";
		$fixed++;$edit=1 ;$ungroup=0;}  //CFG OPT FUTURE  TODO:  отключаемое 2 реж 1-база может отличатся от 2-база вс=базе.AS Mysql 
}
//*/$prdbdata[$tbl][18]="\n"; поможе если все таки достигнули крайнее число колонок.
		
 $tbl++;
 } echo "<br>".cmsg (A_SF_ALLDB).($prdbdatacnt-2)."<br>---------------------------------------<br>";

##проверка на факт редактирования должна быть обязательно везде - незачем постоянно делать сохранения.
 if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/dbdata.cfg","w",1);
   writefullcsv ($tempdescr,$dbheader,$dbplevel,$prdbdata);$edit=0;
   fclose ($tempdescr);
 }

 unset ($tempdescr,$dbheader,$dbplevel,$prdbdata);



	// проверкa gmdata.cfg
	
	
	// CFG OPT FUTURE  TODO:   СОЗДАНИЕ ПАПОК ПОЛЬЗОВАТЕЛЕЙ И ФАЙЛА ПО УМОЛЧАНИЮ -  В ЗАВИС ОТ ИНСТАНЦИИ ПО ТИПУ _DATA .. САП
 $cnt=1;$admins=0;$users=0;
  while ($cnt<$prauthcnt) {

if (((strlen ($prauth[$cnt][1]))<32)AND($prauth[$cnt][0]==true)) {
	echo "$msfixed ".cmsg (A_SF_U_NOCYPH).$prauth[$cnt][0]." ".cmsg (A_SF_U_CYHP)."<br>";$fixed++;$edit=1;
$prauth[$cnt][1]=hashgen ($prauth[$cnt][1]);
}

if ((($prauth[$cnt][1][0])!=="!")AND($prauth[$cnt][0]==true)) {
	echo "$mswar ".cmsg(A_SF_U_NOCYPH)." ".$prauth[$cnt][0]." ".cmsg (A_OLD_ENC)."<br>";$war++;
}

$su=$su+$prauth[$cnt][42];
 $admins=$admins+$prauth[$cnt][2];$a=$prauth[$cnt][10];if ($a) { $users=$users+1;};
 $cnt++;	} echo "<br>".cmsg (A_SU)." $su ".cmsg (A_T_ADMFRUSR)." $admins ".cmsg (A_IZ)." $users ".cmsg (A_USRS).".<br>---------------------------------------<br>";


   ###rewrite cfg### :)))
 if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/gmdata.cfg","w",1);
   writefullcsv ($tempdescr,$gmheader,$gmplevel,$prauth);$edit=0;
 fclose ($tempdescr);
  }
  unset ($tempdescr,$gmheader,$gmplevel,$prauth);



/*

// проверка editor.cfg  files.cfg ???
  $cnt=1;
  while ($cnt<$edcnt) {
  $cnt++;
   if (($edcontent[$cnt][0]!=="")AND($edcontent[$cnt][1]=="")) {echo "$mswar ".cmsg (A_T_EDAT)." $cnt (".$edcontent[$cnt][0]." (".$prdbdata[$edcontent[$cnt][0]][0].")) ".cmsg (A_T_EDATEMP)."<br>";$war++;}
 } echo "<br> ".cmsg (A_T_EDCFGS)." ".($edcnt-2)."<br>---------------------------------------<br>";


   ###rewrite cfg### :)))
 if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/editor.cfg","w",1);
   writefullcsv ($tempdescr,$edheader,$edplevel,$edcontent);$edit=0;
 }
 unset ($tempdescr,$edheader,$edplevel,$edcontent);
*/


 	// проверка pages.cfg
 $cnt=1;
 while ($cnt<$pgcnt) {
//if ($cnt>10) { echo "Страница $cnt (".$pgcontent[$cnt][1].") не может быть обслужена из за встроенных ограничений.<br>"; $war++;}
if ($pgcontent[$cnt][1]==="") {echo "$mserror  ".cmsg (A_PAGE)." $cnt (".$pgcontent[$cnt][1].") ".cmsg (A_T_PGNOCONN).".<br>";$error++;}
if ((strpos($pgcontent[$cnt][1],"readfile.php"))!==false) {echo "$msfixed ".cmsg (A_PAGE)." $cnt (".$pgcontent[$cnt][1].") up to 3.5.18+.<br>";
$pgcontent[$cnt][1]=str_replace("readfile.php","r.php",$pgcontent[$cnt][1]);$fixed++;$edit=1;}
if ((strpos($pgcontent[$cnt][1],"edit.php"))!==false) {echo "$msfixed ".cmsg (A_PAGE)." $cnt (".$pgcontent[$cnt][1].") up to 3.6.1+.<br>";
$pgcontent[$cnt][1]=str_replace("edit.php","login.php",$pgcontent[$cnt][1]);$fixed++;$edit=1;}

if ((strpos($pgcontent[$cnt][1],"writefile.php"))!==false) {echo "$msfixed  ".cmsg (A_PAGE)." $cnt (".$pgcontent[$cnt][1].") up to 3.5.18+.<br>";
$pgcontent[$cnt][1]=str_replace("writefile.php","w.php",$pgcontent[$cnt][1]);$fixed++;$edit=1;}

if ($pgcontent[$cnt][3]==="") {echo "$mswar  ".cmsg (A_PAGE)."$cnt (".$pgcontent[$cnt][1].") ".cmsg (A_T_PGNOHDR).".<br>";$war++;}
 if (($pgcontent[$cnt][6]>0)AND($pgcontent[$cnt][7]<4)) {echo "$mswar  ".cmsg (A_PAGE)." $cnt (".$pgcontent[$cnt][1].") ".cmsg (A_T_PGUPTM).$dbc[7]."<br>";$war++;}
  if (($pgcontent[$cnt][4]==1)AND($pgcontent[$cnt][2]==false)) {echo "$mserror ".cmsg (A_PAGE)." $cnt (".$pgcontent[$cnt][1].") ".cmsg (A_T_PGRDR).".<br>";$error++;}

 $cnt++;} echo "<br>".cmsg (A_T_ALLPG).($pgcnt-2)."<br>---------------------------------------<br>";

 
   ###rewrite cfg### :)))
 if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/pages.cfg","w",1);
   writefullcsv ($tempdescr,$pgheader,$pgplevel,$pgcontent);$edit=0;
 }
 unset ($tempdescr,$pgheader,$pgplevel,$pgcontent);

 	// проверка denywords.cfg
 $cnt=1;
 while ($cnt<$dncnt) {
	if (strlen ($dncontent[$cnt][0])<4) { echo "$mswar Длина слова (".$dncontent[$cnt][0].") мала =".strlen ($dncontent[$cnt][0]).", это может вызвать ошибки <br>";
	 $warn++;};
 	
	$cnt++;
 }echo "<br>".cmsg (A_DNW_ALL)." ".($dncnt-2)."<br>---------------------------------------<br>";


   ###rewrite cfg### :)))
 if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/denywords.cfg","w",1);
   writefullcsv ($tempdescr,$dnheader,$dnplevel,$dncontent);$edit=0;
    unset ($tempdescr,$dnheader,$dnplevel,$dncontent);
 }


$date=date("d.m.Y H:i:s");// текущая дата
$dateinunix=strdbstounixtime ($date);// переводим обычную dbs дату в юникс

// прове files.cfg
 $cnt=1;$edit=0;
 while ($cnt<$filcount-1) {
      //echo "filcount mlya $filcount , count fildata-= ".count ($fildata)."<br>";// zaebalo  gde counter?
      if ($debug) echo $fildata[$cnt][4]."=".$fildata[$cnt][9]."<br>";// debug
$downloadedfiles=$downloadedfiles+$fildata[$cnt][9];
//
////if (1==1) { echo "$fildata";};  при удалении сохранять 2 в колонку об удалении
// Извините, файл найти не удалось -  Возможно файл устарел , перемещён или не соответствует правилам хостинга
$datarazm=$fildata[$cnt][8];$xdataupload=strdbstounixtime ($datarazm);
$dataskac=$fildata[$cnt][10];$xdatalastload=strdbstounixtime ($dataskac);
if (is_dir ($fildata[$cnt][5])) $fildata[$cnt][6]=2;//папки не имеет смысла пытаться удалять
//важно после попытки удаления программа более не пытается удалять уже удаленные файлы помечая их флагом 2 в колонке удаления.
$razn=$dateinunix-$xdatalastload;
$toomanydays=1295684*2;
if ($razn>$toomanydays) {// echo "File <font color=blue>".$fildata[$cnt][5]."</font> (ID ".$fildata[$cnt][0]." is hosted> 30 days ($datarazm)<br>";//noaction
// если файл есть уже 30 дней то можно проверять и дату последней скачки если она конечно же есть
if ($debug) echo "[debug] this file is dara rasm= $datarazm ($xdataupload) datascac=$dataskac  ($xdatalastload) razn=$razn<br>";
$razn2=$dateinunix-$xdatalastload;
if (!($fildata[$cnt][6]==2)) if ($xdatalastload<1) {echo "File  <blu>".$fildata[$cnt][5]."</blu> ни разу не загружался. <br>";};// затычка

if (($xdatalastload>0)AND(!($fildata[$cnt][6]==2))) { if ($razn2>$toomanydays) { echo "File <blu>".$fildata[$cnt][5]."</blu> (ID ".$fildata[$cnt][0]." is outdated ($dataskac)<br>";$enableremove=1; };
if ($enableremove) if ($pr[88]) if (file_exists ($fildata[$cnt][5]))  {
                echo "<red>Auto removing outdated file ".$fildata[$cnt][5]."   !</red><br>";
                logwrite ("A_CHECK:Remove outdated file ".$fildata[$cnt][5]);
                $fildata[$cnt][6]=2; $edit=1; //  знак удаленного файла - не проверяется
                unlink ($fildata[$cnt][5]) ;;
                $enableremove=0;
                };
}
}
if (!($fildata[$cnt][6]==2))  if (!file_exists ($fildata[$cnt][5])){
        if ($pr[85]) echo "$msfixed ";
        echo "".$fildata[$cnt][5]." ".cmsg ("LNK_NOT");
         if ($pr[85]) {echo " ".cmsg ("LNK_RMV"); $fildata[$cnt]="";; $fixed++;$edit=1;} // ЭТОПРАВИЛЬНОЕ УДАЛЕНИЕ!!
         echo "<br>";
        };
	$cnt++;
}

echo "<br>".cmsg (A_FIL_DWN).": $downloadedfiles<br>";
 echo "<br>".cmsg (A_FIL_ALL)." ".(count ($fildata)-2)."<br>---------------------------------------<br>";


   ###rewrite cfg### :)))
 if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/files.cfg","w",1);
   writefullcsv ($tempdescr,$filheader,$filplevel,$fildata);$edit=0;
    unset ($tempdescr,$filheader,$filplevel,$fildata);
 }//-------------------------------
 //
 //
//проверкa styles
 $cnt=1;
 while ($cnt<$stcnt) {
	 echo"";break;
 }echo "<br>".cmsg (A_STL_ALL)." ".($stcnt-2)."<br>---------------------------------------<br>";

//планируется стили подключать  просто как папки

 if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/styles.cfg","w",1);
   writefullcsv ($tempdescr,$stheader,$stplevel,$stcontent);$edit=0;
    unset ($tempdescr,$stheader,$stplevel,$stcontent);
 }

// проверка  langset

  $cnt=1;
 while ($cnt<$lscnt) {
	 echo"";break;
 }echo "<br>".cmsg (A_LNG_ALL)." ".($lscnt-2)."<br>---------------------------------------<br>";



  if ($edit==1) {
	 @$tempdescr=csvopen ("_conf/langset.cfg","w",1);
   writefullcsv ($tempdescr,$lsheader,$lsplevel,$lscontent);$edit=0;
    unset ($tempdescr,$lsheader,$lsplevel,$lscontent);
 }

global $vpropcheck;
if ($vpropcheck>1.0) { $error+1; msgexiterror ("cfgnewcrit","property","disable");}
if ($vpropcheck<-1.0){ $error+1;  msgexiterror ("cfgoldcrit","property","disable");}
if ($vpropcheck>0.8){ $error+1;  msgexiterror ("cfgnewwarn","noexit","disable");}
if ($vpropcheck<-0.8) { $error+1; msgexiterror ("cfgoldwarn","noexit","disable");}

echo "=============================<br>=============================<br>";
echo "".cmsg (A_T_ALLERR)." : ".($error+$war+$fixed)."<br>";
echo "".cmsg (A_T_FROM)." :<br>".cmsg (A_T_CRIT)." $error <br>".cmsg (A_T_NOCRIT)." $war <br> ".cmsg (A_T_FIXED)." $fixed <br>";
if ($error+$warn>0) echo "".cmsg (A_T_REC)." ";
$data="";
if ($debug) print_r ($errortables);
if ($errortables) { echo "<form action=\"admin.php\"><br>";checkbox (0,"yes");echo count ($errortables);
for ($a=0;$a<count ($errortables);$a++) {
$data.=$errortables[$a][0].";".$errortables[$a][1]."?";
 };
 global $sd;
 if ($sd[19]=="utf-8") $data=iconvx("windows-1251","utf-8",$data);
 //if ($sd[19]=="utf-8") $data=iconvx("utf-8","windows-1251",$data);
  $data=base64_encode ($data);
  $fileforerrtname="_local".add_endslash("")."errt";
  unlink ($fileforerrtname);
  $errtfile=fopen ($fileforerrtname,"a");
  fwrite ($errtfile,$data);
  fclose ($errtfile);
//hidekey ("errt",$data);
 hidekey ("count",count ($errortables));
submitkey ("write","ADM_DEL_OFF_TABLES");echo "</form>";dispref () ;}

	}

    //################################################################
    ////################################################################
    ////################################################################
//################################################################
//удаление неответивших таблиц
//################################################################
function deleteemptytables () {
  // errt, count - gde oni??
    
global $errt,$yes,$errortables,$write;
global $sd,$pr,$mycol,$mycols,$ADM,$tbl;	global $gmheader,$gmplevel,$prauth,$prauthcnt;
global $dbheader,$dbplevel,$prdbdata,$prdbdatacnt,$sd;
//linux specsimbols -  чтоб вставить символ жмём Ctrl+Shift+U (появится символ u) отпускаем клавиши - вводим код символа... коды можно подсматривать в том же ООо.
// - "¦" этот символ конвертируется мля - его нельзя юзать.
 //2200
 //if ($sd[19]=="utf-8") $errt=iconvx("utf-8","windows-1251",$errt);
 if (!$yes) { echo "To removing aliases you must enable it. (check on box left the key).<br>";return;};
$fileforerrtname="_local".add_endslash("")."errt";
  $errtfile=fopen ($fileforerrtname,"r");
  $errt=fread ($errtfile,100000 );
  //fclose ($errtfile);
  if ($errt) { unlink ($fileforerrtname); } else { echo "unable to read $fileforerrtname <br>"; return;};
  echo "$errt";
 $errt=base64_decode($errt);
echo "decoded=$errt;;";
$errormassive=explode ("?",$errt ); //опять старые грабли задолбло
    echo "Starting deleting unneeded tables...<br>";
    //echo "Needed to remove: $errortables<br>";
    echo "Error massive counts:".(count ($errormassive)-1)."<br>";
    echo "Total registered tables: ".count ($prdbdata)."<br>";
//print_r ($errt);
print_r ($errormassive);// ERRMASS=".implode ($errormassive,"!")."
for ($a=0;$a<count ($prdbdata);$a++) {
    $partforcompare=$prdbdata[$a][0].";".$prdbdata[$a][1];
    if ($sd[19]=="utf-8") $partforcompare=iconvx("windows-1251","utf-8",$partforcompare);
    //echo "cycle A=$a PART=$partforcompare <br>ENDING<Br><br>";
if (in_array($partforcompare,$errormassive))  { echo "removed: ".$prdbdata[$a][0].";".$prdbdata[$a][1].",";$total++;$edit=1;} else {
$prdbdatanew[]=$prdbdata[$a]; $edit=1;}
//if (in_array () $errormassive[$a]=="")
//if(in_array($sd[18], $limits))
}

echo "total: $total<br>";

 if ($edit==1) {
     echo "Trying to rewrite...<br>";
     	$tempdescr=csvopen ("_conf/dbdata.cfg","w",1);
   $x=writefullcsv ($tempdescr,$dbheader,$dbplevel,$prdbdatanew);$edit=0;
   echo "result=$x";
 }
 unset ($tempdescr,$dbheader,$dbplevel,$prdbdata);

}



//функция перезаписи однострочных конфигов - полностью оптимизирована
function write ()  
	{
	
	for ($a=0;$a<200;$a++) { global ${"pr".$a};global ${"sd".$a};} //новое чтение конфигов,корректное
	global $codekey;
	if ($codekey==7) demo ();

   @$desc=csvopen ("_conf/property.cfg","r",1);
$data=readfullcsv ($desc,"new");$pr=$data[0];
   @$site=csvopen ("_conf/sitedata.cfg","r",1);
$data=readfullcsv ($site,"new");$sd=$data[0];
//возможно стоит попробовать масс замену в admin.php  и циклы.

	for ($a=0;$a<count ($pr);$a++) { $pr[$a]=stripslashes (${"pr".$a});} //новое чтение конфигов,корректное
	for ($a=0;$a<count ($sd);$a++) { 
		if ($sd14=="A_DEM_NOSQL")if (($a==14) OR($a==17)) continue;  //skip if public demo
		$sd[$a]=stripslashes (${"sd".$a});}  //PARTIAL EXCHANGE
	echo "<bb><h2>".cmsg (A_WRITED)."</bb><br>";    
	
    if (count ($pr)<24)	for ($a=24;$a<200;$a++)
	{ $sd[$a]="0";	  if ($a>36) $pr[$a]="0";	} //зануляем несделанные  potom mojno ubrat
	
	for ($a=0;$a<count ($sd);$a++)
	{ if (strpos ($sd[$a],"\"")!==false) { echo "Possible hack...exit.";exit;}
	  	}
	for ($a=0;$a<count ($pr);$a++)
	{ if (strpos ($pr[$a],"\"")!==false) { echo "Possible hack...exit.";exit;}
	  	}
		 @$tempdescr=csvopen ("_conf/property.cfg","w",1);
   writefullcsv ($tempdescr,$pr,"","");
   		 @$tempdescr=csvopen ("_conf/sitedata.cfg","w",1);
   writefullcsv ($tempdescr,$sd,"","");
}



// ФУНКЦИИ ОТНОСЯЩИЕСЯ К SD
	// SD ADDED
	// Теперь функция поддерживает любое число конфигов, максимум легко изменить
	function displayconfigtblsd ()  // GMDATA EDITOR (USERDATA)
{
	 global $descfld,$sitefld,$editfld,$pr,$desc,$sd,$site,$ADMM,$prauth,$ADM,$gmlimitcfg,$HASHUSER,$go;
	 if ($go==cmsg("A_MY_PROF")) {$ADMM=$ADM;}
	lprint ("A_USR_NOTE");
		if ($gmlimitcfg===1){$ADMM=$ADM;}
	$a=0; if ($ADMM>=count ($prauth)) { echo cmsg ("A_REG").count ($prauth)."<br>";$ADMM=0;}
if (($ADM>-1)and($ADM<count ($prauth))AND($gmlimitcfg===0)) if ($go!==cmsg ("A_MY_PROF"))
	{			?>
		<br><form action=admin.php method=post>
<?php
	echo cmsg ("A_USR")."<select name=ADMM>";//админу доступен выбор любого пользователя
	for ($ab=1;$ab<count ($prauth)-1;$ab++) {//ab=stroke
	if ($ab==$ADMM) $asd="selected";else $asd="";
		echo "<option value=".$ab." $asd >".$prauth[$ab][0]."</option>";	}
	 submitkey ("write","A_USR_CN") ;
			}
?>
	<input type=hidden name=totalbas  value = <?php print $totalbas; ?>>
</form> <?php
	; if ($ADMM>0) 
	{			?> <form action=admin.php method=post> 
<?php submitkey ("go","APP_CFG");
hidekey ("write","3");
	 	echo "<br>".cmsg ("A_USR_PCFG")."<br>";
		$LOGINUSER=stripslashes ($prauth[$ADMM][0]);
		$PASSWORDUSER=stripslashes ($prauth[$ADMM][1]);
	//улучшить предварительную загрузку конфигов чтобы значения не терялись если их не видно !"!!
        //count ($pr) removed, set 200 to default НЕ ПОМОГЛО , с админ правами все ок, без них труба
	for ($a=2;$a<201;$a++) { ${"pradm".$a}=stripslashes ($prauth[$ADMM][$a]);} //новое чтение конфигов,корректное
	
if ($gmlimitcfg!==1) 
	{
if ($go!==cmsg("A_MY_PROF")) submitkey ("go","A_CNEW");?>
<br><?php lprint ("A_USR_LG") ; echo ":"; inputtext ("LOGINUSER",15,$LOGINUSER);
echo "<br>";	  } 
 lprint ("A_USR_PS") ; echo ":";inputtext ("PASSWORDUSER",15,"");
  lprint ("A_USR_PSHLP");
 hidekey ("HASHUSER",$PASSWORDUSER);
 if ($gmlimitcfg!==1) 
	{
 echo "<br>";

if (($go==cmsg("A_MY_PROF"))or($ADMM==$ADM)) { $onlyforme=1; };
if (($prauth[$ADM][42])or($onlyforme)) { checkbox ($pradm2,"pradm2");lprint ("A_U_ENADM") ;
if ($prauth[$ADMM][42]) lprint ("BLOCK"); echo "<br>"; }  // ADMM - selected user   ADM  - real user - don't forgot!!!
else { hidekey ("pradm2",$pradm2);};
checkbox ($pradm3,"pradm3");	lprint ("A_U_ENED") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm4,"pradm4");	lprint ("A_U_ENENHSRCH") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm5,"pradm5");	lprint ("A_U_ENMASS_DEL") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm6,"pradm6");	lprint ("A_U_ENHDR_BCK") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm33,"pradm33");	lprint ("A_FRZ") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm34,"pradm34");	lprint ("A_EXEC") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm35,"pradm35");	lprint ("A_COPY_EXCH") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm43,"pradm43");	lprint ("GMP_43") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
checkbox ($pradm44,"pradm44");	lprint ("GMP_44") ;if ($pradm42) lprint ("BLOCK"); echo "<br>";
if ($prauth[$ADM][42]) {  // требуются права суперпользователя для показа этой опции иначе скрытая передача
    // ещё неплохо бы ее игнорировать на приеме, так как слишком легко подменить .
    echo "-------------------------------------------------<br>";
    checkbox ($pradm42,"pradm42");	lprint ("GMP_42");echo "<br>";
checkbox ($pradm59,"pradm59");	lprint ("NOPASS");echo "<br>";
checkbox ($pradm60,"pradm60");	lprint ("NOPROF");echo "<br>";

} else {
    // если нет прав идет скрытая передача параметра здесь
    hidekey ("pradm42",$pradm42);
    hidekey ("pradm59",$pradm59);
    hidekey ("pradm60",$pradm60);

};

echo cmsg ("A_FMG_CONF")."<br>";
checkbox ($pradm7,"pradm7");	lprint ("A_FMG_READ") ;if ($pradm42) lprint ("BLOCK");echo "<br>";
checkbox ($pradm8,"pradm8");	lprint ("A_FMG_DISK") ;if ($pradm42) lprint ("BLOCK");echo "<br>";
checkbox ($pradm9,"pradm9");	lprint ("A_FMG_DOWN") ;if ($pradm42) lprint ("BLOCK");echo "<br>";
checkbox ($pradm36,"pradm36");	lprint ("A_FMG_UPL") ;if ($pradm42) lprint ("BLOCK");
echo " <br>";lprint ("GMP_51");
echo "";inputtext ("pradm51",5,$pradm51);echo "Mb;";
echo " ";lprint ("GMP_56");inputtext ("pradm56",5,$pradm56);echo "Kb\s<br>";//GMP_56
checkbox ($pradm12,"pradm12");	lprint ("A_FMG_WRITE") ;if ($pradm42) lprint ("BLOCK");echo ".<br>";
checkbox ($pradm13,"pradm13");	lprint ("A_FMR_DEL") ;if ($pradm42) lprint ("BLOCK");echo ".<br>";
checkbox ($pradm14,"pradm14");	lprint ("A_FMG_IGN_HIDE") ;echo ".<br>";
checkbox ($pradm38,"pradm38");	lprint ("SHOW_PHP_FMG");echo "<br>";
checkbox ($pradm52,"pradm52");	lprint ("HIDE_FLLST") ;echo "<br>";
checkbox ($pradm54,"pradm54");	lprint ("GMP_54") ;echo "<br>";
checkbox ($pradm50,"pradm50");lprint ("GMP_50") ;lprint ("OTH_HOMEDIR");inputtext ("pradm53",17,$pradm53); echo "<br>";

 lprint ("A_U_PLVL") ;
 inputtext ("pradm10",2,$pradm10);  echo "<BR>";
	checkbox ($pradm11,"pradm11"); lprint ("A_USR_BAN") ;echo ","; lprint ("GMP_48"); inputtext ("pradm48",15,$pradm48);
   echo "<br>";
	 lprint ("A_U_REGNAM") ;inputtext ("pradm15",15,$pradm15); echo "<br>"; 
	} 
  if ($gmlimitcfg===1)
		{  //NO Admins can see only self configs not all, maybe just don't translate it?? in this mode it always ignored
echo "<br>"; lprint ("A_U_PASHLP");
			}
checkbox ($pradm16,"pradm16");	lprint ("A_U_NOHELP"); echo "<br>";
checkbox ($pradm17,"pradm17");	lprint ("A_U_NOSHRPED");echo "<br>";
checkbox ($pradm18,"pradm18");	lprint ("A_U_NOANYFLD");echo "<br>";
checkbox ($pradm19,"pradm19");	lprint ("A_U_ENSORT");echo "<br>";
checkbox ($pradm20,"pradm20");	lprint ("A_U_ENPGSPLT");echo "<br>";
checkbox ($pradm23,"pradm23");	lprint ("A_U_T8");echo "<br>";
checkbox ($pradm24,"pradm24");	lprint ("A_U_T9");echo "<br>";

//lprint ("A_FMG_INST") ; inputtxt ("pradm37",2);  echo "<br>";
lprint ("A_FMG_INST") ; inputtext ("pradm37",2,$pradm37);  echo "<br>";
lprint ("GMP_49") ; inputtext ("pradm49",2,$pradm49);  echo "<br>";

lprint ("UNL_LIM");echo "<br>";
checkbox ($pradm26,"pradm26");	print cmsg ("A_MODE")." ".$sd[4] ;echo ".<br>";
	checkbox ($pradm27,"pradm27");	print cmsg ("A_MODE")." ".$sd[5] ;echo ".<br>";
checkbox ($pradm28,"pradm28");	print cmsg ("A_MODE")." ".$sd[6] ;echo ".<br>";
checkbox ($pradm29,"pradm29");	print cmsg ("A_MODE")." ".$sd[7] ;echo ".<br>";
checkbox ($pradm30,"pradm30");	print cmsg ("A_MODE")." ".$sd[20] ;echo ".<br>";
checkbox ($pradm25,"pradm25");	lprint ("A_U_T10");echo "<br>";
checkbox ($pradm31,"pradm31"	);	print cmsg ("A_MODE")." ".$sd[22] ;echo ".<br>";
checkbox ($pradm32,"pradm32");	print cmsg ("A_MODE")." ".$sd[23] ;echo ".<br>";
checkbox ($pradm39,"pradm39");	print cmsg ("GMP_39");echo "<br>";
checkbox ($pradm40,"pradm40");	print cmsg ("GMP_40");echo "<br>";
checkbox ($pradm41,"pradm41");	print cmsg ("GMP_41");echo " 2<br>";//if ($prauth[$ADM][41])
checkbox ($pradm45,"pradm45");	print cmsg ("GMP_45");echo "<br>";
// print cmsg ("GMP_46"); inputtext ("pradm46",2,$pradm46); echo "<br>"; NOT USED NOW
print cmsg ("GMP_55"); inputtext ("pradm55",20,$pradm55); echo "<br>";
print cmsg ("GMP_47"); inputtext ("pradm47",6,$pradm47); 	 echo "<br>";
print cmsg ("GMP_57"); inputtext ("pradm57",6,$pradm57); 	 echo "<br>";
print cmsg ("GMP_58"); inputtext ("pradm58",6,$pradm58); 	 echo "<br>";
  ?>	
 <br><?php lprint ("A_U_ANCFG") ; ?>:<br> <?php global $stcontent,$lscontent;
lprint ("A_U_STYLE");   printselect ($stcontent,1,1,"pradm21",$pradm21,0,0); echo cmsg ("")."<br>";
lprint ("A_U_LANG");    printselect ($lscontent,1,1,"pradm22",$pradm22,1,0);echo "<br>";
 hidekey ("ADMM",$ADMM) ;
 submitkey ("go","APP_CFG");
 echo "</form>";
 } else { lprint ("A_U_SEL");};
 echo "<form action=admin.php method=post>";
 submitkey ("write","RETURN"); 
echo "</form>";
  if ($gmlimitcfg!==1)
		{?>	<form action=admin.php method=post>
	<?php //submitkey ("write","A_USR_CFG");
echo "<br>  </form> ";
 }
	@fclose ($site); 
exit;
}

// MODIFIED TO WRITE LOGINDATA (SITE RELATED)  
// SD CONFIG
// Теперь функция поддерживает любое число конфигов, максимум легко изменить
function writeconfigtblsd () 
{	//echo "Возникла проблема при реконфигурации аккаунта<br>";	exit;	//надобно как то автоопрос чтоли сделать всех переменных  
	//автоматизировать немного  1- загрузку в html,2- взятие на редактирование 3- сохранение
	 echo "<bb><h2>Данные записаны.</bb><br></h2>";
	global $codekey,$LOGINUSER,$PASSWORDUSER,$HASHUSER,$OSTYPE,$go,$gmlimitcfg,$ADMM,$ADM;  // echo "ADMM==".$ADMM ;//тест
	//if ($gmlimitcfg===1){$ADMM=$ADM;}// тк добавили gmlimitcfg поэтому добавим и этот,хотя изначально gmlim вооб.тут не юзался
	for ($a=0;$a<200;$a++) { global ${"pradm".$a};} //новое чтение global
		//кажется сюда цикл влезет
 @$gmdata=csvopen ("_conf/gmdata.cfg","r",1);
$data=readfullcsv ($gmdata,"new");
$gmheader=$data[0];$gmplevel=$data[1];$prauth=$data[2];$prauthcnt=$data[3];// тупо счетчик строк - дата 3
if ($go==cmsg ("A_CNEW")) {
	if ($codekey==7) demo ();
	if ($codekey==9) demo ();
//	if ($codekey==8) demo ();	 temp for test enabling create users
//  ADMM - пользователь, настроки которого редактируют.  а пользователь, которые это делает - ,
if ($codekey==4) needupgrade ();
$ADMM=($prauthcnt-1) ;echo "Creating new one...<br>";};// ага нихрена он никого не создает!
$edit=1;

echo "DEBUG Состояние gmlimitcfg=$gmlimitcfg<br> ";

  if ((!$prauth[$ADM][42])AND($prauth[$ADMM][59])AND($PASSWORDUSER==true)) { $PASSWORDUSER=FALSE;LPRINT ("DISPASSCH"); }
// здесь у нас указывается что пользователь хочет изменить пароль.  не даём ему это сделать если стоит запрет на смену пароля.
		if ($gmlimitcfg==0)	$prauth[$ADMM][0]=stripslashes ($LOGINUSER); 			
		echo "<form action=\"admin.php\" method=\"POST\">";
		if ($PASSWORDUSER==true) { $prauth[$ADMM][1]=hashgen ($PASSWORDUSER);
	//здесь у нас надо отправить новый кук чтобы пользователь мог не перезаходить после смены пароля.
		$dbsa=a ( base64_encode($prauth[$ADMM][0]."¦".$PASSWORDUSER));
			if ($ADM==$ADMM) hidekey ("dbsaa",$dbsa); 
			if ($ADM!==$ADMM) echo "...<br>";
		} else { $prauth[$ADMM][1]=stripslashes ($HASHUSER);};
		submitkey ("dalee","CONT");
		echo "</form>";
		// prevents fake change password
		//  Незагруженные переменные остнутся неизмененными!
		//..$counterusercolumns=count ($prauth[$ADMM]);// представьте себе так надо!
               $counterusercolumns=count ($gmheader);// а иак лучше создаются новые пользователи в установке по дефолту. а то пишется херь всякая в конец пред юзера.

		//..if ($counterusercolumns>100) $counterusercolumns=100;
//		echo "DEBUG Your cnt= $counterusercolumns ADMM=$ADMM ADM=$ADM<br>";
           
  //              echo " prauth[adm=$ADM][60]=".$prauth[$ADM][60]." prauth[admm=$ADMM]=".$prauth[$ADMM][60]."<br>";
                if ((!$prauth[$ADM][42])AND(($prauth[$ADMM][60]))) { LPRINT ("DISPROFCH"); exit ();}
              
             
		for ($a=2;$a<$counterusercolumns-1;$a++) { //попробуем на 1 меньше писать может поможет если там \n \r\n передаются по ум.
				// счас работает все проверить построе на тесте.

		if ($gmlimitcfg===1) if ((($a>1)AND($a<16))OR(($a>32)AND($a<37))OR($a==38)OR(($a>41)AND($a<46))OR(($a>49)AND($a<55))OR($a==48)) continue;
             //   echo "isset pradm$a : ".isset(${"pradm".$a})."<br>";
		//if ($gmlimitcfg===1)if (isset(${"pradm".$a})===false) continue;
                    //42(су) 59( пароль) 60(профиль) должны точно пропускаться, если нет сделать это
                $prauth[$ADMM][$a]=stripslashes (${"pradm".$a});
                //// не вышло просто оставить непоказанное в покое да и нельзя так, вдруг пришлют через GET переменную
                // дописывать сюда все настройки требующие админа или суперюзверя
                
		}  //PARTIAL EXCHANGER  запись конфигов проверено
                if ($go==cmsg ("A_CNEW")) if ($OSTYPE=="LINUX") $prauth[$ADMM][$counterusercolumns].="\n"; // добавляет забытый в перевод строки только для создания юзера.
//print_r($prauth);
                //..if (($prauth[$ADM][0])==($prauth[$ADMM][0])) { echo "UserName (Login) cannot be identical<br>"; $edit=0;return;};
              //это ещё от чего защита?

	//тоже похож на цикл
  //..$bugwithemptyfieldsfixlinux=1;
	 @$tempdescr=csvopen ("_conf/gmdata.cfg","w",1);
//global $testlinuxlinefeed;$testlinuxlinefeed=1;  неправильно работает - выполняется и перед и после добавления юзера что недопустимо
echo "--------------------------------------------"							;
   writefullcsv ($tempdescr,$gmheader,$gmplevel,$prauth);$edit=0;
   exit;
}






	endtm ();
	// формген - модуль для обработки form.cfg для ввода данных в таблицы и для выдачи

?>
