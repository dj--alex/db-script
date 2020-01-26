<?php

// ************************************************************************
// Program: test.php
// Version: 0.5.1
// Date:    17/04/2003
// Author:  michael kamleitner (mika@ssw.co.at)
// WWW:	    http://www.entropy.at/forum.php?action=thread&t_id=15 
//          (suggestions, bug-reports & general shouts are welcome)
// Desc:    this test-script lists all audio-files (.wav, .aif, .mp3)
//          which reside in the ./ directory. If a file is selected,
//          it is loaded and its audio-attributes are displayed.
// ************************************************************************
	
	require ('classAudioFile.php');

	print "<html><head>";	
	print "<link rel=\"stylesheet\" type=\"text/css\" href=\"./global.css\">";
   	print "<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">";
	print "<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">";
	print "</head><body>";
	echo "<b><a href=info.csv>Data created to info.csv</a></b>";
	print "<table border=1>";
	print "<tr><td valign=top>";
	
	echo "mp3 parser v0.02 beta module version<br>";
	$path=str_replace ( "\\","/",$path);
	$dir=$path.$filetoaction."/";
	echo "получен путь $path.$filetoaction<br>";
//	$handle=opendir('./');
	$wr = fopen ("mp3path.txt","w"); $err=fwrite ($wr,$dir);
	fclose ($wr);
//	$handle=opendir ($dir);
	$handle=opendir ($dir);


	while (false !== ($file = readdir($handle))) 
	{ 
    		if ($file <> "." && $file <> "..")
    		{
	    		if ( (substr(strtoupper($file),strlen($file)-4,4)==".WAV") ||
	    		     (substr(strtoupper($file),strlen($file)-4,4)==".AIF") ||
	    		     (substr(strtoupper($file),strlen($file)-4,4)==".MP3") )
	    		{
	    		     	print "<a href=\"./test.php?filename=$file\">$file</a><br>"; //вывод имени файла
						if  ($file<> "")
	{	
		$AF = new AudioFile; //($HTTP_GET_VARS[filename] переглючено на полный вывод :)
		$AF->loadFile($file);
		$AF->printSampleInfo();
		if ($AF->wave_id == "RIFF")
		{
			$AF->visual_width=600;
			$AF->visual_height=500;
			$AF->getVisualization(substr($file,0,strlen($file)-4).".png");
			print "<img src=./".substr($file,0,strlen($file)-4).".png>";
		}
	}
	    		} else {
	    		}
	    	}
	}
	
	print "</td><td valign=top>";
	

	print "</td></tr></table></body></html>";
?>