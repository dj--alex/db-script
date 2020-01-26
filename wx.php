<?php
// Äàííàÿ ïðîãðàììà îòíîñèòñÿ ê ïàêåòó DBSCRIPT v2.1 (ñ) dj--alex
if ($_FILES) ob_start(); // äîáàâëåíî ò.ê. â 2033 ñòðîêå íåïîíÿòíî ïðèñëàëè ôàéë âîîáùå èëè íåò
require_once ('dbscore.lib'); // ôóíêöèÿ ïîäãîòîâêè ê ðàáîòå è àâòîðèçàöèè
if (!$activation) Header("Location: login.php");;  //http://127.0.0.1/dj/site/login.php  ñòàðàÿ àâòîðèçàöèÿ  â dbscript zone âñïëûëà - êîãäà óáèðàòü òî?
//$error=pg_connect ("!","2","3");echo $error;    postgre-php not installed
///if ($enablewin32enctooldmenu)
// TinyMCE addition
  /* ?> <script type="text/javascript" src="tinymce/tiny_mce.js"></script>
   <script type="text/javascript">
       tinyMCE.init({
               mode:"textareas",
               theme:"advanced",
               language:"en"
           });
    </script><?php */
$verwritefile="Editor v4.3.3 beta (c) dj--alex";
 global $verwritefile,$vID,$vID2;

$enterpoint=$verwritefile;// äëÿ ïîêàçà òî÷êè âõîäà
autoexecsql ();
import_request_variables ("PGC","");  // óíèâåðñàëüíîå ðåøåíèå ïðîáëåì
//ïðèåì äîëáàíûõ ôàéëîâ
// ÷àñòü íåêîòîðûõ çàãðóçîê ïåðåìåííûõ ìîæíî óäàëèòü
if (isset($_FILES["userfile"])) ob_start (); // òàêîå ÷óâñòâî ÷òî ýòà ÷àñòü êîäà ïðîñòî èãíîðèðóåòñÿ.


$writefile=1;
IF ($pr[36])  if (!isset($_SERVER['PHP_AUTH_USER']) ||
   ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
  authenticate ();}



if ($frameoldcore==0) $fil=getvar ('fil'); //áûëî óñòàíîâëåíî íåâåðíîå 1
 if ($fil!==false) {$data= explode (";",$fil);
					$tbl= $data[0];	$vID=$data[1];	$vID2=$data[2]; $datafieldcolsel=$data[3];// virtual id
				 };
 // íàñòðîéêà ïðåôèêñîâ äëÿ ðàáîòû ñ ëþáûì ÿçûêîìûì cmd
if ($cmd=="ed") { $write=cmsg ("KEY_EDIT"); }
if ($cmd=="add") { $write=cmsg ("KEY_ADD"); }
if ($cmd=="del") { $write=cmsg ("KEY_DEL"); }
if ($cmd=="hdr") { $write=cmsg ("KEY_HEAD"); }
if ($cmd=="dat") { $write=cmsg ("KEY_DATA"); }
if ($cmd=="sql") { $write=cmsg ("KEY_EXECUTE"); }
if ($cmd=="sqle") { $write=cmsg ("KEY_S_EXEC"); }
if ($cmd=="join") { $write=cmsg ("KEY_LINKING"); }
if (($masstbl)AND($write==cmsg ("KEY_MASS_OPER"))) { $tbl=$masstbl;  }

  if ($commode!==false) { $commode=1;}
  if ($codekey==5) { needupgrade ();exit;};
//if (!$pr[8]) { echo "write=$write  vd=$vd  go=$go <br>";}

//RIGHTSLIMITATION
if ($ADM==0) { msgexiterror ("notright","","disable");Header("Location: login.php");}
If ($prauth[$ADM][3]==false) { msgexiterror ("notright","","disable");exit;}
//END OF RIGHTS LIMITATION
lprint ("WF_WELCOM");

 if ($nokeys==1) nokeys (1);
 if ($daysleft<1) expire ();
//PART OF ID tbl
if ($pr[37]) {// analog in getfile
?><br><form action="w.php" method="post" id="edit">
<input type=hidden name=vID value=<?=$vID; ?>></input>
	<input type=hidden name=vID2 value=<?=$vID2; ?>></input>
	<input type=hidden name=colfind value=<?=$colfind; ?>></input>
	<input type=hidden name=intf value="master-mode"></input>
	<input type=hidden name=mode value=<?=$mode; ?>></input>
    <input type=hidden name=printlimit value=<?=$printlimit; ?>></input>
    <input type=hidden name=field value=<?=$field; ?>></input>
    <?php 		//section select group
    // REMOVED at 4.0.97  changed to part of getfile.php $list=groupdbdetect($prdbdata);
	///                             //	hidekey ("groupdb",$groupdb);print_r ($list);	//	print_r ($a);
	//groupdbprint ($list,"Group",$prdbdata,$tbl,$groupdb);
        	//	hidekey ("groupdb",$groupdb);print_r ($list);	//	print_r ($a);
        $grouplist=groupdbfielddetect ($prdbdata,17);// set group as field
        $groupdbthisname="groupdb";
	if (!$hidemenu) {
            groupdbprint ($grouplist,"Group",$prdbdata,$tbl,$groupdb);

        $grouplist2=groupdbfielddetect ($prdbdata,6);// set IP as field
        $groupdbthisname="ipfilter";// in future - add this variable to f
        groupdbprint ($grouplist2,"IP",$prdbdata,$tbl,$ipfilter);// IP CFG OPT FUTURE  TODO: groupdbfielddetect
	submitkey ("write","SELECT");
	if ($prauth[$ADM][2]) submitkey ("live","LIVEMOD");echo "*";
 	if ($live) echo "in future release!";  // 		hidekey ("live",$live);  STATEMENT LOST
        }
 		echo"</form>";
}


?>
<form action="w.php" method=post><?php hidekey ("vID",$vID);
hidekey ("vID2",$vID2);//...hidekey ("colfind",$colfind);
hidekey ("groupdb",$groupdb);//added
hidekey ("ipfilter",$ipfilter);

//ìîäóëü çàïóñêà è îáðàáîòêè
if ($write==cmsg ("KEY_CFG")) {
	echo "<br>".cmsg ("ADM_CSEL").":<br>";
	submitkey ("write","CF_USRS"); 	submitkey ("write","CF_DB");submitkey ("write","CF_FIL");
 	submitkey ("write","CF_DWORD");	submitkey ("write","CF_PAGES");
	submitkey ("write","CF_STYL");	submitkey ("write","CF_LSET");
        submitkey ("write","CF_SRV");	if ($prauth[$ADM][42]) submitkey ("write","CF_CMD");
        if ($prauth[$ADM][42]) submitkey ("write","CF_FSCR");
        exit;
}

// $k= count($db) - âû÷èñëåíèå êîë-âà ñòîëáöîâ// c7 0 - select  c7 1 - start
$deftbl=$pr[16];

//if (!$hidemenu)
if (($prauth[$ADM][24]==false)OR(!$tbl)) { printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbl",lprint ("SELLINK"),$groupdb,$ipfilter,6);
submitkey ("write","A_USRGO" ); //íàéäåí êîä òðåáóåìîé áàçû
}
  //if (isset ($colfind)) { $colfind= $md2column;} äëÿ ÷åãî åå íèãäå íåòó?
?>
</form>

<?php
if (($dblk)AND($cmd=="sqle")) {
    $tbl=1;
		$prdbdata[$tbl][12]="mysql";
		$prdbdata[$tbl][5]=$tab;		$prdbdata[$tbl][0]=$tab;
		$prdbdata[$tbl][1]=$tab;		$prdbdata[$tbl][6]=$mainhostmysql; //6
		$prdbdata[$tbl][9]=$dblk;$errorredirectdb=1;


}

if (($cmd=="sql")AND($tbl=="")) {;// dblinker
	//	echo "tab=$tab<Br>";
$modeselectsimilartable=$pr[53];
		if ($modeselectsimilartable) for ($a=0;$a<count($prdbdata);$a++) {
			//åñëè òàáëèöà íå óñòàíîâëåíà ïûòàåìñÿ ïîäîáðàòü íàèáîëåå ïîõîæóþ.
			// 6 - server - not checked.  ïðîïóùåíî. ìá ïîòîì äîáàâèòü
		if ($prdbdata[$a][9]===$dblk) { $tbl=$a ;$errorredirectdb=1;} //ïðîâåðêà áàçû, âûáîð ëþáîé òàáëèöû èç áàçû íàóãàä
					}   // íå èñïîëüçóåòñÿ ïîêà÷òî

		if (!$modeselectsimilartable) {

	$tbl=1;
		$prdbdata[$tbl][12]="mysql";
		$prdbdata[$tbl][5]=$tab;		$prdbdata[$tbl][0]=$tab;
		$prdbdata[$tbl][1]=$tab;		$prdbdata[$tbl][6]=$mainhostmysql; //6
		$prdbdata[$tbl][9]=$dblk;$errorredirectdb=1;}
		//ïîäñòàâêà çíà÷åíèé âìåñòî äàííûõ èç dbdata CFG OPT FUTURE  TODO: - âîçìîæíî ïåðåêëþ÷åíèå 2 ðåæèìîâ
		}
		//if (($prdbdata[$a][5]===$tblk)AND($errorredirectdb==false)) { $tbl="";$errorredirecttb=1;} //
if ($cmd=="sql") {
	$directexecute=1;
	if ($fdmp==1) $write=cmsg("WF_BCK_FILEDUMP_UNARCH");  // EXECUTE SQL DUMP , RESTORE FROM BACKUP *normal
}

//PART OF ID tbl
$filbas=$prdbdata[$tbl][0];			$namebas=$prdbdata[$tbl][1];
$needscr=$prdbdata[$tbl][2];			$scrdir=$filbas."scr";
$formatscr=$prdbdata[$tbl][3];		$category=$prdbdata[$tbl][4];
$tablemysqlselect=$prdbdata[$tbl][5]; if ($tablemysqlselect==="") $tablemysqlselect=0;	//reset to default
$hostmysqlselect=$prdbdata[$tbl][6];  if ($hostmysqlselect==="") $hostmysqlselect=0;	//reset to default
$categorymode=$prdbdata[$tbl][7];	$scrcolumn=$prdbdata[$tbl][8];
$tblmysqlselect=$prdbdata[$tbl][9];
$md1column=$prdbdata[$tbl][10];		if ($md1column==="") $md1column=1 ;	//reset to default
$md2column=$prdbdata[$tbl][11];		if ($md2column==="") $md2column=0;	//reset to default
$dbtype=$prdbdata[$tbl][12];		$writeright=$prdbdata[$tbl][13];
$needrights=$prdbdata[$tbl][14];		$virtualid=$prdbdata[$tbl][15];
$reserved16=$prdbdata[$tbl][16];	    $res16=$reserved16;$reserved17=$prdbdata[$tbl][17];
$dbtype=$prdbdata[$tbl][12];
$floodlimit=$sd[12];
$encode=$prdbdata[$tbl][21];


// Ïðîâåðêà óðîâíÿ ïðàâ
if ($prauth[$ADM][10]<$writeright) msgexiterror ("notrights",$writeright,"w.php");
// Âíåñåíà ïðàâêà ÷òîáû íåëüçÿ áûëî ðåäàêòèðîâàòü òàáëèöó 2-ãî óðîâíÿ ñ 2-ì óðîâíåì ïðàâ.

if ($prauth[$ADM][2]) {  //ìîäóëü ñîâìåñòèìîñòè ñ conf ôàéëàìè.
	if ($write==cmsg ("CF_USRS")) { $tbl="gmdata";$namebas=$tbl;};
	if ($write==cmsg ("CF_DB")) {$tbl="dbdata";$namebas=$tbl;};
	if ($write==cmsg ("CF_FIL")) {$tbl="files";$namebas=$tbl;};
	if ($write==cmsg ("CF_DWORD")) {$tbl="denywords";$namebas=$tbl;};
	if ($write==cmsg ("CF_PAGES")) {$tbl="pages";$namebas=$tbl;};
	if ($write==cmsg ("CF_STYL")) {$tbl="styles";$namebas=$tbl;};
	if ($write==cmsg ("CF_LSET")) {$tbl="langset";$namebas=$tbl;};// dalee chastx from libmysql
        if ($write==cmsg ("CF_SRV")) {$tbl="srvlst";$namebas=$tbl;};// dalee chastx from libmysql
        if ($prauth[$ADM][42]) if ($write==cmsg ("CF_CMD")) {$tbl="cmdlines";$namebas=$tbl;};// dalee chastx from libmysql
        if ($prauth[$ADM][42]) if ($write==cmsg ("CF_FSCR")) {$tbl="filescript";$namebas=$tbl;};// dalee chastx from libmysql
	//require_once ("_sys/rfsysdatareq.php");
	rfsysdatareq ();
        $encode="windows-1251";$prdbdata[$tbl][21]=$encode; // êîäèðîâêà íå ìåíÿåòñÿ !!
	if ($namebas=="") { $namebas=$tbl;$filbas=$tbl.".cfg";$cfgmod=1;};
}

if ($tbl) if (($prdbdata[$tbl][12]!=="mysql")AND($prdbdata[$tbl][12]!=="fdb")AND($prdbdata[$tbl][12]!=="pg")AND($prdbdata[$tbl][12]!=="ibase")) msgexiterror ("SCP","Alias=$tbl,as =".$prdbdata[$tbl][12],"admin.php");
if ($cfgmod==2) msgexiterror ("nologsedit",$namebas,"w.php");


?>
<form action="w.php" method=post>
<?php
if (!$hidemenu) {
hidekey ("groupdb",$groupdb);//added  - ãðóïïà ïðè âûáîðå îïåðàöèè â ðåäàêòîðå áîëåå íå òåðÿåñÿ.
hidekey ("ipfilter",$ipfilter);//added  - ãðóïïà ïðè âûáîðå îïåðàöèè â ðåäàêòîðå áîëåå íå òåðÿåñÿ.
    echo "ID1 ";inputtxt ("vID",30); }
if ($prdbdata[$tbl][22]) $directedit=1;
if (!$directedit) if (($virtualid==true)OR($virtualid=="0")) {
   if (!$hidemenu) {  echo "ID2 ";inputtxt ("vID2",8); }
};
if ($directedit) { echo " Directedit mode.";} // hidekey ("vID2",$vID2); $vID2=""; íå ïîìîãëî îò  Ýòî çíà÷åíèå íåçàíÿòî.

#################################################################
// Ïîïðàâêè íà òåêóùèå íàñòðîéêè
################################################################3/
//âûâîä òåêóùåé ÿ÷åéêè


//if ($pr[9]==1) checkbox ($commode,"commode"); lprint ("WF_NOSCR");
//if (($cfgmod<1)AND($prauth[$ADM][18]))	 {checkbox ($prauth[$ADM][18],"noaddmode");lprint ("WF_ALLFLD");echo "<br>";}

if (($cfgmod<1)AND($prauth[$ADM][2])) {
	echo "<a href='w.php?cmd=ed&fil=dbdata;".$prdbdata[$tbl][0]."'><img src='_ico/linked_table-no.png' border=0 title='".cmsg ("PROP_EDIT")."'></a>";
}


   if ($hidemenu) $menudisable=1;
if ($namebas==false) {echo "<br><red>";
    lprint ("WF_NOLNK");
    echo "</red><br>";
    $menudisable=1;} else {
    echo "<br>";
    lprint ("CONNLINK:");
    echo "<grn> $namebas ($tbl) [$tablemysqlselect'$tblmysqlselect ".$prdbdata[$tbl][12]." server $hostmysqlselect]<br></grn>";}
print "<input type=hidden name=tbl value=$tbl>";
	hidekey ("live",$live);
if ($menudisable==0) {

submitkey ("write","KEY_EDIT");
submitkey ("write","KEY_ADD");
submitkey ("write","KEY_DEL");
 if (($prauth[$ADM][23]==true)or($cfgmod==1)) submitkey ("write","KEY_VIEW");
submitkey ("write","KEY_COMM");

if ($prauth[$ADM][6]) { submitkey ("write","KEY_HEAD");}; //CFG OPT FUTURE  TODO:!
if ($prauth[$ADM][10]) { submitkey ("write","KEY_AN");  };
if ($prauth[$ADM][35]) { submitkey ("write","KEY_MASEXC");submitkey ("write","A_IMPEXP"); };  //CFG OPT FUTURE  TODO:!
if (($prauth[$ADM][35])AND(!$cfgmod)) { submitkey ("write","KEY_MASCPY"); };  //CFG OPT FUTURE  TODO:!
if (($prauth[$ADM][35])AND(!$cfgmod)and($prdbdata[$tbl][12]!="fdb")) { submitkey ("write","KEY_SHOWCODE"); };  //CFG OPT FUTURE  TODO:!
if (($prauth[$ADM][34])and($prdbdata[$tbl][12]!="fdb")) { submitkey ("write","KEY_EXECUTE"); };  //CFG OPT FUTURE  TODO:!
if (($prauth[$ADM][43])and($prdbdata[$tbl][12]!="fdb")) { submitkey ("write","BACKUPS"); };  //CFG OPT FUTURE  TODO:!

if ($prauth[$ADM][43]) {
     submitkey ("write","KEY_COMPARE"); submitkey ("write","KEY_MACRO");echo "<br>"    ;};



}
echo "<br>";
  if (($write===cmsg("A_IMPEXP"))AND ($prauth[$ADM][10]>0)) { importexporttbl () ; exit;}
  //if (($ietbl==1)AND ($prauth[$ADM][10]>0)) { importexporttbl () ; exit;}
   if ($write===cmsg("A_IE_DEST")) { importexporttbl () ; exit;} // íåäîïåðåíåñåíî êóäà íàäî.
   if ($write===cmsg("A_IE_SRC")) { importexporttbl () ; exit;}
   if ($write===cmsg("A_CONV_SRC_CHG")) { importexporttbl () ; exit;}
   if ($write===cmsg("A_CONV_DEST_CHG")) { importexporttbl () ; exit;}
   if ($write===cmsg("A_CONV_SRC_CHG")) { importexporttbl () ; exit;}
   if ($write===cmsg("A_CONV_SRC_CHG")) { importexporttbl () ; exit;}

   if ($write===cmsg("A_IE_START")) {
	    if (($codekey==7)OR($codekey==9)OR($codekey==8)) demo ();
		if (($codekey==4)OR($codekey==5)) needupgrade ();
		$act="Exchange $tbl1 to $tbl2";		logwrite ($act); importexporttbl () ; exit;
		}

if ($menudisable==1) { if ($prdbdata[$tbl][0]=="") exit; };



if (($errorredirectdb)) { //dblinker enter
	echo "<br><red>".cmsg (REQ_LINK)." $tab ".cmsg (AND_DB)." $dblk".cmsg (M_SEL_DB)." $dblk<br></red>";
	if ($modeselectsimilartable) echo cmsg (WORK_MODE).":".cmsg (MOD_SEL_TAB)."<br>";
    if (!$modeselectsimilartable) echo cmsg (WORK_MODE).":".cmsg (MOD_SIM_TAB)."<br>";
 //echo "write=$write;";
}


//ìîäóëü çàïóñêà è îáðàáîòêè
if (($write==cmsg ("KEY_VIEW"))AND($prdbdata[$tbl][12]=="fdb")) {
$mode=2;//$scrcolumn=0;$tablemysqlselect=0;$md2column=0;
if ($cfgmod==1) { // ïðîñòî êîïèÿ ðåæèìà 4 èç readfile
echo "<uu>"; lprint ("RF_M4MSG"); echo "</uu>";	$multisearch=0;
	 			$data=readdescripters ();$f=$data[4];
				 for ($a=0;$dbc=xfgetcsv ($f,$xfgetlimit,"¦");$a++) {
					  $k = count($dbc);   $selected[]=$dbc;    }
  	$oldvID=-1;
  	if (($codekey==9)or($codekey==7))  { lprint ("DEMO_1");$printlimit=3;$limitenable=1;};
	selectedprintcsv ($data,$mycol,$selected);
	exit;
}

lprint ("WF_RF1");echo ":<br>";
if ($vID==false) msgexiterror ("needcode",$mode,"w.php");
if ($mode == 2)
{
$data=readdescripters ();$f=$data[4]; if ($f==-1) die ("aaaargh! 163!");
$mycol=$z;$myrow=array ();$selected=array ();//added
$findrecords=0;lprint ("RF_RESSRCH");echo " ".$namebas." - ".$vID.":";
//echo "f--$f";
for ($a=0;$dbc=xfgetcsv ($f,$xfgetlimit,"¦");$a++) {
$k = count($dbc);   //echo $dbc[0];
//modify
	if (($dbc[$md2column]==$vID)AND($vID2=="")) {   //modified if  and duplicated query
			$selected[]=$dbc;
			}
	if (($dbc[$md2column]==$vID)AND($vID2!=="")AND($dbc[$virtualid]==$vID2)AND($virtualid===true)) {
			$selected[]=$dbc;
			}
}
   selectedprintcsv ($data,$mycol,$selected);
//repeat
lprint ("WF_RF2");echo ":<br>";
$data=readdescripters ();$f=$data[4];
$findrecords=0;lprint ("RF_RESSRCH");echo " ".$namebas." - ".$vID.":";
for ($a=0;$dbc=xfgetcsv ($f,$xfgetlimit,"¦");$a++) {
$k = count($dbc); echo "";
echo "<table border=3 width=100% bgcolor=white>"; echo "<tr>";
if ($vID!=="") $findid=strpos ($dbc[$md2column],$vID);
if ($vID2!=="") $findid2=strpos ($dbc[$virtualid],$vID2);//mod - add for corr if
				if (($findid!==false)AND($vID2=="")) {   //modified if  and duplicated query
					if ($dbc[$md2column]==$vID) continue;
			$selected[]=$dbc;
			}
				if (($findid!==false)AND($vID2!=="")AND($findid2!==false)) {  //mod if
					if (($dbc[$md2column]==$vID)AND ($dbc[$virtualid]==$vID2)) continue;
			$selected[]=$dbc;
			}

}
   selectedprintcsv ($data,$mycol,$selected);
}

	$mode=6; $presettedmode=3;set_time_limit(0);
 //from readfile part
//mode 6 ïðîöåäóðà CSV ïîèñêà ïî íîâîé êîëîíêå  ÍÅ ÑÄÅËÀÍÎ
// ïðîöåäóðà ïîèñêà ïî èìåíè  - mode 1 - CSV
if (($prauth[$ADM][18]>0)AND($noaddmode==1))
 {
$mznumb=array ();lprint ("WF_CMPALL"); echo "<br>";
// ÂÑÒÐÎÈÒÜ, ÌÎÄÅÐÍÈÇÈÐÎÂÀÒÜ  	$query=$query.") AND `".$mycol[$md2column]."` NOT LIKE '%".$vID."%'";
// TEST ZONE
	//SQL$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$res16=$prdbdata[$tbl][16];// Ëèìèò êîëîíîê
	 global $presettedmode,$categorymode,$m6field,$m6count,$mode,$fields;//äåêîäèðîâàíèå ñòðîêè
	global $selectedfield,$multisearch;	global $categorymode,$mode;
	global $mode6,$m6field,$m6count; // $m6count; - kakogo hera ne peredan
	global $mycols,$mycol,$del,$res16,$presettedmode,$selectedfield;
	global $partquery,$vID,$fields,$multisearch;
	prefixdecode ($res16);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
	$f=$data[4];
		global $mzdata; $mzcnt=count ($mzdata);//$mycol[$md1column]".."
		$mycol=$mzdata; global $mznumb;
$mode6=array ();
decodecols ();
	$mzcnt=count ($mode6);
// end fields names  $mode6[number field]  $mzcnt -max; for this- worked
//  $m6field[number field] - nomera polej dlya otobrajeniya - werna tolxko dlya 1
			echo "DEBUG CSV counter $mzcnt<br>";
//			echo "DEBUG CSV massive 0 elementorig ".$mzdata[0]." selected==".$mode6[0]." selected number ==".$mznumb[0]."<br><br>";
$myrow=array ();$selected=array ();//added
//SQL	$result = dbs_query ($query,$connect,$dbtype);
	// END TEST
for ($aaa=0;$aaa<count ($mode6);$aaa++)	{ $fndcolumn=$mznumb[$aaa];
//echo "mz $mzdata[0]  fnd $fndcolumn<br>";
 $findrecords=0;$prntbuf=cmsg ("RF_RESSRCH")." ".$namebas." - ".cmsg ("BYCOL").$mzdata[$fndcolumn]." -- ".$vID.":\n\n";
  $vIDold=$vID; $vID=strtolower ($vID);
	$data=readdescripters ();	$f=$data[4];
 for ($a=0;$dbc=xfgetcsv ($f,$xfgetlimit,"¦");$a++) {
  $k = count($dbc)-$tablemysqlselect;
   $findid=strpos(strtolower($dbc[$fndcolumn]),$vID);
   $findidorig=strpos(strtolower($dbc[$md2column]),$vID);
   if (($findid!==false)&&($dbc[$fndcolumn]!=="")) {
  if (($dbc[$md2column]==$vID)OR($findidorig!==false)) { echo "</tr>" ;continue ; }  //äîáàâëåíî ÷òîáû ïîâòîðíî íå ïîêàçûâàëñÿ   óëó÷øåíî óäàëÿÿ âñå ñîâïàäåíèÿ
		   $selected[]=$dbc;   //added
   }
 }
 }
  selectedprintcsv ($data,$mycol,$selected);
 }
 //from readfile partends
}

//ìîäóëü çàïóñêà è îáðàáîòêè
if (($write==cmsg("KEY_AN"))AND($prdbdata[$tbl][12]=="fdb")) {
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
// $z to mycol  other $z is dupl and changed to myrow
			$data=readdescripters ();  if ($data==-1) exit;
	while ($myrow=xfgetcsv ($f,$xfgetlimit,"¦")) {	$countquery=$myrow[$md2column];
					settype ($countquery, integer);
						if ($countquery>$maximalcntmd2) $maximalcntmd2=$countquery;
									$maxquery++;}
//	ðàñïå÷àòêà äàííûõ èç äåñêðèïòîðîâ
 echo "<table border=3 width=99% bordercolor=#0000AA ><tr>";
 if ($cfgmod!==1) echo "<td>headerreal</td><td>plevels</td><td>headerrealnumbers</td></tr><tr>";
 if ($cfgmod==1) echo "<td>headervirtual</td><td>plevels</td><td>headerrealnumbers</td></tr><tr>";
	for ($a=0;$a<count ($data[0]);$a++)	{
		for ($b=0;$b<3;$b++) {  echo "<td><bb>$b</bb>:".$data[$b][$a]."</td>";	} echo "</tr><tr>";
	}
echo "</tr></table>";

	echo "<br> ".cmsg ("WF_AN_ALLDAT").": $maxquery, ".cmsg ("WF_LASTW")."$maximalcntmd2<br>";
		@$pl=round (($maximalcntmd2/$maxquery)*100,5);
		if ($pl) echo cmsg ("WF_LDED")." $pl% <br>";
}


if ($write==cmsg ("KEY_AN")) {
        submitkey ("write","WF_UNDO_LAST");//echo "<br>";
	submitkey ("write","WF_MYCANCLIST");//echo "<br>";
	submitkey ("write","WF_CANCMON");//echo "<br>";
	submitkey ("write","WF_CANCDAY");//echo "<br>";
	submitkey ("write","WF_CANCTBL");//echo "<br>";
}

if ($write==cmsg ("WF_UNDO")) {
	$ulog=csvopen ("_logs/undolog.dat","r",1);
	//echo $u0.$u1.$u3;
	while ($dbc=xfgetcsv ($ulog,$xfgetlimit,"¦")){
		@$chto=strpos ($dbc[4],$u3);//AND($chto==true) - ne pashet
		if (($dbc[0]==$u0)AND($dbc[1]==$u1)){  //
			//echo "dbc3=chto=$chto--cmd=".$dbc[3]."---undocmd=".$dbc[4]."<br>";;
			$query=$dbc[4];break;
			}
	}
	echo "==>$query<br>";
	hidekey ("u0",$u0);
	hidekey ("u1",$u1);
	hidekey ("u3",$u3);
	submitkey ("write","KEY_S_UNDO");echo "<br>";
}


if ($write==cmsg ("KEY_S_UNDO")) {
			$ulog=csvopen ("_logs/undolog.dat","r",1);
	//echo $u0.$u1.$u3;
	while ($dbc=xfgetcsv ($ulog,$xfgetlimit,"¦")){
		@$chto=strpos ($dbc[4],$u3);//AND($chto==true) - ne pashet
		if (($dbc[0]==$u0)AND($dbc[1]==$u1)){  //
			//echo "dbc3=chto=$chto--cmd=".$dbc[3]."---undocmd=".$dbc[4]."<br>";;
			$query=$dbc[4];break;
			}
	}
           $query=str_replace ("<cr_lf>","\n",$query);//enabling change \n to <cr_lf>  reroll
           $query=str_replace ("<R>","\r",$query);//enabling change \n to <cr_lf>  reroll
	echo "==>$query<br>";
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	echo "Select db: ".$prdbdata[$tbl][9]."<br>";
	dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	executesql ($query,$connect,1);
	$a=dbserr ();
	if ($a) { lprint (NO_DB_QUE) ;}
	$action="KEY_S_UNDO db:".$prdbdata[$tbl][9]." table=".$prdbdata[$tbl][6]." cannot request data ";logwrite ($action);
}








//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_EDIT"))AND($prdbdata[$tbl][12]=="fdb")) {
	if ($vID==="") { echo cmsg ("WF_FSELID")."<br>"; exit;};

	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");
        if ($cfgmod==1) if (!$pr[8]) echo "DEBUG D encode=$encode system(19)=".$sd[19]."<br>";

//	echo "dEBUG vID2=$vID2 virtualid=$virtualid<br>";
	echo "<br>";
			$data=readdescripters ();  if ($data==-1) exit;
                        $mycolvirtualname=$data[3]; if (strlen ($mycolvirtualname[0])<1) $mycolvirtualname=$mycol;// CFG OPT FUTURE  TODO:
        if ($virtualid=="") $vID2=""; // çàòû÷êà , ò.ê. íàì ïðèñûëàþò âòîðîé èä à îí íàì íå íóæåí âðîäå áû
	$mycol=xfgetcsv ($f,$xfgetlimit,"¦");// $z to mycol  other $z is dupl and changed to myrow
	if ($cfgmod==1) $mycol=$data[0];
		if ($vID2==="") { while ($myrow[$md2column]!==$vID) {
									$myrow=xfgetcsv ($f,$xfgetlimit,"¦");
										if ($myrow===false) { break;};
										};
									};
		if ($vID2!=="") {
			for ($a=0;$myrow=xfgetcsv ($f,$xfgetlimit,"¦");$a++) {
				if ($vID!=="") $findid=strpos ($myrow[$md2column],$vID);
					if ($vID2!=="") $findid2=strpos ($myrow[$virtualid],$vID2);//mod-add for corr if
							if (($myrow[$md2column]===$vID)AND($myrow[$virtualid]===$vID2)) break;
									//$myrow=xfgetcsv ($f,$xfgetlimit,";");
							};
									};

		@$crc=implode ("¦",$myrow);//added crc32 count
		//ïðîâåðêà íå çàíÿò ëè ID
	if ($myrow===false) {
		echo cmsg ("QUE_EMP")."<br>";   // êàêîãî õåðà îíî íåçàíÿòî èç êîíôèãóðàöèè êîãäà ñòîïóäîâî èçâåñòî ÷òî îíî ÇÀÍßÒÎ !
		exit;
	}
//end ïðîâåðêà íå çàíÿò ëè ID
//!!!!!
$oldcoreedit=$prauth[$ADM][39];
$countdatafieldstowrite= count ($mycol);
if ($countdatafieldstowrite>60) $countdatafieldstowrite=60;
if ($oldcoreedit)
		for ($a=0;$a<$countdatafieldstowrite;$a++)
			{
			echo "$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii>(ID1)</ii>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=40 rows=1><?php                         //patch for windows-1251 menu editing in utf-8 mode
                       if ($enablewin32enctooldmenu)  if (($sd[19]=="utf-8")AND($encode=="windows-1251")) $myrow[$a]=iconv("windows-1251","utf-8",$myrow[$a]);
                        echo $myrow[$a]?></textarea><br><?php ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$countdatafieldstowrite;$a++)
			{ //hdr text	//

				if ($prauth[$ADM][41])echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";
		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE  TODO:
		if ($lensa>50) $lensa=50;
			?>
			</td>
			<?php if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?php                         //patch for windows-1251 menu editing in utf-8 mode
                       if ($enablewin32enctooldmenu)  if (($sd[19]=="utf-8")AND($encode=="windows-1251")) $myrow[$a]=iconv("windows-1251","utf-8",$myrow[$a]);
                        echo $myrow[$a]?></textarea><br></td><?php 			//echo "<tr>";//optionalBox,not linear edit.

			} //field text

			echo "</table>";
	}
	//!!!!!!!!!
checkbox ($crcignore,"crcignore"); echo cmsg ("WF_NOCRC")."<br>";
hidekey ("crc",crc32(trim($crc)));
hidekey ("origid1",$myrow[$md2column]);
hidekey ("origid2",$myrow[$virtualid]);
submitkey ("write","KEY_S_EDIT");echo "<br>";
}

//ìîäóëü îáðàáîòêè
if (($write==cmsg("KEY_S_EDIT"))AND($prdbdata[$tbl][12]=="fdb")) {
if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) { @$f=csvopen ("_conf/".$filbas,"r","0");
	if ($codekey==7) demo ();
	}
	echo "<br>";
	// origid1 i origid2  ìîæíî èñïîëüçîâàòü äëÿ ãàðàíòà óäàëåíèÿ èçìåíåííîé çàïèñè.
	$data=readdescripters();
	$mycol=xfgetcsv ($f,$xfgetlimit,"¦");
	$a=0;$cnt=count ($mycol);
			for ($a=0;$a<$cnt;$a++)
			{
	$myrow[$a]=${"z".$a};//ïðèíèìàåì äàííûå þçåðàú
        // âíèìàíèå, èìåííî òóò íàäî îòëàâëèâàòü enter ïðèñëàííûé þçåðîì !!! CFG OPT FUTURE  TODO:
        //patch for windows-1251 menu editing in utf-8 mode   - writing mod
        if ($enablewin32enctooldmenu)  if (($sd[19]=="utf-8")AND($encode=="windows-1251")) { $myrow[$a]=iconv("utf-8","windows-1251",$myrow[$a]); $noenter=1 ;};
    //$x=getidbyid ($prauth,0,"realid",$myrow[0]);// ýòî èìÿ ðåäàêòèðóåìîãî ïîëüçîâàòåëÿ
    $x=getidbyid ($prauth,0,"realid",$myrow[0]);
 //echo "realid=$x prauth x 0 ".$prauth[$x][0]." prauth adm 0 ".$prauth[$ADM][0]."<br>";exit;
//  echo "x2= $x2  x42=$x42";exit;
  if (!$prauth[$ADM][42])  if (($cfgmod==1)and($filbas=="gmdata.cfg")) { $myrow[2]=$prauth[$x][2];$myrow[42]=$prauth[$x][42] ;};
 //çàùèòà íàñòðîåê ïðàâ åñëè íåò ïðàâà ñóïåðïîëüçîâàòåëÿ - öåëüþ ÿâëÿåòñÿ ïðèíóäèòü èñïîëüçîâàòü íàñòðîéêó ïðîôèëåé.
	if ($a===0) { $values="".$myrow[$a];}


	if ($a>0) {$values="".$values."¦".$myrow[$a]; }
if (!$pr[8]) {  echo "DEBUG Decoding incoming data z$a -- $myrow[$a]<br>";}
			}
			if (!$pr[8]) echo $OSTYPE;
		//òìåíåí òê ïðè ñîõðàíåíèè çàãîëîâêà âûçûâàë åãî ñìåùåíèå.

