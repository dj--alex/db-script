<?php
$stx = $REMOTE_ADDR ;$st = substr ($stx,0,7);
$exitpoint="exitpoint";

$verlogin="Login manager 4.0 (c) dj--alex";
$enterpoint=$verlogin;
 require_once ('dbscore.lib'); // ������� ���������� � ������ � �����������
// ������ ��������� ��������� � ������ DBSCRIPT v2.1 (�) dj--alex
if ($prauth[$ADM][2]==false) echo "<br>";
if ($prauth[$ADM][0]=="UNKNOWN") echo "<br><br><br><br><br><br><br><br><br><br>";
if ($activation==false) echo "<br><br><br><br><br><br><br><br><br><br>";
if ($demo) $serial="demo";
if ($publicdemo) $serial="publicdemo";
if ($test) $serial=$testenable;

 if (isset($_FILES["userfile"])) { //��������� ��������� ���� //��� ���������� , � �� ����... ��� ��������� � ����� ��� 
//	if ($go=="Send key") { //��������� ��������� ����
		$uploaddir= "_conf";
		if ($size>700) { echo "�������� hardcoded ����� � 300bytes";exit;};
if (uploadfile ($uploaddir,"add.key")) { lprint ("FS_FWR"); } else { lprint ("FS_FWRFAIL"); } 
//echo "2userfile=$userfile  go=$go path=$path (disabled) ";
Header("Location: login.php");//��������� ��� � ������ �����������.  �� ���������� ������ �������� ���� ����� �� �������

    }
    

    
    
if (($prauth[$ADM][2]==false)AND(($prauth[$ADM][11]))) {lprint ("A_LOG_BAN");
?><form action="login.php" method="post"> <?php submitkey ("resetcookie","LOGOUT");
 echo "</form>";
exit;}  

//
 if ($pr[36]=="on")  { 
if (!isset($_SERVER['PHP_AUTH_USER']) ||
     ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
   authenticate();}  
 };
 
	 if (($pr[36]=="on")AND($ADM==0)) { lprint ("LG_OFF");   exit;};
$p=1;
       print "<h".$sd[3].">";
// LIMITATIONS
$gmlimitcfg=0;
if ($loginstate) if ($ADM==0) {msgexiterror ("notuser",0,"login.php");}// -inc pass or login

If (($_COOKIE['dbsa'])AND($ADM===0)) { echo "Your login as anonymous." ;
?><form action="login.php" method="post"> <?php submitkey ("resetcookie","LOGOUT");$anprinted=1;
 echo "</form>";

echo "<table border=0 ><tr><td>";pictogramm("search.png","getfile.php",cmsg ("MNU_3"));
echo "<td>";echo "<td>";pictogramm("key1.png","filemgr.php",cmsg ("MNU_7"));
echo "<td>";pictogramm("temp.png","r.php?viewid=.ver&base=0",cmsg ("MNU_4"));
echo "</tr></table>";

exit;}  

If (($dbsa)AND($ADM===0)) { echo "Your login as anonymous." ;
?><form action="login.php" method="post"> <?php if ($anprinted==false) submitkey ("resetcookie","LOGOUT");
 echo "</form>";
echo "<table border=0 ><tr><td>";pictogramm("search.png","getfile.php",cmsg (MNU_3));
echo "<td>";echo "<td>";pictogramm("key1.png","filemgr.php",cmsg (MNU_7));
echo "</tr></table>";
exit;}  

##������ �������� ���������
dmck ($serial);  // �������� ���� ��� ���� ������ ���� ������ ������������.  �������� � 3.5.61
	
	



 $codekey2=loadserial ();
if ($codekey2) {	$codekey=$codekey2; $activate=true;}

##����� �������� ���������
// ��� ������� HTML ���� ��������� ������ �� ��� ��������, ����� � ������ ������ ����������� ���� �� ������������.
// ��� ���� ���� ����� ��� ������� �������

if ($activate==false) {?><STYLE TYPE="TEXT/CSS">
<!--
body{
	overflow: auto;
}
td {
	font: 11px tahoma, verdana, arial;
	cursor: default;
}
inputx, selectx, divx {
	font: 11px times new roman, verdana, arial;
}
input.textx, selectx {
	width: 100%;
}
fieldset {
	margin-bottom: 10px;
}
-->
</STYLE>
<script language="JavaScript" type="text/JavaScript">
</script>
<link href="style.css" rel="stylesheet" type="text/css">
<div id="Layer1" style="position:absolute; width:400px; height:115px; z-index:1; left: 141px; top: 148px;" class="author_text">
<FIELDSET>
<LEGEND><img src=_ico/keyact.png></img></LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<form action="login.php" method="post">
<TD WIDTH=41%><?php lprint ("ACT_CODE") ?>:</TD>
<TD WIDTH=59%><?=genactcode (); ?></TD>
</TR>
<TR>
<TD><?php lprint ("S_N_ENT") ?>:</TD>
<TD><INPUT NAME=serial TYPE=text CLASS=text></TD>
</TR>
</TABLE><CENTER>
<?php 
submitkey ("check","CHECK");
if ($OSTYPE=="WINDOWS") submitkey ("demo","DEMO");
if ($OSTYPE=="LINUX") submitkey ("demo","2DBS_");
if ($testenable) submitkey ("test","TEST");
submitkey ("publicdemo","7DBS_");
echo "</CENTER></form></FIELDSET></div>";
exit;}


// ������ ����
if (($prauth[$ADM][0]==false)OR(!$ADM)) {?><STYLE TYPE="TEXT/CSS">
<!--
body{
	overflow: auto;
}
td {
	font: 11px tahoma, verdana, arial;
	cursor: default;
}
inputx, selectx, divx {
	font: 11px times new roman, verdana, arial;
}
input.textx, selectx {
	width: 100%;
}
fieldset {
	margin-bottom: 10px;
}
-->
</STYLE>
<script language="JavaScript" type="text/JavaScript">
</script>
<link href="style.css" rel="stylesheet" type="text/css">
<div id="Layer1" style="position:absolute; width:200px; height:115px; z-index:1; left: 311px; top: 158px;" class="author_text">
<FIELDSET>
<LEGEND><img src=_ico/key.png></img></LEGEND>
<TABLE WIDTH=100% BORDER=0 CELLSPACING=0 CELLPADDING=2>
<TR>
<form action="login.php" method="post">
<TD WIDTH=41%><?php lprint ("A_USR_LG") ?>:</TD>
<TD WIDTH=59%><INPUT NAME=dbs_log TYPE=text CLASS=text></TD>
</TR>
<TR>
<TD><?php lprint ("A_USR_PS") ?>:</TD>
<TD><INPUT NAME=dbs_psw TYPE=password CLASS=text></TD>
</TR>
</TABLE><CENTER>
<?php 
checkbox ($forever,"forever"); lprint ("LOG_FOREVER");
submitkey ("loginstate","FMG_ENTER");
//submitkey ("anonymous","ANONYMOUS"); 
echo "</CENTER></form></FIELDSET></div>";
exit;}


//������ ����
##������ �������� �����
if (($dbskeystate===false)AND($addkeystate===true)) $regresult=installnewkey ($key);
if (($dbskeystate===false)AND($addkeystate===false)) $nokeys=1;// ��� ����������� �������� add.key
if (($dbskeystate===true)AND($addkeystate===true)) $regresult=addnewkey ($key);

 	if ($regresult) msgexiterror ("key",$regresult,"login.php");
##����� �������� �����



//END OF LIMITATIONS
	echo "<cite><p>".cmsg ("WELCOME!")." dbscript , {$_SERVER['PHP_AUTH_USER']}<br></cite>";   
	 if ($pr[36]=="on")  {    exit; };
	if ($prauth[$ADM][16]==0) {

//	echo "���������� �����: {$_REQUEST['OldAuth']}<br><h6>";
print "<h".$sd[3].">";
if ($helpgo=="") lprint ("HELP_HELLO");
//echo " �� ������ ��������� �������������� ������� ���� � excel ����������� ������ � ������� ��, �� ��� ��������� �������������� �� ����������� ������� ���� dj--alexyandex.ru.<br> ��������! �� �������� ������� �� ��� ID!.<br>";
} 
?><form method="post"> <?php submitkey ("resetcookie","LOGOUT");
echo "</form>";
echo "<table border=0 ><tr>";
echo "<td>";pictogramm("config.png","admin.php",cmsg ("MNU_0"));
echo "<td>";pictogramm("userprofile.png","admin.php?cmd=myprof",cmsg ("MNU_1"));
echo "<td>";pictogramm("search.png","getfile.php",cmsg ("MNU_3"));
echo "<td>";pictogramm("editor.png","w.php",cmsg ("MNU_2"));
echo "<td>";pictogramm("dblinker.png","dblinker.php",cmsg ("MNU_8"));
echo "<td>";pictogramm("filemgr.png","filemgr.php",cmsg ("MNU_7"));echo "</tr><tr>";
echo "<td>";pictogramm("version.png","r.php?viewid=.ver&base=0",cmsg ("MNU_4"));
echo "<td>";pictogramm("save_f.png","admin.php?cmd=note",cmsg ("MNU_5"));
echo "<td>";pictogramm("userinfo.png","r.php?viewid=.info&base=0",cmsg ("MNU_9"));
echo "<td>";pictogramm("test.png","admin.php?cmd=test",cmsg ("MNU_6"));
echo "<td>";pictogramm("author.png","r.php?vID=.author&base=0",cmsg ("MNU_10"));
echo "</tr></table>";


?>
<br> 
  <form method="post"> <?php submitkey ("helpgo","HELP_EDIT");
submitkey ("helpgo","HELP_ADM");
//echo "</form>";


if ($helpgo==cmsg ("HELP_EDIT")) {
	echo "<br>";lprint ("WF_HELP"); echo "<br>";
	}

if ($helpgo==cmsg ("HELP_ADM")) {
	If ($prauth[$ADM][2]==true) {echo "<br>".cmsg ("A_HLP")."<br>";	}
	If ($prauth[$ADM][2]==false) echo "<br>".cmsg ("A_HLP2")."<br>"; 
	echo cmsg ("AB_HELP");
}

if ($prauth[$ADM][2]==true)  nokeys (0);



/*
����� �� ������ ��������� ������������ ������ ���� � ����������� �� �������. ��� ��������� ����� ��� ���� � ������� �� ������� ������� �����������. ����� 1 - ����� �� ���������� ��������� �����. ����� ��������������� ��� ������, 2 - �������������� ����� ������, �������� ������ ��������������� ��� ������ �� 2 ������� �����������. 3 - �� �� , �� � 1 �������. ���� ����� ��� ������ 3
������� 0 � ����� - ���������� �������������� ���������.
��� �������� ������ ������� �������� �������� ��� ��������� � ������ ����� ��������� ������ � ������ ���� ������� ��������� ����� ���� ������ ����. ������ ������������ �� ������ ��������������� ���.
��� SQL ������ ���� ������� ����, ����� , ������ ���� ��� ���� � �������� ������������, ���� � �������. ���������� ���������� ��������� SQL.
����� ������� ��������� ��� ������� 6 � 7. C��������� �������� ����������� ����� �������� � ���� !1 ��� �����,!2 ������ ���,!3 ��� ���������,����������� ID �������. � ��������� �� ����� ����������.
*/
	//if ($pr[35]!=="on") if (($daysleft>0)AND($daysleft<10)) trial ();
	 // if (($daysleft<0)AND($daysleft!=="unlimited")) expire ();
 //$a="17.02.2009";	 $b="17.02.2008";	 if ($a<$b) echo "a menshe b";	 if ($a>$b) echo "a bolshe b";	 if ($a==$b) echo "a = b";  
//endcomm



