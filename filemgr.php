<?php
$dbdataskip=1;
require_once ('dbscore.lib'); // функция подготовки к работе и авторизации
if (!$activation) exit;
$verfilemgr="Filemgr  v 4.1.81 (c) dj--alex ";
  $enterpoint=$verfilemgr;#end of conf
// вот наша буферизация - ob_start();ob_end_flush();
autoexecsql ();// ob_flush ();exit; zdes menueshe est.
@ import_request_variables ("PG","");

//  search theme ----
 if ($pr[86]) if (($pr[87])OR($prauth[$ADM][7])){  //либо право на чтение у юзера, либо разрешение искать всем.
     //if ($searchfilenew) { echo $searchfilenew;}
     if ($searchfilenew) echo cmsg ("SRCH_FND")."<table border=3 width=100% bordercolor=#302621 >";
    // echo "filcount = $filcount <br>";
     for ($a=0;$a<$filcount;$a++) {
         $filename=basename($fildata[$a][5]);
        if ($pr[90]) if ($fildata[$a][11]) { if (($fildata[$a][9])>$maxdown) {//echo "9=".$fildata[$a][9].")>max=$maxdown filewithmaxdown=$a<br>";
                                                                               $oldmaxdown=$maxdown; $filewithmaxdown=$a;$maxdown=$fildata[$a][9] ;}}
        if (($fildata[$a][11])or($prauth[$ADM][2])) if (strpos (" ".$filename,$searchfilenew)==true) {
                        $ex=@file_exists ($fildata[$a][5]);
                        $dir=is_dir ($fildata[$a][5]);  // папок от файлов нихера не отличает !! че за
                        if (($ex)AND(!$dir)) {
                            $fsizer="[".round (@filesize ($fildata[$a][5])/1024/1024,2)."Mb]";
                         $countf++;
                     //    echo "countf=$countf<br>";
                         echo"<tr><td>".$filename."(".$fildata[$a][9].")</td><td>".$fsizer."</td>";//bgcolor=white
                         $commstr="_ico/saveme.png";//.$dbc[$md1column]// возможная ошибка - не $dbc[0] а md2column  poprawil
                         echo "<td><a target=b3 href='filemgr.php?c=".$fildata[$a][4]."'><img src=$commstr border=0 title='".cmsg ("FMG_DOWNLOAD")."'></a>";
                       if (($prauth[$ADM][2])OR($prauth[$ADM][2])) {
                      //может добавить отдельное право для редактирования ссылок и удаления слинкованных файлов? ??
                            $commstr="_ico/errorcritical.png";
                           echo "<a target=b3 href='filemgr.php?c=".$fildata[$a][4]."&d=".$fildata[$a][12]."'><img src=$commstr border=0 title='".cmsg ("PHYS_DEL")."'></a>";
                       }
                    echo "</td></tr>";
                         }
      
//     exit;
        }


     }
                 if ($searchfilenew) echo "</table>";
//echo "<br><form action=filemgr.php method=post>";lprint ("SRCH_FILE");inputtxt ("searchfilenew",30);submitkey ("start","DALEE");echo "<br></form>";

if ((!$countf)AND($searchfilenew)) { echo "</table>No one files found. Or it not allowed by hosted user.<br>";
    echo "<br><form action=filemgr.php method=post>";lprint ("SRCH_FILE");inputtxt ("searchfilenew",30);submitkey ("start","DALEE");echo "<br></form>";
 if ($pr[90]) {echo cmsg ("POP_FIL")."<table border=3 width=100% bordercolor=#302621 >";
 $fsizer="[".round (@filesize ($fildata[$filewithmaxdown][5])/1024/1024,2)."Mb]";
  echo"<tr><td>".basename($fildata[$filewithmaxdown][5])."(".$fildata[$filewithmaxdown][9].")</td><td>".$fsizer."</td>";//bgcolor=white
                         $commstr="_ico/saveme.png";//.$dbc[$md1column]// возможная ошибка - не $dbc[0] а md2column  poprawil
                         echo "<td><a target=b3 href='filemgr.php?c=".$fildata[$filewithmaxdown][4]."'><img src=$commstr border=0 title='".cmsg ("FMG_DOWNLOAD")."'></a>";
                         echo "</td></tr></table>";
            }
     exit;}
      
 }


//  Shared theme ----
 if ($coreredir=="SH_UPDD_FL")  { //not forced, not automatically  // подстройка для автопредложения share
    $cmd=cmsg ("FMG_SHARE");
    $fileforaction=$destinationfilename;
    $filesize=$filesizeinmb;
    // echo "Redirect accepted from fmgr side<br>;";
    $cmd{0}=cmsg ("FMG_SHARE");
    //$cmd{1}=cmsg ("FMG_SHARE");
    $pid=0;
 }


if (($c)OR ($f)) if ($pr[74]) { lprint ("DWN_LNK_DIS");msgexiterror ("notright","","disable");exit;}

