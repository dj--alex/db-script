<?php 
require_once ('dbscore.lib'); // функция подготовки к работе и авторизации
if (!$activation) exit;
$verfilemgr="Filemgr  v 3.6.11  (c) dj--alex ";
  $enterpoint=$verfilemgr;#end of conf
// вот наша буферизация - ob_start();ob_end_flush();
autoexecsql (); 
@ import_request_variables ("PG","");
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
//CFG OPT FUTURE  Filemgr ne trebuet registracii и скачивать можно без нее.
//echo $sd[10];
//echo "erogog;rgrtgrg;grggg;jljlrg;rtjglrjglrglrglrjg;rjgrg;jg;ij;;'osf'rsg'rsg";
//print_r ($POST);
 if (!$sd[10]) if ($ADM==0) { msgexiterror ("notright","","disable");exit ;}

if (isset($_FILES["userfile"])) { 
 if ($codekey==7) demo ();
 if (!$path) { echo "Path потерян... конец операции...";exit;} else { $err=uploadfile ($path,"original");}
 if ($err==false) echo "upload fail.";  if ($err==true)  echo "upload complete.";
  exit;}

  //echo "OSTYPE==$OSTYPE";
  if ($pr[41]) $defaultpath=$pr[41]; else {
if ($OSTYPE=="LINUX") $defaultpath=getcwd ()."/";#config
if ($OSTYPE=="WINDOWS") $defaultpath=getcwd ()."\\";#config
  }
  if (($sd[10])AND($ADM==0)) {$prauth[0][9]="on";$prauth[0][7]="on"; $prauth[0][37]="1";$defaultpath=$sd[10];}
  
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
	$maskname="mask".$a;//$$maskname=$mask{$a};
	$cmd=${$cmdname};$stroka=${$strokaname};$path=${$pathname};$fileforaction=${$fileforactionname};$mask=${$maskname};
	//echo "cmd1=$cmd1;<br>";
	if ($nokeys==1) nokeys (1);
  if ($daysleft<1) expire ();

	//echo "<br>zad per<br>$cmd={$cmdname};$stroka={$strokaname};$path={$pathname};$fileforaction={$fileforactionname};$mask={$maskname};<br>";
	//echo "<br>cmd=$cmd,cmd1=$cmd1,str=$stroka,p=$path,f=$fileforaction,m=$mask,PID=$a,an PID=$pid<br>";
if ($prauth[$ADM][40]) { $cmd=$cmdtmp; lprint ("DEBUGMSG");echo ":".	cmsg ("GMP_40")."<br>";	}
//if ($noscreenmode==true) { $cmd=$cmd1;$write=$cmd;}  //NOWORK
	filemgr ($cmd,$stroka,$path,$fileforaction,$mask,$a);

	if ($a<$maxmgrs) echo "<hr>";
	}

function filemgr ($cmd,$stroka,$path,$fileforaction,$mask,$pid){  // is a part filemgr- fileio
	//hidekey ("pidептвоюмать",$pid);
	global $defaultpath,$protect,$prauth,$ADM,$pr,$sd;//..,$file
	global $filemgrmod,$daysleft,$codekey,$noscreenmode,$maxmgrs,$OSTYPE;
		if ($codekey==4) needupgrade ();

//echo "ACTION:cmd=$cmd,str ok,path ok,file=$fileforaction,pid=$pid>";// -+++- 
 $path=str_replace ("\\\\","\\",$path);  // проверка на вшивость -
 //$path=str_replace ("/","\\",$path);


if (($cmd==cmsg("FMG_CPY_F"))and($prauth[$ADM][12])) {global $path2;copy($path.$fileforaction,$path2.$fileforaction);echo "copy($path$fileforaction,$path2);"; echo "Копирование завершено";};
if (($cmd==cmsg("FMG_MOV_F"))and($prauth[$ADM][12])) {global $path2;copy($path.$fileforaction,$path2.$fileforaction);unlink ($path.$fileforaction);
echo "Перемещение завершено";};
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

if (($cmd==cmsg("FMG_DEL"))and($prauth[$ADM][13])) {
	if ($codekey==7) demo ();
	@$err1=unlink ($path.$fileforaction);
	@$err2=rmdir ($path.$fileforaction);
	}
if (($cmd==cmsg("FMG_NEW"))and($prauth[$ADM][12])) {
	//if ($codekey==7) demo ();
	$err=fopen($path.$stroka,"r"); if ($err==false) $err=fopen ($path.$stroka,"a");}

if (($cmd==cmsg("FMG_REN"))and($prauth[$ADM][12])) {
	if ($codekey==7) demo ();
	$err=rename ($path.$fileforaction, $path.$stroka);
}

if (($cmd==cmsg("FMG_EDIT"))and($prauth[$ADM][12])) {
	if ($codekey==7) demo ();
	$err=simpleedit ($path.$fileforaction,$stroka);
}


if ($pr[12]) {$act="FILEMGR_CMD $cmd $file($path $fileforaction) word=$stroka"; 
if ($cmd!==cmsg("FMG_ENTER")AND($cmd!==cmsg("FMG_EXIT"))) logwrite ($act) ;
	};  // логируемся
// } else { echo "<br><font color=red>".cmsg ("LIM")."</font>".cmsg ("FMG_HLP2");}

#selectin files using  fileio.php
if ((!$path)OR($cmd==cmsg("FMG_RESET"))) { $path=$defaultpath;$mask="*.*";$file="";$stroka=""; };
//$path=str_replace ("//","/",$path);проверка на вшивость -

if ($err) echo "$err <br>";

// маска для файла может быть поиск по части имени и поиск по формату
//выделить обращение к директории и режим парсинга (маска)
//насчет маски - возможно стоит ее добавить в поисковик МЕ

echo "<form action=filemgr.php method=post>";
hidekey ("write",$cmd);
//выделить отдельно модуль создания меню выбора файла.
$file=getdirdata ($path,$mask,$protect);//print_r ($file);
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
 	if ($OSTYPE=="LINUX") $path=str_replace ("\\\\","\\",$path);  // проверка на вшивость -
	hidekey ("stroka".$a,$$strokaname);		hidekey ("mask".$a,$$maskname);	
	hidekey ("path".$a,$$pathname);			hidekey ("fileforaction".$a,$$fileforactionname);
	
	}