//..if (!$noenter)
    if ($OSTYPE=="LINUX") if ($values[strlen ($values)-1]!=="\n") $values=$values."\n";
		if ($OSTYPE=="WINDOWS")	$values=$values."\n";  // csv linux   bug  pustye stroki

                // //patch for windows-1251 menu editing in utf-8 mode
                //if (($sd[19]=="utf-8")AND($encode=="windows-1251")) $values=iconv("utf-8","windows-1251",$values); FUUUU 1¦¦¦¦¦
// çàìåíåí vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid] ïðîñòî ìåãàçàòû÷êà :)
// à òåïåðü ïîïðàâèëè ìåãàçàòû÷êó áîëåå êîððåêòíî  md2- oridid1  virid - orig2
//echo "Starting executing query <br>";// ýòà ñòðîêà âîîáùå íå âèäíà ïðè gmdata ili dbdata   vidimo 200 polej - mnogo
csvmod ($f,"edit",$values,$origid1,$origid2);
lprint ("WF_QUECOMP");
if ($pr[12]) {$act="EDIT_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // ëîãèðóåìñÿ
submitkey ("write","WF_UNDO_LAST");
}



//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_ADD"))AND($prdbdata[$tbl][12]=="fdb")) {
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
	$data=readdescripters ();  if ($data==-1) exit;
		$mycolvirtualname=$data[3]; if (strlen ($mycolvirtualname[0])<1) $mycolvirtualname=$mycol;
                ////ïîäñ÷åòà ïóñòîé ÿ÷åéêè

		while ($myrow=xfgetcsv ($f,$xfgetlimit,"¦")) {	$countquery=$myrow[$md2column];
					settype ($countquery, integer);
						if ($countquery>$maximalcntmd2) $maximalcntmd2=$countquery;
									$maxquery++;}
		echo cmsg ("WF_1NOTUSED").":".($maximalcntmd2+1)."<br>";  // ýòî â àâòîìàò äîáàâëÿòü.    CFG OPT îòêë.
		rewind ($f);		//	erase&rewind :) ïåðåìîòàòü $F!!!
		//êîíåö çàâåðøåíèÿ ïîäñ÷åòà ïóñòîé ÿ÷åéêè
	$mycol=xfgetcsv ($f,$xfgetlimit,"¦");
        	if ($cfgmod==1) $mycol=$data[0];// ÷òåíèå çàãîëîâêîâ ïðàâèëüíî !!! â íóæíîé êîäèðîâêå!!!
                $cnt=count ($mycol);
		if ($vID2==="") { while ($myrow[$md2column]!==$vID) {
									$myrow=xfgetcsv ($f,$xfgetlimit,"¦");
											if ($myrow===false) { break;};
									};
									};
		if ($vID2!=="") {
			for ($a=0;$myrow=xfgetcsv ($f,$xfgetlimit,"¦");$a++) {
				if ($vID!=="") $findid=strpos ($myrow[$md2column],$vID);
					if ($vID2!=="") $findid2=strpos ($myrow[$virtualid],$vID2);//mod - add for corr
					if (($myrow[$md2column]===$vID)AND($myrow[$virtualid]===$vID2)) break;
							};
									};
		$a=0;
		//ïðîâåðêà íå çàíÿò ëè ID
	if ($myrow===false) {
		echo cmsg ("QUE_EMP")."<br>";
		$myrow[$md2column]=$vID;
		if (($virtualid>0)AND ($vID2!=="")) $myrow[$virtualid]=$vID2;
	}
//end ïðîâåðêà íå çàíÿò ëè ID
$oldcoreedit=$prauth[$ADM][39];
if ($oldcoreedit)
	for ($a=0;$a<$cnt;$a++)
			{
			echo "$mycolvirtualname[$a]";
			if ($mycol[$md2column]===$mycol[$a]) {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=30 rows=1><?php                         //patch for windows-1251 menu editing in utf-8 mode
                        if ($enablewin32enctooldmenu) if (($sd[19]=="utf-8")AND($encode=="windows-1251")) $myrow[$a]=iconv("windows-1251","utf-8",$myrow[$a]);
                        echo $myrow[$a]; ?></textarea><br><?php ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=0% bordercolor=#602621>"; // íåïîíÿòíîå èçìåíåíèå . 100% áûëî çàìåíåíî íà 0 .öåëü íåÿñíà.
			for ($a=0;$a<count ($mycol);$a++)
			{ //hdr text	//
				if ($prauth[$ADM][41])echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycolvirtualname[$a] ";// ïåðåâåñòè
			if ($mycol[$md2column]===$mycol[$a])  {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";
		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE  TODO:
		if ($lensa>50) $lensa=50;
			?>
			</td>
			<?php if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?php                         //patch for windows-1251 menu editing in utf-8 mode
                        if ($enablewin32enctooldmenu) if (($sd[19]=="utf-8")AND($encode=="windows-1251")) $myrow[$a]=iconv("windows-1251","utf-8",$myrow[$a]);
                        echo $myrow[$a]?></textarea><br></td><?php 			//echo "<tr>";//optionalBox,not linear edit.

			} //field text

			echo "</table>";
	}
 submitkey ("write","KEY_S_ADD");
 echo "<br>";
}


//ìîäóëü îáðàáîòêè
if (($write==cmsg ("KEY_S_ADD"))AND($prdbdata[$tbl][12]=="fdb")) {
		if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) { @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
		if ($codekey==7) demo ();
		if ($filbas=="gmdata.cfg") if (($codekey==5)OR($codekey==9)) {
			print cmsg ("WF_NONEWUSR")."<br>";exit;};
		if ($filbas=="dbdata.cfg") if (($codekey==5)OR($codekey==9)OR($codekey==3)) {
			print cmsg ("WF_NONEWDB")."<br>";exit;};
			};
	$data=readdescripters();
	$mycol=xfgetcsv ($f,$xfgetlimit,"¦");
	$a=0;$cnt=count ($mycol);
			for ($a=0;$a<$cnt;$a++)
			{
	$myrow[$a]=${"z".$a};//ïðèíèìàåì äàííûå þçåðà
        //patch for windows-1251 menu editing in utf-8 mode   - writing mod
        if ($enablewin32enctooldmenu)  if (($sd[19]=="utf-8")AND($encode=="windows-1251")) { $myrow[$a]=iconv("utf-8","windows-1251",$myrow[$a]); $noenter=1 ;};
	if ($a===0) { $values="".$myrow[$a];}
	if ($a>0) {$values="".$values."¦".$myrow[$a]; }
if (!$pr[8]) {  echo "DEBUG Decoding incoming data z$a -- $z[$a]<br>";}
			}
if ($OSTYPE=="LINUX") if ($values[strlen ($values)-1]!=="\n") $values=$values."\n";
			if ($OSTYPE=="WINDOWS")	$values=$values."\n";

	csvmod ($f,"add",$values,$myrow[$md2column],$myrow[$virtualid]);
	lprint ("WF_QUECOMP");
	if ($pr[12]) {$act="ADD_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // ëîãèðóåìñÿ
        submitkey ("write","WF_UNDO_LAST");
}



//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_DEL"))AND($prdbdata[$tbl][12]=="fdb")) {
		if (($virtualid==true)AND($vID2==false)) echo "<red>".cmsg
		("WF_DEL_GROUP")." ".$vID." </red><br>";
		if ($vID==="") { echo cmsg ("WF_FSELID")."<br>"; exit;};

 submitkey ("write","KEY_S_DEL");
}

//ìîäóëü îáðàáîòêè
if (($write==cmsg ("KEY_S_DEL"))AND($prdbdata[$tbl][12]=="fdb")) {
		if ($codekey==7) demo ();
		if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) {
		@$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
		if ($filbas=="gmdata.cfg") {
			$a=testadmin ($prauth,$vID);
			if ($a==1) {print cmsg ("WF_NODELADM")."<br>";exit;};};

	}
		$data=readdescripters ();  if ($data==-1) exit;
csvmod ($f,"del",$values,$vID,$vID2);
lprint ("WF_QUECOMP");
undolog ($act,$undodata,$tbl,"");
if ($pr[12]) {$act="DEL_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;	};  // ëîãèðóåìñÿ
submitkey ("write","WF_UNDO_LAST");
}


//ìîäóëü çàïóñêà  ìàññîâàÿ çàìåíà òåêñòîâûé ðåæèì
if (($write==cmsg ("KEY_MASEXC"))AND($prdbdata[$tbl][12]=="fdb")) {
	$nofilestreamallowed=1;// äëÿ readdesdcripters åñëè åñòü ÷òîáû óáèâàë ñâîé ëèíê
		echo cmsg ("WF_SELFLD").":";// Âñòàâëåíî äëÿ âûáîðà ïîëÿ
	global $presettedmode,$res16,$mznumb;
        //global $addifcmp1,$addif1;//test line
	$nofilestreamallowed=1;
	$data=readdescripters ();$a=prefixdecode ($res16);
	$mznumb=$data[2]; $mzdata=$data[0];$plevels=$data[1];
  if ($data==-1) exit;
   decodecols ($res16);
 printfield ($data,"nfield"); echo "<br>";
 echo lprint ("WF_SRCID"); ?>  <textarea name=sourceid cols= 30 rows=1 ><?=$sourceid; ?></textarea> <?=lprint ("WF_EMPTY"); ?> <br>
	<?=lprint ("WF_EXCHID"); ?> <textarea name=exchid cols= 30 rows=1 ><?=$exchid; ?></textarea> <br>
	<?// checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
   checkbox ($wfemptyenab,"wfemptyenab") ;echo cmsg ("WF_EMP_EN")."<br>";
 if ($prauth[$ADM][5]==1) { checkbox ($delete,"delete");echo "<red>".cmsg ("WF_UPDTODEL")."</red><br>"; };
radio ("strupdmode","allstrokes","WF_EXCALL"); echo "<br>";
 radio ("strupdmode","#substrokes","WF_EXCSUB"); echo "<br>"; // select ignored ???? WTF?
  radio ("strupdmode","subindstrokes","WF_EXCSUBIND") ; //echo "<br>";
  ?><textarea name=subindex cols= 5 rows=1 ><?=$subindex; ?></textarea>,<?php lprint ("WF_EXCSPLT") ; ?> ,<textarea name=subsplitter cols= 4 rows=1 ><?=$subsplitter; ?></textarea><br>
 <?php   // start compare addif
checkboxcorrect ("addifenable1",$addifenable1) ;
	echo "**".cmsg ("WF_IF")."1 :"; printfield ($data,"naddif1");
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?php checkboxcorrect ("addifenable2",$addifenable2) ;
	echo "**".cmsg ("WF_IF")."2 :"; printfield ($data,"naddif2");
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
		<?php 	// end compare addif   Âñòàâëåíî äëÿ âûáîðà ïîëÿ
	echo "<br>".cmsg ("WF_DUPL")."<br>";
	if (strlen ($vID2)!==0) echo cmsg ("WF_ID2HLP")."<br>";
submitkey ("write","KEY_S_EXCH");
}

