<?php
require_once ('dbscore.lib'); // функция подготовки к работе и авторизации
$enterpoint=$verdblink;$verdblink="Dbmanager v4.2.1 (c) dj--alex"; //endindex

if ($serv2) $mainhostmysql=$serv2;
if ($dbtype=="mysql") $connect=mysqli_connect ($mainhostmysql, $sd[14] , $sd[17]);
$pgconn="host=".$mainhostmysql." port=5432 user=".$sd[14]." password=".$sd[17]."";
if ($dbtype=="pg") $connect=pg_connect ($pgconn);
if ($dbtype=="ibase") $connect=ibase_connect ($mainhostmysql, $sd[14] , $sd[17]);
if ($dbtype=="oci") $connect=oci_connect ($mainhostmysql, $sd[14] , $sd[17]); // not used
//echo "$connect=mysqli_connect to=".$mainhostmysql." ";    %username%
//echo "TEEEEST!!!  dblinker.php?cmd=sql&tbl=$tbl&tab=$tableselected&dblk=$dbselected; ";print_r ($tableselected);

if ($dbtype!=="fdb") if ($connect===false) echo "Server not connected";

 if ($ADM==0) { msgexiterror ("notuser",0,"dblinker.php");}// -inc pass or login
If ($prauth[$ADM][3]==false) { msgexiterror ("notright","","disable");exit;}// msgexiterror НЕ ВЫПОЛНЯЕТ выход самостоятельно функцию целиком перевести на window ()
// ИБАНЕ ключ ОПЯТЬ не загружается  мдя
if (($write==cmsg(KEY_EXECUTE))or($write==cmsg("DUMP"))) {  // передать базу данных для исполнения коман  $serv2 $dbselected $dbtype $tableselected
	for ($a=0;$a<count($prdbdata);$a++) {
		if ($prdbdata[$a][9]===$dbselected) { if ($prdbdata[$a][5]===$tableselected[0]) $tbl=$a; }
	}
	if ($write==cmsg(DUMP)) $fdmp=1;  // DUMP - выполнить дамп,  передает и параметр дампа - название его например - влияет на форсирование выбора.
	//$directexecute=1;
  Header("Location: w.php?cmd=sql&tbl=$tbl&tab=".$prdbdata[$tbl][5]."".$tableselected[0]."&dblk=".$prdbdata[$tbl][9]."$dbselected"."&fdmp=$fdmp");exit;
	exit;
}

 echo "server:".$mainhostmysql." type=$dbtype<br>";// CFG OPT FUT SELECTOR UNIQUE SERVERS FROM DB
 echo "debug:connect=$connect<br>";
if ((!isset($start))AND(!isset($end))AND(!isset($write))) { ?>  
   <form action=dblinker.php method=post>
  <?php  lprint ("GEN_DB_TBL");
  echo "<br>";
 	lprint ("GEN_DB_CON");
  echo "<br>";
    ?><select name=dbtype>
    <option value="mysql">mysql</option>
    <option value="fdb">text (csv,dat)</option>
    <option value="pg">postgre 8* </option>
    <option value="ibase">firebird 2*</option>
    <option value="oci">oracle 10 * </option>
    </select>    <br>   <br>  <?php if (!$dbtype) {
   echo"Another server ";inputtxt ("serv2",10);echo "<br>";
 	submitkey ("start","DALEE");
  	}
  	echo "<br>";echo "<br>";
 echo cmsg (DBS_CMD)." ";inputtxt ("dbscmd",15);echo "<br>";
 submitkey ("start","DALEE");
echo "</form>";
}

if ($dbscmd) { //&nomnu=1 CFG OPT FUTURE  TODO:  TODO:
	Header("Location: r.php?cm=1&tbl=log&vID=".$dbscmd."&m=0;");exit;
}