//lprint ("FMG_CREATE"); 
	if ($ADM>0) inputtext("stroka".$pid,15,$stroka);//<textarea type = text name=stroka<?=$pid  cols= 15 rows=1 wrap=NONE><?=$stroka; </textarea>
	lprint ("FMG_MASK");inputtext ("mask".$pid,15,$mask); //<textarea type = text name=mask<?=$pid  cols= 7 rows=1 wrap=NONE><?=$mask; </textarea> <?
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
	 submitkey ("cmd","FMG_REN"); 
	 submitkey ("cmd","FMG_EDIT"); 
	 submitkey ("cmd","FMG_NEW"); 			}
		 if ($prauth[$ADM][13]) {
	 submitkey ("cmd","FMG_DELALL");	
	 submitkey ("cmd","FMG_DEL"); 			 }
		 if ($prauth[$ADM][9]) {
	 submitkey ("cmd","FMG_DOWNLOAD");}
		 if ($prauth[$ADM][36]) {
	 submitkey ("cmd","FMG_UPLOAD"); 		} // CFG OPT FUTURE ..отделить разрешение на закачку файлй
	 submitkey ("cmd","FMG_REF"); 
	 submitkey ("cmd","FMG_RESET");		 
	 submitkey ("cmd","FMG_MASKAPPLY");
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
 submitimg ("cmd".$pid,"FMG_EDIT","_ico/edit.png");
 submitimg ("cmd".$pid,"FMG_NEW","_ico/newfile.png");
 submitimg ("cmd".$pid,"FMG_JOINFIL","_ico/joinfiles.png");
 }
 if ($prauth[$ADM][13]) {
 if ($prauth[$ADM][5]==true) submitimg ("cmd".$pid,"FMG_DELALL","_ico/removefolder.png");
  submitimg ("cmd".$pid,"FMG_DEL","_ico/removefile.png");
 }
 if ($prauth[$ADM][9]) {
 submitimg ("cmd".$pid,"FMG_DOWNLOAD","_ico/download.png");
 }
 if ($prauth[$ADM][36]) {
 submitimg ("cmd".$pid,"FMG_UPLOAD","_ico/upload.png");
  }
 submitimg ("cmd".$pid,"FMG_REF","_ico/refresh.png");
 submitimg ("cmd".$pid,"FMG_RESET","_ico/reset.png");
 submitimg ("cmd".$pid,"FMG_MASKAPPLY","_ico/stargreen.png");

	 }
	 
if (($pid==1)AND($prauth[$ADM][12])) {
		echo "<br>";echo cmsg ("FMG2");
		 submitimg ("cmd".$pid,"FMG_CPY_F","_ico/copyfile.png");echo " ";
		 submitimg ("cmd".$pid,"FMG_MOV_F","_ico/movefile.png");echo " ";
		 //submitimg ("cmd".$pid,"FMG_CPY_FLD","_ico/copyfolder.png");echo " ";
		 submitimg ("cmd".$pid,"FMG_MOV_FLD","_ico/movefolder.png");echo " ";
	}

	?> <input type = hidden name = path<?=$pid ;?> value ="<?=$path ?>" >
<?
	IF ($file) { echo "<BR>".cmsg ("FMG_FILDB").":<select name =fileforaction".$pid.">"; //ИМХО size=10 здесь опционально нужно вводить. Или убирать нахрен. Весь вид портит.
	for ($a=0;$a<$dircnt;$a++) {
		if (($file[$a][0])===".") continue;
		if (($file[$a][0])==="..") continue;
		if (($file[$a][0])===false) continue;
		if ($file[$a][1]) { $dir="==>";}else{ $dir="";};
		echo "<option value=\"".$file[$a][0]."\">".$dir.$file[$a][0]."</option>";
		}// size (".$file[$a][2].")
	if ($pr[11]==1) {	//protected cmds
	}
	echo "</select></form>";
	}
	
	echo "".(int)(@disk_total_space($path)/(1024*1024))."Mb ";
echo "/".(int)(@disk_free_space($path)/(1024*1024))."Mb";
}
?>