//ìîäóëü îáðàáîòêè
//ìàññîâàÿ çàìåíà òåêñòîâûé ðåæèì
if (($write==cmsg ("KEY_S_EXCH"))AND($prdbdata[$tbl][12]=="fdb")) { //FIX IT!s
	$nofilestreamallowed=1;// äëÿ readdesdcripters åñëè åñòü ÷òîáû óáèâàë ñâîé ëèíê
	// ïîëó÷åííûå äàííûå:
	//field - íîìåð ïîëÿ\êîëîíêè
	//strupdmode - ðåæèì ðàáîòû allstrokes, substrokes,subindstrokes
	//nolimit
	//addifenable1 ðàçðåøåíèå ïåðâîãî äîï óñëîâèÿ addif1 - ïîëå óñëîâèÿ  UNSUPPORTED
	//addifenable2 ðàçðåøåíèå äîï óñëîâèÿ addif2 - ïîëå óñëîâèÿ UNSUPPORTED
	//addifcmp1,2 çíàêè â ïîðÿäêå î÷åðåäíîñòè = != >> <<   IGNORED!!! UNSUPPORTED
	//addiflist1,2  ñïèñîê çíà÷åíèé,êîòîðûå ìîæíî ñðàâíèâàòü, íå ðàá â << >> åñëè áîëåå 1 PARTIAL UNSUPPORTED
	//sourceid   èñõîäíèê,   exchid - êîíå÷íûé ðåçóëüòàò
if (!$cfgmod) $filename="_data/".$filbas;
if ($cfgmod==1) $filename="_conf/".$filbas;
if ($cfgmod==2) $filename="_logs/".$filbas;
// $wfemptyenab
	 if (($codekey==4)) needupgrade ();	 if (($codekey==9)OR($codekey==7)) demo ();
	if ($nolimit) {set_time_limit(0);} else {set_time_limit(120) ;};
	if (($prauth[$ADM][5]==false)AND($delete)) { unset ($delete); echo "r";};// ñáðîñ îò íåëåãàëüíûõ delete
	if (!$strupdmode) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>Íå óêàçàí ðåæèì ðàáîòû!";exit;};
	if (strlen ($exchid)==0) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>Íå óêàçàíà öåëü çàìåíû!";exit;};
	if (!$wfemptyenab) if (($strupdmode=="substrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>Îãðàíè÷åíèå</bb><br></red>".cmsg ("WF_ER_NOSUB"); exit;} ;
	if ($strupdmode==="subindstrokes") {
		if (!$subindex) { echo "<red><bb>Îøèáêà</bb><br></red>".cmsg ("WF_ER_NOIND").".<br>" ;exit ; };
		if (!$subsplitter) { echo "<red><bb>Îøèáêà</bb><br></red>".cmsg ("WF_ER_SPLIT").".<br>" ;
		} ; exit; };
	if (($prauth[$ADM][4]===false)AND($strupdmode!=="substrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>Îãðàíè÷åíèå</bb><br></red>Íåëüçÿ çàìåíÿòü ëþáîå çíà÷åíèå íà íóæíîå âàì èç ïðèíöèïîâ áåçîïàñíîñòè." ; exit;} ;// all_> sub
	//îêîí÷àíèå îáðàáîòêè îøèáîê    	//	íà÷àëî csv ÷àñòè îáíîâèòåëÿ  ===!!!!======
	@$f=csvopen ($filename,"r","0");//îòêðûâàåì áàçó
	echo "<br>";
	$hdr=xfgetcsv ($f,$xfgetlimit,"¦"); // ïðîïóñêàåì çàãîëîâêè,ò.ê. èõ ïåðåìîòàëà ïðîãðàììà ÷òåíèÿ
	$mycol=$hdr;
	$plvl=xfgetcsv ($f,$xfgetlimit,"¦");
	$tbld=array ();
	$cnt=0; //$b[0]=0;
	$sampletotest1=explode (",",$addiflist1);
	$sampletotest2=explode (",",$addiflist2);
	echo "DEBUG Runned mode= $strupdmode<br>";
	while (!feof($f))
		{	// çäåñü ñóäÿ ïî âñåìó èäåò ðàçáèòèå ïî ñòðîêàì îðèãèíàëüíîãî ìàññèâà.
		$tbldorig[$cnt]=fgets ($f); $tbld[$cnt]=explode ("¦",$tbldorig[$cnt]);
		// - çíà÷åíèå âçÿòîå èç ôàéëà        çíà÷åíèÿ ðàçáèòûå ïî êîëîíêàì - ò.å.èíäåêñ ñòðîêè+åùå èíäåêñ êîëîíêè
//ïðîãðàììà äëÿ ñðàâíåíèÿ äîïîëíèòåëüíûõ óñëîâèé
 if ($addifenable1) {
    $datatotest=$tbld[$cnt][$addif1];// áåç N
	$addifgrants1=granttest ($datatotest,$addiflist1,$addifcmp1);
 }
 if ($addifenable2) {
    $datatotest=$tbld[$cnt][$addif2];// òåîð.ìîæíî ëþáîå ÷èñëî ïîëåé äëÿ ñðàâíåíèÿ.â
	$addifgrants2=granttest ($datatotest,$addiflist2,$addifcmp2);
 	};

 	 // ôóíêöèÿ âîçâðàùàåò ñîîòâåòñòâèå óñëîâèþ   $datatotest - äàííûå äëÿ ïðîâåðêè, list - ñïèñîê îáðàçöîâ cmp- ìåòîä ñðàâ
 	 if (($wfemptyenab)AND($sourceid=="")) { $nulldataen=1;$sourceid="NULL";}//îáåñïå÷åíèå "ïóñòîãî óñëîâèÿ" if ($cnt>1)
	if ($strupdmode=="substrokes") if ((strpos ($tbld[$cnt][$field],$sourceid)!==false)OR($nulldataen==true)) {
							$select=$cnt;//echo "Çíà÷åíèå çàìåíåíî.<br>"; //$tbld[$cnt]=$z;
							$replid=$tbld[$cnt][$field];$oldreplid=$replid;
	//						echo "BUGGED!?  DEBUG replid=$replid=str_replace (src=$sourceid, exch=$exchid,replid=$replid);";
							$replid=str_replace ($sourceid, $exchid,$replid);
							if ($wfemptyenab) $replid=$exchid;
							//ñäåëàòü ìèíè ôóíêöèþ äëÿ ïðîâåðêè ñ ïàðàì addifgranttest ()
							if (($addifenable1)AND($addifgrants1===false)) {$replid=$oldreplid;$findrecords--; };
							if (($addifenable2)AND($addifgrants2===false)) {$replid=$oldreplid;$findrecords--; };
							$tbld[$cnt][$field]=$replid;
							if ($delete) $tbld[$cnt][$field]="_DELETE_IS_REQUIRED!!!";
							$tbldorig[$cnt]=implode ("¦",$tbld[$cnt]); //çàì íà values
							$findrecords++;
							if (!$pr[8]) {echo "DEBUG Selected data - ".$tbld[$cnt][0]." must changed to $replid ($values)<br>";}
							//echo "AFTERborigcnt ".$tbldorig[$cnt]." CONTAIN MUST EXCHANGED TO! ex $exchid<br>";//LOG
							}

		if ($strupdmode=="allstrokes") { if (($tbld[$cnt][$field]==$sourceid)OR($nulldataen==true)) {
							$select=$cnt;//echo "Çíà÷åíèå çàìåíåíî.<br>"; //$tbld[$cnt]=$z;
							$replid=$tbld[$cnt][$field];$oldreplid=$replid;
			//				echo "BUGGED!?  DEBUG replid=$replid=str_replace (src=$sourceid, exch=$exchid,replid=$replid);";
							$replid=str_replace ($sourceid, $exchid,$replid);
							if ($wfemptyenab) $replid=$exchid;
							if (($addifenable1)AND($addifgrants1===false)) {$replid=$oldreplid;$findrecords--; };
							if (($addifenable2)AND($addifgrants2===false)) {$replid=$oldreplid;$findrecords--; };
							$tbld[$cnt][$field]=$replid;
							if ($delete) $tbld[$cnt][$field]="_DELETE_IS_REQUIRED!!!";
							$tbldorig[$cnt]=implode ("¦",$tbld[$cnt]); //çàì íà values
							$findrecords++;
							if (!$pr[8]) {echo "DEBUG Selected data - ".$tbld[$cnt][0]." must changed to $replid ($values)<br>";}
							//echo "AFTERborigcnt ".$tbldorig[$cnt]." CONTAIN MUST EXCHANGED TO! ex $exchid<br>";//LOG
							 };
}
	if ($strupdmode=="subindstrokes") if (strpos ($tbld[$cnt][$field],$sourceid)!==false) {
							$select=$cnt;//echo "Çíà÷åíèå çàìåíåíî.<br>"; //$tbld[$cnt]=$z;
							$data=$tbld[$cnt][$field];$oldreplid=$data;$guided=$tbld[$cnt][$md2column];
	$replid=$dataexp;
	echo $tbld[$cnt][0]." -- ".$tbld[$cnt][$field]." -- ".$field." <br>";
		$dataexp=explode ($subsplitter,$data); // subindex
		if ($dataexp[$subindex]==$sourceid) {
//echo "Dataexp - $dataexp ;; dataexp index ".$dataexp[$subindex]." ;; index  $subindex;  source $sourceid; exh $exchid<br>";
				$dataexp[$subindex]=$exchid;
			$replid=implode ($subsplitter,$dataexp);
			//$replid=str_replace ($sourceid, $exchid,$replid);// replid ýòî ìàññèâ êîòîðûé íóæä â èçìåíåíèè
		}
							if (($addifenable1)AND($addifgrants1===false)) {$replid=$oldreplid;$findrecords--; };
							if (($addifenable2)AND($addifgrants2===false)) {$replid=$oldreplid;$findrecords--; };

							$tbld[$cnt][$field]=$replid;
							if ($delete) $tbld[$cnt][$field]="_DELETE_IS_REQUIRED!!!";
							$tbldorig[$cnt]=implode (";",$tbld[$cnt]); //çàì íà values
							$findrecords++;
							if (!$pr[8]) {echo "DEBUG Selected data - ".$tbld[$cnt][0]." must changed to $replid ($values)<br>";}
							//echo "AFTERborigcnt ".$tbldorig[$cnt]." CONTAIN MUST EXCHANGED TO! ex $exchid<br>";//LOG
							}
		$cnt++;
		}
// $tbld - ìàññèâ ñîäåðæàùèé âñå êîíå÷íûå äàííûå - äîëæåíáûòü îáÿçàòåëüíî èñïîëüçîâàí è êîíâåðòèðîâàí
echo "<br>Çàìåíåíî âñåãî çíà÷åíèé : $findrecords<br><br>";
		//	$select=0;//added for compactibility
	$cntdb=$cnt+1;
	if ($select===false) { echo "__SELECT_ERROR";exit;};
// ïðîöåäóðà ïîëó÷àåò ñâåäåíèÿ èç á\ä è ñîçäàåò âíóòðåííþþ áîëüøóþ ïåðåìåííóþ
// â íåé çàðàíåå çàìåíÿåòñÿ íóæíîå çíà÷åíèå â îáîèõ ñëó÷àÿõ
// ãîòîâèìñÿ ê çàïèñè//_WRITE213.85.55.251

	fclose ($f);

	//..$dest=csvopen ($filename.".exch","w",1);4/1/77
        $dest=csvopen ($filename,"w",1);
	//character linux delete fail
  if ($OSTYPE=="WINDOWS") $hdr=implode ($hdr,"¦")."\r\n"; //win32 enter not unix
if ($OSTYPE=="WINDOWS") $plvl=implode ($plvl,"¦")."\r\n";
if ($OSTYPE=="LINUX") $hdr=implode ($hdr,"¦");
if ($OSTYPE=="LINUX") $plvl=implode ($plvl,"¦");
    fwrite ($dest,$hdr);
  fwrite ($dest,$plvl);
  for ($a=0;$myrow=$tbldorig[$a];$a++) {
  		if (($delete)AND(strpos ($myrow,"_DELETE_IS_REQUIRED!!!"))) { echo "Ñòðîêà $a óäàëÿåòñÿ!"; continue;}
  		$writedata=$myrow;//$writedata=implode ($myrow,"¦")."\r\n";
		fwrite ($dest,$writedata);
	}
fclose ($dest);
//exit;//LINUX FAILURE WRITING BUG
		//$f=csvopen ($filename,"backup",0);
	/*	for ($a=0;$a<5;$a++)	{ echo "";			}//áåç ðàçíèöû  äàæå åñëè òûùó ðàç ïîâòîðèò âñå ðàâíî íè.... íå óäàëÿåò.

		//@$del=unlink ($filename);  //êàê ìåíÿ çàòðàõàëî ýòî permission denied ERROR!BUG!  ÂÀØÓ ÌÀÒÜ ÁËÈÍ!
		$realp=realpath ($filename);
		//$del=unlink ($realp);  //êàê ìåíÿ çàòðàõàëî ýòî permission denied ERROR!BUG! ÏÎÒÐÀ×ÅÍÎ ÍÀ ÝÒÎ ÍÅÑÊÎËÜÊÎ ÍÅÄÅËÜ !!!
		//echo "try realpath $filename is =$realp; ";
                //fclose ($f) ;
                echo "Real path for file:$realp<br>"; // íåëüçÿ ïðîñòî òàê óäàëÿòü ôàéë - èìåííî ýòî âûçûâàåò åãî ñîçäàíèå ïðè âêë ãëîáàëüíîñòè (ïð34)
		//$e=csvopen ($filename,"delete",0);		 // ØÎÁ ÒÂÎÞ ÌÀÒÜ INITSE áëîêèðîâàë!!!!

                //echo"[debug]deleting $filename code return=$e<br>";
                //$e=unlink ($filename) ;
                //echo"[debug]deleting2 $filename  code return=$e<br>";
		$e=csvopen ($filename.".exch","rename",$realp); // åøü
                echo"[debug]ren $filename.exch code return=$e<br>";
		//echo "csvopen ($filename.exch,rename,$filename);	";
		//$f=csvopen ("_conf/dbdata.cfg.exch","rename","_conf/dbdata.cfg");
		if ($del==true) break;
         *
         */


	if ($pr[12]) {$act="MASS_EXCH_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // ëîãèðóåìñÿ
}


//ìîäóëü çàïóñêà è îáðàáîòêè
if (($write==cmsg("KEY_MASCPY"))AND($prdbdata[$tbl][12]=="fdb")) {

	 if (($codekey==9)OR($codekey==7)) demo ();
	if ($cfgmod==1) { lprint ("CFG_LIM"); exit;};

	lprint ("WF_MASCPYMSG");// Âñòàâëåíî äëÿ âûáîðà ïîëÿ
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a; êîïèÿ ìîäóëÿ èç íà÷àëà writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,0,0);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"destination",cmsg ("WF_MAS_DEST"),$groupdb,0,0);
	//êîíåö âûáîðà êîëîíêè èç òåêóùåé áàçû
// äîëæíû èñïîëüçîâàüñÿ òîëüêî FDB òàáëèöû.
 ?><br><input type= hidden name=go value=Ïåðåõîä_êîïèðîâàíèå>
 <?php   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
  if ($prauth[$ADM][5]==1) echo ""; // ðåçåðâ äëÿ óäàëåíèÿ
 lprint ("WF_MASCPYACT") ; ?> <br>
  <input type="radio" name="cpymod" value="copyabort"> <?php lprint ("ABORT") ; ?>
  <input type="radio" name="cpymod"  value="copyrewrite"> <?php lprint ("REWRITE") ; ?>
  <input type="radio" name="cpymod"  value="copyignore"> <?php lprint ("IGNORE") ; ?><br>
 <?php 	// start compare addif
echo cmsg ("WF_MASCPYIFHLP")."<br> ";
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1");
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 wrap=virtual><?=$addiflist1; ?></textarea><br>
<?php checkboxcorrect ("addifenable2",$addifenable2) ;
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2");
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 wrap=virtual><?=$addiflist2; ?></textarea><br>
	<?php         lprint ("NO_PROC") ;
        needupdate ();
        if (($codekey==4)) needupgrade ();
        submitkey ("write","KEY_S_COPY");
}

// ïîêà ïðîöåäóðà îáðàáîòêè íå ãîòîâà

//ìîäóëü çàïóñêà
//ñäåëàòü âîçìîæíî îäíîâðåìåííóþ èëè ðàçäåëüíóþ ïðàâêè?
//SQL HEADER
if (($write==cmsg("KEY_HEAD"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	 	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
 if ($data==-1) exit;
	 echo "<br>".cmsg ("WF_HDSEL")."<br>";
	 //echo "*"; submitkey ("write","WF_HDRSQL_REAL"); REMOVED  NOT USED
 	 submitkey ("write","WF_HDRSQL_VIRT");
 	 submitkey ("write","WF_STRC_SQL");
 	 submitkey ("write","WF_STRC_DAT");echo "<br><br>";
 	 submitkey ("write","CFG_COPY");submitkey ("write","WF_NEW_TAB");
         submitkey ("write","WF_SHOW_TAB_CRT");

}


//ìîäóëü çàïóñêà
//ñäåëàòü âîçìîæíî îäíîâðåìåííóþ èëè ðàçäåëüíóþ ïðàâêè?
if (($write==cmsg("BACKUPS"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	 infrestsql($connect,$prdbdata,$tbl);

	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
 if ($data==-1) exit;
 lprint(WF_AR_TAB);echo "<br>";
	  submitkey ("write","WF_ARCH");
	 submitkey ("write","WF_UNARCH");echo "<br>";
	 echo "<br>"	 	  ;lprint (WF_AR_OTH);echo "<br>";
	 checkbox (1,"addname");lprint ("ADD_NAME");
	 checkbox (1,"adddata");lprint ("ADD_DATA");
	 checkbox ($addtxt,"addtxt");lprint ("WRIT_NM");inputtxt("txtfordb",10);

	 echo "<br>IP:";inputtxt("remoteip",10); submitkey ("write","WF_BCK_TRANS");echo "**";
	 echo "<br>";
	 submitkey ("write","WF_BCK_ARCH");
	 submitkey ("write","WF_BCK_UNARCH");echo "";
	 echo "<br><br>";
         //..checkbox (0,"onetable"); lprint ("");
       //printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("DUMP1TABLE"),$groupdb,$ipfilter,6);
//         echo "<br>";
	  	  submitkey ("write","WF_BCK_FILEDUMP_ARCH");
  	 submitkey ("write","WF_BCK_FILEDUMP_UNARCH");echo "<br>";  //RESTORE FROM DUMP!!!
	 echo "<br><br>";
	  	  //submitkey ("write","WF_BCK_COPYTBL_ARCH");
	 //submitkey ("write","WF_BCK_COPYTBL_UNARCH");echo "** UNRELEASED<br>";
	 	 echo "<input type=hidden name=colfind value=1>";
}




// RESTORING FROM SAVED DATABASE IN OTHER DATABASE&&**
if (($write==cmsg("WF_BCK_UNARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
lprint (W_BCK_UNARCH_TIP);
$separator="¦";lprint ("GEN_DB_SEL");
$cmd="SHOW DATABASES";
$a=dbs_query ($cmd,$connect,$dbtype);;
if ($a==false) echo "connection die";
echo "<br>Source:<select name=source>";
while ($result=dbs_fetch_row ($a,$dbtype)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
	if (strpos ($result[0],"backup")!==FALSE) echo "<option>".$result[0]."";
}
echo "</select>";
echo"<br>Target:";$a=dbs_query ($cmd,$connect,$dbtype);;
if ($a==false) echo "connection die";
echo "<select name=dest>";
while ($result=dbs_fetch_row ($a,$dbtype)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
	echo "<option>".$result[0]."";
}
echo "</select><br> Or new name:";
 echo"";inputtxt ("newdb",10);echo "<br>";
hidekey("write","WF_BCK_UNARCH");
lprint ("REQ_TIME");
 submitkey ("start","DALEE");
}
// RESTORING FROM SAVED DATABASE IN OTHER DATABASE<br>

if ($write=="WF_BCK_UNARCH") {
	echo "Server:".$prdbdata[$tbl][6]." (autodetect)<br>";
	echo "Restoring from -live- backup <br>";
set_time_limit(0);// CFG OPT FUTURE  TODO:?
//echo $sd[14].$sd[17];
$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
if ($newdb) $dest=$newdb;
	copydatabase ($source,$dest,$connect);
	$action="WF_BCK_UNARCH ".$source.".".$dest.".".$connect." ";logwrite ($action);
}



// Çàïóñêíîé ìîäóëü ñîçäàíèÿ áýêàïà
if (($write==cmsg("WF_BCK_ARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$backupdbname="backup"; // backup+DATABASEname-opt+data-opt+text-opt;
	if ($addname) $backupdbname.=$prdbdata[$tbl][9]."_";
	if ($adddata) $backupdbname.=date ("dmY")."_";
	if ($addtxt) $backupdbname.=$txtfordb;
	hidekey ("backupdbname",$backupdbname);
	hidekey ("dbname",$prdbdata[$tbl][9]);

echo cmsg (BCK_CRT_ALL)." ".$prdbdata[$tbl][9]." ".cmsg (W_NM)." :".$backupdbname."<br>";
lprint ("REQ_TIME");
submitkey ("start","START");
}


// ìîäóëü ñîçäàíèÿ æèâîãî áýêàïà
//CREATING DUMP AT SQL SIDE AS COPY SQL DATABASE
if (($start)AND($backupdbname)AND ($prdbdata[$tbl][12]!="fdb")) {echo "Ñîçäàåòñÿ -æèâîé- áýêàï $backupdbname...<br>";
set_time_limit(0);// CFG OPT FUTURE  TODO:?
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	copydatabase ($prdbdata[$tbl][9],$backupdbname,$connect);
 $action="DB_COPY ".$prdbdata[$tbl][9].".".$backupdbname.".".$connect." ";logwrite ($action);
}

//copy full tables   êîïèðîâàíèå ïîëíûé òàáëèö
//#########################################################################
/// /CREATING DUMP AND EXECUTING AT REMOTE SERVER   NA - NOT USED TMP
if (($write==cmsg("WF_BCK_TRANS"))AND ($prdbdata[$tbl][12]!="fdb")) {
	@$connect2 = dbs_connect ($mysqlserver2,$sd[14],$sd[17],$dbtype);
	 set_time_limit(0);// CFG OPT FUTURE  TODO:?
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$dumpdbname="backup"; // backup+DATABASEname-opt+data-opt+text-opts;
	if ($addname) $dumpdbname.=$prdbdata[$tbl][9]."_";
	if ($adddata) $dumpdbname.=date ("dmY")."_";
	if ($addtxt) $dumpdbname.=$txtfordb;
	hidekey ("dumpdbname",$dumpdbname);
	hidekey ("dbname",$prdbdata[$tbl][9]);

echo cmsg ("BCK_CRT_ALL").$prdbdata[$tbl][9].cmsg ("W_NM")."<br>";
echo "Dbscript side:/_local/dump/".$dumpdbname;
 // - íå ðàáîòàåò !!?? Fatal error: Maximum execution time of 60 seconds exceeded in /media/E/KERNEL/dbs/dbscore.lib  on line 4107
if ($pr[20]) lprint ("BLOCK_CF");
echo"<br>";
echo "SQL side:".$pr[39].$dumpdbname."<br>";
lprint ("REQ_TIME");
echo "<br>";

if (!$pr[20])checkbox ($structure,"structure");lprint ("DUMP_STR");echo "<br>";
checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
//submitkey ("start","START");
submitkey ("start","SQL_REM_START");
}

//TRANSPORT TO ANOTHER SQL SERVER??
//CREATING DUMP AT DBSCRIPT SIDE AS ONE SQL FILE
if (($start==cmsg ("SQL_REM_START"))AND($dumpdbname)AND ($prdbdata[$tbl][12]!="fdb")AND(!$pr[20])) {
	@$connect2 = dbs_connect ($mysqlserver2,$sd[14],$sd[17],$dbtype);
         //echo "bldjad";die ();
	set_time_limit(0);
        echo cmsg (W_CRT_DMP)." $backupdbname...<br>";
	echo "Ðåæèì: Dbscript side, data";
	if ($structure) echo "+structure";
	echo "<br>";
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$query="CREATE DATABASE IF NOT EXISTS `$backupdbname`;";
	$silent=0;dbs_query ($query,$connect,$dbtype);
	//generate table list
	echo "connecting..".$prdbdata[$tbl][9]."<br>";
	dbs_selectdb ($prdbdata[$tbl][9],$connect,$dbtype);
$cmd="SHOW TABLES";
$a=dbs_query ($cmd,$connect,$dbtype);;

while ($result=dbs_fetch_row ($a,$dbtype)) {
	$tablelist[]=$result[0];$tables++;//echo "table added to list ::".$result[0]."<br>";
	}
	@$a=opendir ("_local/dump"); if ($a==false) mkdir ("_local/dump");@closedir ($a);
	$dumpfile=fopen ("_local/dump/".$dumpdbname,"w"); if ($dumpfile==false) die ("cannot open file $dumpdbname");
	$x="#::Dbscript $verchar ::  Mysql dump \n\r";
        // òóò ìû ãäå òî ïîòåðÿëè encodng
	fwrite ($dumpfile,$x);
for ($a=0;$a<count ($tablelist);$a++) {

	$x="#table `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`\n";if ($OSTYPE=="WINDOWS") $x.="\r";
	echo $x."<br>";
	fwrite ($dumpfile,$x);
	ob_flush ();
	$x="CREATE DATABASE IF NOT EXISTS `".$prdbdata[$tbl][9]."`;\n";if ($OSTYPE=="WINDOWS") $x.="\r";
	fwrite ($dumpfile,$x);
    $x="USE `".$prdbdata[$tbl][9]."`;\n";if ($OSTYPE=="WINDOWS") $x.="\r";
	fwrite ($dumpfile,$x);

	if ($structure) { //if ($debugmode)	echo "DEBUG $query.<br>";
		$query="SHOW CREATE TABLE `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;"; //OPT STRUCTURE
		$result=dbs_query ($query,$connect,$dbtype); sqlerr();
	for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
    	$insertone=$myrow[1].";";
    	//if ($views) echo $insertone;
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
                                        $x=detectencoding($insertone);   if ($views)   echo "Encoded str: ".$x."<br>?";  //dobawil utf-8  êàêàÿ òî ëåâàÿ ïðîöåäóðà. die () íå ðàáîòàåò
                              if (($x!=="utf-8")AND($sd[19]=="utf-8")) $insertone=iconvx("windows-1251","utf-8",$insertone);
		fwrite ($dumpfile,$insertone);
		$strclines++;		//echo $insertone."<br>";
	};

	}

	//if ($debugmode)	echo "DEBUG $query.<br>";
	$query="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;";
	$result=dbs_query ($query,$connect,$dbtype); sqlerr();
// ïå÷àòü   ôîðìèðîâàíèå òåêñòà çàïðîñà
	for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
    	$mycols=count ($myrow);
		$insertone=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols,"");
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
                        $x=detectencoding($insertone);    if ($views) echo "Encoded ln : ".$x."<br>?";  //dobawil utf-8  êàêàÿ òî ëåâàÿ ïðîöåäóðà. die () íå ðàáîòàåò
                              if (($x!=="utf-8")AND($sd[19]=="utf-8")) $insertone=iconvx("windows-1251","utf-8",$insertone);
		fwrite ($dumpfile,$insertone);
		$lines++;
		//echo $insertone."<br>";

	};
	if (($result==false)) $err++;
	if ($result==0) $skipped++;
 if (!$pr[8])	echo "DEBUG $query.<br>";
}
$x=cmsg ("BCK_LIN+")."$lines";
	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$x=cmsg ("BCK_TBL+")."".$tables;
	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$x=cmsg ("BCK_SKIP").$skipped;
 	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$x=cmsg ("BCK_ERR").$err;
	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$action="WF_BCK_TRANS;SQL_REM_START $dumpdbname-->$dumpfile -l $lines -t $table -e $err -s $skipped ";logwrite ($action);
}





//MENU DBS SIDE DUMP
if (($write==cmsg("WF_BCK_FILEDUMP_ARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
	 set_time_limit(0);// CFG OPT FUTURE  TODO:?  backup restore
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$dumpdbname="backup"; // backup+DATABASEname-opt+data-opt+text-opts;
        if ($addname) $dumpdbname.=$prdbdata[$tbl][9]."_";
	if ($adddata) $dumpdbname.=date ("dmY")."_";
	if ($addtxt) $dumpdbname.=$txtfordb;
	hidekey ("dumpdbname",$dumpdbname);
	hidekey ("dbname",$prdbdata[$tbl][9]);

echo cmsg ("BCK_CRT_ALL").$prdbdata[$tbl][9].cmsg ("W_NM")."<br>";
echo "Dbscript side:/_local/dump/".$dumpdbname;
if ($pr[20]) lprint ("BLOCK_CF");
echo"<br>";
lprint ("REQ_TIME");
echo "<br>";
if (!$pr[20])checkbox ($structure,"structure");lprint ("DUMP_STR");echo "<br>";
checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
    checkbox (0,"onetable"); lprint ("");

       printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("DUMP1TABLE"),$groupdb,$ipfilter,6);
         echo "<br>";
         echo "Request encode to (only internal)"; inputtxt ($requestencode,5);      echo "<br>";
         checkbox (0,"mysqldump"); lprint ("M_DMP");echo "<br>";
if (!$pr[20]) submitkey ("start","SELF_BCK");
}


//âîññòàíîâèòü êîïèè òàáëèö SQL
if (($write==cmsg("WF_BCK_COPYTBL_UNARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
	echo "WF_BCK_COPYTBL_UNARCH<br>";
}


//MENU SQL SIDE ;Ñäåëàòü êîïèè òàáëèö SQL
if (($write==cmsg("WF_BCK_COPYTBL_ARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
	 set_time_limit(0);// CFG OPT FUTURE  TODO:?
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$dumpdbname="backup"; // backup+DATABASEname-opt+data-opt+text-opts;
	if ($addname) $dumpdbname.=$prdbdata[$tbl][9]."_";
	if ($adddata) $dumpdbname.=date ("dmY")."_";
	if ($addtxt) $dumpdbname.=$txtfordb;
	hidekey ("dumpdbname",$dumpdbname);
	hidekey ("dbname",$prdbdata[$tbl][9]);

echo cmsg ("BCK_CRT_ALL").$prdbdata[$tbl][9].cmsg ("W_NM")."<br>";
echo"<br>";
echo "SQL side:".$pr[39].$dumpdbname."<br>";
lprint ("REQ_TIME");
echo "<br>";

submitkey ("start","SQL_BCK");
}



//CREATING DUMP AT SQL SIDE AS FILETABLES
if (($start==cmsg ("SQL_BCK"))AND($dumpdbname)AND ($prdbdata[$tbl][12]!="fdb")) {
	set_time_limit(0);// CFG OPT FUTURE  TODO:?
	echo cmsg (W_CRT_DMP)." $dumpdbname...<br>";
	echo "Ðåæèì: SQL side<br>";
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	//generate table list
	echo "connecting..".$prdbdata[$tbl][9]."<br>";
	$file=$pr[39];
	echo "Make folder: $file$dumpdbname<br>";
	@mkdir ($file.$dumpdbname)	;
	//opendir ($file.$dumpdbname)	;
		 if ($file==false) die ("File to backup set to NULL!<bR>");
	//echo "File:$file<br>";
	dbs_selectdb ($prdbdata[$tbl][9],$connect,$dbtype);

	$cmd="SHOW TABLES";// ìîæåò âûäåëèòü ïðîñìîòð áàç äàííûõ è òàáëèö â îòäåëüíûå ïðîöåäóðû è èõ âåçäå ñäåëàòü ñòàðòîâûìè?
$a=dbs_query ($cmd,$connect,$dbtype);;
while ($result=dbs_fetch_row ($a,$dbtype)) {
	$tablelist[]=$result[0];$cnt++;//echo "table added to list ::".$result[0]."<br>";
	}

for ($a=0;$a<count ($tablelist);$a++) {
    if (($onetable)AND($tablelist[$a]!==$prdbdata[$source][9])) continue; //íåïðîâåðåíî!!!!111
 $query="BACKUP TABLE `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."` TO  '".$file.$dumpdbname."';";
	$e=dbs_query ($query,$connect,$dbtype);
	echo "DEBUG $query.<br>";//if (!$pr[8])
	sqlerr();
	while ($res=dbs_fetch_row ($e,$dbtype)) {
	echo $res[1]."::".$res[2]."::".$res[3]."<br>";	//echo "table added to list ::".$result[0]."<br>";
	}

 if (!$pr[8])	echo "DEBUG $query.<br>";
 $action="SqL_BCK $dumpdbname--> -q $query -t $tablelist -e $err -s $skipped ";logwrite ($action);
}
	//sqlerr();
}

//CREATING DUMP AT DBSCRIPT SIDE AS ONE SQL FILE
if (($start==cmsg ("SELF_BCK"))AND($dumpdbname)AND ($prdbdata[$tbl][12]!="fdb")AND(!$pr[20])) {
	echo cmsg (W_CRT_DMP)." $backupdbname...<br>";
	echo "Ðåæèì: Dbscript side, data";
	if ($structure) echo "+structure";// ïðîâåðèòü ïðàâèëüíî ëè ìû ïîëó÷àåì ñîåäèíåíèå åñëè óêàçàí ñåðâåð èç servlst.cfg
	echo "<br>";
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$query="CREATE DATABASE IF NOT EXISTS `$backupdbname`;";
        //mysql_query("SET NAMES `cp1251`", $connect);
	$silent=0;dbs_query ($query,$connect,$dbtype);
	//generate table list
	echo "connecting..".$prdbdata[$tbl][9]."<br>";
	dbs_selectdb ($prdbdata[$tbl][9],$connect,$dbtype);
$cmd="SHOW TABLES";
$a=dbs_query ($cmd,$connect,$dbtype);;

while ($result=dbs_fetch_row ($a,$dbtype)) {
	$tablelist[]=$result[0];$tables++;//echo "table added to list ::".$result[0]."<br>";
	}
	@$a=opendir ("_local/dump"); if ($a==false) mkdir ("_local/dump");@closedir ($a);
        if ($onetable) $dumpdbname=$dumpdbname.$prdbdata[$source][5];// ïåðåäàåò òîëüêî 1 íîìåð âûáðàííîé òàáëèöû.
	$dumpfile=fopen ("_local/dump/".$dumpdbname,"w"); if ($dumpfile==false) die ("cannot open file $dumpdbname");
        echo "Final filename:$dumpdbname<br>";
        if (!$mysqldump) $dumpdbname=$dumpdbname."(int).sql";
// èñïðàâèòü encoding bla

	$x="#::Dbscript $verchar :: $verwritefile :: http://dj.chg.su/dbscript/  Mysql Dump File \n\r";
	fwrite ($dumpfile,$x);
        //if ($onetable) $dumpdbname=$dumpdbname."$tablelist[0]";
        //echo "STATUS onetable=$onetable , source= $source ".$prdbdata[$source][5]."<br>";
for ($a=0;$a<count ($tablelist);$a++) {
	if (($onetable)AND($tablelist[$a]!==$prdbdata[$source][5])) continue;
        // áåçîïàñíûé ìåòîä äåëàòü äàìïû. ðåêîìåíäóåòñÿ èñïîëüçîâàòü òîëüêî åãî  çèï ïîêà íå ïîääåðæèâàåòñÿ.
        if ($mysqldump) {
            fclose ($dumpfile);@unlink ($dumpfile); // CFG OPT FUTURE  TODO: -  íåêîãäà ùà ýòî ïðàâèòü
            $filetowrite="_local/dump/".$dumpdbname.$date;
            //if ($OSTYPE=="LINUX") if ($zip) $sys.="| gzip -c ".$filetowrite.".sql.gz";//'date "+%Y-%m-%d"'
            $sys="mysqldump -u ".$sd[14]." -p".$sd[17]." ".$prdbdata[$tbl][9]." --routines > ".$filetowrite.".sql";
            $print="mysqldump ".$prdbdata[$tbl][9]." --routines > ".$filetowrite."(ext).sql";
            if ($onetable) $sys="mysqldump -u ".$sd[14]." -p".$sd[17]." ".$prdbdata[$tbl][9]." ".$tablelist[$a]." --routines > ".$filetowrite.".sql";
            echo ($print);
            logwrite ($sys);//./--routines
            system ( $sys);

            echo "<br>".$prdbdata[$tbl][9]."  > ".$filetowrite.$date.".sql<br>Executing external dump end.exit"; die ("");
        }
        /*
         * Usage: mysqldump [OPTIONS] database [tables]
     OR     mysqldump [OPTIONS] --databases [OPTIONS] DB1 [DB2 DB3...]
    OR     mysqldump [OPTIONS] --all-databases [OPTIONS]
         *     * --skip-opt - îòìåíÿåò íàñòðîéêè mysqldump ïî óìîë÷àíèþ. Â ÷àñòíîñòè - îòìåíÿåò ìíîãîñòðî÷íûé îïåðàòîð INSERT
    * --order-by-primary - ñòðîêè INSERT â äàìïå áóäóò ñîðòèðîâàòüñÿ ïî ÈÄ, òàê ÷òî íàéòè íóæíóþ ñòðîêó áóäåò ãîðàçäî ïðîùå
    * --default-character-set=utf8 - ïîìíèòå, ÿ ãîâîðèë ïðî âîçìîæíûå ïðîáëåìû ñ êîäèðîâêîé? Ïîäñòðàõóåìñÿ (íàäåþñü, âû óæå íå èñïîëüçóåòå ñp1251?)

         */
        //echo "bnre4t5gg9[ph5[gk5opgjk5ipju5hju5l45pht45phjybip45ju8jopyhjph8j59j8458g45ou7hr4gop45h45og";
        echo "processing....";
        //    Äåëàòü áåêàï êîíêðåòíîé áàçû îò ïîëüçîâàòåëñÿ (ó êîòîðîãî åñòü ïðàâà íà ýòó áàçó).
        $x="#table `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`\n";if ($OSTYPE=="WINDOWS") $x.="\r";
	echo $x."<br>";
	fwrite ($dumpfile,$x);
	ob_flush ();



	$x="CREATE DATABASE IF NOT EXISTS `".$prdbdata[$tbl][9]."`;";
	fwrite ($dumpfile,$x);
	$x="USE `".$prdbdata[$tbl][9]."`;\n";if ($OSTYPE=="WINDOWS") $x.="\r";
	fwrite ($dumpfile,$x);

	if ($structure) { //if ($debugmode)	echo "DEBUG $query.<br>";
		$query="SHOW CREATE TABLE `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;"; //OPT STRUCTURE
		$result=dbs_query ($query,$connect,$dbtype); sqlerr();
	for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
    	$insertone=$myrow[1].";";
    	//if ($views) echo $insertone;
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
		                $x=detectencoding($insertone);

                                $encodeset=$x;
                                    if ($views)   echo "Encoded ln : ".$x."<br>?";  //dobawil utf-8  êàêàÿ òî ëåâàÿ ïðîöåäóðà. die () íå ðàáîòàåò
                                    if ($requestencode) { echo"Request encode as^ $requestencode";$encodeset=$requestencode;$x=$requestencode;};
                              if (($x!=="utf-8")AND($sd[19]=="utf-8")) $insertone=iconvx("windows-1251","utf-8",$insertone);
//êîäèðîâêà óñòàíàâëèâàåòñÿ òîëüêî ïðè íàëè÷èè øàïêè. æåëàòåëüíî îáîéòèñü áåç ýòîãî  ý- ýòî áàã CFG OPT FUTURE  TODO:
                fwrite ($dumpfile,$insertone);
		$strclines++;		//echo $insertone."<br>";
	};

	}

             //ñêîïèðîâàíî - ìîäóëü äëÿ ïðèíóäèòåëüíîé îòäà÷è â êîäèðîâêå êîòîðóþ íàì ïðèñëàëè...
        if ($encodeset) { // global íàñòðîéêà äëÿ mysql  pr[76]  ïî÷åìó òî íå ðàáîòàåò .. äåéñòâóåò òîëüêî ëîêàëüíàÿ.
            echo "setting NAMES and CHARACTER SET one more time to $encodeset ($requestencode)... <br>";
        dbs_query("SET NAMES $encodeset", $connect,$dbtype);
        dbs_query("SET CHARACTER SET $encodeset", $connect,$dbtype);
        }

	//if ($debugmode)	echo "DEBUG $query.<br>";
	$query="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;";
        $sourcetable="`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`";
	$result=dbs_query ($query,$connect,$dbtype); sqlerr();
// ïå÷àòü   ôîðìèðîâàíèå òåêñòà çàïðîñà
	for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
    	$mycols=count ($myrow); //updating to gennohdlog !!!
		//$insertone=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols,"");
                $GENALT=1;//$insertone=gennohdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols,"");
                     // ìîæåò ýòó ôóíêöèþ âûäåëèòü îòäåëüíî?                   //..  http://www.thumbshots.com/
if ($GENALT) {
    global $mycol;  // óëó÷øåííîå - ìîæíî âûäåëèòü CFG OPT FUTURE  TODO:// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];


}
// echo "$field";
// ïå÷àòü   ôîðìèðîâàíèå òåêñòà çàïðîñà
 if ($GENALT) $insertone="INSERT INTO $sourcetable ".$fields." VALUES ";
    for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$GENALT) {
                    $insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
                    echo $insertone."<br>";
                }
                if ($GENALT) {
                    $insertone.=gennohdlog ($sourcetable,$myrow,$mycols,$field).",\n";

                }
                // ïîòîì óëó÷øèòü ÷òîáû íå äåëàëà èçëèøíèé êîä

	};
       if ($GENALT)  {$insertone[strlen($insertone)-2]=";";
//îêîí÷ âñòàâ  îøèáêà
		//÷òî ãåíåðèðóåòñÿ ïðè ' âíóòðè è êàê îíî ïîòîì âûïîëíÿåòñÿ
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
                if ($views) echo $insertone."<br>";
                                $x=detectencoding($insertone);    if ($views)  echo "Encoded ln : ".$x."<br>?";  //dobawil utf-8  êàêàÿ òî ëåâàÿ ïðîöåäóðà. die () íå ðàáîòàåò
                              if (($x!=="utf-8")AND($sd[19]=="utf-8")) $insertone=iconvx("windows-1251","utf-8",$insertone);
// ìíå èíòåðåñíî ÷òî ýòî çà êîäèðîâêà âî âñòðîåííîì äàìïå êîòîðàÿ âñåãäà íè÷åãî íå äåëàåò.
		fwrite ($dumpfile,$insertone);
		$lines++;
		//echo $insertone."<br>";
                }// çàáûë

	};
	if (($result==false)) $err++;
	if ($result==0) $skipped++;
 if (!$pr[8])	echo "DEBUG $query.<br>";
}
$x=cmsg ("BCK_LIN+")."$lines";
	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$x=cmsg ("BCK_TBL+")."".$tables;
	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$x=cmsg ("BCK_SKIP").$skipped;
 	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$x=cmsg ("BCK_ERR").$err;
	fwrite ($dumpfile,"#".$x."\n\r");echo "$x<br>";
$action="SELF_BCK_DBS_SIDE $dumpdbname-->$backupdbname -l $lines -t tables -e $err -s $skipped force $dbselected";logwrite ($action);
}



//SQL EXECUTE ñþäà çàëèâàåò ôàéë ñ èìåíåì þçåðà â + è ñàì âûçûâàåò âûïîëíåíèå WF_BCK_FILEDUMP_UNARCH

//Restore from file dump at dbscript folder
//âîññòàíîâèòü èç äàìïà â ïàïêå dbscript
if (($write==cmsg("WF_BCK_FILEDUMP_UNARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
if ($connect==false) {sqlerr($connect);exit;}
if ($dblk) { hidekey ("dblk",$dblk);$forcedb=1;};// ajôîðñèðîâàòü âûáîð åñëè ïðèñëàëè íàçâàíèå áàçû äàííûõ
	checkbox ($forcedb,"forcedb");lprint ("FORCE_DB");echo ":";
$cmd="SHOW DATABASES";
$a=dbs_query ($cmd,$connect,$dbtype);;
if ($a==false) {sqlerr($a);exit;}
 //echo" dblk=<br>";
//.. çäåñü ãäå òî ïðîâåðêó ïóòè íàäî óëó÷øèòü åñëè êîííåêò íå äàëè - äàòü äðóãîé
// echo "<form action=dblinker.php method=post>"; needed for?   unknown
//show already connected list of databases     requires name for menu and displayed title  (may cmsg-ed)
//name - íàçâàíèå ìåíþ,  title - çàãîëîâîê ýòîé âûáîðêè
//function directselectsqldb ($connect,$name,$title) { //name==dest always!,
echo "<select name=dbselected>";
while ($result=dbs_fetch_row ($a,$dbtype)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
        if ($result[0]==$dblk) {$s="selected"; } else {$s="";};
	echo "<option value=".$result[0]." ".$s.">".$result[0]."";
}
echo "</select><br>";

	$path=getcwd ()."/_local/dump/";   //íàäî ñäåëàòü âîçìîæíîñòü âûáîðà ïàïêè ïðÿìî îòñþäà, õîòü òóïî ââåðõ âíèç èëè íàçíà÷àòü å¸ ÷åðåç filemgr
        if (($pr[39])AND(is_dir($pr[39]))) $path=$pr[39];


	echo cmsg (PATH_DUMP_DBS)."$path<br>";
	echo cmsg (SEL_FILE)."<br>";  //oldcore copy filemgr mod  ..
	//echo "Path=$path<br>";
		$path2=$fldup."/_local/dump";
			$mask="*.*";//wse ok
                        global $pr;
                        if ($pr[99]) $mask="*.sql";//wse ok
			$protect[]="*.php";$protect[]="*.rar";$protect[]="*.zip";$protect[]="*.gz";
                        $protect[]="*.sql~";
                        $protect[]="..";
			$files=getdirdata ($path,$mask,$protect);
			if ($files==false) {
					echo " Èùåì äàëåå...<br>";
					//echo "2=getdirdata ($path2,$mask,$protect);";
					$files=getdirdata ($path2,$mask,$protect);
					if ($files==false) echo "Folder not found, 2 tryes.";;
			}
		echo "<form method=post>";
                sort ($files) ;
echo "<select name=\"dump[]\" multiple size=10>";
		for ($a=2;$a<count ($files);$a++){
				if ($files[$a][0]=="") continue;
                                if ($files[$a][0]==".") continue;
                                if ($files[$a][0]=="..") continue;

				echo "<option>".$files[$a][0]."";
			}
			unset ($files);
echo "</select><br>";
checkbox ($views,"views") ; echo cmsg (WF_LOG).cmsg (NORECOMM)."<br>";
checkbox ($dumpmode1,"dumpmode1") ; echo cmsg (OLDCOREDUMPEX)."<br>";
checkbox ($dumpmode2,"dumpmode2") ; echo cmsg (OLDCOREDUMPEX2)."<br>";
checkbox (0,"mysqldump") ; echo cmsg (M_DMP_UPL)."<br>";
// hidekey ("dbtype",$dbtype);íèõåðà íå ïåðåäàåòñÿ.
//checkbox ($disviews,"disviews") ; echo cmsg (WF_LOG).cmsg (NORECOMM)."<br>";
        echo "Encoding can be set in table (alias) properties.<br>";
        echo "manual set encoding:";inputtxt ("encodeset",15);echo " (utf-8 , not utf8)<br>";


 submitkey ("start","DALEE");
echo "</form>";
echo "<form method=\"post\" action=\"filemgr.php\" target=_blank>";
        submitkey ("cmd","FMG_DUMP_UPLOAD");
        echo "</form>";
}
// äëÿ îäèíàêîâûõ íàäïèñåé ìîæ äîá ïîò. ïåðåì. step  1.1 1.2 1.3 :)))
// ïðîöåäóðà âîññòàíîâëåíèÿ áàçû äàííûõ èç äàìïà.
if (($dump)AND($start==cmsg(DALEE))) {
if (($dblk)AND(!$forcedb)) {$forcedb=1;$dbselected=$dblk;	}
	$path=getcwd ()."/_local/dump/";
        $dbtype="mysql"; // default dbtype in CFG OPT FUTURE  TODO:!
      	@$connect=dbs_connect ($pr[43],$sd[14],$sd[17],$dbtype); //prdata tbl 6 changing to $pr[43]  EVERYWHERE!!!
        @ini_set('max_execution_time', 0);set_time_limit(0);
        //..echo "$connect=dbs_connect (".$pr[43].",".$sd[14].",".$sd[17].",$dbtype)";
          sqlerr ($connect);
               	$dumpfile=$dump[0];
	$f=fopen ($path.$dumpfile,"rb");
	if ($views) print_r ($dump);
	echo "file=$path $dumpfile";
        if ($mysqldump) {
            $localpath="_local/dump/".$dumpfile."";
            $localpath=$path.$dumpfile;
         $sys="mysql -u ".$sd[14]." -p".$sd[17]." ".$dbselected." < ".$localpath."";
         //$sys="mysql -u ".$sd[14]." -p".$sd[17]." ".$dbselected." < ".$localpath."";
         logwrite ($sys) ;
         //$sys=escapeshellcmd ($sys);
         system ( $sys);
         echo "<br><br>$sys<br>";
         echo "Executing external mysql to ".$dbselected." < ".$localpath."<br>Ending.";exit;
        }

	$query="";
        if ($encodeset) { // global íàñòðîéêà äëÿ mysql  pr[76]  ïî÷åìó òî íå ðàáîòàåò .. äåéñòâóåò òîëüêî ëîêàëüíàÿ.
            echo "setting NAMES and CHARACTER SET one more time to $encodeset... <br>";
        dbs_query("SET NAMES $encodeset", $connect,$dbtype);
        dbs_query("SET CHARACTER SET $encodeset", $connect,$dbtype);
        }
        if ($dumpmode2) {
            echo "Trying to execute full dump without any checks or descriptors...<br>";
            fclose ($f);
            needupdate ();
            $query=file_get_contents ($path.$dumpfile);
             //..$db->getConnection()->exec($query); ///-  áûëî áû êðó÷å íî ó ìåíÿ íåò òàêîé ôóíêöèè
            	//..$result=dbs_query ($query,$connect,$dbtype);
                sqlerr ();
                ob_flush ();
        }
	if (!$dumpmode2) while ($a=fgets ($f)) {// ïîêà ÷èòàåòñÿ
	if ($a[0]==="#") continue;	if ($a[1]==="#") continue;// skip comment lines
	if ((!$dumpmode1)AND(!$dumpmode2)) $najti=strpos ($a,";\r");
        if (($dumpmode1)) $najti=strpos ($a,";");

        //        $queries=preg_split("#(ENGINE=[^\;]+)\;\r?\n#i",$cmd,-1,PREG_SPLIT_DELIM_CAPTURE);
	$najti2=strpos ($a,"SELECT DATABASE");
	$najti3=strpos ($a,"create database if not exists");
	if ($najti2!==false) {
						//dump are normal?  check ' inside dump text
						$b=str_replace ("SELECT DATABASE ","CREATE DATABASE ",$a);//3.5.25 ver only
						$a=str_replace ("SELECT DATABASE ","USE ",$a);
						dbs_query ($b,$connect,$dbtype);;
						echo "<br>".cmsg (W_NDB_FORC2)."($a)<br>";
						}
	if ($najti3!==false) {dbs_query ($a,$connect,$dbtype);;
						$a=str_replace ("create database if not exists","USE ",$a);
						echo "<br>".cmsg (W_NDB_FORC)."($a)<br>";
							}
	if ($forcedb) {
			$cmd="USE $dbselected;";
			$res=dbs_query ($cmd,$connect,$dbtype);;
                        sqlerr ($res); // à åñëè áàçó íèãäå íå çàäàëè , ÷òî ñ íåé äåëàòü?  ïðèøèòü ïîäêëþ÷åííóþ
                        // íåò àíàëèçà ñêðèïòà íà ïðèíàäëåæíîñòü áàçû
			//if ($a) echo "forced select $cmd<br>"; îíî âûçûâàëî áàã 1111111
				}
	if ($najti===false)	{$query.=$a;continue;}
	if ($najti!==false)	{$query.=$a;}

	if ($views) echo "<br>EXECUTING:".$query."<br>";

	$result=dbs_query ($query,$connect,$dbtype);
	$query="";
	$queries++;
	//if ($queries) ob_flush();//die ("lim");
	if (($result==false)) {$err++; if ($views) echo "ERROR QUERY:$a<br><br>";}   // âîò ýòî âåðíî à íå -1  òóò false ñâåðÿòñÿ äîëæåí!!!!
	if ($result==0) $skipped++;
 sqlerr();ob_flush();

	}
	if (!$pr[8]) echo "DEBUG $query.<br>";
$x=cmsg (WF_EXQUES)."$queries";	echo "$x<br>";
//$x=cmsg ("BCK_TBL+")."".$tables;	echo "$x<br>";
$x=cmsg (BCK_SKIP).$skipped; 	echo "$x<br>";
$x=cmsg (BCK_ERR).$err;	echo "$x<br>";
$query="";
	mysqli_close($connect);
	fclose ($f);
	ob_clean();
	$action="WF_BCK_FILEDUMP_UNARCH $path.$dumpfile -q $queries -e $err -s $skipped force $dbselected";logwrite ($action);
	//apache_child_terminate();
lprint (COMPLETED);exit; //òåïåðü íå äîëæíî áûòü íèêàêèõ First select id please
}
//êîíåö âûïîëíåíèÿ âîññòàíîâëåíèÿ èç äàìïà



//=-===============BACKUP END======================================



//ìîäóëü çàïóñêà
if (($write==cmsg ("CFG_COPY"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	readdescripters (); if ($data==-1) exit;
	//     echo $mznumb[3].$mycols; echo $res16; echo $a; êîïèÿ ìîäóëÿ èç íà÷àëà writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,$ipfilter,6);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"destination",cmsg ("WF_MAS_DEST"),$groupdb,$ipfilter,6);
	//êîíåö âûáîðà êîëîíêè èç òåêóùåé áàçû
	if ($cfgmod==0) submitkey ("write","CFG_CHG");
}

//ìîäóëü îáðàáîòêè
	if ($write==cmsg ("CFG_CHG")) { //++ ÝÒÎ - ÍÅ ÏÅÐÅÏÈÑÀÒÜ ÑÒÐÓÊÒÓÐÓ, ÑÌ ÍÈÆÅ
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$filbassource=$prdbdata[$source][0];$filbasdest=$prdbdata[$destination][0];
	echo $filbassource."-->".$filbasdest;
	$debug=1;
	csvopen ("_data/".$filbassource,"copy","_data/".$filbasdest);
	$action="CFG_COPY _data/$filbassource-->_data/$filbasdest";logwrite ($action);
	// íå òîò æå ëè ñàìûé áàã ñ ãëîáàëüíîñòüþ ÷òîè ïðè E_DB  ACCESS? ãàëêó
	//Ñîçäàíèå çàãîëîâêîâ ïî óìîë÷àíèþ ãëîáàëüíûìè (ìóëüòèèíñò)  pora prowe A_HDR_GLOBBYDEF   $pr[34]==1   global - is first
		$data=readdescripters (); if ($data==-1) exit;
	}



//ìîäóëü çàïóñêà
if (($write==cmsg ("WF_HDRSQL_REAL"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	readdescripters (); if ($data==-1) exit;
}

//ìîäóëü îáðàáîòêè
	if ($write==cmsg ("WF_HDRSQL_REWR")) { //++ ÝÒÎ - ÍÅ ÏÅÐÅÏÈÑÀÒÜ ÑÒÐÓÊÒÓÐÓ, ÑÌ ÍÈÆÅ
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	echo "if (($field==$fieldexch)AND ($action==exch)";
		$data=readdescripters (); if ($data==-1) exit;
	}

//ìîäóëü çàïóñêà
	if (($write==cmsg  ("WF_STRC_SQL"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters (); if ($data==-1) exit;
	echo cmsg ("WF_SELROW").":";
	printfield ($data,"field");
	echo "<br>";lprint ("WF_SELACT");
?>
<select name =action >
<option value=addafter><?php lprint ("WF_ROW_ADDAFT");?> </option>
<option value=addbefore><?php lprint ("WF_ROW_ADDBEF");?></option>
<option value=del><?php lprint ("WF_ROW_DEL");?></option>
<option value=modify><?php lprint ("WF_ROW_MOD");?></option>
</select>
<?="<br>".cmsg ("WF_NNAMROW").":";
    echo "<input type=text id=dbmgr name=newname><br>"; //äîáàâëåíû íîâûå ID  . öåëü íåÿñíà. ïîêà îñòàâëþ
	checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";  ?>
<?php submitkey ("write","WF_MODSTRC_SQL");
	echo "<br><br>".cmsg ("WF_NEWPARAM")."<br>";
		checkbox ($protoenable,"protoenable");
		echo cmsg ("WF_PROTROW").":";	printfield ($data,"nfieldexch");
		echo cmsg ("RECOMM")."<br>";
			echo cmsg ("WF_NROWDAT").":";
    echo "<input type=text id=dbmgr_txt name=newdatatype><br>";
			echo cmsg ("WF_NROWLEN").":";
    echo "<input type=text id=dbmgr_txt name=newlen><br>";
			echo cmsg ("WF_NROWFLAG").":";
    echo "<input type=text id=dbmgr_txt name=newflags><br>";
	}
//ìîäóëü îáðàáîòêè
	if ($write==cmsg("WF_MODSTRC_SQL")) { //++
			if ($codekey==7) demo ();
		if ($codekey==4) needupgrade ();
		if ((!$protoenable)AND($newdatatype=="")) { lprint ("WF_ROW_NODATA"); exit ;};
		$params=array ();		$params[0]=$newname;
		if ($protoenable) {$params[1]="prototype";} else {$fieldexch="";
		$params[1]=$newlen;
		$params[2]=$newflags;
		$params[3]=$newdatatype;
		}
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
		$data=readdescripters (); if ($data==-1) exit;
	// íàñòðîåíî íà ïîëó÷åíèå íîìåðîâ êîëîíîê!
	if (($field==$fieldexch)AND ($action=="exch")) {lprint ("WF_EXCHSELF"); exit;};
	 $result=structsql ($action,$field,$fieldexch,$params) ;
	if ($result==true) { echo cmsg ("WF_HEADOK")."!<br>";} else { echo cmsg ("WF_HEADFAIL")."<br>";}
	if ($pr[12]) {$act="HEADER_STRUCT_SQL $action,$field,$newname $newdatatype ($newlen) $newdatatype numbcolproto=$fieldexch)"; logwrite ($act) ;};

	}



// ñîçäàíèå òàáëèöû
//ìîäóëü çàïóñêà
	if (($write==cmsg  ("WF_NEW_TAB"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters (); if ($data==-1) exit;
			echo cmsg ("WF_NEW_TAB_INFO").":";	echo "<br>";
			lprint ("WF_NEW_NAME");inputtxt("newtable",25);
	 submitkey ("write","WF_ADD_TAB_SQL");
	}
//ìîäóëü îáðàáîòêè
	if ($write==cmsg("WF_ADD_TAB_SQL")) { //++
			if ($codekey==7) demo ();
		if ($codekey==4) needupgrade ();
		if (($newtable=="")) { lprint ("WF_ROW_NODATA"); exit ;};
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
		$exec="CREATE TABLE `".$newtable."` (
  `id` bigint(20) unsigned NOT NULL auto_increment COMMENT 'Identifier' ,
    PRIMARY KEY  (`id`) ); ";

  if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$a=dbs_query($exec,$connect,$dbtype);
	echo "executing: $exec ; Status=$a";
	if ($pr[12]) {$act="WF_NEW_TAB (".$prdbdata[$tbl][9]."'".$newtable.") state $a "; logwrite ($act) ;};

	}



	if ($write==cmsg("WF_SHOW_TAB_CRT")) { //++
			if ($codekey==7) demo ();
		if ($codekey==4) needupgrade ();
	//	if (($newtable=="")) { lprint ("WF_ROW_NODATA"); exit ;};
        @$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9],$connect,$dbtype);
        $query="SHOW CREATE TABLE `".$prdbdata[$tbl][5]."`;";
        //$query="SHOW CREATE TABLE `".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."`;";  ìëÿòü  ÷å ýòîìó óðîäó íàäî,

  if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$a=dbs_query($query,$connect,$dbtype);
        //echo " $a=dbs query  as $query,$connect,$dbtype<br>";
   	//echo "executed: $query ; Status=$a  Count=".count ($a)."<br>";
        $result=dbs_fetch_row ($a,$dbtype);
        echo "$result[1]";
        //print ($a[1][0]);
      // $x=executesql ($query,$connect,1);echo $x;
	if ($pr[12]) {$act="WF_SHOW_CRT_TAB (".$prdbdata[$tbl][9]."'".$prdbdata[$tbl][5].") state $a "; logwrite ($act) ;};
        exit;
	}







//ìîäóëü çàïóñêà

	if (($write==cmsg ("WF_STRC_DAT"))AND ($prdbdata[$tbl][12]!="fdb")OR($write==cmsg ("WF_MODSTRC_DAT"))AND ($prdbdata[$tbl][12]=="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$data=readdescripters (); if ($data==-1) exit;
	$data[0]=$data[3];// óáèðàåì íàõ çàãîëîâêè îò SQL
	echo cmsg ("WF_SELROW").":";
	printfield ($data,"nfield");
	echo cmsg ("WF_EXCHROW").":";	printfield ($data,"nfieldexch");
	echo "<br>".cmsg ("WF_NNAMROW").":";
 echo "	<input type=text id=dbmgr name=newname> <br>"; // îøèáêà, öåëü id íå íàéäåíà. ïðîïóùåíî.
	lprint ("WF_SELACT");
	?>
		<select name =action >
<option value=addafter><?php lprint ("WF_ROW_ADDAFT");?> </option>
<option value=addbefore><?php lprint ("WF_ROW_ADDBEF");?></option>
<option value=del><?php lprint ("WF_ROW_DEL");?></option>
<option value=exch><?php lprint ("WF_ROW_EX");?></option>
<option value=nop><?php lprint ("WF_ROW_NOP");?></option>
</select>
	<br><?submitkey ("write","WF_MODSTRC_DAT2");

	}
//ìîäóëü îáðàáîòêè
if ($write==cmsg ("WF_MODSTRC_DAT2")) { //++
		if ($codekey==7) demo ();
		if ($codekey==4) needupgrade ();
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	//	$data=readdescripters (); if ($data==-1) exit;
	// íàñòðîåíî íà ïîëó÷åíèå íîìåðîâ êîëîíîê!
//	print_r ($data); echo "Dtata!!!";
	if (($field==$fieldexch)AND ($action=="exch")) {lprint ("WF_EXCHSELF"); exit;};
	 structdat ($action,$field,$fieldexch,$newname) ;
	if ($pr[12]) {$act="HEADER_STRUCT_DAT $action,$field,$fieldexch,$newname"; logwrite ($act) ;};
}


//ìîäóëü çàïóñêà
if (($write==cmsg ("WF_HDRSQL_VIRT"))AND ($prdbdata[$tbl][12]!="fdb")) { //++
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
        lprint ("M_LINK") ; Echo "<br>";
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters (); if ($data==-1) exit;
	$mycol=$data[0];
	@$f=csvopen ("_data/".$filbas,"r","0");$new=0;
		if ($f==true) { $z=xfgetcsv ($f,$xfgetlimit,"¦");$plevel=xfgetcsv ($f,$xfgetlimit,"¦"); };
		$a=0;$cnt=count ($mycol);
	for ($a=0;$a<$cnt;$a++)
			{
			echo "$a $z[$a] (<blu>$mycol[$a]</blu>) ";
			?><textarea name=z<?=$a; ?> cols=30 rows=1><?=$z[$a]?></textarea>
				<textarea name=p<?=$a; ?> cols=12 rows=1><?=$plevel[$a]?></textarea>
	<!--			<input type=submit name=executeaddfield value=<?=$a?>>+-->
				<?php 				;//
				$fil=$tbl.";".$z[$a].";".$a.";".$b."";//tabbydb,columnname,columnnomer,0
				$pl=$plevel[$a];$pl=str_replace ("#",";",$pl);
		 echo "<a href='w.php?cmd=join&fil=$fil&pl=".$pl."'><img src='_ico/linked_table-no.png' border=0 title='".cmsg ("KEY_LINKING")."'></a></color>";
				echo "<br>";  //step 1 linkning table master
			}
			lprint ("WF_VIDTORID");
     echo ":"; checkbox ($sqltocsv,"sqltocsv");
	 echo "<br>";lprint ("WF_RIDTOVID");
	 echo ":"; checkbox ($csvtosql,"csvtosql");
	 echo "<br>";

  submitkey ("write","WF_HDR_REWR");
}


//ìîäóëü çàïóñêà      ìîäóëü îáðàáîòêè ïðåäûäóùåãî è ýòîãî ðåæèìà íèæå
//CSV HEADE
if (($write==cmsg("KEY_LINKING"))) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	if ($dbtype!=="fdb") {@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
        }
	$data=readdescripters (); if ($data==-1) exit;
	$mycol=$data[0];
//join cmd   fil=$fil  plevel=$plevel
lprint ("S_PL") ;echo ":";
echo "<select name=plevel>";
		for ($a=0;$a<10;$a++){
			echo "<option>".$a;
			}
echo "</select><br>";
lprint ("LINK_CHK");echo "<br>";

	$datafil=explode (";",$fil); $dataplevel= explode (";",$pl);$plevel=$pl;
	if ($debug) echo "getting data  $fil  plevel=$pl<br>";$pl=$dataplevel;
	 	$columnname=$datafil[1];$columnnomer=$datafil[2];
 	echo "tbl=$tbl [".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."] column $columnname (No $columnnomer)   join to <br>";  //tabbydb,columnname,columnnomer,0"////tabbydb,columnname,columnnomer,0
//.echo "0=óðîâåíü".$pl[0].";#1=íàçâ èëè íî òàáëèöû".$pl[1].";#2=ìåòîä ï ".$pl[2].";#3=Êîë".$pl[3].";#4=ConnectName".$pl[4].";#5=Âñïîì òàáëèöà-îñíîâíîå èìÿ(îòîáðàæàåìîå)".$pl[5].";#6=Ðåæèì ï".$pl[6].";#7=Êîë".$pl[7].";)";// $pl 0-plevel íå òðîãàåì, 2 name or ID 3 mode 4 col  5 name ?  ;6 helptable name typa kak 1 ;7 mode typa kak 2 ;8 kolonka (kak 3)
$intpl=$pl[1];
settype ($intpl,integer);
if ($pl[1]) if (is_integer($intpl)===true) $id1=getidbyid ($prdbdata,0,"realid",$pl[1]);//ïîëó÷àåì ID òàáëèöû ñîîòâåòñòâóþùåé èìåíè  b
$intpl=$pl[5];
settype ($intpl,integer);
if ($pl[5]) if (is_integer($intpl)===true) $id5=getidbyid ($prdbdata,0,"realid",$pl[5]);//ïîëó÷àåì ID òàáëèöû ñîîòâåòñòâóþùåé èìåíè

if ($pl[1]) echo "<BR><BR>tbl connected as link=".$pl[1]." (reg conf realid #$id1) [".$prdbdata[$pl[1]][9].".".$prdbdata[$pl[1]][5]."] with method ".$pl[2]." (No ".$pl[3].") displays as  ".$pl[4]."<br>";  //tabbydb,columnname,columnnomer,0"////tabbydb,columnname,columnnomer,0
if ($pl[5]) echo "tbl connected as help=".$pl[5]." (reg conf realid #$id5) [".$prdbdata[$pl[5]][9].".".$prdbdata[$pl[5]][5]."] with method ".$pl[6]." (No ".$pl[7].") displays as  ".$pl[8]."<br>";  //tabbydb,columnname,columnnomer,0"////tabbydb,columnname,columnnomer,0
if (!$pl[1]) echo cmsg (TLNK_NOT)."<br>";
if (!$pl[5]) echo cmsg (HLNK_NOT)."<br>";
//åñëè äàííûå óæå áóäóò ïðèñóòñòâîâàòü - èõ íóæíî áóäåò áðàòü îòñþäà. ^_^ â èäåàëå ìîæåò ïðèíèìàòüñÿ íå òîëüêî 2 ïóíòà :)
//.getidbyid($db,$idsrchcolumn,$idrescolumn,$stringêîò èùóò) 	 âûáîð òàáëèöû, äëÿ 2 ïóíêòîâ, ïîòîì âûáîð ìåòîäà è êîëîíêè è èìåíè ñîåäèíåíèÿ.
	//exit;
	//resending

        $activetableid=$tbl;
	$master="key_linking";
        $step=1;
        if ($pr[37]) submitkey ("write","TARGET"); // group
	if (!$pr[37]) submitkey ("write","TARGET2"); // no group
}


////// ìîäóëü ïåðåõîäà linkning

if (($write==cmsg("TARGET"))) {
 $groupdbthisname="groupdb";
		groupdbprint ($list,"Group",$prdbdata,$tbl,$groupdb);; //êîä TBL ïåðåäàåòñÿ ñàìîñòîÿòåëüíî, åñëè ãðóïïû íå èñïîëüçóþòñÿ - ýòîò áëîê ïðîïóñêàòü
	$master="key_linking";
        $step=2;
	submitkey ("write","TARGET2");
}




// ìîäóëü ïåðåõîäà linkning

if (($write==cmsg("TARGET2"))) {
//	echo "!!!!!!!!!!!!!";
        $tlb=$activetableid;
     //   echo "PRINTLINK 1809 $prauth,$prdbdata,$ADM,$tbl,$grouplist,tbllink,cmsg(ELLINK),$groupdb,$ipfilter,6)<br>;";
     //   echo "id1=$id1  id5=$id5  columnname=$columnname columnnomer=$columnnomer <br>";
     //  print_r ($grouplist) ;echo "<br>";
       $tablelist=array (1=>"tbllink", 2=>"tblhelp");
        for ($cycle=1;$cycle<count ($tablelist)+1 ;$cycle++) {
            if ($cycle>1) $cycleno=$cycle;
	printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,$tablelist[$cycle],cmsg("SELLINK"),$groupdb,$ipfilter,"");echo "<br>";
 }       //
	//printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tblhelp",cmsg("SELLINK"),$groupdb,$ipfilter,"");
	$master="key_linking";
        //hidekey ("step",3);
$step=3;
	submitkey ("write","SAV_LNK");
}


// ìîäóëü ñîõðàíåíèÿ linkning

if (($write==cmsg("SAV_LNK"))) {
//	echo "res  NOT CHECKED  $tbllink <br>";
        //  tbllink - podkl tut
        $tablelist=array (1=>$tbllink, 2=>$tblhelp);
        //$tbl=$tbllink;
        for ($cycle=1;$cycle<count ($tablelist)+1 ;$cycle++) {
            if ($cycle>1) $cycleno=$cycle;
            $tbl=$tablelist[$cycle];
         if ($dbtype!=="fdb") {   @$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);// 6 - server - 9 - db  5- table
            @dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
         }
echo " connecting ... ".$prdbdata[$tablelist[$cycle]][9]."<br>";
	$data=readdescripters (); if ($data==-1) exit;
	$mycol=$data[0];
        ; // â äáëèíêåðå ãåíåðèðîâàòü èìåíà äëÿ ïîëåé 0 è 1 ñ òî÷êàìè !!1  ýòî ñèëüíî óïðîñòèò æèçíü!!
	print $prdbdata[$tablelist[$cycle]][0]." :: ";
echo "<select name = mode".$cycleno." size = ".$mode15.">";
if ((($pr[3])and($ADM==0))or($prauth[$ADM][26])) echo "<option value=1".$sel[1].">".$sd[4]."</option>";
if ((($pr[4])and($ADM==0))or($prauth[$ADM][27])) echo "<option value=2".$sel[2].">".$sd[5]."</option>";
if ((($pr[5])and($ADM==0))or($prauth[$ADM][28])) echo "<option value=3".$sel[3].">".$sd[6]."</option>";
if ((($pr[6])and($ADM==0))or($prauth[$ADM][29])) echo "<option value=4 disabled".$sel[4].">".$sd[7]."</option>";
if ((($pr[29])and($ADM==0))or($prauth[$ADM][30])) echo "<option value=6".$sel[6].">".$sd[20]."</option>";
if ((($pr[30])and($ADM==0))or($prauth[$ADM][25])) echo "<option value=7 selected".$sel[7].">".$sd[21]."</option>";
if ((($pr[31])and($ADM==0))or($prauth[$ADM][31])) echo "<option value=8".$sel[8].">".$sd[22]."</option>";
if ((($pr[32])and($ADM==0))or($prauth[$ADM][32])) echo "<option value=10".$sel[10].">".$sd[23]."</option>";
print "	</select>
";
		//$data=readdescripters (); Â ÏÅÐÂÎé èòåðàöèè ïåðåìåííûå èìåþò íîðìàëüíûå èìåíà (cycleno=="")_ ïîòî íà÷èíàåòñÿ ñ2
		$a=prefixdecode ($res16);
   decodecols ($res16);	lprint ("FOR_SEL");
   $field=$kol;//echo "(field=$kol ";
    printfield ($data,"_kol".$cycleno);
    echo "(only field mode) ";
   ;echo cmsg ("COLCOMM") ;echo "$cycleno :";
   inputtxt ("colcomm".$cycleno,10); echo "<br>";
    }
    echo "<br>Note:Help table automatically selects mode 4 -No connect large tables !<br>";


     $master="key_linking";
        //hidekey ("step",4);
        //USEHLPTAB2 Èñïîëüçîâàòü âñïîìîãàòåëüíóþ òàáëèöó (âíèìàíèå - ïîëíûé ïîêàç! )
        //COLCOMM Êîììåíòàðèé îòîáðàæàåìûé ïî êîëîíêå:
        checkbox ($usehlptab2,"usehlptab2"); echo cmsg ("USEHLPTAB2")."<br>";

$step=4;
	submitkey ("write","SAV_LNK2");
}

if (($write==cmsg("SAV_LNK2"))) {
	//echo "!!!!!!!!!!!!!end";
	// edit csv   1=Plevel#2=BaseVisualNameorrealID#3=Modesrch#4=Column#5=ConnectName#6=Help-BaseVisualName#7=Modesrch#8=Column#NA
        $master="key_linking";
        $tablelist=array (1=>$tbllink, 2=>$tblhelp);// dâ áóäóùåì äîñòàòî÷íî óâåëè÷èòü ïåðåìåííóþ
        //$tbl=$tbllink;
        if (strlen ($plevel)>1) $plevel=$plevel[0]; //íå ñîâñåì ïðàâèëüíî , íî â ïàäëó âûÿñíÿòü ñêîëüêî òàì öèôð â ïåðâîì ïîëå. è íå áóäåò ;;;1;1;1;1;;
$genericnewplevelforactivetableid=$plevel."#";
        for ($cycle=1;$cycle<count ($tablelist)+1 ;$cycle++) {
            if ($cycle>1) $cycleno=$cycle;
$dbandtablename=$prdbdata[$tablelist[$cycle]][0];  // use not visual (1)  normal (0) system name .

$mode=${"mode".$cycleno};
$kol=${"kol".$cycleno};
$colcomm=${"colcomm".$cycleno};
if (!$usehlptab2) if ($cycleno==2) { $dbandtablename=""; $mode="d";$kol="";$colcomm="";};
$genericnewplevelforactivetableid.=$dbandtablename."#".$mode."#".$kol."#".$colcomm."#";

        }
//if ($pl[5]) echo "tbl connected as help=".$pl[5]." (reg conf realid #$id5) [".$prdbdata[$pl[5]][9].".".$prdbdata[$pl[5]][5]."] with method ".$pl[6]." (No ".$pl[7].") displays as  ".$pl[8]."<br>";  //tabbydb,columnname,columnnomer,0"////tabbydb,columnname,columnnomer,0
//$dbandtablename=$prdbdata[$tbllink][0];//used name from 1  (not visual name (0))
//if ($usehlptab2) $dbandtablename2=$prdbdata[$tblhelp][0];
//$modesearch=$mode;if ($mode==7) $mode=$mode.".".$kol; //  ýòî ïðàâäà íóæíî?*
//$modesearch2=$mode2;if ($mode2==7) $mode2=$mode2.".".$kol2;
//$genericnewplevelforactivetableidx=$plevel."#".$dbandtablename."#".$mode."#".$kol."#".$colcomm."#".$dbandtablename2."#$mode2#".$kol2."#".$name2;
//'ýòè äàííûå òîëüêî äëÿ êîíêðåòîíîãî ïîëÿ, è èì íå òðåáóåòñÿ ñîäåðæàòü  åãî ÈÄ
echo "writing ".$genericnewplevelforactivetableid."<br>";
       // hidekey ("step",5); 0#tcharscharacters_inventory#2
$step=5;

$silent=1;
		$ff=csvopen ("_data/".$filbas,"r",1);
		$data=readfullcsv ($ff,"new"); if ($data==-1) { echo "E_DB:failed read status<br>";exit;}
               $csvheader=$data[0];$csvplevel=$data[1];$csvdata=$data[2];$csvcnt=$data[3];

                $csvplevel[$columnnomer]=$genericnewplevelforactivetableid;
                fclose ($ff);
		$ff=csvopen ("_data/".$filbas,"w",1);
                 writefullcsv ($ff,$csvheader,$csvplevel,$csvdata);
                echo "writed";exit;
			/*for ($b=0;$b<count ($csvheader);$b++) {
				if ($mycol[$a]==$csvheader[$b]) $newplevel[$a]=$csvplevel[$b];
				if ($newplevel[$a]==="") $newplevel[$a]="0";
			}*/
                //        }

	//submitkey ("write","SAV_LNK");
}


//stepping
if ($master=="key_linking") {
if ($step>0) {
    echo "<br>";
        hidekey ("activetableid",$activetableid);// ýòî ÈÄ òàáëèöû ê êîòîðîé áóäåì ïîäñîåäèíÿòü
	hidekey ("plevel",$plevel); // óðîâåíü äîñòóïà äëÿ ýòîé òàáëèöû
	hidekey ("columnname",$columnname); //èìÿ êîëîíêè ê êîòîðîé áóäåò ïðîèçâîäèòñÿ ïîäêëþ÷åíèå (âêëþ÷àÿ óðîâåíü äîñòóïà)
	hidekey ("columnnomer",$columnnomer);// å¸ íîìåð
	hidekey ("id1",$id1);
	hidekey ("id5",$id5);
        hidekey ("step",$step);//..øàã  âûïîëíåíèÿ îïåðàöèè
        hidekey ("hidemenu",1);//óáèðàòü ìåíþ
hidekey ("menudisable",on);
    echo "Your table=$tbl [".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."] column $columnname (No $columnnomer)   join to <br>";
    echo "Step $step/5<br>";
    }
 if ($step>2) { if ($groupdb) hidekey ("groupdb",$groupdb);
	 echo "Adding from group:$groupdb<br>";
 }
if ($step>3) {
    	hidekey ("tbllink",$tbllink);
	hidekey ("tblhelp",$tblhelp);
        hidekey ("ipfilter",$ipfilter);
echo "Table 1 - $tbllink ; Table 2 (help) - $tblhelp  <br> IP filtering - $ipfilter<br>";

        $tablelist=array (1=>$tbllink, 2=>$tblhelp);
        //$tbl=$tbllink;
        for ($cycle=1;$cycle<count ($tablelist)+1 ;$cycle++) {
            if ($cycle>1) $cycleno=$cycle;
  echo "Table $cycle (id=".$tablelist[$cycle]." (".$prdbdata[$tablelist[$cycle]][0].")  used pl=$plevel mode = ".${"mode".$cycleno};
  echo " kol=".${"kol".$cycleno}." (_".${"_kol".$cycleno}.")  colcomm=".${"colcomm".$cycleno}."";

}
//." :: Plevel:";


}
if ($step>4) {
    hidekey  ("usehlptab2",$usehlptab2);
    hidekey ("colcomm",$colcomm);
        hidekey ("colcomm2",$colcomm2);
        hidekey ("mode",$mode);
        hidekey ("kol",$kol);
        hidekey ("mode2",$mode2);
        hidekey ("kol2",$kol2);
  //  echo "Table 1 ($tbllink) used mode = $mode  kol=$kol ($_kol)  colcomm=$colcomm";
    echo "debug Table 2 ($tblhelp) used mode= $mode2 kol=$kol2 ($_kol2)  usehlptab2=$usehlptab2 ";
}

}
//end stepping \
//
//
//
//
//ìîäóëü çàïóñêà      ìîäóëü îáðàáîòêè ïðåäûäóùåãî è ýòîãî ðåæèìà íèæå
//CSV HEADER
if (($write==cmsg("KEY_HEAD"))AND ($prdbdata[$tbl][12]=="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) {
		@$f=csvopen ("_conf/".$filbas,"r","0");
		$data=readdescripters();//print_r($data);
		rewind ($f);
	}
               lprint ("M_LINK") ; Echo "<br>";
	echo "<br>";
	 if ($f==-1) exit;
		$z=xfgetcsv ($f,$xfgetlimit,"¦");$plevel=xfgetcsv ($f,$xfgetlimit,"¦");
		if ($cfgmod==1) {$headervirtual=$data[3];} else {$headervirtual=$z;};//always virtual//always virtual
		if (count ($z)==1) {  lprint ("WF_OUTDATDB");echo "<br>";}
	for ($a=0;$a<count ($z);$a++)
			{
			echo "$a $headervirtual[$a] (<blu>$mycol[$a]</blu>) ";
			?><textarea name=z<?=$a; ?> cols=30 rows=1><?=$z[$a]?></textarea>
				<textarea name=p<?=$a; ?> cols=12 rows=1><?=$plevel[$a]?></textarea>
                                <?php                                 $fil=$tbl.";".$z[$a].";".$a.";".$b."";//tabbydb,columnname,columnnomer,0
				$pl=$plevel[$a];$pl=str_replace ("#",";",$pl);
                                echo "<a href='w.php?cmd=join&fil=$fil&pl=".$pl."'><img src='_ico/linked_table-no.png' border=0 title='".cmsg ("KEY_LINKING")."'></a></color>";
				echo "<br>";
			}
			echo "";

 submitkey ("write","WF_HDR_REWR");
  		 submitkey ("write","WF_MODSTRC_DAT");echo "<br><br>";
 	 submitkey ("write","WF_ARCH");
  submitkey ("write","WF_UNARCH");

}

//ìîäóëü  îáðàáîòêè
// Ïåðåçàïèñü çàãîëîâêà CSV(DAT) äëÿ SQL  ïîäîéäåò äëÿ êîíôû!
if (($write==cmsg ("WF_HDR_REWR"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN"); exit;};
	  //óñëîâèå íå âûïîëíÿåòñÿ
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
	@$f=csvopen ("_data/".$filbas,"r","1");$new=0;
		$z=xfgetcsv ($f,$xfgetlimit,"¦"); $p=xfgetcsv ($f,$xfgetlimit,"¦");
		for ($a=0;$a<count ($z);$a++)	{
	if (!$sqltocsv) $z[$a]=${"z".$a};//ïðèíèìàåì äàííûå þçåðà
	$p[$a]=${"p".$a};//ïðèíèìàåì äàííûå þçåðà
}
if ($OSTYPE=="LINUX") $z[$a-1]=$z[$a-1]."\n";//ôèêñ áàãà ñ ïåðåâîäîì ñòðîêè,ñàì ìîæåò âûçâàòüäðóãèå áàãè îñòîðîæíî
//if ($OSTYPE=="WINDOWS") $z[$a-1]=$z[$a-1]."\r\n";//ôèêñ áàãà ñ ïåðåâîäîì ñòðîêè,ñàì ìîæåò âûçâàòüäðóãèå áàãè îñòîðîæíî
//ôèêñ îòìåíåí òê ïðè ñîõðàíåíèè çàãîëîâêà âûçûâàë åãî ñìåùåíèå.
fclose ($f);
	if ($sqltocsv) { $z=$data[0]; $z[]=""; };//headerreal
	@$f=csvopen ("_data/".$filbas,"w","1");
writefullcsv ($f,$z,$p,"");
	if ($pr[12]) {$act="HEADER_SQL $tbl to $values"; logwrite ($act) ;};
}


//ìîäóëü îáðàáîòêè
if (($write==cmsg ("WF_HDR_REWR"))AND ($prdbdata[$tbl][12]=="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN"); exit;};
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
		$new=0;
	$data=readdescripters ();
	$z=xfgetcsv ($f,$xfgetlimit,"¦"); $plevels=xfgetcsv ($f,$xfgetlimit,"¦");// íàäî òåðÿòü èõ!!
	$z=$data[0];$plevels=$data[1];
	for ($a=0;$a<count ($z);$a++) {
		$z[$a]=${"z".$a};//ïðèíèìàåì äàííûå þçåðà
		$p[$a]=${"p".$a};//ïðèíèìàåì äàííûå þçåðà
		}
	$values=implode ($z,"¦");if ($OSTYPE=="WINDOWS") $values.="\n"; //if ($OSTYPE=="LINUX") $values.="\r\n";//LINUX FIX  à â âèíäå îíî íå ðàáîòàåò çà÷åì âîîáùå \n?
	$plevels=implode ($p,"¦");if ($OSTYPE=="WINDOWS") $plevels.="\n"; //if ($OSTYPE=="LINUX") $plevels.="\r\n";//LINUX FIX  - ÷å ïðàâäà ðàáîòàåò??files.cfg íå ïðèíèìàåò..âèäèìî íå ñîâïàäàåò òî òî. õåðíÿ - ïîïðàâëÿåì äëÿ ðàáîòû ñ êîíôèãóðàöèåé
	$a="";
	while (!feof($f))
	{ @$a.=fread ($f,10000); //echo $a;
   };
   fclose ($f);
   	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"w","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"w","0");
	fwrite ($f,$values);
	fwrite ($f,$plevels);
	fwrite ($f,$a);
	fclose ($f);
	if ($pr[12]) {$act="HEADER_DAT $tbl to $values"; logwrite ($act) ;};
}

//=========================================


//ìîäóëü îáðàáîòêè - ïðîñòîå êîïèðîâàíèå òàáëèöû âíóòðü áàçû dbscript
if ($write==cmsg ("WF_ARCH")) {
	if ($codekey==7) demo ();
	$dir="_data/"; if ($cfgmod==1) $dir="_conf/";
@$f=csvopen ($dir.$filbas.".backup.dat","delete",0);  //backup module
@$f=csvopen ($dir.$filbas,"copy",$dir.$filbas.".backup.dat");//backup module
@$f=csvopen ($dir.$filbas,"copy",$dir.$filbas.".backup".date ("m.d.y H-i-s").".dat");//backup module
if ($prdbdata[$tbl][12]!="fdb") {
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	readdescripters ();
	backupsql($connect,$prdbdata,$tbl);
	};   // ñîõðàíåíèå äëÿ SQL â îòäåëüíîé áàçå áýêàï
	if ($pr[12]) {$act="Backup created B $tbl"; logwrite ($act) ;};
}
//=========================================
//ìîäóëü îáðàáîòêè - ïðîñòîå âîññòàíîâëåíèå òàáëèöû èç áàçû dbscript
if ($write==cmsg ("WF_UNARCH")) {
	$dir="_data/"; if ($cfgmod==1) $dir="_conf/";
@$f=csvopen ($dir.$filbas,"delete",0);  //backup module
@$f=csvopen ($dir.$filbas.".backup.dat","copy",$dir.$filbas);//backup module
if ($prdbdata[$tbl][12]!="fdb") {
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	readdescripters ();
	restoresql($connect,$prdbdata,$tbl);
	};
	if ($pr[12]) {$act="Backup created B $tbl"; logwrite ($act) ;};
}


//=========================================
//ìîäóëü çàïóñêà
if ($write==cmsg ("KEY_COMM")) {
	if ($scrcolumn=="") {lprint ("NO_COMM_SYST");exit;}
	if (($prdbdata[$tbl][12]=="fdb")) {
			if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
			if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");
			//	echo "dEBUG vID2=$vID2 virtualid=$virtualid<br>";
			echo "<br>";
			$data=readdescripters ();  if ($data==-1) exit;
			$mycol=xfgetcsv ($f,$xfgetlimit,"¦");// $z to mycol  other $z is dupl and changed to myrow
			if ($vID2==="") { while ($myrow[$md2column]!==$vID) {
									$myrow=xfgetcsv ($f,$xfgetlimit,"¦");
										if ($myrow===false) { break;};
										};
									};
				if ($vID2!=="") {
					for ($a=0;$myrow=xfgetcsv ($f,$xfgetlimit,"¦");$a++) {
						if ($vID!=="") $findid=strpos ($myrow[$md2column],$vID);
							if ($vID2!=="") $findid2=strpos ($myrow[$virtualid],$vID2);//mod-add for corr if
									if (($myrow[$md2column]===$vID)AND($myrow[$virtualid]===$vID2)) break;
											//$myrow=xfgetcsv ($f,$xfgetlimit,";");
									};
											};
				@$crc=implode ("¦",$myrow);//added crc32 count
				//ïðîâåðêà íå çàíÿò ëè ID
			if ($myrow===false) {
				echo cmsg ("QUE_EMP")."<br>";
				exit;
			}

	}
	if (($prdbdata[$tbl][12]!="fdb")) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;

	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
	//ïðîâåðêà íå çàíÿò ëè ID
	if ($myrow===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrow)));
		}
$commmsg=$myrow[$scrcolumn];

$scrdir="_local/scrcomm/".$scrdir;
$comfile=$scrdir."/".$commmsg.".txt"; // ýòî îáõîä îïðîñà â áàçå ñîäåðæèìîãî êîëîíêè Êîëîíêà êàðòèí

$imgfile=$scrdir."/".$commmsg."$formatscr"; // òàêñ  èç r.php âçÿò êîä ïðîâåðêè êàðòèíêè.
@$wrimg = fopen ($imgfile,"r");
if (!$wrimg) if (($needscr==true)AND($formatscr)) { echo "Image enabled<br>";};
if ($wrimg) if (($needscr==true)AND($formatscr)) {
    //$scr=
    $scr=$imgfile;//  WARNING   -  ìîæíî þçàòü äëÿ çàïèñè!
                 echo "Miniimage<a href=\"$scr\"><img src=\"$scr\" border=0 height=80 width=60></a>";
}

@$opend=opendir ($scrdir);
if ($opend==true) { echo "";} else {
	$wr=mkdir ($scrdir);
	if ($wr==true) { echo "";} else {lprint ("FS_NEWDIR");};
	};
@ $wr = fopen ($comfile,"r");
if ($wr==true) {$vd=fread ($wr,10000);} else { lprint ("FS_NEWFILE"); };
//echo "scrdir=$scrdir comfile=$comfile";
echo " </form>"; // äàæå èñöåëåíèå ýòîãî íåäóãà íå ïîìîãàåò ñîõðàíèòü ôàéë :(

lprint ("COMMSG");echo " (Obj ".$commmsg." Col $scrcolumn)";
//<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		//<input type="hidden" name="max_file_size" value="10000000">
?> :	<form enctype="multipart/form-data" action="w.php" method=post>
	<textarea name=vd cols=75 rows=10 ><?php print $vd; ?></textarea>
        <input name=userfile type=file class=buttonS>
<?php 	hidekey ("tbl",$tbl);
	hidekey ("commmsg",$commmsg);
	hidekey ("vID",$vID);
        echo "<br>";
        checkboxcorrect ("delcom",$delcom); lprint ("DELCOM");
        checkboxcorrect ("delscr",$delscr); lprint ("DELSCR");echo "<br>";
	submitkey ("write","KEY_S_COMM");
	echo " </form>";exit;
}

  // çàïèñü ôàéëà íà ñåðâåð. áåñïîëåçíî óêàçûâàòü àäðåñàò php èáî äàííûå âñå ðàâíî ïîòåðÿþòñÿ
//ìîäóëü  îáðàáîòêè
 if ($write==cmsg("KEY_S_COMM"))  {
 	//echo "!!!!";
 	if ($codekey==4) needupgrade ();
	global $scrdir,$go;
	$scrdir="_local/scrcomm/".$scrdir;
	//testzone upload file	// Çàãðóçêà ôàéëîâ íà ñåðâåð// Åñëè upload ôàéëà

	//comment write
 	if (!$vd) echo "Íå ïåðåäàí êîììåíòàðèé.Èçìåíåíèÿ íå ñäåëàíû.";
	if ($vd) {$vd=stripslashes($vd); // íåñêîëüêî óìåíüøåíî ðàçìíîæåíèå êîñûõ
	@$wr = fopen ($scrdir."/".$commmsg.".txt","w+");
	$act="COMMEDIT $comfile";
	@fwrite ($wr,$vd);fclose ($wr);
        if ($wr==true) { lprint ("FS_WR_OK");echo ".<br>";} else { 	$errt=cmsg ("FS_ERR"); $ermsg=cmsg ("FS_NODIR");	};
        if ($pr[12]) { logwrite ($act) ;	};  // ëîãèðóåìñÿ
        }
        print_r($_FILES);echo "!!!!!";	//wf_uploadingpic ($scrdir."/",$vID.".jpg");
        if (1==1) {
                        $uploaddir= "_local/scrcomm/".$prdbdata[$tbl][0]."scr";
                        $scrfullpathname=$uploaddir."/".$commmsg.$formatscr;
        if (isset($_FILES)) { $file=1; } else {$file=-1 ;};
echo "_FILES STATE: $file<br>";
		@$tempsize=getimagesize ($_FILES["userfile"]["tmp_name"]) ;
		@$size=filesize ($_FILES["userfile"]["tmp_name"]);
                //echo "scrdir: $scrdir<br>";
		if ($size==0) $file=0;
		if ($file==1) { //ôàéë åñòü , ïðåäïðèíèìàåì ìåðû

            		if (!$tempsize) {  echo "Ýòî íå êàðòèíêà ! Ôàéë íå áûë ñîõðàíåí. <br>";exit ;} // òîæå 0 ïðè >64k
        		if ($size>900000) { echo "Ïðåâûøåí hardcoded ëèìèò â 900Êá";exit;}; //CFG OPT FUTURE  TODO:
                        echo "Êóäà:".$uploaddir."/ File:".$commmsg.$formatscr."<br>";
                        echo "fullpathname=$scrfullpathname<br>";
                        unlink ($scrfullpathname);
                        $error=uploadfile ($uploaddir."/",$commmsg.$formatscr); //ïî÷åìó !!!?? Çàëèòü íå óäàëîñü
                        die ("Aaaaaaaaaaa");
                        if ($error) { ob_clean ();lprint ("FS_FWR"); } else { ob_clean ();lprint ("FS_FWRFAIL"); }
                        echo $uploaddir."/",$commmsg.".jpg";
                        echo "Îí áûë óñïåøíûì þçåðíåéìîì íà ÓÏÿ÷êå!<br>";
            		}
    }
//end of upload//....        if($error==false) echo "Ñëèâ íå çàñ÷èòàí";	//end comment write
if ($delcom){$x=unlink ($scrdir."/".$commmsg.".txt");echo $x;};
if ($delscr){$x=unlink ($scrfullpathname);echo $x;};
        exit;
 }




//endcomm



// -----------------------------------------------------------------
//MYSQL SECTION
//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_VIEW"))AND($prdbdata[$tbl][12]!="fdb")) {
	if ($vID==false)
{
  msgexiterror ("needcode",$mode,"w.php");
}
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
	global $query,$connect;
	global $mzdata,$mycols,$myrow;
	global $findrecords,$scrcolumn;

echo cmsg ("WF_RF1").":<br>";
	$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
if (($virtualid>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	selectedprintsql ($data);

if (($prauth[$ADM][17])>0) {
	echo cmsg ("WF_RF2").":<br>";
	$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE (".$mycol[$md2column]." LIKE '%".$vID."%'";
	$query=$query." && ".$mycol[$md2column]." != '".$vID."')";
//if (($virtualid>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$virtualid]."LIKE '".$vID2."'";};
	selectedprintsql ($data);

	}




if ((($prauth[$ADM][18])>0)AND($noaddmode==1)) {
	echo cmsg ("WF_CMPALL")."<br>";
	$mode=6; $presettedmode=3;
	global $presettedmode,$categorymode,$m6field,$m6count,$mode,$fields;//äåêîäèðîâàíèå ñòðîêè
	global $selectedfield,$multisearch;
	 //from readfile part  small ïðåîáðàçîâàíî
	 	global $categorymode,$mode;
	global $mode6,$m6field,$m6count; // $m6count; - kakogo hera ne peredan
	global $mycols,$mycol,$del,$res16,$presettedmode,$selectedfield;
	global $partquery,$vID,$fields,$multisearch;

	if (($mode == 6)AND($prdbdata[$tbl][12]!="fdb")) {
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$res16=$prdbdata[$tbl][16];// Ëèìèò êîëîíîê
	//äåêîäèðîâàíèå ñòðîêè
prefixdecode ($indata);
		dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		global $mzdata; //$mycol[$md1column]".."
$mode6=array ();
decodecols ();
	$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE (".$partquery ;
	$query=$query.") AND `".$mycol[$md2column]."` NOT LIKE '%".$vID."%'";
//	echo $query;
//if ($virtualid==1) { $query = $query." AND ".$mycol[$virtualid]."= '".$vID2."'";};
//áåñïîëåçíî èáî ñðàâíèâàåòñÿ ñ ëþáûì ïîëåì, åñëè òîëüêî ïåðåïèñàòü ñ ó÷åòîì 2 ïîëåé öåëóþ ôóíêöèþ
	$result = dbs_query ($query,$connect,$dbtype);
//	echo "mycols $mycols mz  $mzdata[1]";
selectedprintsql ($data);
	if ($multisearch==0) {exit (1); }
}
}
}

 //from readfile partends
//=========================================
//ìîäóëü çàïóñêà è îáðàáîòêè
if (($write==cmsg("KEY_AN"))AND($prdbdata[$tbl][12]!="fdb")) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
	//ôóíêöèÿ ïîäñ÷åòà çíà÷åíèé â òàáëèöå
	if ($data==-1) exit;

	echo "<br>";// $mycol[$md2column]<br>";
	$maxquery="SELECT MAX(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$countquery="SELECT Count(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$result=dbs_query ($countquery,$connect,$dbtype);	$counttbl = dbs_fetch_row ($result,$dbtype);
	$result = dbs_query ($maxquery,$connect,$dbtype);;	$maxtbl = dbs_fetch_row ($result,$dbtype);
     	//	ðàñïå÷àòêà äàííûõ èç äåñêðèïòîðîâ
 echo "<table id=execsql border=3 width=100% bordercolor=#000099 ><tr>";
 echo "<td>headerreal</td><td>plevels</td><td>headerrealnumbers</td><td>headervirtual</td><td>datatypos</td><td>fieldlen</td></tr><tr>";
	for ($a=0;$a<count ($data[0]);$a++)	{
		for ($b=0;$b<6;$b++) {  echo "<td><bb>$b</bb>:".$data[$b][$a]."</td>";	} echo "</tr><tr>";
	}
echo "</tr></table>";
// echo "mycols ñîîáùåííûé rdesc ".$data[6]."!<br>";
	echo cmsg ("WF_AN_ALLDAT")." ".$counttbl[0].", ".cmsg ("WF_LASTW")." ".$maxtbl[0]."<br>";
	@$pl=round (($counttbl[0]/$maxtbl[0])*100,5);
	echo cmsg ("WF_LDED")." = $pl% <br>";
	//îêîí÷àíèå ïîäñò÷åòîâ  [EXTEND ] nowork
?>			</form><form action="w.php" >
<?php submitkey ("go","KEY_REPAIR");
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","REPAIR TABLE `".$prdbdata[$tbl][5]."`;");
echo "</form>";
?>
	<form action="w.php" >
<?php submitkey ("go","KEY_CHECK");
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","CHECK TABLE `".$prdbdata[$tbl][5]."`;");
echo "</form>";
?>
<form action="w.php" >
<?php submitkey ("go","KEY_OPT");
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","OPTIMIZE TABLE `".$prdbdata[$tbl][5]."`;");
echo "</form>";
?>
	<form action="w.php" >
 <?php submitkey ("go","A_SQLRES");
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","SHOW PROCESSLIST ;");
echo "</form>";?>
<form action="w.php" >
 <?submitkey ("go","A_SQLCFG");
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","SHOW VARIABLES ;");
echo "</form>";
?><form action="w.php" >
 <?php submitkey ("go","SQLSPST");
 hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","SHOW PROCEDURE STATUS ;");
echo "</form>";

?><form action="w.php" >
 <?submitkey ("go","SQLSFST");
 hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","SHOW FUNCTION STATUS ;");
echo "</form>";

}
//=========================================




//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_DATA"))AND($prdbdata[$tbl][12]!="fdb")) {
	if ($vID==="") { lprint ("WF_FSELID")."<br>"; exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;
		//datafieldcolsel ýòî No# êîëîíêè ñ data ïåðåäàííûé èç ïîèñêà
	$datacols=explode (",",$prdbdata[$tbl][18]);
	$datafilehdr=explode (",",$prdbdata[$tbl][19]);
	$datasplitters=explode (",",$prdbdata[$tbl][20]);
      //..  ýòî ìåíþ ïîêàç ïî êíîïêå DATA
        if ($datasplitters[$datafieldID]=="SPC") { $datasplitters[$datafieldID]=" "; echo "SPACE applied<br>";};
	echo " DATALIST ".$prdbdata[$tbl][18].";  SEARCH COLUMN $datafieldcolsel <br>";
for ($a=0;$a<count ($datacols);$a++) {
	//echo "a=".$datacols[$a]." dcs=$datafieldcolsel<br>";
	if ($datacols[$a]==$datafieldcolsel) $datafieldID=$a;
}  //datafieldID - ýòî íîìåð àêòèâíîé DATA èç ñïèñêà â áàçàõ àäìèíêà , no field number !
echo "ebanyj splitter 2= ".$datasplitters[$datafieldID]."<br>";
 if ($datasplitters[$datafieldID]=="SPC") { $datasplitters[$datafieldID]=" "; echo "SPACE applied<br>";};
echo "ebanyj splitter 1= ".$datasplitters[$datafieldID]."<br>";
	echo "type:DATA table:".$prdbdata[$tbl][5]." column:".$mycol[$datafieldcolsel]." (No $datafieldcolsel) datafieldID=$datafieldID separator:".$datasplitters[$datafieldID]." (SPC)<br>";
	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
	//prepare new data
	@$g=csvopen ("_data/".$datafilehdr[$datafieldID],"r",0); //õåäåð è ñïëèòòåð ïîêà âñåãäà áóäóò ïåðâûå ,óïðîùåíî!!! CFG OPT FUT
	@$mycoldat=fread ($g,1000);
	if (!$g) echo "Failed check headers DATA ,file _data/".$datafilehdr[$datafieldID]."<br>";
	@fclose ($g);
	$myrowdat=explode ($datasplitters[$datafieldID],$myrow[$datafieldcolsel]); //ýòî íàøå dATA
			//for ($a=0;$a<$mycols;$a++) 			{ 			}
	$mycolsdat=count ($myrowdat);
	//$mycol=$mycoldat;$mycols=$mycolsdat; $myrow=$myrowdat;  //TEMP!!!

	//$mycol äîëæåí òóò ïîëó÷èòü ñîäåðæèìîå DATA  $myrow - ñîäåðæèìîå çàãîëîâêà
	//ïðîâåðêà íå çàíÿò ëè ID
	if ($myrowdat===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrowdat))); //ïîc÷òèòàë óæå myrowdat ))
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
		for ($a=0;$a<$mycolsdat;$a++)
			{
			echo "$mycoldat[$a] ($a)";
					if ($a===0) { $values="'".$myrowdat[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrowdat[$a]; }	//self-control
			?>
			<textarea name=z<?=$a; ?> cols=40 rows=1><?=$myrowdat[$a]?></textarea><br><?php ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$mycolsdat;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycoldat[$a] ";
		$lensa=strlen ($myrowdat[$a])+2;// CFG OPT FUTURE  TODO:
		if ($lensa>50) $lensa=50;
					if ($a===0) { $values="'".$myrowdat[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrowdat[$a]; }	//self-control
			?>			</td>
			<?php if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrowdat[$a]?></textarea><br></td><?php 			} //field text

			echo "</table>";
	}

checkbox ($crcignore,"crcignore"); lprint ("WF_NOCRC");echo "<br>";
hidekey ("crc",$crc);
hidekey ("origid1",$myrowdat[$md2column]);
hidekey ("origid2",$myrowdat[$virtualid]);
hidekey ("datafieldcolsel",$datafieldcolsel);
hidekey ("datafieldname",$mycoldat[$datafieldcolsel]);
hidekey ("datafieldID",$datafieldID);
checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";

submitkey ("write","KEY_S_DATA");echo "<br>";
}


//==========================
//=========================================
//ìîäóëü  îáðàáîòêè
if (($write==cmsg("KEY_S_DATA"))AND($prdbdata[$tbl][12]!="fdb")) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
	//datafieldcolsel ýòî No# êîëîíêè ñ data ïåðåäàííûé èç ïîèñêà
	$datacols=explode (",",$prdbdata[$tbl][18]);
	$datafilehdr=explode (",",$prdbdata[$tbl][19]);
	$datasplitters=explode (",",$prdbdata[$tbl][20]);
        echo "count datacols=".count ($datacols)." original ".$prdbdata[$tbl][18]."<br>";
/*for ($a=0;$a<count ($datacols);$a++) { // ñöóêî íå íàõîäèò $datafieldID
	echo " ($a==$datafieldcolsel) (a=datafieldcolsel)<br>";
	if ($a==$datafieldcolsel) $datafieldID=$a;
}
*/ //datafieldID - ýòî íîìåð àêòèâíîé DATA èç ñïèñêà â áàçàõ àäìèíêà
IF ($datafieldID===false) echo "datafieldID FALSE!!!! procedure will fail!!<br>";
IF ($datafieldID==0) $datafieldID=0;
echo "!@!!!!!!!!!!!123!!!!!!!!!!!!! separator:".$datasplitters[$datafieldID].""; // ýòî ìåíþ ïîêàçûâàåòñÿ íå ïî êíîïêå DATA
if ($datasplitters[$datafieldID]==="SPC") { $datasplitters[$datafieldID]=" "; echo "SPACE applied<br>";};

echo "type:DATA table:".$prdbdata[$tbl][5]." column:".$mycol[$datafieldcolsel]." (No $datafieldcolsel) datafieldID=$datafieldID separator:".$datasplitters[$datafieldID]." (SPC)<br>";
echo "crc code given:$crc<br>";
// äàëüøå â íåêîòîðûõ ìåñòàõ SQL ñêðèïòà íàäî ïîìåíÿòü äàòàèä íà èìÿ ïîëÿ  ($mycol[$datafieldcolsel) - ÷òî áû çíà÷èë ýòîò êîììåíò (2009.12)
echo "origid1=$origid1<BR>";//,$myrowdat[$md2column]);
echo "origid2=$origid2<BR>";//,$myrowdat[$virtualid]);
echo "datafieldcolsel=$datafieldcolsel<BR>";//,$datafieldcolsel);
echo "datafieldname=$datafieldname<BR>";//$mycoldat[$datafieldcolsel]);
echo "datafieldID=$datafieldID<BR>";//$datafieldID);"
// $myrow[$md2column]."'"; - ÏÎÒÅÐßÍ !!! ÏÎ×ÅÌÓ  , ÊÀÊÎÃÎ !!!!  12.2009 SELECT 'taximask' FROM `characters` WHERE guid= ''  --- MYROW ÏÎÕÎÄÓ ÏÓÑÒÎÉ ÔÎÐÌÈÐÓÅÒÑß
	// çàìåíåí vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid]
// ñáîðêà âñåõ ïåðåìåííûõ â values è myrow[]
	for ($a=0;$a<$mycolsdat;$a++)	{
	$myrowdat[$a]=${"z".$a};
        echo 'check='.$myrowdat[$a];
	if ($a===0) { $values=$myrowdat[$a];}
	if ($a>0) {$values="".$values.$datasplitters[$datafieldID].$myrowdat[$a]; }
			}
// ñáîðêà âñåõ ïåðåìåííûõ â values è myrow[]
        ECHO "values=$values<br>";
	//ïðîâåðêà ñòàðûõ äàííûõ äëÿ CRC i UnDO / ïðîâåðèòü íàäî òîëüêî ÄÀÒÀ!!
	$cmd="SELECT '".$mycol[$datafieldcolsel]."' FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$myrow[$md2column]."'";
	if ($virtualid==true) { $addcmd=" AND ".$mycoldat[$virtualid]."= '".$myrow[$virtualid]."'"; $cmd.=$addcmd;};
	$result = dbs_query ($cmd, $connect,$dbtype);
	echo "cmd=$cmd, result=$result <br>";
	$myrowold = dbs_fetch_row ($result,$dbtype);
	if ($myrowold==false) {lprint ("WF_EDITNOTADD");echo "<br>";
	/*//ïðîöåäóðà undo ñòàðîãî ID ñîõðàíèòü íàäî òîëüêî ÄÀÒÀ!!!
		$cmd="SELECT '".$mycol[$datafieldcolsel]."' FROM `".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
		if ($virtualid==true) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$origid2."'";};
		$result=dbs_query ($cmd,$connect,$dbtype);;
		echo "cmd=$cmd, result=$result <br>";
		$myrowold=dbs_fetch_row ($result,$dbtype); // òóò false åñëè òî çíà÷èò ïïö :)
		*/
	} // 2 ðàçà ïðîâåðÿåò îäíî çíà÷åíèå â áàçå òîëüêî ðàçíûìè ìåòîäàìè.
	// nen íàäî ïðîñòî ñâåðèòü data â undo   è çàïèñàòü íîâîå çíà÷åíèå.
	@$olddata=implode ($datasplitters[$datafieldID],$result); // âîò ýòî è íàäî ñîõðàíÿòü è îòêàòûâàòü
	$undodata="UPDATE `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` SET `".$mycol[$datafieldcolsel]."`='".$myrowold."');";
	if (!$crcignore) {
				@$crcnew=crc32(trim($olddata));
				echo "crcnew =$crcnew<br>";
				if ($myrowold!==false) if ($crcnew!=$crc) {lprint ("WF_CRCFAIL"); exit;} ;}; //crc32testfunction
	// ñòàðîå óñëîâèå äî 3.2.6 ++ $mycol[$md2column]."='".$vID."'";
	// îïÿòü âîçìîæíàÿ îøèáêà  - íåîáÿçàòåëüíî 0 ÿâëÿåòñÿ êëþ÷îì
	echo "data for check : myrowold=$olddata '".$myrowold."'<br>";
	echo "data for chk: values=$values <br>";
	$cmd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$datafieldcolsel]."`='".$values."');";
	$a=dbs_query ($cmd,$connect,$dbtype);  // óñëîâèå îáíîâëåíî
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($views) {echo cmsg ("WF_EXQUE")."$cmd<br>"; } else { echo cmsg ("WF_ADDFAIL")."$myrow[0]<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_UPDOK")."!<br>";} else {
		$errt=cmsg ("WF_UPDFAIL"); $ermsg="$myrow[0]<br>";}
	if ($pr[12]) {$act="EDIT_SQL_TYPE_DATA  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;undolog ($act,$undodata); };
	//CFG OPT FUTURE  TODO: - some action like backup not logging!!!!
	//if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// ïèøåò îøèáêó è åå êîä  è åãî æå âîçâðàùàåò
//endof executing
submitkey ("write","WF_UNDO_LAST");
}

//end KEY_S_DATA



//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_EDIT"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	if ($vID==="") { lprint ("WF_FSELID")."<br>"; exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;
                $mycolvirtualname=$data[3]; if (strlen ($mycolvirtualname[0])<1) $mycolvirtualname=$mycol;
if ($prdbdata[$tbl][18]) {//dly redaktirowainya data
	echo "pdb18 ".$prdbdata[$tbl][18];
	$datacols=explode (",",$prdbdata[$tbl][18]);
$datafilehdr=explode (",",$prdbdata[$tbl][19]);
$datasplitters=explode (",",$prdbdata[$tbl][20]);
///echo "datacol ".$datacols[0]."filehdr ".$datafilehdr[0]."  datasplit ".$datasplitters[0]."<br>";

}
if ($prdbdata[$tbl][22]) $directedit=1;
 if (!$directedit) {
	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
            //exec reselect  â ñëó÷àå íåïðàâèëüíî óñòàíîâëåííîãî id2 íàäî åãî ñáðîñèòü, â ñëó÷àå íàëè÷èÿ ïðàâèëüíûõ îáîèõ ïîïûòàòüñÿ îòðåäàêòèðîâàòü äàííûå äðóãèì ìåòîäîì
            //ïîòîì äîäåëàòü update - replace   ýòî ìîæíî â ïðèíöèïå è äëÿ csv ñäåëàòü
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
            }
            //exec reselect
         }
 if ($directedit) {
             if ($directedit==2) $vID=base64_decode ($vID);
             $decodeddata=explode ("^^",$vID);
            //echo "bldjad  DIRECT EDIT BLYA!!";
                   $directeditwhere=gensqldirecteditwhere ($mycol,$decodeddata,$mycols);
                    $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE $directeditwhere ";
		     $result = dbs_query ($cmd, $connect,$dbtype);
                    $myrow = dbs_fetch_row ($result,$dbtype);
               //     echo $cmd;
 }
	//ïðîâåðêà íå çàíÿò ëè ID
	if ($myrow===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrow)));
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
		for ($a=0;$a<$mycols;$a++)
			{
			echo "$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii>(ID1)</ii>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			if ($prdbdata[$tbl][18]) for ($b=0;$b<count ($datacols);$b++) { $fil=$tbl.";".$myrow[$md2column].";;".$datacols[$b]."";
				if ($a==$datacols[$b]) {echo "<a href='w.php?cmd=dat&fil=$fil'><img src='_ico/linked_table-yn.png' border=0 title='".cmsg ("KEY_HEAD")."'></a>";}
			} //redaktirowanie data

					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
			?>
			<textarea name=z<?=$a; ?> cols=40 rows=1><?=$myrow[$a]?></textarea><br><?php ;
			}
	if (!$oldcoreedit) { //  â ýòîì ìåñòå ïðîèñõ. èíèö. ãåíåðàö òàáëèöû äëÿ dbmgr_ðåäàêòîðà  òîëüêî äëÿ íîâîãî è âåðòèêàëüíîãî ñòèëåé !! êîïèðîâàòü èçìåíåíèÿ îòñþäà!
		echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";//èçìåíåíèå óòâåðæäåíî íåïîëíîñòüþ.åñëè ðåäàêòèðîâàòü òî óæ ñðàçó âñå <table> à íå îäíó.à òî îíè âñå ñòàíóò ðàçíûå.
		for ($a=0;$a<$mycols;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.   GMP_41;Ðåäàêòîð, âåðòèêàëü èíòåðôåéñ  èç lang/russian.cfg
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";

		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE  TODO:
		if ($lensa>50) $lensa=50;
                if ($prdbdata[$tbl][18]) for ($b=0;$b<count ($datacols);$b++) { $fil=$tbl.";".$myrow[$md2column].";;".$datacols[$b]."";
				if ($a==$datacols[$b]) {echo "<a href='w.php?cmd=dat&fil=$fil'><img src='_ico/linked_table-yn.png' border=0 title='".cmsg ("KEY_HEAD")."'></a>";}
			} //redaktirowanie data

					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
			?>			</td>
			<?php if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrow[$a]?></textarea><br></td><?php 			//echo "<tr>";//optionalBox,not linear edit.  èìÿ ID äîëæíî áûòü êàê ìîæíî êîðî÷å, ò.ê. ýëåìåíòîâ ìîãóò áûòü 1000è
			// äîáàâèòü ïîòîì ñþäà trafeconom mode  ïîïðàâëþ ïîçæå äðóãèå ñòèëè àíàëîãè÷íî ýòîìó.

			} //field text

			echo "</table>"; // êîíåö ãåíåðàòîðó òàáëèöû äëÿ dbmgr_edit
	}
	// ïðîâåðêà çàìîðîçêè
	$values=$values."'";
	$cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values);";
				@$afile="_conf/autoexec.sql";
				$f=fopen ($afile,"r");
				if ($f==false) { @$wr=fopen ($afile,"w+"); echo "File created";$f=fopen ($afile,"r");}
				while ($checkcmd=@fgets ($f)) {
				$findcmd=strpos ($checkcmd,$cmd);
				if ($findcmd!==false) { $frozen=1; };
				}
				fclose ($f);
	// îêîí÷àíèå ïðîâåðêè çàìîðîçêè

checkbox ($crcignore,"crcignore"); lprint ("WF_NOCRC");echo "<br>";
hidekey ("crc",$crc);
checkbox ($dbgid,"dbgid"); echo cmsg ("DBG_ID")."<br>";
hidekey ("origid1",$myrow[$md2column]);
hidekey ("origid2",$myrow[$virtualid]);
checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";

if ($prauth[$ADM][33]) if (!$frozen) { checkbox ($enfreez,"enfreez");echo "<red>".cmsg ("KEY_S_FREEZE");echo "</red><br>";};
if ($frozen) {hidekey ("frozen",$frozen); echo "<blu>".cmsg ("KEY_FRZD")."</blu><br>";
if ($prauth[$ADM][33]) {checkbox ($unfreez,"unfreez");echo cmsg ("KEY_S_UNFREEZE");echo "<br>";}
};
submitkey ("write","KEY_S_EDIT");echo "<br>";

}


//=========================================
//ìîäóëü  îáðàáîòêè
if (($write==cmsg("KEY_S_EDIT"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
	// çàìåíåí vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid]
// ñáîðêà âñåõ ïåðåìåííûõ â values è myrow[]
		for ($a=0;$a<$mycols;$a++)	{
	$myrow[$a]=${"z".$a};
	if ($a===0) { $values="'".$myrow[$a];}
	if ($a>0) {$values="".$values."','".$myrow[$a]; }
			}
			$values=$values."'";
// ñáîðêà âñåõ ïåðåìåííûõ â values è myrow[]
// íà÷àëî ðàçìîðîçêè åñëè âêë
if ($unfreez) {
	$cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values); #".$prauth[$ADM][0];
				$afile="_conf/autoexec.sql";
				$afilenew="_conf/autoexec.tmp";
				@$f=fopen ($afile,"r");
				$fw=fopen ($afilenew,"w");
				while ($checkcmd=@fgets ($f)) {
		//	$lencheck=strlen ($checkcmd);
				$findcmd=strpos ($checkcmd,$cmd);
				if ($findcmd!==false) { $unfrozen=1;echo"";} else { fwrite ($fw,$checkcmd);};
				}
				fclose ($f);fclose ($fw);
				if ($unfrozen) { unlink ($afile);rename ($afilenew,$afile);};
				if (!$unfrozen)echo "<red>".lprint ("FROZ_OTH_USR")."</red><br>";
				// ìîæåò ýòó ïðîöåäóðó òîæå êàê òî ñòàíäàðòèçèðîâàòü?
}
//êîíåö ðàçìîðîçêè åñëè âêë
if ($dbgid) { echo "old editing<br>";
    $printid1=$myrow[$md2column];
    $printid2=$myrow[$virtualid];
}
if (!$dbgid) { //echo "oldcore editing<br>";
    $printid1=$origid1;
    $printid2=$origid2;
}
//
if ($prdbdata[$tbl][22]) $directedit=1;
 if (!$directedit) {
	//ïðîâåðêà ñòàðûõ äàííûõ äëÿ CRC i UnDO
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$printid1."'";
	if ($virtualid==true) { $addcmd=" AND ".$mycol[$virtualid]."= '".$printid2."'"; $cmd.=$addcmd;};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrowold = dbs_fetch_row ($result,$dbtype);
                    //exec reselect  â ñëó÷àå íåïðàâèëüíî óñòàíîâëåííîãî id2 íàäî åãî ñáðîñèòü, â ñëó÷àå íàëè÷èÿ ïðàâèëüíûõ îáîèõ ïîïûòàòüñÿ îòðåäàêòèðîâàòü äàííûå äðóãèì ìåòîäîì
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$printid1."'";
		if (($virtualid)AND ($vID2!=="")) {  $addcmd=" AND ".$mycol[$virtualid]."= '".$printid2."'";$cmd.=$addcmd;};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrowold = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) { $directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
            }
            //exec reselect
 }
  if ($directedit) {
             if ($directedit==2) $vID=base64_decode ($vID);
             $decodeddata=explode ("^^",$vID);

 }
        if ($myrowold==false) {
	//ïðîöåäóðà undo ñòàðîãî ID
      $directeditwhere=gensqldirecteditwhere ($mycol,$decodeddata,$mycols);
	if (!$directedit) {$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
		if ($virtualid==true) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$origid2."'";};
                }
	if ($directedit) {$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  $directeditwhere ";};
                }
		$result=dbs_query ($cmd,$connect,$dbtype);;
		$myrowold=dbs_fetch_row ($result,$dbtype); // òóò false åñëè òî çíà÷èò ïïö :)

	@$olddata=implode (";",$myrowold); // âîò ýòî è íàäî ñîõðàíÿòü è îòêàòûâàòü
        //echo "checking myrowold= $myrowold ".count ($myrowold)." = $olddata<br>";
        if ($myrowold) {$update=1; }else { lprint ("WF_EDITNOTADD");echo "<br>";} // !$directedit
	if (!$update){// $undodata=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrowold,$mycols,""); // zdes VALUES ('','','','','');
            	   $udirecteditwhere=gensqldirecteditwhere ($mycol,$myrow,$mycols);
      if (!$directedit)     {$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$printid1."'";
	if (($virtualid>0)AND ($vID2!=="")) { $undodata=$undodata." AND ".$mycol[$virtualid]."= '".$printid2."'";}; }
    if ($directedit)     {$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE $udirecteditwhere "; }
        }
        if ($update) {$counterediteddata=0;
            $undodata=gensqlupdate ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$mycol,$myrow,$myrowold);
        }


	if (!$crcignore) {
				@$crcnew=crc32(trim($olddata));
                                //echo " $crcnew=$crc <br>";  //F1_KEY_S_EDIT
				if ($myrowold!==false) if ($crcnew!=$crc) {lprint ("WF_CRCFAIL"); exit;} ;}; //crc32testfunction

	// ñòàðîå óñëîâèå äî 3.2.6 ++ $mycol[$md2column]."='".$vID."'";
        //generic update script if myrowold (old data) is present
 //  äëÿ ïðÿìîé ïåðåäà÷è ññûëêè â áóäóùåì ìîæíî ñäåëàòü ïîìåòêó â virtualid=direct  a v vID - ýíêîäèðîâàííûé ìàññèâ

       //if (!$directeditwhere) $directeditwhere="";  ïî ìîåìó íå èìååò ñìûñëà. 120043578+0+255+100147689+1374  id ïåðåäàåòñÿ äèðåêòåäèòîì
 $directeditwhere=gensqldirecteditwhere ($mycol,$myrowold,$mycols);
        if ($update) {

            $counterediteddata=0;
         $updatecmd=gensqlupdate ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$mycol,$myrowold,$myrow);
         /*
            $updatecmd="UPDATE `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` SET ";
            for ($a=0;$a<$mycols;$a++) {

                   gan
        }*/
        if ($counterediteddata<1) { echo "You nothing change.";exit;}
        if (!$directedit){
        $updatecmd.="WHERE  ".$mycol[$md2column]."='".$printid1."'";
	if ($virtualid==true) { $updatecmd.=" AND ".$mycol[$virtualid]."= '".$printid2."'";};
        }
        if ($directedit){
        $updatecmd.="WHERE  ".$directeditwhere;
        }

        if (!$directedit){
        $undodata.="WHERE  ".$mycol[$md2column]."='".$printid1."'";
	if ($virtualid==true) { $undodata.=" AND ".$mycol[$virtualid]."= '".$printid2."'";};
        }
        if ($directedit){  $directeditwhere=gensqldirecteditwhere ($mycol,$myrow,$mycols);
        $undodata.="WHERE  ".$directeditwhere;
        }

        $cmd=$updatecmd;
        //echo "cmd2=$cmd";
        //echo "cmd=$cmd  ";exit;
        $a=dbs_query ($cmd,$connect,$dbtype);//ñäåëàòü ëþáîå êîë-âî
        if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
       dbserr ();// $silent=0;
        }
         // update where old data only new data in cycle  //ïîòîì äîäåëàòü update - replace   ýòî ìîæíî â ïðèíöèïå è äëÿ csv ñäåëàòü
        //end generic update script
        //

//echo $cmd;exit;
if (!$update) {


        if (!$directedit) {
	// îïÿòü âîçìîæíàÿ îøèáêà  - íåîáÿçàòåëüíî 0 ÿâëÿåòñÿ êëþ÷îì
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$myrow[$md2column]."'";
	if ($virtualid==true) {  $cmd.=$addcmd;};

		$cmd2="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
	if ($virtualid==true) { $cmd2=$cmd2." AND ".$mycol[$virtualid]."= '".$origid2."'";}; // ïî èäåå ýòîò íå íóæíåå? íî íèêòî íå æàëîâàëñÿ.
	// ýòî óäàëåíèå ñòàðîãî ID åñëè áûë


	$a=dbs_query ($cmd,$connect,$dbtype);  // óñëîâèå îáíîâëåíî
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}

	$a=dbs_query ($cmd2,$connect,$dbtype);  // óñëîâèå îáíîâëåíî
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}
        }
 //exit;
	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";// èñïîëíÿåòñÿ íà ñàìîì äåëå ýòà


	$a=dbs_query ($cmd,$connect,$dbtype);//ñäåëàòü ëþáîå êîë-âî
       $cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)"; //äëÿ ëîãà ýòà êîìàíäà è äëÿ ôðèçà, íî íå äëÿ èñïîëíåíèÿ.
}
 //echo $cmd;


	if ($enfreez) {
		if (($codekey==9)or($codekey==7)) demo ();
				$afile="_conf/autoexec.sql";		 $autoexeccmd=$cmd."; #".$prauth[$ADM][0]."\r\n";
				$f=fopen ($afile,"a+");
				$a=fwrite ($f,$autoexeccmd);
				if ($a) { echo "<blu>".cmsg ("KEY_FRZD")."</blu><br>";};
				fclose ($f);
				}
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else { echo cmsg ("WF_ADDFAIL")."$myrow[0]<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_UPDOK")."!<br>";} else {
		$errt=cmsg ("WF_UPDFAIL"); $ermsg="$myrow[0]<br>";}
	if (!$errt) if ($pr[12]) {$act="EDIT_SQL  B $tbl($nametbl) Find $vID $vID2 Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
           logwrite ($act) ;undolog ($act,$undodata,$baseID,$hostIP); };
	//if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// ïèøåò îøèáêó è åå êîä  è åãî æå âîçâðàùàåò
