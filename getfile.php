<? 
//SITE UNKNOWN  PROGRAMM CREATED BY DJ--ALEX
 	global $vergetfile;	
$vergetfile="Search v4.0.97 (c) dj--alex";
	require_once ('dbscore.lib');
	if ($auth==cmsg("AUTHEN")) {
	 {
    if (!isset($_SERVER['PHP_AUTH_USER']) ||
     ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
   authenticate ();

  } 
  else {
   echo "<form action='{$_SERVER['PHP_SELF']}' METHOD='post'>\n";
   echo "<input type='hidden' name='SeenBefore' value='1' />\n";
  echo "<input type='hidden' name='OldAuth' value='{$_SERVER['PHP_AUTH_USER']}' />\n";
  echo "</form></p>\n";	
  }
	}

}
$enterpoint=$vergetfile;
If ($prauth[$ADM][4]==true) {$adm=1;} else { $gmlimitcfg=1;} ;// { $adm=$ADM;
if ($ADM<1) $adm=0;

?><CENTER> <p align="center">	<? if (!$pr[10]) { echo "<img src=_style/$sd[0] align=middle></p>"; }?>
<h<? print $sd[3]; ?>><? print "$sd[1]"; ?>
<? // MASTER MODE
$deftbl=$pr[16];

if ($pr[37]) {// analog in writefile
?><br><form action="getfile.php" method="post">
<input type=hidden name=vID value=<?=$vID; ?>></input>
	<input type=hidden name=vID2 value=<?=$vID2; ?>></input>
	<input type=hidden name=colfind value=<?=$colfind; ?>></input>
	<input type=hidden name=intf value="master-mode"></input>
	<input type=hidden name=mode value=<?=$mode; ?>></input>
    <input type=hidden name=printlimit value=<?=$printlimit; ?>></input>
    <input type=hidden name=field value=<?=$field; ?>></input>
    <input type=hidden name=live value=<?=$live; ?>></input>
    <?
	//section select group
    
	//	hidekey ("groupdb",$groupdb);print_r ($list);	//	print_r ($a);
        $grouplist=groupdbfielddetect ($prdbdata,17);// set group as field
        $groupdbthisname="groupdb";
	groupdbprint ($grouplist,"Group",$prdbdata,$tbl,$groupdb);
        
        $grouplist2=groupdbfielddetect ($prdbdata,6);// set IP as field
        $groupdbthisname="ipfilter";// in future - add this variable to f
        groupdbprint ($grouplist2,"IP",$prdbdata,$tbl,$ipfilter);// IP CFG OPT FUTURE groupdbfielddetect
//        ..print_r ($grouplist);        print_r ($grouplist2);
	submitkey ("write","SELECT");
	if ($prauth[$ADM][2]) submitkey ("live","LIVEMOD");echo "*";
	if ($live) echo "in future release!";
	echo"</form><br>";
}

 if ($pr[24]) { 
	 if (($adm==1)OR($deftbl==false)) { ?>
<form action="r.php" method="post">
	<input type=hidden name=vID value=<?=$vID; ?>></input>
	<input type=hidden name=vID2 value=<?=$vID2; ?>></input>
	<input type=hidden name=colfind value=<?=$colfind; ?>></input>
	<input type=hidden name=intf value="master-mode"></input>
	<input type=hidden name=mode value=<?=$mode; ?>></input>
    <input type=hidden name=printlimit value=<?=$printlimit; ?>></input>
    <input type=hidden name=field value=<?=$field; ?>></input>
    <input type=hidden name=groupdb value=<?=$groupdb; ?>></input>
    <input type=hidden name=ipfilter value=<?=$ipfilter; ?>></input>
    <input type=hidden name=page value=<?=0; ?>></input>
    <input type=hidden name=live value=<?=$live; ?>></input>
		 <?

        //if (($groupdb!=="Unsorted")or ($ipfilter!=="Unsorted")) зачем вообще это условие?
 printlink ($prauth,$prdbdata,$ADM,$tbl,0,"tbl",cmsg("SELLINK"),$groupdb,$ipfilter,6);
//if  printlink ($prauth,$prdbdata,$ADM,$tbl,$grouplist,"tbl",cmsg("SELLINK"),$ipfilter);
submitkey ($write,"A_USRGO");
  } ;
 if (($adm==0)AND($deftbl==true)) { ?> 
	<form action="r.php" method="post">
		<input type=hidden name=tbl value=<?=$deftbl; ?>></input>
	<? submitkey ("write","FMG_ENTER");
	 };
echo "</form>";
}; // MASTER MODE ENDS
	if (!$pr[24]) require ('readfilemenu.php');

 if ($adm==1) {
	if ($pr[11]) { echo "<br>".cmsg("GF_USRDIS_A_WARN"); }
    } else if ($pr[11]) { echo "<br>".cmsg("GF_USRDIS_U_WARN"); }
	fclose ($desc);
	showshortlog ();
 print "$sd[2]";
?>