// выбор и действия (write) с базами 
if (($start)AND(!$dbselected)AND($dbtype!="fdb")) {
$separator="¦";lprint ("GEN_DB_SEL");
$cmd="SHOW DATABASES";
$a=dbs_query ($cmd,$connect,$dbtype);
if ($a==false) echo "connection die";

echo "<form action=dblinker.php method=post>";
echo "<select name=dbselected>";
while ($result=dbs_fetch_row ($a,$dbtype)) {
	if ($result[0]=="information_schema") continue;
	if ($result[0]=="mysql") continue;
	echo "<option>".$result[0]."";
}
echo "</select>";
echo "<input type=hidden name=dbtype value=$dbtype>";
echo "<input type=hidden name=dbs value=$dbs>";
echo "<input type=hidden name=serv2 value=$serv2>";


submitkey ("start","USE_DB");
if ($prauth[$ADM][2]) {
submitkey ("write","CRT_DB");
submitkey ("write","DEL_DB");
submitkey ("write","COPY_DB");
if (($prauth[$ADM][34])) { 	submitkey ("write","DUMP");  }
//submitkey ("start","DALEE");
}
echo "</form>";
}


if (($write==cmsg(CRT_DB))AND($dbtype!="fdb"))	{
	if ($write)echo "<form action=dblinker.php method=post>";
	hidekey ("cmd","CRT_DB");
	echo"Name new database, (use ; if not one) : ";inputtxt ("newdbname",10);
	submitkey ("write","DALEE");
		hidekey ("dbtype",$dbtype);
	hidekey ("dbselected",1);
	hidekey ("serv2",$serv2);
}



if (($dbselected)AND(!$tableselected)AND($dbtype!="fdb")) {
	if ($write)echo "<form action=dblinker.php method=post>";
	//define db commands

	
	if (($write==cmsg(DEL_DB)))	{
	echo"Your sure to delete this db ".$dbselected."<Br>";
	hidekey ("cmd","DEL_DB");
	submitkey ("write","YES");submitkey ("write","NO");
	}
	
	if (($write==cmsg(COPY_DB))) {
				hidekey ("cmd","COPY_DB");
			directselectsqldb ($connect,"source","source");
			directselectsqldb ($connect,"dest","target");

	submitkey ("write","DALEE");	}
			
//var for all options
	hidekey ("dbtype",$dbtype);
	hidekey ("dbselected",$dbselected);
	hidekey ("serv2",$serv2);
	//execution zone for db commands
	if (!$prauth[$ADM][2]) $cmd="";
IF ($cmd=="CRT_DB") {
	$ex=explode (";",$newdbname); // можно создавать много баз через ;
	if (count ($ex)<1) {
	$cmd="CREATE DATABASE $newdbname";
			$a=dbs_query ($cmd,$connect,$dbtype);
			dbserr ();
	} else {
		echo "count : ".count ($ex)."<br>";
	for ($a=0;$a<count ($ex);$a++) {$cmd="CREATE DATABASE ".$ex[$a].";";
			dbs_query ($cmd,$connect,$dbtype);
			echo $cmd."<br>";
			dbserr ();
			}
		
	}
        $act="DBL:CRT_DB (s) ".$newdbname; logwrite ($act);
	$endoper=1;
}
IF ($cmd=="DEL_DB") {
	if ($write==cmsg (NO)) exit;
	$cmd="DROP DATABASE $dbselected";
			$a=dbs_query ($cmd,$connect,$dbtype);
		dbserr ();
		echo "OK";
                $act="DBL:DEL_DB ".$dbselected; logwrite ($act);
		$endoper=1;
}
IF ($cmd=="COPY_DB") { 
	if ($debugmode) echo "";
	//$connect = mysqli_connect ($prdbdata[$tbl][6], $sd[14] , $sd[17]);
	echo " copydatabase ($source,$dest,$connect); ";
	copydatabase ($source,$dest,$connect); //ni hrena!!!!
        $act="DBL:COPY_DB ".$source." to $dest"; logwrite ($act);
	$endoper=1;
}
	hidekey("dbs",$dbs);
	if ($endoper==1) {
		hidekey ("dbselected","");
		submitkey ("start","DALEE");
	}
	/*8/hidekey("write",$write);
*/
	if ($write) echo "</form>";
}