if (!$errt) submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//infa  DISTINCT - îòêëþ÷èòü äóáëèêàòû

//=========================================
//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_ADD"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);

	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;
	$mycolvirtualname=$data[3]; if (strlen ($mycolvirtualname[0])<1) $mycolvirtualname=$mycol;
        	$maxquery="SELECT MAX(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$result = dbs_query ($maxquery,$connect,$dbtype);;	$maxtbl = dbs_fetch_row ($result,$dbtype);
	echo cmsg ("WF_1NOTUSED").": ".($maxtbl[0]+1)."<bR>";
        $maximalcntmd2=$maxtbl[0];
 if ($prdbdata[$tbl][22]) $directedit=1;
 if (!$directedit) {
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
                    //exec reselect  â ñëó÷àå íåïðàâèëüíî óñòàíîâëåííîãî id2 íàäî åãî ñáðîñèòü, â ñëó÷àå íàëè÷èÿ ïðàâèëüíûõ îáîèõ ïîïûòàòüñÿ îòðåäàêòèðîâàòü äàííûå äðóãèì ìåòîäîì
            // ðàáîòàåò îòëè÷íî äàæå åñëè íåïðàâèëüíî óêàçàí ID2 ))))
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>".$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
            }
           //exec reselect
         }
 if ($directedit) {
             if ($directedit==2) $vID=base64_decode ($vID);
             $decodeddata=explode ("^^",$vID);
              $directeditwhere=gensqldirecteditwhere ($mycol,$decodeddata,$mycols);

                     $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE $directeditwhere ";
		     $result = dbs_query ($cmd, $connect,$dbtype);
                    $myrow = dbs_fetch_row ($result,$dbtype);
                 //   echo $cmd;
 }