if ($c) {  //нам пришла ссылка на файл!  возрадуемся!
    for ($a=0;$a<$filcount;$a++) {    //echo $table[$a][4]."<br>";
    if ($fildata[$a][4]==$c) { $filerealid=$a;$pathwithfile=$fildata[$a][5];$commfile=$fildata[$a][7];$hashdel=$fildata[$a][12];};    //if (==$pathandfile) lprint (FSH_EXST_AN_USR); //трёхмерный массив :))
}

if (file_exists ($pathwithfile)==false) die ("File not found.");
if ($commfile==false) {$f=$c;} else {
echo cmsg ("COMMFILE")."$commfile<br>";
 echo "<a href='filemgr.php?f=".$c."'>Download!</a><br>";
 exit;
 };


$filmsv=explode(".",$pathwithfile);
 $exts=array('gif','png','jpg'); //Возможные расширения
 if(count($filmsv)>1) if(!in_array(strtolower($filmsv[count($filmsv)-1]), $exts)) { $z=""; } else {
   $f="image";

 if (!$f) exit;

 }
}
if ($f) {  //нам пришла ссылка на файл!  возрадуемся!
    for ($a=0;$a<$filcount;$a++) {    //echo $table[$a][4]."<br>";
    if ($fildata[$a][4]==$f) { $filerealid=$a;$pathwithfile=$fildata[$a][5];$hashdel=$fildata[$a][12];};    //if (==$pathandfile) lprint (FSH_EXST_AN_USR); //трёхмерный массив :))
}


// RIGHTS пока не проверяются..чисто проврка.
//echo "будет скачан $pathwithfile <br>";
$share=$fildata[$filerealid][1];
//echo " GEN USR LINK  ".$fildata[$filerealid][2]."......".$prauth[$ADM][0]."<br><br>";
$userlist[]=$fildata[$filerealid][2];$username=$prauth[$ADM][0];
if ($share=="FMG_UNSHARE") die ("unsupported");
if ($share=="GENLNK_UNREG") $enabledownload=1;
if ($share=="GENLNK_REG") if ($prauth[$ADM][0]!=="UNKNOWN") { $enabledownload=1;}
else {msgexiterror ("notrights","F_DWN_REG You not in userlist this file! ","filemgr.php");} //msgexit update req!!!!
if ($share=="GEN_PLVL_USR") if (($fildata[$filerealid][3]+1)<$prauth[$ADM][10])  { $enabledownload=1;}
else {msgexiterror ("notrights","F_DWN_PLVL You not in userlist this file! ","filemgr.php");}
if ($share=="GENLNK_USR")  if (in_array ($username,$userlist)) { $enabledownload=1; }
else {msgexiterror ("notrights","F_DWN_USR You not in userlist this file! ","filemgr.php");}
//echo "trying ... FMG_LNK_DL ".$prauth[$ADM][0]." download file $pathwithfile)   <br>";

if (is_dir ($pathwithfile)==true) { $sharedir=1; echo "FMG_TEST: Directory mod<Br>";  };

if (($d)and($pathwithfile)and($f)) {
    if (is_dir ($pathwithfile)==true) { echo "FMG_TEST: Cannot remove dir<Br>";  exit;};
    if (($prauth[$ADM][2])AND($d)) { unlink ($pathwithfile); echo "Administrative remove file<br>";exit; }
    //echo "hashdel=$hashdel  d=$d";exit;
    if ($d==$hashdel) { unlink ($pathwithfile); echo "remove file by user<br>";exit;}  // по идее надо бы спросить удалять или нет, но мне пофиг..
}

if (!$pathwithfile) die ("File not found.");
if (!$enabledownload) die ("not allowed!!");
if (file_exists ($pathwithfile)==false) die ("File not found.");

if ($enabledownload) { logwrite ("FMG_LNK_DL ".$prauth[$ADM][0]." download file $pathwithfile)" ); if (!$sharedir)ob_clean ();
    fclose ($filescfg) ;//fclose ($file);
$filescfg=csvopen ("_conf/files.cfg","w",1);
$fildata[$filerealid][9]=$fildata[$filerealid][9]+1; // set downloads +1
$fildata[$filerealid][10]=date("d.m.Y H:i:s"); // set downloads +1
$x=writefullcsv ($filescfg,$filheader,$filplevels,$fildata); // надо себе напомнить чтоб не забывал переоткрывать файл в w
   //writing         new stroke to _conf\files.cfg
    //logwrite ("FMG_SHARE $share (usr=$userlist) (plvl=$groupplevels) $pathandfile");


if ($f=="image") {
   ob_clean ();// echo "<img src=\'$pathwithfile\'>";
   $content =  file_get_contents ($pathwithfile);
   // печатает тем не менее эта строка видимо    // показывает картинки отдельно если залита была картинко
     header("Content-type: image/jpg");
     echo $content;// показ php файлов залитых вместо jpg будет неудачен.
     $img= imagecreatefromstring($content);
//     print imagejpeg($img);
  }
  if (($f!="image")AND(!$sharedir)) sendfile ($pathwithfile);
  if ($sharedir) {$pathshare=$pathwithfile;}; // куда пропадает меню ?
  if (!$sharedir)exit;

};

} //окончание работы с ссылкой и выдачей файла и возврат к норм работе


//print_r ($_POST);
//принимаем графические переменные и преобразовываем их в cmd
if ($prauth[$ADM][40]) $noscreenmode=1;
 if ($noscreenmode==false) {
 if ($pid>0){ // пид нихера не получаем.
 if (isset ($FMG_SRCH_x)) $cmd{$pid}=cmsg ("FMG_SRCH");
 if (isset ($FMG_ENTER_x)) $cmd{$pid}=cmsg ("FMG_ENTER");
 if (isset ($FMG_EXIT_x)) $cmd{$pid}=cmsg ("FMG_EXIT");
 if (isset ($FMG_DRV_x)) $cmd{$pid}=cmsg ("FMG_DRV");
 if (isset ($FMG_MKDIR_x)) $cmd{$pid}=cmsg ("FMG_MKDIR");
 if ($codekey!==5) if (isset ($FMG_DELALL_x)) $cmd{$pid}=cmsg ("FMG_DELALL");
 if ($codekey!==5) if (isset ($FMG_JOINFIL_x)) $cmd{$pid}=cmsg ("FMG_JOINFIL");
 if (isset ($FMG_EXECUTE_x)) $cmd{$pid}=cmsg ("FMG_EXECUTE");
 if ($codekey!==5) if (isset ($FMG_DEL_x)) $cmd{$pid}=cmsg ("FMG_DEL");
 if ($codekey!==5) if (isset ($FMG_REN_x)) $cmd{$pid}=cmsg ("FMG_REN");
  if ($codekey!==5) if (isset ($FMG_EDIT_x)) $cmd{$pid}=cmsg ("FMG_EDIT");
 if (isset ($FMG_NEW_x)) $cmd{$pid}=cmsg ("FMG_NEW");
 if (isset ($FMG_DOWNLOAD_x)) $cmd{$pid}=cmsg ("FMG_DOWNLOAD");
 if ($codekey!==5) if (isset ($FMG_UPLOAD_x)) $cmd{$pid}=cmsg ("FMG_UPLOAD");
 if ($codekey!==5) if (isset ($FMG_SHARE_x)) $cmd{$pid}=cmsg ("FMG_SHARE");
 if ($codekey!==5) if (isset ($FMG_UNZIP_x)) $cmd{$pid}=cmsg ("FMG_UNZIP");
 if ($OSTYPE=="LINUX") if ($codekey!==5) if (isset ($FMG_UNRAR_x)) $cmd{$pid}=cmsg ("FMG_UNRAR");
 if (isset ($FMG_REF_x)) $cmd{$pid}=cmsg ("FMG_REF");
 if (isset ($FMG_RESET_x)) $cmd{$pid}=cmsg ("FMG_RESET");
 if ($codekey!==5) if (isset ($FMG_CPY_F_x)) $cmd{$pid}=cmsg ("FMG_CPY_F");
 if ($codekey!==5) if (isset ($FMG_MOV_F_x)) $cmd{$pid}=cmsg ("FMG_MOV_F");
if ($codekey!==5) if (isset ($FMG_CPY_FLD_x)) $cmd{$pid}=cmsg ("FMG_CPY_FLD");
if ($codekey!==5) if (isset ($FMG_MOV_FLD_x)) { $cmd{$pid}=cmsg ("FMG_MOV_FLD"); $pathx=$path1;$path1=$path2;$path2=$pathx;}


 }
}