//dbscript mysql linkgen   выбор и действия (write) с таблицами
if (($dbselected)AND(!$tableselected)AND($dbtype!="fdb")AND($start)) {
if (1==1) {$separator="¦";lprint ("GEN_TBL_SEL");}

if ($dbselected) {
dbs_selectdb ($dbselected,$connect,$dbtype);
$cmd="SHOW TABLES";
$a=dbs_query ($cmd,$connect,$dbtype);

echo "<form action=dblinker.php method=post>";
echo "<select name=\"tableselected[]\" multiple size=20>";
while ($result=dbs_fetch_row ($a,$dbtype)) {
	echo "<option>".$result[0]."";$cnt++;
}
//if ($cnt<1) echo "База не содержит таблиц";
echo "</select>";

echo "<input type=hidden name=dbtype value=$dbtype>";
?><input type=hidden name=dbselected value=<?=$dbselected?>>
<?echo "<input type=hidden name=serv2 value=$serv2>";
//echo "<input type=hidden name=dbs value=$dbs>";
submitkey ("start","USE_TAB");
if (($dbtype!="fdb")AND($prauth[$ADM][2])) {
submitkey ("write","COPY_TAB");
submitkey ("write","DEL_TAB");
submitkey ("write","MOVE_TAB");
if ($debugmode) submitkey ("write","MOD_TAB"); //perehod na w.php
if ($debugmode) submitkey ("write","ADD_TAB"); //perehod na w.php
if (($prauth[$ADM][34])) { 

	//hidekey ($directexecute,1);
	submitkey ("write","KEY_EXECUTE"); 
	
}; 
}
echo "</form>";
}





// далее генерим инфу по базам с входами в таблицы	
    // c файлами проще - работает как с таблицами только.
 // echo"<select name=tables multiple></select>";
    
}
//final


//dbscript fdb linkgen   // почему не видит файлы под виндой ??
if ((!$tableselected)AND($start)AND($dbtype=="fdb")) {
$separator="¦";lprint ("GEN_TBL_SEL");
if (!$prauth[$ADM][2]) msgexiterror ("notrights"," administrator","admin.php"); 
		if ($OSTYPE=="LINUX") {$path=getcwd ()."/_data/";
		$path2=$fldup."/_data/";}
                if ($OSTYPE=="WINDOWS") {$path=getcwd ()."\\_data\\";
		$path2=$fldup."\\_data\\";} // если где то ещё это будет замечено тоже поправить!!!!
			$mask="*.dat";//wse ok
			$protect[]="backup.*";
			$files=getdirdata ($path,$mask,$protect);
                        //echo "$files=getdirdata ($path,$mask,$protect);;";                        print_r ($files);
			if ($files==false) { 
					echo " Ищем далее...<br>";
					//echo "2=getdirdata ($path2,$mask,$protect);";
					$files=getdirdata ($path2,$mask,$protect);
					if ($files==false) echo "Folder not found, 2 tryes.";;
			}
		echo "<form action=dblinker.php method=post>";
echo "<select name=\"tableselected[]\" multiple size=20>";
		for ($a=2;$a<count ($files);$a++){  //fixed lost first file fdb dat adding list

				if ($files[$a][0]=="") continue;
				echo "<option>".$files[$a][0]."";
				//$modules[]=searchplus ($path.$files[$a][0],"NOPRINT","ver+(c)");  hide
			}
			unset ($files);
echo "</select>";



		?><input type=hidden name=dbtype value=fdb>
		<input type=hidden name=dbselected value=<?=$dbselected?>>
		<?php echo "<input type=hidden name=serv2 value=$serv2>";
//echo " fdb $dbs temp";
 submitkey ("start","DALEE");
echo "</form>";
}




