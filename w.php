<?php
// Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex
if ($_FILES) ob_start(); // добавлено т.к. в 2033 строке непонятно прислали файл вообще или нет
require_once ('dbscore.lib'); // функция подготовки к работе и авторизации
if (!$activation) Header("Location: login.php");;  //http://127.0.0.1/dj/site/login.php  старая авторизация  в dbscript zone всплыла - когда убирать то?
//$error=pg_connect ("!","2","3");echo $error;    postgre-php not installed
// TinyMCE addition 
  /* ?> <script type="text/javascript" src="tinymce/tiny_mce.js"></script>
   <script type="text/javascript">
       tinyMCE.init({
               mode:"textareas",
               theme:"advanced",
               language:"en"
           });
    </script><?
*/
$verwritefile="Editor v4.3.13 beta (c) dj--alex";
 global $verwritefile,$vID,$vID2;

$enterpoint=$verwritefile;// для показа точки входа
autoexecsql (); 
import_request_variables ("PGC","");  // универсальное решение проблем
//прием долбаных файлов
// часть некоторых загрузок переменных можно удалить
if (isset($_FILES["userfile"])) ob_start (); // такое чувство что эта часть кода просто игнорируется.


$writefile=1;
IF ($pr[36])  if (!isset($_SERVER['PHP_AUTH_USER']) ||
   ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
  authenticate ();}  



if ($frameoldcore==0) $fil=getvar ('fil'); //было установлено неверное 1
 if ($fil!==false) {$data= explode (";",$fil); 
					$tbl= $data[0];	$vID=$data[1];	$vID2=$data[2]; $datafieldcolsel=$data[3];// virtual id
				 };
 // настройка префиксов для работы с любым языкомым cmd
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
    <?
		//section select group
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
        groupdbprint ($grouplist2,"IP",$prdbdata,$tbl,$ipfilter);// IP CFG OPT FUTURE groupdbfielddetect
	submitkey ("write","SELECT");
	if ($prauth[$ADM][2]) submitkey ("live","LIVEMOD");echo "*";
 	if ($live) echo "in future release!";  // 		hidekey ("live",$live);  STATEMENT LOST
        }
 		echo"</form>";
}


?>
<form action="w.php" method=post><?
hidekey ("vID",$vID);
hidekey ("vID2",$vID2);//...hidekey ("colfind",$colfind);
hidekey ("groupdb",$groupdb);//added
hidekey ("ipfilter",$ipfilter);

//модуль запуска и обработки
if ($write==cmsg ("KEY_CFG")) {
	echo "<br>".cmsg ("ADM_CSEL").":<br>";
	submitkey ("write","CF_USRS"); 	submitkey ("write","CF_DB");submitkey ("write","CF_FIL");
 	submitkey ("write","CF_DWORD");	submitkey ("write","CF_PAGES");
	submitkey ("write","CF_STYL");	submitkey ("write","CF_LSET");
        submitkey ("write","CF_SRV");	if ($prauth[$ADM][42]) submitkey ("write","CF_CMD");
        exit;
}

// $k= count($db) - вычисление кол-ва столбцов// c7 0 - select  c7 1 - start
$deftbl=$pr[16];

//if (!$hidemenu)
if (($prauth[$ADM][24]==false)OR(!$tbl)) { printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbl",lprint ("SELLINK"),$groupdb,$ipfilter,6);
submitkey ("write","A_USRGO" ); //найден код требуемой базы
}
  //if (isset ($colfind)) { $colfind= $md2column;} для чего ее нигде нету?
?>
</form>

<?

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
			//если таблица не установлена пытаемся подобрать наиболее похожую.
			// 6 - server - not checked.  пропущено. мб потом добавить
		if ($prdbdata[$a][9]===$dblk) { $tbl=$a ;$errorredirectdb=1;} //проверка базы, выбор любой таблицы из базы наугад
					}   // не используется покачто

		if (!$modeselectsimilartable) {
	
	$tbl=1;
		$prdbdata[$tbl][12]="mysql";
		$prdbdata[$tbl][5]=$tab;		$prdbdata[$tbl][0]=$tab;
		$prdbdata[$tbl][1]=$tab;		$prdbdata[$tbl][6]=$mainhostmysql; //6 
		$prdbdata[$tbl][9]=$dblk;$errorredirectdb=1;}
		//подставка значений вместо данных из dbdata CFG OPT FUTURE - возможно переключение 2 режимов
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


// Проверка уровня прав
if ($prauth[$ADM][10]<$writeright) msgexiterror ("notrights",$writeright,"w.php");
// Внесена правка чтобы нельзя было редактировать таблицу 2-го уровня с 2-м уровнем прав.

if ($prauth[$ADM][2]) {  //модуль совместимости с conf файлами.
	if ($write==cmsg ("CF_USRS")) { $tbl="gmdata";$namebas=$tbl;};
	if ($write==cmsg ("CF_DB")) {$tbl="dbdata";$namebas=$tbl;};
	if ($write==cmsg ("CF_FIL")) {$tbl="files";$namebas=$tbl;};
	if ($write==cmsg ("CF_DWORD")) {$tbl="denywords";$namebas=$tbl;};
	if ($write==cmsg ("CF_PAGES")) {$tbl="pages";$namebas=$tbl;};
	if ($write==cmsg ("CF_STYL")) {$tbl="styles";$namebas=$tbl;};
	if ($write==cmsg ("CF_LSET")) {$tbl="langset";$namebas=$tbl;};// dalee chastx from libmysql
        if ($write==cmsg ("CF_SRV")) {$tbl="srvlst";$namebas=$tbl;};// dalee chastx from libmysql
        if ($prauth[$ADM][42]) if ($write==cmsg ("CF_CMD")) {$tbl="cmdlines";$namebas=$tbl;};// dalee chastx from libmysql
	//require_once ("_sys/rfsysdatareq.php");
	rfsysdatareq ();
	if ($namebas=="") { $namebas=$tbl;$filbas=$tbl.".cfg";$cfgmod=1;};
}

if ($tbl) if (($prdbdata[$tbl][12]!=="mysql")AND($prdbdata[$tbl][12]!=="fdb")AND($prdbdata[$tbl][12]!=="pg")AND($prdbdata[$tbl][12]!=="ibase")) msgexiterror ("SCP","Alias=$tbl,as =".$prdbdata[$tbl][12],"admin.php");
if ($cfgmod==2) msgexiterror ("nologsedit",$namebas,"w.php");


?>
<form action="w.php" method=post>
<?

if (!$hidemenu) {
hidekey ("groupdb",$groupdb);//added  - группа при выборе операции в редакторе более не теряеся.
hidekey ("ipfilter",$ipfilter);//added  - группа при выборе операции в редакторе более не теряеся.
    echo "ID1 ";inputtxt ("vID",30); }
if ($prdbdata[$tbl][22]) $directedit=1;
if (!$directedit) if (($virtualid==true)OR($virtualid=="0")) {
   if (!$hidemenu) {  echo "ID2 ";inputtxt ("vID2",8); }
};
if ($directedit) { echo " Directedit mode.";} // hidekey ("vID2",$vID2); $vID2=""; не помогло от  Это значение незанято.

#################################################################
// Поправки на текущие настройки
################################################################3/
//вывод текущей ячейки


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
 
if ($prauth[$ADM][6]) { submitkey ("write","KEY_HEAD");}; //CFG OPT FUTURE!
if ($prauth[$ADM][10]) { submitkey ("write","KEY_AN");  };
if ($prauth[$ADM][35]) { submitkey ("write","KEY_MASEXC");submitkey ("write","A_IMPEXP"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][35])AND(!$cfgmod)) { submitkey ("write","KEY_MASCPY"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][35])AND(!$cfgmod)and($prdbdata[$tbl][12]!="fdb")) { submitkey ("write","KEY_SHOWCODE"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][34])and($prdbdata[$tbl][12]!="fdb")) { submitkey ("write","KEY_EXECUTE"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][43])and($prdbdata[$tbl][12]!="fdb")) { submitkey ("write","BACKUPS"); };  //CFG OPT FUTURE!

if ($prauth[$ADM][43]) {
     submitkey ("write","KEY_COMPARE"); submitkey ("write","KEY_MACRO");echo "<br>"    ;};



}
echo "<br>";
  if (($write===cmsg("A_IMPEXP"))AND ($prauth[$ADM][10]>0)) { importexporttbl () ; exit;}
  //if (($ietbl==1)AND ($prauth[$ADM][10]>0)) { importexporttbl () ; exit;}
   if ($write===cmsg("A_IE_DEST")) { importexporttbl () ; exit;} // недоперенесено куда надо.
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
	

//модуль запуска и обработки
if (($write==cmsg ("KEY_VIEW"))AND($prdbdata[$tbl][12]=="fdb")) {
$mode=2;//$scrcolumn=0;$tablemysqlselect=0;$md2column=0;
if ($cfgmod==1) { // просто копия режима 4 из readfile
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
//mode 6 процедура CSV поиска по новой колонке  НЕ СДЕЛАНО
// процедура поиска по имени  - mode 1 - CSV
if (($prauth[$ADM][18]>0)AND($noaddmode==1))
 {
$mznumb=array ();lprint ("WF_CMPALL"); echo "<br>";
// ВСТРОИТЬ, МОДЕРНИЗИРОВАТЬ  	$query=$query.") AND `".$mycol[$md2column]."` NOT LIKE '%".$vID."%'";
// TEST ZONE
	//SQL$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$res16=$prdbdata[$tbl][16];// Лимит колонок
	 global $presettedmode,$categorymode,$m6field,$m6count,$mode,$fields;//декодирование строки
	global $selectedfield,$multisearch;	global $categorymode,$mode;
	global $mode6,$m6field,$m6count; // $m6count; - kakogo hera ne peredan
	global $mycols,$mycol,$del,$res16,$presettedmode,$selectedfield;
	global $partquery,$vID,$fields,$multisearch;
	prefixdecode ($res16);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
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
  if (($dbc[$md2column]==$vID)OR($findidorig!==false)) { echo "</tr>" ;continue ; }  //добавлено чтобы повторно не показывался   улучшено удаляя все совпадения
		   $selected[]=$dbc;   //added
   }
 } 
 }
  selectedprintcsv ($data,$mycol,$selected);
 }	
 //from readfile partends
}