if ($prauth[$ADM][40]) $cmdtmp=$cmd;
	for ($a=0;$a<100;$a++) { // save pid data
	$cmdname="cmd".$a;//$cmd1=$cmd{1};  $cmd2=$cmd{2};
	$$cmdname=$cmd{$a};
	//echo "$a=".$$cmd{$a}.";;";
	}
//Filemgr ne trebuet registracii и скачивать можно без нее.
//echo $sd[10];
//echo "erogog;rgrtgrg;grggg;jljlrg;rtjglrjglrglrglrjg;rjgrg;jg;ij;;'osf'rsg'rsg";
//print_r ($POST);
 if (!$sd[10]) if ($ADM==0) { msgexiterror ("notright","","disable");exit ;}

if (isset($_FILES["userfile"])) {
 if ($codekey==7) demo ();
 if (!$path) { echo "Path потерян... конец операции...";exit;} else {
     if ($pr[68]) $redirecttoshare=1;
     $err=uploadfile ($path,"original");}
 if ($err==false) echo "upload fail.";  if ($err==true)  echo "upload complete.";
  exit;}

  //echo "OSTYPE==$OSTYPE";
  if ($pr[41]) $defaultpath=$pr[41]; else {
   if ($OSTYPE=="LINUX") $defaultpath=getcwd ()."/";#config
   if ($OSTYPE=="WINDOWS") $defaultpath=getcwd ()."\\";#config
  }
  if ($prauth[$ADM][50]==true) { if ($userfilesfolder) $defaultpath=$userfilesfolder;

  if ($prauth[$ADM][53]) { $defaultpath=$prauth[$ADM][53];}
   if ($pr[41]==false) {if ($OSTYPE=="LINUX") $defaultpath.="/";#config
   if ($OSTYPE=="WINDOWS") $defaultpath.="\\";#config
     ;// personal folder added
   }

};


  if (($sd[10])AND($ADM==0)) {
      $prauth[0][37]="1";$defaultpath=$sd[10];// restriction right on unregistered user

        if ($pr[66]) $prauth[0][54]="on";// пока что зависит от прав на Upload // echo cmsg ("FMG_SHARE");
        if ($pr[67]) $prauth[0][9]="on"; //echo cmsg ("FMG_DOWNLOAD");
        if ($pr[71]) $prauth[0][36]="on";// echo cmsg ("FMG_UPLOAD");
        if ($pr[72]) $prauth[0][7]="on";//echo cmsg ("NAVI")."<br>";

      }