//if (($tableselected)AND(!$end)AND($start!==cmsg(USE_TAB))AND($start!==cmsg(DALEE))) {
	if (($tableselected)AND(!$end)AND($write)AND(!$cmd)) {
		echo "<form action=dblinker.php method=post>";
		echo $write."<br>";
		echo "DB:$dbselected<br>"; echo "have db's :$prdbdatacnt<br>";
	 	 $totaltables=count ($tableselected);
		for ($a=0;$a<$totaltables;$a++) { // работает и почему то не виснет 
 			echo $tableselected[$a];
                        for ($b=0;$b<$prdbdatacnt;$b++) {  
                                        if ($prdbdata[$b][1]==$dbselected.$tableselected[$a]) {echo " -- <red>Alias present!</red>";break;};//}else{ echo "Alias not present";
                                         if ($prdbdata[$b][1]==$dbselected.".".$tableselected[$a]) {echo " -- <red>Alias present!</red>";break;};//}else{ echo "Alias not present";
                                    }
                                    echo "<br>";
 			echo "<input type=hidden name=\"tableselected[$a]\" value=".$tableselected[$a].">";
 	 }
	//menu commands for tables
 	 if ($write==cmsg (COPY_TAB)) {
			echo "Select target database:<br>";
						directselectsqldb ($connect,"dest","target");
			hidekey ("cmd","COPY_TAB");
			submitkey ("start","DALEE");
		}
		if ($write==cmsg (DEL_TAB)) {
			echo"Your sure to delete this tables? <Br>";
			hidekey ("cmd","DEL_TAB");
			submitkey ("write","YES");submitkey ("write","NO");
			echo "";
		}
		if ($write==cmsg (MOVE_TAB)) {
			echo "Select target database:<br>";
						directselectsqldb ($connect,"dest","target");
			hidekey ("cmd","MOVE_TAB");
			submitkey ("start","DALEE");
		}
		if ($write==cmsg (MOD_TAB)) {
			hidekey ("cmd","MOD_TAB");
			submitkey ("start","DALEE");
			}
		if ($write==cmsg (ADD_TAB)) {
			hidekey ("cmd","ADD_TAB");
			submitkey ("start","DALEE");

		}
		
		hidekey ("dbtype",$dbtype);
		hidekey ("dbselected",$dbselected);
		hidekey ("serv2",$serv2);
		if ($write)echo "</form>";
		//execution zone for table commands
	exit;
	
}

