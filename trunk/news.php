<?php   echo 'News block module.<br>';// module for dbscript
if ($debug) echo "Starting...loading core...<br>";
// Данная программа относится к пакету DBSCRIPT v2.1 (с) dj--alex
// Заказной плагин кrequires tbl dbs id пакету. "Новости для сайта".
if ($_FILES) ob_start(); // добавлено т.к. в 2033 строке непонятно прислали файл вообще или нет
$nomnu=true;
require_once ('dbscore.lib'); // функция подготовки к работе и авторизации
$nomnu=1;
if (!$activation) exit;
/*
 * Что за блог?   news.php  nedit.php - блог для Dbscript
 * Идентификатор таблицы блога создающейся при первом его запуске, ID этой таблицы из алиасов _нужно_ прописать в админке
 * после этого блог будет работать с таблицей (dbscriptbk._dbs__news43)
 * Поддерживается показ новостей за последние 15 дней по умолчанию
 * Новости все по умолчанию свернуты и могут быть открыты
 * Работают щелчки в шапке по тегам , по авторам, и поддержка видеоплееров. (можно заливать flv)
 * важно: В показе таблицы поддерживаются HTML теги
 * выдаются в виде стандартной Dbscript таблицы.
 * Для создания новостей в блоге используется редактор TinyMCE
 * Поддерживается показ видео
 * Планируется поддержка показа по любым щелчкам (почти сделано), буду рад помощи в доработке.

 *
 * При редактировании в одном из полей теряются данные...хз почему. если копировать перед редактированием это помогает.
 * * поддержки notable пока нет
 * Возможность поиска по > < необходимо внедрить в основной поиск
 * Также в основной поиск неплохо добавить и поискать same parameter.
 * Планируется загрузка и выгрузка пользовательски данных в отдельный plugins.cfg для начала хотябы общие настройки.
 *
 */
?>

</head>
<body>
<style media="all" type="text/css">@import "_style/insidestyles.css";</style>

<?

$dbtype="mysql";
$tbl=192;
$tbl=$sd[38];

$x=newscreatesql (); 
//..echo " Вы должны установить tbl= тому ИД , которому равен _dbs__news43  он есть в админке - $sd[38]  Мод Блог - идентификатор таблицы. ";

if ($debug) echo "Returned message about existing tables:$x<br>";
if ($debug)echo "Settings: requires tbl dbs id for work: $tbl *usually 1<br>";
//показать новости за последний месяц   data  gutentag
$date=date("d.m.Y H:i:s");
$datesrch=date("m.Y");
$dateinunix=strdbstounixtime ($date);// переводим обычную dbs дату в юникс
//..$dateinunix2=strdbstounixtime ("13.04.2010 10:38:53");// переводим обычную dbs дату в юникс
if ($debug) echo "Now $date = Now date in unix=".$dateinunix."<br>";
//echo "Now date in unix by time ".time ()."<br>";
$dateinunixminux15=$dateinunix-(1295684*2);  //CFG OPT FUTURE - это число дней 15  его можно изменять.
$dateminus15=date("d.m.Y H:i:s",$dateinunixminux15);
if ($debug) echo "date -15days= ".$dateminus15." ($dateinunixminux15)<br>";  //1295684 - 15 юникс дней.
$vID=$datesrch;
//$tempdate=date("d.m.Y H:i:s",1272436417);  //переводим юникс дату в дбс
//echo "Tempdate =$tempdate  and date-tempdate=".($dateinunix-1272436417)."<br>";

//TEST TEST TEST!


if ($ADM!==0)echo "<a target=b2 href='news.php?stdout=1'><img src=\"_ico/admin.png\" border=0 title='".cmsg ("WF_CANCSHOW")."'></a>";


