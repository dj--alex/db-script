<?php
// ������ ��������� ��������� � ������ DBSCRIPT v2.1 (�) dj--alex
if ($_FILES) ob_start(); // ��������� �.�. � 2033 ������ ��������� �������� ���� ������ ��� ���
$nomnu=true;
    require_once ('dbscore.lib'); // ������� ���������� � ������ � �����������
if (!$activation) exit;

// TinyMCE addition
   ?> <script type="text/javascript" src="tinymce/tiny_mce.js"></script>
   <script type="text/javascript">

       tinyMCE.init({
               mode:"textareas",
               theme:"advanced",
               language:"ru"
           });
    </script>

<?php 
// EXTERNAL MINI EDITOR DEMO DBS
function player ($file) {
     ?><object type="application/x-shockwave-flash" data="/player/player.swf" width="" height="">
        <param name="bgcolor" value="#ffffff" />
        <param name="allowFullScreen" value="true" />
        <param name="allowScriptAccess" value="always" />
        <param name="wmode" value="transparent" />
        <param name="movie" value="/player/player.swf" />
        <param name="flashvars" value="/video/<?=$file?>.flv" />
        </object><?php }

function newswritesql ($id,$user,$plevelview,$subject,$gutentag,$video,$message,$data) {
    //// ������ - ��������� ��� � sQl ����.
	global $dbtype,$pr,$sd;
        echo "ebaat doshlo!!";
        //## ���� �� ������� ������ ������� �� ����������� ����� ����������
	     $query="SHOW CREATE TABLE `dbscriptbk`.`_dbs_".$prefix."_news43`;";
        $silent=0;$e=dbs_query ($query,$connect,$dbtype);
        if ($e==true) {$mysqlanswer=true;} else  { die ("NB_F_NEWSWRITESQL_NOT_CONNECTED.");};
        $dbtype="mysql";
        $prefix=$sd[30];
        @$connect=dbs_connect ($pr[43],$sd[14] , $sd[17],$dbtype);
        $logtype=="_dbs_".$prefix."_news43";
        $query="INSERT INTO `dbscriptbk`.`".$logtype."` (id,user,plevelview,subject,gutentag,video,message,data)VALUES ('$id','$user','$plevelview','$subject','$gutentag','$video','$message','$data') ;";
//        echo $query;
	$e=dbs_query ($query,$connect,$dbtype);
        dbserr ();
 if (!$pr[8]) echo "DEBUG $query.<br>";
	return $a;
 }
// ��� �������������� ������������ ��� ����� -  ���������� ������ ���������� �������� , � �� ��� ������!  � � ���� � � ���!
//end of duplicate mysql log

/*
if (!$action) {
    	echo "<form target=fileedit method=post>";
	hidekey("fileed",$file);
	echo "<textarea id=fileed name=vd cols=79 rows=25 >".$vd."</textarea><br>";
	submitkey ("go","SAVE");
	submitkey ("go","WF_UNDO"); echo "</form>";
}
 * */
//  COPY PAST nedit.php  4.1.117
if ($menudisable==0) {
?><form action="nedit.php" method=post>
<?php echo "ID1 ";inputtxt ("vID",30);
submitkey ("write","KEY_EDIT");
submitkey ("write","KEY_ADD");
submitkey ("write","KEY_DEL");
echo "</form>";
}