//ïðîâåðêà íå çàíÿò ëè ID
	if ($myrow===false) {
		echo cmsg ("QUE_EMP")."<br>";
		$myrow[$md2column]=$vID;
		if (($virtualid>0)AND ($vID2!=="")) $myrow[$virtualid]=$vID2;
	}
//end ïðîâåðêà íå çàíÿò ëè ID
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
	for ($a=0;$a<$mycols;$a++)
			{
			echo "$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a])  {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=30 rows=1><?=$myrow[$a]?></textarea><br><?php ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$mycols;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a])  {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";

		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE  TODO:
		if ($lensa>50) $lensa=50;
					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
			?>			</td>
			<?if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
			?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrow[$a]?></textarea><br></td><?php 			if ($prauth[$ADM][41]) echo "<tr>";//optionalBox,not linear edit.
		} //field text
		echo "</table>";
	}
			echo "";
   checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
	submitkey ("write","KEY_S_ADD"); echo  "<br>";
}


//=========================================

//ìîäóëü îáðàáîòêè
if (($write==cmsg ("KEY_S_ADD"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
 $directedit=$prdbdata[$tbl][22];
// ñáîðêà âñåõ ïåðåìåííûõ â values è myrow[]
			for ($a=0;$a<$mycols;$a++)
			{
	$myrow[$a]=${"z".$a};
	if ($a===0) { $values="'".$myrow[$a];}
	if ($a>0) {$values="".$values."','".$myrow[$a]; }
			}
			$values=$values."'";
// ñáîðêà âñåõ ïåðåìåííûõ â values è myrow[]
//òóò íàäî áû undo
	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	$a=dbs_query ($cmd,$connect,$dbtype);//ñäåëàòü ëþáîå êîë-âî
	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";	if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else 	{
		$errt=cmsg ("WF_ADDFAIL"); $ermsg="$myrow[0]".cmsg ("WF_ADDPRS")."<br>";}
	   $directeditwhere=gensqldirecteditwhere ($mycol,$myrow,$mycols);

      if (!$directedit)     {$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$myrow[$md2column]."'";
	if (($virtualid>0)AND ($vID2!=="")) { $undodata=$undodata." AND ".$mycol[$virtualid]."= '".$myrow[$virtualid]."'";}; }
    // â âàðèàíòå - if (!$directedit)  - îøèáêà åñëè äîáàâëÿëîñü òîëüêî îäíî çíà÷åíèå èç èä 1
    // vID1 vID2 - íå èñïîëüçóþòñÿ, íóæíî èñïîëüçîâàòü ñîîòâåòâóþùèå ïîëÿ äàííûõ âìåñòî íèõ
    if ($directedit)     {$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE $directeditwhere "; }
	if (!$errt) if ($pr[12]) {$act="ADD_SQL  B $tbl($nametbl) Find $vID $vID2 Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
            logwrite ($act) ; undolog ($act,$undodata,$baseID,$hostIP);}; // ëîãèðóåìñÿ
	 //executing+errlogäåëàåì íîðìàëüíóþ îáðàáîòêó îøèáîê  èñï âñåãäà ýòîò ìîäóëü
	 	     //if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// ïèøåò îøèáêó è åå êîä  è åãî æå âîçâðàùàåò
if (!$errt) submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//=========================================
//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_DEL"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][22]) $directedit=$prdbdata[$tbl][22];
    if (!$directedit) if (($virtualid==true)AND($vID2==false)) echo "<red>".cmsg
		("WF_DEL_GROUP")." ".$vID." </red><br>";
		 if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");

                   if ($vID==="") { lprint ("WF_FSELID");exit;}
                   //çàãðóçîê ïðîâåðîê íå ïðîèçâîäèòñÿ äëÿ óñêîðåíèÿ ðàáîòû, äà è ïðîñòî òàê îáû÷íî óäàëèòü íå íàæèìàþò
                   //íó è õîòü îäíà ôóíêöèÿ áóäåò âìåùàòñÿ â 10 ñòðîê :)))
		submitkey ("write","KEY_S_DEL");
}



//=========================================
//ìîäóëü îáðàáîòêè
if (($write==cmsg("KEY_S_DEL"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;

 if ($prdbdata[$tbl][22]) $directedit=1;
 if (!$directedit) {
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
        for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$test) $test=$myrow[0];
		$undodata.=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols,"")." ";
	};
	// òóò íàäî áû undo     //exec reselect  â ñëó÷àå íåïðàâèëüíî óñòàíîâëåííîãî id2 íàäî åãî ñáðîñèòü, â ñëó÷àå íàëè÷èÿ ïðàâèëüíûõ îáîèõ ïîïûòàòüñÿ îòðåäàêòèðîâàòü äàííûå äðóãèì ìåòîäîì
            // ðàáîòàåò îòëè÷íî äàæå åñëè íåïðàâèëüíî óêàçàí ID2 ))))
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
            }
 //exec reselect
         }
 if ($directedit) {
             if ($directedit==2) $vID=base64_decode ($vID);
             $myrow=explode ("^^",$vID);
              $directeditwhere=gensqldirecteditwhere ($mycol,$myrow,$mycols);
                     $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE $directeditwhere ";
		     $result = dbs_query ($cmd, $connect,$dbtype);
                    $myrow = dbs_fetch_row ($result,$dbtype);
                    if (!$test) $test=$myrow[0];// åñëè åñòü ÷òî óäàëÿòü òåñò âêëþ÷åí
                    $undodata.=gencmdlogi ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols,"")." ";
                //    echo $cmd; çàïèñûâàåì îòñóòñòâóþùèé undolog
 }
    // udal vse bez undo
	$a=$test;
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
         if ($directedit) $cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE $directeditwhere";
	dbs_query ($cmd,$connect,$dbtype);
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($test==true) { echo $vID.cmsg ("WF_DELOK")."!<br>";} else {
				$errt=cmsg ("WF_DELFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";}

  if (!$errt) if ($pr[12]) {$act="DEL_SQL  B $tbl($nametbl) Find $vID $vID2 Cmd $cmd";
       $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];logwrite ($act) ;
     undolog ($act,$undodata,$baseID,$hostIP);
};  //

 //if ($views) cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();