//модуль запуска и обработки
if (($write==cmsg("KEY_AN"))AND($prdbdata[$tbl][12]=="fdb")) {
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
// $z to mycol  other $z is dupl and changed to myrow  
			$data=readdescripters ();  if ($data==-1) exit; 
	while ($myrow=xfgetcsv ($f,$xfgetlimit,"¦")) {	$countquery=$myrow[$md2column];
					settype ($countquery, integer);
						if ($countquery>$maximalcntmd2) $maximalcntmd2=$countquery;
									$maxquery++;}
//	распечатка данных из дескрипторов
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








//модуль запуска 
if (($write==cmsg ("KEY_EDIT"))AND($prdbdata[$tbl][12]=="fdb")) {
	if ($vID==="") { echo cmsg ("WF_FSELID")."<br>"; exit;};

	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");
//	echo "dEBUG vID2=$vID2 virtualid=$virtualid<br>";
	echo "<br>";
			$data=readdescripters ();  if ($data==-1) exit;
                        $mycolvirtualname=$data[3]; if (strlen ($mycolvirtualname[0])<1) $mycolvirtualname=$mycol;// CFG OPT FUTURE
        if ($virtualid=="") $vID2=""; // затычка , т.к. нам присылают второй ид а он нам не нужен вроде бы
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
		//проверка не занят ли ID
	if ($myrow===false) { 
		echo cmsg ("QUE_EMP")."<br>";   // какого хера оно незанято из конфигурации когда стопудово известо что оно ЗАНЯТО БЛЯ!!!
		exit;
	}
//end проверка не занят ли ID
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
			<textarea name=z<?=$a; ?> cols=40 rows=1><?=$myrow[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$countdatafieldstowrite;$a++)
			{ //hdr text	//

				if ($prauth[$ADM][41])echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";
		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE 
		if ($lensa>50) $lensa=50;
			?>
			</td>
			<?
if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrow[$a]?></textarea><br></td><? 
			//echo "<tr>";//optionalBox,not linear edit.
			
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

//модуль обработки
if (($write==cmsg("KEY_S_EDIT"))AND($prdbdata[$tbl][12]=="fdb")) {
if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) { @$f=csvopen ("_conf/".$filbas,"r","0");
	if ($codekey==7) demo ();
	}
	echo "<br>";
	// origid1 i origid2  можно использовать для гаранта удаления измененной записи.
	$data=readdescripters();
	$mycol=xfgetcsv ($f,$xfgetlimit,"¦");
	$a=0;$cnt=count ($mycol);
			for ($a=0;$a<$cnt;$a++)
			{
	$myrow[$a]=${"z".$a};//принимаем данные юзера
    //$x=getidbyid ($prauth,0,"realid",$myrow[0]);// это имя редактируемого пользователя
    $x=getidbyid ($prauth,0,"realid",$myrow[0]);
 //echo "realid=$x prauth x 0 ".$prauth[$x][0]." prauth adm 0 ".$prauth[$ADM][0]."<br>";exit;
//  echo "x2= $x2  x42=$x42";exit;
  if (!$prauth[$ADM][42])  if (($cfgmod==1)and($filbas=="gmdata.cfg")) { $myrow[2]=$prauth[$x][2];$myrow[42]=$prauth[$x][42] ;};
 //защита настроек прав если нет права суперпользователя - целью является принудить использовать настройку профилей.
	if ($a===0) { $values="".$myrow[$a];}
	if ($a>0) {$values="".$values."¦".$myrow[$a]; }
if (!$pr[8]) {  echo "DEBUG Decoding incoming data z$a -- $myrow[$a]<br>";}
			}
			echo $OSTYPE;
		//тменен тк при сохранении заголовка вызывал его смещение.
if ($OSTYPE=="LINUX") if ($values[strlen ($values)-1]!=="\n") $values=$values."\n";
		if ($OSTYPE=="WINDOWS")	$values=$values."\n";  // csv linux   bug  pustye stroki FI
// заменен vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid] просто мегазатычка :)
// а теперь поправили мегазатычку более корректно  md2- oridid1  virid - orig2
//echo "Starting executing query <br>";// эта строка вообще не видна при gmdata ili dbdata   vidimo 200 polej - mnogo
csvmod ($f,"edit",$values,$origid1,$origid2);
lprint ("WF_QUECOMP");
if ($pr[12]) {$act="EDIT_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // логируемся
submitkey ("write","WF_UNDO_LAST");
}



//модуль запуска
if (($write==cmsg ("KEY_ADD"))AND($prdbdata[$tbl][12]=="fdb")) {
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
	$data=readdescripters ();  if ($data==-1) exit; 
		$mycolvirtualname=$data[3]; if (strlen ($mycolvirtualname[0])<1) $mycolvirtualname=$mycol;
                ////подсчета пустой ячейки

		while ($myrow=xfgetcsv ($f,$xfgetlimit,"¦")) {	$countquery=$myrow[$md2column];
					settype ($countquery, integer);
						if ($countquery>$maximalcntmd2) $maximalcntmd2=$countquery;
									$maxquery++;}
		echo cmsg ("WF_1NOTUSED").":".($maximalcntmd2+1)."<br>";  // это в автомат добавлять.    CFG OPT откл.
		rewind ($f);		//	erase&rewind :) перемотать $F!!!
		//конец завершения подсчета пустой ячейки
	$mycol=xfgetcsv ($f,$xfgetlimit,"¦");
        	if ($cfgmod==1) $mycol=$data[0];// чтение заголовков правильно !!! в нужной кодировке!!! 
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
		//проверка не занят ли ID
	if ($myrow===false) { 
		echo cmsg ("QUE_EMP")."<br>";
		$myrow[$md2column]=$vID;
		if (($virtualid>0)AND ($vID2!=="")) $myrow[$virtualid]=$vID2;
	}
//end проверка не занят ли ID
$oldcoreedit=$prauth[$ADM][39];
if ($oldcoreedit)
	for ($a=0;$a<$cnt;$a++)
			{
			echo "$mycolvirtualname[$a]";
			if ($mycol[$md2column]===$mycol[$a]) {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=30 rows=1><?=$myrow[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=0% bordercolor=#602621>"; // непонятное изменение . 100% было заменено на 0 .цель неясна.
			for ($a=0;$a<count ($mycol);$a++)
			{ //hdr text	//	
				if ($prauth[$ADM][41])echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycolvirtualname[$a] ";// перевести
			if ($mycol[$md2column]===$mycol[$a])  {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";
		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE
		if ($lensa>50) $lensa=50;
			?>
			</td>
			<?
if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrow[$a]?></textarea><br></td><? 
			//echo "<tr>";//optionalBox,not linear edit.
			
			} //field text
			
			echo "</table>";
	}
 submitkey ("write","KEY_S_ADD");
 echo "<br>";
}


//модуль обработки
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
	$myrow[$a]=${"z".$a};//принимаем данные юзера
	if ($a===0) { $values="".$myrow[$a];}
	if ($a>0) {$values="".$values."¦".$myrow[$a]; }
if (!$pr[8]) {  echo "DEBUG Decoding incoming data z$a -- $z[$a]<br>";}
			}
if ($OSTYPE=="LINUX") if ($values[strlen ($values)-1]!=="\n") $values=$values."\n";			
			if ($OSTYPE=="WINDOWS")	$values=$values."\n";

	csvmod ($f,"add",$values,$myrow[$md2column],$myrow[$virtualid]);
	lprint ("WF_QUECOMP");
	if ($pr[12]) {$act="ADD_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // логируемся
        submitkey ("write","WF_UNDO_LAST");
}



//модуль запуска 
if (($write==cmsg ("KEY_DEL"))AND($prdbdata[$tbl][12]=="fdb")) {
		if (($virtualid==true)AND($vID2==false)) echo "<red>".cmsg
		("WF_DEL_GROUP")." ".$vID." </red><br>";
		if ($vID==="") { echo cmsg ("WF_FSELID")."<br>"; exit;};

 submitkey ("write","KEY_S_DEL");
}

//модуль обработки
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
if ($pr[12]) {$act="DEL_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;	};  // логируемся
submitkey ("write","WF_UNDO_LAST");
}


//модуль запуска  массовая замена текстовый режим
if (($write==cmsg ("KEY_MASEXC"))AND($prdbdata[$tbl][12]=="fdb")) {
	$nofilestreamallowed=1;// для readdesdcripters если есть чтобы убивал свой линк
		echo cmsg ("WF_SELFLD").":";// Вставлено для выбора поля
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
  ?><textarea name=subindex cols= 5 rows=1 ><?=$subindex; ?></textarea>,<? lprint ("WF_EXCSPLT") ; ?> ,<textarea name=subsplitter cols= 4 rows=1 ><?=$subsplitter; ?></textarea><br>
 <?   // start compare addif
checkboxcorrect ("addifenable1",$addifenable1) ;
	echo "**".cmsg ("WF_IF")."1 :"; printfield ($data,"naddif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?
checkboxcorrect ("addifenable2",$addifenable2) ;
	echo "**".cmsg ("WF_IF")."2 :"; printfield ($data,"naddif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
		<?
	// end compare addif   Вставлено для выбора поля
	echo "<br>".cmsg ("WF_DUPL")."<br>";
	if (strlen ($vID2)!==0) echo cmsg ("WF_ID2HLP")."<br>"; 
submitkey ("write","KEY_S_EXCH");
}

//модуль обработки
//массовая замена текстовый режим
if (($write==cmsg ("KEY_S_EXCH"))AND($prdbdata[$tbl][12]=="fdb")) { //FIX IT!s
	$nofilestreamallowed=1;// для readdesdcripters если есть чтобы убивал свой линк
	// полученные данные:
	//field - номер поля\колонки
	//strupdmode - режим работы allstrokes, substrokes,subindstrokes
	//nolimit 
	//addifenable1 разрешение первого доп условия addif1 - поле условия  UNSUPPORTED
	//addifenable2 разрешение доп условия addif2 - поле условия UNSUPPORTED
	//addifcmp1,2 знаки в порядке очередности = != >> <<   IGNORED!!! UNSUPPORTED
	//addiflist1,2  список значений,которые можно сравнивать, не раб в << >> если более 1 PARTIAL UNSUPPORTED
	//sourceid   исходник,   exchid - конечный результат
if (!$cfgmod) $filename="_data/".$filbas;
if ($cfgmod==1) $filename="_conf/".$filbas;
if ($cfgmod==2) $filename="_logs/".$filbas;
// $wfemptyenab
	 if (($codekey==4)) needupgrade ();	 if (($codekey==9)OR($codekey==7)) demo ();
	if ($nolimit) {set_time_limit(0);} else {set_time_limit(120) ;};
	if (($prauth[$ADM][5]==false)AND($delete)) { unset ($delete); echo "r";};// сброс от нелегальных delete
	if (!$strupdmode) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>Не указан режим работы!";exit;};
	if (strlen ($exchid)==0) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>Не указана цель замены!";exit;};
	if (!$wfemptyenab) if (($strupdmode=="substrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>Ограничение</bb><br></red>".cmsg ("WF_ER_NOSUB"); exit;} ;
	if ($strupdmode==="subindstrokes") { 
		if (!$subindex) { echo "<red><bb>Ошибка</bb><br></red>".cmsg ("WF_ER_NOIND").".<br>" ;exit ; };
		if (!$subsplitter) { echo "<red><bb>Ошибка</bb><br></red>".cmsg ("WF_ER_SPLIT").".<br>" ;
		} ; exit; };
	if (($prauth[$ADM][4]===false)AND($strupdmode!=="substrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>Ограничение</bb><br></red>Нельзя заменять любое значение на нужное вам из принципов безопасности." ; exit;} ;// all_> sub
	//окончание обработки ошибок    	//	начало csv части обновителя  ===!!!!======
	@$f=csvopen ($filename,"r","0");//открываем базу
	echo "<br>";
	$hdr=xfgetcsv ($f,$xfgetlimit,"¦"); // пропускаем заголовки,т.к. их перемотала программа чтения
	$mycol=$hdr;
	$plvl=xfgetcsv ($f,$xfgetlimit,"¦");
	$tbld=array (); 
	$cnt=0; //$b[0]=0;
	$sampletotest1=explode (",",$addiflist1);
	$sampletotest2=explode (",",$addiflist2);
	echo "DEBUG Runned mode= $strupdmode<br>";
	while (!feof($f)) 
		{	// здесь судя по всему идет разбитие по строкам оригинального массива.
		$tbldorig[$cnt]=fgets ($f); $tbld[$cnt]=explode ("¦",$tbldorig[$cnt]);
		// - значение взятое из файла        значения разбитые по колонкам - т.е.индекс строки+еще индекс колонки
//программа для сравнения дополнительных условий
 if ($addifenable1) { 
    $datatotest=$tbld[$cnt][$addif1];// без N
	$addifgrants1=granttest ($datatotest,$addiflist1,$addifcmp1);
 }
 if ($addifenable2) { 
    $datatotest=$tbld[$cnt][$addif2];// теор.можно любое число полей для сравнения.в
	$addifgrants2=granttest ($datatotest,$addiflist2,$addifcmp2);
 	};
 	
 	 // функция возвращает соответствие условию   $datatotest - данные для проверки, list - список образцов cmp- метод срав
 	 if (($wfemptyenab)AND($sourceid=="")) { $nulldataen=1;$sourceid="NULL";}//обеспечение "пустого условия" if ($cnt>1) 
	if ($strupdmode=="substrokes") if ((strpos ($tbld[$cnt][$field],$sourceid)!==false)OR($nulldataen==true)) { 
							$select=$cnt;//echo "Значение заменено.<br>"; //$tbld[$cnt]=$z;
							$replid=$tbld[$cnt][$field];$oldreplid=$replid;
	//						echo "BUGGED!?  DEBUG replid=$replid=str_replace (src=$sourceid, exch=$exchid,replid=$replid);";
							$replid=str_replace ($sourceid, $exchid,$replid);
							if ($wfemptyenab) $replid=$exchid;
							//сделать мини функцию для проверки с парам addifgranttest ()
							if (($addifenable1)AND($addifgrants1===false)) {$replid=$oldreplid;$findrecords--; };
							if (($addifenable2)AND($addifgrants2===false)) {$replid=$oldreplid;$findrecords--; };
							$tbld[$cnt][$field]=$replid;
							if ($delete) $tbld[$cnt][$field]="_DELETE_IS_REQUIRED!!!";
							$tbldorig[$cnt]=implode ("¦",$tbld[$cnt]); //зам на values
							$findrecords++;
							if (!$pr[8]) {echo "DEBUG Selected data - ".$tbld[$cnt][0]." must changed to $replid ($values)<br>";}
							//echo "AFTERborigcnt ".$tbldorig[$cnt]." CONTAIN MUST EXCHANGED TO! ex $exchid<br>";//LOG
							}
	
		if ($strupdmode=="allstrokes") { if (($tbld[$cnt][$field]==$sourceid)OR($nulldataen==true)) { 
							$select=$cnt;//echo "Значение заменено.<br>"; //$tbld[$cnt]=$z;
							$replid=$tbld[$cnt][$field];$oldreplid=$replid;
			//				echo "BUGGED!?  DEBUG replid=$replid=str_replace (src=$sourceid, exch=$exchid,replid=$replid);";
							$replid=str_replace ($sourceid, $exchid,$replid);
							if ($wfemptyenab) $replid=$exchid;
							if (($addifenable1)AND($addifgrants1===false)) {$replid=$oldreplid;$findrecords--; };
							if (($addifenable2)AND($addifgrants2===false)) {$replid=$oldreplid;$findrecords--; };
							$tbld[$cnt][$field]=$replid;
							if ($delete) $tbld[$cnt][$field]="_DELETE_IS_REQUIRED!!!";
							$tbldorig[$cnt]=implode ("¦",$tbld[$cnt]); //зам на values
							$findrecords++;
							if (!$pr[8]) {echo "DEBUG Selected data - ".$tbld[$cnt][0]." must changed to $replid ($values)<br>";}
							//echo "AFTERborigcnt ".$tbldorig[$cnt]." CONTAIN MUST EXCHANGED TO! ex $exchid<br>";//LOG
							 };
}
	if ($strupdmode=="subindstrokes") if (strpos ($tbld[$cnt][$field],$sourceid)!==false) { 
							$select=$cnt;//echo "Значение заменено.<br>"; //$tbld[$cnt]=$z;
							$data=$tbld[$cnt][$field];$oldreplid=$data;$guided=$tbld[$cnt][$md2column];
	$replid=$dataexp;
	echo $tbld[$cnt][0]." -- ".$tbld[$cnt][$field]." -- ".$field." <br>"; 
		$dataexp=explode ($subsplitter,$data); // subindex
		if ($dataexp[$subindex]==$sourceid) { 
//echo "Dataexp - $dataexp ;; dataexp index ".$dataexp[$subindex]." ;; index  $subindex;  source $sourceid; exh $exchid<br>";
				$dataexp[$subindex]=$exchid;
			$replid=implode ($subsplitter,$dataexp);
			//$replid=str_replace ($sourceid, $exchid,$replid);// replid это массив который нужд в изменении
		}	
							if (($addifenable1)AND($addifgrants1===false)) {$replid=$oldreplid;$findrecords--; };
							if (($addifenable2)AND($addifgrants2===false)) {$replid=$oldreplid;$findrecords--; };

							$tbld[$cnt][$field]=$replid;
							if ($delete) $tbld[$cnt][$field]="_DELETE_IS_REQUIRED!!!";
							$tbldorig[$cnt]=implode (";",$tbld[$cnt]); //зам на values
							$findrecords++;
							if (!$pr[8]) {echo "DEBUG Selected data - ".$tbld[$cnt][0]." must changed to $replid ($values)<br>";}
							//echo "AFTERborigcnt ".$tbldorig[$cnt]." CONTAIN MUST EXCHANGED TO! ex $exchid<br>";//LOG
							}
		$cnt++;
		}
// $tbld - массив содержащий все конечные данные - долженбыть обязательно использован и конвертирован
echo "<br>Заменено всего значений : $findrecords<br><br>";
		//	$select=0;//added for compactibility
	$cntdb=$cnt+1;
	if ($select===false) { echo "__SELECT_ERROR";exit;};
// процедура получает сведения из б\д и создает внутреннюю большую переменную
// в ней заранее заменяется нужное значение в обоих случаях
// готовимся к записи//_WRITE213.85.55.251
	
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
  		if (($delete)AND(strpos ($myrow,"_DELETE_IS_REQUIRED!!!"))) { echo "Строка $a удаляется!"; continue;} 
  		$writedata=$myrow;//$writedata=implode ($myrow,"¦")."\r\n";
		fwrite ($dest,$writedata);
	}
fclose ($dest);
//exit;//LINUX FAILURE WRITING BUG  
		//$f=csvopen ($filename,"backup",0);			
	/*	for ($a=0;$a<5;$a++)	{ echo "";			}//без разницы  даже если тыщу раз повторит все равно ни.... не удаляет.
		
		//@$del=unlink ($filename);  //как меня затрахало это permission denied ERROR!BUG!  ВАШУ МАТЬ БЛИН!
		$realp=realpath ($filename);
		//$del=unlink ($realp);  //как меня затрахало это permission denied ERROR!BUG! ПОТРАЧЕНО НА ЭТО НЕСКОЛЬКО НЕДЕЛЬ !!!
		//echo "try realpath $filename is =$realp; ";
                //fclose ($f) ;
                echo "Real path for file:$realp<br>"; // нельзя просто так удалять файл - именно это вызывает его создание при вкл глобальности (пр34)
		//$e=csvopen ($filename,"delete",0);		 // ШОБ ТВОЮ МАТЬ INITSE блокировал!!!!

                //echo"[debug]deleting $filename code return=$e<br>";
                //$e=unlink ($filename) ;
                //echo"[debug]deleting2 $filename  code return=$e<br>";
		$e=csvopen ($filename.".exch","rename",$realp); // ешь
                echo"[debug]ren $filename.exch code return=$e<br>";
		//echo "csvopen ($filename.exch,rename,$filename);	";
		//$f=csvopen ("_conf/dbdata.cfg.exch","rename","_conf/dbdata.cfg");	
		if ($del==true) break;
         *
         */
		
	
	if ($pr[12]) {$act="MASS_EXCH_DAT  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // логируемся
}


//модуль запуска и обработки
if (($write==cmsg("KEY_MASCPY"))AND($prdbdata[$tbl][12]=="fdb")) {
	
	 if (($codekey==9)OR($codekey==7)) demo ();
	if ($cfgmod==1) { lprint ("CFG_LIM"); exit;};
	
	lprint ("WF_MASCPYMSG");// Вставлено для выбора поля
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a; копия модуля из начала writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,0,0);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"destination",cmsg ("WF_MAS_DEST"),$groupdb,0,0);
	//конец выбора колонки из текущей базы
// должны использоваься только FDB таблицы.
 ?><br><input type= hidden name=go value=Переход_копирование> 
 <?   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
  if ($prauth[$ADM][5]==1) echo ""; // резерв для удаления
 lprint ("WF_MASCPYACT") ; ?> <br>
  <input type="radio" name="cpymod" value="copyabort"> <? lprint ("ABORT") ; ?> 
  <input type="radio" name="cpymod"  value="copyrewrite"> <? lprint ("REWRITE") ; ?>
  <input type="radio" name="cpymod"  value="copyignore"> <? lprint ("IGNORE") ; ?><br>
 <? 	// start compare addif
echo cmsg ("WF_MASCPYIFHLP")."<br> ";
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 wrap=virtual><?=$addiflist1; ?></textarea><br>
<?	checkboxcorrect ("addifenable2",$addifenable2) ;
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 wrap=virtual><?=$addiflist2; ?></textarea><br>
	<?
        lprint ("NO_PROC") ;
        needupdate ();
        if (($codekey==4)) needupgrade ();
        submitkey ("write","KEY_S_COPY");
}

// пока процедура обработки не готова

//модуль запуска 
//сделать возможно одновременную или раздельную правки?
//SQL HEADER
if (($write==cmsg("KEY_HEAD"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	 	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
 if ($data==-1) exit; 
	 echo "<br>".cmsg ("WF_HDSEL")."<br>";
	 //echo "*"; submitkey ("write","WF_HDRSQL_REAL"); REMOVED  NOT USED
 	 submitkey ("write","WF_HDRSQL_VIRT");
 	 submitkey ("write","WF_STRC_SQL"); 	 
 	 submitkey ("write","WF_STRC_DAT");echo "<br><br>";
 	 submitkey ("write","CFG_COPY");submitkey ("write","WF_NEW_TAB");
         submitkey ("write","WF_SHOW_TAB_CRT");
 	  
}


//модуль запуска 
//сделать возможно одновременную или раздельную правки?
if (($write==cmsg("BACKUPS"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	 infrestsql($connect,$prdbdata,$tbl);

	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
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
set_time_limit(0);// CFG OPT FUTURE?
//echo $sd[14].$sd[17];
$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
if ($newdb) $dest=$newdb;
	copydatabase ($source,$dest,$connect);
	$action="WF_BCK_UNARCH ".$source.".".$dest.".".$connect." ";logwrite ($action);		
}



// Запускной модуль создания бэкапа
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


// модуль создания живого бэкапа
//CREATING DUMP AT SQL SIDE AS COPY SQL DATABASE
if (($start)AND($backupdbname)AND ($prdbdata[$tbl][12]!="fdb")) {echo "Создается -живой- бэкап $backupdbname...<br>";
set_time_limit(0);// CFG OPT FUTURE?
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	copydatabase ($prdbdata[$tbl][9],$backupdbname,$connect);
 $action="DB_COPY ".$prdbdata[$tbl][9].".".$backupdbname.".".$connect." ";logwrite ($action);		
}

//copy full tables   копирование полный таблиц
//#########################################################################
/// /CREATING DUMP AND EXECUTING AT REMOTE SERVER   NA - NOT USED TMP
if (($write==cmsg("WF_BCK_TRANS"))AND ($prdbdata[$tbl][12]!="fdb")) {
	@$connect2 = dbs_connect ($mysqlserver2,$sd[14],$sd[17],$dbtype);
	 set_time_limit(0);// CFG OPT FUTURE?
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
 // - не работает !!?? Fatal error: Maximum execution time of 60 seconds exceeded in /media/E/KERNEL/dbs/dbscore.lib  on line 4107
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
	echo "Режим: Dbscript side, data";
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
        // тут мы где то потеряли encodng
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
                                        $x=detectencoding($insertone);   if ($views)   echo "Encoded str: ".$x."<br>?";  //dobawil utf-8  какая то левая процедура. die () не работает
                              if (($x!=="utf-8")AND($sd[19]=="utf-8")) $insertone=iconvx("windows-1251","utf-8",$insertone);
		fwrite ($dumpfile,$insertone);
		$strclines++;		//echo $insertone."<br>";
	};	
				
	}
	
	//if ($debugmode)	echo "DEBUG $query.<br>";
	$query="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;";
	$result=dbs_query ($query,$connect,$dbtype); sqlerr();
// печать   формирование текста запроса
	for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
    	$mycols=count ($myrow);
		$insertone=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols,"");
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
                        $x=detectencoding($insertone);    if ($views) echo "Encoded ln : ".$x."<br>?";  //dobawil utf-8  какая то левая процедура. die () не работает
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
	 set_time_limit(0);// CFG OPT FUTURE?  backup restore   
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
         checkbox (0,"mysqldump"); lprint ("M_DMP");echo "<br>";
if (!$pr[20]) submitkey ("start","SELF_BCK");
}


//восстановить копии таблиц SQL
if (($write==cmsg("WF_BCK_COPYTBL_UNARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
	echo "WF_BCK_COPYTBL_UNARCH<br>";
}


//MENU SQL SIDE ;Сделать копии таблиц SQL
if (($write==cmsg("WF_BCK_COPYTBL_ARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
	 set_time_limit(0);// CFG OPT FUTURE?
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
	set_time_limit(0);// CFG OPT FUTURE?
	echo cmsg (W_CRT_DMP)." $dumpdbname...<br>";
	echo "Режим: SQL side<br>";
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
	
	$cmd="SHOW TABLES";// может выделить просмотр баз данных и таблиц в отдельные процедуры и их везде сделать стартовыми?
$a=dbs_query ($cmd,$connect,$dbtype);;
while ($result=dbs_fetch_row ($a,$dbtype)) {
	$tablelist[]=$result[0];$cnt++;//echo "table added to list ::".$result[0]."<br>";
	}
	
for ($a=0;$a<count ($tablelist);$a++) {
    if (($onetable)AND($tablelist[$a]!==$prdbdata[$source][9])) continue; //непроверено!!!!111
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
	echo "Режим: Dbscript side, data";
	if ($structure) echo "+structure";// проверить правильно ли мы получаем соединение если указан сервер из servlst.cfg
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
	$dumpfile=fopen ("_local/dump/".$dumpdbname,"w"); if ($dumpfile==false) die ("cannot open file $dumpdbname");
	$x="#::Dbscript $verchar :: $verwritefile :: http://dj.chg.su/dbscript/  Mysql Dump File \n\r";
	fwrite ($dumpfile,$x);
        //echo "STATUS onetable=$onetable , source= $source ".$prdbdata[$source][5]."<br>";
for ($a=0;$a<count ($tablelist);$a++) {
	if (($onetable)AND($tablelist[$a]!==$prdbdata[$source][5])) continue;
        if ($mysqldump) { 
            fclose ($dumpfile);@unlink ($dumpfile); // CFG OPT FUTURE -  некогда ща это править
            $filetowrite="_local/dump/".$dumpdbname.$date;
            //if ($OSTYPE=="LINUX") if ($zip) $sys.="| gzip -c ".$filetowrite.".sql.gz";//'date "+%Y-%m-%d"'
            $sys="mysqldump -u ".$sd[14]." -p".$sd[17]." ".$prdbdata[$tbl][9]." --routines > ".$filetowrite.".sql";
            $print="mysqldump ".$prdbdata[$tbl][9]." --routines > ".$filetowrite.".sql";
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
         *     * --skip-opt - отменяет настройки mysqldump по умолчанию. В частности - отменяет многострочный оператор INSERT
    * --order-by-primary - строки INSERT в дампе будут сортироваться по ИД, так что найти нужную строку будет гораздо проще
    * --default-character-set=utf8 - помните, я говорил про возможные проблемы с кодировкой? Подстрахуемся (надеюсь, вы уже не используете сp1251?)

         */
        echo "bnre4t5gg9[ph5[gk5opgjk5ipju5hju5l45pht45phjybip45ju8jopyhjph8j59j8458g45ou7hr4gop45h45og";
        //    Делать бекап конкретной базы от пользователся (у которого есть права на эту базу).
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
		                $x=detectencoding($insertone);   if ($views)   echo "Encoded ln : ".$x."<br>?";  //dobawil utf-8  какая то левая процедура. die () не работает
                              if (($x!=="utf-8")AND($sd[19]=="utf-8")) $insertone=iconvx("windows-1251","utf-8",$insertone);

                fwrite ($dumpfile,$insertone);
		$strclines++;		//echo $insertone."<br>";
	};	
				
	}
	
	//if ($debugmode)	echo "DEBUG $query.<br>";
	$query="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;";
        $sourcetable="`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`";
	$result=dbs_query ($query,$connect,$dbtype); sqlerr();
// печать   формирование текста запроса
	for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
    	$mycols=count ($myrow); //updating to gennohdlog !!! 
		//$insertone=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols,"");
                $GENALT=1;//$insertone=gennohdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols,"");
                     // может эту функцию выделить отдельно?                   //..  http://www.thumbshots.com/
if ($GENALT) {
    global $mycol;  // улучшенное - можно выделить CFG OPT FUTURE// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];

   
}
// echo "$field";
// печать   формирование текста запроса
 if ($GENALT) $insertone="INSERT INTO $sourcetable ".$fields." VALUES ";
    for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$GENALT) {
                    $insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
                    echo $insertone."<br>";
                }
                if ($GENALT) {
                    $insertone.=gennohdlog ($sourcetable,$myrow,$mycols,$field).",\n";

                }
                // потом улучшить чтобы не делала излишний код

	};
       if ($GENALT)  {$insertone[strlen($insertone)-2]=";";
//оконч встав  ошибка
		//что генерируется при ' внутри и как оно потом выполняется
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
                if ($views) echo $insertone."<br>";
                                $x=detectencoding($insertone);    if ($views)  echo "Encoded ln : ".$x."<br>?";  //dobawil utf-8  какая то левая процедура. die () не работает
                              if (($x!=="utf-8")AND($sd[19]=="utf-8")) $insertone=iconvx("windows-1251","utf-8",$insertone);

		fwrite ($dumpfile,$insertone);
		$lines++;
		//echo $insertone."<br>";
                }// забыл
		
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
	


//SQL EXECUTE сюда заливает файл с именем юзера в + и сам вызывает выполнение WF_BCK_FILEDUMP_UNARCH

//Restore from file dump at dbscript folder
//восстановить из дампа в папке dbscript
if (($write==cmsg("WF_BCK_FILEDUMP_UNARCH"))AND ($prdbdata[$tbl][12]!="fdb")) {
@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
if ($connect==false) {sqlerr($connect);exit;}
if ($dblk) { hidekey ("dblk",$dblk);$forcedb=1;};// ajфорсировать выбор если прислали название базы данных
	checkbox ($forcedb,"forcedb");lprint ("FORCE_DB");echo ":";
$cmd="SHOW DATABASES";
$a=dbs_query ($cmd,$connect,$dbtype);;
if ($a==false) {sqlerr($a);exit;}
 //echo" dblk=<br>";
//.. здесь где то проверку пути надо улучшить если коннект не дали - дать другой
// echo "<form action=dblinker.php method=post>"; needed for?   unknown
//show already connected list of databases     requires name for menu and displayed title  (may cmsg-ed)
//name - название меню,  title - заголовок этой выборки
//function directselectsqldb ($connect,$name,$title) { //name==dest always!,
echo "<select name=dbselected>";
while ($result=dbs_fetch_row ($a,$dbtype)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
        if ($result[0]==$dblk) {$s="selected"; } else {$s="";};
	echo "<option value=".$result[0]." ".$s.">".$result[0]."";
}
echo "</select><br>";

	$path=getcwd ()."/_local/dump/";   //надо сделать возможность выбора папки прямо отсюда, хоть тупо вверх вниз или назначать её через filemgr
        if (($pr[39])AND(is_dir($pr[39]))) $path=$pr[39];
        
        
	echo cmsg (PATH_DUMP_DBS)."$path<br>";
	echo cmsg (SEL_FILE)."<br>";  //oldcore copy filemgr mod  ..
	//echo "Path=$path<br>";
		$path2=$fldup."/_local/dump";
			$mask="*.*";//wse ok
			$protect[]="*.php";$protect[]="*.rar";
			$files=getdirdata ($path,$mask,$protect);
			if ($files==false) { 
					echo " Ищем далее...<br>";
					//echo "2=getdirdata ($path2,$mask,$protect);";
					$files=getdirdata ($path2,$mask,$protect);
					if ($files==false) echo "Folder not found, 2 tryes.";;
			}
		echo "<form method=post>";
echo "<select name=\"dump[]\" multiple size=10>";
		for ($a=2;$a<count ($files);$a++){
				if ($files[$a][0]=="") continue;
				echo "<option>".$files[$a][0]."";
			}
			unset ($files);
echo "</select><br>";
checkbox ($views,"views") ; echo cmsg (WF_LOG).cmsg (NORECOMM)."<br>";
checkbox ($dumpmode1,"dumpmode1") ; echo cmsg (OLDCOREDUMPEX)."<br>";
checkbox ($dumpmode2,"dumpmode2") ; echo cmsg (OLDCOREDUMPEX2)."<br>";
checkbox (0,"mysqldump") ; echo cmsg (M_DMP_UPL)."<br>";
// hidekey ("dbtype",$dbtype);нихера не передается.
//checkbox ($disviews,"disviews") ; echo cmsg (WF_LOG).cmsg (NORECOMM)."<br>";
        echo "Encoding can be set in table (alias) properties.<br>";
        echo "manual set encoding:";inputtxt ("encodeset",15);echo " (utf-8 , not utf8)<br>";


 submitkey ("start","DALEE");
echo "</form>";
echo "<form method=\"post\" action=\"filemgr.php\" target=_blank>";
        submitkey ("cmd","FMG_DUMP_UPLOAD");
        echo "</form>";
}
// для одинаковых надписей мож доб пот. перем. step  1.1 1.2 1.3 :)))
// процедура восстановления базы данных из дампа.
if (($dump)AND($start==cmsg(DALEE))) {
if (($dblk)AND(!$forcedb)) {$forcedb=1;$dbselected=$dblk;	}
	$path=getcwd ()."/_local/dump/";
        $dbtype="mysql"; // default dbtype in CFG OPT FUTURE! 
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
        if ($encodeset) { // global настройка для mysql  pr[76]  почему то не работает .. действует только локальная.
            echo "setting NAMES and CHARACTER SET one more time to $encodeset... <br>";
        dbs_query("SET NAMES $encodeset", $connect,$dbtype);
        dbs_query("SET CHARACTER SET $encodeset", $connect,$dbtype);
        }
        if ($dumpmode2) {
            echo "Trying to execute full dump without any checks or descriptors...<br>";
            fclose ($f); 
            needupdate ();  
            $query=file_get_contents ($path.$dumpfile);
             //..$db->getConnection()->exec($query); ///-  было бы круче но у меня нет такой функции
            	//..$result=dbs_query ($query,$connect,$dbtype);
                sqlerr ();
                ob_flush (); 
        }
	if (!$dumpmode2) while ($a=fgets ($f)) {// пока читается
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
                        sqlerr ($res); // а если базу нигде не задали , что с ней делать?  пришить подключенную
                        // нет анализа скрипта на принадлежность базы
			//if ($a) echo "forced select $cmd<br>"; оно вызывало баг 1111111
				}
	if ($najti===false)	{$query.=$a;continue;}
	if ($najti!==false)	{$query.=$a;}
             
	if ($views) echo "<br>EXECUTING:".$query."<br>";
        
	$result=dbs_query ($query,$connect,$dbtype);
	$query="";
	$queries++;
	//if ($queries) ob_flush();//die ("lim");
	if (($result==false)) {$err++; if ($views) echo "ERROR QUERY:$a<br><br>";}   // вот это верно а не -1  тут false сверятся должен!!!!
	if ($result==0) $skipped++;
 sqlerr();ob_flush();

	}
	if (!$pr[8]) echo "DEBUG $query.<br>";
$x=cmsg (WF_EXQUES)."$queries";	echo "$x<br>";
//$x=cmsg ("BCK_TBL+")."".$tables;	echo "$x<br>";
$x=cmsg (BCK_SKIP).$skipped; 	echo "$x<br>";
$x=cmsg (BCK_ERR).$err;	echo "$x<br>";
$query="";
	mysql_close($connect);
	fclose ($f);
	ob_clean();
	$action="WF_BCK_FILEDUMP_UNARCH $path.$dumpfile -q $queries -e $err -s $skipped force $dbselected";logwrite ($action);
	//apache_child_terminate();
lprint (COMPLETED);exit; //теперь не должно быть никаких First select id please
}
//конец выполнения восстановления из дампа



//=-===============BACKUP END======================================
 
 

//модуль запуска 
if (($write==cmsg ("CFG_COPY"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	readdescripters (); if ($data==-1) exit; 
	//     echo $mznumb[3].$mycols; echo $res16; echo $a; копия модуля из начала writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,$ipfilter,6);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"destination",cmsg ("WF_MAS_DEST"),$groupdb,$ipfilter,6);
	//конец выбора колонки из текущей базы 
	if ($cfgmod==0) submitkey ("write","CFG_CHG");
}

//модуль обработки
	if ($write==cmsg ("CFG_CHG")) { //++ ЭТО - НЕ ПЕРЕПИСАТЬ СТРУКТУРУ, СМ НИЖЕ
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$filbassource=$prdbdata[$source][0];$filbasdest=$prdbdata[$destination][0];
	echo $filbassource."-->".$filbasdest;
	$debug=1;
	csvopen ("_data/".$filbassource,"copy","_data/".$filbasdest);
	$action="CFG_COPY _data/$filbassource-->_data/$filbasdest";logwrite ($action);
	// не тот же ли самый баг с глобальностью чтои при E_DB  ACCESS? галку
	//Создание заголовков по умолчанию глобальными (мультиинст)  pora prowe A_HDR_GLOBBYDEF   $pr[34]==1   global - is first
		$data=readdescripters (); if ($data==-1) exit; 
	}
	
	
	
//модуль запуска 
if (($write==cmsg ("WF_HDRSQL_REAL"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	readdescripters (); if ($data==-1) exit;  
}

//модуль обработки
	if ($write==cmsg ("WF_HDRSQL_REWR")) { //++ ЭТО - НЕ ПЕРЕПИСАТЬ СТРУКТУРУ, СМ НИЖЕ
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	echo "if (($field==$fieldexch)AND ($action==exch)";
		$data=readdescripters (); if ($data==-1) exit; 
	}

//модуль запуска
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
<option value=addafter><? lprint ("WF_ROW_ADDAFT");?> </option>
<option value=addbefore><? lprint ("WF_ROW_ADDBEF");?></option>
<option value=del><? lprint ("WF_ROW_DEL");?></option>
<option value=modify><? lprint ("WF_ROW_MOD");?></option>
</select>
<?="<br>".cmsg ("WF_NNAMROW").":";
    echo "<input type=text id=dbmgr name=newname><br>"; //добавлены новые ID  . цель неясна. пока оставлю
	checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";  ?>
<? submitkey ("write","WF_MODSTRC_SQL");
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
//модуль обработки
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
	// настроено на получение номеров колонок!
	if (($field==$fieldexch)AND ($action=="exch")) {lprint ("WF_EXCHSELF"); exit;};
	 $result=structsql ($action,$field,$fieldexch,$params) ;
	if ($result==true) { echo cmsg ("WF_HEADOK")."!<br>";} else { echo cmsg ("WF_HEADFAIL")."<br>";}
	if ($pr[12]) {$act="HEADER_STRUCT_SQL $action,$field,$newname $newdatatype ($newlen) $newdatatype numbcolproto=$fieldexch)"; logwrite ($act) ;};

	}



// создание таблицы
//модуль запуска
	if (($write==cmsg  ("WF_NEW_TAB"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters (); if ($data==-1) exit; 
			echo cmsg ("WF_NEW_TAB_INFO").":";	echo "<br>";
			lprint ("WF_NEW_NAME");inputtxt("newtable",25);
	 submitkey ("write","WF_ADD_TAB_SQL");	
	}
//модуль обработки
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
        //$query="SHOW CREATE TABLE `".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."`;";  млять  че этому уроду надо,

  if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$a=dbs_query($query,$connect,$dbtype);
        //echo " $a=dbs query  as $query,$connect,$dbtype<br>";
        //$a=mysql_query($query,$connect); так нет, а  напрямую работает !!! оно издевается
	//echo "executed: $query ; Status=$a  Count=".count ($a)."<br>";
        $result=dbs_fetch_row ($a,$dbtype);
        echo "$result[1]";
        //print ($a[1][0]);
      // $x=executesql ($query,$connect,1);echo $x;
	if ($pr[12]) {$act="WF_SHOW_CRT_TAB (".$prdbdata[$tbl][9]."'".$prdbdata[$tbl][5].") state $a "; logwrite ($act) ;};
        exit;
	}




	
	

//модуль запуска 

	if (($write==cmsg ("WF_STRC_DAT"))AND ($prdbdata[$tbl][12]!="fdb")OR($write==cmsg ("WF_MODSTRC_DAT"))AND ($prdbdata[$tbl][12]=="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$data=readdescripters (); if ($data==-1) exit; 
	$data[0]=$data[3];// убираем нах заголовки от SQL
	echo cmsg ("WF_SELROW").":";
	printfield ($data,"nfield");
	echo cmsg ("WF_EXCHROW").":";	printfield ($data,"nfieldexch");
	echo "<br>".cmsg ("WF_NNAMROW").":";
 echo "	<input type=text id=dbmgr name=newname> <br>"; // ошибка, цель id не найдена. пропущено.
	lprint ("WF_SELACT");
	?>
		<select name =action >
<option value=addafter><? lprint ("WF_ROW_ADDAFT");?> </option>
<option value=addbefore><? lprint ("WF_ROW_ADDBEF");?></option>
<option value=del><? lprint ("WF_ROW_DEL");?></option>
<option value=exch><? lprint ("WF_ROW_EX");?></option>
<option value=nop><? lprint ("WF_ROW_NOP");?></option>
</select>
	<br><?submitkey ("write","WF_MODSTRC_DAT2");
		
	}
//модуль обработки
if ($write==cmsg ("WF_MODSTRC_DAT2")) { //++
		if ($codekey==7) demo ();
		if ($codekey==4) needupgrade ();
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	//	$data=readdescripters (); if ($data==-1) exit; 
	// настроено на получение номеров колонок!
//	print_r ($data); echo "Dtata!!!";
	if (($field==$fieldexch)AND ($action=="exch")) {lprint ("WF_EXCHSELF"); exit;};
	 structdat ($action,$field,$fieldexch,$newname) ;
	if ($pr[12]) {$act="HEADER_STRUCT_DAT $action,$field,$fieldexch,$newname"; logwrite ($act) ;};
}


//модуль запуска 
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
				<? 				;// 
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


//модуль запуска      модуль обработки предыдущего и этого режима ниже
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
//.echo "0=уровень".$pl[0].";#1=назв или но таблицы".$pl[1].";#2=метод п ".$pl[2].";#3=Кол".$pl[3].";#4=ConnectName".$pl[4].";#5=Вспом таблица-основное имя(отображаемое)".$pl[5].";#6=Режим п".$pl[6].";#7=Кол".$pl[7].";)";// $pl 0-plevel не трогаем, 2 name or ID 3 mode 4 col  5 name ?  ;6 helptable name typa kak 1 ;7 mode typa kak 2 ;8 kolonka (kak 3)
$intpl=$pl[1];
settype ($intpl,integer);
if ($pl[1]) if (is_integer($intpl)===true) $id1=getidbyid ($prdbdata,0,"realid",$pl[1]);//получаем ID таблицы соответствующей имени  b  
$intpl=$pl[5];
settype ($intpl,integer);
if ($pl[5]) if (is_integer($intpl)===true) $id5=getidbyid ($prdbdata,0,"realid",$pl[5]);//получаем ID таблицы соответствующей имени

if ($pl[1]) echo "<BR><BR>tbl connected as link=".$pl[1]." (reg conf realid #$id1) [".$prdbdata[$pl[1]][9].".".$prdbdata[$pl[1]][5]."] with method ".$pl[2]." (No ".$pl[3].") displays as  ".$pl[4]."<br>";  //tabbydb,columnname,columnnomer,0"////tabbydb,columnname,columnnomer,0
if ($pl[5]) echo "tbl connected as help=".$pl[5]." (reg conf realid #$id5) [".$prdbdata[$pl[5]][9].".".$prdbdata[$pl[5]][5]."] with method ".$pl[6]." (No ".$pl[7].") displays as  ".$pl[8]."<br>";  //tabbydb,columnname,columnnomer,0"////tabbydb,columnname,columnnomer,0
if (!$pl[1]) echo cmsg (TLNK_NOT)."<br>";
if (!$pl[5]) echo cmsg (HLNK_NOT)."<br>";
//если данные уже будут присутствовать - их нужно будет брать отсюда. ^_^ в идеале может приниматься не только 2 пунта :)
//.getidbyid($db,$idsrchcolumn,$idrescolumn,$stringкот ищут) 	 выбор таблицы, для 2 пунктов, потом выбор метода и колонки и имени соединения.
	//exit;
	//resending

        $activetableid=$tbl;
	$master="key_linking";
        $step=1;
        if ($pr[37]) submitkey ("write","TARGET"); // group
	if (!$pr[37]) submitkey ("write","TARGET2"); // no group
}


////// модуль перехода linkning

if (($write==cmsg("TARGET"))) {
 $groupdbthisname="groupdb";
		groupdbprint ($list,"Group",$prdbdata,$tbl,$groupdb);; //код TBL передается самостоятельно, если группы не используются - этот блок пропускать
	$master="key_linking";
        $step=2;
	submitkey ("write","TARGET2");
}




// модуль перехода linkning

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


// модуль сохранения linkning

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
        ; // в дблинкере генерировать имена для полей 0 и 1 с точками !!1  это сильно упростит жизнь!!
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
		//$data=readdescripters (); В ПЕРВОй итерации переменные имеют нормальные имена (cycleno=="")_ пото начинается с2
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
        //USEHLPTAB2 Использовать вспомогательную таблицу (внимание - полный показ! )
        //COLCOMM Комментарий отображаемый по колонке:
        checkbox ($usehlptab2,"usehlptab2"); echo cmsg ("USEHLPTAB2")."<br>";
        
$step=4;
	submitkey ("write","SAV_LNK2");
}

if (($write==cmsg("SAV_LNK2"))) {
	//echo "!!!!!!!!!!!!!end";
	// edit csv   1=Plevel#2=BaseVisualNameorrealID#3=Modesrch#4=Column#5=ConnectName#6=Help-BaseVisualName#7=Modesrch#8=Column#NA
        $master="key_linking";
        $tablelist=array (1=>$tbllink, 2=>$tblhelp);// dв будущем достаточно увеличить переменную
        //$tbl=$tbllink;
        if (strlen ($plevel)>1) $plevel=$plevel[0]; //не совсем правильно , но в падлу выяснять сколько там цифр в первом поле. и не будет ;;;1;1;1;1;;
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
//$modesearch=$mode;if ($mode==7) $mode=$mode.".".$kol; //  это правда нужно?*
//$modesearch2=$mode2;if ($mode2==7) $mode2=$mode2.".".$kol2;
//$genericnewplevelforactivetableidx=$plevel."#".$dbandtablename."#".$mode."#".$kol."#".$colcomm."#".$dbandtablename2."#$mode2#".$kol2."#".$name2;
//'эти данные только для конкретоного поля, и им не требуется содержать  его ИД
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
        hidekey ("activetableid",$activetableid);// это ИД таблицы к которой будем подсоединять
	hidekey ("plevel",$plevel); // уровень доступа для этой таблицы
	hidekey ("columnname",$columnname); //имя колонки к которой будет производится подключение (включая уровень доступа)
	hidekey ("columnnomer",$columnnomer);// её номер
	hidekey ("id1",$id1);
	hidekey ("id5",$id5);
        hidekey ("step",$step);//..шаг  выполнения операции
        hidekey ("hidemenu",1);//убирать меню
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
//модуль запуска      модуль обработки предыдущего и этого режима ниже
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
                                <?
                                $fil=$tbl.";".$z[$a].";".$a.";".$b."";//tabbydb,columnname,columnnomer,0
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

//модуль  обработки
// Перезапись заголовка CSV(DAT) для SQL  подойдет для конфы!
if (($write==cmsg ("WF_HDR_REWR"))AND ($prdbdata[$tbl][12]!="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN"); exit;};
	  //условие не выполняется
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();	
	@$f=csvopen ("_data/".$filbas,"r","1");$new=0;
		$z=xfgetcsv ($f,$xfgetlimit,"¦"); $p=xfgetcsv ($f,$xfgetlimit,"¦");
		for ($a=0;$a<count ($z);$a++)	{
	if (!$sqltocsv) $z[$a]=${"z".$a};//принимаем данные юзера
	$p[$a]=${"p".$a};//принимаем данные юзера
}
if ($OSTYPE=="LINUX") $z[$a-1]=$z[$a-1]."\n";//фикс бага с переводом строки,сам может вызватьдругие баги осторожно
//if ($OSTYPE=="WINDOWS") $z[$a-1]=$z[$a-1]."\r\n";//фикс бага с переводом строки,сам может вызватьдругие баги осторожно
//фикс отменен тк при сохранении заголовка вызывал его смещение.
fclose ($f);
	if ($sqltocsv) { $z=$data[0]; $z[]=""; };//headerreal
	@$f=csvopen ("_data/".$filbas,"w","1");
writefullcsv ($f,$z,$p,"");
	if ($pr[12]) {$act="HEADER_SQL $tbl to $values"; logwrite ($act) ;};
}


//модуль обработки
if (($write==cmsg ("WF_HDR_REWR"))AND ($prdbdata[$tbl][12]=="fdb")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN"); exit;};
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
		$new=0;
	$data=readdescripters ();
	$z=xfgetcsv ($f,$xfgetlimit,"¦"); $plevels=xfgetcsv ($f,$xfgetlimit,"¦");// надо терять их!!
	$z=$data[0];$plevels=$data[1]; 
	for ($a=0;$a<count ($z);$a++) {
		$z[$a]=${"z".$a};//принимаем данные юзера
		$p[$a]=${"p".$a};//принимаем данные юзера
		}
	$values=implode ($z,"¦");if ($OSTYPE=="WINDOWS") $values.="\n"; //if ($OSTYPE=="LINUX") $values.="\r\n";//LINUX FIX  а в винде оно не работает зачем вообще \n?
	$plevels=implode ($p,"¦");if ($OSTYPE=="WINDOWS") $plevels.="\n"; //if ($OSTYPE=="LINUX") $plevels.="\r\n";//LINUX FIX  - че правда работает??files.cfg не принимает..видимо не совпадает то то. херня - поправляем для работы с конфигурацией
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

 
//модуль обработки - простое копирование таблицы внутрь базы dbscript
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
	};   // сохранение для SQL в отдельной базе бэкап
	if ($pr[12]) {$act="Backup created B $tbl"; logwrite ($act) ;};
}
//=========================================
//модуль обработки - простое восстановление таблицы из базы dbscript
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
//модуль запуска 
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
				//проверка не занят ли ID
			if ($myrow===false) { 
				echo cmsg ("QUE_EMP")."<br>";
				exit;
			}
			
	}
	if (($prdbdata[$tbl][12]!="fdb")) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;

	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
	//проверка не занят ли ID
	if ($myrow===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrow)));
		}
$commmsg=$myrow[$scrcolumn];
	
$scrdir="_local/scrcomm/".$scrdir;
$comfile=$scrdir."/".$commmsg.".txt"; // это обход опроса в базе содержимого колонки Колонка картин

$imgfile=$scrdir."/".$commmsg."$formatscr"; // такс  из r.php взят код проверки картинки.
@$wrimg = fopen ($imgfile,"r");
if (!$wrimg) if (($needscr==true)AND($formatscr)) { echo "Image enabled<br>";};
if ($wrimg) if (($needscr==true)AND($formatscr)) {
    //$scr=
    $scr=$imgfile;//  WARNING   -  можно юзать для записи!
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
echo " </form>"; // даже исцеление этого недуга не помогает сохранить файл :(

lprint ("COMMSG");echo " (Obj ".$commmsg." Col $scrcolumn)";
//<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		//<input type="hidden" name="max_file_size" value="10000000">
?> :	<form enctype="multipart/form-data" action="w.php" method=post>
	<textarea name=vd cols=75 rows=10 ><? print $vd; ?></textarea>
        <input name=userfile type=file class=buttonS>
<? 	hidekey ("tbl",$tbl);
	hidekey ("commmsg",$commmsg);
	hidekey ("vID",$vID);
        echo "<br>";
        checkboxcorrect ("delcom",$delcom); lprint ("DELCOM");
        checkboxcorrect ("delscr",$delscr); lprint ("DELSCR");echo "<br>";
	submitkey ("write","KEY_S_COMM");
	echo " </form>";exit;
}

  // запись файла на сервер. бесполезно указывать адресат php ибо данные все равно потеряются
//модуль  обработки
 if ($write==cmsg("KEY_S_COMM"))  {
 	//echo "!!!!";
 	if ($codekey==4) needupgrade ();
	global $scrdir,$go;
	$scrdir="_local/scrcomm/".$scrdir;
	//testzone upload file	// Загрузка файлов на сервер// Если upload файла
        
	//comment write
 	if (!$vd) echo "Не передан комментарий.Изменения не сделаны.";
	if ($vd) {$vd=stripslashes($vd); // несколько уменьшено размножение косых
	@$wr = fopen ($scrdir."/".$commmsg.".txt","w+"); 
	$act="COMMEDIT $comfile"; 
	@fwrite ($wr,$vd);fclose ($wr);
        if ($wr==true) { lprint ("FS_WR_OK");echo ".<br>";} else { 	$errt=cmsg ("FS_ERR"); $ermsg=cmsg ("FS_NODIR");	};
        if ($pr[12]) { logwrite ($act) ;	};  // логируемся
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
		if ($file==1) { //файл есть , предпринимаем меры

            		if (!$tempsize) {  echo "Это не картинка ! Файл не был сохранен. <br>";exit ;} // тоже 0 при >64k
        		if ($size>900000) { echo "Превышен hardcoded лимит в 900Кб";exit;}; //CFG OPT FUTURE
                        echo "Куда:".$uploaddir."/ File:".$commmsg.$formatscr."<br>";
                        echo "fullpathname=$scrfullpathname<br>";
                        unlink ($scrfullpathname);
                        $error=uploadfile ($uploaddir."/",$commmsg.$formatscr); //почему !!!?? Залить не удалось
                        die ("Aaaaaaaaaaa");
                        if ($error) { ob_clean ();lprint ("FS_FWR"); } else { ob_clean ();lprint ("FS_FWRFAIL"); }
                        echo $uploaddir."/",$commmsg.".jpg";
                        echo "Он был успешным юзернеймом на УПячке!<br>";
            		}
    }
//end of upload//....        if($error==false) echo "Слив не засчитан";	//end comment write
if ($delcom){$x=unlink ($scrdir."/".$commmsg.".txt");echo $x;};
if ($delscr){$x=unlink ($scrfullpathname);echo $x;};
        exit;
 }




//endcomm



// -----------------------------------------------------------------
//MYSQL SECTION
//модуль запуска
if (($write==cmsg ("KEY_VIEW"))AND($prdbdata[$tbl][12]!="fdb")) {
	if ($vID==false)
{ 
  msgexiterror ("needcode",$mode,"w.php");
} 
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
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
	global $presettedmode,$categorymode,$m6field,$m6count,$mode,$fields;//декодирование строки
	global $selectedfield,$multisearch;
	 //from readfile part  small преобразовано
	 	global $categorymode,$mode;
	global $mode6,$m6field,$m6count; // $m6count; - kakogo hera ne peredan
	global $mycols,$mycol,$del,$res16,$presettedmode,$selectedfield;
	global $partquery,$vID,$fields,$multisearch;

	if (($mode == 6)AND($prdbdata[$tbl][12]!="fdb")) {
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	$res16=$prdbdata[$tbl][16];// Лимит колонок
	//декодирование строки
prefixdecode ($indata);
		dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		global $mzdata; //$mycol[$md1column]".."
$mode6=array ();
decodecols ();
	$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE (".$partquery ;
	$query=$query.") AND `".$mycol[$md2column]."` NOT LIKE '%".$vID."%'";
//	echo $query;
//if ($virtualid==1) { $query = $query." AND ".$mycol[$virtualid]."= '".$vID2."'";};
//бесполезно ибо сравнивается с любым полем, если только переписать с учетом 2 полей целую функцию
	$result = dbs_query ($query,$connect,$dbtype);
//	echo "mycols $mycols mz  $mzdata[1]";  
selectedprintsql ($data);
	if ($multisearch==0) {exit (1); }
}
}
}

 //from readfile partends
//=========================================
//модуль запуска и обработки
if (($write==cmsg("KEY_AN"))AND($prdbdata[$tbl][12]!="fdb")) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
	//функция подсчета значений в таблице
	if ($data==-1) exit;

	echo "<br>";// $mycol[$md2column]<br>";
	$maxquery="SELECT MAX(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$countquery="SELECT Count(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$result=dbs_query ($countquery,$connect,$dbtype);	$counttbl = dbs_fetch_row ($result,$dbtype);
	$result = dbs_query ($maxquery,$connect,$dbtype);;	$maxtbl = dbs_fetch_row ($result,$dbtype);
     	//	распечатка данных из дескрипторов
 echo "<table id=execsql border=3 width=100% bordercolor=#000099 ><tr>";
 echo "<td>headerreal</td><td>plevels</td><td>headerrealnumbers</td><td>headervirtual</td><td>datatypos</td><td>fieldlen</td></tr><tr>";
	for ($a=0;$a<count ($data[0]);$a++)	{
		for ($b=0;$b<6;$b++) {  echo "<td><bb>$b</bb>:".$data[$b][$a]."</td>";	} echo "</tr><tr>";
	}
echo "</tr></table>";
// echo "mycols сообщенный rdesc ".$data[6]."!<br>";
	echo cmsg ("WF_AN_ALLDAT")." ".$counttbl[0].", ".cmsg ("WF_LASTW")." ".$maxtbl[0]."<br>";
	@$pl=round (($counttbl[0]/$maxtbl[0])*100,5);
	echo cmsg ("WF_LDED")." = $pl% <br>";
	//окончание подстчетов  [EXTEND ] nowork
?>			</form><form action="w.php" >
<? submitkey ("go","KEY_REPAIR"); 
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","REPAIR TABLE `".$prdbdata[$tbl][5]."`;");
echo "</form>";
?>
	<form action="w.php" >
<? submitkey ("go","KEY_CHECK"); 
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","CHECK TABLE `".$prdbdata[$tbl][5]."`;");
echo "</form>";
?>
<form action="w.php" >
<? submitkey ("go","KEY_OPT"); 
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","OPTIMIZE TABLE `".$prdbdata[$tbl][5]."`;");
echo "</form>";
?>
	<form action="w.php" >
 <? submitkey ("go","A_SQLRES"); 
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
 <? submitkey ("go","SQLSPST");
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




//модуль запуска 
if (($write==cmsg ("KEY_DATA"))AND($prdbdata[$tbl][12]!="fdb")) {
	if ($vID==="") { lprint ("WF_FSELID")."<br>"; exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;
		//datafieldcolsel это No# колонки с data переданный из поиска
	$datacols=explode (",",$prdbdata[$tbl][18]);
	$datafilehdr=explode (",",$prdbdata[$tbl][19]);
	$datasplitters=explode (",",$prdbdata[$tbl][20]);
      //..  это меню показ по кнопке DATA
        if ($datasplitters[$datafieldID]=="SPC") { $datasplitters[$datafieldID]=" "; echo "SPACE applied<br>";};
	echo " DATALIST ".$prdbdata[$tbl][18].";  SEARCH COLUMN $datafieldcolsel <br>";
for ($a=0;$a<count ($datacols);$a++) {
	//echo "a=".$datacols[$a]." dcs=$datafieldcolsel<br>";
	if ($datacols[$a]==$datafieldcolsel) $datafieldID=$a;
}  //datafieldID - это номер активной DATA из списка в базах админка , no field number ! 
echo "ebanyj splitter 2= ".$datasplitters[$datafieldID]."<br>";
 if ($datasplitters[$datafieldID]=="SPC") { $datasplitters[$datafieldID]=" "; echo "SPACE applied<br>";};
echo "ebanyj splitter 1= ".$datasplitters[$datafieldID]."<br>";
	echo "type:DATA table:".$prdbdata[$tbl][5]." column:".$mycol[$datafieldcolsel]." (No $datafieldcolsel) datafieldID=$datafieldID separator:".$datasplitters[$datafieldID]." (SPC)<br>";
	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
	//prepare new data
	@$g=csvopen ("_data/".$datafilehdr[$datafieldID],"r",0); //хедер и сплиттер пока всегда будут первые ,упрощено!!! CFG OPT FUT
	@$mycoldat=fread ($g,1000);
	if (!$g) echo "Failed check headers DATA ,file _data/".$datafilehdr[$datafieldID]."<br>";
	@fclose ($g);
	$myrowdat=explode ($datasplitters[$datafieldID],$myrow[$datafieldcolsel]); //это наше dATA
			//for ($a=0;$a<$mycols;$a++) 			{ 			}
	$mycolsdat=count ($myrowdat);
	//$mycol=$mycoldat;$mycols=$mycolsdat; $myrow=$myrowdat;  //TEMP!!!
	
	//$mycol должен тут получить содержимое DATA  $myrow - содержимое заголовка
	//проверка не занят ли ID
	if ($myrowdat===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrowdat))); //поcчтитал уже myrowdat ))
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
		for ($a=0;$a<$mycolsdat;$a++)
			{
			echo "$mycoldat[$a] ($a)";
					if ($a===0) { $values="'".$myrowdat[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrowdat[$a]; }	//self-control
			?>
			<textarea name=z<?=$a; ?> cols=40 rows=1><?=$myrowdat[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$mycolsdat;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycoldat[$a] ";
		$lensa=strlen ($myrowdat[$a])+2;// CFG OPT FUTURE 
		if ($lensa>50) $lensa=50;
					if ($a===0) { $values="'".$myrowdat[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrowdat[$a]; }	//self-control
			?>			</td>
			<? if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrowdat[$a]?></textarea><br></td><? 
			} //field text
			
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
//модуль  обработки
if (($write==cmsg("KEY_S_DATA"))AND($prdbdata[$tbl][12]!="fdb")) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
	//datafieldcolsel это No# колонки с data переданный из поиска
	$datacols=explode (",",$prdbdata[$tbl][18]);
	$datafilehdr=explode (",",$prdbdata[$tbl][19]);
	$datasplitters=explode (",",$prdbdata[$tbl][20]);
        echo "count datacols=".count ($datacols)." original ".$prdbdata[$tbl][18]."<br>";
/*for ($a=0;$a<count ($datacols);$a++) { // сцуко не находит $datafieldID
	echo " ($a==$datafieldcolsel) (a=datafieldcolsel)<br>";
	if ($a==$datafieldcolsel) $datafieldID=$a;
} 
*/ //datafieldID - это номер активной DATA из списка в базах админка
IF ($datafieldID===false) echo "datafieldID FALSE!!!! procedure will fail!!<br>";
IF ($datafieldID==0) $datafieldID=0;
echo "!@!!!!!!!!!!!123!!!!!!!!!!!!! separator:".$datasplitters[$datafieldID].""; // это меню показывается не по кнопке DATA
if ($datasplitters[$datafieldID]==="SPC") { $datasplitters[$datafieldID]=" "; echo "SPACE applied<br>";};
	
echo "type:DATA table:".$prdbdata[$tbl][5]." column:".$mycol[$datafieldcolsel]." (No $datafieldcolsel) datafieldID=$datafieldID separator:".$datasplitters[$datafieldID]." (SPC)<br>";
echo "crc code given:$crc<br>";
// дальше в некоторых местах SQL скрипта надо поменять датаид на имя поля  ($mycol[$datafieldcolsel) - что бы значил этот коммент (2009.12)
echo "origid1=$origid1<BR>";//,$myrowdat[$md2column]);
echo "origid2=$origid2<BR>";//,$myrowdat[$virtualid]);
echo "datafieldcolsel=$datafieldcolsel<BR>";//,$datafieldcolsel);
echo "datafieldname=$datafieldname<BR>";//$mycoldat[$datafieldcolsel]);
echo "datafieldID=$datafieldID<BR>";//$datafieldID);"
// $myrow[$md2column]."'"; - ПОТЕРЯН !!! ПОЧЕМУ  , КАКОГО !!!!  12.2009 SELECT 'taximask' FROM `characters` WHERE guid= ''  --- MYROW ПОХОДУ ПУСТОЙ ФОРМИРУЕТСЯ
	// заменен vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid]
// сборка всех переменных в values и myrow[]
	for ($a=0;$a<$mycolsdat;$a++)	{
	$myrowdat[$a]=${"z".$a};
        echo 'check='.$myrowdat[$a];
	if ($a===0) { $values=$myrowdat[$a];}
	if ($a>0) {$values="".$values.$datasplitters[$datafieldID].$myrowdat[$a]; }
			}
// сборка всех переменных в values и myrow[]
        ECHO "values=$values<br>";
	//проверка старых данных для CRC i UnDO / проверить надо только ДАТА!!
	$cmd="SELECT '".$mycol[$datafieldcolsel]."' FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$myrow[$md2column]."'";
	if ($virtualid==true) { $addcmd=" AND ".$mycoldat[$virtualid]."= '".$myrow[$virtualid]."'"; $cmd.=$addcmd;};
	$result = dbs_query ($cmd, $connect,$dbtype);
	echo "cmd=$cmd, result=$result <br>";
	$myrowold = dbs_fetch_row ($result,$dbtype);
	if ($myrowold==false) {lprint ("WF_EDITNOTADD");echo "<br>"; 
	/*//процедура undo старого ID сохранить надо только ДАТА!!!
		$cmd="SELECT '".$mycol[$datafieldcolsel]."' FROM `".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
		if ($virtualid==true) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$origid2."'";};
		$result=dbs_query ($cmd,$connect,$dbtype);;
		echo "cmd=$cmd, result=$result <br>";
		$myrowold=dbs_fetch_row ($result,$dbtype); // тут false если то значит ппц :)
		*/
	} // 2 раза проверяет одно значение в базе только разными методами.
	// nen надо просто сверить data в undo   и записать новое значение.
	@$olddata=implode ($datasplitters[$datafieldID],$result); // вот это и надо сохранять и откатывать
	$undodata="UPDATE `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` SET `".$mycol[$datafieldcolsel]."`='".$myrowold."');";
	if (!$crcignore) {
				@$crcnew=crc32(trim($olddata));
				echo "crcnew =$crcnew<br>";
				if ($myrowold!==false) if ($crcnew!=$crc) {lprint ("WF_CRCFAIL"); exit;} ;}; //crc32testfunction
	// старое условие до 3.2.6 ++ $mycol[$md2column]."='".$vID."'";
	// опять возможная ошибка  - необязательно 0 является ключом
	echo "data for check : myrowold=$olddata '".$myrowold."'<br>";
	echo "data for chk: values=$values <br>";
	$cmd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$datafieldcolsel]."`='".$values."');";
	$a=dbs_query ($cmd,$connect,$dbtype);  // условие обновлено
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($views) {echo cmsg ("WF_EXQUE")."$cmd<br>"; } else { echo cmsg ("WF_ADDFAIL")."$myrow[0]<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_UPDOK")."!<br>";} else { 
		$errt=cmsg ("WF_UPDFAIL"); $ermsg="$myrow[0]<br>";}
	if ($pr[12]) {$act="EDIT_SQL_TYPE_DATA  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;undolog ($act,$undodata); };
	//CFG OPT FUTURE - some action like backup not logging!!!!
	//if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// пишет ошибку и ее код  и его же возвращает
//endof executing
submitkey ("write","WF_UNDO_LAST");
}

//end KEY_S_DATA



//модуль запуска 
if (($write==cmsg ("KEY_EDIT"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	if ($vID==="") { lprint ("WF_FSELID")."<br>"; exit;};
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
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
            //exec reselect  в случае неправильно установленного id2 надо его сбросить, в случае наличия правильных обоих попытаться отредактировать данные другим методом
            //потом доделать update - replace   это можно в принципе и для csv сделать 
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
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
	//проверка не занят ли ID
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
			<textarea name=z<?=$a; ?> cols=40 rows=1><?=$myrow[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { //  в этом месте происх. иниц. генерац таблицы для dbmgr_редактора  только для нового и вертикального стилей !! копировать изменения отсюда!
		echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";//изменение утверждено неполностью.если редактировать то уж сразу все <table> а не одну.а то они все станут разные.
		for ($a=0;$a<$mycols;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.   GMP_41;Редактор, вертикаль интерфейс  из lang/russian.cfg
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";
		
		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE 
		if ($lensa>50) $lensa=50;
                if ($prdbdata[$tbl][18]) for ($b=0;$b<count ($datacols);$b++) { $fil=$tbl.";".$myrow[$md2column].";;".$datacols[$b]."";
				if ($a==$datacols[$b]) {echo "<a href='w.php?cmd=dat&fil=$fil'><img src='_ico/linked_table-yn.png' border=0 title='".cmsg ("KEY_HEAD")."'></a>";}
			} //redaktirowanie data

					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
			?>			</td>
			<? if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrow[$a]?></textarea><br></td><? 
			//echo "<tr>";//optionalBox,not linear edit.  имя ID должно быть как можно короче, т.к. элементов могут быть 1000и
			// добавить потом сюда trafeconom mode  поправлю позже другие стили аналогично этому.
			
			} //field text
			
			echo "</table>"; // конец генератору таблицы для dbmgr_edit
	}
	// проверка заморозки
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
	// окончание проверки заморозки
	
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
//модуль  обработки
if (($write==cmsg("KEY_S_EDIT"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
	// заменен vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid]
// сборка всех переменных в values и myrow[]
		for ($a=0;$a<$mycols;$a++)	{
	$myrow[$a]=${"z".$a};
	if ($a===0) { $values="'".$myrow[$a];}
	if ($a>0) {$values="".$values."','".$myrow[$a]; }
			}
			$values=$values."'";
// сборка всех переменных в values и myrow[]
// начало разморозки если вкл
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
				// может эту процедуру тоже как то стандартизировать?
}
//конец разморозки если вкл
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
	//проверка старых данных для CRC i UnDO
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$printid1."'";
	if ($virtualid==true) { $addcmd=" AND ".$mycol[$virtualid]."= '".$printid2."'"; $cmd.=$addcmd;};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrowold = dbs_fetch_row ($result,$dbtype);
                    //exec reselect  в случае неправильно установленного id2 надо его сбросить, в случае наличия правильных обоих попытаться отредактировать данные другим методом
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$printid1."'";
		if (($virtualid)AND ($vID2!=="")) {  $addcmd=" AND ".$mycol[$virtualid]."= '".$printid2."'";$cmd.=$addcmd;};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrowold = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) { $directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
            }
            //exec reselect
 }
  if ($directedit) {
             if ($directedit==2) $vID=base64_decode ($vID);
             $decodeddata=explode ("^^",$vID);
             
 }
        if ($myrowold==false) {
	//процедура undo старого ID
      $directeditwhere=gensqldirecteditwhere ($mycol,$decodeddata,$mycols);
	if (!$directedit) {$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
		if ($virtualid==true) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$origid2."'";};
                }
	if ($directedit) {$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  $directeditwhere ";};
                }
		$result=dbs_query ($cmd,$connect,$dbtype);;
		$myrowold=dbs_fetch_row ($result,$dbtype); // тут false если то значит ппц :)
	
	@$olddata=implode (";",$myrowold); // вот это и надо сохранять и откатывать
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

	// старое условие до 3.2.6 ++ $mycol[$md2column]."='".$vID."'";
        //generic update script if myrowold (old data) is present
 //  для прямой передачи ссылки в будущем можно сделать пометку в virtualid=direct  a v vID - энкодированный массив
      
       //if (!$directeditwhere) $directeditwhere="";  по моему не имеет смысла. 120043578+0+255+100147689+1374  id передается директедитом
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
        $a=dbs_query ($cmd,$connect,$dbtype);//сделать любое кол-во
        if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
       dbserr ();// $silent=0;
        }
         // update where old data only new data in cycle  //потом доделать update - replace   это можно в принципе и для csv сделать
        //end generic update script
        //

//echo $cmd;exit;
if (!$update) {


        if (!$directedit) {
	// опять возможная ошибка  - необязательно 0 является ключом
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$myrow[$md2column]."'";
	if ($virtualid==true) {  $cmd.=$addcmd;};

		$cmd2="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
	if ($virtualid==true) { $cmd2=$cmd2." AND ".$mycol[$virtualid]."= '".$origid2."'";}; // по идее этот не нужнее? но никто не жаловался.
	// это удаление старого ID если был
        
           
	$a=dbs_query ($cmd,$connect,$dbtype);  // условие обновлено
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}
        
	$a=dbs_query ($cmd2,$connect,$dbtype);  // условие обновлено
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}
        }
 //exit;
	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";// исполняется на самом деле эта
        
       
	$a=dbs_query ($cmd,$connect,$dbtype);//сделать любое кол-во
       $cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)"; //для лога эта команда и для фриза, но не для исполнения.
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
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else { echo cmsg ("WF_ADDFAIL")."$myrow[0]<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_UPDOK")."!<br>";} else { 
		$errt=cmsg ("WF_UPDFAIL"); $ermsg="$myrow[0]<br>";}
	if (!$errt) if ($pr[12]) {$act="EDIT_SQL  B $tbl($nametbl) Find $vID $vID2 Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
           logwrite ($act) ;undolog ($act,$undodata,$baseID,$hostIP); };
	//if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// пишет ошибку и ее код  и его же возвращает
if (!$errt) submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//infa  DISTINCT - отключить дубликаты

//=========================================
//модуль запуска 
if (($write==cmsg ("KEY_ADD"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);

	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
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
                    //exec reselect  в случае неправильно установленного id2 надо его сбросить, в случае наличия правильных обоих попытаться отредактировать данные другим методом
            // работает отлично даже если неправильно указан ID2 ))))
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>".$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
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
//проверка не занят ли ID
	if ($myrow===false) { 
		echo cmsg ("QUE_EMP")."<br>";
		$myrow[$md2column]=$vID;
		if (($virtualid>0)AND ($vID2!=="")) $myrow[$virtualid]=$vID2;
	}
//end проверка не занят ли ID
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
	for ($a=0;$a<$mycols;$a++)
			{
			echo "$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a])  {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=30 rows=1><?=$myrow[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$mycols;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a])  {echo "<ii>(ID1)</ii>"; $myrow[$a]=($maximalcntmd2+1);};
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";
		
		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE 
		if ($lensa>50) $lensa=50;
					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
			?>			</td>
			<?if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
			?>
			<td><textarea id=dbmgr_txta name=z<?=$a; ?> cols=<?=$lensa;?> rows=1><?=$myrow[$a]?></textarea><br></td><? 
			if ($prauth[$ADM][41]) echo "<tr>";//optionalBox,not linear edit.
		} //field text
		echo "</table>";
	}
			echo "";
   checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>"; 
	submitkey ("write","KEY_S_ADD"); echo  "<br>";
}


//=========================================

//модуль обработки
if (($write==cmsg ("KEY_S_ADD"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
 $directedit=$prdbdata[$tbl][22];
// сборка всех переменных в values и myrow[]
			for ($a=0;$a<$mycols;$a++)
			{
	$myrow[$a]=${"z".$a};
	if ($a===0) { $values="'".$myrow[$a];}
	if ($a>0) {$values="".$values."','".$myrow[$a]; }
			}
			$values=$values."'";
// сборка всех переменных в values и myrow[]
//тут надо бы undo
	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	$a=dbs_query ($cmd,$connect,$dbtype);//сделать любое кол-во
	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";	if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else 	{
		$errt=cmsg ("WF_ADDFAIL"); $ermsg="$myrow[0]".cmsg ("WF_ADDPRS")."<br>";}
	   $directeditwhere=gensqldirecteditwhere ($mycol,$myrow,$mycols);
           
      if (!$directedit)     {$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$myrow[$md2column]."'";
	if (($virtualid>0)AND ($vID2!=="")) { $undodata=$undodata." AND ".$mycol[$virtualid]."= '".$myrow[$virtualid]."'";}; }
    // в варианте - if (!$directedit)  - ошибка если добавлялось только одно значение из ид 1
    // vID1 vID2 - не используются, нужно использовать соответвующие поля данных вместо них
    if ($directedit)     {$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE $directeditwhere "; }
	if (!$errt) if ($pr[12]) {$act="ADD_SQL  B $tbl($nametbl) Find $vID $vID2 Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
            logwrite ($act) ; undolog ($act,$undodata,$baseID,$hostIP);}; // логируемся
	 //executing+errlogделаем нормальную обработку ошибок  исп всегда этот модуль
	 	     //if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// пишет ошибку и ее код  и его же возвращает
if (!$errt) submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//=========================================
//модуль запуска 
if (($write==cmsg ("KEY_DEL"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][22]) $directedit=$prdbdata[$tbl][22];
    if (!$directedit) if (($virtualid==true)AND($vID2==false)) echo "<red>".cmsg
		("WF_DEL_GROUP")." ".$vID." </red><br>";
		 if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 
                   if ($vID==="") { lprint ("WF_FSELID");exit;}
                   //загрузок проверок не производится для ускорения работы, да и просто так обычно удалить не нажимают
                   //ну и хоть одна функция будет вмещатся в 10 строк :)))
		submitkey ("write","KEY_S_DEL");
}



//=========================================
//модуль обработки
if (($write==cmsg("KEY_S_DEL"))AND($prdbdata[$tbl][12]!="fdb")) {
    if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
 	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
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
	// тут надо бы undo     //exec reselect  в случае неправильно установленного id2 надо его сбросить, в случае наличия правильных обоих попытаться отредактировать данные другим методом
            // работает отлично даже если неправильно указан ID2 ))))
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
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
                    if (!$test) $test=$myrow[0];// если есть что удалять тест включен
                    $undodata.=gencmdlogi ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols,"")." ";
                //    echo $cmd; записываем отсутствующий undolog
 }
    // udal vse bez undo
	$a=$test;
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
         if ($directedit) $cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE $directeditwhere";
	dbs_query ($cmd,$connect,$dbtype);
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
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
//модуль запуска 
if (($write==cmsg("KEY_MASEXC"))AND($prdbdata[$tbl][12]!="fdb")) {
		if ($prdbdata[$tbl][9]=="dbscriptbk") msgexiterror ("nologsedit"," (DB.TBL ".$prdbdata[$tbl][9].".".$prdbdata[$tbl][5]."","main.php");
   @ $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
// выбор колонки из текущей базы
// в качестве разделителя для условия равно можно использовать запятые
	echo cmsg ("WF_SELFLD").":";// Вставлено для выбора поля
//	$ar=$selectedfield;
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a;
	printfield ($data,"nfield"); 
	//конец выбора колонки из текущей базы
  echo "<br>";lprint ("WF_SRCID") ; ?>	<textarea name=sourceid cols= 24 rows=1 ><?=$sourceid; ?></textarea> <? lprint ("WF_EMPTY") ; ?> <br>
<? lprint ("WF_EXCHID") ; ?>	<textarea name=exchid cols= 24 rows=1 ><?=$exchid; ?></textarea> <br>
<? checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>"; 
 checkbox ($wfemptyenab,"wfemptyenab") ;echo cmsg ("WF_EMP_EN")."<br>";
   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
 if ($prauth[$ADM][5]==1) { checkbox ($delete,"delete");echo "<red>".cmsg ("WF_UPDTODEL")."</red><br>"; };
  radio ("strupdmode","allstrokes","WF_EXCALL"); echo "<br>";
 radio ("strupdmode","#substrokes","WF_EXCSUB"); echo "<br>"; // select ignored ???? WTF?
  radio ("strupdmode","subindstrokes","WF_EXCSUBIND") ; //echo "<br>";
  ?>
  <textarea name=subindex cols= 5 rows=1 ><?=$subindex; ?></textarea>,<? lprint ("WF_EXCSPLT") ; ?> ,<textarea name=subsplitter cols= 4 rows=1 ><?=$subsplitter; ?></textarea><br>

 <?   // start compare addif
 checkboxcorrect ("addifenable1",$addifenable1) ; 
	echo cmsg ("WF_IF")."1 :"; printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?
checkboxcorrect ("addifenable2",$addifenable2) ;
	echo cmsg ("WF_IF")."2 :"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
		<?
	// end compare addif   Вставлено для выбора поля
	echo "<br>".cmsg ("WF_DUPL")."<br>";
	if (strlen ($vID2)!==0) echo cmsg ("WF_ID2HLP")."<br>"; 

 ?> 
	<gray> <? lprint ("WF_EMUSUB") ; ?> : </gray><input type="checkbox" name="emusubstroke"><br>
 <? submitkey ("write","KEY_S_EXCH");
}



//=========================================
//модуль обработки
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
	if (($prauth[$ADM][5]==false)AND($delete)) { unset ($delete); echo "r";};// сброс от нелегальных delete
	readdescripters ();// получение данных заголовка м  ассив mycol кол-во mycols
    if (!$strupdmode) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_NOMODE");exit;};
	if (strlen ($exchid)==0) { echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_NOTARG");exit;};
	if (($strupdmode=="substrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>".cmsg ("LIM")."</bb><br></red>".cmsg ("WF_ER_NOSUB"); exit;} ;
	if ($strupdmode==="subindstrokes") { 
	   if (!$subindex) {echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_NOIND") ; exit;}
	  if (!$subsplitter) {echo "<red><bb>".cmsg ("INP_ERR")."</bb><br></red>".cmsg ("WF_ER_SPLIT") ; exit;}
		} ;
	
		if (!$wfemptyenab) if (($prauth[$ADM][4]===false)AND($strupdmode==="allstrokes") AND (strlen ($sourceid)==0)) { echo "<red><bb>".cmsg ("LIM")."</bb><br></red>".cmsg ("WF_EX_ANY_D") ; exit;} ;
	//окончание обработки ошибок
	if ((strlen ($sourceid)==0)AND($strupdmode!=="substrokes")) 
		{ $cmd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$exchid."' WHERE `".$mycol[$md2column]."`= '".$vID."'";
			if ($delete) $cmd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$md2column]."`= '".$vID."'";
				}  // если не указана цель замены тогда заменяет любое значение в пределах ID

	if ((strlen ($sourceid)!==0)AND($strupdmode!=="substrokes")) 
		{ $cmd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$exchid."' WHERE `".$mycol[$field]."`= '".$sourceid."'";
		if ($delete) $cmd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`= '".$sourceid."'";
				} // заменяет указанные значения в пределах ID  ,  может расширятся allstrokes
				// allstrokes??  onestroke
	if (($strupdmode=="onestroke") AND (strlen ($sourceid)!==0)) { 
		$cmd=$cmd." AND `".$mycol[$md2column]."`= '".$vID."'";
		if (($virtualid>0)AND (strlen ($vID2)!==0)) { 
					$cmd = $cmd." AND `".$mycol[$virtualid]."`= '".$vID2."'";};};

	if (($addifenable1)OR($addifenable2)) {$cmd=$cmd.$cmdaddif;		}; // вып доп условия модерниз.



// SUBSTRREPLACE замена внутри строки без индекса  
if (($strupdmode=="substrokes")AND(!$emusubstroke))	{
	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`=REPLACE (`".$mycol[$field]."`,$sourceid,$exchid) WHERE `$mycol[$field]` LIKE '%$sourceid%'";
if ($delete) $cmd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`LIKE  '%".$sourceid."%'";
	echo "";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // вып доп условия модерниз.
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";

	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
		}

//+++++ПРОСМОТР $cmd="SELECT name,$substringone as A FROM `".$prdbdata[$tbl][5]."` WHERE `name` LIKE \"%".$charname."%\";";


// SUBINDSTRREPLACE замена внутри строки с индеком  -
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
//substrone получает значение искомого элемента и может сравниватся как обычная переменная
/*if ($test1) {
	$cmd="SELECT $substringone as A FROM `".$prdbdata[$tbl][5]."` WHERE A='".$sourceid."'";
$result = dbs_query ($cmd, $connect,$dbtype);$myrow = dbs_fetch_row ($result,$dbtype);
if (!$pr[8]) echo "COMMAND 2 : $cmd<br><bR><br>Substroke 2 row:".$myrow[0]."<br><br><br><br><br>";
}  //  шобы не светилось
*/ 


	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`= CONCAT(SUBSTRING_INDEX(`".$mycol[$field]."`, '".$subsplitter."', '".($startsub)."'), ' ".$exchid." ' ,SUBSTRING_INDEX(`".$mycol[$field]."`, '".$subsplitter."', '".$endsub."'))  WHERE (".$substringone.")=".$sourceid." "; // where частьверная.
 // кстати вроде баг с этой фигней в цсв до сих пор осталсяяLIKE '%".$subsplitter.$sourceid.$subsplitter."%'
if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE ".$substringone."='".$sourceid."' ";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // вып доп условия модерниз.
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";$silent=0;dbserr ();
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
	}

//модулb эмуляции субстрок
// SUBSTRREPLACE замена внутри строки без индекса  эмуляция(!!!)
if (($strupdmode=="substrokes")AND($emusubstroke)) { $sourcefield="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`LIKE '%".$sourceid."%'";
$subselect=dbs_query ($sourcefield,$connect,$dbtype);
while($row=dbs_fetch_array($subselect,$connect,$dbtype))
	{ $data=$row[$field];$guided=$row[$md2column];
	//echo $row[0]." -- ".$row[$field]." -- ".$field." <br>"; 
$replid=$data; $replid=str_replace ($sourceid, $exchid,$replid);// replid это массив который нужд в изменении
	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$replid."' WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // вып доп условия модерниз.
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };

};
echo "Выполнено ".$findrecords." циклов.<br>";
};


// SUBINDSTRREPLACE замена внутри строки с индеком  эмуляция
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
$replid=implode ($subsplitter,$dataexp); //$replid=str_replace ($sourceid, $exchid,$replid);// replid это массив который нужд в изменении
	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$replid."' WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // вып доп условия модернизировано
	$result = dbs_query ($upd,$connect,$dbtype);;$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
	}; //endif dataexp
};//endwhile
echo cmsg ("WF_CCLOK").$findrecords.".<br>";
};//endif subindstrokes
// конец модуля эмуляции субстрок
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
	$a=$result;// проверка на вшивость :) чтобы сто раз не удаляли
	if (($views)AND($strupdmode=="allstrokes")) $upd=$cmd;//фикс непоказа запроса в 1реж
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a===true) { echo $vID.cmsg ("WF_UPDOK")."<br>";} else { 
				$errt=cmsg ("WF_UPDFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";}
	if ($delete) { $partaction="MASS_DEL_SQL"; } else { $partaction="MASS_EXCH_SQL";};
	if (($pr[12])AND(!$cmd)) {$act=$partaction." B $tbl Replsub $sourceid $exchid"; logwrite ($act) ;	};  // логируемся
	if (($pr[12])AND($cmd)) {$act=$partaction." B $tbl Repl $sourceid $exchid CMD $cmd"; logwrite ($act) ;	};  // логируемся
}



	



//модуль запуска
//===============================  для масс сравнения будет похожая менюшка.
// для инстанс режима будет сначала выбор инстансов а дальше уже просто данные будут передаваться похожему скрипту.
if (($write==cmsg("KEY_MASCPY"))AND($prdbdata[$tbl][12]!="fdb")) {
  @ $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
// выбор колонки из текущей базы
	lprint ("WF_MASCPYMSG");// Вставлено для выбора поля
//	$ar=$selectedfield;
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a; копия модуля из начала writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,$ipfilter,6);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"destination",cmsg ("WF_MAS_DEST"),$groupdb,$ipfilter,6);
	//конец выбора колонки из текущей базы

 ?><br><input type= hidden name=go value=Переход_копирование> 
 <?   checkbox ($views,"views") ;echo cmsg ("WF_LOG")."<br>"; 
    checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
  if ($prauth[$ADM][5]==1) echo ""; // резерв для удаления
// echo "<gray>Просто просмотр, без копирования</red><input type=checkbox name=delete><br>"; ?>
  <? lprint ("WF_MASCPYACT") ; ?> <br>
  <input type="radio" name="cpymod" value="copyabort"> <? lprint ("ABORT") ; ?> 
  <input type="radio" name="cpymod"  value="copyrewrite"> <? lprint ("REWRITE") ; ?>
  <input type="radio" name="cpymod"  value="copyignore"> <? lprint ("IGNORE") ; ?><br>
 <? 	
// start compare addif
echo cmsg ("WF_MASCPYIFHLP")."<br> ";

   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?
	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
	<? submitkey ("write","KEY_S_COPY");
}

//модуль обработки
if (($write==cmsg("KEY_S_COPY"))AND($prdbdata[$tbl][12]!="fdb")) {
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();

	//echo "Процедура работает в тестовом режиме";
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


	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
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
	

	if (($addifenable1)OR($addifenable2)) {$cmd=$cmd.$cmdaddif;		}; // вып доп условия модернизировано
//echo "cmdaddif-$cmdaddif addifcmp2=$addifcmp2 addifcmp1=$addifcmp1";
$cmd=$query.$cmdaddif.";";
//echo "<br>$cmd=$query.$cmfaddif.<br>";
	if (!$pr[8]) {echo "DEBUG Получен код $result<br>";}

//executing+errlogделаем нормальную обработку ошибок  исп всегда этот модуль
$result = dbs_query ($cmd, $connect,$dbtype);
  if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// пишет ошибку и ее код  и его же возвращает
$error= mysql_error ();
//echo $error;
if ($errno) {lprint ("WF_POSERR");}
//endof executing


	if ($pr[12]) {$act="MASS_COPY_SQL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;	};  // логируемся
}

//=========================================


//копирование таблиц. возможно будет частью модуля работы с базами данных
//паковка баз данных - список ключей вверху файла, файл обрабатывается до координаты ключа,ключ вст.обр. продолжается

//использовать тот же тип выбора что и в мастере соединения таблиц.
//модуль запуска - сравнение

// bug - при копировании таблиц не сообщает что они были успешно скопированы,  при исполнении скрипта аналогично
/*
 * мои планы на ближайшие 24 часа.
я думаю у меня выйдет если я отвлекатся не буду.

1 - добавить в сайт новости. - сделаю на страницу сообщество , т.к. другой пустой страницы с кнопкой там нет, а у меня нет шрифтов чтобы делать кнопки

2скрипты в планах
сравнение баз, сравнение таблиц, выделение разницы в SQL скрипт
улучшение исполнения дампа до понимания перевода строк любого файлы
улучшение генерирования лога (с включением шапки в INSERTы)
добавление macros.cfg для группировки таблиц для совершения однотипных операций сразу с группой по 1 команде. (это в последнюю очередь)

*/
if (($write==cmsg ("KEY_COMPARE"))AND($prdbdata[$tbl][12]!="fdb")) {
//echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
//global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;
//echo "global $groupdb,$groupdb2,$tablesource,$tabledest,$kol1,$kol2;";
    $groupdbthisname="groupdb";
		groupdbprint ($list,"Group",$prdbdata,$tbl,$groupdb); // wat &   db lost (real name) 
    $groupdbthisname="groupdb2";
		groupdbprint ($list,"Group2",$prdbdata,$tbl,$groupdb);
hidekey ("hidemenu",1);//убирать меню
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
 hidekey ("hidemenu",1);//убирать меню
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
   // checkbox ($keys,"keys"); echo cmsg ("WF_MASCMP_KEY")."<br>"; пока нет возм сравнить содержимое
   //checkbox ($dbaff,"dbaff") ; echo cmsg ("WF_INSBAS")."<br>"; если поля баз разные то и базы авт надо разные сравнивать!!! -
     
 hidekey ("tablesource",$tablesource);
 hidekey ("tabledest",$tabledest);
 // здесь определяем реальный groupid
 // хотя этот метод хуже чем определение groupdb и выдача db ,  но всеже alias точно содержит нужный db id , а groupdb может быть одинаковым для разных db
 //for ($a=)
 hidekey ("groupdb",$groupdb);
 hidekey ("groupdb2",$groupdb2);
 //hidekey ("groupdb",$groupdb);
 //hidekey ("groupdb2",$groupdb2);
 hidekey ("hidemenu",1);//убирать меню
 hidekey ("menudisable",on);
  $x=explode (".",$tablesource); // разделяем базу данных на базу и таблицу
  $databasedef=$x[0];
  $tabledef=$x[1];
$dbtype="mysql";
$tbl=gettblidfromdbandtable ($prdbdata,$databasedef,$tabledef,"id");
//echo "проверка на вшивость -$tbl=gettblidfromdbandtable ($prdbdata,$databasedef,$tabledef,$string);  ";
 	$data=readdescripters (); if ($data==-1) exit; //$tbl=0; она ориентируется только на это значение
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
 ?>  <input type="radio" name="cmpmode"value="1to2"><? lprint ("WF_CMP_12") ; ?><br>
  <input type="radio" name="cmpmode" value="2to1"> <? lprint ("WF_CMP_21") ;?><br>
  <?
  //submitkey ("write","KEY_COMPARE_3");
  //checkbox ($a1,"a1"); echo cmsg ("WF_MASCMP_KEY")."<br>";  CANNOT BE DISABLED  , CFG OPT FUTURE
  checkbox ($wfcmpqry,"wfcmpqry") ; echo cmsg ("WF_CMP_QRY")."<br>";
     checkbox ($execute,"execute") ; echo "<red>".cmsg ("WF_VIEANDEXEC")."<br></red>";
     checkbox ($GENALT,"GENALT") ; echo cmsg ("GENALT")."<br>";
// start compare addif COPY 
//checkbox ($cmpifchg,"cmpifchg") ; echo "<gray>".cmsg ("WF_CMPIFCGH")."<br></red>";
   echo "<input type=checkbox name=addifenable1>";
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1");
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$vID; ?></textarea><br>
		<?
	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2");
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
	<?
   //   echo "cmd=$cmd<br>";
  submitkey ("write","KEY_S_COMPARE");

  }
//






//модуль исполнения - сравнение
if (($write==cmsg ("KEY_S_COMPARE"))AND($prdbdata[$tbl][12]!="fdb")) {
  // result screen
  $cmdaddif="1=1";
  
    $x=explode (".",$tablesource); // разделяем базу данных на базу и таблицу
  $databasesource="`".$x[0]."`.";
  $tablesource="`".$x[1]."`";
  $source=$databasesource.$tablesource;
  $x=explode (".",$tabledest); // разделяем базу данных на базу и таблицу
  $databasedest="`".$x[0]."`.";
  $tabledest="`".$x[1]."`";
  $dest=$databasedest.$tabledest;

  if ($cmpmode=="2to1")  {
      $x=$source;
      $source=$dest;
      $dest=$x;
  }
$sourcetable=$tablesource; //for execute

  //preparing условия WHERE
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

// execute mode..  try generate and execute script (can be splitteD) CFG OPT FUTURE
  if ($wfcmpqry) {echo "wfcmpqry _on ";
//echo $cmd;
//$cmd=" SHOW DATABASES;";
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
        $mycols=dbs_num_fields ($result,"");
	if ($result==true) { echo $vID.cmsg ("WF_CMP")."<br>";} else {
				$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";
                                //почему то всегда пишет ошибку
                                }
                                // может эту функцию выделить отдельно?
if ($GENALT) {
    global $mycol;  // улучшенное - можно выделить CFG OPT FUTURE// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];
}
if ($execute) $sourcetable=$databasedest.$sourcetable;// целевая база данных указывается автоматически.
// печать   формирование текста запроса
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
                // потом улучшить чтобы не делала излишний код

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
 // вывести чего не хватает первой до второй  с ключами
  //код показывающий содержимое всех ячеек конечной таблицы которых не хватает в начальной

//код список ID всех ячеек конечной таблицы которых не хватает в начальной
//$cmd="SELECT $kol1 FROM `$tabledest`.`$tabledest` WHERE `$kol2` NOT IN (SELECT `$kol1` FROM `$tablesource`.`$tablesource` WHERE 1=1)";

     
// a   piiii   rabotaet SELECT * FROM `tchars_t3can`.`guild` WHERE 'guildid' IN (SELECT * FROM `tchars`.`guild`);
/*  какого хера не работает ????? cmd generic :SELECT * FROM `tchars.account_data` WHERE `criteria_id` NOT IN (SELECT `criteria_id` FROM `trealm.account` WHERE 1=1)
 *SELECT * FROM `tchars`.`guild` WHERE 'guildid' NOT IN (SELECT 'guildid' FROM `tchars_t3can`.`guild`);
Очень хочется юзануть перенос отсюда  ('эта функция что до сих пор не сделана? )
SELECT * FROM `ytdb560u`.`table` WHERE `entry` NOT IN (SELECT `entry` FROM `ctdb013_test`.`quest_template` WHERE 1=1)
взять 2 линка  сравнить число колонок, запустить   set names
ВЗЯТО ВЫШЕ:::
WF_MASCMP_KEY;Сравнивать только наличие данных, не содержимое
WF_CMP_12;Вывести сравнение первой относительно второй+++
WF_CMP_21;Вывести сравнение второй относительно первой+++
WF_CMP_QRY;Создать и показать скрипт на объект соотвествующий условию+++


 */
}
//

// модуль запуска создание макро
if (($write==cmsg ("KEY_MACRO"))AND($prdbdata[$tbl][12]!="fdb")) {
needupdate ();
// needupgrade ();  модуль для особых версий dbscript
submitkey ("write","KEY_S_MACRO");
}

// вариант 2 -    написание скрипта лично пользователем, с указанием %a %b  по типу printf и методики выполнеиня :)


// модуль исполнения создание макро
if (($write==cmsg ("KEY_S_MACRO"))AND($prdbdata[$tbl][12]!="fdb")) {
needupdate ();
//  1 - выбирается группа таблиц как в dblinker
// выбирается поле для ID1 операций
// для операций будут использовать  scr dest id1 tablelist переменные (массивы) 
}






//модуль запуска
//===============================  для масс сравнения будет похожая менюшка.
// для инстанс режима будет сначала выбор инстансов а дальше уже просто данные будут передаваться похожему скрипту.   вообще то реально сравнение все же нужно сделать без разницы где
if (($write==cmsg ("KEY_SHOWCODE"))AND($prdbdata[$tbl][12]!="fdb")) {

  @ $connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
// выбор колонки из текущей базы
	//echo cmsg ("WF_MASCPYMSG").cmsg ("WF_MASCMPMSG")."<br>";// Вставлено для выбора поля
//	$ar=$selectedfield;
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a; копия модуля из начала writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb,$ipfilter,6);
//printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"dest",cmsg ("WF_MAS_DEST"),$groupdb,$ipfilter,6);
//конец выбора колонки из текущей базы

 ?><br>
<?
   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
   checkbox ($GENALT,"GENALT") ; echo cmsg ("GENALT")."<br>";
?>
 <input type="radio" name="cmpmode"  value="1only" checked><? lprint ("WF_CMP_QRY") ; ?><br>
  <? 	
// start compare addif
//checkbox ($cmpifchg,"cmpifchg") ; echo "<gray>".cmsg ("WF_CMPIFCGH")."<br></red>";
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$vID; ?></textarea><br>
		<?
	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
	<?  submitkey ("write","KEY_S_SHOWCODE");
          submitkey ("write","WF_SHOW_TAB_CRT");
	// end compare addif   Вставлено для выбора поля
}

//модуль обработки
if (($write==cmsg ("KEY_S_SHOWCODE"))AND($prdbdata[$tbl][12]!="fdb")) { //  execute (!(
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();
	$connect = dbs_connect ($prdbdata[$source][6], $sd[14] , $sd[17],$prdbdata[$source][12]);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;
	$mycol=$data[0];
	$id1=$mycol[$md2column];
	if ($virtualid) $id2=$mycol[$virtualid];
	if ($cmpifcfg) $id1=$addif1;// cброс 
// mycol и так содержит правильные названия колонок
	if ($nolimit) {set_time_limit(0);} else {set_time_limit(60) ;};
//			if ($keys)  -только ключи - не проверяь содержимое

if ($dbaff) {
	$sourcedb="`".$prdbdata[$source][9]."`.";
	$destdb="`".$prdbdata[$dest][9]."`.";
}
$sourcetable=$sourcedb."`".$prdbdata[$source][5]."`";
$desttable=$destdb."`".$prdbdata[$dest][5]."`";
//  9 - db   5 - table  `".$prdbdata[$source][9]."`.

	if ($cmpmode=="1only") { unset ($keys);  $cmd="SELECT * FROM `".$prdbdata[$source][9]."`.`".$prdbdata[$source][5]."` WHERE";	} 
	// чтобы отобразить все надо стереть именно это WHERE !!!!!!!!!!!!!
	// в общем какого то хрена перестала работатьь и последняя полезная часть запроса теряя передаваемые переменные
	
//   if (!$addiflist1) { lprint ("WF_NEEDIF");exit;};
   if ($addiflist1==$addiflist2) { lprint ("WF_BADIF"); exit;};
// сдесь будет играть роль по индексам или целиком ровнять  bbbabagbbw
// сравнение   все что равно,  все что не равно по ключам , вообще все что не равно
// все с условием


	if ((!$keys)AND($cmpmode!=="1only"))
	{ echo "Эти значения в обоих таблицах полностью совпадают.<br>";
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
	
	$cmd=$cmd.$cmdaddif.";";		// вып доп условия модернизировано
//echo $cmd;
//$cmd=" SHOW DATABASES;";
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
	if ($result==true) { echo $vID.cmsg ("WF_CMP")."<br>";} else { 
				$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";
                                //почему то всегда пишет ошибку
                                }
                                // может эту функцию выделить отдельно?
if ($GENALT) {
    global $mycol;  // улучшенное - можно выделить CFG OPT FUTURE// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];
}
// печать   формирование текста запроса
 if ($GENALT) $insertone="INSERT INTO $sourcetable ".$field." VALUES ";
    for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$GENALT) {
                    $insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
                    echo $insertone."<br>";
                }
                if ($GENALT) {
                    $insertone.=gennohdlog ($sourcetable,$myrow,$mycols,$field).",";

                }
                // потом улучшить чтобы не делала излишний код
		
	};
       if ($GENALT)  {$insertone[strlen($insertone)-1]=";";

           echo $insertone."<br>"; }

  echo cmsg ("WF_CCLOK")." ".$c."<br>";


	if ($views) echo cmsg ("WF_EXQUE").$cmd."<br>";
		echo "<br>".cmsg ("WF_QUECOMP")." ".dbs_affected_rows ()." ".cmsg ("WF_Q1")."<br>";
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($pr[12]) {$act="SHOW_PATCH_SQL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // логируемся

	//executing+errlogделаем нормальную обработку ошибок  исп всегда этот модуль
$silent=0;$errno=dbserr ();// пишет ошибку и ее код  и его же возвращает
//if ($errno) {echo cmsg ("WF_POSERR")."<br>";}
//endof executing


}



//=========================================
//модуль запуска
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
	//Header("Location: r.php?tbl=log&mode=7&kol=1&vID=".$prauth[$ADM][15]."(".$prauth[$ADM][0].")");  показ постранично не умеет и last не пон
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
    $silent=0;$errno=dbserr ();// пишет ошибку и ее код  и его же возвращает
    if ($errno) {echo cmsg ("WF_POSERR")."<br>";}
    //print_r ($a);
    //($file,$filetoaction,$stroka)
    ////date("d.m.Y")  $prauth[$ADM][15]."(".$prauth[$ADM][0].")

	//Header("Location: r.php?tbl=log&mode=7&kol=1&vID=".$prauth[$ADM][15]."(".$prauth[$ADM][0].")");  показ постранично не умеет и last не пон
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



//echo "write=$write tbl=$tbl massoper=$massoper prdb12=".$prdbdata[$tbl][12]." <br>"; какого хера передается код массововй операции вновь и вновь??????
// KEY_S_MASS_OPER теряется - приходится заюзать KEY_MASS_OPER   рем AND($prdbdata[$tbl][12]!="fdb")

// модуль исполнения====================================
if (($write==cmsg ("KEY_S_MASS_OPER"))AND($prauth[$ADM][45])AND($massoper)) {
if (!$massoper) echo "Необходимо выбрать режим работы ! Select option first !";
// 1- change column  , 2 - show generate script (SQL only)  3- remove 4 - to best 5 - noop
//ells 2.1.3¦spells.dat¦-¦30971++¦31262++¦31657++¦
if ($massoper==5) return;
$activetable=$prdbdata[$tbl][1];
echo "Активная таблица Active table: $activetable [$tablemysqlselect'$tblmysqlselect]; Given data total:$boxcnt<br>";
for ($a=0;$a<$boxcnt;$a++) {
        $b=${box.$a};
        $c=explode ("+",$b);
	$strokedata.=$b."¦";//if ($box[$a][2]) $strokedata.="&".$box[$a][2]."¦";
        $strokefixeddata1.=$c[0].",";
        $strokefixeddata2.=$c[1].",";
 //echo " box[$a]==>".${box.$a}."".$box[$a][1]."<br>";  //ids vID  vID2  DISABLE VISIBLE print no ID's, a parts.
//hidekey ("box".$a,$box[$a][0]."&".$box[$a][1]);
}
//тут заканчивается генерация строки.
echo "Selected data lines : $strokedata<br>";

if (($massoper==3)AND($prdbdata[$tbl][12]=="fdb")){//fdb del mass with undo
    //модуль обработки
  
    echo "starting mass delete $boxcnt entries.<br>";
for ($a=0;$a<$boxcnt;$a++) {
    $string=${box.$a};
    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
    echo "deleting id1=$vID id2=$vID2 <br>";
    if ($virtualid=="") $vID2="";// если нет вид2 тогда его значение просто ненужно.   возможно это где то ещё надо добавить.
//процедура скопирована из простого удаления и НЕОПТИМИЗИРОВАНА 
		if ($codekey==7) demo ();
		if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) {
		@$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
		if ($filbas=="gmdata.cfg") {
			$a=testadmin ($prauth,$vID);
			if ($a==1) {print cmsg ("WF_NODELADM")."<br>";exit;};};

	}
	$data=readdescripters ();  if ($data==-1) exit;
csvmod ($f,"del",$values,$vID,$vID2); // при ошибках вызывает белый экран  не давать NULL
lprint ("WF_QUECOMP");
undolog ($act,$undodata,$tbl,"");
if ($pr[12]) {$act="DEL_DAT_SEL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;	};  // логируемся
submitkey ("write","WF_UNDO_LAST");
}//endcycle


}
if ($massoper==1){//fdb del mass with undo
    //модуль обработки  по сути аналог MASS_EXCH  может ему и передаватть все данные с надстройкой список? 
    echo "starting mass exchange fdb $boxcnt entries.<br>";
for ($a=0;$a<$boxcnt;$a++) {
    $string=${box.$a};    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
    echo "exchanging id1=$vID id2=$vID2 <br>";// наши переменные в $vID i $vID2  $a - цикл ими уплравляющий
}//  drugaya skobka ubrana
if ($virtualid=="") $vID2="";// если нет вид2 тогда его значение просто ненужно.   возможно это где то ещё надо добавить.
//$strokefixeddata=str_replace ("¦",",",$strokedata);//hide
 
$strokefixeddata1=(substr($strokefixeddata1, -1) == ',') ? substr($strokefixeddata1, 0, -1) : $strokefixeddata1;
echo "$strokefixeddata1";

hidekey ("addiflist1",$strokefixeddata1);
//hidekey ("addiflist2",$strokefixeddata2);  if $string=explode ("+",$string)  true значит был послан отсюда запрос.  начну правку с этого
//hidekey ("field",$addif1); // передается , но не принимается. ну и нафиг его.
////hidekey ("nfield",$addif1);//увы не доходит оно до KEY_MASEXC  там селект его теряет. ядро проверяет $field, видимо содержимое отличается
hidekey ("sourceid",$sourceid);
hidekey ("exchid",$exchid);//hidekey ("addif1",$addif1);//hidekey ("addifcmp1",$addifcmp1);
hidekey ("addifenable1","1");
//hidekey ("addifenable2","1"); // как узнать про второй ID ?  такой вариант не покатит нужно править MASEXCH  dat условие и  ID2 ....
hidekey ("nolimit",1); //3266
hidekey ("strupdmode","subindstrokes");
hidekey ("vID",$vID);
hidekey ("vID2",$vID2);
submitkey ("write","KEY_MASEXC");
}


if (($massoper==3)AND($prdbdata[$tbl][12]!="fdb")) { //sql del mass with undo
  // SELECT SAVEUNDO  DELETE ALL WHERE IDS=  //
    //модуль обработки  по сути аналог MASS_EXCH  может ему и передаватть все данные с надстройкой список?
    echo "starting mass del sql $boxcnt entries.<br>";
for ($xa=0;$xa<$boxcnt;$xa++) { //копия DEL_SQL  renewed!~
    $string=${box.$xa};    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
    echo "exchanging id1=$vID id2=$vID2 <br>";// наши переменные в $vID i $vID2  $a - цикл ими уплравляющий
    if ($virtualid=="") $vID2="";// если нет вид2 тогда его значение просто ненужно.   возможно это где то ещё надо добавить.
      // процедура удалени $tablemysqlselect'$tblmysqlselect
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;
 if ($prdbdata[$tbl][9]=="dbscriptbk") $virtualid=false;  // CFG OPT FUTURE  пока не решил что делать.
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
	// тут надо бы undo     //exec reselect  в случае неправильно установленного id2 надо его сбросить, в случае наличия правильных обоих попытаться отредактировать данные другим методом
            // работает отлично даже если неправильно указан ID2 ))))
            if (dbs_num_rows($result)>1) {echo "Multi select detected.Trying autoset new ID.";   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
                $virtualid=$md2column+1;
                $cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
                $result = dbs_query ($cmd, $connect,$dbtype);
                $myrow = dbs_fetch_row ($result,$dbtype);
                if (dbs_num_rows($result)==1) { echo "<br>Success!<br>";$virtualidfixed=1;};
                if (dbs_num_rows($result)>1) {$directedit=1;echo "<br>".cmsg ("DE_REQ")."<br>";};   // обнаружили что скрипт что то многовато нашёл , не должно быть более 1 строки !
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
                    if (!$test) $test=$myrow[0];// если есть что удалять тест включен
                    $undodata.=gencmdlogi ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols,"")." ";
                //    echo $cmd; записываем отсутствующий undolog
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
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
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
      //окончание процедуры удаления.



}//  drugaya skobka ubrana

}
 
if (($massoper==2)AND($prdbdata[$tbl][12]!="fdb")){// redirect to showcode
    //модуль обработки  по сути аналог MASS_EXCH  может ему и передаватть все данные с надстройкой список?
    echo "starting mass exchange $boxcnt entries.<br>";
for ($a=0;$a<$boxcnt;$a++) {
    $string=${box.$a};    $string=explode ("+",$string);
				$vID=$string[0];$vID2=$string[1];
  if ($debugmode)  echo "retrieving id1=$vID id2=$vID2 <br>";// наши переменные в $vID i $vID2  $a - цикл ими уплравляющий
  if ($virtualid=="") $vID2="";// если нет вид2 тогда его значение просто ненужно.   возможно это где то ещё надо добавить.
    // копия SHOWCODE
    // процедура удалени $tablemysqlselect'$tblmysqlselect
        $connect = dbs_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17],$prdbdata[$tbl][12]);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols

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

// печать   формирование текста запроса
    for ($c=0;$myrow = @dbs_fetch_row ($result,$dbtype);$c++) {
		$insertone=gencmdlog ($sourcetable,$myrow,$mycols,"");
		echo $insertone."<br>";
	};

  if ($debugmode) echo cmsg ("WF_CCLOK")." ".$c."<br>";
		//echo "<br>".cmsg ("WF_QUECOMP")." ".dbs_affected_rows ()." ".cmsg ("WF_Q1")."<br>";
	if ($debugmode) if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($pr[12]) {$act="SHOW_PATCH_SQL  B $tbl($nametbl) id1=$vID id2=$vID2 Cmd= $cmd"; logwrite ($act) ;};  // логируемся

    //conec kopii SHOWCODE
}//  drugaya skobka ubrana

    

}




if ($massoper==4) { // dlya fdb po kakoy to prichine teryaetsya userfolder
    if ($debugmode)  echo "[debug]Userfolder=$userfolder;<br>";
$filbas=$userfolder."/best.cfg";  // возможно будет дб в initse  с созданием шапки если файла вообще нет+++
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
  	//проверка работает успешно , первая запись делается идеально правильно.
  }
  echo "Massive have lines (bestcnt) =$bestcnt<Br>";

if (is_array ($bestheader)) { //header уже есть
	$bestheader=implode ($bestheader,"¦");
	$bestplevel=implode ($bestplevel,"¦");
	echo "tempprint bestheader= $bestheader<bR>";};
if (($bestheader=="")OR($bestheader=="¦")) {  //header отсутствует
	$bestheader="activetable¦table¦db¦dataline-autohdr";	$bestplevel=$bestheader;
$newdata=1;$bestcnt=1; //only if no data allowed;
if (($OSTYPE=="LINUX")) { $bestheader.="\n"; $bestplevel.="\n"; } //AND($bestheader[count ($bestheader)-2]!=="\n")
		 } else { echo ""; };

// создаем липовую шапку

echo "<br>";
if ($rewr) {$bestcnt=$rewritecnt+1; lprint ("REW_OK"); echo "<br>";}  //rewrite MO

// тут надо искать старое значениенND");$action="UNBAN IP ".$cmd[1]."!";logwrite ($action);
		if ($OSTYPE=="LINUX") {$strokedata.="\n"; }//запись ведется БЕЗ проверки!! сделать ее!   И чето нихрена не пишется
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
//..echo "ВЫХОДИМ!";exit;
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
//модуль запуска     AND($prdbdata[$tbl][12]!="fdb")
if (($write==cmsg ("KEY_MASS_OPER"))AND($prauth[$ADM][45])) { //  CFG OPT FUTURE
lprint (M_OP_INF);echo "<bR>";

$data=readdescripters ();
echo "";
radio ("massoper",1,"M_OP_1") ;//printfield ($data,"addif1");
	//printcmp ("addifcmp1");
/*?><textarea name=addiflist1 cols= 25 rows=1 wrap=virtual><?=$addiflist1; ?></textarea><br><?	*/
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
//модуль запуска 
if (($write==cmsg ("KEY_EXECUTE"))AND($prdbdata[$tbl][12]!="fdb")AND($prauth[$ADM][34])) { //  CFG OPT FUTURE
if ($codekey==7) die ("Disabled for secutiry reasons.");


if ($codekey==5) needupgrade ();
// if (!$prauth[$ADM][2]) die ("Возможно не хватает прав ;)");
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
  <input type="radio" name="cpymod" value="copyabort"> <? lprint ("ABORT") ; ?> 
    <input type="radio" name="cpymod" value="copyignore" checked> <? lprint ("IGNORE") ; ?><br>
		<textarea name=vd cols=75 rows=8 ></textarea>

<?
echo "<br>";
submitkey ("write","KEY_S_EXEC");
submitkey ("write","WF_BCK_FILEDUMP_UNARCH");echo "<br>"; 
//submitkey ("write","");
echo "<br>";
}	
//модуль обработки


if (($write==cmsg ("KEY_S_EXEC"))AND($prdbdata[$tbl][12]!="fdb")) {
// if (!$prauth[$ADM][2]) die ("Возможно не хватает прав ;)");
$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
$dbtype=$prdbdata[$tbl][12];
	if (!$disabledbselect) { $c=dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype); echo "Using: ".$prdbdata[$tbl][9]."<br>";}
	if (($directexecute)AND($forcedb)) {$c=dbs_selectdb ($dbselected, $connect,$dbtype);
		echo "Forced use: $dbselected<br>";	//$cmd="USE $dbselected;";	dbs_query ($cmd,$connect,$dbtype);;
	} ;
        if ($utf8) { dbs_query ("SET NAMES `utf8`;",$connect,$dbtype); };
	if (!$c) echo "connection failed<br>";
	if (!$disabledesc) $data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
    $cmd=$vd;global $printlimit;
	// модуль лимитирования вывода SQL
	if ($printlimit and $limitenable) { 
	settype ($printlimit,"integer");
if ($printlimit==false) { msgexiterror ("limit","noexit","disable");} else {$limit=" LIMIT $printlimit";};}
	// модуль лимитирования вывода SQL end
// модуль сортировки
 if ($selectenable) $group=" GROUP BY ".$field."";
// конец модуля сортировки
//$qw=dbs_query ($cmd,$connect,$dbtype);;echo $qw."--"; dbserr ();
	//$patterns[0]="//\'/" ;$replacements[0]="'"; //Unknown modifier '\' in 
	if ($debug) echo "key_s_exec check cmd - $cmd<br>";
        $patterns[0]="/\\\'/" ;$replacements[0]="'"; //4.1  check
	@$cmd=preg_replace ($patterns,$replacements, $cmd);//4.1  check
        if ($debug) echo "key_s_exec check cmd after preg replace - $cmd<br>";

        //CFG OPT FUTURE - именно здесь содержится глюк вывода на печать
	if (strpos ($cmd,"SELECT")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"SHOW")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"CHECK")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"REPAIR")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"ANALYZE")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"OPTIMIZE")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"BACKUP")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"RESTORE")!==false) $printing=1; // разрешает печать в libmysql
	$cmd=$cmd.$group.$limit; // именно в этом порядке
        $queries=explode (";\r",$cmd);  // так просто ????? WTF
        //..$queries=preg_split ('\\' ,$cmd);
        //if (!$pregsplitdisabled) $queries=preg_split("#(ENGINE=[^\;]+)\;\r?\n#i",$cmd,-1,PREG_SPLIT_DELIM_CAPTURE);
        //print_r ($queries); echo "executing aborted --------- test ";
        //exit;
        ////  echo "forced data dblk=$dblk , dbsel, tab=$tab";
if ($generic)  { $printing=0; echo "std table out disabled by generating script<br>"; };
  //  вот бла.  вчера вечером была закрывающая скобка и все работало. а сегодня её нет. что за7

        $countqueries=count ($queries);  //тут вот ошибка с выполнением. ;  нельзя так делать  !!! исправить!!!
   // а теперь выполнение большого количества запросов
   //echo "q=".$countqueries."<br>";
	for ($cntque=0;$cntque<$countqueries;$cntque++) {
		unset ($errt);unset ($ermsg);
		$multicmd=$queries[$cntque];
		if ($multicmd=="") continue;
		$a=executesql ($multicmd,$connect,0);// было 
	if ($a==-1) executesql ($multicmd,$connect,2); //old mode for possible bugs issue
        //
        // простой скрипт проверки - SELECT * FROM `tchars_t3can`.`guild` WHERE `guildid` NOT IN (SELECT `guildid` FROM `tchars`.`guild` WHERE 1=1);
        //. сло /// это не сравнение бла SELECT * FROM `tchars`.`guild_bank_item` WHERE `guildid`='79';
////SELECT * FROM `tchars`.`item_instance` WHERE `guid` IN (SELECT `item_guid` FROM `tchars`.`guild_bank_item` WHERE `guildid`=79) LIMIT 10;
//SELECT `guid` FROM `tchars`.`item_instance` WHERE `guid` IN (SELECT `item_guid` FROM `tchars`.`guild_bank_item` WHERE `guildid`=79);
////SELECT * FROM `tchars_t3can`.`item_instance` WHERE `guid` IN (SELECT `item_guid` FROM `tchars_t3can`.`guild_bank_item` WHERE `guildid`=79) ; FINALE
// выбрать все ГУИДЫ всех вещей из гильдбанка и показать их в данных  item_instance
                    // возможно этот код стоит как то выделить ?  на генерацию кода... он уже раз 4-й точно используется почти без изменений
               if ($generic) {echo "g _on ";  // залочить обычную печать при генерации кода чтобы не лагало
//echo $cmd;
$printing=0;  // disables print
//$cmd=" SHOW DATABASES;";
	if ($cmd) $result = dbs_query ($cmd, $connect,$dbtype);
        $mycols=dbs_num_fields ($result,"");
	if ($result==true) { echo $vID.cmsg ("WF_CMP")."<br>";} else {
				$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";
                                //почему то всегда пишет ошибку
                                }
                                // может эту функцию выделить отдельно?
if ($GENALT) {
    global $mycol;  // улучшенное - можно выделить CFG OPT FUTURE// copyed from dbscore readdescripters
    $data2=dbs_genericnumlist ($result,$mycols,$mycol);
    $field=$data2["fieldlist"];
}
$sourcetable="`".$prdbdata[$tbl][5]."`";// целевая база данных указывается автоматически.
//$sourcetable="`".$prdbdata[$tbl][9]."`";// целевая база данных указывается автоматически./
// печать   формирование текста запроса
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
                    if (!$noprintsave) echo $insertone."<br>";  // в другие части этой копии скрипта внедрить сохранение в файл (!!!) CFg OPT FUTURE
                    if ($noprintsave)  {
                        fwrite ($dumpfile,$insertone);
                    };
                }
                if ($GENALT) {
                    $insertone.=gennohdlog ($sourcetable,$myrow,$mycols,$field).",";
                    //echo "faak  -  $insertone=gennohdlog ($sourcetable,$myrow,$mycols,); ";

                }
                // потом улучшить чтобы не делала излишний код

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
                    //..окончание вставки кода генерации
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
	
	};  // логируемся
	if (($countqueries-1)>1) {echo "<br>".cmsg (WF_SEND_SQL_E_T)." ".($cntque-1-$error)."/".($countqueries-1)."<br>";
	if ($skipped) echo cmsg ("BCK_SKIP").$skipped."<br>";
	if ($error) echo cmsg ("BCK_ERR").$error."<br>";
	}	

}




echo "</form>"; // конечный тег для всего 

// функции экспортирования и импортирования баз NEW
function importexporttbl ()
{
	 global $prdbdata; global $prauth; global $ADM;
	 global $pr; global $sd;global $tbl; global $write;
  //if (($write==cmsg("A_IMPEXP"))OR($write==cmsg("A_IE_DEST"))OR($write==cmsg("A_IE_SRC"))OR($write==cmsg("A_IE_START"))) { echo "";} else  { return;} // недоперенесено куда надо.
   	 global $sd17; global $addmode; global $send; global $views;
	 global $tbl1;global $tbl2;global $totalbas; global $filbas,$codekey,$usecomma2x;
		 if ($codekey==7) demo ();
	if ($prauth[$ADM][10]<2) { lprint ("ACCDEN"); exit;};
	if ($prauth[$ADM][2]==false) { lprint ("ACCDEN"); exit;};
	//не разрешает администрировать не имея этого права - защита от альтернативного входа ($prauth[$ADM][10]<2)
	 if ($prauth[$ADM][16]==0) {
	 echo cmsg (CONV_NOTE)."<br>";
	 }

	?> <form action=w.php method=post><?
hidekey ("vID",$vID);
hidekey ("colfind",$colfind);
hidekey ("tbl1",$tbl1);
hidekey ("tbl2",$tbl2);
hidekey ("ietbl",1);
// colfind - пока не подключен будет развертыватся
for ($a=0;$prdbdata[$a]==true;$a++) {
$k = count($prdbdata);$l= $k+1;
$filbas=$prdbdata[$a][0] ; $bas[$a]=$prdbdata[$a][1];
}

// $k= count($db) - вычисление кол-ва столбцов
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
 //найден код требуемой базы
$filbas=$prdbdata[$tbl1][0];

  if (isset ($colfind)) { $colfind= $md2column;}

submitkey ("write","A_CONV_SRC_CHG");
?> </form>
<form action=w.php method=post>
<?
hidekey ("vID",$vID);
hidekey ("colfind",$colfind);
hidekey ("tbl1",$tbl1);
hidekey ("tbl2",$tbl2);
hidekey ("ietbl",1);
// colfind - пока не подключен будет развертыватся
for ($a=0;$prdbdata[$a]==true;$a++) {
$k = count($prdbdata);$l= $k+1;
$filbas=$prdbdata[$a][0] ; $bas[$a]=$prdbdata[$a][1];
}

// $k= count($db) - вычисление кол-ва столбцов// c7 0 - select  c7 1 - start
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
 //найден код требуемой базы
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
   if ($ncols != sizeof($line_chunks)) print "<br># ошибка, несоответствие колонок и данных<br>";
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
   $line = eregi_replace("[[:space:]]+", "", $line);
   $letterarray = char2array($line);
   for ($i=0;$i<count($letterarray);$i++) {
      if (eregi("^[_a-z0-9-]+", $letterarray[$i]))
         $fieldname .= $letterarray[$i];
   }
   return $fieldname;
}

//end procs standart csv<-->sql converter
  if (isset ($colfind2)) { $colfind2= $md2column2;}

 submitkey ("write","A_CONV_DEST_CHG");
 ?></form>  <?
   echo cmsg ("A_CONV_TOEXEC").":<br>".cmsg ("A_CONV_SRC").$namebas." (".$tbl1.") -->".cmsg ("A_CONV_DEST")." ".$namebas2." (".$tbl2.")<br>";
	if ($dbtype==$dbtype2) { echo "<red>".cmsg ("A_ONESTRUCT")."</red><br>";};
	if (($dbtype=="fdb") AND ($dbtype2=="mysql")) { echo " CSV->->SQL.<br>";};
	if (($dbtype=="mysql") AND ($dbtype2=="fdb")) { echo " SQL->->CSV.<br>";};
	
if ($write===cmsg ("A_CONV_START")) {
	if ($prauth[$ADM][10]<2) { lprint ("ACCDEN"); exit;};
	set_time_limit(0);
	//процесс
	//  2235 to 22355   serega   3377 removed to 2235
	if ($dbtype==$dbtype2) { lprint ("A_ONESTRUCT");exit;};
	//start decoding SCP to CSV
	if (($dbtype==2) AND ($dbtype2=="fdb")) {
		$filbas="_data/".$prdbdata[$tbl1][0];
		echo "<font color=red>Работа над данным режимом не закончена.</red><br>".$filbas;
		iniparse ($filbas,21) ;};
	//end of decoding SCP to CSV

	//  CSV to SQL
	if ((($dbtype=="fdb") AND ($dbtype2=="mysql"))) {
	$filbas=$prdbdata[$tbl1][0];// где то ВСЕГДА теряет $filbas пришлось так сделать
	$csv_file_name=$filbas;
	$csv_file=$filbas;  //reconfig
	if (!$filbas) { echo "Filebas = $filbas !!!!!!"; exit; };
	$db_host=$hostmysqlselect2;
	$user_nm=$sd[14]; //хм а почему Access denied for user '1'@'localhost' (using password: YES) in /media/D/Work/KERNEL/dj/site/dbscore.lib on line 1172
	$password=$sd[17];
	$DATABASE=$tblmysqlselect2;echo "DEBUG DATABASE dest=$DATABASE";
	$table=$tablemysqlselect2;echo "DEBUG Table dest=$table";
//        echo "filbas=$filbas ; db_host=$db_host ; user_nm=$user_nm ; passwor=$password db=$DATABASE tab=$table";данные идут верные

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
      if (ereg('[^(]*\((.*)\)[^)]*',$client,$regs)) {
         $os = $regs[1];
         if (eregi("Win",$os)) $crlf="\r\n";
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
	  	$query.=$partquery; // окончательный запрос тут!
	//if ($views) { echo $partquery;}
// 	simple execute

	//mysql_select_db ($prdbdata[$tbl2][9], $connect);
        dbs_selectdb ($prdbdata[$tbl2][9],$connect,$dbtype2);
//	executesql ($query,$connect,"",1);  bad use only this command
$find;
$ax=array(); // почему то вариант с разделением на строки куда лучше работает
$ax=explode (";",$query );
for ($ab=0;$ab<count($ax)-1;$ab++) {
 if ($views) echo "<ii><bb>to execute ::: <br>".$ax[$ab].";<br>--- query $ab ---</ii></bb></bb><br>";
 $find=$find+executesql ($ax[$ab].";",$connect,"",2);
 if ($views) echo "<br>--------<br>";
}


//	echo "6=".$prdbdata[$tbl2][6]." 13=".$prdbdata[$tbl2][13]." 17=".$sd[17]." selected db=".$prdbdata[$tbl2][9]."<br>";
//	$result = dbs_query ($query,$connect,$dbtype);($query, $connect);
//	if ($result<1) { echo " Процедура импорта не удалась.  <br>$result<br>"; };
//	$myrow =dbs_fetch_row ($a,$dbtype);
      if (!$send)
         echo "</pre><p>";
   } else {
      echo "Необходим CSV для конверсии";

   }
   echo "Процедура закончена, выполнено $find операций.";
   @unlink($location);
exit;
		};

	// END CSV TO SQL

	// SQL TO CSV
	if (($dbtype=="mysql") AND ($dbtype2=="fdb")) {
	//	echo "Преобразование SQL в CSV.";
	$separator="¦";
        if ($usecomma2x) { $separator=";"; echo "Forced using ; as separator , plevel writing declined.<br>";  }
	$csv_file_name=$namebas2;  //reconfig
	$db_host=$hostmysqlselect;
	$user_nm=$sd[14];
	$password=$sd[17];
	$DATABASE=$tblmysqlselect;
	$table=$tablemysqlselect;

//процедура очень давно не проверялась,  ее надо вынести в w.php  и как следует проштудировать

   $connect=dbs_connect($db_host, $user_nm, $password,$dbtype) or die( "Unable to connect to SQL server");
   @dbs_selectdb($DATABASE,$connect,$dbtype) or die( "Unable to select DATABASE");
   $sqlcont = "select * from $table";
   $result = dbs_query($sqlcont,$connect,$dbtype);
   echo dbserr();

   function make_csv_happy($string,$separator) {
      $string = trim($string);
      if (eregi("\$separator",$string)) {
         $string = ereg_replace("\"", "\"\"", $string);
         $string = "\"".$string."\"";
      }
      $string = ereg_replace(10, "", $string);
      $string = ereg_replace("\r", "", $string);
      return $string;
   }

   if (mysql_fieldname($result, 0) == "id") $first_field = "iD";

   while($col < mysql_numfields($result)) {
      $fname  = mysql_fieldname($result, $col);
      if ($col < mysql_numfields($result)-1)$comma = $separator;
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
   $final .= $plevels."\n";//plevel generic  сделать выбор разделителя для сохранения - dbs 4.x 2.x (;)
   }
   while($row < mysql_numrows($result)) {
      $col=0;
      $line = "";
      while($col < mysql_numfields($result)) {
         $fname = mysql_fieldname($result, $col);
         if ($col < mysql_numfields($result)-1)$comma = $separator;
         else $comma = "";
         $line .= make_csv_happy(mysql_result($result,$row,$fname),$separator).$comma;
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
      if (ereg('[^(]*\((.*)\)[^)]*',$client,$regs)) {
         $os = $regs[1];
		 if (eregi("Win",$os)) $crlf="\r\n";
      }
   } else {
      echo "</center><p align=\"left\"><pre>";
   }
	// 		end SQL TO CSV

	 if ($views) echo $final;
	if ($addmode) {
			@$f=fopen ("_data/".$filbas2,"w") or die ("Не могу подсоединится к базе.");
	@fwrite ($f,$final) or die ("Невозможно произвести запись");
	@fclose ($f);
			} else {
			@$f=fopen ("_data/".$filbas2,"a+") or die ("Не могу подсоединится к базе.");
	@fwrite ($f,$final) or die ("Невозможно произвести запись");
	@fclose ($f);
			} ;


   if (!$send) echo "</pre></p>";

		};
	echo "Задача поставлена, подождите пожалуйста до окончания процесса и не переключайте страницу.	";

	exit;
}

?>
<form action=w.php method=post>
<?
hidekey ("db_host",0);
hidekey ("user_nm",0);
hidekey ("password",0);
hidekey ("DATABASE",0);
hidekey ("table",0);
hidekey ("tbl1",$tbl1);
hidekey ("tbl2",$tbl2);
hidekey ("ietbl",1);
	?>

<? checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
   checkbox ($unique,"unique") ; echo cmsg ("A_CONV_SETUID")."<br>";
   checkbox ($usecomma2x,"usecomma2x") ; echo cmsg ("USECOMMA2X")."<br>";
   checkbox ($addmode,"addmode"); echo cmsg ("A_CONV_SETREWR")."<br>"; ?>
<?   hidekey ("separator",";");
 	submitkey ("write","A_CONV_START");
	echo "</form>";
}


endtm ();
end;

/* 
 */

?> 
