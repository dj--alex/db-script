<?// ������ ��������� ��������� � ������ DBSCRIPT v1.8 (�) dj--alex
//pcntl_getpriority(1) ;// r.php rev202 - part of Site Unknown Project
//
//  ��������, ���������� ������ ��� �� �������������� ��� ��������� � �������
//  ��������� ���������� ��������.
//  ����� ����������� ����� ��������� ������ ����������� � ������� �����������
//  ��� � ��� ����������� ������ (����� ���������)
//
// ���� ���������� ���������� �� ���������� �������� - ����������� �� ���. dj--alex.
//
// ���� �� ������ ���������� ������ ���� ��������� � ������� ����� ����� ������ � ���� ����� ����������� ������
// �� ������ ���������� ������ 3 ��������: ������ ������� ������ ���������, ������������ ��������, 
// ��� �������� ��� ������� � ������� ������� �����-���� ����� ����� ����������� ������ (���������� ������� �� ������ ������,�����)
// // echo "<br>".cmsg ("DONATE")." N 4100177805659 ,Webmoney Z777820755783 R207389102594.";
//
require_once ('dbscore.lib'); // ������� ���������� � ������ � �����������

autoexecsql ();
/*SELECT `name`,(SUBSTRING_INDEX(SUBSTRING_INDEX(`data`,' ', �����),' ', -1)+0) AS `money` FROM `character` WHERE (SUBSTRING_INDEX(SUBSTRING_INDEX(`data`,' ', �����),' ', -1)+0)>1000000;
1325  ������ --- SEARCH �� ���������   ���������������� */
import_request_variables ("PG","");

if (($vID[0]=="!")AND(strtolower ($vID[1])=="m")) {$vID[0]="#";$vID[1]="";}
if ($tbl==-2) if ($vID=="Relogin") $vID=".relogin";


global $verreadfile,$vID,$mzdata,$multisearch,$cmd;
$verreadfile="Viewer v3.6 (c) dj--alex";

### readfile  readdescripters return data info
##	$data=array ( // �� ��������� -  ������ ������ ��������
##		0 => $headerreal,			//headerreal , all  example $data[0][$column]
	##	1 => $plevels,				//plevels , all
	##  2 => $headerrealnumbers,	//headerrealnumbers, all
	##  3 => $headervirtual,		//sql only  csv - copy headerreal � ������ 3.3.7 ������ �������� ����� $data[0]
	##	4 => $datatypos,			//sql only  csv - connect (!!!)
	##	5 => $fieldlen,				//sql only  csv - cfgmod (!!)
	##	6 => $mycols,				// example - echo $data[6] ) ;
	##	7 => $fixdetect ,  // ���� ��� ������� ������ � ������ �������
	##	8 => $warndetect ,// ���� ��� ������� ������ � ������ �������
	##	9 => $plinkdb,    // ���� �� ���� ������  ����� �� plevel, all
	##	10 => $plinkrow ); //���� �� �������\�����, all