//endof executing

if (!$errt) submitkey ("write","WF_UNDO_LAST");

}











//=========================================
//ìîäóëü çàïóñêà
if (($write==cmsg("KEY_MASEXC"))AND($prdbdata[$tbl][12]!="fdb")) {
		if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
   @ $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
// âûáîð êîëîíêè èç òåêóùåé áàçû
// â êà÷åñòâå ðàçäåëèòåëÿ äëÿ óñëîâèÿ ðàâíî ìîæíî èñïîëüçîâàòü çàïÿòûå
	echo cmsg ("WF_SELFLD").":";// Âñòàâëåíî äëÿ âûáîðà ïîëÿ
//	$ar=$selectedfield;
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a;
	printfield ($data,"nfield");
	//êîíåö âûáîðà êîëîíêè èç òåêóùåé áàçû
  echo "<br>";lprint ("WF_SRCID") ; ?>	<textarea name=sourceid cols= 24 rows=1 ><?=$sourceid; ?></textarea> <?php lprint ("WF_EMPTY") ; ?> <br>
<?php lprint ("WF_EXCHID") ; ?>	<textarea name=exchid cols= 24 rows=1 ><?=$exchid; ?></textarea> <br>
<?php checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
 checkbox ($wfemptyenab,"wfemptyenab") ;echo cmsg ("WF_EMP_EN")."<br>";
   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
 if ($prauth[$ADM][5]==1) { checkbox ($delete,"delete");echo "<red>".cmsg ("WF_UPDTODEL")."</red><br>"; };
  radio ("strupdmode","allstrokes","WF_EXCALL"); echo "<br>";
 radio ("strupdmode","#substrokes","WF_EXCSUB"); echo "<br>"; // select ignored ???? WTF?
  radio ("strupdmode","subindstrokes","WF_EXCSUBIND") ; //echo "<br>";
  ?>
  <textarea name=subindex cols= 5 rows=1 ><?=$subindex; ?></textarea>,<?php lprint ("WF_EXCSPLT") ; ?> ,<textarea name=subsplitter cols= 4 rows=1 ><?=$subsplitter; ?></textarea><br>

 <?php   // start compare addif
 checkboxcorrect ("addifenable1",$addifenable1) ;
	echo cmsg ("WF_IF")."1 :"; printfield ($data,"addif1");
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?php checkboxcorrect ("addifenable2",$addifenable2) ;
	echo cmsg ("WF_IF")."2 :"; printfield ($data,"addif2");
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
		<?php 	// end compare addif   Âñòàâëåíî äëÿ âûáîðà ïîëÿ
	echo "<br>".cmsg ("WF_DUPL")."<br>";
	if (strlen ($vID2)!==0) echo cmsg ("WF_ID2HLP")."<br>";

 ?>
	<gray> <?php lprint ("WF_EMUSUB") ; ?> : </gray><input type="checkbox" name="emusubstroke"><br>
 <?php submitkey ("write","KEY_S_EXCH");
}



