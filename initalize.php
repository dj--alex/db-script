<?php
require_once ('dbscore.php');
//$script="login.php";
 if ($pr[36]=="on")  { 
 	$script="disable";
if (!isset($_SERVER['PHP_AUTH_USER']) ||
     ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
   authenticate();}  
 };
 
if ($pr[36]!=="on") if (!isset ($_SERVER['PHP_AUTH_USER']))  msgexiterror ("anonymous",0,"disable");
 
if (($_SERVER['PHP_AUTH_USER']=="UNKNOWN")OR($_SERVER['PHP_AUTH_USER']=="anonymous")OR($_SERVER['PHP_AUTH_USER']==false)) msgexiterror ("notuser",0,$script);

 
?>
