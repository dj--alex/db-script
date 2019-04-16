<?php// ������ ����� � ��������������� �� �������
 ?>  
 <form action="r.php" method="post">
<input type=text name="vID" size=80 value="<?=$vID; ?>" ></input>
<?php hidekey ("vID2",$vID2);//<CENTER>
hidekey ("tbl",$tbl); 
hidekey ("intf","master-mode");
 hidekey ("mode",$mode); 
    hidekey ("printlimit",$printlimit) ;
	 hidekey ("field",$field); 
	hidekey ("selectenable",0); 
	hidekey ("limitenable",0); 
	hidekey ("kol",$kol);
	hidekey ("groupdb",$groupdb);
        hidekey ("ipfilter",$ipfilter);
        hidekey ("page",$page);
	hidekey ("live",$live);
 submitkey ("write","SEARCH");
 
	 if ($pr[17]) {	submitkey ("go","BROWSE");	}
	 if ($pr[52]) { submitkey ("go","BEST");	}//����� 5 - ������ - ���� �� ����� ��� RF - ��������  UnUSED
	 echo "<br>";
	 	 hidekey ("adm",$adm);
	 $defselect=$pr[15];
 
if (($adm==1)OR($defselect==0))
	{
if ($pr[19]) $mode15=7;
//��� ��-����� ������ ����� ���� ��� ������.  $prauth[$ADM][21]+8=29 � ����� ������ �����.<bb></bb>
// ����� - ��������� ���� ����� ��� ���������  �����������  �������� ������  �����������  5 ����������
// ��������� ������ ����������� �����������  - 
// ����� ���� ������ ����� �� �������� ��������� ����������� ���������  ���� �� �������� ����� default - 
// ����� ��������� ��� �����������    1 ����������
$sel=array();$sel[$mode]=" selected ";
if ($mode==9) $sel[3]=" selected "; //�������� ��� � �������������
print cmsg (SRCH_TP).":<select name = mode size = ".$mode15.">";
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
if ($prauth[$ADM][20]==1)
		{
			
	checkbox ($limitenable,"limitenable");  // lchk ��� ����?
	lprint ("RF_PRINTLIM"); ?>
	<textarea name=printlimit cols= 5 rows=1 wrap=virtual><?=$printlimit; ?></textarea>
<?} // ����� �������� ��������������� ����������
 }
if (($adm==0)AND($defselect>0)) hidekey ("mode",$defselect);
// ���� ���� ���� �� ���������

if (($readfile)AND($prauth[$ADM][19])) {
	checkbox ($selectenable,"selectenable");  //schk ��� ����?
		$data=readdescripters ();
		$a=prefixdecode ($res16);
   decodecols ($res16);	lprint ("RF_SORT"); 
    printfield ($data,"field"); 

}

if (($field!="")AND($selectenable)) if (array_search ($field,$data[0])==false) {echo "READ:Sort link wrong<br>";$field="";}

//print_r($data[0]);
//echo "efrgergerger ".$field."===".$data[0]."br<";
//��������� fieldlist

//hidekey ("kol",$kol);  no effect
// ����� ������� ��� ������
if (($readfile)AND($prauth[$ADM][25])) {
	//checkbox ($selectenable,"selectenable");  //schk ��� ����?
		$data=readdescripters ();
		$a=prefixdecode ($res16);
   decodecols ($res16);	lprint ("FOR_SEL"); 
   $field=$kol;//echo "(field=$kol ";
    printfield ($data,"_kol"); 
}

//echo "kol=$kol  data0=";print_r ($data[0]);
if (($kol!="")AND($mode==7)) if (settype ($kol, integer)==false) {echo "READ:Select column with name wrong, need number<br>";$kol="";}
///if (($kol!="")AND($mode==7)) if (array_search ($kol,$data[0])==false) {echo "READ:Select link wrong<br>";$kol="";}  // for name reserved

	echo "<br>";hidekey ("commode",0); 
	hidekey ("review",0); 
	hidekey ("live",$live); 
	//hidekey ("kol",$kol); // ne ubiratx!!!! ne!!! b rab poisk
	hidekey ("multisearch",0); 

if (($pr[9])or($adm==1)) { checkbox ($commode,"commode"); lprint ("RF_NOCOMM");}// cchk?
if (($pr[33])or($adm==1)) { checkbox ($fullfield,"fullfield"); lprint ("RF_FULFLD"); }// fchk?

if (($pr[13])or($adm==1)) if (!$pr[14]) { checkbox ($review,"review"); lprint ("RF_REV");}
if ($pr[14]) hidekey ("review",1); // �chk?


if (($pr[22])or($adm==1)) if (!$pr[23]) { checkbox ($multisearch,"multisearch"); lprint ("RF_MSRCH"); } // mchk?
if ($pr[23]) hidekey ("multisearch",1); 
//

if ($readfile==false) {

$deftbl=$pr[16]; 
if (($adm==1)OR($deftbl==="")) {
	echo "<br>";
	printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbl",lprint ("SELLINK"),$groupdb,$ipfilter,6); //NO Master mode
	//submitkey ($write,"A_USRGO"); �� �����! :) 
	
}
if (($adm==0)AND($deftbl>0)){ hidekey ("tbl",$deftbl); }
if (($adm==0)AND($deftbl==="0")){ hidekey ("tbl",$deftbl);}

// SCRIPT WRITTEN BY DJ--ALEX  - DO NOT DELETE


   //hidekey ("kol",$kol);  no effect
	hidekey ("namebas",$bas); 
echo "</select>";

	}
// end if readfile
echo "</form></body>"; 
// return to readfile or getfile