##		11 => $plinkkol, ); //���� �� �������, all
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
		if (($go==cmsg(BROWSE))OR(($review==1)AND($mode==3))) {$mode=9; }; //������������� ������ ����������  ����������� ���� ��� �� ����.
		if ($go==cmsg(BEST)) {$mode=5 ;}; // shows editor selected products
		if ($go==cmsg(ASSEMBLY)) {$mode=11 ;  }; // 9  free unlinked must be linked in disable to createPC.php

		$enterpoint=$verreadfile; // ��� ������ ����� �����

		// screen �������� vID2  ($vID2)  ������ ������� ��� �� ��������� � CSV
		// ������ ������� getfile

		if (!isset ($tbl)) {$tbl=$base;} // support old links  recommended
		if (!isset ($vID2)) {$vID2=$myrowvid;} // support old links  recommended
		if (!isset ($vID)) {$vID=$viewid;} // support old links  recommended

		if (!isset ($tbl)) {msgexiterror ("lostvar",0,"disable");}

		If ($prauth[$ADM][4]==true) {$adm=1;} else { $gmlimitcfg=1;} ;// { $adm=$ADM;

		//$writefile=0;
		//If ($prauth[$ADM][3]==true) {$writefile=1;} ;//���������� ���������� ������ ��������������
		//if ($ADM<1) {$adm=0;$writefile=0;		}


		//commands require auth  includes  VERSION
		if ($cmd[0]=="config") {
	?> <br>��� ����������� ���������� ������� ��� ��������� <br>
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
		

		if ($prauth[$ADM][2]) {  //������ ������������� � conf �������.
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


		If ($prauth[$ADM][2]==true) {  // ������� ������ ��� ���������������
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
		
		
		//if ($sd[9]) {$dbs_ips_nolog=explode (",",$sd[9]);// ������ �������� ������� �� �������,�������
			//print_r ($dbs_ips_nolog);
			//if (in_array($dbs_ip, $dbs_ips_nolog)) return 0; } //  ���� ����� ����
		// ����� ������ ������ ��� �������


			if ($cmd[0]=="keygen") {
				Header("Location: keygen.php");
			echo lprint ("REGRESET").".<br>";
			exit;}

			if (($cmd[0])=="remove") {
				if ($cmd[1]=="key") { @unlink ("_conf/dbs.key");@unlink ("_conf/add.key"); msgexiterror ("key".cmsg ("KEY_NODEMO")."login.php","","");}
}

		}
		
	rfsysdatareq();
	$tblint=$tbl;settype($tblint,integer);// ��������� ���� �������� �� �����.
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
		 		if ($languageprofile=="russian") echo "��� ������� ������� -- ".$prauth[$ADM][10]."<br>���� ������ � �����  ".$_SERVER['PHP_AUTH_USER']."(".$prauth[$ADM][0].")(".$prauth[$ADM][15].")<br>IP ".$dbs_ip." Host:".gethostbyaddr ($dbs_ip).", � $tbl<br><br>�� ��� :".$USERDAT;
		 		if ($languageprofile!=="russian") echo "Your plevel is -- ".$prauth[$ADM][10]."<br>Your login and names ".$_SERVER['PHP_AUTH_USER']."(".$prauth[$ADM][0].")(".$prauth[$ADM][15].")<br>IP ".$dbs_ip." Host:".gethostbyaddr ($dbs_ip).", Number $tbl<br><br>About you:".$USERDAT;
		 		closewindow ();
		 		exit;
		}


		//����� ������ dbscript   ����� ����� �������� ��� ������ (���� ���)
		//��������  �� ���� php �������� ������ �� ������� ��� ���������� $ver* � = ����� $ver*
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
			// � ������ ������� ����� ����������� ���� :)
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
			//����� ����� ������ �� �������� ���������
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

	if ((($adm==1)OR($deftbl==false))AND($pr[7])) { //������ ����
		$writefile=0; // �������� �������� ����� ��� ������� ,��� ��� � ������ ������ ��� ��� �������� :)
		printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbl",lprint ("CONNLINK:"),$groupdb);// master mode menu
		If ($prauth[$ADM][3]==true) {$writefile=1;} ;//���������� ���������� ������ �������������� 
		if ($ADM<1) {$adm=0;$writefile=0;		}
		submitkey ("write","A_USRGO");
			} ;
			
 if (($adm==0)AND($deftbl==true)) { ?>
	<form action="r.php" method=post>
		<input type=hidden name=tbl value=<?=$deftbl; ?>>
			<input type=submit name=write value=�����>
	<? };// ��� ������ ��������� �� ����� ����.

 print "</form>";

 $readfile=1;
 
 require ('readfilemenu.php');  // ����������� �������� ��� header.php
 echo "</CENTER>";
 
 if (!isset ($mode)) exit;
 // MASTER MODE ENDS
			}
			$multilimit=$pr[27];
			if ($multisearch==1) { $mv=multistart ();}

			$lock=$pr[11];

			// ��������� ������ � ����������
			if ($printlimit and $limitenable) {
				settype ($printlimit,"integer");
				if ($printlimit==false) {
					msgexiterror ("limit","disable","disable");
				} else {$addlimit=" LIMIT $printlimit";};
			}
			if ($selectenable) { $addgroup=" GROUP BY ".$field.""; }
			$addsql=$addgroup.$addlimit;// CSV � ����������� ��������...
			//��������� ������ � ����������

			if ($lock) { if ($adm==0) msgexiterror ("disabled",0,"getfile.php"); }

			if (($mode<>2)AND($mode<>4)AND(strlen($vID)<$sd[13]))
			{
				print "<b>������ �����</b><br>";
				echo "������������ ���������� ��� ������. ���������� �������� ��� ������� $sd[13] ����.";echo "<form  action=disable method=post>"; hidekey ("go","�����");echo "</form> ";
				exit (1);
			}

			if (($daysleft<-12)AND($vID!=="")AND($ADM>0)) expire ();

			if (!isset ($mode))  msgexiterror ("lostvar",0,"disable");
			//��������� ���������� ��������					//PART OF ID tbl
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
			// $DB - ���� ��� �� decc  $DBC - ���������� ��� ��������, �� ����� ����
			$floodlimit=$sd[12];
// ���-�� �� ����� ��� ���� � ���������� ������ ���� ��� ������� ���� ������ ��� ���� ������.
if ($tbl) if (($usemysql!=="mysql")AND($usemysql!=="fdb")) msgexiterror ("SCP",$usemysql,"admin.php");
###########################
###########################
###########################
			//MYSQLMODESTART
