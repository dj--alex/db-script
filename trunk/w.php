<? 
// Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex

require_once ('dbscore.lib'); // функция подготовки к работе и авторизации

if (!$activation) exit;
//$error=pg_connect ("!","2","3");echo $error;    postgre-php not installed

$verwritefile="Editor v4.0.971 (c) dj--alex";
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
if ($cmd=="del") { $write=cmsg ("KEY_DEL"); }
if ($cmd=="hdr") { $write=cmsg ("KEY_HEAD"); }
if ($cmd=="dat") { $write=cmsg ("KEY_DATA"); }
if ($cmd=="sql") { $write=cmsg ("KEY_EXECUTE"); }
if ($cmd=="join") { $write=cmsg ("KEY_LINKING"); }
if (($masstbl)AND($write==cmsg ("KEY_MASS_OPER"))) { $tbl=$masstbl;  }

  if ($commode!==false) { $commode=1;}
  if ($codekey==5) { needupgrade ();exit;};
//if (!$pr[8]) { echo "write=$write  vd=$vd  go=$go <br>";}

//RIGHTSLIMITATION
 if ($ADM==0) { msgexiterror ("notright","","disable");exit ;}
If ($prauth[$ADM][3]==false) { msgexiterror ("notright","","disable");exit;}
//END OF RIGHTS LIMITATION
lprint ("WF_WELCOM");

 if ($nokeys==1) nokeys (1);
 if ($daysleft<1) expire (); 
//PART OF ID tbl
if ($pr[37]) {// analog in getfile
?><br><form action="w.php" method="post">
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
	groupdbprint ($grouplist,"Group",$prdbdata,$tbl,$groupdb);

        $grouplist2=groupdbfielddetect ($prdbdata,6);// set IP as field
        $groupdbthisname="ipfilter";// in future - add this variable to f
        groupdbprint ($grouplist2,"IP",$prdbdata,$tbl,$ipfilter);// IP CFG OPT FUTURE groupdbfielddetect
	submitkey ("write","SELECT");
	if ($prauth[$ADM][2]) submitkey ("live","LIVEMOD");echo "*";
 	if ($live) echo "in future release!";  // 		hidekey ("live",$live);  STATEMENT LOST
 		echo"</form>";
}


?>
<form action="w.php" method=post><?
hidekey ("vID",$vID);
hidekey ("vID2",$vID2);//...hidekey ("colfind",$colfind);
hidekey ("groupdb",$groupdb);//added

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

if (($prauth[$ADM][24]==false)OR(!$tbl)) { printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbl",lprint ("SELLINK"),$groupdb,$ipfilter,6);
submitkey ("write","A_USRGO" ); //найден код требуемой базы
}
  //if (isset ($colfind)) { $colfind= $md2column;} для чего ее нигде нету?
?>
</form>

<?


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
$usemysql=$prdbdata[$tbl][12];		$writeright=$prdbdata[$tbl][13];
$needrights=$prdbdata[$tbl][14];		$virtualid=$prdbdata[$tbl][15];
$reserved16=$prdbdata[$tbl][16];	    $res16=$reserved16;$reserved17=$prdbdata[$tbl][17];

$floodlimit=$sd[12];


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

if ($tbl) if (($prdbdata[$tbl][12]!=="mysql")AND($prdbdata[$tbl][12]!=="fdb")) msgexiterror ("SCP","Alias=$tbl,as =".$prdbdata[$tbl][12],"admin.php");
if ($cfgmod==2) msgexiterror ("nologsedit",$namebas,"w.php");

?>
<form action="w.php" method=post>
Искать <textarea name=vID cols= 30 rows=1 ><?=$vID; ?></textarea>
<? if (($virtualid==true)OR($virtualid=="0")) {
	?>ID2 <textarea name=vID2 cols= 8 rows=1 ><?=$vID2; ?></textarea>
		<? ;};

#################################################################
// Поправки на текущие настройки
################################################################3/
//вывод текущей ячейки


if ($pr[9]==1) checkbox ($commode,"commode"); lprint ("WF_NOSCR");
if (($cfgmod<1)AND($prauth[$ADM][18]))	 {checkbox ($prauth[$ADM][18],"noaddmode");lprint ("WF_ALLFLD");echo "<br>";}

if (($cfgmod<1)AND($prauth[$ADM][2])) {
	echo "<a href='w.php?cmd=ed&fil=dbdata;".$prdbdata[$tbl][0]."'><img src='_ico/linked_table-no.png' border=0 title='".cmsg ("PROP_EDIT")."'></a>";
}



if ($namebas==false) {echo "<br><font color=red id=errfnt>";lprint ("WF_NOLNK");echo "</font><br>";$menudisable=1;} else {echo "<br>";lprint ("CONNLINK:");echo "<font color=green id=xfnt> $namebas ($tbl) [$tablemysqlselect'$tblmysqlselect server $hostmysqlselect]<br></font>";}
print "<input type=hidden name=tbl value=$tbl>";
	hidekey ("live",$live); 
if ($menudisable==0) {

submitkey ("write","KEY_EDIT"); 
submitkey ("write","KEY_ADD"); 
submitkey ("write","KEY_DEL"); 
 if (($prauth[$ADM][23]==true)or($cfgmod==1)) submitkey ("write","KEY_VIEW");	
submitkey ("write","KEY_COMM");
 
if ($prauth[$ADM][6]) { submitkey ("write","KEY_HEAD");}; //CFG OPT FUTURE!
if ($prauth[$ADM][10]) { submitkey ("write","KEY_AN"); }; 
if ($prauth[$ADM][35]) { submitkey ("write","KEY_MASEXC"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][35])AND(!$cfgmod)) { submitkey ("write","KEY_MASCPY"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][35])AND(!$cfgmod)and($prdbdata[$tbl][12]=="mysql")) { submitkey ("write","KEY_SHOWCODE"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][34])and($prdbdata[$tbl][12]=="mysql")) { submitkey ("write","KEY_EXECUTE"); };  //CFG OPT FUTURE!
if (($prauth[$ADM][43])and($prdbdata[$tbl][12]=="mysql")) { submitkey ("write","BACKUPS"); };  //CFG OPT FUTURE!


}
echo "<br>";