// в ядре произвести аналогичное изменение.
$filemgrmod=$sd[8];
#call filemanager
//echo "cmd1=$cmd1;<br>";
if ($prauth[$ADM][37]) $maxmgrs=$prauth[$ADM][37]; else $maxmgrs=2;
	for ($a=1;$a<$maxmgrs+1;$a++) { // save pid data
		//$fileforaction1="ept";		$cmd1="ept";
	$cmdname="cmd".$a;
	//echo "cmd{1}=".$cmd{1}.";<br>";
	$strokaname="stroka".$a;//$$strokaname=$stroka{$a};//$cmd1=$cmd{1};  $cmd2=$cmd{2};
	$pathname="path".$a;//$$pathname=$path{$a};
	$fileforactionname="fileforaction".$a;//$$fileforactionname=$fileforaction{$a};
    // вот здесь будет внедрение multiple files CFG OPT FUTURE
	$maskname="mask".$a;//$$maskname=$mask{$a};
	$cmd=${$cmdname};$stroka=${$strokaname};$path=${$pathname};$fileforaction=${$fileforactionname};$mask=${$maskname};
	//echo "cmd1=$cmd1;<br>";
	if ($nokeys==1) nokeys (1);
  if ($daysleft<1) expire ();

//moved TO Up -- SHARE APPLYING STEP 2 --
//global $username,$share,$write,$file;

if ($go==cmsg (FMG_SHARE))
{

        if ((!$prauth[$ADM][54])AND($coreredir!="step2")) { lprint ("DIS") ; exit;};

    if ($username) @$userlist=implode ($username,",");
    if ($share!=="GENLNK_USR") $userlist="";
    if ($file===false) exit;
    //echo "share=$share us=$userlist groupplevels=$groupplevels w=$write file=$file yes=$yes<br>";
  $hash=md5($prauth[$ADM][0].$file);
  $pathandfile=$file;
  $filesize=filesize ($file);
$hashdel=crc32 ($filesize);

  //check alreasy exist and receive ID
$count=$filcount;//echo "Counts found files.cfg: ".$count."<br>";
if ($share=="") { lprint (FSH_NO); exit; };
for ($a=0;$a<$count;$a++) {
    //echo $table[$a][4]."<br>";
    if ($share!=="FMG_UNSHARE") if ($fildata[$a][4]==$hash) { lprint ("FSH_EXST"); exit  ; }
    if ($share!=="FMG_UNSHARE") if ($fildata[$a][5]==$pathandfile) lprint ("FSH_EXST_AN_USR"); //трёхмерный массив :))
    if ($share=="FMG_UNSHARE") if ($fildata[$a][5]==$pathandfile) { $filefound=1;};
    if ($share=="FMG_UNSHARE")  if ($fildata[$a][4]==$hash) { lprint ("LNK_RMV");
        $fildata[$a]="";fclose ($filescfg) ;$filescfg=csvopen ("_conf/files.cfg","w",1); //reopen for write
        $x=writefullcsv ($filescfg,$filheader,$filplevels,$fildata); // надо себе напомнить чтоб не забывал переоткрывать файл в w
echo $x;   //writing new stroke to _conf\files.cfg
    logwrite ("FMG_UNSHARE $share (usr=$userlist) (plvl=$groupplevels) $pathandfile");exit;
    }
}
if (($share=="FMG_UNSHARE")AND($filefound==0)) { lprint ("UNSH_FAIL");exit;};
    $count=$count-1;$id=$count;
   $fildata[$count][0]=$id;   $fildata[$count][1]=$share;
   $fildata[$count][2]=$userlist;   $fildata[$count][3]=$groupplevels;
   $fildata[$count][4]=$hash;   $fildata[$count][5]=$pathandfile;
   $fildata[$count][6]=$yes;   $fildata[$count][7]=$commfile;   $fildata[$count][8]=date("d.m.Y H:i:s");
   $fildata[$count][9]=$downloads;   $fildata[$count][10]=$lastdownload;   $fildata[$count][11]=$srchen;
   $fildata[$count][12]=$hashdel;   $fildata[$count][13]=$filesize;   $fildata[$count][14]="0";
   $fildata[$count][15]=$dupname;   $fildata[$count][16]="0";   $fildata[$count][17]="0";
   $fildata[$count][18]=$dupname;   $fildata[$count][19]="0";   $fildata[$count][20]="0";
   $fildata[$count][21]=$dupname;   $fildata[$count][22]="0";   $fildata[$count][23]="0";
   $fildata[$count][24]=$dupname;   $fildata[$count][25]="0";   $fildata[$count][26]="0".$addOSenter;
 echo cmsg ("Y_LNK")." <a href='filemgr.php?c=".$fildata[$count][4]."'>link</a> ".cmsg ("Y_LNK_I")."<br>";
 //echo "server name=".$_SERVER['SERVER_NAME']."<br>"; echo "php self=".$_SERVER['PHP_SELF']."<br>"; echo "doc root=".$_SERVER['DOCUMENT_ROOT']."<br>";
$link="<br>http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."?c=".$fildata[$count][4]."<br><br>";

echo $link;

 echo cmsg ("D_LNK")." <a href='filemgr.php?c=".$fildata[$count][4]."&d=".$fildata[$count][12]."'>remove link</a> ".cmsg ("Y_LNK_I")."<br>";
 //echo "server name=".$_SERVER['SERVER_NAME']."<br>"; echo "php self=".$_SERVER['PHP_SELF']."<br>"; echo "doc root=".$_SERVER['DOCUMENT_ROOT']."<br>";
$link="<br>http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."?c=".$fildata[$count][4]."&d=".$fildata[$count][12]."<br><br>";

echo $link;
//echo "hash from filesdata-2 massive: ".$table[$count][4]."<br>";
//echo "writefullcsv вернул:";
fclose ($filescfg) ;//fclose ($file);
$filescfg=csvopen ("_conf/files.cfg","w",1);

//$testlinuxlinefeed=1;  надо не этот параметр врубать а вручную .add дописывать  все работает, можно копипастить :)))
$x=writefullcsv ($filescfg,$filheader,$filplevels,$fildata); // надо себе напомнить чтоб не забывал переоткрывать файл в w
echo $x;
   //writing new stroke to _conf\files.cfg
    logwrite ("FMG_SHARE $share (usr=$userlist) (plvl=$groupplevels) $pathandfile");

if ($debugmode) readfile ("_conf/files.cfg");  //debug//
exit;
}
//moved TO Up -- SHARE APPLYING STEP 2 -- ENDING

//added to sharing dir
if ($sharedir) { $path=$pathshare ;$cmd=cmsg ("FMG_ENTER");}; //working but странно.

if (!$prauth[$ADM][16]) if ($sd[27]) echo $sd[27]."<br>";
	//echo "<br>zad per<br>$cmd={$cmdname};$stroka={$strokaname};$path={$pathname};$fileforaction={$fileforactionname};$mask={$maskname};<br>";
	//echo "<br>cmd=$cmd,cmd1=$cmd1,str=$stroka,p=$path,f=$fileforaction,m=$mask,PID=$a,an PID=$pid<br>";
if ($prauth[$ADM][40]) { $cmd=$cmdtmp; lprint ("DEBUGMSG");echo ":".	cmsg ("GMP_40")."<br>";	}



//if ($noscreenmode==true) { $cmd=$cmd1;$write=$cmd;}  //NOWORK
	if ($debugmode) echo "filemgr (cmd=$cmd,stroka=$stroka,path=$path,file=$fileforaction,mask=$mask,pid=$a);";
        filemgr ($cmd,$stroka,$path,$fileforaction,$mask,$a);

	if ($a<$maxmgrs) echo "<hr>";
	}


/*
 * syntax: limit_rate скорость
default: нет
context: http, server, location, if в location

Директива задаёт скорость передачи ответа клиенту. Скорость задаётся в байтах в секунду. Ограничение работает только для одного соединения, то есть, если клиент откроет 2 соединения, то суммарная скорость будет в 2 раза выше ограниченной.

Если необходимо ограничить скорость для части клиентов на уровне сервера, то директива limit_rate для этого не подходит. Вместо этого следует задать нужную скорость переменной $limit_rate:

    server {

        if ($slow) {
            set $limit_rate  4k;
        }

        ...
    }

 */

