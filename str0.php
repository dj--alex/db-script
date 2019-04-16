<?// ������ ��������� ��������� � ������ DBSCRIPT v2.1 (�) dj--alex
###########################################################
#  				PAGES									  #
###########################################################
// ������ ��������� ��������� � ������ DBSCRIPT v1.8 (�) dj--alex
// ������� ��������� ��� �� ������� �����, �� ���� ����� ����� - str0 �� ������ � ����� ��� ����
// ��� ������� ������ �������� ����������� ������������ ����1 (����������� ��� dbscript)  
// ��� ���������  ��� ������� ����� ���� �� ������ � ������� �� ������� ����� ������-�� ��������

// ������ �� �������� str0.php ��� �� ���������������� � indexmenu.php, head, footer  ����

$verpages="Pages v4.2 (c) dj--alex";
$nomnu=1; //��� ���������� ������ ���������� ���� ����� �� �������������
require_once ('dbscore.lib'); // �������� ������ � �������
if ($pr[55]) { print ("Normal exit by config parameters"); exit ;}

$goo=getvar ('goo');$str=getvar ('str');

$menuexist=1;
$str0active=1;
$pageenter=getvar ('p');$pageenter++;

for ($a=0;$a<15;$a++) {
	if ($pgheader[$a]==$languageprofile) $thislanguagepagescolumn=$a;  // BUG??  � ����� ��� +1 ��� �����?
}

$x="";
if ($goo) { //$addr="str0.php?p=0".$str;   header ($addr);    ����� �������� ������ � $thislanguagepagescolumn !!!!  ��� ��� ����� ���� ����
    for ($a=0;$a<count ($pgcontent);$a++) {
    $thispagename=$pgcontent[$a][$thislanguagepagescolumn];
                       $x=detectencoding ($thispagename);//      echo "Encoded : ".$x."<br>?";
                            if (($x!=="utf-8")AND($sd[19]=="utf-8")) $thispagename=iconvx("windows-1251","utf-8",$thispagename);
                                                   $x=detectencoding ($goo);//      echo "Encoded : ".$x."<br>?";
                            if (($x!=="utf-8")AND($sd[19]=="utf-8")) $goo=iconvx("windows-1251","utf-8",$goo);
    //if ($sd[19]=="utf-8") $thispagename=iconvx("windows-1251","utf-8",$thispagename);  // ��� ����� ���� ��������� ����� ��������� � ���������� - ������������� menukey �������������
    //if ($sd[19]=="utf-8") $goo=iconvx("windows-1251","utf-8",$goo);
    if ($thispagename==$goo) { $pageenter=$a; break;};
     
$x.="cycle #=$a hdnlangname=".$pgheader[$thislanguagepagescolumn]."(pgc[a]=goo thispagename=".$thispagename."==$goo)<br>";  // ����� ������ �����?:??  ������ ����   $thispagename ="" ???
    }
}
//echo "goo=$goo";exit;

if (is_numeric($pageenter)==false) bluescreen ("$x PAGES:GIVEN_STRING_BUT_REQUIRES_A_NUMBER");  //popravil ujazvimosts

//echo "111111111111111111111111111111111111thislanguagepagescolumn$thislanguagepagescolumn"; exit;

$startedbypage=$pgcontent[$pageenter][0];   $module1=$pgcontent[$pageenter][1];//  guid,  str1
$module2=$pgcontent[$pageenter][2];			$pagedisplayname=$pgcontent[$pageenter][3];// str2    rus kom
$exchange=$pgcontent[$pageenter][4]; // ���������� ������ ��� �������� 0 - net
$pagetextname=$pgcontent[$pageenter][5];// rus kom
$pageredirectto=$pgcontent[$pageenter][6];//  0 - no  1 - yes, for itself  other - redirect to concrete page
$pageredirecttime=$pgcontent[$pageenter][7];// $pagetextname=$pgcontent[$pageenter][8];// rus kom
 //8 , 9 ,10 reserved for  Deus Modus menu