//�������� ������� �� ��������� �����   data  gutentag
$date=date("d.m.Y H:i:s");
$datesrch=date("m.Y");
$dateinunix=strdbstounixtime ($date);// ��������� ������� dbs ���� � �����
//..$dateinunix2=strdbstounixtime ("13.04.2010 10:38:53");// ��������� ������� dbs ���� � �����
//
//
//���������� ��� ����� ����
$tbl=192;//$tbl=0;
$dbtype="mysql";
$tbl=$sd[38];
$prdbdata[$tbl][6]=$pr[43];// ???
//$prdbdata[$tbl][9]="_dbs__news43";
$prauth[$ADM][39]=1;
$md2column=0;
//$oldcoreedit=$prauth[$ADM][39];
//$result=newscreatesql ();
// ��������� ���������
//
//
////  COPY PAST nedit.php  4.1.117
//������ �������
if ($write) echo '<form action="nedit.php" method=post>';
if ($write==cmsg ("KEY_EDIT")) {
	if ($vID==="") { lprint ("WF_FSELID")."<br>"; exit;};
	$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	dbs_selectdb ("dbscriptbk", $connect,$dbtype);
	$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
		if ($data==-1) exit;
                $mycolvirtualname=$data[3];if (strlen ($mycolvirtualname[0])<1) $mycolvirtualname=$mycol;
             //   echo $data[3][0];
                //print_r ($mycol);
                //$mycol=$data[0];
 /*if ($testmode===1)  {
                 $result = dbs_query ($query, $connect,$dbtype);

echo "<font class=text><table id=dbmgr_edit border=0 width=100% bordercolor=#206621 style=\" color: #".$rgbtext.";  \"  >"; echo "<tr>";
			for ($a=0;$a<$mycols;$a++)
				{
                                  //  if ($mzdata[0]==false) {echo "<td><bb>".$mycol[$a]."</bb></td>";				}
                                    while ($myrow = dbs_fetch_row ($result,$dbtype)){  // DECLINED BY FALSE RESULT
                                                $datathisline=strdbstounixtime ($myrow[5]);
                                                if ($myrow[2]>0) continue; //skip plevel >0
						if ($datathisline>$dateinunixminux15) for ($a=0;$a<$mycols;$a++){
                                                                if ($a==0) { echo "Psto $myrow[0]";}// id post
                                                                if ($a==1) { echo "" ; };// plevel ignored
                                                                if ($a==2) { echo " -=$myrow[2]=-<br>" ; };// subj
                                                                if ($a==3) { echo " Tags:$myrow[3]" ; };// tag
                                                                if ($a==4) { player ($myrow[4]);echo "<br>"; };// vid
                                                                if ($a==5) { echo "Message: (".$myrow[5]."<br>"; };// vid
                                                                if ($a==6) { echo "d" ; };// data
                                                                //if ($myrow[$a]>2) echo "<td><bb>".$myrow[$a]."</bb></td>";
                                                                                        }
                                                                                        }
                                echo "</table>";
				}
              exit;
}
*/
  
if ($prdbdata[$tbl][18]) {//dly redaktirowainya data
	echo "pdb18 ".$prdbdata[$tbl][18];
	$datacols=explode (",",$prdbdata[$tbl][18]);
$datafilehdr=explode (",",$prdbdata[$tbl][19]);
$datasplitters=explode (",",$prdbdata[$tbl][20]);
///echo "datacol ".$datacols[0]."filehdr ".$datafilehdr[0]."  datasplit ".$datasplitters[0]."<br>";

}

	$cmd="SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
        echo $cmd;
		//if (($virtualid)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
	//�������� �� ����� �� ID
	if ($myrow===false) { echo cmsg ("QUE_EMP")."<br>";		exit;	}
	@$crc=crc32(trim(implode (";",$myrow)));
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
		for ($a=0;$a<$mycols;$a++)
			{
			echo "$mycolvirtualname[$a] "; // 
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii>(ID1)</ii>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
			if ($prdbdata[$tbl][18]) for ($b=0;$b<count ($datacols);$b++) { $fil=$tbl.";".$myrow[$md2column].";;".$datacols[$b]."";
				if ($a==$datacols[$b]) {echo "<a href='nedit.php?cmd=dat&fil=$fil'><img src='_ico/linked_table-yn.png' border=0 title='".cmsg ("KEY_HEAD")."'></a>";}
			} //redaktirowanie data

					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
                       $z{$a}=$myrow[$a]; echo "<td>";
                       $myrow[1]==$prauth[$ADM][0]; //username fix
                        if ($a==6) { txtarea ("z6",$lensa,99)  ; }; //  ������ ������ ����� ��� 5 ���� - ���������.
                           if ($a!=6) {inputtext ("z$a",20,$myrow[$a]);}
                     echo "<br></td>";
			}
	if (!$oldcoreedit) { //  � ���� ����� ������. ����. ������� ������� ��� dbmgr_���������  ������ ��� ������ � ������������� ������ !! ���������� ��������� ������!
		echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";//��������� ���������� �����������.���� ������������� �� �� ����� ��� <table> � �� ����.� �� ��� ��� ������ ������.
		for ($a=0;$a<$mycols;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.   GMP_41;��������, ��������� ���������  �� lang/russian.cfg
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
			//if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";

		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE
		if ($lensa>50) $lensa=50;
                if ($prdbdata[$tbl][18]) for ($b=0;$b<count ($datacols);$b++) { $fil=$tbl.";".$myrow[$md2column].";;".$datacols[$b]."";
				//if ($a==$datacols[$b]) {echo "<a href='nedit.php?cmd=dat&fil=$fil'><img src='_ico/linked_table-yn.png' border=0 title='".cmsg ("KEY_HEAD")."'></a>";}
			} //redaktirowanie data

					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
			?>			</td>
			<?php if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.
                       $z{$a}=$myrow[$a]; echo "<td>"; //�������� ������� �������� ����� ����������� � ��� editor base
                       $myrow[1]==$prauth[$ADM][0];
                        if ($a==6) { txtarea ("z6",$lensa,99)  ; }; //  ������ ������ ����� ��� 5 ���� - ���������.
                           if ($a!=6) {inputtext ("z$a",20,$myrow[$a]);}

                     echo "<br></td>";
			//if ($a!==5) <textarea id=dbmgr_txta name=z=$a;  cols=; rows=1>=$myrow[$a]</textarea>
			//echo "<tr>";//optionalBox,not linear edit.  ��� ID ������ ���� ��� ����� ������, �.�. ��������� ����� ���� 1000�
			// �������� ����� ���� trafeconom mode  �������� ����� ������ ����� ���������� �����.

			} //field text

			echo "</table>"; // ����� ���������� ������� ��� dbmgr_edit
	}
	// �������� ���������
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
	// ��������� �������� ���������

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
//������  ���������
if (($write==cmsg("KEY_S_EDIT"))AND(1==1)) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();
	// ������� vID -> $myrow[$md2column]   myrowid->$myrow[$virtualid]
// ������ ���� ���������� � values � myrow[]
		for ($a=0;$a<$mycols;$a++)	{
	$myrow[$a]=${"z".$a};
	if ($a===0) { $values="'".$myrow[$a];}
	if ($a>0) {$values="".$values."','".$myrow[$a]; }
			}
			$values=$values."'";
// ������ ���� ���������� � values � myrow[]
// ������ ���������� ���� ���
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
				// ����� ��� ��������� ���� ��� �� �����������������?
}
//����� ���������� ���� ���
	//�������� ������ ������ ��� CRC i UnDO
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$myrow[$md2column]."'";
	if ($virtualid==true) { $addcmd=" AND ".$mycol[$virtualid]."= '".$myrow[$virtualid]."'"; $cmd.=$addcmd;};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrowold = dbs_fetch_row ($result,$dbtype);
	if ($myrowold==false) {lprint ("WF_EDITNOTADD");echo "<br>";
	//��������� undo ������� ID
		$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
		if ($virtualid==true) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$origid2."'";};
		$result=dbs_query ($cmd,$connect,$dbtype);;
		$myrowold=dbs_fetch_row ($result,$dbtype); // ��� false ���� �� ������ ��� :)
	}
	@$olddata=implode (";",$myrowold); // ��� ��� � ���� ��������� � ����������
	$undodata=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrowold,$mycols);
	if (!$crcignore) {
				@$crcnew=crc32(trim($olddata));
				if ($myrowold!==false) if ($crcnew!=$crc) {lprint ("WF_CRCFAIL"); exit;} ;}; //crc32testfunction

	// ������ ������� �� 3.2.6 ++ $mycol[$md2column]."='".$vID."'";
	// ����� ��������� ������  - ������������� 0 �������� ������
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$myrow[$md2column]."'";
	if ($virtualid==true) {  $cmd.=$addcmd;};

		$cmd2="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE  ".$mycol[$md2column]."='".$origid1."'";
	if ($virtualid==true) { $cmd2=$cmd2." AND ".$mycol[$virtualid]."= '".$origid2."'";};
	// ��� �������� ������� ID ���� ���


	$a=dbs_query ($cmd,$connect,$dbtype);  // ������� ���������
	if (!$pr[8]) {echo "DEBUG ������� ��� $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}
	$a=dbs_query ($cmd2,$connect,$dbtype);  // ������� ���������
	if (!$pr[8]) {echo "DEBUG ������� ��� $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_DELOK")."!<br>";} else { echo cmsg ("WF_DELFAIL")."$myrow[0]<br>";}


	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	$a=dbs_query ($cmd,$connect,$dbtype);//������� ����� ���-��
	$cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	if ($enfreez) {
		if (($codekey==9)or($codekey==7)) demo ();
				$afile="_conf/autoexec.sql";		 $autoexeccmd=$cmd."; #".$prauth[$ADM][0]."\r\n";
				$f=fopen ($afile,"a+");
				$a=fwrite ($f,$autoexeccmd);
				if ($a) { echo "<font color=blue id=bfnt>".cmsg ("KEY_FRZD")."</font><br>";};
				fclose ($f);
				}
	if (!$pr[8]) {echo "DEBUG ������� ��� $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else { echo cmsg ("WF_ADDFAIL")."$myrow[0]<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_UPDOK")."!<br>";} else {
		$errt=cmsg ("WF_UPDFAIL"); $ermsg="$myrow[0]<br>";}
	if ($pr[12]) {$act="EDIT_SQL  B $tbl($nametbl) Find$vID Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
            logwrite ($act) ;undolog ($act,$undodata,$baseID,$hostIP); };
	//if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// ����� ������ � �� ���  � ��� �� ����������
submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//infa  DISTINCT - ��������� ���������

//=========================================
//������ �������
if (($write==cmsg ("KEY_ADD"))AND(1==1)) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
		if ($data==-1) exit;
	if ($data==-1) exit;
                 $mycolvirtualname=$data[3];
                
	$maxquery="SELECT MAX(`".$mycol[$md2column]."`)FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`";
	$result = dbs_query ($maxquery,$connect,$dbtype);;	$maxtbl = dbs_fetch_row ($result,$dbtype);
	echo cmsg ("WF_1NOTUSED").": ".($maxtbl[0]+1)."<bR>";
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
	//if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
	$myrow = dbs_fetch_row ($result,$dbtype);
        
//�������� �� ����� �� ID
	if ($myrow===false) {
		echo cmsg ("QUE_EMP")."<br>";
		$myrow[$md2column]=$vID;
		//if (($virtualid>0)AND ($vID2!=="")) $myrow[$virtualid]=$vID2;
	}
//end �������� �� ����� �� ID
	$oldcoreedit=$prauth[$ADM][39];
	if ($oldcoreedit)
	for ($a=0;$a<$mycols;$a++)
			{
			echo "$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii>(ID1)</ii>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii>(ID2)</ii>";
                       $z{$a}=$myrow[$a];
                       if ($a==7) { $value=$dateinunix;echo "($date)";};
                              echo "<td>";
                        if ($a==6) { txtarea ("z$a",$lensa,1)  ; }; //  ������ ������ ����� ��� 5 ���� - ���������.
                           if ($a!=6) {inputtext ("z$a",$lensa,$value);}
                     echo "<br></td>";
			}
	if (!$oldcoreedit) { echo "<table id=dbmgr_edit border=3 width=100% bordercolor=#602621>";
		for ($a=0;$a<$mycols;$a++)
			{ //hdr text
	if ($prauth[$ADM][41]) echo "<tr>";//optional   Box,not linear edit.
			echo "<td>$mycolvirtualname[$a] ";
			if ($mycol[$md2column]===$mycol[$a]) echo "<ii><bb>(ID1)</ii></bb>";
			if ($mycol[$virtualid]===$mycol[$a]) echo "<ii><bb>(ID2)</ii></bb>";

		$lensa=strlen ($myrow[$a])+2;// CFG OPT FUTURE
		if ($lensa>50) $lensa=50;
					if ($a===0) { $values="'".$myrow[$a];} 				// self-control
					if ($a>0) {$values="".$values."','".$myrow[$a]; }	//self-control
			?>			</td>
			<?if ($prauth[$ADM][41]) echo "</tr><tr>"; //optional Box,not linear edit.

                       $z{$a}=$myrow[$a];
                                if ($a==7) { $value=$dateinunix;echo "($date)";};
                       echo "<td>";
                        if ($a==6) { txtarea ("z$a",$lensa,1)  ; }; //  ������ ������ ����� ��� 5 ���� - ���������.
                           if ($a!=6) {inputtext ("z$a",$lensa,$value);}
                     echo "<br></td>";
			if ($prauth[$ADM][41]) echo "<tr>";//optionalBox,not linear edit.
		} //field text
		echo "</table>";
	}
			echo "";
   checkbox ($views,"views") ; echo cmsg ("WF_LOG")."<br>";
	submitkey ("write","KEY_S_ADD"); echo  "<br>";
}