if (($tableselected)AND($cmd)) {
	//command executing for tables
	if (!$prauth[$ADM][2]) msgexiterror ("notrights"," administrator","admin.php"); 
	echo "<form action=dblinker.php method=post>";
	if (($cmd=="DEL_TAB")AND($write==cmsg (YES))) {
		 $totaltables=count ($tableselected);
	 	 dbs_selectdb($dbselected,$connect,$dbtype);
	 	 for ($a=0;$a<$totaltables;$a++) {
	 	 		$cmd="DROP TABLE `".$tableselected[$a]."`";
			    $e=dbs_query ($cmd,$connect,$dbtype);
				dbserr ();
                                if ($e===false) $cnt++;
				}
                                $act="DBL:DEL_TAB (s) ".$dbselected.".".implode ($tableselected,","); logwrite ($act);
	}
	if (($cmd=="COPY_TAB")) {
		 $totaltables=count ($tableselected);
	 	 dbs_selectdb($dbselected,$connect,$dbtype);
	 	 for ($a=0;$a<$totaltables;$a++) {
	 	 		$query="CREATE TABLE `$dest`.`".$tableselected[$a]."` LIKE `".$dbselected."`.`".$tableselected[$a]."`;";
				$e=dbs_query ($query,$connect,$dbtype);
				dbserr ();
				if ($debugmode)	echo "DEBUG $query.<br>";
				$query="REPLACE INTO `$dest`.`".$tableselected[$a]."` SELECT * FROM `".$dbselected."`.`".$tableselected[$a]."`;";
				$e=dbs_query ($query,$connect,$dbtype);
				dbserr ();if ($e===false) $cnt++;
				//$cmd="DROP TABLE `".$tableselected[$a]."`";
				//dbs_query ($cmd,$connect,$dbtype);
				dbserr ();
				}
                                $act="DBL:COPY_TAB (s) ".$dbselected." to $dest::".implode ($tableselected,","); logwrite ($act);
	}
	if (($cmd=="MOVE_TAB")) {
		 $totaltables=count ($tableselected);
	 	 dbs_selectdb($dbselected,$connect,$dbtype);
	 	 for ($a=0;$a<$totaltables;$a++) {
	 	 		$query="CREATE TABLE `$dest`.`".$tableselected[$a]."` LIKE `".$dbselected."`.`".$tableselected[$a]."`;";
				$e=dbs_query ($query,$connect,$dbtype);
				dbserr ();
				if ($debugmode)	echo "DEBUG $query.<br>";
				$query="REPLACE INTO `$dest`.`".$tableselected[$a]."` SELECT * FROM `".$dbselected."`.`".$tableselected[$a]."`;";
				$e=dbs_query ($query,$connect,$dbtype);
				dbserr ();if ($e===false) $cnt++;
				$cmd="DROP TABLE `".$tableselected[$a]."`";
				dbs_query ($cmd,$connect,$dbtype);
				dbserr ();
				}
                                $act="DBL:MOVE_TAB (s) ".$dbselected." to $dest::".implode ($tableselected,","); logwrite ($act);
	}
	
	if (($cmd=="MOD_TAB")) {
	echo "<form action=w.php method=post>";
	$activetable=$tableselected[0];
	hidekey ("generictable",$activetable);
	hidekey ("write","WF_STRC_SQL");
	//GENERATING ADDRESS FOR WRITEFILE OR SAY ADD TO LIST FIRST
	echo "</form>";exit;
	}
	
	if (($cmd=="ADD_TAB")) {
	echo "<form action=w.php method=post>";
	$activetable=$tableselected[0];
	hidekey ("generictable",$activetable);
	hidekey ("write","WF_NEW_TAB");
	echo "</form>";exit;
	}
	echo cmsg (TAB_AFF)."$cnt<Br>";
	echo "OK";
	hidekey ("dbtype",$dbtype);
		hidekey ("dbselected",$dbselected);
		hidekey ("serv2",$serv2);
	submitkey ("start","DALEE");		
	echo "</form>";exit;
}


if (($tableselected)AND(!$end)AND(!$cmd)) {
		echo "<form action=dblinker.php method=post>";
$separator="¦";lprint ("GEN_TBL_ADD");

echo "<br>";
echo "DB:$dbselected<br>";
	 	 $totaltables=count ($tableselected);
 for ($a=0;$a<$totaltables;$a++) {
 	echo $tableselected[$a];
                    for ($b=0;$b<$prdbdatacnt;$b++) {//  добавка таблиц, надо посмотреть name
                                        if ($prdbdata[$b][0]==$dbselected.$tableselected[$a]) {echo " -- <red>Alias present!</red>";break;};//}else{ echo "Alias not present";
                                         if ($prdbdata[$b][0]==$dbselected.".".$tableselected[$a]) {echo " -- <red>Alias present!</red>";break;};//}else{ echo "Alias not present";
                                    }
                                    echo ",";
 	echo "<input type=hidden name=\"tableselected[$a]\" value=".$tableselected[$a].">";
 	 }
if (!$prauth[$ADM][2]) { msgexiterror ("notrights"," administrator","admin.php"); ;exit;}
echo "<br>";
echo "<select name=groupplevels>";
		for ($a=0;$a<10;$a++){
			echo "<option>".$a;
			}
echo "</select>";

lprint ("DEF_PLVL");
echo "<br>";
echo cmsg ("DBP_21")." ";inputtxt ("encode",15);echo "<br>";

  checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
  checkbox ($nodbs,"nodbs") ; echo cmsg ("NODBS")."<br>"; 
 	echo "<input type=hidden name=serv2 value=$serv2>";
	echo "<input type=hidden name=\"tableselected[]\" value=".$tableselected.">";
	echo "<input type=hidden name=dbtype value=$dbtype>";
	?> <input type=hidden name=dbselected value=<?=$dbselected?>> <?php 	 if (1==1) submitkey ("end","KEY_S_ADD");

	echo "</form>";
}


