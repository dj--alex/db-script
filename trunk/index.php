<?	// ������ ��������� ��������� � ������ DBSCRIPT v2.1 (�) dj--alex
//header ("Location: main.php");
//$nomnu=1;
	require ('dbscore.lib'); // ������� ���������� � ������ � �����������

if ($frameoldcore==0) {require_once ("main.php");}
?>
<b><h3><font color=red><a href="login.php"><?=cmsg (ENTER); ?></b></h></a>
<br>
<?
echo "</font>".date ("d.m.Y H-i-s")."<br>";
if ($frameoldcore==1) {
	autoexecsql (0);
  if (($go=="relogin")or($add<0)) {
   if (!isset($_SERVER['PHP_AUTH_USER']) ||
     ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
   authenticate();$add++;}  else {
   echo "<form action='{$_SERVER['PHP_SELF']}' METHOD='post'>\n";
   hiddenkey ("SeenBefore",1);$go=="0";
   hiddenkey ("OldAuth",$_SERVER['PHP_AUTH_USER']);
   submitkey ("write","AUTHEN");
   echo "<br><br>���� � ��� IE �� ������� ������ � ������ ��� � ��������� ������ ��� ��������� �������.<br>";
   echo "<br>����� ������� ������ ���������� ��������� ���������� � Caps Lock<br><br>";
   echo "</form></p>\n";$add++;	
  }
}
?>

<frameset rows="*" COLS="15%, 85%" framespacing="0" frameborder="YES" border="0">
  <frame src="indexmenu.php" name="mainFrame" scrolling="NO" noresize>
  <frame src="main.php" name="rightFrame">
</frameset>
<noframes><body>��� ������� �� ������������ ������. �������� ���.
</noframes>
<?
}
?>