function filemgr ($cmd,$stroka,$path,$fileforaction,$mask,$pid){  // is a part filemgr- fileio
	//hidekey ("pidептвоюмать",$pid);
	global $defaultpath,$protect,$prauth,$ADM,$pr,$sd;//..,$file
	global $filemgrmod,$daysleft,$codekey,$noscreenmode,$maxmgrs,$OSTYPE,$coreredir;
		if ($codekey==4) needupgrade ();

//echo "ACTION:cmd=$cmd,str ok,path ok,file=$fileforaction,pid=$pid>";// -+++-
 $path=str_replace ("\\\\","\\",$path);  // проверка на вшивость -
 //$path=str_replace ("/","\\",$path);


if (($cmd==cmsg("FMG_CPY_F"))and($prauth[$ADM][12])) {global $path2;copy($path.$fileforaction,$path2.$fileforaction);echo "copy($path$fileforaction,$path2);"; echo cmsg ("CP_END");};
if (($cmd==cmsg("FMG_MOV_F"))and($prauth[$ADM][12])) {global $path2;copy($path.$fileforaction,$path2.$fileforaction);unlink ($path.$fileforaction);
echo cmsg ("MOV_END");};

	if (($cmd==cmsg("FMG_DOWNLOAD"))and($prauth[$ADM][9])) { ob_clean ();$err=sendfile ($path.$fileforaction);};
if (($cmd==cmsg("FMG_UPLOAD"))and($prauth[$ADM][36])) {
	$path=del_endslash ($path);
//	if ($codekey==7) demo ();
//<input type="hidden" name="MAX_FILE_SIZE" value="8000000000">
	?><form enctype="multipart/form-data" action="filemgr.php" method="post">
	<input name=userfile type=file class=buttonS> <input type=Submit name=go class=buttonS>
	<input type = hidden name = path value ="<?=$path ;?>"><?=$path;hidekey ("pid",$pid);?></form>
<?=" ";
hidekey ("write",$cmd);
exit;//moved from non-function zone
}
//возможно сюда присобачим кнопку удаления из админки точнее ссылки с нее из w.php :)

//if (($cmd==cmsg("FMG_UNSHARE"))and($prauth[$ADM][36])) {    echo "not implemented";}
if ((($cmd==cmsg("FMG_SHARE"))and($prauth[$ADM][36])) OR ($coreredir=="SH_UPDD_FL")) {
	$path=del_endslash ($path); // -- SHARE STEP 1 --
    $file=$path."/".$fileforaction;
    if ($coreredir=="SH_UPDD_FL") { global $destinationfilename,$filesizeinmb;
            $file=$destinationfilename;
                                };
    	?><form enctype="multipart/form-data" action="filemgr.php" method="post"><?
    echo "File: $file<br>";
    lprint (GEN_OPT);echo "<br>";
radio ("share","#GENLNK_UNREG","GENLNK_UNREG");echo "<br>";
radio ("share","FMG_UNSHARE","FMG_UNSHARE"); echo "<br>";

 if (!$pr[70]) { radio ("share","GENLNK_REG","GENLNK_REG");echo "<br>";
 radio ("share","GEN_PLVL_USR","GEN_PLVL_USR");echo "<select name=groupplevels>";
		for ($a=0;$a<10;$a++){			echo "<option>".$a;			}
echo "</select>";echo "<br>";

radio ("share","GENLNK_USR","GENLNK_USR");echo "<br>";

    echo "<select name=\"username[]\" multiple size=15>";
    for ($a=1;$a<count ($prauth);$a++) {
	echo "<option>".$prauth[$a][0]."";$cnt++;
}
echo "</select>"; }
echo "<br>";
lprint (COMM);inputtext ("commfile",15,$commfile);echo "<br>";
checkbox (1,"yes"); lprint (GEN_FL_EPX);
checkbox (1,"srchen"); lprint (GEN_FILENSRCH);
echo "<br>";
if ($coreredir=="SH_UPDD_FL") { hidekey ("coreredir","step2");};
    hidekey ("file",$file);
    submitkey ("go","FMG_SHARE");
	hidekey ("pid",$pid);?></form>
<?=" ";
hidekey ("write",$cmd);
exit;//moved from non-function zone -- SHARE STEP 1 -- ENDING
}
//
//	echo "Мы получили из пред сессии  $cmd $fileforaction!<br> <BR>";   ikonki mlya !
//echo "<br>".cmsg ("FMG_MHLP")."<br>";  ХЕЛП ОТКЛЮЧЕН
 if ($noscreenmode==false) { echo "" ;};
//тут пишем команды и выполняем их

if (!$prauth[$ADM][38]) $protect[]="*.php";// скрываем файлы скрипта чтобы их никто не стер.
$protect[]="*.key";// не снимать комментарий - безопасность снизится до 0
//if ($OSTYPE=="LINUX") if (($sd[10])AND($ADM==0)) $path=$path."/";  //bug with unregistered users  folder lost /
//if ($OSTYPE=="WINDOWS") if (($sd[10])AND($ADM==0)) $path=$path."\\";

if ($OSTYPE=="WINDOWS") if (($cmd==cmsg("FMG_ENTER"))and($prauth[$ADM][7])) $path=$path.$fileforaction."\\";
if ($OSTYPE=="LINUX") if (($cmd==cmsg("FMG_ENTER"))and($prauth[$ADM][7])) $path=$path.$fileforaction."/";

if ($OSTYPE=="WINDOWS") if (($cmd==cmsg("FMG_DRV"))and($prauth[$ADM][8])) { $path=$stroka.":/";};
if ($OSTYPE=="LINUX") if (($cmd==cmsg("FMG_DRV"))and($prauth[$ADM][8])) { $path="/media/$stroka/";};
if ($OSTYPE=="LINUXALT") if (($cmd==cmsg("FMG_DRV"))and($prauth[$ADM][8])) { $path="/mnt/$stroka/";}; //CFG OPT FUTURE

if ($OSTYPE=="WINDOWS") if (($cmd==cmsg("FMG_EXIT"))and($prauth[$ADM][7])) $path=dirname ($path)."\\";//$path=folderupdir ($path);
if ($OSTYPE=="LINUX") if (($cmd==cmsg("FMG_EXIT"))and($prauth[$ADM][7])) $path=dirname ($path)."/";

if (($cmd==cmsg("FMG_SRCH"))and($prauth[$ADM][7])) {
$file=$path.$fileforaction; // далее скрипт рассчитан на эту переменную, к томуже массив стереть надо:)
$a=searchplus ($file,$fileforaction,$stroka);
if ($pr[12]) {$act="FILEMGR_SRCH $cmd $file word=$stroka"; logwrite ($act) ;
	};  // логируемся
//if ($a==false) die ("<br>Ошибка!Файл $file не найден!!!.<br>");
echo " <form action=filemgr.php method=post>";
	hidekey ("pid",$pid);
	hidekey ("write",$cmd);
	 submitkey ("cmd".$pid,"FMG_RESET");echo "</form>";exit;
}

//If ($prauth[$ADM][2]==true) {
	// blocked commands
if (($cmd==cmsg("FMG_MKDIR"))and($prauth[$ADM][12])) {
	//if ($codekey==7) demo ();
	$err=mkdir ($path.$stroka);
}
//if ($cmd==cmsg("FMG_DELALL")) $err=rmdir ($path.$fileforaction);
if (($cmd==cmsg("FMG_JOINFIL"))and($prauth[$ADM][12])) {
	if ($codekey==7) demo (); 
	$err=joinfiles ($path,$mask,$protect,$stroka);
}
if (($cmd==cmsg("FMG_DELALL"))and($prauth[$ADM][13])) { // rmdir теперь  полное удаление (!)
	if ($codekey==7) demo ();
	if ($prauth[$ADM][5]==true) {
		if (($stroka)=="accept") { $err=kill_dir ($path.$fileforaction);} else { echo "Вы не сказали accept";} } else {
		msgexiterror ("notright","","disable");exit ;}	 // круто удаляет отключим
}
if (($cmd==cmsg("FMG_EXECUTE"))and($prauth[$ADM][8])) {
	if ($codekey==7) demo ();
	echo cmsg ("FMG_MOD_IN")."<br>";
	require ($filemgrmod);
	echo cmsg ("FMG_MOD_OUT")."<br>";
}


 if ($OSTYPE=="LINUX") if (($cmd==cmsg("FMG_UNRAR"))and($prauth[$ADM][12])) {
    $file=$path.$fileforaction;//rar_open rar_list PHP by standart is unsupported!!!
    $unrared=substr($fileforaction,0, strrpos($fileforaction,'.') );; // elf  elfkz  удаляем расширение рар
    mkdir ($path.$unrared);
    echo "Creating folder $unrared<br>";
    $extractionpoint=$path.$unrared;
    echo "Extracting to ".$extractionpoint.";<br>";
$zip = system("unrar x \"$file\" \"$extractionpoint\"");
echo "<br>Result=$zip  "; //echo '"unrar e \"'.$file.'\" \"'.$extractionpoint.'\""'; echo " <br>";
 }



if (($cmd==cmsg("FMG_UNZIP"))and($prauth[$ADM][12])) {
    $file=$path.$fileforaction;//rar_open rar_list PHP by standart is unsupported!!!
$zip = zip_open($file);
if ($zip) {

while ($zip_entry = zip_read($zip)) {
echo "Name: " . zip_entry_name($zip_entry) . "\n";
echo "Actual Filesize: " . zip_entry_filesize($zip_entry) . "\n";
echo "Compressed Size: " . zip_entry_compressedsize($zip_entry) . "\n";
echo "Compression Method: " . zip_entry_compressionmethod($zip_entry) . "\n";

if (zip_entry_open($zip, $zip_entry, "r")) {
echo "File Contents:\n";
$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
//echo "$buf\n";
$x=fopen ($path.zip_entry_name($zip_entry),"w");
fwrite ($x,$buf);
fclose ($x);

zip_entry_close($zip_entry);
}
echo "\n";

}
zip_close($zip);
}
}

if (($cmd==cmsg("FMG_DEL"))and($prauth[$ADM][13])) {
	if ($codekey==7) demo ();
	@$err1=unlink ($path.$fileforaction);
	@$err2=rmdir ($path.$fileforaction);
	}
if (($cmd==cmsg("FMG_NEW"))and($prauth[$ADM][12])) {
	//if ($codekey==7) demo ();
	@$err=fopen($path.$stroka,"r"); if ($err==false) $err=fopen ($path.$stroka,"a");}

if (($cmd==cmsg("FMG_REN"))and($prauth[$ADM][12])) {
	if ($codekey==7) demo ();
	$err=rename ($path.$fileforaction, $path.$stroka);
}

if (($cmd==cmsg("FMG_EDIT"))and($prauth[$ADM][12])) {
	if ($codekey==7) demo ();
	$err=simpleedit ($path.$fileforaction,$stroka);
}


if ($pr[12]) {$act="FILEMGR_CMD $cmd $file($path $fileforaction) word=$stroka";
if ($cmd) if ($cmd!==cmsg("FMG_ENTER")AND($cmd!==cmsg("FMG_EXIT"))) logwrite ($act) ;
	};  // логируемся
// } else { echo "<br><font color=red id=errfnt>".cmsg ("LIM")."</font>".cmsg ("FMG_HLP2");}

#selectin files using  fileio.php
if ((!$path)OR($cmd==cmsg("FMG_RESET"))) { $path=$defaultpath;$mask="*.*";$file="";$stroka=""; };
//$path=str_replace ("//","/",$path);проверка на вшивость -

if ($err) echo "$err <br>";

// маска для файла может быть поиск по части имени и поиск по формату
//выделить обращение к директории и режим парсинга (маска)
//насчет маски - возможно стоит ее добавить в поисковик МЕ
     if ($pid==1) {if ($pr[86]) if (($pr[87])OR($prauth[$ADM][7])){  //либо право на чтение у юзера, либо разрешение искать всем.
       echo "<br><form action=filemgr.php method=post>";lprint ("SRCH_FILE");inputtxt ("searchfilenew",30);submitkey ("start","DALEE"); echo "</form>";
       if ($searchfilenew) { echo $searchfilenew;};
       }
     
     


     }
       
echo "<form action=filemgr.php method=post>";
hidekey ("write",$cmd);
//выделить отдельно модуль создания меню выбора файла.
$file=getdirdata ($path,$mask,$protect);//print_r ($file);
if ($file) asort ($file);
$dircnt= count ($file);
	if (($ADM>0)) echo "<font color=blue>$path</font><br>";
	hidekey ("pid",$pid);
	// cобственно это и мешает многооконной идее ))   вроде теперь кое-
	for ($a=1;$a<$maxmgrs+1;$a++) { // save pid data
	$strokaname="stroka".$a;
	$pathname="path".$a;
	$fileforactionname="fileforaction".$a;
	$maskname="mask".$a;
	global $$strokaname,$$pathname,$$fileforactionname,$$maskname;

	$$pathname=str_replace ("\\\\","\\",$$pathname);	$$pathname=str_replace ("\\\\","\\",$$pathname);
	if ($OSTYPE=="WINDOWS") $path=str_replace ("\\\\","\\",$path);  // проверка на вшивость -
 	if ($OSTYPE=="LINUX") $path=str_replace ("\\\\","\\",$path);  // проверка на вшивость -xc
	hidekey ("stroka".$a,$$strokaname);		hidekey ("mask".$a,$$maskname);
	hidekey ("path".$a,$$pathname);			hidekey ("fileforaction".$a,$$fileforactionname);

	}

//lprint ("FMG_CREATE");
	if ($ADM>0) inputtext("stroka".$pid,15,$stroka);//<textarea type = text name=stroka<?=$pid  cols= 15 rows=1 wrap=NONE><?=$stroka; </textarea>
        if ($ADM>0) { $hidefolder=$prauth[$ADM][52];} else {$hidefolder=$pr[73];};
        if (!$hidefolder) { lprint ("FMG_MASK");inputtext ("mask".$pid,15,$mask);} //<textarea type = text name=mask<?=$pid  cols= 7 rows=1 wrap=NONE><?=$mask; </textarea> <?

 if ($noscreenmode) {
 	if ($prauth[$ADM][7]) { //FMG.pid удален
 		echo "generate cmd$pid<br>";
 	//$cmdx="cmd".$pid;
 //работает но передает только вторую букву [1] FIXED?
 	 submitkey ("cmd","FMG_SRCH");
 	 submitkey ("cmd","FMG_ENTER");
	 submitkey ("cmd","FMG_EXIT"); 		}
	if ($prauth[$ADM][8]) {
	 submitkey ("cmd","FMG_DRV");
	 if (($filemgrmod)AND($prauth[$ADM][2]==true))	 submitkey ("cmd","FMG_EXECUTE");  }
		if ($prauth[$ADM][12]) {
	 submitkey ("cmd","FMG_MKDIR");
	 submitkey ("cmd","FMG_JOINFIL");
         submitkey ("cmd","FMG_UNZIP");
          	if ($OSTYPE=="LINUX")submitkey ("cmd","FMG_UNRAR");
	 submitkey ("cmd","FMG_REN");
	 submitkey ("cmd","FMG_EDIT");
	 submitkey ("cmd","FMG_NEW"); 			}
		 if ($prauth[$ADM][13]) {
	 submitkey ("cmd","FMG_DELALL");
	 submitkey ("cmd","FMG_DEL"); 			 }
		 if ($prauth[$ADM][9]) {
	 submitkey ("cmd","FMG_DOWNLOAD");}
		 if ($prauth[$ADM][36]) {
	 submitkey ("cmd","FMG_UPLOAD");
         }
 if ($prauth[$ADM][54]) {
 	 submitkey ("cmd","FMG_SHARE");
//	 submitkey ("cmd","FMG_UNSHARE");

}
if(!$pr[75]){submitkey ("cmd","FMG_REF");
	 submitkey ("cmd","FMG_RESET");
}
	 if (!$hidefolder) submitkey ("cmd","FMG_MASKAPPLY");
		}


	 if ($noscreenmode==false) {
if ($prauth[$ADM][7]) {
 submitimg ("cmd".$pid,"FMG_SRCH","_ico/target.png");
 submitimg ("cmd".$pid,"FMG_ENTER","_ico/openfolder.png");
 submitimg ("cmd".$pid,"FMG_EXIT","_ico/folderup.png");
}
 if ($prauth[$ADM][8]) {
 submitimg ("cmd".$pid,"FMG_DRV","_ico/drv.png");
 submitimg ("cmd".$pid,"FMG_EXECUTE","_ico/execute.png");
 }
 if ($prauth[$ADM][12]) {
 submitimg ("cmd".$pid,"FMG_MKDIR","_ico/newfolder.png");
 submitimg ("cmd".$pid,"FMG_REN","_ico/rename.png");
 submitimg ("cmd".$pid,"FMG_EDIT","_ico/editfmg.png");
 submitimg ("cmd".$pid,"FMG_NEW","_ico/newfile.png");
 submitimg ("cmd".$pid,"FMG_JOINFIL","_ico/joinfiles.png");
 submitimg ("cmd".$pid,"FMG_UNZIP","_ico/backup.png");
if ($OSTYPE==="LINUX")  submitimg ("cmd".$pid,"FMG_UNRAR","_ico/backup.png");
 }
 if ($prauth[$ADM][13]) {
 if ($prauth[$ADM][5]==true) submitimg ("cmd".$pid,"FMG_DELALL","_ico/removefolder.png");
  submitimg ("cmd".$pid,"FMG_DEL","_ico/removefile.png");
 }
 if ($prauth[$ADM][9]) {
 submitimg ("cmd".$pid,"FMG_DOWNLOAD","_ico/download.png");
 }


 if ($prauth[$ADM][36]) {
  if(!$pr[75]){ submitimg ("cmd".$pid,"FMG_UPLOAD","_ico/upload.png"); }
  if($pr[75]){ submitimg ("cmd".$pid,"FMG_UPLOAD","_ico/uploadalt.png"); }
 }
 if ($prauth[$ADM][54]) {
 submitimg ("cmd".$pid,"FMG_SHARE","_ico/w_accept.png");
 //submitimg ("cmd".$pid,"FMG_UNSHARE","_ico/w_close.png");

  }
  if(!$pr[75]){
 submitimg ("cmd".$pid,"FMG_REF","_ico/refresh.png");
 submitimg ("cmd".$pid,"FMG_RESET","_ico/reset.png");
  }
  if (!$hidefolder) submitimg ("cmd".$pid,"FMG_MASKAPPLY","_ico/stargreen.png");

	 }

if (($pid==1)AND($prauth[$ADM][12])) { // только 1 раз исполняется этот блок .  на 1 пиде.
		echo "<br>";echo cmsg ("FMG2");
		 submitimg ("cmd".$pid,"FMG_CPY_F","_ico/copyfile.png");echo " ";
		 submitimg ("cmd".$pid,"FMG_MOV_F","_ico/movefile.png");echo " ";
		 //submitimg ("cmd".$pid,"FMG_CPY_FLD","_ico/copyfolder.png");echo " ";
		 submitimg ("cmd".$pid,"FMG_MOV_FLD","_ico/movefolder.png");echo " ";



	}

	?> <input type = hidden name = path<?=$pid ;?> value ="<?=$path ?>" >
<?
   if ($hidefolder) unset ($file); //no filelist
	IF ($file) { echo "<BR>".cmsg ("FMG_FILDB").":<select name =fileforaction".$pid." multiple size = ".$prauth[$ADM][49].">";

        sort ($file); //нет реакции... print_r ($file); echo "Rewefkowe";

	for ($a=0;$a<$dircnt;$a++) {
		if (($file[$a][0])===".") continue;
		if (($file[$a][0])==="..") continue;
		if (($file[$a][0])===false) continue;
		if ($file[$a][1]) { $dir="==>";}else{ $dir="";};
                $fsizer="";
                if ($dir!=="==>") {
                    $fsize=$file[$a][2];// settype ($fsizer,"string");

                if ($fsize<1024) $fsizer="[".round ($fsize,1)."b]";
                if ($fsize<1) $fsizer="";
                if ($fsize>1024) $fsizer="[".round ($fsize/1024,1)."Kb]";
                if ($fsize>1024*1024) $fsizer="[".round ($fsize/1024/1024,2)."Mb]";
                if ($fsize>1024*1024*1024) $fsizer="[".round ($fsize/1024/1024/1024,2)."Gb]";
                }
                //$filesizemb=$file[$a][2]/1024;
		echo "<option value=\"".$file[$a][0]."\">".$dir.$file[$a][0]."".$fsizer."</option>";
		}// size (".$file[$a][2].")
	if ($pr[11]==1) {	//protected cmds
	}
	echo "</select></form>";

     

	}
echo "<br>";

$dbsdiskfree=round ((int)(@disk_free_space($path)/(1024*1024*1024)),1);
$dbsdisktotal=(int)(@disk_total_space($path)/(1024*1024*1024));

if ($ADM) echo "Selected : Free ".$dbsdiskfree."Gb ";  // сделать переключатель дисков или что то вроде указателя
if ($ADM) echo "\\".$dbsdisktotal."Gb<br>";


$disks=explode (",",$pr[79]);
for ($a=0;$a<count ($disks);$a++) {
 $diskfree[$a]=round ((@disk_free_space($disks[$a])/(1024*1024*1024)),1); //Gb
 $disktotal[$a]=round ((@disk_total_space($disks[$a])/(1024*1024*1024)),1); //Gb
 if (!$pr[80]) echo "Disk ".($a).":: ".$diskfree[$a]."Gb \\ ".$disktotal[$a]."Gb.<br>";
 $avgfree=$avgfree+$diskfree[$a];
 $avgtotal=$avgtotal+$disktotal[$a];
}
$avgfree=$avgfree;
$avgtotal=$avgtotal;


echo " Summary :Free ".$avgfree."Gb ";echo "\\".$avgtotal."Gb";echo "<br>";

}