// функция поиска похожих новостей по щелчку из заголовка.
function tag ($tag,$field) {
//generating automatic tag
    $tags=explode (",",$tag);
    $counttags=count ($tags) ;
    //echo "blax blax  $counttags";
    for ($a=0;$a<$counttags;$a++) {
    echo "<a target=tag href='news.php?".$field."=".$tags[$a]."'>$tags[$a]</a>";
    if ($a<$counttags-1) echo ",";
    // <img src=\"_ico/admin.png\" border=0 title='".cmsg ("WF_CANCSHOW")."'>
    }
}
  // copy of search r.php mode == 2
					$connect=dbs_connect ($prdbdata[$tbl][6],$sd[14],$sd[17],$dbtype);
					dbs_selectdb ("dbscriptbk", $connect,$dbtype);  //mod
					$data=readdescripters ();// получение данных заголовка массив mycol кол-во mycols
					global $query,$connect;
					global $mzdata,$mycols,$myrow,$findrecords,$scrcolumn;
					settype ($vID,"integer");
					if ($vID==0)  msgexiterror ("needcode",$mode,"disable");
                                           //default mode - select only by data last 15 days
                                        $query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE `data` > ".$dateinunixminux15;
                                        if ($tag) $query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE `gutentag` LIKE '%".$tag."%'";
                                        if ($author) $query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE `user` LIKE '%".$author."%'";
                                        //author !!!
                                        //debug $query = "SELECT * FROM `".$prdbdata[$tbl][5]."` WHERE `data` < ".$dateinunixminux15;
                                        echo $query."<br>";  // CFG OPT FUTURE - это условие неплохо бы добавить в основной поиск  > < !=
					//if (($prdbdata[$tbl][15]>0)AND ($vID2!=="")) { $query = $query." AND ".$mycol[$prdbdata[$tbl][15]]."= '".$vID2."'";};
					//$query=$query.$addsql;// сортировка, лимит


        if (($stdout==1)&&($ADM!==0)) {	selectedprintsql ($data); } else {
            $result = dbs_query ($query, $connect,$dbtype);
//..echo "[debug] mycols=$mycols";

initwindowactions (0);
?> <link href="msgerr.css" rel="stylesheet" type="text/css"> <?
echo "<font class=text><table id=myTable border=1 width=100% bordercolor=#206621 style=\" color: #".$rgbtext.";  \"  >";
echo "<tr>";
			for ($a=0;$a<$mycols;$a++)
				{
                                    //echo "1";
                                  //  if ($mzdata[0]==false) {echo "<td><bb>".$mycol[$a]."</bb></td>";				}
                                    while ($myrow = dbs_fetch_row ($result,$dbtype)){  // DECLINED BY FALSE RESULT
                                       //../ if ($myrow==false) echo "False result !!!!!<br>";
                                        $l++ ;
                                        //echo "2";
                                        echo "<tr>";
                                                if ($myrow[2]>0) continue; //skip plevel >0
                                         
                                                $datathisline=$myrow[7];
                                                if ($debug) echo "datathisline= $datathisline myrow6=".$myrow[7]." ,  dateinunixminux15 = $dateinunixminux15, mycols=$mycols<br>";
						if ($datathisline>$dateinunixminux15) for ($b=0;$b<$mycols;$b++){

                                                           if ($b>0) if ($b>3) echo"<td>";
                                                           if ($b==1) {echo "</table>"; echo "<div id=l".$l." style=\" visibility:$hid; height:1 px \">";
                                               echo "<table border=1 width=100% bordercolor=#206621 style=\" color: #".$rgbtext.";  \" ><tr><td>";
                                                           }
                                                           
                                                            if ($b==0) { echo "<td >"; //оригинальный "каталог постов"
?><a HREF="javascript:win('l<?php echo $l;?>',0)"><img src="_ico/w_hide.png" border=0></a>
<a HREF="javascript:win('l<?php echo $l;?>',1)"><img src="_ico/w_zoom_out.png" border=0></a>
                    <?
                    
echo cmsg("B_POTS")." ".$myrow[0];}// id post
                                          if ($b==1) { echo "<ll ><tr>"; echo cmsg ("B_AUTH")." "; tag ($myrow[1],"author"); echo " :"; };// plevel ignored
                                          if ($b==2) { echo "" ; };// plevel ignored
                                          if ($b==3) { echo ": ".cmsg ("B_THEM")." ".$myrow[3]."=- ::" ; };// subj
                                         
                                          if ($b==4) { echo "". cmsg ("B_TAG").": ";tag ($myrow[4],"tag");echo "</tr>" ; };// tag
                                          if ($myrow[5]) if ($b==5) { echo "$myrow[5] :: ";player ($myrow[5]);echo "<br>"; };// vid
                                          if ($b==6) { echo " ".$myrow[6]."<br>"; };// vid
                                           if ($b==7) { echo date("d.m.Y H:i:s",$myrow[7])."<br>"; ; };// data
                                          if ($b==7) { echo "</ll></td></tr></table></div>";}

                                           if ($b>3) echo "</td>";

                                                                //if ($myrow[$a]>2) echo "<td><bb>".$myrow[$a]."</bb></td>";
                                                                                        }
                                       echo "</tr><br>";$hid="hidden";
                                                                                        }
                                
				}
                                ;
        }

//.flv

function player ($file) {
     ?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab
#version=8,0,0,0" width="320" height="260" id="fp" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="movie" value="player/fp.swf?video=<?=$file?>&image=img.jpg &title=my video" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="player/fp.swf?video=video/<?=$file;?>&image=img.jpg&title=my video" quality="high" bgcolor="#ffffff" width="320" height="260" name="fp" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>
<?
}
/*.*
function player ($file) {
     ?><object type="application/x-shockwave-flash" data="/player/player.swf" width="" height="">
        <param name="bgcolor" value="#cfffff" />
        <param name="allowFullScreen" value="true" />
        <param name="allowScriptAccess" value="always" />
        <param name="wmode" value="transparent" />
        <param name="movie" value="/player/player.swf" />
        <param name="flashvars" value="/video/<?=$file?>" />
        </object><?
}
 * *
 */
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
	$query="CREATE TABLE $tablename ( `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `user` text NOT NULL DEFAULT '0', `plevelview` int(2) unsigned NOT NULL DEFAULT '0', `subject` text NOT NULL, `gutentag` text NOT NULL, `video` text NOT NULL, `message` text NOT NULL, `data` text NOT NULL,PRIMARY KEY (`id`) )	ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;";
	$a=dbs_query ($query,$connect,$dbtype);
        
        if ($a==false) { sqlerr (); $mysqlanswer=false;} else {$mysqlanswer=true;};
        // внимание записи ВСЕХ существующих копий дбскрипт будут попадать в эти базы- модификации названия таблиц и т.п. пока отсутствуют CFG OPT FUTURE
## end of creating tables
        }
        return $mysqlanswer;

}