//����� ������������, ��� ��� �� ��������� �����
if (($cm==1)AND($mode==0)) {
print "<html><b>".cmsg ("COMM").":</b><br>";
// ������� ������ ����� ���������� ���� �� ������� ������ JS ��   //print $d ;//method2
$comfile="_local/scrcomm/".$scrdir."/".$vID.".txt";
@ $wr = fopen ($comfile,"r");
$vd=fread ($wr,10000);
echo $vd;
exit;
}
			// �������� ������ ���� �� ������
			if ($prauth[$ADM][10]<$needrights){msgexiterror ("notrights",$needrights,"disable");}

			###################################
			#PREPARING FOR SELECT FIELD FOR DB#
			###################################
			//����������  ����� 7 ����� ����
			if (!$pr[8]) { echo "DEBUG Field state: $field ; ";
			echo "Selected: $selectedfield<br>"; }
			if ($field===false) { echo "fields - false";};

	
		if (($mode>7)and($mode<8)) {
			$kol=($mode-7)*10; $mode= 7;echo "Reselect column for mode 7 : $kol";
		}


			// ���������� � ������������

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
				return $mv; // �� ��������� ������ �� ��������
			}
			$mvcnt=count($mv);			//	echo "Total on massive entered ".$mvcnt." but allowed ".$multilimit."<br>";
			if ($mvcnt>$pr[27]) { $mvcnt=$multilimit ;			//	echo " mvcnt  $mvcnt...  limit  $multilimit...   c27 $pr[27]...<br>";
			lprint ("RF_MULTILIM");echo "$multilimit<br>"; }
			// echo $mv; //	for ($a=0;$a<$multilimit;$a++) {  echo "Number - $a - Named - $mv[$a]<bR>"; }; // debug
			// ����� ����������
	if ($cfgmod>0)	{ echo "Configuration selected $filbas<br>";rfsysdatareq();}
	//$data=		readdescripters ();