//=========================================
//ìîäóëü îáðàáîòêè
if (($write==cmsg("KEY_S_EXCH"))AND($prdbdata[$tbl][12]!="fdb")) {
 if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");

 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);

	if (($addifcmp1=="bolee")OR($addifcmp1=="menee")) {
    	$sampletotest=explode (",",$addiflist1);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}
    if (($addifcmp2=="bolee")OR($addifcmp2=="menee")) {
    	$sampletotest=explode (",",$addiflist2);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}

   if (($addif1)AND($addifenable1)) {
		if ($addifcmp1=="rawno") $cmdaddif=" AND `".$addif1."` IN (".$addiflist1.") ";
		if ($addifcmp1=="nerawno") $cmdaddif=" AND `".$addif1."` NOT IN (".$addiflist1.") ";
		if ($addifcmp1=="bolee") $cmdaddif=" AND `".$addif1."` >'".$addiflist1."' ";
		if ($addifcmp1=="menee") $cmdaddif=" AND `".$addif1."` <'".$addiflist1."' ";
		};

   if (($addif2)AND($addifenable2)) {
		if ($addifcmp2=="rawno") $cmdaddif.=" AND `".$addif2."` IN (".$addiflist2.") ";
		if ($addifcmp2=="nerawno") $cmdaddif.=" AND `".$addif2."` NOT IN (".$addiflist2.") ";
		if ($addifcmp2=="bolee") $cmdaddif.=" AND `".$addif2."` >'".$addiflist2."' ";
		if ($addifcmp2=="menee") $cmdaddif.=" AND `".$addif2."` <'".$addiflist2."' ";
		};
	//	echo "COMMAND ADDED TO IF ---  $cmdaddif<br>";

	if ($nolimit) {set_time_limit(0);} else {set_time_limit(60) ;};
	if (($prauth[$ADM][5]==false)AND($delete)) { unset ($delete); echo "r";};// ñáðîñ îò íåëåãàëüíûõ delete
	readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ì  àññèâ mycol êîë-âî mycols
    if (!$strupdmode) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_NOMODE");exit;};
	if (strlen ($exchid)==0) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_NOTARG");exit;};
	if (($strupdmode=="substrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>".cmsg ("LIM")."</bb><br></red>".cmsg ("WF_ER_NOSUB"); exit;} ;
	if ($strupdmode==="subindstrokes") {
	   if (!$subindex) {echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_NOIND") ; exit;}
	  if (!$subsplitter) {echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_SPLIT") ; exit;}
		} ;

		if (!$wfemptyenab) if (($prauth[$ADM][4]===false)AND($strupdmode==="allstrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>".cmsg ("LIM")."</bb><br></red>".cmsg ("WF_EX_ANY_D") ; exit;} ;
	//îêîí÷àíèå îáðàáîòêè îøèáîê
	if ((strlen ($sourceid)==0)AND($strupdmode!=="substrokes"))
		{ $cmd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$exchid."' WHERE `".$mycol[$md2column]."`= '".$vID."'";
			if ($delete) $cmd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$md2column]."`= '".$vID."'";
				}  // åñëè íå óêàçàíà öåëü çàìåíû òîãäà çàìåíÿåò ëþáîå çíà÷åíèå â ïðåäåëàõ ID

	if ((strlen ($sourceid)!==0)AND($strupdmode!=="substrokes"))
		{ $cmd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$exchid."' WHERE `".$mycol[$field]."`= '".$sourceid."'";
		if ($delete) $cmd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`= '".$sourceid."'";
				} // çàìåíÿåò óêàçàííûå çíà÷åíèÿ â ïðåäåëàõ ID  ,  ìîæåò ðàñøèðÿòñÿ allstrokes
				// allstrokes??  onestroke
	if (($strupdmode=="onestroke") AND (strlen ($sourceid)!==0)) {
		$cmd=$cmd." AND `".$mycol[$md2column]."`= '".$vID."'";
		if (($virtualid>0)AND (strlen ($vID2)!==0)) {
					$cmd = $cmd." AND `".$mycol[$virtualid]."`= '".$vID2."'";};};

	if (($addifenable1)OR($addifenable2)) {$cmd=$cmd.$cmdaddif;		}; // âûï äîï óñëîâèÿ ìîäåðíèç.



// SUBSTRREPLACE çàìåíà âíóòðè ñòðîêè áåç èíäåêñà
if (($strupdmode=="substrokes")AND(!$emusubstroke))	{
	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`=REPLACE (`".$mycol[$field]."`,$sourceid,$exchid) WHERE `$mycol[$field]` LIKE '%$sourceid%'";
if ($delete) $cmd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`LIKE  '%".$sourceid."%'";
	echo "";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // âûï äîï óñëîâèÿ ìîäåðíèç.
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";

	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
		}

//+++++ÏÐÎÑÌÎÒÐ $cmd="SELECT name,$substringone as A FROM `".$prdbdata[$tbl][5]."` WHERE `name` LIKE \"%".$charname."%\";";


// SUBINDSTRREPLACE çàìåíà âíóòðè ñòðîêè ñ èíäåêîì  -
if (($strupdmode=="subindstrokes")AND(!$emusubstroke))	{
//calc maximum row inside data field
	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`LIKE '%".$sourceid."%'";
	$result = dbs_query ($cmd, $connect,$dbtype);$myrow = dbs_fetch_row ($result,$dbtype);
	$a=trim ($myrow[$field]); $b=explode ($subsplitter,$a);$endsub=count ($b); //end calc  $endsub
	if ($test1) {echo "COMMAND: $cmd<bR>:";
if (!$pr[8]) echo "DEBUG Test first row:".$a."<br><br>";
if (!$pr[8]) echo "DEBUG Substroke cont $endsub codes - editing row $subindex data : ".$b[$subindex-1]."<br>None changes, just test,encoding index real (without 0)<br><bR>";
}
  $startsub=-1+$subindex; $endsub=-($endsub-$subindex); // corrected
$substringone=" (SUBSTRING_INDEX(SUBSTRING_INDEX(".$mycol[$field].",'".$subsplitter."','".$subindex."'),'".$subsplitter."','-1') )";
//substrone ïîëó÷àåò çíà÷åíèå èñêîìîãî ýëåìåíòà è ìîæåò ñðàâíèâàòñÿ êàê îáû÷íàÿ ïåðåìåííàÿ
/*if ($test1) {
	$cmd="SELECT $substringone as A FROM `".$prdbdata[$tbl][5]."` WHERE A='".$sourceid."'";
$result = dbs_query ($cmd, $connect,$dbtype);$myrow = dbs_fetch_row ($result,$dbtype);
if (!$pr[8]) echo "COMMAND 2 : $cmd<br><bR><br>Substroke 2 row:".$myrow[0]."<br><br><br><br><br>";
}  //  øîáû íå ñâåòèëîñü
*/


	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`= CONCAT(SUBSTRING_INDEX(`".$mycol[$field]."`, '".$subsplitter."', '".($startsub)."'), ' ".$exchid." ' ,SUBSTRING_INDEX(`".$mycol[$field]."`, '".$subsplitter."', '".$endsub."'))  WHERE (".$substringone.")=".$sourceid." "; // where ÷àñòüâåðíàÿ.
 // êñòàòè âðîäå áàã ñ ýòîé ôèãíåé â öñâ äî ñèõ ïîð îñòàëñÿÿLIKE '%".$subsplitter.$sourceid.$subsplitter."%'
if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE ".$substringone."='".$sourceid."' ";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // âûï äîï óñëîâèÿ ìîäåðíèç.
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";$silent=0;dbserr ();
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
	}

//ìîäóëb ýìóëÿöèè ñóáñòðîê
// SUBSTRREPLACE çàìåíà âíóòðè ñòðîêè áåç èíäåêñà  ýìóëÿöèÿ(!!!)
if (($strupdmode=="substrokes")AND($emusubstroke)) { $sourcefield="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`LIKE '%".$sourceid."%'";
$subselect=dbs_query ($sourcefield,$connect,$dbtype);
while($row=dbs_fetch_array($subselect,$connect,$dbtype))
	{ $data=$row[$field];$guided=$row[$md2column];
	//echo $row[0]." -- ".$row[$field]." -- ".$field." <br>";
$replid=$data; $replid=str_replace ($sourceid, $exchid,$replid);// replid ýòî ìàññèâ êîòîðûé íóæä â èçìåíåíèè
	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$replid."' WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // âûï äîï óñëîâèÿ ìîäåðíèç.
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };

};
echo "Âûïîëíåíî ".$findrecords." öèêëîâ.<br>";
};


// SUBINDSTRREPLACE çàìåíà âíóòðè ñòðîêè ñ èíäåêîì  ýìóëÿöèÿ
if (($strupdmode=="subindstrokes")AND($emusubstroke)) {
$sourcefield="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."` LIKE '%".$sourceid."%'";
$subselect=dbs_query ($sourcefield,$connect,$dbtype);
while($row=dbs_fetch_array($subselect,$connect,$dbtype))
	{ $data=$row[$field];$guided=$row[$md2column];
	//echo $row[0]." -- ".$row[$field]." -- ".$field." <br>";
$dataexp=explode ($subsplitter,$data); // subindex
if ($dataexp[$subindex]==$sourceid) {
	//echo "Dataexp - $dataexp ;; dataexp index ".$dataexp[$subindex]." ;; index  $subindex;  source $sourceid; exh $exchid<br>";
	$dataexp[$subindex]=$exchid;
$replid=implode ($subsplitter,$dataexp); //$replid=str_replace ($sourceid, $exchid,$replid);// replid ýòî ìàññèâ êîòîðûé íóæä â èçìåíåíèè
	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$replid."' WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // âûï äîï óñëîâèÿ ìîäåðíèçèðîâàíî
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
	}; //endif dataexp
};//endwhile
echo cmsg ("WF_CCLOK").$findrecords.".<br>";
};//endif subindstrokes
// êîíåö ìîäóëÿ ýìóëÿöèè ñóáñòðîê
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
	$a=$result;// ïðîâåðêà íà âøèâîñòü :) ÷òîáû ñòî ðàç íå óäàëÿëè
	if (($views)AND($strupdmode=="allstrokes")) $upd=$cmd;//ôèêñ íåïîêàçà çàïðîñà â 1ðåæ
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($a===true) { echo $vID.cmsg ("WF_UPDOK")."<br>";} else {
				$errt=cmsg ("WF_UPDFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";}
	if ($delete) { $partaction="MASS_DEL_SQL"; } else { $partaction="MASS_EXCH_SQL";};
	if (($pr[12])AND(!$cmd)) {$act=$partaction." B $tbl Replsub $sourceid $exchid"; logwrite ($act) ;	};  // ëîãèðóåìñÿ
	if (($pr[12])AND($cmd)) {$act=$partaction." B $tbl Repl $sourceid $exchid CMD $cmd"; logwrite ($act) ;	};  // ëîãèðóåìñÿ
}







//ìîäóëü çàïóñêà
//===============================  äëÿ ìàññ ñðàâíåíèÿ áóäåò ïîõîæàÿ ìåíþøêà.
// äëÿ èíñòàíñ ðåæèìà áóäåò ñíà÷àëà âûáîð èíñòàíñîâ à äàëüøå óæå ïðîñòî äàííûå áóäóò ïåðåäàâàòüñÿ ïîõîæåìó ñêðèïòó.
if (($write==cmsg("KEY_MASCPY"))AND($prdbdata[$tbl][12]!="fdb")) {
  @ $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
// âûáîð êîëîíêè èç òåêóùåé áàçû
	lprint ("WF_MASCPYMSG");// Âñòàâëåíî äëÿ âûáîðà ïîëÿ
//	$ar=$selectedfield;
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a; êîïèÿ ìîäóëÿ èç íà÷àëà writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,$ipfilter,6);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"destination",cmsg ("WF_MAS_DEST"),$groupdb,$ipfilter,6);
	//êîíåö âûáîðà êîëîíêè èç òåêóùåé áàçû

 ?><br><input type= hidden name=go value=Ïåðåõîä_êîïèðîâàíèå>
 <?php   checkbox ($views,"views") ;echo cmsg ("WF_LOG")."<br>";
    checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
  if ($prauth[$ADM][5]==1) echo ""; // ðåçåðâ äëÿ óäàëåíèÿ
// echo "<gray>Ïðîñòî ïðîñìîòð, áåç êîïèðîâàíèÿ</red><input type=checkbox name=delete><br>"; ?>
  <?php lprint ("WF_MASCPYACT") ; ?> <br>
  <input type="radio" name="cpymod" value="copyabort"> <?php lprint ("ABORT") ; ?>
  <input type="radio" name="cpymod"  value="copyrewrite"> <?php lprint ("REWRITE") ; ?>
  <input type="radio" name="cpymod"  value="copyignore"> <?php lprint ("IGNORE") ; ?><br>
 <?php // start compare addif
echo cmsg ("WF_MASCPYIFHLP")."<br> ";

   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1");
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?php 	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2");
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
	<?php submitkey ("write","KEY_S_COPY");
}

//ìîäóëü îáðàáîòêè
if (($write==cmsg("KEY_S_COPY"))AND($prdbdata[$tbl][12]!="fdb")) {
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();

	//echo "Ïðîöåäóðà ðàáîòàåò â òåñòîâîì ðåæèìå";
	$connect1 = dbs_connect ($prdbdata[$source][6], $sd[14] , $sd[17],$prdbdata[$source][12]);
	$connect2 = dbs_connect ($prdbdata[$destination][6], $sd[14] , $sd[17],$prdbdata[$destination][12]);
	dbs_selectdb ($prdbdata[$source][9], $connect1,$prdbdata[$source][12]);
	dbs_selectdb ($prdbdata[$destination][9], $connect2,$prdbdata[$destination][12]);

$desttbl=$prdbdata[$destination][9].".".$prdbdata[$destination][5];
$sourctbl=$prdbdata[$source][9].".".$prdbdata[$source][5];
if ($cpymod=="") { lprint ("WF_MASCPY_NOACT");exit;}
if ($cpymod=="copyabort") { $query="INSERT INTO ".$desttbl." SELECT * FROM ".$sourctbl." ";
};
if ($cpymod=="copyrewrite") { $query="REPLACE INTO ".$desttbl." SELECT * FROM ".$sourctbl." ";
};
if ($cpymod=="copyignore") { $query="INSERT IGNORE INTO ".$desttbl." SELECT * FROM ".$sourctbl." ";
};


	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;
	if ($nolimit) {set_time_limit(0);} else {set_time_limit(60) ;};

	if (($addifcmp1=="bolee")OR($addifcmp1=="menee")) {
    	$sampletotest=explode (",",$addiflist1);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}
    if (($addifcmp2=="bolee")OR($addifcmp2=="menee")) {
    	$sampletotest=explode (",",$addiflist2);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}


   if ($addif1) {
	if ($addifcmp1=="rawno") $cmdaddif=" WHERE `".$addif1."` IN (".$addiflist1.") ";
	if ($addifcmp1=="nerawno") $cmdaddif=" WHERE `".$addif1."` NOT IN (".$addiflist1.") ";
	if ($addifcmp1=="bolee") $cmdaddif=" WHERE `".$addif1."` >'".$addiflist1."' ";
	if ($addifcmp1=="menee") $cmdaddif=" WHERE `".$addif1."` <'".$addiflist1."' ";
	};

   if (($addif2)AND($addifenable2)) {
	if ($addifcmp2=="rawno") $cmdaddif.=" AND `".$addif2."` IN (".$addiflist2.") ";
	if ($addifcmp2=="nerawno") $cmdaddif.=" AND `".$addif2."` NOT IN (".$addiflist2.") ";
	if ($addifcmp2=="bolee") $cmdaddif.=" AND `".$addif2."` >'".$addiflist2."' ";
	if ($addifcmp2=="menee") $cmdaddif.=" AND `".$addif2."` <'".$addiflist2."' ";
	};


	if (($addifenable1)OR($addifenable2)) {$cmd=$cmd.$cmdaddif;		}; // âûï äîï óñëîâèÿ ìîäåðíèçèðîâàíî
//echo "cmdaddif-$cmdaddif addifcmp2=$addifcmp2 addifcmp1=$addifcmp1";
$cmd=$query.$cmdaddif.";";
//echo "<br>$cmd=$query.$cmfaddif.<br>";
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $result<br>";}

//executing+errlogäåëàåì íîðìàëüíóþ îáðàáîòêó îøèáîê  èñï âñåãäà ýòîò ìîäóëü
$result = dbs_query ($cmd, $connect,$dbtype);
  if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// ïèøåò îøèáêó è åå êîä  è åãî æå âîçâðàùàåò
$error= mysql_error ();
//echo $error;
if ($errno) {lprint ("WF_POSERR");}
//endof executing


	if ($pr[12]) {$act="MASS_COPY_SQL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;	};  // ëîãèðóåìñÿ
}

//=========================================


//êîïèðîâàíèå òàáëèö. âîçìîæíî áóäåò ÷àñòüþ ìîäóëÿ ðàáîòû ñ áàçàìè äàííûõ
//ïàêîâêà áàç äàííûõ - ñïèñîê êëþ÷åé ââåðõó ôàéëà, ôàéë îáðàáàòûâàåòñÿ äî êîîðäèíàòû êëþ÷à,êëþ÷ âñò.îáð. ïðîäîëæàåòñÿ

//èñïîëüçîâàòü òîò æå òèï âûáîðà ÷òî è â ìàñòåðå ñîåäèíåíèÿ òàáëèö.
//ìîäóëü çàïóñêà - ñðàâíåíèå

// bug - ïðè êîïèðîâàíèè òàáëèö íå ñîîáùàåò ÷òî îíè áûëè óñïåøíî ñêîïèðîâàíû,  ïðè èñïîëíåíèè ñêðèïòà àíàëîãè÷íî
/*
 * ìîè ïëàíû íà áëèæàéøèå 24 ÷àñà.
ÿ äóìàþ ó ìåíÿ âûéäåò åñëè ÿ îòâëåêàòñÿ íå áóäó.

1 - äîáàâèòü â ñàéò íîâîñòè. - ñäåëàþ íà ñòðàíèöó ñîîáùåñòâî , ò.ê. äðóãîé ïóñòîé ñòðàíèöû ñ êíîïêîé òàì íåò, à ó ìåíÿ íåò øðèôòîâ ÷òîáû äåëàòü êíîïêè

2ñêðèïòû â ïëàíàõ
ñðàâíåíèå áàç, ñðàâíåíèå òàáëèö, âûäåëåíèå ðàçíèöû â SQL ñêðèïò
óëó÷øåíèå èñïîëíåíèÿ äàìïà äî ïîíèìàíèÿ ïåðåâîäà ñòðîê ëþáîãî ôàéëû
óëó÷øåíèå ãåíåðèðîâàíèÿ ëîãà (ñ âêëþ÷åíèåì øàïêè â INSERTû)
äîáàâëåíèå macros.cfg äëÿ ãðóïïèðîâêè òàáëèö äëÿ ñîâåðøåíèÿ îäíîòèïíûõ îïåðàöèé ñðàçó ñ ãðóïïîé ïî 1 êîìàíäå. (ýòî â ïîñëåäíþþ î÷åðåäü)

*/
if (($write==cmsg ("KEY_COMPARE"))AND($prdbdata[$tbl][12]!="fdb")) {
//echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
//global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;
//echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
    $groupdbthisname="groupdb";
		groupdbprint ($list,"Group",$prdbdata,$tbl,$groupdb); // wat &   db lost (real name)
    $groupdbthisname="groupdb2";
		groupdbprint ($list,"Group2",$prdbdata,$tbl,$groupdb);
hidekey ("hidemenu",1);//óáèðàòü ìåíþ
hidekey ("menudisable",on);
   submitkey ("write","KEY_COMPARE_2");
}
//

if (($write==cmsg ("KEY_COMPARE_2"))AND($prdbdata[$tbl][12]!="fdb")) {
//echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
//global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;
//echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
//$cmd="SELECT * FROM `$tabledest`.`$tabledest` WHERE `$kol2` NOT IN (SELECT `$kol1` FROM `$tablesource`.`$tablesource` WHERE 1=1)";
 hidekey ("groupdb",$groupdb);
 hidekey ("groupdb2",$groupdb2);
 hidekey ("hidemenu",1);//óáèðàòü ìåíþ
 hidekey ("menudisable",on);

 $printalias="db+name";//allows return name by printlink  //db+name allows return dbname.dbtable
   printlink ($prauth,$prdbdata,$ADM,$tablesource,$grouplist,"tablesource",cmsg("SELLINK"),$groupdb,$ipfilter,"");echo "<br>";
   printlink ($prauth,$prdbdata,$ADM,$tabledest,$grouplist,"tabledest",cmsg("SELLINK"),$groupdb2,$ipfilter,"");echo "<br>";
  //       echo "cmd=$cmd<br>";

   submitkey ("write","KEY_COMPARE_3");

  }
//

if (($write==cmsg ("KEY_COMPARE_3"))AND($prdbdata[$tbl][12]!="fdb")) {
//   $cmd="SELECT * FROM `".$tabledest."` WHERE `".$kol2."` NOT IN (SELECT `".$kol1."` FROM `".$tablesource."` WHERE 1=1)";
 //  echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
  //global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;
    //echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
    checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
   // checkbox ($keys,"keys"); echo cmsg ("WF_MASCMP_KEY")."<br>"; ïîêà íåò âîçì ñðàâíèòü ñîäåðæèìîå
   //checkbox ($dbaff,"dbaff") ; echo cmsg ("WF_INSBAS")."<br>"; åñëè ïîëÿ áàç ðàçíûå òî è áàçû àâò íàäî ðàçíûå ñðàâíèâàòü!!! -

 hidekey ("tablesource",$tablesource);
 hidekey ("tabledest",$tabledest);
 // çäåñü îïðåäåëÿåì ðåàëüíûé groupid
 // õîòÿ ýòîò ìåòîä õóæå ÷åì îïðåäåëåíèå groupdb è âûäà÷à db ,  íî âñåæå alias òî÷íî ñîäåðæèò íóæíûé db id , à groupdb ìîæåò áûòü îäèíàêîâûì äëÿ ðàçíûõ db
 //for ($a=)
 hidekey ("groupdb",$groupdb);
 hidekey ("groupdb2",$groupdb2);
 //hidekey ("groupdb",$groupdb);
 //hidekey ("groupdb2",$groupdb2);
 hidekey ("hidemenu",1);//óáèðàòü ìåíþ
 hidekey ("menudisable",on);
  $x=explode (".",$tablesource); // ðàçäåëÿåì áàçó äàííûõ íà áàçó è òàáëèöó
  $databasedef=$x[0];
  $tabledef=$x[1];
$dbtype="mysql";
$tbl=gettblidfromdbandtable ($prdbdata,$databasedef,$tabledef,"id");
//echo "ïðîâåðêà íà âøèâîñòü -$tbl=gettblidfromdbandtable ($prdbdata,$databasedef,$tabledef,$string);  ";
 	$data=readdescripters (); if ($data==-1) exit; //$tbl=0; îíà îðèåíòèðóåòñÿ òîëüêî íà ýòî çíà÷åíèå
	$mycol=$data[0];
 $a=prefixdecode ($res16);
   decodecols ($res16);	lprint ("FOR_SEL");
   $field=$kol;//echo "(field=$kol ";

   $field1=printfield ($data,"kol1");
      $field2=printfield ($data,"kol2");
//      echo "field1=";print_r ($field);
  //    echo"<br> ";
echo "<br>";

//compare database struct   compare table struct   compare table data (with cp
 ?>  <input type="radio" name="cmpmode"value="1to2"><?php lprint ("WF_CMP_12") ; ?><br>
  <input type="radio" name="cmpmode" value="2to1"> <?php lprint ("WF_CMP_21") ;?><br>
  <?php   //submitkey ("write","KEY_COMPARE_3");
  //checkbox ($a1,"a1"); echo cmsg ("WF_MASCMP_KEY")."<br>";  CANNOT BE DISABLED  , CFG OPT FUTURE  TODO:
  checkbox ($wfcmpqry,"wfcmpqry") ; echo cmsg ("WF_CMP_QRY")."<br>";
     checkbox ($execute,"execute") ; echo "<red>".cmsg ("WF_VIEANDEXEC")."<br></red>";
     checkbox ($GENALT,"GENALT") ; echo cmsg ("GENALT")."<br>";
// start compare addif COPY
//checkbox ($cmpifchg,"cmpifchg") ; echo "<gray>".cmsg ("WF_CMPIFCGH")."<br></red>";
   echo "<input type=checkbox name=addifenable1>";
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1");
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$vID; ?></textarea><br>
		<?php 	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2");
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
	<?php    //   echo "cmd=$cmd<br>";
  submitkey ("write","KEY_S_COMPARE");

  }
//






//ìîäóëü èñïîëíåíèÿ - ñðàâíåíèå
if (($write==cmsg ("KEY_S_COMPARE"))AND($prdbdata[$tbl][12]!="fdb")) {
  // result screen
  $cmdaddif="1=1";

    $x=explode (".",$tablesource); // ðàçäåëÿåì áàçó äàííûõ íà áàçó è òàáëèöó
  $databasesource="`".$x[0]."`.";
  $tablesource="`".$x[1]."`";
  $source=$databasesource.$tablesource;
  $x=explode (".",$tabledest); // ðàçäåëÿåì áàçó äàííûõ íà áàçó è òàáëèöó
  $databasedest="`".$x[0]."`.";
  $tabledest="`".$x[1]."`";
  $dest=$databasedest.$tabledest;

  if ($cmpmode=="2to1")  {
      $x=$source;
      $source=$dest;
      $dest=$x;
  }
$sourcetable=$tablesource; //for execute

  //preparing óñëîâèÿ WHERE
if ($addifenable1) {	if (($addifcmp1=="bolee")OR($addifcmp1=="menee")) {
    	$sampletotest=explode (",",$addiflist1);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}
    if (($addifcmp2=="bolee")OR($addifcmp2=="menee")) {
    	$sampletotest=explode (",",$addiflist2);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}

  if ($addiflist1){
   if ($addif1) {
		if ($addifcmp1=="rawno") $cmdaddif=" `".$addif1."` IN (".$addiflist1.") ";
		if ($addifcmp1=="nerawno") $cmdaddif=" `".$addif1."` NOT IN (".$addiflist1.") ";
		if ($addifcmp1=="bolee") $cmdaddif=" `".$addif1."` >'".$addiflist1."' ";
		if ($addifcmp1=="menee") $cmdaddif=" `".$addif1."` <'".$addiflist1."' ";
		};
   if (($addif2)AND($addifenable2)) {
		if ($addifcmp2=="rawno") $cmdaddif.=" AND `".$addif2."` IN (".$addiflist2.") ";
		if ($addifcmp2=="nerawno") $cmdaddif.=" AND `".$addif2."` NOT IN (".$addiflist2.") ";
		if ($addifcmp2=="bolee") $cmdaddif.=" AND `".$addif2."` >'".$addiflist2."' ";
		if ($addifcmp2=="menee") $cmdaddif.=" AND `".$addif2."` <'".$addiflist2."' ";
		};
	  }
}

  //echo "USING REAL TABLE NAME !!!!!; tablenam= $tablename <br>:/:";
  $cmd="SELECT * FROM $dest WHERE `$kol2` NOT IN (SELECT `$kol1` FROM $source WHERE $cmdaddif);";
  //echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
  //global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;
  //echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
  hidekey ("menudisable",on);
  $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
//$dbtype=$prdbdata[$tbl][12];
     // dbs_selectdb ($prdbdata[tbl2][9],$connect,$dbtype);
        echo "cmd generic :$cmd<br>";  //  129;79;108

     $printing=1;
$x=executesql ($cmd,$connect,1);

// execute mode..  try generate and execute script (can be splitteD) CFG OPT FUTURE  TODO:
  if ($wfcmpqry) {echo "wfcmpqry _on ";
//echo $cmd;
//$cmd=" SHOW DATABASES;";
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
        $mycols=dbs_num_fields ($result,"");
	if ($result==true) { echo $vID.cmsg ("WF_CMP")."<br>";} else {
				$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";
                                //ïî÷åìó òî âñåãäà ïèøåò îøèáêó
                                }
                                // ìîæåò ýòó ôóíêöèþ âûäåëèòü îòäåëüíî?
if ($GENALT) {
    global $mycol;  // óëó÷øåííîå - ìîæíî âûäåëèòü CFG OPT FUTURE  TODO:// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];
}
if ($execute) $sourcetable=$databasedest.$sourcetable;// öåëåâàÿ áàçà äàííûõ óêàçûâàåòñÿ àâòîìàòè÷åñêè.
// ïå÷àòü   ôîðìèðîâàíèå òåêñòà çàïðîñà
 if ($GENALT) $insertone="INSERT INTO $sourcetable ".$field." VALUES ";
    for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$GENALT) {
                    $insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
                    //echo "faak  -  $insertone=gencmdlog ($sourcetable,$myrow,$mycols,); ";
                    echo $insertone."<br>";
                }
                if ($GENALT) {
                    $insertone.=gennohdlog ($sourcetable,$myrow,$mycols,$field).",";
                    //echo "faak  -  $insertone=gennohdlog ($sourcetable,$myrow,$mycols,); ";

                }
                // ïîòîì óëó÷øèòü ÷òîáû íå äåëàëà èçëèøíèé êîä

	};
       if ($GENALT)  {$insertone[strlen($insertone)-1]=";";

           echo $insertone."<br>"; }

if ($execute) {
    echo "starting executing generated script <br>;";
         $printing=1;
           if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
$x=executesql ($insertone,$connect,1);
};

      };

 /* if (1==0) {  $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);// 6 - server - 9 - db  5- table
            dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
            $data=readdescripters (); if ($data==-1) exit;
	$mycol=$data[0];
 $a=prefixdecode ($res16);
   decodecols ($res16);	lprint ("FOR_SEL");
          	$maxquery="SELECT MAX(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$countquery="SELECT Count(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$result=dbs_query ($countquery,$connect,$dbtype);	$counttbl = dbs_fetch_row ($result,$dbtype);
	$result = dbs_query ($maxquery,$connect,$dbtype);;	$maxtbl = dbs_fetch_row ($result,$dbtype);
        	echo cmsg ("WF_AN_ALLDAT")." ".$counttbl[0].", ".cmsg ("WF_LASTW")." ".$maxtbl[0]."<br>";
	@$pl=round (($counttbl[0]/$maxtbl[0])*100,5);
	echo cmsg ("WF_LDED")." = $pl% <br>";

  } */
 // âûâåñòè ÷åãî íå õâàòàåò ïåðâîé äî âòîðîé  ñ êëþ÷àìè
  //êîä ïîêàçûâàþùèé ñîäåðæèìîå âñåõ ÿ÷ååê êîíå÷íîé òàáëèöû êîòîðûõ íå õâàòàåò â íà÷àëüíîé

//êîä ñïèñîê ID âñåõ ÿ÷ååê êîíå÷íîé òàáëèöû êîòîðûõ íå õâàòàåò â íà÷àëüíîé
//$cmd="SELECT $kol1 FROM `$tabledest`.`$tabledest` WHERE `$kol2` NOT IN (SELECT `$kol1` FROM `$tablesource`.`$tablesource` WHERE 1=1)";


// a   piiii   rabotaet SELECT * FROM `tchars_t3can`.`guild` WHERE 'guildid' IN (SELECT * FROM `tchars`.`guild`);
/*  êàêîãî õåðà íå ðàáîòàåò ????? cmd generic :SELECT * FROM `tchars.account_data` WHERE `criteria_id` NOT IN (SELECT `criteria_id` FROM `trealm.account` WHERE 1=1)
 *SELECT * FROM `tchars`.`guild` WHERE 'guildid' NOT IN (SELECT 'guildid' FROM `tchars_t3can`.`guild`);
Î÷åíü õî÷åòñÿ þçàíóòü ïåðåíîñ îòñþäà  ('ýòà ôóíêöèÿ ÷òî äî ñèõ ïîð íå ñäåëàíà? )
SELECT * FROM `ytdb560u`.`table` WHERE `entry` NOT IN (SELECT `entry` FROM `ctdb013_test`.`quest_template` WHERE 1=1)
âçÿòü 2 ëèíêà  ñðàâíèòü ÷èñëî êîëîíîê, çàïóñòèòü   set names
ÂÇßÒÎ ÂÛØÅ:::
WF_MASCMP_KEY;Ñðàâíèâàòü òîëüêî íàëè÷èå äàííûõ, íå ñîäåðæèìîå
WF_CMP_12;Âûâåñòè ñðàâíåíèå ïåðâîé îòíîñèòåëüíî âòîðîé+++
WF_CMP_21;Âûâåñòè ñðàâíåíèå âòîðîé îòíîñèòåëüíî ïåðâîé+++
WF_CMP_QRY;Ñîçäàòü è ïîêàçàòü ñêðèïò íà îáúåêò ñîîòâåñòâóþùèé óñëîâèþ+++


 */
}
//

// ìîäóëü çàïóñêà ñîçäàíèå ìàêðî
if (($write==cmsg ("KEY_MACRO"))AND($prdbdata[$tbl][12]!="fdb")) {
needupdate ();
// needupgrade ();  ìîäóëü äëÿ îñîáûõ âåðñèé dbscript
submitkey ("write","KEY_S_MACRO");
}

// âàðèàíò 2 -    íàïèñàíèå ñêðèïòà ëè÷íî ïîëüçîâàòåëåì, ñ óêàçàíèåì %a %b  ïî òèïó printf è ìåòîäèêè âûïîëíåèíÿ :)


// ìîäóëü èñïîëíåíèÿ ñîçäàíèå ìàêðî
if (($write==cmsg ("KEY_S_MACRO"))AND($prdbdata[$tbl][12]!="fdb")) {
needupdate ();
//  1 - âûáèðàåòñÿ ãðóïïà òàáëèö êàê â dblinker
// âûáèðàåòñÿ ïîëå äëÿ ID1 îïåðàöèé
// äëÿ îïåðàöèé áóäóò èñïîëüçîâàòü  scr dest id1 tablelist ïåðåìåííûå (ìàññèâû)
}






//ìîäóëü çàïóñêà
//===============================  äëÿ ìàññ ñðàâíåíèÿ áóäåò ïîõîæàÿ ìåíþøêà.
// äëÿ èíñòàíñ ðåæèìà áóäåò ñíà÷àëà âûáîð èíñòàíñîâ à äàëüøå óæå ïðîñòî äàííûå áóäóò ïåðåäàâàòüñÿ ïîõîæåìó ñêðèïòó.   âîîáùå òî ðåàëüíî ñðàâíåíèå âñå æå íóæíî ñäåëàòü áåç ðàçíèöû ãäå
if (($write==cmsg ("KEY_SHOWCODE"))AND($prdbdata[$tbl][12]!="fdb")) {

  @ $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
// âûáîð êîëîíêè èç òåêóùåé áàçû
	//echo cmsg ("WF_MASCPYMSG").cmsg ("WF_MASCMPMSG")."<br>";// Âñòàâëåíî äëÿ âûáîðà ïîëÿ
//	$ar=$selectedfield;
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a; êîïèÿ ìîäóëÿ èç íà÷àëà writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,$ipfilter,6);
//printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"dest",cmsg ("WF_MAS_DEST"),$groupdb,$ipfilter,6);
//êîíåö âûáîðà êîëîíêè èç òåêóùåé áàçû

 ?><br>
<?php    checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
   checkbox ($GENALT,"GENALT") ; echo cmsg ("GENALT")."<br>";
?>
 <input type="radio" name="cmpmode"  value="1only" checked><?php lprint ("WF_CMP_QRY") ; ?><br>
  <?php // start compare addif
//checkbox ($cmpifchg,"cmpifchg") ; echo "<gray>".cmsg ("WF_CMPIFCGH")."<br></red>";
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1");
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$vID; ?></textarea><br>
		<?php 	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2");
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
	<?php  submitkey ("write","KEY_S_SHOWCODE");
          submitkey ("write","WF_SHOW_TAB_CRT");
	// end compare addif   Âñòàâëåíî äëÿ âûáîðà ïîëÿ
}

//ìîäóëü îáðàáîòêè
if (($write==cmsg ("KEY_S_SHOWCODE"))AND($prdbdata[$tbl][12]!="fdb")) { //  execute (!(
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();
	$connect = dbs_connect ($prdbdata[$source][6], $sd[14] , $sd[17],$prdbdata[$source][12]);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;
	$mycol=$data[0];
	$id1=$mycol[$md2column];
	if ($virtualid) $id2=$mycol[$virtualid];
	if ($cmpifcfg) $id1=$addif1;// cáðîñ
// mycol è òàê ñîäåðæèò ïðàâèëüíûå íàçâàíèÿ êîëîíîê
	if ($nolimit) {set_time_limit(0);} else {set_time_limit(60) ;};
//			if ($keys)  -òîëüêî êëþ÷è - íå ïðîâåðÿü ñîäåðæèìîå

if ($dbaff) {
	$sourcedb="`".$prdbdata[$source][9]."`.";
	$destdb="`".$prdbdata[$dest][9]."`.";
}
$sourcetable=$sourcedb."`".$prdbdata[$source][5]."`";
$desttable=$destdb."`".$prdbdata[$dest][5]."`";
//  9 - db   5 - table  `".$prdbdata[$source][9]."`.

	if ($cmpmode=="1only") { unset ($keys);  $cmd="SELECT * FROM `".$prdbdata[$source][9]."`.`".$prdbdata[$source][5]."` WHERE";	}
	// ÷òîáû îòîáðàçèòü âñå íàäî ñòåðåòü èìåííî ýòî WHERE !!!!!!!!!!!!!
	// â îáùåì êàêîãî òî õðåíà ïåðåñòàëà ðàáîòàòüü è ïîñëåäíÿÿ ïîëåçíàÿ ÷àñòü çàïðîñà òåðÿÿ ïåðåäàâàåìûå ïåðåìåííûå

//   if (!$addiflist1) { lprint ("WF_NEEDIF");exit;};
   if ($addiflist1==$addiflist2) { lprint ("WF_BADIF"); exit;};
// ñäåñü áóäåò èãðàòü ðîëü ïî èíäåêñàì èëè öåëèêîì ðîâíÿòü  bbbabagbbw
// ñðàâíåíèå   âñå ÷òî ðàâíî,  âñå ÷òî íå ðàâíî ïî êëþ÷àì , âîîáùå âñå ÷òî íå ðàâíî
// âñå ñ óñëîâèåì


	if ((!$keys)AND($cmpmode!=="1only"))
	{ echo "Ýòè çíà÷åíèÿ â îáîèõ òàáëèöàõ ïîëíîñòüþ ñîâïàäàþò.<br>";
	for ($a=0;$a<count ($mycol);$a++){
	 $b.="$sourcetable.`".$mycol[$a]."`=$desttable.`".$mycol[$a]."` AND";
	}
		$cmd="SELECT * FROM $sourcetable,$desttable WHERE $b ";
	}

	if (($addifcmp1=="bolee")OR($addifcmp1=="menee")) {
    	$sampletotest=explode (",",$addiflist1);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}
    if (($addifcmp2=="bolee")OR($addifcmp2=="menee")) {
    	$sampletotest=explode (",",$addiflist2);
    	$sample=$sampletotest[0];    	lprint ("CMP_B_OR_S_NA");echo "<br>";
    	}

  if ($addiflist1){
   if ($addif1) {
		if ($addifcmp1=="rawno") $cmdaddif=" $desttable.`".$addif1."` IN (".$addiflist1.") ";
		if ($addifcmp1=="nerawno") $cmdaddif=" $desttable.`".$addif1."` NOT IN (".$addiflist1.") ";
		if ($addifcmp1=="bolee") $cmdaddif=" $desttable.`".$addif1."` >'".$addiflist1."' ";
		if ($addifcmp1=="menee") $cmdaddif=" $desttable.`".$addif1."` <'".$addiflist1."' ";
		};
   if (($addif2)AND($addifenable2)) {
		if ($addifcmp2=="rawno") $cmdaddif.=" AND $desttable.`".$addif2."` IN (".$addiflist2.") ";
		if ($addifcmp2=="nerawno") $cmdaddif.=" AND $desttable.`".$addif2."` NOT IN (".$addiflist2.") ";
		if ($addifcmp2=="bolee") $cmdaddif.=" AND $desttable.`".$addif2."` >'".$addiflist2."' ";
		if ($addifcmp2=="menee") $cmdaddif.=" AND $desttable.`".$addif2."` <'".$addiflist2."' ";
		};
	  }

	$cmd=$cmd.$cmdaddif.";";		// âûï äîï óñëîâèÿ ìîäåðíèçèðîâàíî
//echo $cmd;
//$cmd=" SHOW DATABASES;";
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
	if ($result==true) { echo $vID.cmsg ("WF_CMP")."<br>";} else {
				$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";
                                //ïî÷åìó òî âñåãäà ïèøåò îøèáêó
                                }
                                // ìîæåò ýòó ôóíêöèþ âûäåëèòü îòäåëüíî?
if ($GENALT) {
    global $mycol;  // óëó÷øåííîå - ìîæíî âûäåëèòü CFG OPT FUTURE  TODO:// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];
}
// ïå÷àòü   ôîðìèðîâàíèå òåêñòà çàïðîñà
 if ($GENALT) $insertone="INSERT INTO $sourcetable ".$field." VALUES ";
    for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$GENALT) {
                    $insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
                    echo $insertone."<br>";
                }
                if ($GENALT) {
                    $insertone.=gennohdlog ($sourcetable,$myrow,$mycols,$field).",";

                }
                // ïîòîì óëó÷øèòü ÷òîáû íå äåëàëà èçëèøíèé êîä

	};
       if ($GENALT)  {$insertone[strlen($insertone)-1]=";";

           echo $insertone."<br>"; }

  echo cmsg ("WF_CCLOK")." ".$c."<br>";


	if ($views) echo cmsg ("WF_EXQUE").$cmd."<br>";
		echo "<br>".cmsg ("WF_QUECOMP")." ".dbs_affected_rows ()." ".cmsg ("WF_Q1")."<br>";
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($pr[12]) {$act="SHOW_PATCH_SQL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // ëîãèðóåìñÿ

	//executing+errlogäåëàåì íîðìàëüíóþ îáðàáîòêó îøèáîê  èñï âñåãäà ýòîò ìîäóëü
$silent=0;$errno=dbserr ();// ïèøåò îøèáêó è åå êîä  è åãî æå âîçâðàùàåò
//if ($errno) {echo cmsg ("WF_POSERR")."<br>";}
//endof executing


}



//=========================================
//ìîäóëü çàïóñêà
if ($write==cmsg ("WF_UNDO_LAST")) {
    $file="_logs/undolog.dat";
    $undolist=searchplus ($file,"NOPRINT",date("d.m.Y")."&".$prauth[$ADM][15]."(".$prauth[$ADM][0].")");
    $last=count ($undolist);
    echo "Undolist last hour counts :$last<br>";
    $massive=explode ("¦",$undolist[$last-1]);
    echo "Your command at ".$massive[0].":<br>".$massive[3]."<br><br>";
    echo "To undo , manual execute this command: <br>".$massive[4]."<br>";
    //print_r ($a);
    //($file,$filetoaction,$stroka)
    ////date("d.m.Y")  $prauth[$ADM][15]."(".$prauth[$ADM][0].")
    submitkey ("write","WF_UNDO_LAST_EXEC");
	//Header("Location: r.php?tbl=log&mode=7&kol=1&vID=".$prauth[$ADM][15]."(".$prauth[$ADM][0].")");  ïîêàç ïîñòðàíè÷íî íå óìååò è last íå ïîí
}


if ($write==cmsg ("WF_UNDO_LAST_EXEC")) {
    @$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
    dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
    $file="_logs/undolog.dat";
    $undolist=searchplus ($file,"NOPRINT",date("d.m.Y")."&".$prauth[$ADM][15]."(".$prauth[$ADM][0].")");
    $last=count ($undolist);
    echo "Undolist last hour counts :$last<br>";
    $massive=explode ("¦",$undolist[$last-1]);
    echo "Your command at ".$massive[0].":<br>".$massive[3]."<br><br>";
    echo "Executing undo command: <br>".$massive[4]."<br>";
    $cmd=$massive[4];
    $result = dbs_query ($cmd, $connect,$dbtype);
    $silent=0;$errno=dbserr ();// ïèøåò îøèáêó è åå êîä  è åãî æå âîçâðàùàåò
    if ($errno) {echo cmsg ("WF_POSERR")."<br>";}
    //print_r ($a);
    //($file,$filetoaction,$stroka)
    ////date("d.m.Y")  $prauth[$ADM][15]."(".$prauth[$ADM][0].")

	//Header("Location: r.php?tbl=log&mode=7&kol=1&vID=".$prauth[$ADM][15]."(".$prauth[$ADM][0].")");  ïîêàç ïîñòðàíè÷íî íå óìååò è last íå ïîí
}



if ($write==cmsg ("WF_MYCANCLIST")) {
	Header("Location: r.php?tbl=log&mode=7&kol=1&vID=".$prauth[$ADM][15]."(".$prauth[$ADM][0].")");
}

if ($write==cmsg ("WF_CANCMON")) {
	Header("Location: r.php?tbl=log&mode=7&kol=0&vID=".date("m.Y"));
}

if ($write==cmsg ("WF_CANCDAY")) {
	Header("Location: r.php?tbl=log&mode=7&kol=0&vID=".date("d.m.Y"));
}

if ($write==cmsg ("WF_CANCTBL")) {
	Header("Location: r.php?tbl=log&mode=7&kol=4&vID=".$prdbdata[$tbl][0]);
}



//echo "write=$write tbl=$tbl massoper=$massoper prdb12=".$prdbdata[$tbl][12]." <br>"; êàêîãî õåðà ïåðåäàåòñÿ êîä ìàññîâîâé îïåðàöèè âíîâü è âíîâü??????
// KEY_S_MASS_OPER òåðÿåòñÿ - ïðèõîäèòñÿ çàþçàòü KEY_MASS_OPER   ðåì AND($prdbdata[$tbl][12]!="fdb")

// ìîäóëü èñïîëíåíèÿ====================================
if (($write==cmsg ("KEY_S_MASS_OPER"))AND($prauth[$ADM][45])AND($massoper)) {
if (!$massoper) echo "Íåîáõîäèìî âûáðàòü ðåæèì ðàáîòû ! Select option first !";
// 1- change column  , 2 - show generate script (SQL only)  3- remove 4 - to best 5 - noop
//ells 2.1.3¦spells.dat¦-¦30971++¦31262++¦31657++¦
if ($massoper==5) return;
$activetable=$prdbdata[$tbl][1];
echo "Àêòèâíàÿ òàáëèöà Active table: $activetable [$tablemysqlselect'$tblmysqlselect]; Given data total:$boxcnt<br>";
for ($a=0;$a<$boxcnt;$a++) {
        $b=${box.$a};
        $c=explode ("+",$b);
	$strokedata.=$b."¦";//if ($box[$a][2]) $strokedata.="&".$box[$a][2]."¦";
        $strokefixeddata1.=$c[0].",";
        $strokefixeddata2.=$c[1].",";
 //echo " box[$a]==>".${box.$a}."".$box[$a][1]."<br>";  //ids vID  vID2  DISABLE VISIBLE print no ID's, a parts.
//hidekey ("box".$a,$box[$a][0]."&".$box[$a][1]);
}
//òóò çàêàí÷èâàåòñÿ ãåíåðàöèÿ ñòðîêè.
echo "Selected data lines : $strokedata<br>";

if (($massoper==3)AND($prdbdata[$tbl][12]=="fdb")){//fdb del mass with undo
    //ìîäóëü îáðàáîòêè

    echo "starting mass delete $boxcnt entries.<br>";
for ($a=0;$a<$boxcnt;$a++) {
    $string=${box.$a};
    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
    echo "deleting id1=$vID id2=$vID2 <br>";
    if ($virtualid=="") $vID2="";// åñëè íåò âèä2 òîãäà åãî çíà÷åíèå ïðîñòî íåíóæíî.   âîçìîæíî ýòî ãäå òî åù¸ íàäî äîáàâèòü.
//ïðîöåäóðà ñêîïèðîâàíà èç ïðîñòîãî óäàëåíèÿ è ÍÅÎÏÒÈÌÈÇÈÐÎÂÀÍÀ
		if ($codekey==7) demo ();
		if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) {
		@$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
		if ($filbas=="gmdata.cfg") {
			$a=testadmin ($prauth,$vID);
			if ($a==1) {print cmsg ("WF_NODELADM")."<br>";exit;};};

	}
	$data=readdescripters ();  if ($data==-1) exit;
csvmod ($f,"del",$values,$vID,$vID2); // ïðè îøèáêàõ âûçûâàåò áåëûé ýêðàí  íå äàâàòü NULL
lprint ("WF_QUECOMP");
undolog ($act,$undodata,$tbl,"");
if ($pr[12]) {$act="DEL_DAT_SEL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;	};  // ëîãèðóåìñÿ
submitkey ("write","WF_UNDO_LAST");
}//endcycle


}
if ($massoper==1){//fdb del mass with undo
    //ìîäóëü îáðàáîòêè  ïî ñóòè àíàëîã MASS_EXCH  ìîæåò åìó è ïåðåäàâàòòü âñå äàííûå ñ íàäñòðîéêîé ñïèñîê?
    echo "starting mass exchange fdb $boxcnt entries.<br>";
for ($a=0;$a<$boxcnt;$a++) {
    $string=${box.$a};    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
    echo "exchanging id1=$vID id2=$vID2 <br>";// íàøè ïåðåìåííûå â $vID i $vID2  $a - öèêë èìè óïëðàâëÿþùèé
}//  drugaya skobka ubrana
if ($virtualid=="") $vID2="";// åñëè íåò âèä2 òîãäà åãî çíà÷åíèå ïðîñòî íåíóæíî.   âîçìîæíî ýòî ãäå òî åù¸ íàäî äîáàâèòü.
//$strokefixeddata=str_replace ("¦",",",$strokedata);//hide

$strokefixeddata1=(substr($strokefixeddata1, -1) == ',') ? substr($strokefixeddata1, 0, -1) : $strokefixeddata1;
echo "$strokefixeddata1";

hidekey ("addiflist1",$strokefixeddata1);
//hidekey ("addiflist2",$strokefixeddata2);  if $string=explode ("+",$string)  true çíà÷èò áûë ïîñëàí îòñþäà çàïðîñ.  íà÷íó ïðàâêó ñ ýòîãî
//hidekey ("field",$addif1); // ïåðåäàåòñÿ , íî íå ïðèíèìàåòñÿ. íó è íàôèã åãî.
////hidekey ("nfield",$addif1);//óâû íå äîõîäèò îíî äî KEY_MASEXC  òàì ñåëåêò åãî òåðÿåò. ÿäðî ïðîâåðÿåò $field, âèäèìî ñîäåðæèìîå îòëè÷àåòñÿ
hidekey ("sourceid",$sourceid);
hidekey ("exchid",$exchid);//hidekey ("addif1",$addif1);//hidekey ("addifcmp1",$addifcmp1);
hidekey ("addifenable1","1");
//hidekey ("addifenable2","1"); // êàê óçíàòü ïðî âòîðîé ID ?  òàêîé âàðèàíò íå ïîêàòèò íóæíî ïðàâèòü MASEXCH  dat óñëîâèå è  ID2 ....
hidekey ("nolimit",1); //3266
hidekey ("strupdmode","subindstrokes");
hidekey ("vID",$vID);
hidekey ("vID2",$vID2);
submitkey ("write","KEY_MASEXC");
}


if (($massoper==3)AND($prdbdata[$tbl][12]!="fdb")) { //sql del mass with undo
  // SELECT SAVEUNDO  DELETE ALL WHERE IDS=  //
    //ìîäóëü îáðàáîòêè  ïî ñóòè àíàëîã MASS_EXCH  ìîæåò åìó è ïåðåäàâàòòü âñå äàííûå ñ íàäñòðîéêîé ñïèñîê?
    echo "starting mass del sql $boxcnt entries.<br>";
for ($xa=0;$xa<$boxcnt;$xa++) { //êîïèÿ DEL_SQL  renewed!~
    $string=${box.$xa};    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
    echo "exchanging id1=$vID id2=$vID2 <br>";// íàøè ïåðåìåííûå â $vID i $vID2  $a - öèêë èìè óïëðàâëÿþùèé
    if ($virtualid=="") $vID2="";// åñëè íåò âèä2 òîãäà åãî çíà÷åíèå ïðîñòî íåíóæíî.   âîçìîæíî ýòî ãäå òî åù¸ íàäî äîáàâèòü.
      // ïðîöåäóðà óäàëåíè $tablemysqlselect'$tblmysqlselect
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
		if ($data==-1) exit;
 if ($prdbdata[$tbl][9]=="dbscriptbk") $virtualid=false;  // CFG OPT FUTURE  TODO:  ïîêà íå ðåøèë ÷òî äåëàòü.
 if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 echo "!!";
 if ($prdbdata[$tbl][22]) $directedit=1;
 if (!$directedit) {
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
        for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$test) $test=$myrow[0];
		$undodata.=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols,"")." ";
	};
	// òóò íàäî áû undo     //exec reselect  â ñëó÷àå íåïðàâèëüíî óñòàíîâëåííîãî id2 íàäî åãî ñáðîñèòü, â ñëó÷àå íàëè÷èÿ ïðàâèëüíûõ îáîèõ ïîïûòàòüñÿ îòðåäàêòèðîâàòü äàííûå äðóãèì ìåòîäîì
            // ðàáîòàåò îòëè÷íî äàæå åñëè íåïðàâèëüíî óêàçàí ID2 ))))
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // îáíàðóæèëè ÷òî ñêðèïò ÷òî òî ìíîãîâàòî íàø¸ë , íå äîëæíî áûòü áîëåå 1 ñòðîêè !
            }
 //exec reselect
         }
 if ($directedit) {
             if ($directedit==2) $vID=base64_decode ($vID);
             $myrow=explode ("^^",$vID);
              $directeditwhere=gensqldirecteditwhere ($mycol,$myrow,$mycols);
                     $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE $directeditwhere ";
		     $result = dbs_query ($cmd, $connect,$dbtype);
                    $myrow = dbs_fetch_row ($result,$dbtype);
                    if (!$test) $test=$myrow[0];// åñëè åñòü ÷òî óäàëÿòü òåñò âêëþ÷åí
                    $undodata.=gencmdlogi ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols,"")." ";
                //    echo $cmd; çàïèñûâàåì îòñóòñòâóþùèé undolog
 }
    // udal vse bez undo
	$a=$test;
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
         if ($directedit) $cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE $directeditwhere";
        echo "we execute real query:::$cmd<Br><br>";
        echo "we get undodata for this :::$undodata<br><br>";
	$e=dbs_query ($cmd,$connect,$dbtype);
        echo "errorcode=$e";
	if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($test==true) { echo $vID.cmsg ("WF_DELOK")."!<br>";} else {
				$errt=cmsg ("WF_DELFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";}

  if (!$errt) if ($pr[12]) {$act="DEL_SQL  B $tbl($nametbl) Find $vID $vID2 Cmd $cmd";
       $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];logwrite ($act) ;
     undolog ($act,$undodata,$baseID,$hostIP);
};  //

 //if ($views) cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();
//endof executing

submitkey ("write","WF_UNDO_LAST");
      //îêîí÷àíèå ïðîöåäóðû óäàëåíèÿ.



}//  drugaya skobka ubrana

}

if (($massoper==2)AND($prdbdata[$tbl][12]!="fdb")){// redirect to showcode
    //ìîäóëü îáðàáîòêè  ïî ñóòè àíàëîã MASS_EXCH  ìîæåò åìó è ïåðåäàâàòòü âñå äàííûå ñ íàäñòðîéêîé ñïèñîê?
    echo "starting mass exchange $boxcnt entries.<br>";
for ($a=0;$a<$boxcnt;$a++) {
    $string=${box.$a};    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
  if ($debugmode)  echo "retrieving id1=$vID id2=$vID2 <br>";// íàøè ïåðåìåííûå â $vID i $vID2  $a - öèêë èìè óïëðàâëÿþùèé
  if ($virtualid=="") $vID2="";// åñëè íåò âèä2 òîãäà åãî çíà÷åíèå ïðîñòî íåíóæíî.   âîçìîæíî ýòî ãäå òî åù¸ íàäî äîáàâèòü.
    // êîïèÿ SHOWCODE
    // ïðîöåäóðà óäàëåíè $tablemysqlselect'$tblmysqlselect
        $connect = dbs_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17],$prdbdata[$tbl][12]);
	$data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols

         $cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE";
      $cmd.=" ".$mycol[$md2column]."= '".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd.=" AND ".$mycol[$virtualid]."= '".$vID2."'";};
        //added DIRECTEDIT for SHOWCODE (alternate realm)
 if ($directedit) {
             if ($directedit==2) $vID=base64_decode ($vID);
             $decodeddata=explode ("^^",$vID);
            //echo "bldjad  DIRECT EDIT BLYA!!";
                   $directeditwhere=gensqldirecteditwhere ($mycol,$decodeddata,$mycols);
                    $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE $directeditwhere ";
		     }
        //end of adding
        if ($debugmode) echo "Command $cmd;<br><br>";
        $result=dbs_query ($cmd,$connect,$dbtype);
        // real start copy
        //if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
	if ($debugmode) if ($result===true) { echo $vID.cmsg ("WF_CMP")."<br>";} else {
				//$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";
                                }

// ïå÷àòü   ôîðìèðîâàíèå òåêñòà çàïðîñà
    for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
		$insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
		echo $insertone."<br>";
	};

  if ($debugmode) echo cmsg ("WF_CCLOK")." ".$c."<br>";
		//echo "<br>".cmsg ("WF_QUECOMP")." ".dbs_affected_rows ()." ".cmsg ("WF_Q1")."<br>";
	if ($debugmode) if (!$pr[8]) {echo "DEBUG Ïîëó÷åí êîä $a<br>";}
	if ($pr[12]) {$act="SHOW_PATCH_SQL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // ëîãèðóåìñÿ

    //conec kopii SHOWCODE
}//  drugaya skobka ubrana



}




if ($massoper==4) { // dlya fdb po kakoy to prichine teryaetsya userfolder
    if ($debugmode)  echo "[debug]Userfolder=$userfolder;<br>";
$filbas=$userfolder."/best.cfg";  // âîçìîæíî áóäåò äá â initse  ñ ñîçäàíèåì øàïêè åñëè ôàéëà âîîáùå íåò+++
  @$best=csvopen ($filbas,"r",0);$data=readfullcsv ($best,"new");
 // $data=readdescripters ();
   $bestheader=$data[0];$bestplevel=$data[1];$bestcontent=$data[2];$bestcnt=$data[3];
  $strokedata=$activetable."¦".$tablemysqlselect."¦".$tblmysqlselect."¦"; // FORMAT^    tablename;id1Xid2;id1Xid2
  @fclose ($best);
//echo "==================SRAZU POSLE CHTENIYA==============<br>";
//debugcfgprint ($bestheader,$bestplevel,$bestcontent) ;
//echo "=================================================<br>";

  for ($a=0;$a<$bestcnt;$a++) {
  	if ($bestcontent[$a]!=="") if (strpos (@implode ($bestcontent[$a],"¦"),$strokedata)!==false) {
  		$rewritecnt=$a;
  	if (!$rewr)	{ echo "Already present, remove first please. Address:$rewritecnt of $bestcnt<br>";exit;}

  	}
  	//ïðîâåðêà ðàáîòàåò óñïåøíî , ïåðâàÿ çàïèñü äåëàåòñÿ èäåàëüíî ïðàâèëüíî.
  }
  echo "Massive have lines (bestcnt) =$bestcnt<Br>";

if (is_array ($bestheader)) { //header óæå åñòü
	$bestheader=implode ($bestheader,"¦");
	$bestplevel=implode ($bestplevel,"¦");
	echo "tempprint bestheader= $bestheader<bR>";};
if (($bestheader=="")OR($bestheader=="¦")) {  //header îòñóòñòâóåò
	$bestheader="activetable¦table¦db¦dataline-autohdr";	$bestplevel=$bestheader;
$newdata=1;$bestcnt=1; //only if no data allowed;
if (($OSTYPE=="LINUX")) { $bestheader.="\n"; $bestplevel.="\n"; } //AND($bestheader[count ($bestheader)-2]!=="\n")
		 } else { echo ""; };

// ñîçäàåì ëèïîâóþ øàïêó

echo "<br>";
if ($rewr) {$bestcnt=$rewritecnt+1; lprint ("REW_OK"); echo "<br>";}  //rewrite MO

// òóò íàäî èñêàòü ñòàðîå çíà÷åíèåíND");$action="UNBAN IP ".$cmd[1]."!";logwrite ($action);
		if ($OSTYPE=="LINUX") {$strokedata.="\n"; }//çàïèñü âåäåòñÿ ÁÅÇ ïðîâåðêè!! ñäåëàòü åå!   È ÷åòî íèõðåíà íå ïèøåòñÿ
 $bestheader=explode ("¦",$bestheader);$bestplevel=explode ("¦",$bestplevel);
if ($strokedata) {
//$strokedata=str_replace ("¦","+",$strokedata);//hide
//if ($bestcontent[$bestcnt-2]=="") { $bestcontent[$bestcnt-2]="null";};
//if (!$newdata) {$bestcnt++;};
$bestcontent[$bestcnt-1]=explode ("¦",$strokedata);
if($newdata) $bestcontent[$bestcnt]=explode ("¦",$strokedata);
$bestedit=1;};
//..echo "==================PERED OTPRAWKOJ==============<br>";
//debugcfgprint ($bestheader,$bestplevel,$bestcontent) ;
//echo "=================================================<br>";
//..echo "ÂÛÕÎÄÈÌ!";exit;
 if ($bestedit==1) {
     echo "File=$filbas";
	  $tempdescr=fopen ($filbas,"w");
	//  echo "===========CHECK:WRItEFULLCFG DATA=-==============<br>";
   	  $code=writefullcsv ($tempdescr,$bestheader,$bestplevel,$bestcontent);
   	  //echo "writefullcsv return code $code<br>";
   	 $edit=0;
   	 //echo "===============END WRITEFULLCFGDATAOUT=========================<br>";
  @$best=csvopen ($filbas,"r",0);$data=readfullcsv ($best,"new");
  $bestheader=$data[0];$bestplevel=$data[1];$bestcontent=$data[2];$bestcnt=$data[3];
  //echo "<font color=magenta>=============CHECK:best.cfg==============<br></red>Massive have lines (bestcnt)=$bestcnt<br>";
  //debugcfgprint ($bestheader,$bestplevel,$bestcontent) ;
//echo "=================================================<br>";
  @fclose ($best);

   	  }

 unset ($tempdescr,$bestheader,$bestplevel,$bestcontent);
}
//endif  massooper 4

}


//=========================================
//ìîäóëü çàïóñêà     AND($prdbdata[$tbl][12]!="fdb")
if (($write==cmsg ("KEY_MASS_OPER"))AND($prauth[$ADM][45])) { //  CFG OPT FUTURE  TODO:
lprint (M_OP_INF);echo "<bR>";

$data=readdescripters ();
echo "";
radio ("massoper",1,"M_OP_1") ;//printfield ($data,"addif1");
	//printcmp ("addifcmp1");
/*?><textarea name=addiflist1 cols= 25 rows=1 wrap=virtual><?=$addiflist1; ?></textarea><br><?php */
       txtarea ("sourceid",5,1);
       txtarea ("exchid",5,1);
       echo"<br>";
if ($prdbdata[$tbl][12]!="fdb") radio ("massoper",2,"M_OP_2") ;echo "<bR>";
if (!$prauth[$ADM][5]) echo "<gray>".cmsg ("M_OP_3").cmsg ("BLOCK")."</gray>";
if ($prauth[$ADM][5]) radio ("massoper",3,"M_OP_3") ;echo "<bR>";
radio ("massoper",4,"TO_BEST") ;checkbox ($rewr,"rewr"); lprint (REW_IF_PRES);echo "<br>";
radio ("massoper",5,"NOP") ;echo "<bR>";



while (list($var,$value) = each($_POST)) :
;
if (substr($var,0,3)=="bxt") { $box[]= explode ("¦",substr ($var,3)); $boxcnt++;
//echo "$var , ".substr($var,0,2) ."<br>";  generic table	//..echo "<BR>$var => $value <br>";
}
endwhile;
for ($a=0;$a<$boxcnt;$a++) {
//echo " box[$a]==>".$box[$a][0].";".$box[$a][1]."<br>";  //ids vID  vID2  DISABLE VISIBLE
hidekey ("box".$a,$box[$a][0]."+".$box[$a][1]);
}
//echo "ending cycle<br>";
echo "Total given: $a  <br>";
hidekey ("masstbl",$tbl);
//if ($massoper) hidekey ("massoper",$massoper);
hidekey ("boxcnt",$boxcnt);
hidekey ("given",$a);
hidekey ("cmd",0);
submitkey ("write","KEY_S_MASS_OPER");
}

//..==================================================
	//=========================================
//ìîäóëü çàïóñêà
if (($write==cmsg ("KEY_EXECUTE"))AND($prdbdata[$tbl][12]!="fdb")AND($prauth[$ADM][34])) { //  CFG OPT FUTURE  TODO:
if ($codekey==7) die ("Disabled for secutiry reasons.");


if ($codekey==5) needupgrade ();
// if (!$prauth[$ADM][2]) die ("Âîçìîæíî íå õâàòàåò ïðàâ ;)");
	$data=readdescripters ();$a=prefixdecode ($res16);
		//if ($data==-1) exit;
                if ($dblk) { $forcedb=1 ;
                    //echo "forced data dblk=$dblk , dbsel, tab=$tab";
                                hidekey ("dblk",$dblk); hidekey ("dbselected",$dblk);
                                hidekey ("hidemenu",1); hidekey ("cmd","sqle");
                                hidekey ("tab",$tab);
                                }
		if ($directexecute) { checkbox ($forcedb,"forcedb");lprint ("FORCE_DB");echo ":";
		$cmd="SHOW DATABASES"; //copy from dump execute
$a=dbs_query ($cmd,$connect,$dbtype);;
if ($a==false) echo "connection die";

//echo "<form action=dblinker.php method=post>";  maybe no need?
echo "<select name=dbselected>";
while ($result=dbs_fetch_row ($a,$dbtype)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
	if ($result[0]==$dblk) {$s="selected"; } else {$s="";};
	echo "<option value=".$result[0]." ".$s.">".$result[0]."";
}
echo "</select><br>";
}
   decodecols ($res16);
   if ($data>-1) {
   	checkbox ($selectenable,"selectenable");	echo cmsg (SORT_BY).":";printfield ($data,"field");
	checkbox ($limitenable,"limitenable") ; lprint ("WF_EX_LIM");
	inputtxt ("printlimit",3);echo "<Br>";
        checkbox ($disabledbselect,"disabledbselect") ;  lprint ("WF_EX_AUDB");
	checkbox ($disabledesc,"disabledesc") ; lprint ("WF_EX_NODS");
        checkbox ($disableprint,"disableprint");lprint ("WF_NO_RES_SQL");

   }
   echo "<br>";
	checkbox ($bugkosye,"bugkosye"); lprint ("WF_EX_TRYSKIPBUG");
        checkbox ($utf8,"utf8"); lprint ("UTF8");
        checkbox ($generic,"generic"); lprint ("GEN_SQL_FROM_EXEC");
        checkbox ($noprintsave,"noprintsave"); lprint ("NOPRINTSAVE");
        ?>
		<br>
  <input type="radio" name="cpymod" value="copyabort"> <?php lprint ("ABORT") ; ?>
    <input type="radio" name="cpymod" value="copyignore" checked> <?php lprint ("IGNORE") ; ?><br>
		<textarea name=vd cols=75 rows=8 ></textarea>

<?php echo "<br>";
submitkey ("write","KEY_S_EXEC");
submitkey ("write","WF_BCK_FILEDUMP_UNARCH");echo "<br>";
//submitkey ("write","");
echo "<br>";
}
//ìîäóëü îáðàáîòêè


if (($write==cmsg ("KEY_S_EXEC"))AND($prdbdata[$tbl][12]!="fdb")) {
// if (!$prauth[$ADM][2]) die ("Âîçìîæíî íå õâàòàåò ïðàâ ;)");
$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
$dbtype=$prdbdata[$tbl][12];
	if (!$disabledbselect) { $c=dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype); echo "Using: ".$prdbdata[$tbl][9]."<br>";}
	if (($directexecute)AND($forcedb)) {$c=dbs_selectdb ($dbselected, $connect,$dbtype);
		echo "Forced use: $dbselected<br>";	//$cmd="USE $dbselected;";	dbs_query ($cmd,$connect,$dbtype);;
	} ;
        if ($utf8) { dbs_query ("SET NAMES `utf8`;",$connect,$dbtype); };
	if (!$c) echo "connection failed<br>";
	if (!$disabledesc) $data=readdescripters ();// ïîëó÷åíèå äàííûõ çàãîëîâêà ìàññèâ mycol êîë-âî mycols
    $cmd=$vd;global $printlimit;
	// ìîäóëü ëèìèòèðîâàíèÿ âûâîäà SQL
	if ($printlimit and $limitenable) {
	settype ($printlimit,"integer");
if ($printlimit==false) { msgexiterror ("limit","noexit","disable");} else {$limit=" LIMIT $printlimit";};}
	// ìîäóëü ëèìèòèðîâàíèÿ âûâîäà SQL end
// ìîäóëü ñîðòèðîâêè
 if ($selectenable) $group=" GROUP BY ".$field."";
// êîíåö ìîäóëÿ ñîðòèðîâêè
//$qw=dbs_query ($cmd,$connect,$dbtype);;echo $qw."--"; dbserr ();
	//$patterns[0]="//\'/" ;$replacements[0]="'"; //Unknown modifier '\' in
	if ($debug) echo "key_s_exec check cmd - $cmd<br>";
        $patterns[0]="/\\\'/" ;$replacements[0]="'"; //4.1  check
	@$cmd=preg_replace ($patterns,$replacements, $cmd);//4.1  check
        if ($debug) echo "key_s_exec check cmd after preg replace - $cmd<br>";

        //CFG OPT FUTURE  TODO: - èìåííî çäåñü ñîäåðæèòñÿ ãëþê âûâîäà íà ïå÷àòü
	if (strpos ($cmd,"SELECT")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	if (strpos ($cmd,"SHOW")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	if (strpos ($cmd,"CHECK")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	if (strpos ($cmd,"REPAIR")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	if (strpos ($cmd,"ANALYZE")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	if (strpos ($cmd,"OPTIMIZE")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	if (strpos ($cmd,"BACKUP")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	if (strpos ($cmd,"RESTORE")!==false) $printing=1; // ðàçðåøàåò ïå÷àòü â libmysql
	$cmd=$cmd.$group.$limit; // èìåííî â ýòîì ïîðÿäêå
        $queries=explode (";\r",$cmd);  // òàê ïðîñòî ????? WTF
        //..$queries=preg_split ('\\' ,$cmd);
        //if (!$pregsplitdisabled) $queries=preg_split("#(ENGINE=[^\;]+)\;\r?\n#i",$cmd,-1,PREG_SPLIT_DELIM_CAPTURE);
        //print_r ($queries); echo "executing aborted --------- test ";
        //exit;
        ////  echo "forced data dblk=$dblk , dbsel, tab=$tab";
if ($generic)  { $printing=0; echo "std table out disabled by generating script<br>"; };
  //  âîò áëà.  â÷åðà âå÷åðîì áûëà çàêðûâàþùàÿ ñêîáêà è âñå ðàáîòàëî. à ñåãîäíÿ å¸ íåò. ÷òî çà7

        $countqueries=count ($queries);  //òóò âîò îøèáêà ñ âûïîëíåíèåì. ;  íåëüçÿ òàê äåëàòü  !!! èñïðàâèòü!!!
   // à òåïåðü âûïîëíåíèå áîëüøîãî êîëè÷åñòâà çàïðîñîâ
   //echo "q=".$countqueries."<br>";
	for ($cntque=0;$cntque<$countqueries;$cntque++) {
		unset ($errt);unset ($ermsg);
		$multicmd=$queries[$cntque];
		if ($multicmd=="") continue;
		$a=executesql ($multicmd,$connect,0);// áûëî
	if ($a==-1) executesql ($multicmd,$connect,2); //old mode for possible bugs issue
        //
        // ïðîñòîé ñêðèïò ïðîâåðêè - SELECT * FROM `tchars_t3can`.`guild` WHERE `guildid` NOT IN (SELECT `guildid` FROM `tchars`.`guild` WHERE 1=1);
        //. ñëî /// ýòî íå ñðàâíåíèå áëà SELECT * FROM `tchars`.`guild_bank_item` WHERE `guildid`='79';
////SELECT * FROM `tchars`.`item_instance` WHERE `guid` IN (SELECT `item_guid` FROM `tchars`.`guild_bank_item` WHERE `guildid`=79) LIMIT 10;
//SELECT `guid` FROM `tchars`.`item_instance` WHERE `guid` IN (SELECT `item_guid` FROM `tchars`.`guild_bank_item` WHERE `guildid`=79);
////SELECT * FROM `tchars_t3can`.`item_instance` WHERE `guid` IN (SELECT `item_guid` FROM `tchars_t3can`.`guild_bank_item` WHERE `guildid`=79) ; FINALE
// âûáðàòü âñå ÃÓÈÄÛ âñåõ âåùåé èç ãèëüäáàíêà è ïîêàçàòü èõ â äàííûõ  item_instance
                    // âîçìîæíî ýòîò êîä ñòîèò êàê òî âûäåëèòü ?  íà ãåíåðàöèþ êîäà... îí óæå ðàç 4-é òî÷íî èñïîëüçóåòñÿ ïî÷òè áåç èçìåíåíèé
               if ($generic) {echo "g _on ";  // çàëî÷èòü îáû÷íóþ ïå÷àòü ïðè ãåíåðàöèè êîäà ÷òîáû íå ëàãàëî
//echo $cmd;
$printing=0;  // disables print
//$cmd=" SHOW DATABASES;";
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
        $mycols=dbs_num_fields ($result,"");
	if ($result==true) { echo $vID.cmsg ("WF_CMP")."<br>";} else {
				$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";
                                //ïî÷åìó òî âñåãäà ïèøåò îøèáêó
                                }
                                // ìîæåò ýòó ôóíêöèþ âûäåëèòü îòäåëüíî?
if ($GENALT) {
    global $mycol;  // óëó÷øåííîå - ìîæíî âûäåëèòü CFG OPT FUTURE  TODO:// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];
}
$sourcetable="`".$prdbdata[$tbl][5]."`";// öåëåâàÿ áàçà äàííûõ óêàçûâàåòñÿ àâòîìàòè÷åñêè.
//$sourcetable="`".$prdbdata[$tbl][9]."`";// öåëåâàÿ áàçà äàííûõ óêàçûâàåòñÿ àâòîìàòè÷åñêè./
// ïå÷àòü   ôîðìèðîâàíèå òåêñòà çàïðîñà
   if ($noprintsave) {$dumpdbname=$sourcetable.$tbl."dbs_cut";
                        	@$ax=opendir ("_local/dump"); if ($ax==false) mkdir ("_local/dump");@closedir ($ax);
                        	$dumpfile=fopen ("_local/dump/".$dumpdbname,"w"); if ($dumpfile==false) die ("cannot open file $dumpdbname");
                                $xx="#::Dbscript $verchar :: $verwritefile :: http://dj.chg.su/dbscript/  Mysql Dump File \n\r";
                                fwrite ($dumpfile, $xx);
                    }
 if ($GENALT) $insertone="INSERT INTO $sourcetable ".$field." VALUES ";
    for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$GENALT) {
                    $insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
                    //echo "faak  -  $insertone=gencmdlog ($sourcetable,$myrow,$mycols,); ";
                    if (!$noprintsave) echo $insertone."<br>";  // â äðóãèå ÷àñòè ýòîé êîïèè ñêðèïòà âíåäðèòü ñîõðàíåíèå â ôàéë (!!!) CFG OPT FUTURE  TODO:
                    if ($noprintsave)  {
                        fwrite ($dumpfile,$insertone);
                    };
                }
                if ($GENALT) {
                    $insertone.=gennohdlog ($sourcetable,$myrow,$mycols,$field).",";
                    //echo "faak  -  $insertone=gennohdlog ($sourcetable,$myrow,$mycols,); ";

                }
                // ïîòîì óëó÷øèòü ÷òîáû íå äåëàëà èçëèøíèé êîä

	};
       if ($GENALT)  {$insertone[strlen($insertone)-1]=";";

           if (!$noprintsave) echo $insertone."<br>";
                    if ($noprintsave) {
                        fwrite ($dumpfile,$insertone);
                    };
           }


      };
   if ($noprintsave)  { fclose ($dumpfile) ;
       echo "File dump written to $dumpdbname <br>"; exit;
   }
                    //..îêîí÷àíèå âñòàâêè êîäà ãåíåðàöèè
		if ($a==-1) {
			$silent=0;$error++; $errno=dbserr ();
			if ($errno>0) echo "Full text query:$multicmd<br><br>";
			if ($cpymod=="copyabort") { lprint ("CP_AB_");exit;}
		};

	if (!$pr[8]) echo "EXEC LN $cntque -- ".$multicmd."<br><br>";
	if ($a>0) echo cmsg ("WF_EXQUES").$a."<br>";
	if ($a==0) $skipped++;

	if ($a==-1) { $errt=cmsg ("WF_EX_FAIL"); $ermsg="$a<br>";$multicmd="ignored";}
	if ($pr[12]) {if ($multicmd[0]="\n") {$multicmd[0]=" "; $multicmd[1]=" ";};
					$act="EXECUTE $multicmd "; logwrite ($act) ;

	}

	};  // ëîãèðóåìñÿ
	if (($countqueries-1)>1) {echo "<br>".cmsg (WF_SEND_SQL_E_T)." ".($cntque-1-$error)."/".($countqueries-1)."<br>";
	if ($skipped) echo cmsg ("BCK_SKIP").$skipped."<br>";
	if ($error) echo cmsg ("BCK_ERR").$error."<br>";
	}

}




echo "</form>"; // êîíå÷íûé òåã äëÿ âñåãî

// ôóíêöèè ýêñïîðòèðîâàíèÿ è èìïîðòèðîâàíèÿ áàç NEW
function importexporttbl ()
{
	 global $prdbdata; global $prauth; global $ADM;
	 global $pr; global $sd;global $tbl; global $write;
  //if (($write==cmsg("A_IMPEXP"))OR($write==cmsg("A_IE_DEST"))OR($write==cmsg("A_IE_SRC"))OR($write==cmsg("A_IE_START"))) { echo "";} else  { return;} // íåäîïåðåíåñåíî êóäà íàäî.
   	 global $sd17; global $addmode; global $send; global $views;
	 global $tbl1;global $tbl2;global $totalbas; global $filbas,$codekey,$usecomma2x;
		 if ($codekey==7) demo ();
	if ($prauth[$ADM][10]<2) { lprint ("ACCDEN"); exit;};
	if ($prauth[$ADM][2]==false) { lprint ("ACCDEN"); exit;};
	//íå ðàçðåøàåò àäìèíèñòðèðîâàòü íå èìåÿ ýòîãî ïðàâà - çàùèòà îò àëüòåðíàòèâíîãî âõîäà ($prauth[$ADM][10]<2)
	 if ($prauth[$ADM][16]==0) {
	 echo cmsg (CONV_NOTE)."<br>";
	 }

	?> <form action=w.php method=post><?php hidekey ("vID",$vID);
hidekey ("colfind",$colfind);
hidekey ("tbl1",$tbl1);
hidekey ("tbl2",$tbl2);
hidekey ("ietbl",1);
// colfind - ïîêà íå ïîäêëþ÷åí áóäåò ðàçâåðòûâàòñÿ
for ($a=0;$prdbdata[$a]==true;$a++) {
$k = count($prdbdata);$l= $k+1;
$filbas=$prdbdata[$a][0] ; $bas[$a]=$prdbdata[$a][1];
}

// $k= count($db) - âû÷èñëåíèå êîë-âà ñòîëáöîâ
// c7 0 - select  c7 1 - start
$pr16=$pr[16];
	echo cmsg ("A_CONV_SRC")."<select name = tbl1 size = ".$pr[2].">";
	for ($a=0;$a<$totalbas;$a++) {
		echo "<option value=$a ".(("selected") and ($a==$tbl1)).">".$bas[$a]."</option>";
//		if ($a!==$tbl) echo "<option value=$a >".$bas[$a]."</option>";
//		if ($a===$tbl) {echo "<option value=$a ".(("selected") and ($a==$tbl)).">".$bas[$a]."</option>";}
		}
//PART OF ID tbl

$filbas=$prdbdata[$tbl1][0];			$namebas=$prdbdata[$tbl1][1];
$needscr=$prdbdata[$tbl1][2];		$scrdir=$filbas."scr";
$formatscr=$prdbdata[$tbl1][3];		$category=$prdbdata[$tbl1][4];
$tablemysqlselect=$prdbdata[$tbl1][5]; if ($tablemysqlselect==="") $tablemysqlselect=0;	//reset to default
$hostmysqlselect=$prdbdata[$tbl1][6];  if ($hostmysqlselect==="") $hostmysqlselect=0;	//reset to default
$categorymode=$prdbdata[$tbl1][7];	$scrcolumn=$prdbdata[$tbl1][8];
$tblmysqlselect=$prdbdata[$tbl1][9];
$md1column=$prdbdata[$tbl1][10];		if ($md1column==="") $md1column=1 ;	//reset to default
$md2column=$prdbdata[$tbl1][11];		 if ($md2column==="") $md2column=0;	//reset to default
$dbtype=$prdbdata[$tbl1][12];		$writeright=$prdbdata[$tbl1][13];
$needrights=$prdbdata[$tbl1][14];	$virtualid=$prdbdata[$tbl1][15];
$reserved16=$prdbdata[$tbl1][16];	$reserved17=$prdbdata[$tbl1][17];
 //íàéäåí êîä òðåáóåìîé áàçû
$filbas=$prdbdata[$tbl1][0];

  if (isset ($colfind)) { $colfind= $md2column;}

submitkey ("write","A_CONV_SRC_CHG");
?> </form>
<form action=w.php method=post>
<?php hidekey ("vID",$vID);
hidekey ("colfind",$colfind);
hidekey ("tbl1",$tbl1);
hidekey ("tbl2",$tbl2);
hidekey ("ietbl",1);
// colfind - ïîêà íå ïîäêëþ÷åí áóäåò ðàçâåðòûâàòñÿ
for ($a=0;$prdbdata[$a]==true;$a++) {
$k = count($prdbdata);$l= $k+1;
$filbas=$prdbdata[$a][0] ; $bas[$a]=$prdbdata[$a][1];
}

// $k= count($db) - âû÷èñëåíèå êîë-âà ñòîëáöîâ// c7 0 - select  c7 1 - start
$pr16=$pr[16];
	echo cmsg ("A_CONV_DEST")." <select name = tbl2 size = ".$pr[2].">";
	for ($a=0;$a<$totalbas;$a++) {
		echo "<option value=$a ".(("selected") and ($a==$tbl2)).">".$bas[$a]."</option>";
//		if ($a!==$tbl) echo "<option value=$a >".$bas[$a]."</option>";
//		if ($a===$tbl) {echo "<option value=$a ".(("selected") and ($a==$tbl)).">".$bas[$a]."</option>";}
		}
//PART OF ID tbl

$filbas2=$prdbdata[$tbl2][0];		$namebas2=$prdbdata[$tbl2][1];
$needscr2=$prdbdata[$tbl2][2];	$scrdir2=$filbas2."scr";
$formatscr2=$prdbdata[$tbl2][3];	$category2=$prdbdata[$tbl2][4];
$tablemysqlselect2=$prdbdata[$tbl2][5];	 if ($tablemysqlselect2==="") $tablemysqlselect=0;	//reset to default
$hostmysqlselect2=$prdbdata[$tbl2][6];  if ($hostmysqlselect2==="") $hostmysqlselect=0;	//reset to default
$categorypr4=$prdbdata[$tbl2][7];$scrcolumn2=$prdbdata[$tbl2][8];
$tblmysqlselect2=$prdbdata[$tbl2][9];
$md1column2=$prdbdata[$tbl2][10]; if ($md1column2==="") $md1column2=1 ;	//reset to default
$md2column2=$prdbdata[$tbl2][11];	 if ($md2column2==="") $md2column2=0;	//reset to default
$dbtype2=$prdbdata[$tbl2][12];	$writeright2=$prdbdata[$tbl2][13];
$needrights2=$prdbdata[$tbl2][14];	$virtualid2=$prdbdata[$tbl2][15];
$reserved162=$prdbdata[$tbl2][16];	$reserved172=$prdbdata[$tbl2][17];
 //íàéäåí êîä òðåáóåìîé áàçû
// procs from standart csv<-->sql converter
$separator = stripslashes($separator); $separator = stripcslashes($separator);
if (!$separator)   $separator = "¦";  // separator s changed - work
if ($usecomma2x) { $separator=";"; echo "Forced using ; as separator , plevel writing declined.<br>";  }
$version = "dbs ed"; $path_to_temp = "";

function char2array($string) {
   $len = strlen($string);
   for ($j=0;$j<$len;$j++){
       $char[$j] = substr($string, $j, 1);
   }
   return ($char);
}

function sqlify_line($line, $splitseparator,$separator,$ncols) {
   $line = chop($line);
   $line_chunks = split ($splitseparator, $line);
   if ($ncols != sizeof($line_chunks)) print "<br># îøèáêà, íåñîîòâåòñòâèå êîëîíîê è äàííûõ<br>";
   for($i=0;$i<count($line_chunks);$i++) {
      $s = trim($line_chunks[$i]);
      if ($s[0] == $s[strlen($s)-1] && ($s[0] == "'" || $s[0] == '"')) {
        $s = substr($s,1,strlen($s)-2);
     }
      $line_chunks[$i] = addslashes($s);  //rejected  <font color="#000BA">  </red>
   }
   for($i=0;$i<count($line_chunks);$i++) {
      if ($i == (count($line_chunks)-1))
         $comma = "";
      else
         $comma = ", "; // $separator.
      $final_line  .= "'$line_chunks[$i]'$comma";
   }
   return $final_line;
}

function field_fix($line) {
   $line = preg_replace("[[:space:]]+", "", $line);
   $letterarray = char2array($line);
   for ($i=0;$i<count($letterarray);$i++) {
      if (preg_match("^[_a-z0-9-]+", $letterarray[$i]))
         $fieldname .= $letterarray[$i];
   }
   return $fieldname;
}

//end procs standart csv<-->sql converter
  if (isset ($colfind2)) { $colfind2= $md2column2;}

 submitkey ("write","A_CONV_DEST_CHG");
 ?></form>  <?php    echo cmsg ("A_CONV_TOEXEC").":<br>".cmsg ("A_CONV_SRC").$namebas." (".$tbl1.") -->".cmsg ("A_CONV_DEST")." ".$namebas2." (".$tbl2.")<br>";
	if ($dbtype==$dbtype2) { echo "<red>".cmsg ("A_ONESTRUCT")."</red><br>";};
	if (($dbtype=="fdb") AND ($dbtype2=="mysql")) { echo " CSV->->SQL.<br>";};
	if (($dbtype=="mysql") AND ($dbtype2=="fdb")) { echo " SQL->->CSV.<br>";};

if ($write===cmsg ("A_CONV_START")) {
	if ($prauth[$ADM][10]<2) { lprint ("ACCDEN"); exit;};
	set_time_limit(0);
	//ïðîöåññ
	//  2235 to 22355   spreg_matcha   3377 removed to 2235
	if ($dbtype==$dbtype2) { lprint ("A_ONESTRUCT");exit;};
	//start decoding SCP to CSV
	if (($dbtype==2) AND ($dbtype2=="fdb")) {
		$filbas="_data/".$prdbdata[$tbl1][0];
		echo "<font color=red>Ðàáîòà íàä äàííûì ðåæèìîì íå çàêîí÷åíà.</red><br>".$filbas;
		iniparse ($filbas,21) ;};
	//end of decoding SCP to CSV

	//  CSV to SQL
	if ((($dbtype=="fdb") AND ($dbtype2=="mysql"))) {
	$filbas=$prdbdata[$tbl1][0];// ãäå òî ÂÑÅÃÄÀ òåðÿåò $filbas ïðèøëîñü òàê ñäåëàòü
	$csv_file_name=$filbas;
	$csv_file=$filbas;  //reconfig
	if (!$filbas) { echo "Filebas = $filbas !!!!!!"; exit; };
	$db_host=$hostmysqlselect2;
	$user_nm=$sd[14]; //õì à ïî÷åìó Access denied for user '1'@'localhost' (using password: YES) in /media/D/Work/KERNEL/dj/site/dbscore.lib on line 1172
	$password=$sd[17];
	$DATABASE=$tblmysqlselect2;echo "DEBUG DATABASE dest=$DATABASE";
	$table=$tablemysqlselect2;echo "DEBUG Table dest=$table";
//        echo "filbas=$filbas ; db_host=$db_host ; user_nm=$user_nm ; passwor=$password db=$DATABASE tab=$table";äàííûå èäóò âåðíûå

//echo "!DATABASE ".$DATABASE."!table".$table."!pas".$password;
   $separator = '¦';  //changed
   if ($usecomma2x) { $separator=";"; echo "Forced using ; as separator , plevel writing declined.<br>";  }
  $splitseparator = $separator;

   $table_nm = split ("\.", $csv_file_name);
   $table_name = strtolower($table_nm[0]); // ne ustr
   $table_name=$tablemysqlselect2;
   $out_header = "# source: $tblmysqlselect -- $tablemysqlselect<br># dest : $tblmysqlselect2 -- $tablemysqlselect2 ";


   if ($send) {
      header("Content-disposition: filename=$table.csv");
      header("Content-type: application/octetstream");
      header("Pragma: no-cache");
      header("Expires: 0");
      $client=getenv("HTTP_USER_AGENT");
      if (preg_match('[^(]*\((.*)\)[^)]*',$client,$regs)) {
         $os = $regs[1];
         if (preg_match("Win",$os)) $crlf="\r\n";
      }
   }


   if ($csv_file != "none") {
      $location = $path_to_temp.mktime().".csv";
      copy("_data/".$csv_file,$location) or die ("Failed to copy");
      //unlink($csv_file);
      $file_content = file($location);

      $fields = explode ($splitseparator, $file_content[0]);

      for($i=0;$i<count($fields);$i++) {
         $fields[$i] = field_fix($fields[$i]);
      }
	  $table_create = "";
	//added drop db
	//  $table_create .= "DROP DATABASE IF EXISTS `".$DATABASE."` ;\n";
	//$connect = dbs_connect ($prdbdata[$tbl2][6], $prdbdata[$tbl2][13] , $sd[17],$dbtype2); // fail? $sd[14]
        if (!$dbtype2) $dbtype2="mysql";
        echo "Connected: ".$prdbdata[$tbl2][6]." by user $sd[14] <br>";
        $connect = dbs_connect ($prdbdata[$tbl2][6], $sd[14] , $sd[17],$dbtype2); // fail? $sd[14]
	$query="";
	  if ($addmode) {
	 $query= "CREATE DATABASE `".$DATABASE."` ;\n";
	dbs_query ($query,$connect,$dbtype2);
	  $query= "DROP TABLE IF EXISTS `$table_name` ;\n";
  	dbs_query ($query,$connect,$dbtype2);
	 $query="";
		}
      $table_create .= "CREATE TABLE `$table_name` (\n";
      if ($unique) $table_create .= "   id smallint(6) DEFAULT '0' not null auto_increment,\n";
      $numfields = count($fields);
      for ($i=0;$i<$numfields;$i++) {
         if ($i == ($numfields-1))
            $comma = "";
         else
            $comma ="," ;//$comma = $separator;
         $table_create .= "   `$fields[$i]` CHAR(225) not null$comma\n"; // text?
         $field_names  .= "$fields[$i]$comma ";
      }
      if ($unique) $table_create .= "   PRIMARY KEY (id),\n   UNIQUE ID (id)\n";
      $table_create .= ")ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED ;\n\n";  //test added engine to ; without ;
	  	  if (!$addmode) {  $table_create = "";} // addmode
      if (!$send)
         echo "</center><p align=\"left\"><pre>";
      if ($views) {  echo $out_header; };
//      if ($views) {  echo $table_create; };
	  $query=$table_create;
      if ($unique) $unique_field = "id, ";
      for($i=1;$i<count($file_content);$i++) {
        $partquery.="\n INSERT INTO $table_name ($unique_field".trim($field_names).") VALUES (";
		if ($views) { echo ""; };
   		if ($unique_field) $uniqq = "'$i', ";
		$partquery.=$uniqq.sqlify_line($file_content[$i], $splitseparator,$separator,$numfields)."); \n";
         if ($views) { echo ""; }
      }
	  	$query.=$partquery; // îêîí÷àòåëüíûé çàïðîñ òóò!
	//if ($views) { echo $partquery;}
// 	simple execute

	//mysqli_select_db ($prdbdata[$tbl2][9], $connect);
        dbs_selectdb ($prdbdata[$tbl2][9],$connect,$dbtype2);
//	executesql ($query,$connect,"",1);  bad use only this command
$find;
$ax=array(); // ïî÷åìó òî âàðèàíò ñ ðàçäåëåíèåì íà ñòðîêè êóäà ëó÷øå ðàáîòàåò
$ax=explode (";",$query );
for ($ab=0;$ab<count($ax)-1;$ab++) {
 if ($views) echo "<ii><bb>to execute ::: <br>".$ax[$ab].";<br>--- query $ab ---</ii></bb></bb><br>";
 $find=$find+executesql ($ax[$ab].";",$connect,"",2);
 if ($views) echo "<br>--------<br>";
}


//	echo "6=".$prdbdata[$tbl2][6]." 13=".$prdbdata[$tbl2][13]." 17=".$sd[17]." selected db=".$prdbdata[$tbl2][9]."<br>";
//	$result = dbs_query ($query,$connect,$dbtype);($query, $connect);
//	if ($result<1) { echo " Ïðîöåäóðà èìïîðòà íå óäàëàñü.  <br>$result<br>"; };
//	$myrow =dbs_fetch_row ($a,$dbtype);
      if (!$send)
         echo "</pre><p>";
   } else {
      echo "Íåîáõîäèì CSV äëÿ êîíâåðñèè";

   }
   echo "Ïðîöåäóðà çàêîí÷åíà, âûïîëíåíî $find îïåðàöèé.";
   @unlink($location);
exit;
		};

	// END CSV TO SQL

	// SQL TO CSV
	if (($dbtype=="mysql") AND ($dbtype2=="fdb")) {
	//	echo "Ïðåîáðàçîâàíèå SQL â CSV.";
	$separator="¦";
        if ($usecomma2x) { $separator=";"; echo "Forced using ; as separator , plevel writing declined.<br>";  }
	$csv_file_name=$namebas2;  //reconfig
	$db_host=$hostmysqlselect;
	$user_nm=$sd[14];
	$password=$sd[17];
	$DATABASE=$tblmysqlselect;
	$table=$tablemysqlselect;

//ïðîöåäóðà î÷åíü äàâíî íå ïðîâåðÿëàñü,  åå íàäî âûíåñòè â w.php  è êàê ñëåäóåò ïðîøòóäèðîâàòü

   $connect=dbs_connect($db_host, $user_nm, $password,$dbtype) or die( "Unable to connect to SQL server");
   @dbs_selectdb($DATABASE,$connect,$dbtype) or die( "Unable to select DATABASE");
   $sqlcont = "select * from $table";
   $result = dbs_query($sqlcont,$connect,$dbtype);
   echo dbserr();

   function make_csv_happy($string,$separator) {
      $string = trim($string);
      if (preg_match("\$separator",$string)) {
         $string = preg_replace("\"", "\"\"", $string);
         $string = "\"".$string."\"";
      }
      $string = preg_replace(10, "", $string);
      $string = preg_replace("\r", "", $string);
      return $string;
   }

   if (mysqli_fetch_field_direct($result, 0) == "id") $first_field = "iD";

   while($col < mysqli_num_fields($result)) {
      $fname  = mysqli_fetch_field_direct($result, $col);
      if ($col < mysqli_num_fields($result)-1)$comma = $separator;
      else $comma = "";
      if (($col == 0) && ($first_field)) {
         $names .= $first_field.$comma;
         $plevels .= "0".$comma; }
      else
         { $names .= make_csv_happy(strtoupper($fname),$separator).$comma;
         $plevels .= "0".$comma; }
      $col++;
   }
   $final = $names."\n";
   if ($separator=="¦") {echo "Generating dbs 4.x compactible header...<br>";
   $final .= $plevels."\n";//plevel generic  ñäåëàòü âûáîð ðàçäåëèòåëÿ äëÿ ñîõðàíåíèÿ - dbs 4.x 2.x (;)
   }
   while($row < mysqli_num_rows($result)) {
      $col=0;
      $line = "";
      while($col < mysqli_num_fields($result)) {
         $fname = mysqli_fetch_field_direct($result, $col);
         if ($col < mysqli_num_fields($result)-1)$comma = $separator;
         else $comma = "";
         $line .= make_csv_happy(mysqli_result($result,$row,$fname),$separator).$comma;
         $col++;
      }
      $final .= $line."\n";
      $row++;
   }
   if ($send) {
      header("Content-disposition: filename=$table.csv");
      header("Content-type: application/octetstream");
	  header("Pragma: no-cache");       header("Expires: 0");
      $client=getenv("HTTP_USER_AGENT");
      if (preg_match('[^(]*\((.*)\)[^)]*',$client,$regs)) {
         $os = $regs[1];
		 if (preg_match("Win",$os)) $crlf="\r\n";
      }
   } else {
      echo "</center><p align=\"left\"><pre>";
   }
	// 		end SQL TO CSV

	 if ($views) echo $final;
	if ($addmode) {
			@$f=fopen ("_data/".$filbas2,"w") or die ("Íå ìîãó ïîäñîåäèíèòñÿ ê áàçå.");
	@fwrite ($f,$final) or die ("Íåâîçìîæíî ïðîèçâåñòè çàïèñü");
	@fclose ($f);
			} else {
			@$f=fopen ("_data/".$filbas2,"a+") or die ("Íå ìîãó ïîäñîåäèíèòñÿ ê áàçå.");
	@fwrite ($f,$final) or die ("Íåâîçìîæíî ïðîèçâåñòè çàïèñü");
	@fclose ($f);
			} ;


   if (!$send) echo "</pre></p>";

		};
	echo "Çàäà÷à ïîñòàâëåíà, ïîäîæäèòå ïîæàëóéñòà äî îêîí÷àíèÿ ïðîöåññà è íå ïåðåêëþ÷àéòå ñòðàíèöó.	";

	exit;
}

?>
<form action=w.php method=post>
<?php hidekey ("db_host",0);
hidekey ("user_nm",0);
hidekey ("password",0);
hidekey ("DATABASE",0);
hidekey ("table",0);
hidekey ("tbl1",$tbl1);
hidekey ("tbl2",$tbl2);
hidekey ("ietbl",1);
	?>

<?php checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
   checkbox ($unique,"unique") ; echo cmsg ("A_CONV_SETUID")."<br>";
   checkbox ($usecomma2x,"usecomma2x") ; echo cmsg ("USECOMMA2X")."<br>";
   checkbox ($addmode,"addmode"); echo cmsg ("A_CONV_SETREWR")."<br>"; ?>
<?php   hidekey ("separator",";");
 	submitkey ("write","A_CONV_START");
	echo "</form>";
}


endtm ();
end;

/* 
 */




?> 