// ADDED FUNCTIONS FROM PHP.NET  WRITTEN NON DJ--ALEX
function zip_read2(&$fp)
{
  if(!$fp) return false;

  $next = $fp['pointer'] + 1;
  if($next >= count($fp['contents'])) return false;

  $fp['pointer'] = $next;
  return $fp['contents'][$next];
}
function zip_entry_name2(&$res)
{
  if(!$res) return false;
  return $res['name'];
}
function zip_entry_filesize2(&$res)
{
  if(!$res) return false;
  return $res['length'];
}
function zip_entry_open2(&$fp, &$res)
{
  if(!$res) return false;

  $cmd = 'unzip -p '.shellfix($fp['name']).' '.shellfix($res['name']);

  $res['fp'] = popen($cmd, 'r');
  return !!$res['fp'];
}
function zip_entry_read2(&$res, $nbytes)
{
  return fread($res['fp'], $nbytes);
}
function zip_entry_close2(&$res)
{
  fclose($res['fp']);
  unset($res['fp']);
}

function ShellFix($s)
{
  return "'".str_replace("'", "'\''", $s)."'";
}

function zip_open2($s)
{
  $fp = @fopen($s, 'rb');
  if(!$fp) return false;

  $lines = Array();
  $cmd = 'unzip -v '.shellfix($s);
  exec($cmd, $lines);

  $contents = Array();
  $ok=false;
  foreach($lines as $line)
  {
    if($line[0]=='-') { $ok=!$ok; continue; }
    if(!$ok) continue;

    $length = (int)$line;
    $fn = trim(substr($line,58));

    $contents[] = Array('name' => $fn, 'length' => $length);
  }

  return
    Array('fp'       => $fp,
          'name'     => $s,
          'contents' => $contents,
          'pointer'  => -1);
}

?>