$loadpage=$module1;
if ($exchange==1) {
	// ������ �� �������� �������������� ������ ����� ���������� ������			//$redirect=$pageslist[$a] ;// echo $pageslist[$a];
	$loadpage=$module2;			##strdefault1;module1;module2;screen1;exhange(On\Off);
	} else { $loadpage=$module1 ;};

if ($activation==false) $loadpage="login.php";// ������ ��� ����������������
//���� �� ������� ��� ������ - ��� ���������� ��������� ��������� �� ������ ��� ���������� �� �����������  �� ���������� ������.
//����� ������ - ��� ������ ������������� ������� .
//endif
if (($p>70)OR($p<0)) {bluescreen ("PAGES:INCORRECT_ZONE_ID<br>".($pageenter-1)." <br>");exit;}

if (strlen ($loadpage)<1) {bluescreen ("PAGES:UNDEFINED_PARAMETER_SELECT<br>");exit;}
if ($codekey==-1) {bluescreen ("Technical problem in a site");exit;}
if (($pageredirectto!=="")AND($pageredirectto!==0)) {
if ($pageredirectto==1) { $pageredirectto=""; };
echo "<META HTTP-EQUIV=refresh content=".$pageredirecttime."; URL=".$pageredirectto."></META>";
}

$wopros=strpos ($loadpage,"?");
$realloadpage=substr ($loadpage,0,$wopros);
$realloadpage=trim ($realloadpage);
$test=fopen ($realloadpage,"r") ;
$test2=fopen ($loadpage,"r") ;
if (($test2===false)AND($test===false)) { $resload=true;};
//echo "<frameset><frame src=indexmenu.php name=mainFrame scrolling=NO noresize > </frameset>";exit;};
 fclose ($test);
 @fclose ($test2);

 if ($resload==true) {bluescreen ("PAGES:NOT_FOUND<br>$loadpage<br>");exit;}
 
 // ��� ��� ������ ������ ����� :) 
 if (($codekey<0)) { echo "<frameset><frame src=indexmenu.php name=mainFrame scrolling=NO noresize> </frameset>";exit;};
 //blue screen end
 $frameoldcore=0; //CFG OPT FUTURE
 if ($frameoldcore==1) { // �� ������������ 
 	?>
<frameset rows="*" COLS="18.5%, 85%" framespacing="0" frameborder="NO" border="0">
  <frame src="indexmenu.php" name="mainFrame" scrolling="NO" noresize>
<frame src="<?php echo $loadpage; ?>" name="rightFrame">
</frameset>
<noframes><body>��� ������� �� ������������ ������. �������� ���.</body></noframes>
<?php  }
  if ($frameoldcore==0) {  // ���� ��������
  	$menuloaded=1;ob_flush ();
?>
<div id="menu2" style="position:absolute; width: <?=$pr[44] ; ?>; z-index:0; left: 0px; top: 0px;">
<?php require_once("indexmenu.php");
?></div>
<div id="module2" style="position:absolute; z-index:0; left: <?=$pr[44]+2 ; ?>px; top: 0px; background-color:<?=$rgbfon ; ?>; ">
<?php 
if ($wopros) { //parsing ? data
	$zapros=substr ($loadpage,$wopros+1);
	$loadpage=substr ($loadpage,0,$wopros);
	$zaprosy=explode ("&",$zapros);
	for ($z=0;$z<count ($zaprosy);$z++) {
		//echo "zaprosy=$zaprosy[$z]<br>";
		$zx=explode ("=",$zaprosy[$z]);	
		//echo "zx=$zx";
		$varname=$zx[0];$vardata=$zx[1];
		//echo "final=$varname}=$vardata;";
		//echo "peremen  $$varname=$vardata";// ������ ����������
		${$varname}=$vardata;
		//echo " check var =(".${$varname}.")<br>";
		}
	
	//echo "lp=$loadpage z=$zapros ;";
}
if ($redir) $loadpage=$redir;
/*if ($pr[51]) {  
	$a1=(strrpos ($loadpage,"admin"))+(strrpos ($loadpage,"edit"))+(strrpos ($loadpage,"login")) ;
	if ($a1) { lprint (OVERLOAD);exit ;}
}
*/

require_once("$loadpage");
?>
</div>
<?php   }
  
  ?>
</html>