if ($end) {
	$totaltables=count ($tableselected);
	 $separator="¦";
	 	 echo " Dbscript $dbs  DB $dbtype<br>";
	 	 echo " Total tbls ".$prdbdatacnt."   adding :".($totaltables-1)." <br>";
                 if (!$prauth[$ADM][2]) { msgexiterror ("notrights"," administrator","admin.php"); ;exit;}
	 
     if ($codekey==7) { echo "This is a public demo, you cannot manual add DATABASEs or TABLES. Change type program to Demo or Standart to execute.<br>";exit;}
	 
	 
if (1==1) {lprint ("CFG_SAVE");}

	  echo "<br>";
          if ($encode=="") echo "Autodetect encoding ON.<br>";
for ($b=$prdbdatacnt-1;$b<($totaltables+$prdbdatacnt-2);$b++) {
	
	$tbl=$b;$origID=$b-$prdbdatacnt+1; 
		$namebas=$tableselected[$origID];
		if ($namebas==false) break;
		if ($namebas==array ()) break;
			$filbas=$namebas;
			//if (1==1.45)
                            if ($dbtype=="mysql") { // readdescripters partial copy
                                $servermysql=$serv2; if (!$serv2) $servermysql=$mainhostmysql;// юзаем main
                                $connect=dbs_connect ($servermysql,$sd[14],$sd[17],$dbtype);
                               if ($debugmode) echo "$connect=dbs_connect ($servermysql,$sd[14],$sd[17],$dbtype);";
                                //if (($ADM==0)AND(!$connect)) $silent=0;// на php 4 без авторизации окно не видно :(
                                //if (!$silent)if (!$connect) msgexiterror ("SQLdown",$prdbdata[$tbl][6],"admin.php");
                                dbs_selectdb ($dbselected, $connect,$dbtype);
                                if ($debugmode) echo "mysqli_select_db ($dbselected, $connect);;"; // блядство какое то , только сделал и все работало,  и вдруг неожиданно эта строка во всем виновата"!!!!
                                $listfields=@dbs_list_fields ($dbselected,$tableselected[$origID]); // а как обычно FS не работает с долбаной кириллицей. значит все в порядке. стандартный заёб. никто не будеттаблицы в кириллице называть
                                 if ($debugmode)echo " $listfields=dbs_list_fields ($dbselected,$tableselected[$origID])origID]=$origID];";
                                
                                $mycols=@dbs_num_fields($listfields); // кол-во полей с результата
                                if ($encode=="") $thistableencode=detectmysqlencoding ($dbselected."`.`".$tableselected[$origID],$connect);
                                if ($thistableencode=="utf8") $thistableencode="utf-8";

                               unset ($datafield);unset ($screenfield);unset ($namefield);
                                for ($d=0;$d<$mycols;$d++) {  
                                    $res1=dbs_field_name($listfields,$d); // потом доделать определение типа поля,  все работает!
                                    if ($d==1) $type1=dbs_field_type($listfields,$d); // потом доделать определение типа поля,  все работает!
                                  // ..юю  echo "$res1,";

                                  //setting for MaNGOS, Trinity 
                                    if($res1=="data") { $datafield=$d; echo " applied data, "; }
                                    if ($d==1) if(($type1=="int")or($type1=="real")) { $virtualidfield=$d; echo " applied ID2 ($type1), "; } //15
                                    if($res1=="displayid") { $screenfield=$d; echo " applied scr, "; }
                                    if($res1=="visualid") { $screenfield=$d; echo " applied scr, "; }
                                    if($res1=="title") { $namefield=$d; echo " applied title, "; }
                                    if($res1=="name") { $namefield=$d; echo " applied name, "; }
                                }
                            }
			$additiondbs=184; //DBP_10 - поле name определается 
			for ($c=0;$c<(18+$additiondbs);$c++) { $prdbdata[$tbl][$c]=0;};
			if (!$nodbs) { $prdbdata[$tbl][0]=$dbselected.".".$filbas;			$prdbdata[$tbl][1]=$dbselected.".".$namebas;};
			if ($nodbs) { $prdbdata[$tbl][0]=$dbselected.".".$filbas;			$prdbdata[$tbl][1]=$namebas;};
			$prdbdata[$tbl][5]=$namebas;
			$prdbdata[$tbl][6]=$mainhostmysql; //default host using
			$prdbdata[$tbl][9]=$dbselected;// default DATABASE using!!!!!!!!!!
			$prdbdata[$tbl][10]=1;		//name
                        $prdbdata[$tbl][15]="";		//id2
                        if ($virtualidfield) $prdbdata[$tbl][15]=$virtualidfield;
                        if ($namefield) $prdbdata[$tbl][10]=$namefield ;//namecorrect
                        if ($datafield) $prdbdata[$tbl][18]=$datafield ;//namecorrect это не создает никакой записи в Headers таблицы. она делается не тут.
                        if ($datafield) $prdbdata[$tbl][20]="SPC" ;
                        if ($screenfield) $prdbdata[$tbl][2]=1;//namecorrect
                        if ($screenfield) $prdbdata[$tbl][3]=".jpg" ;//namecorrect
                        if ($screenfield) $prdbdata[$tbl][8]=$screenfield ;//namecorrect
                        $prdbdata[$tbl][11]=0; //code \ ID
                        $prdbdata[$tbl][21]=$encode; if (($encode=="")or($encode=="auto")) $prdbdata[$tbl][21]=$thistableencode; unset ($thistableencode);
			if (1==1) {
				//if ($dbtype=="mysql") $prdbdata[$tbl][12]="mysql";
				//if ($dbtype=="fdb") $prdbdata[$tbl][12]="fdb";
                               $prdbdata[$tbl][12]=$dbtype;
			}	
			$prdbdata[$tbl][13]=($groupplevels+1);// права записи
			$prdbdata[$tbl][14]=$groupplevels;// права чтения
			if ($pr[38]) {$prdbdata[$tbl][17]=$prdbdata[$tbl][9]; //gruppirowka
			if ($dbtype=="fdb")$prdbdata[$tbl][17]="fdb";
			}
			
			if ($OSTYPE=="LINUX") {
				$countprdbdatanowmax=count ($prdbdata[$tbl]);
				$prdbdata[$tbl][$countprdbdatanowmax].="\n"; //working bugfix under linux
			}
			$dbedit=1;
			if ($views) {$x=implode ($separator,$prdbdata[$tbl]);echo $x."<br>";};
}
 $lastddbaddr=count ($prdbdata);
 // echo "lastdbabbr $lastddbaddr 0 contains = ".$prdbdata[$lastddbaddr][0]."<br>"; //always empty
 //unset ($prdbdata[$lastddbaddr]); - это не здесь доб  пустая строка а в writefullcsv !!!
 
 if ($dbedit==1) {
 	echo "сохранение";
 // передается $dbs
	  $tempdescr=csvopen ("_conf/dbdata.cfg","w",1);
   	  writefullcsv ($tempdescr,$dbheader,$dbplevel,$prdbdata);
   	 $edit=0;
   	 
 }
 unset ($tempdescr,$dbheader,$dbplevel,$prdbdata);
}
 

		
		

//endcomm
?>