// ��������� ����� �� ���� ��������� �� ������
if ($vID=="") if (($go=="�����")OR($mode==5)OR($mode==9)OR($mode==4)) { echo ""; } else {exit (1); };


			if (($cmd[0]==="LPRINT")OR($cmd[0]==="lprint")) { lprint ($cmd[1]); exit;} //.5286742

			$vID= trim ($vID);
			// FIXED MESSAGE 
			//if ($vID[0]===".") { exit;echo "__READ_UNKNOWN_COMMAND";$act="READ Unknown command $vID"; logwrite ($act) ; exit;};  // ����������
			$nametbl=$prdbdata[$tbl][1];
			if ($pr[12]) {$act="READ_M $mode B $tbl($nametbl) Find $vID"; logwrite ($act) ;};  // ���������� 

			//multisearch=1 zone   non-global start

			if ($multisearch==0) {  search () ;}
			if ($multisearch==1) {
				for ($aa=0;$aa<$mvcnt;$aa++)  {$vID=$mv[$aa];
				$vID= trim ($vID);
				echo "<font color=magenta><b>� ".($aa+1)." - $mv[$aa] <br></font></b>";
				search () ;}
			}
			// multisearch end
		
			
			if ($mode<4) { exit; }
			// ������������ ���� ���������� ���������� ������  ���5
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
				global $res16;//maybe bug with res16 ��������
				global $vID2;
				global $limitenable,$selectenable,$field,$printlimit,$addsql,$kol;//  ������������ ��� ������ ����


				###########################################################
				//MYSQLMODESEARCHSTART					NON-GLOBAL MODES //
				###########################################################

				//��������� ������ �� ����� - mode 1 - SQL
				if (($mode == 1)AND($prdbdata[$tbl][12]=="mysql")) {
					@$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					@mysql_select_db ($prdbdata[$tbl][9], $connect);
					$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
					global $query,$connect;
					global $mzdata,$mycols,$myrow,$findrecords,$scrcolumn;
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md1column]." LIKE '%".$vID."%'";
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					$query=$query.$addsql;// ����������, �����
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}
				//��������� ������ �� ����  - mode 2 - SQL
				if (($mode == 2)AND($prdbdata[$tbl][12]=="mysql")) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
					global $query,$connect;
					global $mzdata,$mycols,$myrow,$findrecords,$scrcolumn;
					settype ($vID,"integer");
					if ($vID==0)  msgexiterror ("needcode",$mode,"disable");
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= ".$vID;
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					$query=$query.$addsql;// ����������, �����
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}



				//mode 3 ��������� SQL ������ �� ���������
				if (($mode == 3)AND($prdbdata[$tbl][12]=="mysql")) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					if ($categorymode==false) {   msgexiterror ("nocategory",$mode,"disable");  }
					$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
					$myrow=$data[0];
					global $query,$connect,$mzdata,$mycols,$myrow,$findrecords,$scrcolumn;
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$category]." LIKE '%".$vID."%'";
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					$query=$query.$addsql;// ����������, �����
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}



				if ($mode == 9) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					global $fullfield;
					if ($categorymode==false) {   msgexiterror ("nocategory",$mode,"disable");  }
					$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
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




				//mode 8 ��������� SQL ������ �� ����� �������
				if (($mode == 8)AND($prdbdata[$tbl][12]=="mysql")) {
					global $presettedmode;
					$mode=6; $presettedmode=3;
				}

				if (($mode == 7)AND($prdbdata[$tbl][12]=="mysql")) {
					//ubrat vse vybory polej ne svyazannye s tekushim mode==7( po menu)
					global $presettedmode,$res16,$mznumb,$codekey;
					echo "kol=$kol";$field=$kol;
					global $prauth,$ADM;// ��������� ��� ������������ ������������ ������
					//	echo "Field activated first $field<br>"; //TO DELETE AFTE
					$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
					$eid=encodevID ($vID);  $eolddid=encodevID ($olddvID);  //setup id
					{ 		$selectedfield="!1".$field;
					// ���� field ������ �� �����������
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
//	submitkey ("go","R_SEL_ROW");// ��������� �������� ���� ������ �� �������� ���������� ������� ��� �� ����� :))
echo " </form> ";
			 }

				}


				//mode 6 ��������� SQL ������ �� ��������� �������
				if (($mode == 6)AND($prdbdata[$tbl][12]=="mysql")) {
					$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
					global $categorymode,$mode;
					global $mode6,$m6field,$m6count;
					global $mycols,$mycol,$del,$res16,$presettedmode,$selectedfield,$fields;
					global $partquery,$vID,$mznumb;
					$res16=$prdbdata[$tbl][16];// ����� �������
					if ($mode7==1) { $res16=$selectedfield ;};
					$a=prefixdecode ($res16); //echo "PREFIX $res16";
					mysql_select_db ($prdbdata[$tbl][9], $connect);
					$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
					//$mycol[$md1column]".."
					$mode6=array ();
					global $query,$connect;
					global $mzdata,$mycols,$myrow;
					global $findrecords,$scrcolumn;
					decodecols ();
					$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$partquery ;
					if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					//if (!$pr[8]) { echo "AFTER DECODE categorymode=$categorymode,mode=$mode,m6count=$m6count,	 mode6=$mode6,m6field=$m6field,mycols=$mycols,mycol=$mycol,del=$del,partquery=$partquery,vID=$vID<br>";}
					$query=$query.$addsql;// ����������, �����
					selectedprintsql ($data);
					if ($multisearch==0) {exit (1); }
				}





				//MYSQLMODESEARCHEND

				###########################################################
				//CSVMODESEARCH						NON GLOBAL MODE		 //
				###########################################################


				//	if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";}; // �� �������� �.�. ���� ������ � ������� �� screen ������� ���������� ��������� �� 1 ���.



				// ��������� ������ �� �����  - mode 1 - CSV
				if (($mode == 1)AND($prdbdata[$tbl][12]=="fdb"))
				{
					$findrecords=0;echo "���������� ������ �� ���� ".$namebas." - ".$vID.":\n\n";
					$vIDold=$vID; $vID=strtolower ($vID);
					// @$f=fopen ("_data/".$filbas,"r") or die ("���� ���� �� ������");
					// echo ""; $z=xfgetcsv ($f,512,"�");
					// $mycol=$z;$myrow=array ();$selected=array ();//added
					//$md1column=1;$md2column=0;
					//echo "$cfgmod=cfg;$filbas=fil;$namebas=na,;$md1column=md1;$md2column=md2;<br>";
					$data=readdescripters ();$f=$data[4];
					//echo "$cfgmod=cfg;$filbas=fil;$namebas=na,;$md1column=md1;$md2column=md2;<br>";rd ������ �� ����� ������.
					rfsysdatareq (); // ���������� ���������� ��� ����� ��� ����������
					for ($a=0;$dbc=xfgetcsv ($f,512,"�");$a++) {
						$k = count($dbc);//echo "md1=$md1column";// dbc-��� ����  �- ����� ��� �-���������
						$findid=strpos(strtolower($dbc[$md1column]),strtolower($vID));
						if (($findid!==false)&&($dbc[$md1column]!=="")) { //  �������� �������, �� ����� ���� �������
							$selected[]=$dbc;   //added
						}
					}
					// echo "selectedprintcsv ($mycol,$selected); ".$mycol[0].$selected[0]."--".$selected[0][0]."<br>"; �����
					selectedprintcsv ($data,$mycol,$selected);
					//fclose ($f);
					if ($multisearch==0) {exit (1); }
					// $k= count($dbc) - ���������� ���-�� ��������
				}




				//����� �� ���� - mode 2 - CSV

				if (($mode == 2)AND($prdbdata[$tbl][12]=="fdb"))
				{
					$data=readdescripters ();$f=$data[4];$cfgmod=$data[5];
					rfsysdatareq (); // ���������� ���������� ��� ����� ��� ����������
					if (!$cfgmod) { // ������� ������ ��� ������������, � ��������� ������� ��� ���� ���� ����������
						settype ($vID,"integer");
						if ($vID==0)  msgexiterror ("needcode",$mode,"disable");
					}
					$findrecords=0;echo "���������� ������ �� ���� ".$namebas." - ".$vID.":\n\n";
					for ($a=0;$dbc=xfgetcsv ($f,512,"�");$a++) {
						$k = count($dbc); // dbc-��� ����  �- ����� ��� �-���������
						if ($dbc[$md2column]==$vID) $selected[]=$dbc;  // c ���������
					}
					selectedprintcsv ($data,$mycol,$selected);
					if ($multisearch==0) {exit (1); }
				}


				//mode 8 ��������� CSV ������ �� ����� �������
				if (($mode == 8)AND($prdbdata[$tbl][12]=="fdb")) {
					global $presettedmode;
					$mode=6; $presettedmode=3;
				}

				if (($mode == 7)AND($prdbdata[$tbl][12]=="fdb")) {
			//ubrat vse vybory polej ne svyazannye s tekushim mode==7( po menu)
					echo "m7 ������� vID $vID res16 $res16 STR595<br>";
					global $prauth,$ADM,$codekey;// ��������� ��� ������������ ������������ ������
					global $presettedmode,$mzdata,$mzcnt,$res16,$mznumb,$mycol;
					echo "kol=$kol";$field=$kol;
					///	echo "encodevID  $eid;  encodevID(old) $eolddid ";
					$mode=6; $mode7=1;//$presettedmode=-1; bylo 1.1
					//..	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
					//..	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
					$eid=encodevID ($vID);  $eolddid=encodevID ($olddvID);  //setup id
					if (($field===false)OR($go=="�������_�������")) {
						echo "�������� ���� ��� ������:<br>";// ��������� ��� ������ ����
						echo "result res16=$res16 selfield $selectedfield STR603 a=$a m6=$m6field[0] , $m6field[1] , $m6field[2] <br>";
						echo " do (574) readdesc mznumb1=".$mznumb[1]." mycols".$mycols." mzdata1=".$mzdata[1]." plevel=".$plevel[1]." mycol1=".$mycol[1]."<br>";

						$data=readdescripters ();
						echo " do (576) readdesc mznumb1=".$mznumb[1]." mycols".$mycols." mzdata1=".$mzdata[1]." plevel=".$plevel[1]." mycol1=".$mycol[1]."<br>";
						$mznumb=$data[2]; $mycols=$data[6];$mzdata=$data[0];$plevels=$data[1];$mycol=$mzdata;
						$a=prefixdecode ($res16);
						decodecols ($res16);
						echo "result res16=$res16 selfield $selectedfield STR607 a=$a m6=$m6field[0] , $m6field[1] , $m6field[2] <br>";
						// echo "����� ������� $mycols - ���� �������� �� ������ $mznumb[0];$mznumb[1];$mznumb[2];$mznumb[3]<br>";
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

				//mode 6 ��������� CSV ������ �� ����� �������  �� �������
				// ��������� ������ �� �����  - mode 1 - CSV
				if (($mode == 6)AND($prdbdata[$tbl][12]=="fdb"))
				{
					echo "m6 ������� vID $vID<br>";
					echo "result res16=$res16   STR656";
					global $categorymode,$mode; // ��������� ��� ������������� �  decodecols ()
					global $mode6,$m6field,$m6count,$mycols,$mycol,$del;
					global $partquery,$vID,$mzcnt,$mznumb,$presettedmode;
					$mznumb=array ();
					// TEST ZONE
					$res16=$prdbdata[$tbl][16];// ����� �������
					if ($mode7==1) { $res16=$selectedfield ;};
					echo "$res16 - ";
					$a=prefixdecode ($res16);echo "decoded $a=$res16 $categorymode STR 668";	//������������� ������
					$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
					global $mzdata; $mzcnt=count ($mzdata);//$mycol[$md1column]".."
					$mycol=$mzdata;echo "result res16=$res16 ?STR671";
					$mode6=array ();decodecols ();echo "result res16=$res16 STR 672";
					for ($aaa=0;$aaa<count ($mode6);$aaa++)	{ $fndcolumn=$mznumb[$aaa];
					$findrecords=0;
					//echo "���������� ������ � ".$namebas." - �� ������� ".$mzdata[$fndcolumn]."($fndcolumn) -- ".$vID.":\n\n";
					$vIDold=$vID; $vID=strtolower ($vID);
					$f=$data[4];
					$data=readdescripters ();	$f=$data[4];
					for ($a=0;$dbc=xfgetcsv ($f,512,"�");$a++) {
						$k = count($dbc);$myrow=$dbc;
						// for ($b=0;$b<$k;$b++) {  ��� ��� ���;�������;�������;������  ���� ������ ����������� �� 1,4 films al ��� �� ����������� ����� �������� � ��� ��� �� �����������������
						// $mode7=1 ���� ���� ��� ������.������ ����� ����.
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




				// ����� �� ���������
				// ��������� ���� ����� ����� ���� ��� ���� �� ��������� �����
				// �������� � $prdbdata[$a][category] - ��� ���� � �� �� ������� :)
				// ����� ������� ����� �������
				//����� ��������� ���� - ����������� �������������� ����

				//script update csv 2,3,4 cat to 1 else return false

				if (($mode == 3)and($categorymode==false)) msgexiterror ("nocategory",$mode,"disable");
				if ($prdbdata[$tbl][12]=="fdb")
				if (($mode == 3)and($categorymode==1)OR($mode == 3)and($categorymode==4))
				{
					echo "READFILE:OLD_CORE_MODE.<br>";
					updatedb326 ($filbas);
					$findrecords=0 ;// ����� ���������� ��������� �������
					//$category =1; ��������� ���������� � ���� ���������� - this will reset category  TEST ONLY!
					if (($category==="")||($category===false)) msgexiterror ("nocategory",$mode,"disable");

					if ($vID!=="!101") { echo "�� ������ ������� ".$vID." ���� �������:\n\n"; }
					$vIDorig=$vID; $vID=strtolower ($vID); $found=0;
					@$f=fopen ("_data/".$filbas,"r") or die ("�� ������� ��������� ����������� � ����, ���������� �����.");
					echo ""; $z=xfgetcsv ($f,512,"�"); // ���������
					for ($a=0;$dbc=xfgetcsv ($f,512,"�");$a++) {
						if (($limitenable)AND($findrecords>$printlimit)) {
							echo "����� �������� : $findrecords<br><br> ";exit;};
							$k = count($dbc)-$tablemysqlselect;  // �������� �������, ���������� � prop
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
									$scrnum=$dbc[$scrcolumn];$found=1;//$findrecords++; # �������� ������ 2-����
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

					}  // ��������� ��������� �� ���������� �������� �������  1 �� 3
					// ����� ��������� 4 ����� ������ �������� �������. ������� ��������� ������ 4
//DELETED

		if ((($findrecords===0)AND($adm==1)) OR (($findrecords===0)AND($pr[3]==1))) {
		print "<font color=red><b>�� �������</b><br></font>";
		}
		// restart engine m3�1
				fclose ($f);if ($multisearch==0) {echo "����� �������� : $findrecords<br><br> ";exit (1); }
				}



				// ����� ��������� 1  (� 4-� ���� :) )�� ���� ���������� �������� � ������� �� ������ 2 ������� �� �������� ����� �����.





				if ($prdbdata[$tbl][12]=="fdb")
				if (($mode == 3)and($categorymode>1)and($categorymode!==4))
				{	updatedb326 ($filbas);
				// �������� ��� ����������� ������� �������
				// �������� ������� ��������� ����� � ����� ������� (_conv326)
				echo "READFILE:OLD_CORE_MODE.<br>";
				// ����� ���������� ��������� �������
				//if ($vID!=="!101") { echo "���������� ������ �� ���� ".$namebas." - ".$vID.":\n\n";}
				//$category =1; ��������� ���������� � ���� ���������� - this will reset category  TEST ONLY!
				if (($category==="")||($category===false)) // �������� ����� ���� ����� ��� ���������.
				{
					msgexiterror ("nocategory",$mode,"disable");
				}
				//  !101 - tablemysqlselect - hostmysqlselect - - ������� �� prop  ����� ��� ����. ��������  �������� ������
				//���� ������� 1findid!==false �� ��� ��������� � �� ����� ����� ��������. ������ �������� ���.�������
				//���� ������� 1findid==false �� ��������� ������� 2findid!==false  ����� ��� �������
				//���� ������� 1==false � 2==false ����� �������� 3 ���� ��� ���������� �����
				//echo $findrecords;//if ($vID!=="!101") { echo "�� ������ ������� ".$vID." ���� �������:\n\n"; }
				$vIDorig=$vID; $vID=strtolower ($vID); $found=0;
				@$f=fopen ("_data/".$filbas,"r") or die ("�� ������� ��������� ����������� � ����, ���������� �����.");
				echo ""; $z=xfgetcsv ($f,512,"�"); // ���������
				for ($a=0;$dbc=xfgetcsv ($f,512,"�");$a++) {
					if (($limitenable)AND($findrecords>$printlimit)) {
						echo "����� �������� : $findrecords<br><br> ";exit;};
						$k = count($dbc)-$tablemysqlselect;  // �������� �������, ���������� � prop
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
		// ����� ��������� 2 ��������� �������� ������� 2, ����� 3 - �� ��������� (������ findid1)
		// ����� ��������� �������� ������ ������� ���������� ��� ����� ��������� � ������� �� 1
							if ($categorymode===3) {

								if ((($findrecords===0)AND($adm==1)) OR (($findrecords===0)AND($pr[3]==1))) {
									print "<font color=red><b>�� �������</b><br></font>";
									print "����� ��������� �� ������� ����� ������� ������.<br>�������� ����� ������������?";
		?>
				<form action="r.php" method=post><?
						hidekey ("vID",$vID); hidekey ("mode",1);
		hidekey ("adm",$adm);	hidekey ("commode",$commode);
		hidekey ("tbl",$tbl);	hidekey ("go",$content1);

	echo "<p align=center>";submitkey ("go","YES");echo "</p></form>";
	echo "<form action=disable method=post> 	<p align=center>";submitkey ("go","NO"); echo "</p></form>";			}
							}
							// restart engine m3�2
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
					print "<font color=red><b>�� �������</b><br></font>";
						}


				// restart engine m3�3
				fclose ($f);if ($multisearch==0) {echo "����� �������� : $findrecords<br><br> ";exit (1); }  }

			}

			###########################################################
			//CSVMODESEARCHENDED				NON GLOBAL MODE END  //
			###########################################################



			###########################################################
			//				GLOBAL MODE								 //
			###########################################################

			//������ ��� - ����� 4 - global mode   SQL

			if (($mode == 4)AND($prdbdata[$tbl][12]=="mysql")) {
				global $query,$connect;
				global $mzdata,$mycols,$myrow;
				global $findrecords,$scrcolumn;
				$connect = mysql_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
				mysql_select_db ($prdbdata[$tbl][9], $connect);
				$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
				$query = "SELECT * FROM `".$prdbdata[$tbl][5]."`";
				$query=$query.$addsql;// ����������, �����
				$oldvID=-1;
				selectedprintsql ($data);
			}

			
			
			if (($mode == 4)AND($prdbdata[$tbl][12]=="fdb"))
			{ echo "<u>����� ����������� ���� ������.</u>";	$multisearch=0;
			$data=readdescripters ();$f=$data[4];
			//$f=$data[4];  ++$enabledataconnreturn=1; ������ init 495
			for ($a=0;$dbc=xfgetcsv ($f,512,"�");$a++) {
				$k = count($dbc);   $selected[]=$dbc;    }
				$oldvID=-1;
				selectedprintcsv ($data,$mycol,$selected);
				//fclose ($f);exit;
			}



			echo "<br>";
			//����������� �� ���� - ����� 5 - global mode   CSV&SQL
			// ����� ����������� �������������� ����������� �����.





			if (($mode == 5)AND($pr[52]))
			{
			$activetable=$prdbdata[$tbl][1];
			//echo "Active table: $activetable [$tablemysqlselect'$tblmysqlselect]; Given data total:$boxcnt<br>";
			echo cmsg(A_BEST).".<br>";
			$filbas=$userfolder."/best.cfg";  // �������� ����� �� � initse  � ��������� ����� ���� ����� ������ ���+++
  				@$best=csvopen ($filbas,"r",0);$data=readfullcsv ($best,"new");
 				// $data=readdescripters ();
   			$bestheader=$data[0];$bestplevel=$data[1];$bestcontent=$data[2];$bestcnt=$data[3];
  			$strokedata=$activetable."�".$tablemysqlselect."�".$tblmysqlselect."�"; // FORMAT^    tablename;id1Xid2;id1Xid2
  			@fclose ($best);	
  
  /*//$editor=csvopen ("editor.cfg","r",1);
				//if ($editor===false) echo "Config cannot be loaded...";
				for ($a=0;$e=xfgetcsv ($editor,912,"�");$a++) {
					if ($tbl==$e[0]) {$srch = count($e);  $selected= $e[0];echo "������ ������ �� ������ ��������<br>"; break;}
				}
				*/
   for ($a=0;$a<$bestcnt;$a++) {
  	if ($bestcontent[$a]!=="") if (strpos (@implode ($bestcontent[$a],"�"),$strokedata)!==false) {
  		$rewritecnt=$a;
  		//echo "Found $rewritecnt contains ".$bestcontent[$rewritecnt][0]."<br>";
 // 		echo "Already present, remove first please. Address:$rewritecnt of $bestcnt<br>";exit;
  	}
  	//�������� �������� ������� , ������ ������ �������� �������� ���������.
  }
  				if ($rewritecnt==false) msgexiterror ("nobest",$prdbdata[$tbl][1],"getfile.php");
 //$string=explode ("",$)

				$mode=2;$multisearch=1;// ������� ���������� ������������� :)
				for ($aa=3;$aa<count ($bestcontent[$rewritecnt]);$aa++)
				{ $string=explode ("+",$bestcontent[$rewritecnt][$aa]);
				$vID=$string[0];$vID2=$string[1];  //no +
				//echo  "$vID=$string[0];$vID2=$string[1];  //no +";
				 search ();
				//echo "$vID - is searching  this is  $dbc[0]<br>";
				}
			}






			//global mode 9 - no needs vID   (old 6)
			// �������� ��� ���� �� ������� ������� ��� �� ������� ���� ������ ������ ���� 5 ������
			if (($mode == 9)AND($prdbdata[$tbl][12]=="mysql")){ msgexiterror ("errorcfg",$mode,"admin.php");}
			if (($mode == 9)AND($prdbdata[$tbl][12]=="fdb")){ msgexiterror ("errorcfg",$mode,"admin.php");}


			// mode 10 - find comment  sql
			if ($mode == 10) {
				$scrdir="_local/scrcomm/".$scrdir;
				@$dircb=opendir ($scrdir);if (!$dircb) {echo "��� ���� ���� ��� ������������.";exit ;};
				//echo "���� ������������ = $comfile ";
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
						if ($aaa!==false) echo "<font color=gray>".$filescb[$aa]." �������� </font><br>".$comm."<br><br>";
					}

				}
				echo "����� ������������ � ������ : ".$commcount."<br>";
				//	$scrnum; - �� ��� �����
				if ($multisearch==0) {exit (1); }
			}
			// mode 10 end sql find comment




			###########################################################
			//				GLOBAL MODE	END							 //
			###########################################################
			//����������� ��� ������� �������. ��� ������������ � �������


			if ($mode > 10) {msgexiterror ("errorcfg",$mode,"admin.php");}




			###########################################################
			//				FUNCTION ZONE							 //
			###########################################################
			// ������� ������� ���� ���� ��� ������ �� ���� � ���������� ���������� ������������ ���� ����
			// ��� ������ ���� ������� ����������� ������ �� 0 �������, ��� ��������� �� ������� ���������



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
				header('WWW-Authenticate: Basic realm="������ ������ dbscript "');
				header('HTTP/1.0 401 Unauthorized');   echo "<form action='getfile.php' METHOD='post'>\n"; //{$_SERVER['PHP_SELF']}
				echo "<input type='hidden' name='SeenBefore' value='0' />\n";
				echo "<input type='hidden' name='OldAuth' value='{$_SERVER['PHP_AUTH_USER']}' />\n";
				submitkey ("auth","AUTHEN");
				echo "<br><br>Can be used only one times. Other way - is close and open your browser.";
				echo "</form></p>\n";
			}



			function errors () {
?>
 ������ ���������� ����� �������� � ����� ������ ���������<br>
 ������ ����� - ������ ��������� � ��������� ������������� �������.<br>
 �� ������� - � �������� ������� �� ��������,����� �� ����������� ������<br>
 ������ � ���������� - �������� ������������.<br>
 ��� ������� (������ ����������)- ������ ������ �������������� .<br>
 * - � ������� ������.<br>
<?

			}

			function helplog ()
			{
			echo "������ ���������� ����� �������� � ����� ������ ���������<br>";
			echo "<a href='_logs'>������ ������� ���� (�����,������,������ ��������, �������.</a><br>";
				print "������ ����������� ����� ���� � ��������, ����� ��������� ������ ������:<br>";
				print "M - ����� ��������� ";//1- �� �������, 3 - �� ������.<br>";
				print "B - ������������ ����  ";//0 - ���������� ���� 1 - ����������� � ��.����.<br>";
				print "����� ����������� ����� IP � ��������(�).<br>";
			}



			function aboutme () {
				global $languageprofile;//$message="";
				//$icon="info";
				$mainheader="<img src=_ico/conf.png>"."About me";
				$script=array ( 'message'=>$message,'icon'=>$icon,'mainheader'=>$mainheader );
				$actions="";
		 		window ($script,$actions);
		 		if ($languageprofile=="russian") {
		 			echo "<br>Dbscript (DBS) - ��������� ��� ��������� ������ � ������ ������ � �������������� ������� ������������� �������";
		 			echo "<br>����� ���������: ������ �.�. (aka Dj--alex)  ����������:2006-2008";

		 		}
		 		if ($languageprofile!=="russian") {
		 			echo "Dbscript (DBS) - program for group work with DATABASEs + full controlled rights.";
		 			echo "<br>Author program: Fufaev A.V. (aka Dj--alex)   Developing:2006-2008";

		 		}
		 		closewindow ();
		 		exit;
			}

//http://dj.chg.su/dbscript/DBSCRIPTinstruction.doc

/* not include in  - �� ��������� � �����������

	��� ����������� �������.
���������� �������� ������ � ���������� ��������.

1.���� ��� ������� ����� ���������� ���������, � �������� ��� �������.
2.��������� ���� �����������,
3.������ ��� ������ � �������������.
4.���� ������ � �������� sql ����������� ��� ����. Excel, Access, Csv ���� ������ �������������� �� ���������� �������������.
5.�������� �������� ������ � �������, �������.

������ �������: �������� ����������� ������� � ������ sql �������, ��� ���������� ��������� ������� dj.chg.su ��������� ����� SQL, ��� �� �� ��� ����������� ������ ������, � ������ � ������ ��� ���������. ����� ����������� ����� ����������� ��� ������ �� ����� ������� (�\� � �������).

�����: ������ �������� �������,�.�. �������, ������ � ��. � ��� ��������� ������������ �� ����
������ - ���������� ����������� ������������.

��� ����������� ��������� ��� ����� ������ - �� ������������.


� ������� ������� ��������:
��������� ����������� � �������� �� �������� ���������� 28.8�
�.� �� ������ �������� ����� �������� �������� 2 �������.
���������� ��� ������ ����� ��� ����� ������������ ����� ������� ������,�.�. ���������� �������.
��� ����� ������� �������� �����-������-���������-���������� ����������� ����� 70��.
���� ����� �������� �������.


��� ���������� �������� SQL:
��� ������ ��������� � ����� �������� ������ ��������� ������ � mysql � ������� dj.chg.su.
��� �� ������ �������� ������������ � ������������ �������,� �� �������� ��������� ������.
������ �� ������ ������ ��� ������, � ����� �� ���� �� ��������� ���������������� �������.
���� sql ��������� ������ ��� ����� �������,����� ����� ���������� �������� � �������������.
��������������� �����: SELECT , INSERT, UPDATE,DELETE,CREATE,DROP, ALTER, SHOW DB.
������������� ����������� �� ���������� ������ ���� ����������.������������� ������������ ��� � �� ������������� �� ������ �������.

PS.C��� ������������� ������� (���� ����) ������ ��������� �� ���������� �������������� ���� � �� ���������.
��� ���������� ����������� ������ - ���������� �������� � �����������.
��� ������ ������, �������� ���� ��������� ������ ��� �������� � �������� ����.

��� ���������� ������������ ��������� ����� �������� �� ���� �� ������ dj--alex@ya.ru.

���� �� �������������� � ������������ ������ �������� ������ ���������� � ������ ������. �.�. ���� �� �� ���������� ���. � ������������ dbscript - ��� ��� ��� ����� ����� ������. (��������� - ��. ������������).

*/

/*  Sample windows   �� ������������ ��� ���? ����� ������� ��� � �������� window

	$script=array ( //  ��� special ������ ������ ������� ��� �������� data
		'message' => "���������",				// ���������
		'icon' => "info" ,
      'mainheader' => "������� �����");

	$actions=array ( //  ��� special ������ ������ ������� ��� �������� data
		'OK' => "r.php?tbl=22&mode=8&vID=118257",			// ���������
		'������' => "admin.php",				// ���������
		'���������' => "admin.php?write=������_�������");

//window ($script,$actions);closewindow ();

			// SCRIPT WRITTEN BY DJ--ALEX
			#####################################################
			*/

endtm ();

?>