//=========================================

//������ ���������
if (($write==cmsg ("KEY_S_ADD"))AND(1==1)) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();

// ������ ���� ���������� � values � myrow[]
			for ($a=0;$a<$mycols;$a++)
			{
	$myrow[$a]=${"z".$a};
	if ($a===0) { $values="'".$myrow[$a];}
        //if ($a==7) {$values="".$values."',NOW().'"; continue;}
	if ($a>0) {$values="".$values."','".$myrow[$a]; }
			}
			$values=$values."'";
// ������ ���� ���������� � values � myrow[]
//��� ���� �� undo
	$cmd="INSERT INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	$a=dbs_query ($cmd,$connect,$dbtype);//������� ����� ���-��
	$cmd="REPLACE INTO `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` VALUES ($values)";
	if (!$pr[8]) {echo "DEBUG ������� ��� $a<br>";}
	if ($a==true) { echo $myrow[0].cmsg ("WF_ADDED").".<br>";	if ($views) echo cmsg ("WF_EXQUE")."$cmd<br>"; } else 	{
		$errt=cmsg ("WF_ADDFAIL"); $ermsg="$myrow[0]".cmsg ("WF_ADDPRS")."<br>";}
	$undodata="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$vID."'";
	//if (($virtualid>0)AND ($vID2!=="")) { $undodata=$undodata." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	if ($pr[12]) {$act="ADD_SQL  B $tbl($nametbl) Find$vID Cmd $cmd";
            $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];
            logwrite ($act) ; undolog ($act,$undodata,$baseID,$hostIP);}; // ����������
	 //executing+errlog������ ���������� ��������� ������  ��� ������ ���� ������
	 	     //if ($views) echo cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();// ����� ������ � �� ���  � ��� �� ����������
submitkey ("write","WF_UNDO_LAST");
//endof executing
}


//=========================================
//������ �������
if (($write==cmsg ("KEY_DEL"))AND(1==1)) {
	if (($virtualid==true)AND($vID2==false)) echo "<font color=red id=errfnt>".cmsg
		("WF_DEL_GROUP")." ".$vID." </font><br>";
		if ($vID==="") { lprint ("WF_FSELID");exit;};
                hidekey ("vID",$vID);
		submitkey ("write","KEY_S_DEL");
}



//=========================================
//������ ���������
if (($write==cmsg("KEY_S_DEL"))AND(1==1)) {
	@$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
	@dbs_selectdb ($prdbdata[$tbl][9], $connect,$dbtype);
	$data=readdescripters ();// ��������� ������ ��������� ������ mycol ���-�� mycols
		if ($data==-1) exit;
	$cmd="SELECT * FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."` WHERE ".$mycol[$md2column]."= '".$vID."'";
        echo $cmd;
	//if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	$result = dbs_query ($cmd, $connect,$dbtype);
    for ($c=0;$myrow = dbs_fetch_row ($result,$dbtype);$c++) {
		if (!$test) $test=$myrow[0];
		$undodata.=gencmdlog ("`".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`",$myrow,$mycols)." ";
	};
	// ��� ���� �� undo
	$a=$test;
	$cmd="DELETE FROM `".$prdbdata[$tbl][9]."`.`".$prdbdata[$tbl][5]."`  WHERE ".$mycol[$md2column]."='".$vID."'";
	//if (($virtualid>0)AND ($vID2!=="")) { $cmd=$cmd." AND ".$mycol[$virtualid]."= '".$vID2."'";};
	dbs_query ($cmd,$connect,$dbtype);
	if (!$pr[8]) {echo "DEBUG ������� ��� $a<br>";}
	if ($a==true) { echo $vID.cmsg ("WF_DELOK")."!<br>";} else {
				$errt=cmsg ("WF_DELFAIL"); $ermsg=cmsg ("WF_NOQUE")."<br>";}

   if ($pr[12]) {$act="DEL_SQL  B $tbl($nametbl) Find$vID Cmd $cmd";
       $baseID=$tbl;$hostIP=$prdbdata[$tbl][6];logwrite ($act) ;
     undolog ($act,$undodata,$baseID,$hostIP);
};  //

 //if ($views) cmsg ("WF_EXQUE")."$cmd<br><br>";
 echo cmsg ("WF_QUECOMP").dbs_affected_rows ().cmsg ("WF_Q1")."<br>";