if (($errorredirectdb)) { //dblinker enter
	echo "<br><font color=red id=errfnt>".cmsg (REQ_LINK)." $tab ".cmsg (AND_DB)." $dblk".cmsg (M_SEL_DB)." $dblk<br></font>";
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
				 for ($a=0;$dbc=xfgetcsv ($f,512,"¦");$a++) {
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
for ($a=0;$dbc=xfgetcsv ($f,1024,"¦");$a++) {
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
for ($a=0;$dbc=xfgetcsv ($f,1024,"¦");$a++) {
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
	//SQL$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
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
//SQL	$result = mysql_query ($query, $connect);
	// END TEST
for ($aaa=0;$aaa<count ($mode6);$aaa++)	{ $fndcolumn=$mznumb[$aaa];
//echo "mz $mzdata[0]  fnd $fndcolumn<br>";
 $findrecords=0;$prntbuf=cmsg ("RF_RESSRCH")." ".$namebas." - ".cmsg ("BYCOL").$mzdata[$fndcolumn]." -- ".$vID.":\n\n";
  $vIDold=$vID; $vID=strtolower ($vID); 
	$data=readdescripters ();	$f=$data[4];
 for ($a=0;$dbc=xfgetcsv ($f,1024,"¦");$a++) {
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
	while ($myrow=xfgetcsv ($f,1024,"¦")) {	$countquery=$myrow[$md2column];
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
	while ($dbc=xfgetcsv ($ulog,16384,"¦")){
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
	while ($dbc=xfgetcsv ($ulog,16384,"¦")){
		@$chto=strpos ($dbc[4],$u3);//AND($chto==true) - ne pashet
		if (($dbc[0]==$u0)AND($dbc[1]==$u1)){  //
			//echo "dbc3=chto=$chto--cmd=".$dbc[3]."---undocmd=".$dbc[4]."<br>";;
			$query=$dbc[4];break;	
			}
	}
           $query=str_replace ("<cr_lf>","\n",$query);//enabling change \n to <cr_lf>  reroll
           $query=str_replace ("<R>","\r",$query);//enabling change \n to <cr_lf>  reroll
	echo "==>$query<br>";
	$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	echo "Select db: ".$prdbdata[$tbl][9]."<br>";
	mysql_select_db ($prdbdata[$tbl][9], $connect);
	executesql ($query,$connect,1);
	$a=sqlerr ();
	if ($a) { lprint (NO_DB_QUE) ;}
	$action="KEY_S_UNDO db:".$prdbdata[$tbl][9]." tab".$prdbdata[$tbl][6]." cannot request data ";logwrite ($action);
}








//модуль запуска 
if (($write==cmsg ("KEY_EDIT"))AND($prdbdata[$tbl][12]=="fdb")) {
	if ($vID==="") { echo cmsg ("WF_FSELID")."<br>"; exit;};

	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");
//	echo "dEBUG vID2=$vID2 virtualid=$virtualid<br>";
	echo "<br>";
			$data=readdescripters ();  if ($data==-1) exit; 
			
	$mycol=xfgetcsv ($f,1024,"¦");// $z to mycol  other $z is dupl and changed to myrow   
	if ($cfgmod==1) $mycol=$data[0];
		if ($vID2==="") { while ($myrow[$md2column]!==$vID) {
									$myrow=xfgetcsv ($f,1024,"¦");
										if ($myrow===false) { break;};	
										};
									};
		if ($vID2!=="") { 
			for ($a=0;$myrow=xfgetcsv ($f,1024,"¦");$a++) { 
				if ($vID!=="") $findid=strpos ($myrow[$md2column],$vID);
					if ($vID2!=="") $findid2=strpos ($myrow[$virtualid],$vID2);//mod-add for corr if
							if (($myrow[$md2column]===$vID)AND($myrow[$virtualid]===$vID2)) break;
									//$myrow=xfgetcsv ($f,1024,";");
							};
									};
		@$crc=implode ("¦",$myrow);//added crc32 count
		//проверка не занят ли ID
	if ($myrow===false) { 
		echo cmsg ("QUE_EMP")."<br>";
		exit;
	}
//end проверка не занят ли ID
//!!!!!
$oldcoreedit=$prauth[$ADM][39];
if ($oldcoreedit)
		for ($a=0;$a<count ($mycol);$a++)
			{
			echo "$mycol[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii>(ID1)</ii>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=40 rows=1><?=$myrow[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<count ($mycol);$a++)
			{ //hdr text	//

				if ($prauth[$ADM][41])echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycol[$a] ";
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
	$mycol=xfgetcsv ($f,1024,"¦");
	$a=0;$cnt=count ($mycol);
			for ($a=0;$a<$cnt;$a++)
			{
	$myrow[$a]=${"z".$a};//принимаем данные юзера
    //$x=getidbyid ($prauth,0,"realid",$myrow[0]);// это имя редактируемого пользователя
    $x=getidbyid ($prauth,0,"realid",$myrow[0]);
 //echo "realid=$x prauth x 0 ".$prauth[$x][0]." prauth adm 0 ".$prauth[$ADM][0]."<br>";exit;
//  echo "x2= $x2  x42=$x42";exit;
  if (!$prauth[$ADM][42])  if (($cfgmod==1)and($filbas=="gmdata.cfg")) { $myrow[2]=$prauth[$x][2];$myrow[42]=$prauth[$x][42] ;};
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
csvmod ($f,"edit",$values,$origid1,$origid2);
lprint ("WF_QUECOMP");
if ($pr[12]) {$act="EDIT_DAT  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;};  // логируемся
submitkey ("write","WF_UNDO_LAST");
}



//модуль запуска
if (($write==cmsg ("KEY_ADD"))AND($prdbdata[$tbl][12]=="fdb")) {
	if (!$cfgmod) @$f=csvopen ("_data/".$filbas,"r","0");
	if ($cfgmod==1) @$f=csvopen ("_conf/".$filbas,"r","0");echo "<br>";
	$data=readdescripters ();  if ($data==-1) exit; 
		//подсчета пустой ячейки
		while ($myrow=xfgetcsv ($f,1024,"¦")) {	$countquery=$myrow[$md2column];
					settype ($countquery, integer);
						if ($countquery>$maximalcntmd2) $maximalcntmd2=$countquery;
									$maxquery++;}
		echo cmsg ("WF_1NOTUSED").":".($maximalcntmd2+1)."<br>";
		rewind ($f);		//	erase&rewind :) перемотать $F!!!
		//конец завершения подсчета пустой ячейки
	$mycol=xfgetcsv ($f,1024,"¦");$cnt=count ($mycol);
		if ($vID2==="") { while ($myrow[$md2column]!==$vID) {
									$myrow=xfgetcsv ($f,1024,"¦");
											if ($myrow===false) { break;};						
									};
									};
		if ($vID2!=="") { 
			for ($a=0;$myrow=xfgetcsv ($f,1024,"¦");$a++) {
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
			echo "$mycol[$a]";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii>(ID1)</ii>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=30 rows=1><?=$myrow[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=0% bordercolor=#602621>"; // непонятное изменение . 100% было заменено на 0 .цель неясна.
			for ($a=0;$a<count ($mycol);$a++)
			{ //hdr text	//	
				if ($prauth[$ADM][41])echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycol[$a] ";
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
	$mycol=xfgetcsv ($f,1024,"¦");
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
	if ($pr[12]) {$act="ADD_DAT  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;};  // логируемся
        submitkey ("write","WF_UNDO_LAST");
}



//модуль запуска 
if (($write==cmsg ("KEY_DEL"))AND($prdbdata[$tbl][12]=="fdb")) {
		if (($virtualid==true)AND($vID2==false)) echo "<font color=red id=errfnt>".cmsg 
		("WF_DEL_GROUP")." ".$vID." </font><br>";
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
if ($pr[12]) {$act="DEL_DAT  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;	};  // логируемся
submitkey ("write","WF_UNDO_LAST");
}


//модуль запуска  массовая замена текстовый режим
if (($write==cmsg ("KEY_MASEXC"))AND($prdbdata[$tbl][12]=="fdb")) {
	$nofilestreamallowed=1;// для readdesdcripters если есть чтобы убивал свой линк
		echo cmsg ("WF_SELFLD").":";// Вставлено для выбора поля
	global $presettedmode,$res16,$mznumb;
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
 if ($prauth[$ADM][5]==1) { checkbox ($delete,"delete");echo "<font color=red id=errfnt>".cmsg ("WF_UPDTODEL")."</font><br>"; }; ?>
  <input type="radio" name="strupdmode" value="allstrokes"> <? lprint ("WF_EXCALL") ; ?><br>
  <input type="radio" name="strupdmode"  value="substrokes"> <? lprint ("WF_EXCSUB") ; ?> <br>
  <input type="radio" name="strupdmode"  value="subindstrokes"> <? lprint ("WF_EXCSUBIND") ; ?><textarea name=subindex cols= 5 rows=1 ><?=$subindex; ?></textarea>,<? lprint ("WF_EXCSPLT") ; ?> ,<textarea name=subsplitter cols= 4 rows=1 ><?=$subsplitter; ?></textarea><br>
 <?   // start compare addif
 echo "<input type=checkbox name=addifenable1>";
	echo "<font color=gray id=dfnt>**".cmsg ("WF_IF")."1 </font>:"; printfield ($data,"naddif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?
	echo "<input type=checkbox name=addifenable2>";
	echo "<font color=gray id=dfnt>**".cmsg ("WF_IF")."2 </font>:"; printfield ($data,"naddif2"); 
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
	if (!$strupdmode) { echo "<font color=red id=errfnt><bb>".cmsg ("INP_ERR")."</bb><br></font>Не указан режим работы!";exit;};
	if (strlen ($exchid)==0) { echo "<font color=red id=errfnt><bb>".cmsg ("INP_ERR")."</bb><br></font>Не указана цель замены!";exit;};
	if (!$wfemptyenab) if (($strupdmode=="substrokes") AND (strlen ($sourceid)==0)) { echo "<font color=red id=errfnt><bb>Ограничение</bb><br></font>".cmsg ("WF_ER_NOSUB"); exit;} ;
	if ($strupdmode==="subindstrokes") { 
		if (!$subindex) { echo "<font color=red id=errfnt><bb>Ошибка</bb><br></font>".cmsg ("WF_ER_NOIND").".<br>" ;exit ; };
		if (!$subsplitter) { echo "<font color=red id=errfnt><bb>Ошибка</bb><br></font>".cmsg ("WF_ER_SPLIT").".<br>" ; 
		} ; exit; };
	if (($prauth[$ADM][4]===false)AND($strupdmode!=="substrokes") AND (strlen ($sourceid)==0)) { echo "<font color=red id=errfnt><bb>Ограничение</bb><br></font>Нельзя заменять любое значение на нужное вам из принципов безопасности." ; exit;} ;// all_> sub
	//окончание обработки ошибок    	//	начало csv части обновителя  ===!!!!======
	@$f=csvopen ($filename,"r","0");//открываем базу
	echo "<br>";
	$hdr=xfgetcsv ($f,1024,"¦"); // пропускаем заголовки,т.к. их перемотала программа чтения
	$mycol=$hdr;
	$plvl=xfgetcsv ($f,1024,"¦");
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
	$dest=csvopen ($filename.".exch","w",1);
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
		for ($a=0;$a<5;$a++)	{ echo "";			}//без разницы  даже если тыщу раз повторит все равно ни.... не удаляет.
		
		//@$del=unlink ($filename);  //как меня затрахало это permission denied ERROR!BUG!  ВАШУ МАТЬ БЛИН!
		$realp=realpath ($filename);
		//$del=unlink ($realp);  //как меня затрахало это permission denied ERROR!BUG! ПОТРАЧЕНО НА ЭТО НЕСКОЛЬКО НЕДЕЛЬ !!!
		//echo "try realpath $filename is =$realp; ";
		csvopen ($filename,"delete",0);		 // ШОБ ТВОЮ МАТЬ INITSE блокировал!!!!
		csvopen ($filename.".exch","rename",$filename);	
		//echo "csvopen ($filename.exch,rename,$filename);	";
		//$f=csvopen ("_conf/dbdata.cfg.exch","rename","_conf/dbdata.cfg");	
		if ($del==true) break;
		
	
	if ($pr[12]) {$act="MASS_EXCH_DAT  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;};  // логируемся
}


//модуль запуска и обработки
if (($write==cmsg("KEY_MASCPY"))AND($prdbdata[$tbl][12]=="fdb")) {
	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();
	if ($cfgmod==1) { lprint ("CFG_LIM"); exit;};
	  needupdate ();
	lprint ("WF_MASCPYMSG");// Вставлено для выбора поля
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
//     echo $mznumb[3].$mycols; echo $res16; echo $a; копия модуля из начала writefile
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"destination",cmsg ("WF_MAS_DEST"),$groupdb);
	//конец выбора колонки из текущей базы

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
<?	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 wrap=virtual><?=$addiflist2; ?></textarea><br>
	<? submitkey ("write","KEY_S_COPY");
}

// пока процедура обработки не готова


//модуль запуска и обработки
if (($write==cmsg("KEY_SHOWCODE"))AND($prdbdata[$tbl][12]=="fdb")) {
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();
	 if ($cfgmod==1) { lprint ("CFG_LIM");exit;};
	 needupdate ();
	//if ($pr[12]) {$act="COMPARE_DAT  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;};  // логируе
		echo cmsg ("WF_MASCPYMSG").cmsg ("WF_MASCMPMSG")."<br>";// Вставлено для выбора поля
	global $presettedmode,$res16,$mznumb;//	$mode=6; $mode7=1;//$presettedmode=1.1; bylo 1.1
	$data=readdescripters ();$a=prefixdecode ($res16);
		if ($data==-1) exit;
   decodecols ($res16);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"source",cmsg ("WF_MAS_SRC"),$groupdb);
printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"dest",cmsg ("WF_MAS_DEST"),$groupdb);
//конец выбора колонки из текущей базы
echo "<br>";
   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";
   //checkbox ($keys,"keys"); echo cmsg ("WF_MASCMP_KEY")."<br>";   содержимое пока не будем сравнивать
?><input type="radio" name="cmpmode" value="1to2"><? lprint ("WF_CMP_12") ; ?><br>
  <input type="radio" name="cmpmode"  value="2to1"> <? lprint ("WF_CMP_21") ; ?><br>
  <input type="radio" name="cmpmode"  value="1only" checked><? lprint ("WF_CMP_QRY") ; ?><br>
  <? 	// start compare addif
checkbox ($cmpifchg,"cmpifchg") ; echo "<font color=gray id=dfnt>".cmsg ("WF_CMPIFCGH")."<br></font>"; 
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 wrap=virtual><?=$addiflist1; ?></textarea><br>
		<?
	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 wrap=virtual><?=$addiflist2; ?></textarea><br>
	<?  submitkey ("write","KEY_S_SHOWCODE");
	// end compare addif   Вставлено для выбора поля
}


// пока процедура обработки не готова




//модуль запуска 
//сделать возможно одновременную или раздельную правки?
//SQL HEADER
if (($write==cmsg("KEY_HEAD"))AND ($prdbdata[$tbl][12]=="mysql")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	 	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
 if ($data==-1) exit; 
	 echo "<br>".cmsg ("WF_HDSEL")."<br>";
	 //echo "*"; submitkey ("write","WF_HDRSQL_REAL"); REMOVED  NOT USED
 	 submitkey ("write","WF_HDRSQL_VIRT");
 	 submitkey ("write","WF_STRC_SQL"); 	 
 	 submitkey ("write","WF_STRC_DAT");echo "<br><br>";
 	 submitkey ("write","CFG_COPY");submitkey ("write","WF_NEW_TAB");
 	  
}


//модуль запуска 
//сделать возможно одновременную или раздельную правки?
if (($write==cmsg("BACKUPS"))AND ($prdbdata[$tbl][12]=="mysql")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	 infrestsql($connect,$prdbdata,$tbl);

	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
 if ($data==-1) exit; 
 lprint(WF_AR_TAB);echo "<br>";
	  submitkey ("write","WF_ARCH");
	 submitkey ("write","WF_UNARCH");echo "<br>";
	 echo "<br>"	 	  ;lprint (WF_AR_OTH);echo "<br>";
	 checkbox ($addname,"addname");lprint ("ADD_NAME");
	 checkbox ($adddata,"adddata");lprint ("ADD_DATA");
	 checkbox ($addtxt,"addtxt");lprint ("WRIT_NM");inputtxt("txtfordb",10);
	 
	 echo "<br>IP:";inputtxt("remoteip",10); submitkey ("write","WF_BCK_TRANS");echo "**";
	 echo "<br>";
	 submitkey ("write","WF_BCK_ARCH");
	 submitkey ("write","WF_BCK_UNARCH");echo "";
	 echo "<br><br>";
	  	  submitkey ("write","WF_BCK_FILEDUMP_ARCH");
	 submitkey ("write","WF_BCK_FILEDUMP_UNARCH");echo "<br>";  //RESTORE FROM DUMP!!!
	 echo "<br><br>";
	  	  //submitkey ("write","WF_BCK_COPYTBL_ARCH");
	 //submitkey ("write","WF_BCK_COPYTBL_UNARCH");echo "** UNRELEASED<br>";
	 	 echo "<input type=hidden name=colfind value=1>";
}




// RESTORING FROM SAVED DATABASE IN OTHER DATABASE&&**
if (($write==cmsg("WF_BCK_UNARCH"))AND ($prdbdata[$tbl][12]=="mysql")) {
@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
lprint (W_BCK_UNARCH_TIP);
$separator="¦";lprint ("GEN_DB_SEL");
$cmd="SHOW DATABASES";
$a=mysql_query ($cmd,$connect);
if ($a==false) echo "connection die";
echo "<br>Source:<select name=source>";
while ($result=mysql_fetch_row ($a)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
	if (strpos ($result[0],"backup")!==FALSE) echo "<option>".$result[0]."";
}
echo "</select>";
echo"<br>Target:";$a=mysql_query ($cmd,$connect);
if ($a==false) echo "connection die";
echo "<select name=dest>";
while ($result=mysql_fetch_row ($a)) {
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
$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
if ($newdb) $dest=$newdb;
	copydatabase ($source,$dest,$connect);
	$action="WF_BCK_UNARCH ".$source.".".$dest.".".$connect." ";logwrite ($action);		
}



// Запускной модуль создания бэкапа
if (($write==cmsg("WF_BCK_ARCH"))AND ($prdbdata[$tbl][12]=="mysql")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
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
if (($start)AND($backupdbname)AND ($prdbdata[$tbl][12]=="mysql")) {echo "Создается -живой- бэкап $backupdbname...<br>";
set_time_limit(0);// CFG OPT FUTURE?
@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	copydatabase ($prdbdata[$tbl][9],$backupdbname,$connect);
 $action="DB_COPY ".$prdbdata[$tbl][9].".".$backupdbname.".".$connect." ";logwrite ($action);		
}

//copy full tables   копирование полный таблиц
//#########################################################################
/// /CREATING DUMP AND EXECUTING AT REMOTE SERVER   NA - NOT USED TMP
if (($write==cmsg("WF_BCK_TRANS"))AND ($prdbdata[$tbl][12]=="mysql")) {
	@$connect2 = mysql_connect ($mysqlserver2, $sd[14] , $sd[17]);	
	 set_time_limit(0);// CFG OPT FUTURE?
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
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
if (($start==cmsg ("SQL_REM_START"))AND($dumpdbname)AND ($prdbdata[$tbl][12]=="mysql")AND(!$pr[20])) {
	@$connect2 = mysql_connect ($mysqlserver2, $sd[14] , $sd[17]);	
	echo cmsg (W_CRT_DMP)." $backupdbname...<br>";
	echo "Режим: Dbscript side, data";
	if ($structure) echo "+structure";
	echo "<br>";
@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	$query="CREATE DATABASE IF NOT EXISTS `$backupdbname`;";
	$silent=0;mysql_query ($query);
	//generate table list
	echo "connecting..".$prdbdata[$tbl][9]."<br>";
	mysql_selectdb ($prdbdata[$tbl][9],$connect);
$cmd="SHOW TABLES";
$a=mysql_query ($cmd,$connect);

while ($result=mysql_fetch_row ($a)) {
	$tablelist[]=$result[0];$tables++;//echo "table added to list ::".$result[0]."<br>";
	}
	@$a=opendir ("_local/dump"); if ($a==false) mkdir ("_local/dump");@closedir ($a);
	$dumpfile=fopen ("_local/dump/".$dumpdbname,"w"); if ($dumpfile==false) die ("cannot open file $dumpdbname");
	$x="#::Dbscript $verchar ::  Mysql dump \n\r";
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
		$result=mysql_query ($query); sqlerr();
	for ($c=0;$myrow = @mysql_fetch_row($result);$c++) {
    	$insertone=$myrow[1].";";
    	//if ($views) echo $insertone;
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
		fwrite ($dumpfile,$insertone);
		$strclines++;		//echo $insertone."<br>";
	};	
				
	}
	
	//if ($debugmode)	echo "DEBUG $query.<br>";
	$query="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;";
	$result=mysql_query ($query); sqlerr();
// печать   формирование текста запроса
	for ($c=0;$myrow = @mysql_fetch_row($result);$c++) {
    	$mycols=count ($myrow);
		$insertone=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols);
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
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
if (($write==cmsg("WF_BCK_FILEDUMP_ARCH"))AND ($prdbdata[$tbl][12]=="mysql")) {
	 set_time_limit(0);// CFG OPT FUTURE?
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
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

if (!$pr[20]) submitkey ("start","SELF_BCK");
}


//восстановить копии таблиц SQL
if (($write==cmsg("WF_BCK_COPYTBL_UNARCH"))AND ($prdbdata[$tbl][12]=="mysql")) {
	echo "WF_BCK_COPYTBL_UNARCH<br>";
}


//MENU SQL SIDE ;Сделать копии таблиц SQL
if (($write==cmsg("WF_BCK_COPYTBL_ARCH"))AND ($prdbdata[$tbl][12]=="mysql")) {
	 set_time_limit(0);// CFG OPT FUTURE?
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	 	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
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
if (($start==cmsg ("SQL_BCK"))AND($dumpdbname)AND ($prdbdata[$tbl][12]=="mysql")) {
	set_time_limit(0);// CFG OPT FUTURE?
	echo cmsg (W_CRT_DMP)." $dumpdbname...<br>";
	echo "Режим: SQL side<br>";
@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	//generate table list
	echo "connecting..".$prdbdata[$tbl][9]."<br>";
	$file=$pr[39];
	echo "Make folder: $file$dumpdbname<br>";
	@mkdir ($file.$dumpdbname)	;
	//opendir ($file.$dumpdbname)	;
		 if ($file==false) die ("File to backup set to NULL!<bR>");
	//echo "File:$file<br>";
	mysql_selectdb ($prdbdata[$tbl][9],$connect);
	
	$cmd="SHOW TABLES";// может выделить просмотр баз данных и таблиц в отдельные процедуры и их везде сделать стартовыми?
$a=mysql_query ($cmd,$connect);	
while ($result=mysql_fetch_row ($a)) {
	$tablelist[]=$result[0];$cnt++;//echo "table added to list ::".$result[0]."<br>";
	}
	
for ($a=0;$a<count ($tablelist);$a++) {
 $query="BACKUP TABLE `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."` TO  '".$file.$dumpdbname."';";
	$e=mysql_query ($query);
	echo "DEBUG $query.<br>";//if (!$pr[8])	
	sqlerr();
	while ($res=mysql_fetch_row ($e)) {
	echo $res[1]."::".$res[2]."::".$res[3]."<br>";	//echo "table added to list ::".$result[0]."<br>";
	}
	
 if (!$pr[8])	echo "DEBUG $query.<br>";
 $action="SqL_BCK $dumpdbname--> -q $query -t $tablelist -e $err -s $skipped ";logwrite ($action);		
}
	//sqlerr();
}	

//CREATING DUMP AT DBSCRIPT SIDE AS ONE SQL FILE
if (($start==cmsg ("SELF_BCK"))AND($dumpdbname)AND ($prdbdata[$tbl][12]=="mysql")AND(!$pr[20])) {
	echo cmsg (W_CRT_DMP)." $backupdbname...<br>";
	echo "Режим: Dbscript side, data";
	if ($structure) echo "+structure";
	echo "<br>";
@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	$query="CREATE DATABASE IF NOT EXISTS `$backupdbname`;";
	$silent=0;mysql_query ($query);
	//generate table list
	echo "connecting..".$prdbdata[$tbl][9]."<br>";
	mysql_selectdb ($prdbdata[$tbl][9],$connect);
$cmd="SHOW TABLES";
$a=mysql_query ($cmd,$connect);

while ($result=mysql_fetch_row ($a)) {
	$tablelist[]=$result[0];$tables++;//echo "table added to list ::".$result[0]."<br>";
	}
	@$a=opendir ("_local/dump"); if ($a==false) mkdir ("_local/dump");@closedir ($a);
	$dumpfile=fopen ("_local/dump/".$dumpdbname,"w"); if ($dumpfile==false) die ("cannot open file $dumpdbname");
	$x="#::Dbscript $verchar :: http://dj.chg.su/dbscript/  Mysql Dump File \n\r";
	fwrite ($dumpfile,$x);
for ($a=0;$a<count ($tablelist);$a++) {
	
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
		$result=mysql_query ($query); sqlerr();
	for ($c=0;$myrow = @mysql_fetch_row($result);$c++) {
    	$insertone=$myrow[1].";";
    	//if ($views) echo $insertone;
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
		fwrite ($dumpfile,$insertone);
		$strclines++;		//echo $insertone."<br>";
	};	
				
	}
	
	//if ($debugmode)	echo "DEBUG $query.<br>";
	$query="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`;";
	$result=mysql_query ($query); sqlerr();
// печать   формирование текста запроса
	for ($c=0;$myrow = @mysql_fetch_row($result);$c++) {
    	$mycols=count ($myrow);
		$insertone=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$tablelist[$a]."`",$myrow,$mycols);
		//что генерируется при ' внутри и как оно потом выполняется
 		if ($OSTYPE=="LINUX") $insertone.="\n";
		if ($OSTYPE=="WINDOWS") $insertone.="\n\r";
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
$action="SELF_BCK_DBS_SIDE $dumpdbname-->$backupdbname -l $lines -t tables -e $err -s $skipped force $dbselected";logwrite ($action);		
}
	


//SQL EXECUTE сюда заливает файл с именем юзера в + и сам вызывает выполнение WF_BCK_FILEDUMP_UNARCH

//Restore from file dump at dbscript folder
//восстановить из дампа в папке dbscript
if (($write==cmsg("WF_BCK_FILEDUMP_UNARCH"))AND ($prdbdata[$tbl][12]=="mysql")) {
@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
if ($connect==false) {sqlerr($connect);exit;}
if ($dblk) hidekey ("dblk",$dblk);
	checkbox ($forcedb,"forcedb");lprint ("FORCE_DB");echo ":";
$cmd="SHOW DATABASES";
$a=mysql_query ($cmd,$connect);
if ($a==false) {sqlerr($a);exit;}
//.. здесь где то проверку пути надо улучшить если коннект не дали - дать другой
// echo "<form action=dblinker.php method=post>"; needed for?   unknown
echo "<select name=dbselected>";
while ($result=mysql_fetch_row ($a)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
	echo "<option>".$result[0]."";
}
echo "</select><br>";
	
	$path=getcwd ()."/_local/dump/";
	echo cmsg (PATH_DUMP_DBS)."$path<br>";
	echo cmsg (SEL_FILE)."<br>";
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
echo "</select>";
checkbox ($views,"views") ; echo cmsg (WF_LOG).cmsg (NORECOMM)."<br>"; 
//checkbox ($disviews,"disviews") ; echo cmsg (WF_LOG).cmsg (NORECOMM)."<br>"; 
 submitkey ("start","DALEE");
echo "</form>";
}
// для одинаковых надписей мож доб пот. перем. step  1.1 1.2 1.3 :)))
// процедура восстановления базы данных из дампа.
if (($dump)AND($start==cmsg(DALEE))) {
if (($dblk)AND(!$forcedb)) {$forcedb=1;$dbselected=$dblk;	}
	$path=getcwd ()."/_local/dump/";
      	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
          sqlerr ($connect);
               	$dumpfile=$dump[0];
	$f=fopen ($path.$dumpfile,"rb");
	if ($views) print_r ($dump);
	echo "file=$path $dumpfile"; 
	$query="";
	while ($a=fgets ($f)) {// пока читается
	if ($a[0]==="#") continue;	if ($a[1]==="#") continue;// skip comment lines
	$najti=strpos ($a,";");
	$najti2=strpos ($a,"SELECT DATABASE");
	$najti3=strpos ($a,"create database if not exists");
	if ($najti2!==false) {
						//dump are normal?  check ' inside dump text  
						$b=str_replace ("SELECT DATABASE ","CREATE DATABASE ",$a);//3.5.25 ver only 
						$a=str_replace ("SELECT DATABASE ","USE ",$a);
						mysql_query ($b,$connect);
						echo "<br>".cmsg (W_NDB_FORC2)."($a)<br>";
						}
	if ($najti3!==false) {mysql_query ($a,$connect);
						$a=str_replace ("create database if not exists","USE ",$a);
						echo "<br>".cmsg (W_NDB_FORC)."($a)<br>";
							}
	if ($forcedb) {
			$cmd="USE $dbselected;";
			$res=mysql_query ($cmd,$connect); 
                        sqlerr ($res); // а если базу нигде не задали , что с ней делать?  пришить первую попавшуюся.
			//if ($a) echo "forced select $cmd<br>"; оно вызывало баг 1111111
				}
	if ($najti===false)	{$query.=$a;continue;}
	if ($najti!==false)	{$query.=$a;}
	if ($views) echo "<br>EXECUTING:".$query."<br>";
        
	$result=mysql_query ($query,$connect);
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
if (($write==cmsg ("CFG_COPY"))AND ($prdbdata[$tbl][12]=="mysql")) { 
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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
if (($write==cmsg ("WF_HDRSQL_REAL"))AND ($prdbdata[$tbl][12]=="mysql")) { 
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	readdescripters (); if ($data==-1) exit;  
}

//модуль обработки
	if ($write==cmsg ("WF_HDRSQL_REWR")) { //++ ЭТО - НЕ ПЕРЕПИСАТЬ СТРУКТУРУ, СМ НИЖЕ
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	echo "if (($field==$fieldexch)AND ($action==exch)";
		$data=readdescripters (); if ($data==-1) exit; 
	}

//модуль запуска
	if (($write==cmsg  ("WF_STRC_SQL"))AND ($prdbdata[$tbl][12]=="mysql")) { 
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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
	if (($write==cmsg  ("WF_NEW_TAB"))AND ($prdbdata[$tbl][12]=="mysql")) { 
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters (); if ($data==-1) exit; 
			echo cmsg ("WF_NEW_TAB_INFO").":";	echo "<br>";
			lprint (WF_NEW_NAME);inputtxt("newtable",25);
	 submitkey ("write","WF_ADD_TAB_SQL");	
	}
//модуль обработки
	if ($write==cmsg("WF_ADD_TAB_SQL")) { //++
			if ($codekey==7) demo ();
		if ($codekey==4) needupgrade ();
		if (($newtable=="")) { lprint ("WF_ROW_NODATA"); exit ;};
@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
		$exec="CREATE TABLE `".$newtable."` (
  `id` bigint(20) unsigned NOT NULL auto_increment COMMENT 'Identifier' ,
    PRIMARY KEY  (`id`) ); ";

  if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	$a=mysql_query($exec,$connect); 
	echo "executing: $exec ; Status=$a";
	if ($pr[12]) {$act="WF_NEW_TAB (".$prdbdata[$tbl][9]."'".$newtable.") state $a "; logwrite ($act) ;};

	}







	
	

//модуль запуска 

	if (($write==cmsg ("WF_STRC_DAT"))AND ($prdbdata[$tbl][12]=="mysql")OR($write==cmsg ("WF_MODSTRC_DAT"))AND ($prdbdata[$tbl][12]=="fdb")) { 
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
if (($write==cmsg ("WF_HDRSQL_VIRT"))AND ($prdbdata[$tbl][12]=="mysql")) { //++
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN");exit;};
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters (); if ($data==-1) exit; 
	$mycol=$data[0];
	@$f=csvopen ("_data/".$filbas,"r","0");$new=0;
		if ($f==true) { $z=xfgetcsv ($f,2024,"¦");$plevel=xfgetcsv ($f,2024,"¦"); };
		$a=0;$cnt=count ($mycol);
	for ($a=0;$a<$cnt;$a++)
			{
			echo "$a $z[$a] (<font color=blue id=bfnt>$mycol[$a]</font>) ";
			?><textarea name=z<?=$a; ?> cols=30 rows=1><?=$z[$a]?></textarea>
				<textarea name=p<?=$a; ?> cols=12 rows=1><?=$plevel[$a]?></textarea>
	<!--			<input type=submit name=executeaddfield value=<?=$a?>>+-->
				<? 				;// 
				$fil=$tbl.";".$z[$a].";".$a.";".$b."";//tabbydb,columnname,columnnomer,0
				$pl=$plevel[$a];$pl=str_replace ("#",";",$pl);
		 echo "CONNECT<a href='w.php?cmd=join&fil=$fil&pl=".$pl."'><img src='_ico/linked_table-no.png' border=0 title='".cmsg ("KEY_LINKING")."'></a></color>";
				echo "<br>";
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
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters (); if ($data==-1) exit; 
	$mycol=$data[0];
//join cmd   fil=$fil  plevel=$plevel
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
//.getidbyid($db,$idsrchcolumn,$idrescolumn,$stringкот ищут) 	 выбор таблицы, для 2 пунктов, потом выбор метода и колонки и имени соединения.
	//exit;
	//resending
	hidekey ("activetableid",$tbl);
	hidekey ("plevel",$plevel);
	hidekey ("columnname",$columnname);
	hidekey ("columnnomer",$columnnomer);
	hidekey ("id1",$id1);
	hidekey ("id5",$id5);
	if ($pr[37]) submitkey ("write","TARGET");
	if (!$pr[37]) submitkey ("write","TARGET2");
}
	
// модуль перехода linkning

if (($write==cmsg("TARGET"))) {
		groupdbprint ($list,"Group",$prdbdata,$tbl,$groupdb);; //код TBL передается самостоятельно, если группы не используются - этот блок пропускать
	hidekey ("activetableid",$activetableid);
	hidekey ("plevel",$plevel);
	hidekey ("columnname",$columnname);
	hidekey ("columnnomer",$columnnomer);
	hidekey ("id1",$id1);
	hidekey ("id5",$id5);
	submitkey ("write","TARGET2");
}




// модуль перехода linkning

if (($write==cmsg("TARGET2"))) {
	echo "!!!!!!!!!!!!!";
	printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbllink",cmsg("SELLINK"),$groupdb,$ipfilter,6);echo "<br>";
	printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tblhelp",cmsg("SELLINK"),$groupdb,$ipfilter,6);
	hidekey ("groupdb",$groupdb);
	hidekey ("activetableid",$activetableid);
	hidekey ("plevel",$plevel);
	hidekey ("columnname",$columnname);
	hidekey ("columnnomer",$columnnomer);
	hidekey ("id1",$id1);
	hidekey ("id5",$id5);
	submitkey ("write","SAV_LNK");
}


// модуль сохранения linkning

if (($write==cmsg("SAV_LNK"))) {
	echo 'res  NOT CHECKED <br>';
	print "Тип поиска <select name = mode size = ".$mode15.">";
if ($adm==1) { 
	};
if ((($pr[3])and($ADM==0))or($prauth[$ADM][26])) echo "<option value=1".$sel[1].">".$sd[4]."</option>";
if ((($pr[4])and($ADM==0))or($prauth[$ADM][27])) echo "<option value=2".$sel[2].">".$sd[5]."</option>";
if ((($pr[5])and($ADM==0))or($prauth[$ADM][28])) echo "<option value=3".$sel[3].">".$sd[6]."</option>";
if ((($pr[6])and($ADM==0))or($prauth[$ADM][29])) echo "<option value=4".$sel[4].">".$sd[7]."</option>";
if ((($pr[29])and($ADM==0))or($prauth[$ADM][30])) echo "<option value=6".$sel[6].">".$sd[20]."</option>";
if ((($pr[30])and($ADM==0))or($prauth[$ADM][25])) echo "<option value=7".$sel[7].">".$sd[21]."</option>";
if ((($pr[31])and($ADM==0))or($prauth[$ADM][31])) echo "<option value=8".$sel[8].">".$sd[22]."</option>";
if ((($pr[32])and($ADM==0))or($prauth[$ADM][32])) echo "<option value=10".$sel[10].">".$sd[23]."</option>";
//if ($limitenable) $lchk=" checked ";
//if ($selectenable) $schk=" checked ";
print "	</select>";
// выбор колонки для поиска

	//checkbox ($selectenable,"selectenable");  //schk для чего?
		$data=readdescripters ();
		$a=prefixdecode ($res16);
   decodecols ($res16);	lprint ("FOR_SEL"); 
   $field=$kol;//echo "(field=$kol ";
    printfield ($data,"_kol"); echo "(only if mode-7 selected)";
    echo "<br>Help table automatically selects mode 4<br>";


	hidekey ("tbllink",$tbllink);
	hidekey ("tblhelp",$tblhelp);
	hidekey ("groupdb",$groupdb);
        hidekey ("ipfilter",$ipfilter);
	hidekey ("activetableid",$activetableid);
	hidekey ("plevel",$plevel);
	hidekey ("columnname",$columnname);
	hidekey ("columnnomer",$columnnomer);
	hidekey ("id1",$id1);
	hidekey ("id5",$id5);
	submitkey ("write","SAV_LNK2");
}

if (($write==cmsg("SAV_LNK2"))) {
	echo "!!!!!!!!!!!!!end";
	// edit csv
	//submitkey ("write","SAV_LNK");
}



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
	echo "<br>";
	 if ($f==-1) exit; 
		$z=xfgetcsv ($f,2024,"¦");$plevel=xfgetcsv ($f,2024,"¦"); 
		if ($cfgmod==1) {$headervirtual=$data[3];} else {$headervirtual=$z;};//always virtual//always virtual
		if (count ($z)==1) {  lprint ("WF_OUTDATDB");echo "<br>";}
	for ($a=0;$a<count ($z);$a++)
			{
			echo "$a $headervirtual[$a] (<font color=blue id=bfnt>$mycol[$a]</font>) ";
			?><textarea name=z<?=$a; ?> cols=30 rows=1><?=$z[$a]?></textarea>
				<textarea name=p<?=$a; ?> cols=12 rows=1><?=$plevel[$a]?></textarea>
				<br><? 
			}
			echo "";

 submitkey ("write","WF_HDR_REWR");
  		 submitkey ("write","WF_MODSTRC_DAT");echo "<br><br>";
 	 submitkey ("write","WF_ARCH");
  submitkey ("write","WF_UNARCH");
}

//модуль  обработки
// Перезапись заголовка CSV(DAT) для SQL  подойдет для конфы!
if (($write==cmsg ("WF_HDR_REWR"))AND ($prdbdata[$tbl][12]=="mysql")) {
	if (!$prauth[$ADM][6]) { lprint ("ACCDEN"); exit;};
	  //условие не выполняется
	$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();	
	@$f=csvopen ("_data/".$filbas,"r","1");$new=0;
		$z=xfgetcsv ($f,2024,"¦"); $p=xfgetcsv ($f,2024,"¦");
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
	$z=xfgetcsv ($f,2024,"¦"); $plevels=xfgetcsv ($f,2024,"¦");// надо терять их!!
	$z=$data[0];$plevels=$data[1]; 
	for ($a=0;$a<count ($z);$a++) {
		$z[$a]=${"z".$a};//принимаем данные юзера
		$p[$a]=${"p".$a};//принимаем данные юзера
		}
	$values=implode ($z,"¦");if ($OSTYPE=="WINDOWS") $values.="\n";//LINUX FIX  а в винде оно не работает зачем вообще \n?
	$plevels=implode ($p,"¦");if ($OSTYPE=="WINDOWS") $plevels.="\n"; //LINUX FIX
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
if ($prdbdata[$tbl][12]=="mysql") { 
	$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	mysql_select_db ($prdbdata[$tbl][9], $connect);
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
if ($prdbdata[$tbl][12]=="mysql") { 
	$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	mysql_select_db ($prdbdata[$tbl][9], $connect);
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
			$mycol=xfgetcsv ($f,1024,"¦");// $z to mycol  other $z is dupl and changed to myrow   
			if ($vID2==="") { while ($myrow[$md2column]!==$vID) {
									$myrow=xfgetcsv ($f,1024,"¦");
										if ($myrow===false) { break;};	
										};
									};
				if ($vID2!=="") { 
					for ($a=0;$myrow=xfgetcsv ($f,1024,"¦");$a++) { 
						if ($vID!=="") $findid=strpos ($myrow[$md2column],$vID);
							if ($vID2!=="") $findid2=strpos ($myrow[$virtualid],$vID2);//mod-add for corr if
									if (($myrow[$md2column]===$vID)AND($myrow[$virtualid]===$vID2)) break;
											//$myrow=xfgetcsv ($f,1024,";");
									};
											};
				@$crc=implode ("¦",$myrow);//added crc32 count
				//проверка не занят ли ID
			if ($myrow===false) { 
				echo cmsg ("QUE_EMP")."<br>";
				exit;
			}
			
	}
	if (($prdbdata[$tbl][12]=="mysql")) {
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;

	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = mysql_query ($cmd, $connect);
	$myrow = mysql_fetch_row($result);
	//проверка не занят ли ID
	if ($myrow===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrow)));
		}
$commmsg=$myrow[$scrcolumn];
	
$scrdir="_local/scrcomm/".$scrdir;
$comfile=$scrdir."/".$commmsg.".txt"; // это обход опроса в базе содержимого колонки Колонка картин 
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
?> 
:

	<form enctype="multipart/form-data" action="w.php" method=post>
	<textarea name=vd cols=75 rows=10 ><? print $vd; ?></textarea>
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		<input type="hidden" name="max_file_size" value="10000000">
	<input name=userfile type=file class=buttonS>  
<? 	hidekey ("tbl",$tbl);
	hidekey ("commmsg",$commmsg);
	hidekey ("vID",$vID);
	submitkey ("write","KEY_S_COMM");
	echo " </form>";exit;
}

  // запись файла на сервер. бесполезно указывать адресат php ибо данные все равно потеряются
//модуль  обработки
 if ($write==cmsg("KEY_S_COMM"))  {
 	echo "!!!!";
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
if (isset($_FILES)) { $file=1; } else {$file=-1 ;};
echo "_FILES STATE: $file<br>";
		$tempsize=getimagesize ($_FILES["userfile"]["tmp_name"]) ;
		$size=filesize ($_FILES["userfile"]["tmp_name"]);
		if ($size==0) $file=0;
		if ($file==1) { //файл есть , предпринимаем меры
            		$uploaddir= $prdbdata[$tbl][0]."scr";
                   
            		if (!$tempsize) {  echo "Это не картинка ! Файл не был сохранен. <br>";exit ;} // тоже 0 при >64k
        		if ($size>900000) { echo "Превышен hardcoded лимит в 900Кб";exit;}; //CFG OPT FUTURE
                        echo "Куда:".$uploaddir."/ File:".$vID.".jpg<br>";
                        ob_clean (); $error=uploadfile ($uploaddir."/",$vID.".jpg");
                        if ($error) { ob_clean ();lprint ("FS_FWR"); } else { ob_clean ();lprint ("FS_FWRFAIL"); }
                        echo "Он был успешным юзернеймом на УПячке!<br>";
            		}
    }
//end of upload//....        if($error==false) echo "Слив не засчитан";	//end comment write
        exit;
 }




//endcomm



// -----------------------------------------------------------------
//MYSQL SECTION
//модуль запуска
if (($write==cmsg ("KEY_VIEW"))AND($prdbdata[$tbl][12]=="mysql")) {
	if ($vID==false)
{ 
  msgexiterror ("needcode",$mode,"w.php");
} 
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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

	if (($mode == 6)AND($prdbdata[$tbl][12]=="mysql")) {
	$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	$res16=$prdbdata[$tbl][16];// Лимит колонок
	//декодирование строки
prefixdecode ($indata);
		mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		global $mzdata; //$mycol[$md1column]".."
$mode6=array ();
decodecols ();
	$query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE (".$partquery ;
	$query=$query.") AND `".$mycol[$md2column]."` NOT LIKE '%".$vID."%'";
//	echo $query;
//if ($virtualid==1) { $query = $query." AND ".$mycol[$virtualid]."= '".$vID2."'";};
//бесполезно ибо сравнивается с любым полем, если только переписать с учетом 2 полей целую функцию
	$result = mysql_query ($query, $connect);
//	echo "mycols $mycols mz  $mzdata[1]";  
selectedprintsql ($data);
	if ($multisearch==0) {exit (1); }
}
}
}

 //from readfile partends
//=========================================
//модуль запуска и обработки
if (($write==cmsg("KEY_AN"))AND($prdbdata[$tbl][12]=="mysql")) {
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
	//функция подсчета значений в таблице
	if ($data==-1) exit;

	echo "<br>";// $mycol[$md2column]<br>";
	$maxquery="SELECT MAX(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$countquery="SELECT Count(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$result=mysql_query ($countquery, $connect);	$counttbl = mysql_fetch_row($result);
	$result = mysql_query ($maxquery, $connect);	$maxtbl = mysql_fetch_row($result);
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
 <? submitkey ("go","A_SQLCFG"); 
hiddenkey ("write","KEY_S_EXEC");
hidekey ("tbl",$tbl);
hidekey ("vd","SHOW VARIABLES ;");
echo "</form>";
}
//=========================================




//модуль запуска 
if (($write==cmsg ("KEY_DATA"))AND($prdbdata[$tbl][12]=="mysql")) {
	if ($vID==="") { lprint ("WF_FSELID")."<br>"; exit;};
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;
		//datafieldcolsel это No# колонки с data переданный из поиска
	$datacols=explode (",",$prdbdata[$tbl][18]);
	$datafilehdr=explode (",",$prdbdata[$tbl][19]);
	$datasplitters=explode (",",$prdbdata[$tbl][20]);
	echo " DATALIST ".$prdbdata[$tbl][18].";  SEARCH $datafieldcolsel <br>";
for ($a=0;$a<count ($datacols);$a++) {
	//echo "a=".$datacols[$a]." dcs=$datafieldcolsel<br>";
	if ($datacols[$a]==$datafieldcolsel) $datafieldID=$a;
}  //datafieldID - это номер активной DATA из списка в базах админка , no field number ! 

	echo "type:DATA table:".$prdbdata[$tbl][5]." column:".$mycol[$datafieldcolsel]." (No $datafieldcolsel) datafieldID=$datafieldID separator:".$datasplitters[$datafieldID]." (SPC)<br>";
	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = mysql_query ($cmd, $connect);
	$myrow = mysql_fetch_row($result);
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
if (($write==cmsg("KEY_S_DATA"))AND($prdbdata[$tbl][12]=="mysql")) {
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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
echo "type:DATA table:".$prdbdata[$tbl][5]." column:".$mycol[$datafieldcolsel]." (No $datafieldcolsel) datafieldID=$datafieldID separator:".$datasplitters[$datafieldID]." (SPC)<br>";
echo "crc code given:$crc<br>";
// дальше в некоторых местах SQL скрипта надо поменять датаид на имя поля  ($mycol[$datafieldcolsel)

	// заменен vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid]
// сборка всех переменных в values и myrow[]
	for ($a=0;$a<$mycolsdat;$a++)	{
	$myrowdat[$a]=${"z".$a};
	if ($a===0) { $values=$myrowdat[$a];}
	if ($a>0) {$values="".$values.$datasplitters[$datafieldID].$myrowdat[$a]; }
			}
// сборка всех переменных в values и myrow[]
	//проверка старых данных для CRC i UnDO / проверить надо только ДАТА!!
	$cmd="SELECT '".$mycol[$datafieldcolsel]."' FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$myrow[$md2column]."'";
	if ($virtualid==true) { $addcmd=" AND ".$mycoldat[$virtualid]."= '".$myrow[$virtualid]."'"; $cmd.=$addcmd;};
	$result = mysql_query ($cmd, $connect);	
	echo "cmd=$cmd, result=$result <br>";
	$myrowold = mysql_fetch_row($result);
	if ($myrowold==false) {lprint ("WF_EDITNOTADD");echo "<br>"; 
	/*//процедура undo старого ID сохранить надо только ДАТА!!!
		$cmd="SELECT '".$mycol[$datafieldcolsel]."' FROM `".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
		if ($virtualid==true) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$origid2."'";};
		$result=mysql_query ($cmd,$connect);
		echo "cmd=$cmd, result=$result <br>";
		$myrowold=mysql_fetch_row($result); // тут false если то значит ппц :) 
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
	$a=mysql_query ($cmd);  // условие обновлено
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($views) {echo cmsg ("WF_EXQUE")."$cmd<br>"; } else { echo cmsg ("WF_ADDFAIL")."$myrow[0]<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_UPDOK")."!<br>";} else { 
		$errt=cmsg ("WF_UPDFAIL"); $ermsg="$myrow[0]<br>";}
	if ($pr[12]) {$act="EDIT_SQL_TYPE_DATA  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;undolog ($act,$undodata); };  
	//CFG OPT FUTURE - some action like backup not logging!!!!
	//if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=sqlerr ();// пишет ошибку и ее код  и его же возвращает
//endof executing
submitkey ("write","WF_UNDO_LAST");
}

//end KEY_S_DATA



//модуль запуска 
if (($write==cmsg ("KEY_EDIT"))AND($prdbdata[$tbl][12]=="mysql")) {
	if ($vID==="") { lprint ("WF_FSELID")."<br>"; exit;};
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;
if ($prdbdata[$tbl][18]) {//dly redaktirowainya data
	echo "pdb18 ".$prdbdata[$tbl][18];
	$datacols=explode (",",$prdbdata[$tbl][18]);
$datafilehdr=explode (",",$prdbdata[$tbl][19]);
$datasplitters=explode (",",$prdbdata[$tbl][20]);
///echo "datacol ".$datacols[0]."filehdr ".$datafilehdr[0]."  datasplit ".$datasplitters[0]."<br>";

}

	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
		if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = mysql_query ($cmd, $connect);
	$myrow = mysql_fetch_row($result);
	//проверка не занят ли ID
	if ($myrow===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrow)));
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
		for ($a=0;$a<$mycols;$a++)
			{
			echo "$mycol[$a] ";
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
			echo "<td>$mycol[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";
		
		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE 
		if ($lensa>50) $lensa=50;
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
hidekey ("origid1",$myrow[$md2column]);
hidekey ("origid2",$myrow[$virtualid]);
checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>"; 

if ($prauth[$ADM][33]) if (!$frozen) { checkbox ($enfreez,"enfreez");echo "<font color=red id=errfnt>".cmsg ("KEY_S_FREEZE");echo "</font><br>";};
if ($frozen) {hidekey ("frozen",$frozen); echo "<font color=blue id=bfnt>".cmsg ("KEY_FRZD")."</font><br>";
if ($prauth[$ADM][33]) {checkbox ($unfreez,"unfreez");echo cmsg ("KEY_S_UNFREEZE");echo "<br>";}
};
submitkey ("write","KEY_S_EDIT");echo "<br>";

}


//=========================================
//модуль  обработки
if (($write==cmsg("KEY_S_EDIT"))AND($prdbdata[$tbl][12]=="mysql")) {
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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
				if (!$unfrozen)echo "<font color=red id=errfnt>".lprint ("FROZ_OTH_USR")."</font><br>";
				// может эту процедуру тоже как то стандартизировать?
}
//конец разморозки если вкл
	//проверка старых данных для CRC i UnDO
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$myrow[$md2column]."'";
	if ($virtualid==true) { $addcmd=" AND ".$mycol[$virtualid]."= '".$myrow[$virtualid]."'"; $cmd.=$addcmd;};
	$result = mysql_query ($cmd, $connect);	
	$myrowold = mysql_fetch_row($result);
	if ($myrowold==false) {lprint ("WF_EDITNOTADD");echo "<br>"; 
	//процедура undo старого ID
		$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
		if ($virtualid==true) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$origid2."'";};
		$result=mysql_query ($cmd,$connect);
		$myrowold=mysql_fetch_row($result); // тут false если то значит ппц :) 
	}
	@$olddata=implode (";",$myrowold); // вот это и надо сохранять и откатывать
	$undodata=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrowold,$mycols);
	if (!$crcignore) {
				@$crcnew=crc32(trim($olddata));
				if ($myrowold!==false) if ($crcnew!=$crc) {lprint ("WF_CRCFAIL"); exit;} ;}; //crc32testfunction

	// старое условие до 3.2.6 ++ $mycol[$md2column]."='".$vID."'";
	// опять возможная ошибка  - необязательно 0 является ключом
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$myrow[$md2column]."'";
	if ($virtualid==true) {  $cmd.=$addcmd;};

		$cmd2="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
	if ($virtualid==true) { $cmd2=$cmd2." AND ".$mycol[$virtualid]."= '".$origid2."'";};
	// это удаление старого ID если был


	$a=mysql_query ($cmd);  // условие обновлено
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}
	$a=mysql_query ($cmd2);  // условие обновлено
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}


	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	$a=mysql_query ($cmd);//сделать любое кол-во
	$cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	if ($enfreez) {
		if (($codekey==9)or($codekey==7)) demo ();
				$afile="_conf/autoexec.sql";		 $autoexeccmd=$cmd."; #".$prauth[$ADM][0]."\r\n";
				$f=fopen ($afile,"a+");
				$a=fwrite ($f,$autoexeccmd);
				if ($a) { echo "<font color=blue id=bfnt>".cmsg ("KEY_FRZD")."</font><br>";};
				fclose ($f);
				}
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else { echo cmsg ("WF_ADDFAIL")."$myrow[0]<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_UPDOK")."!<br>";} else { 
		$errt=cmsg ("WF_UPDFAIL"); $ermsg="$myrow[0]<br>";}
	if ($pr[12]) {$act="EDIT_SQL  B $tbl($nametbl) Find$vID Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
            logwrite ($act) ;undolog ($act,$undodata,$baseID,$hostIP); };
	//if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=sqlerr ();// пишет ошибку и ее код  и его же возвращает
submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//infa  DISTINCT - отключить дубликаты

//=========================================
//модуль запуска 
if (($write==cmsg ("KEY_ADD"))AND($prdbdata[$tbl][12]=="mysql")) {
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;
	if ($data==-1) exit;
	$maxquery="SELECT MAX(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$result = mysql_query ($maxquery, $connect);	$maxtbl = mysql_fetch_row($result);
	echo cmsg ("WF_1NOTUSED").": ".($maxtbl[0]+1)."<bR>";
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = mysql_query ($cmd, $connect);
	$myrow = mysql_fetch_row($result);
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
			echo "$mycol[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii>(ID1)</ii>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			?>
			<textarea name=z<?=$a; ?> cols=30 rows=1><?=$myrow[$a]?></textarea><br><? ;
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$mycols;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycol[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
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
if (($write==cmsg ("KEY_S_ADD"))AND($prdbdata[$tbl][12]=="mysql")) {
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();

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
	$a=mysql_query ($cmd);//сделать любое кол-во
	$cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";	if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else 	{
		$errt=cmsg ("WF_ADDFAIL"); $ermsg="$myrow[0]".cmsg ("WF_ADDPRS")."<br>";}
	$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $undodata=$undodata." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	if ($pr[12]) {$act="ADD_SQL  B $tbl($nametbl) Find$vID Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
            logwrite ($act) ; undolog ($act,$undodata,$baseID,$hostIP);}; // логируемся
	 //executing+errlogделаем нормальную обработку ошибок  исп всегда этот модуль
	 	     //if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=sqlerr ();// пишет ошибку и ее код  и его же возвращает
submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//=========================================
//модуль запуска 
if (($write==cmsg ("KEY_DEL"))AND($prdbdata[$tbl][12]=="mysql")) {
	if (($virtualid==true)AND($vID2==false)) echo "<font color=red id=errfnt>".cmsg 
		("WF_DEL_GROUP")." ".$vID." </font><br>";
		if ($vID==="") { lprint ("WF_FSELID");exit;};
		submitkey ("write","KEY_S_DEL");
}



//=========================================
//модуль обработки
if (($write==cmsg("KEY_S_DEL"))AND($prdbdata[$tbl][12]=="mysql")) {
	@$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
	$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
		if ($data==-1) exit;
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = mysql_query ($cmd, $connect);
    for ($c=0;$myrow = mysql_fetch_row($result);$c++) {
		if (!$test) $test=$myrow[0];
		$undodata.=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols)." ";
	};
	// тут надо бы undo
	$a=$test;
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$vID."'";
	if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	mysql_query ($cmd); 
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($a==true) { echo $vID.cmsg ("WF_DELOK")."!<br>";} else { 
				$errt=cmsg ("WF_DELFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";}
        
   if ($pr[12]) {$act="DEL_SQL  B $tbl($nametbl) Find$vID Cmd $cmd";
       $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];logwrite ($act) ;
     undolog ($act,$undodata,$baseID,$hostIP);
};  // 
 	 
 //if ($views) cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=sqlerr ();
//endof executing

submitkey ("write","WF_UNDO_LAST");

}











//=========================================
//модуль запуска 
if (($write==cmsg("KEY_MASEXC"))AND($prdbdata[$tbl][12]=="mysql")) {
		
  @ $connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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
 if ($prauth[$ADM][5]==1) { checkbox ($delete,"delete");echo "<font color=red id=errfnt>".cmsg ("WF_UPDTODEL")."</font><br>"; }; ?>
  <input type="radio" name="strupdmode" value="allstrokes"> <? lprint ("WF_EXCALL") ; ?><br>
  <input type="radio" name="strupdmode"  value="substrokes"> <? lprint ("WF_EXCSUB") ; ?> <br>
  <input type="radio" name="strupdmode"  value="subindstrokes"> <? lprint ("WF_EXCSUBIND") ; ?><textarea name=subindex cols= 5 rows=1 ><?=$subindex; ?></textarea>,<? lprint ("WF_EXCSPLT") ; ?> ,<textarea name=subsplitter cols= 4 rows=1 ><?=$subsplitter; ?></textarea><br>

 <?   // start compare addif
 echo "<input type=checkbox name=addifenable1>";
	echo cmsg ("WF_IF")."1 :"; printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$addiflist1; ?></textarea><br>
		<?
	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")."2 :"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
		<?
	// end compare addif   Вставлено для выбора поля
	echo "<br>".cmsg ("WF_DUPL")."<br>";
	if (strlen ($vID2)!==0) echo cmsg ("WF_ID2HLP")."<br>"; 

 ?> 
	<font color=gray id=dfnt> <? lprint ("WF_EMUSUB") ; ?> : </font><input type="checkbox" name="emusubstroke"><br>
 <? submitkey ("write","KEY_S_EXCH");
}



//=========================================
//модуль обработки
if (($write==cmsg("KEY_S_EXCH"))AND($prdbdata[$tbl][12]=="mysql")) {
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();
	$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	mysql_select_db ($prdbdata[$tbl][9], $connect);
 
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
    if (!$strupdmode) { echo "<font color=red id=errfnt><bb>".cmsg ("INP_ERR")."</bb><br></font>".cmsg ("WF_ER_NOMODE");exit;};
	if (strlen ($exchid)==0) { echo "<font color=red id=errfnt><bb>".cmsg ("INP_ERR")."</bb><br></font>".cmsg ("WF_ER_NOTARG");exit;};
	if (($strupdmode=="substrokes") AND (strlen ($sourceid)==0)) { echo "<font color=red id=errfnt><bb>".cmsg ("LIM")."</bb><br></font>".cmsg ("WF_ER_NOSUB"); exit;} ;
	if ($strupdmode==="subindstrokes") { 
	   if (!$subindex) {echo "<font color=red id=errfnt><bb>".cmsg ("INP_ERR")."</bb><br></font>".cmsg ("WF_ER_NOIND") ; exit;}
	  if (!$subsplitter) {echo "<font color=red id=errfnt><bb>".cmsg ("INP_ERR")."</bb><br></font>".cmsg ("WF_ER_SPLIT") ; exit;}
		} ;
	
		if (!$wfemptyenab) if (($prauth[$ADM][4]===false)AND($strupdmode==="allstrokes") AND (strlen ($sourceid)==0)) { echo "<font color=red id=errfnt><bb>".cmsg ("LIM")."</bb><br></font>".cmsg ("WF_EX_ANY_D") ; exit;} ;
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
	$result = mysql_query ($upd, $connect);$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";

	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
		}

//+++++ПРОСМОТР $cmd="SELECT name,$substringone as A FROM `".$prdbdata[$tbl][5]."` WHERE `name` LIKE \"%".$charname."%\";";


// SUBINDSTRREPLACE замена внутри строки с индеком  -
if (($strupdmode=="subindstrokes")AND(!$emusubstroke))	{
//calc maximum row inside data field
	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`LIKE '%".$sourceid."%'";
	$result = mysql_query ($cmd, $connect);$myrow = mysql_fetch_row($result);
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
$result = mysql_query ($cmd, $connect);$myrow = mysql_fetch_row($result);
if (!$pr[8]) echo "COMMAND 2 : $cmd<br><bR><br>Substroke 2 row:".$myrow[0]."<br><br><br><br><br>";
}  //  шобы не светилось
*/ 


	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`= CONCAT(SUBSTRING_INDEX(`".$mycol[$field]."`, '".$subsplitter."', '".($startsub)."'), ' ".$exchid." ' ,SUBSTRING_INDEX(`".$mycol[$field]."`, '".$subsplitter."', '".$endsub."'))  WHERE (".$substringone.")=".$sourceid." "; // where частьверная.
 // кстати вроде баг с этой фигней в цсв до сих пор осталсяяLIKE '%".$subsplitter.$sourceid.$subsplitter."%'
if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE ".$substringone."='".$sourceid."' ";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // вып доп условия модерниз.
	$result = mysql_query ($upd, $connect);$cmd="";$silent=0;sqlerr ();
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
	}

//модулb эмуляции субстрок
// SUBSTRREPLACE замена внутри строки без индекса  эмуляция(!!!)
if (($strupdmode=="substrokes")AND($emusubstroke)) { $sourcefield="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`LIKE '%".$sourceid."%'";
$subselect=mysql_query($sourcefield,$connect); 
while($row=mysql_fetch_array($subselect,$connect))
	{ $data=$row[$field];$guided=$row[$md2column];
	//echo $row[0]." -- ".$row[$field]." -- ".$field." <br>"; 
$replid=$data; $replid=str_replace ($sourceid, $exchid,$replid);// replid это массив который нужд в изменении
	$upd="UPDATE `".$prdbdata[$tbl][5]."` SET `".$mycol[$field]."`='".$replid."' WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if ($delete) $upd="DELETE FROM `".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."`= '".$data."' AND `".$mycol[$md2column]."`= '".$guided."'";
	if (($addifenable1)OR($addifenable2)) {$upd=$upd.$cmdaddif;		}; // вып доп условия модерниз.
	$result = mysql_query ($upd, $connect);$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };

};
echo "Выполнено ".$findrecords." циклов.<br>";
};


// SUBINDSTRREPLACE замена внутри строки с индеком  эмуляция
if (($strupdmode=="subindstrokes")AND($emusubstroke)) {  
$sourcefield="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE `".$mycol[$field]."` LIKE '%".$sourceid."%'";
$subselect=mysql_query($sourcefield,$connect); 
while($row=mysql_fetch_array($subselect,$connect))
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
	$result = mysql_query ($upd, $connect);$cmd="";
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
	if ($result) {$findrecords++ ;} else { echo cmsg ("WF_QUEFAIL")."<br>"; };
	}; //endif dataexp
};//endwhile
echo cmsg ("WF_CCLOK").$findrecords.".<br>";
};//endif subindstrokes
// конец модуля эмуляции субстрок
	if ($cmd) $result = mysql_query ($cmd, $connect);
	$a=$result;// проверка на вшивость :) чтобы сто раз не удаляли
	if (($views)AND($strupdmode=="allstrokes")) $upd=$cmd;//фикс непоказа запроса в 1реж
	if ($views) echo cmsg ("WF_EXQUE").$upd."<br><br>".cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
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
if (($write==cmsg("KEY_MASCPY"))AND($prdbdata[$tbl][12]=="mysql")) {
  @ $connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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
// echo "<font color=gray id=dfnt>Просто просмотр, без копирования</font><input type=checkbox name=delete><br>"; ?>
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
if (($write==cmsg("KEY_S_COPY"))AND($prdbdata[$tbl][12]=="mysql")) { 
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();

	//echo "Процедура работает в тестовом режиме";
	$connect1 = mysql_connect ($prdbdata[$source][6], $sd[14] , $sd[17]);
	$connect2 = mysql_connect ($prdbdata[$destination][6], $sd[14] , $sd[17]);
	mysql_select_db ($prdbdata[$source][9], $connect1);
	mysql_select_db ($prdbdata[$destination][9], $connect2);

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
$result = mysql_query ($cmd, $connect);
  if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").mysql_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=sqlerr ();// пишет ошибку и ее код  и его же возвращает
$error= mysql_error ();
//echo $error;
if ($errno) {lprint ("WF_POSERR");}
//endof executing


	if ($pr[12]) {$act="MASS_COPY_SQL  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;	};  // логируемся
}

//=========================================


//копирование таблиц. возможно будет частью модуля работы с базами данных
//паковка баз данных - список ключей вверху файла, файл обрабатывается до координаты ключа,ключ вст.обр. продолжается




//модуль запуска
//===============================  для масс сравнения будет похожая менюшка.
// для инстанс режима будет сначала выбор инстансов а дальше уже просто данные будут передаваться похожему скрипту.   вообще то реально сравнение все же нужно сделать без разницы где
if (($write==cmsg ("KEY_SHOWCODE"))AND($prdbdata[$tbl][12]=="mysql")) {
  @ $connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	@mysql_select_db ($prdbdata[$tbl][9], $connect);
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
<?// checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>"; 
   checkbox ($nolimit,"nolimit") ; echo cmsg ("WF_NOLMTIM")."<br>";

   // checkbox ($keys,"keys"); echo cmsg ("WF_MASCMP_KEY")."<br>"; пока нет возм сравнить содержимое
   //checkbox ($dbaff,"dbaff") ; echo cmsg ("WF_INSBAS")."<br>"; если поля баз разные то и базы авт надо разные сравнивать!!! -
//RMV	     checkbox ($execute,"execute") ; echo "<font color=red id=errfnt>".cmsg ("WF_VIEANDEXEC")."<br></font>";
   
  //<input type="radio" name="cmpmode" disabled value="1to2"><? lprint ("WF_CMP_12") ; 
  //<input type="radio" name="cmpmode" disabled   value="2to1"> <? lprint ("WF_CMP_21") ;
?>  <input type="radio" name="cmpmode"  value="1only" checked><? lprint ("WF_CMP_QRY") ; ?><br>
  <? 	
// start compare addif
//checkbox ($cmpifchg,"cmpifchg") ; echo "<font color=gray id=dfnt>".cmsg ("WF_CMPIFCGH")."<br></font>"; 
   echo cmsg ("WF_IF1")."1:";  printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 ><?=$vID; ?></textarea><br>
		<?
	echo "<input type=checkbox name=addifenable2>";
	echo cmsg ("WF_IF")." 2:"; printfield ($data,"addif2"); 
	printcmp ("addifcmp2");
?><textarea name=addiflist2 cols= 25 rows=1 ><?=$addiflist2; ?></textarea><br>
	<?  submitkey ("write","KEY_S_SHOWCODE");
	// end compare addif   Вставлено для выбора поля
}

//модуль обработки
if (($write==cmsg ("KEY_S_SHOWCODE"))AND($prdbdata[$tbl][12]=="mysql")) { //  execute (!(
 	 if (($codekey==4)) needupgrade ();
	 if (($codekey==9)OR($codekey==7)) demo ();
	$connect = mysql_connect ($prdbdata[$source][6], $sd[14] , $sd[17]);
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

	if ($cmpmode=="2to1") {
			$temp=$sourcetable; $sourcetable=$desttable;$desttable=$temp; }


	if ($keys) // вывести чего не хватает первой до второй  с ключами
	{		if ($cmpmode!=="1only") {echo "В первой базе ($sourcetable) эти записи отличаются от второй ($desttable), для исправления применить:<br>";
	if ($virtualid) {$vidcmdadd=" AND $sourcetable.`".$id2."`=$desttable.`".$id2."` ";
	  $vidcmdadd2="	$desttable.`".$id2."` IN (SELECT $desttable.`".$id2."` FROM $sourcetable,$desttable WHERE $sourcetable.`".$id1."`=$desttable.`".$id1."` ".$vidcmdadd." ) AND";
			}
   $cmd="SELECT * FROM $desttable WHERE $desttable.`".$id1."` IN (SELECT $desttable.`".$id1."` FROM $sourcetable,$desttable WHERE $sourcetable.`".$id1."`=$desttable.`".$id1."` ".$vidcmdadd." ) AND ".$vidcmdadd2;
	}
	}

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
	if ($cmd) $result = mysql_query ($cmd, $connect);
	if ($result===true) { echo $vID.cmsg ("WF_CMP")."<br>";} else { 
				$errt=cmsg ("WF_CMPFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";}


// печать   формирование текста запроса
    for ($c=0;$myrow = mysql_fetch_row($result);$c++) {
		$insertone=gencmdlog ($sourcetable,$myrow,$mycols);
		echo $insertone."<br>";
	};

  echo cmsg ("WF_CCLOK")." ".$c."<br>";


	if ($views) echo cmsg ("WF_EXQUE").$cmd."<br>";
		echo "<br>".cmsg ("WF_QUECOMP")." ".mysql_affected_rows ()." ".cmsg ("WF_Q1")."<br>";
	if (!$pr[8]) {echo "DEBUG Получен код $a<br>";}
	if ($pr[12]) {$act="SHOW_PATCH_SQL  B $tbl($nametbl) Find$vID Cmd $cmd"; logwrite ($act) ;};  // логируемся

	//executing+errlogделаем нормальную обработку ошибок  исп всегда этот модуль
$silent=0;$errno=sqlerr ();// пишет ошибку и ее код  и его же возвращает
if ($errno) {echo cmsg ("WF_POSERR")."<br>";}
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
// KEY_S_MASS_OPER теряется - приходится заюзать KEY_MASS_OPER

// модуль исполнения====================================
if (($write==cmsg ("KEY_S_MASS_OPER"))AND($prdbdata[$tbl][12]=="mysql")AND($prauth[$ADM][45])AND($massoper)) { 
if (!$massoper) echo "Select option first !";
// 1- change column  , 2 - show generate script (SQL only)  3- remove 4 - to best 5 - noop
if ($massoper==5) return;
$activetable=$prdbdata[$tbl][1];
echo "Active table: $activetable [$tablemysqlselect'$tblmysqlselect]; Given data total:$boxcnt<br>";
if ($massoper==4) {
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

for ($a=0;$a<$boxcnt;$a++) {      
	$strokedata.=${box.$a}."¦";
	//if ($box[$a][2]) $strokedata.="&".$box[$a][2]."¦";
//echo " box[$a]==>".${box.$a}."".$box[$a][1]."<br>";  //ids vID  vID2  DISABLE VISIBLE print no ID's, a parts.
//hidekey ("box".$a,$box[$a][0]."&".$box[$a][1]);
}
//тут заканчивается генерация строки.
echo "Add : $strokedata<br><br>";
if ($rewr) {$bestcnt=$rewritecnt+1; lprint (REW_OK); echo "<br>";}  //rewrite MO

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
	  $tempdescr=fopen ($filbas,"w");
	//  echo "===========CHECK:WRItEFULLCFG DATA=-==============<br>";
   	  $code=writefullcsv ($tempdescr,$bestheader,$bestplevel,$bestcontent);
   	  //echo "writefullcsv return code $code<br>";
   	 $edit=0;
   	 //echo "===============END WRITEFULLCFGDATAOUT=========================<br>";
  @$best=csvopen ($filbas,"r",0);$data=readfullcsv ($best,"new");
  $bestheader=$data[0];$bestplevel=$data[1];$bestcontent=$data[2];$bestcnt=$data[3];
  //echo "<font color=magenta>=============CHECK:best.cfg==============<br></font>Massive have lines (bestcnt)=$bestcnt<br>";
  //debugcfgprint ($bestheader,$bestplevel,$bestcontent) ;
//echo "=================================================<br>";
  @fclose ($best);	

   	  }
   	  
 unset ($tempdescr,$bestheader,$bestplevel,$bestcontent);
}
//endif  massooper 4

}


//=========================================
//модуль запуска
if (($write==cmsg ("KEY_MASS_OPER"))AND($prdbdata[$tbl][12]=="mysql")AND($prauth[$ADM][45])) { //  CFG OPT FUTURE
lprint (M_OP_INF);echo "<bR>";

$data=readdescripters ();
echo "";
radio ("massoper",1,"M_OP_1") ;printfield ($data,"addif1"); 
	printcmp ("addifcmp1");
?><textarea name=addiflist1 cols= 25 rows=1 wrap=virtual><?=$addiflist1; ?></textarea><br>
<?	
if ($prdbdata[$tbl][12]=="mysql") radio ("massoper",2,"M_OP_2") ;echo "<bR>";
if (!$prauth[$ADM][5]) echo "<font color=gray id=dfnt>".cmsg ("M_OP_3").cmsg ("BLOCK")."</font>";
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
if (($write==cmsg ("KEY_EXECUTE"))AND($prdbdata[$tbl][12]=="mysql")AND($prauth[$ADM][34])) { //  CFG OPT FUTURE
if ($codekey==7) die ("Disabled for secutiry reasons.");

if ($codekey==5) needupgrade ();
// if (!$prauth[$ADM][2]) die ("Возможно не хватает прав ;)");
	$data=readdescripters ();$a=prefixdecode ($res16);
		//if ($data==-1) exit;
		if ($directexecute) { checkbox ($forcedb,"forcedb");lprint ("FORCE_DB");echo ":";
		$cmd="SHOW DATABASES"; //copy from dump execute
$a=mysql_query ($cmd,$connect);
if ($a==false) echo "connection die";

//echo "<form action=dblinker.php method=post>";  maybe no need?
echo "<select name=dbselected>";
while ($result=mysql_fetch_row ($a)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
	echo "<option>".$result[0]."";
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
	
   }
	checkbox ($bugkosye,"bugkosye"); lprint ("WF_EX_TRYSKIPBUG"); ?>
		<br>
  <input type="radio" name="cpymod" value="copyabort"> <? lprint ("ABORT") ; ?> 
    <input type="radio" name="cpymod" value="copyignore" checked> <? lprint ("IGNORE") ; ?><br>
		<textarea name=vd cols=75 rows=8 ></textarea>

<?
submitkey ("write","KEY_S_EXEC");submitkey ("write","WF_BCK_FILEDUMP_UNARCH");echo "<br>"; 
}	
//модуль обработки


if (($write==cmsg ("KEY_S_EXEC"))AND($prdbdata[$tbl][12]=="mysql")) {
// if (!$prauth[$ADM][2]) die ("Возможно не хватает прав ;)");
$connect=mysql_connect_wcheck ($prdbdata[$tbl][6],$sd[14],$sd[17]);
	if (!$disabledbselect) mysql_select_db ($prdbdata[$tbl][9], $connect);
	if (($directexecute)AND($forcedb)) {mysql_select_db ($dbselected, $connect);
		echo "Forced use: $dbselected<br>";	//$cmd="USE $dbselected;";	mysql_query ($cmd,$connect);
	} ;
	
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
//$qw=mysql_query ($cmd,$connect);echo $qw."--"; sqlerr ();
	//$patterns[0]="//\'/" ;$replacements[0]="'"; //Unknown modifier '\' in 
	$patterns[0]="/\\\'/" ;$replacements[0]="'";
	@$cmd=preg_replace ($patterns,$replacements, $cmd);
	if (strpos ($cmd,"SELECT")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"SHOW")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"CHECK")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"REPAIR")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"ANALYZE")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"OPTIMIZE")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"BACKUP")!==false) $printing=1; // разрешает печать в libmysql
	if (strpos ($cmd,"RESTORE")!==false) $printing=1; // разрешает печать в libmysql
	$cmd=$cmd.$group.$limit; // именно в этом порядке
	$queries=explode (";",$cmd);	$countqueries=count ($queries);
   // а теперь выполнение большого количества запросов
	for ($cntque=0;$cntque<$countqueries;$cntque++) {
		unset ($errt);unset ($ermsg);
		$multicmd=$queries[$cntque];
		if ($multicmd=="") continue;
		$a=executesql ($multicmd,$connect,0);// было 
	if ($a==-1) executesql ($multicmd,$connect,2); //old mode for possible bugs issue
		if ($a==-1) {
			$silent=0;$error++; $errno=sqlerr ();
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
	if (($countqueries-1)>1) {echo "<br>Sended commands (executed/total)  ".($cntque-1-$error)."/".($countqueries-1)."<br>";
	if ($skipped) echo cmsg ("BCK_SKIP").$skipped."<br>";
	if ($error) echo cmsg ("BCK_ERR").$error."<br>";
	}	

}




echo "</form>"; // конечный тег для всего 

endtm ();
end

?> 