$silent=0;$errno=dbserr ();
//endof executing

submitkey ("write","WF_UNDO_LAST");

}

//END COPY PAST





if ($write) echo "</form>";




function newscreatesql () {
    global $pr,$sd,$debug;
    if (!$pr[82]) return false ;         // CFG OPT FUTURE disables script using checklogssql
    //if (!$pr[43]) {
        if ($debug) { errorlog ("DEBUG checklogsql:Connection failure. Default host not set or SQL off. trying 127.0.0.1.");       $pr[43]="127.0.0.1";        }
$dbtype="mysql";
    	@$connect=dbs_connect ($pr[43],$sd[14] , $sd[17],$dbtype);
        dbs_selectdb ("dbscriptbk", $connect,$dbtype);
	if ($connect==false) {  errorlog ("DEBUG checklogsql:Connection failure. Default host lost. $pr[43]");return false;}
        $mysqlanswer=1;
        $prefix=$sd[30];
        $tablename="_dbs_".$prefix."_news43";
        $query="SHOW CREATE TABLE `dbscriptbk`.`_dbs_".$prefix."_news43`;";
        $silent=0;$e=dbs_query ($query,$connect,$dbtype);
        if ($e==true) $mysqlanswer=true;
        if ($e==false) { echo "initalizing tables..._dbs_".$prefix."_news43 ...";
        	$query="CREATE DATABASE IF NOT EXISTS `dbscriptbk`;";
	$a=dbs_query ($query,$connect,$dbtype);
        if ($a==false) sqlerr ();
	$query="CREATE TABLE $tablename ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `user` int(10) unsigned NOT NULL DEFAULT '0', `plevelview` int(2) unsigned NOT NULL DEFAULT '0', `subject` text NOT NULL, `gutentag` text NOT NULL, `video` text NOT NULL, `message` text NOT NULL, `data` timestamp NOT NULL default CURRENT_TIMESTAMP,PRIMARY KEY (`id`) )		;";
	$a=dbs_query ($query,$connect,$dbtype);

        if ($a==false) { sqlerr (); $mysqlanswer=false;} else {$mysqlanswer=true;};
        // �������� ������ ���� ������������ ����� �������� ����� �������� � ��� ����- ����������� �������� ������ � �.�. ���� ����������� CFG OPT FUTURE
## end of creating tables
        }
        return $mysqlanswer;

}

?>