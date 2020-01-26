<?php

// ************************************************************************
// Class    AudioFile
// Version: 0.5.1
// Date:    17/04/2003
// Author:  michael kamleitner (mika@ssw.co.at)
//	    reto gassmann (gassi@gassi.cx) - additional mp3-code
// WWW:	    http://www.entropy.at/forum.php?action=thread&t_id=15 
//          (suggestions, bug-reports & general shouts are welcome)
// ************************************************************************

//	echo "Class    AudioFile  0.5.1 edited for mp3 parser v0.02 beta module version<br>";
//  Данный файл требуется для моей программы mp3pereimenovatel и используется AS IS.
class AudioFile
{
	var $wave_id;
	var $wave_type;
	var $wave_compression;
	var $wave_channels;
	var $wave_framerate;
	var $wave_byterate;
	var $wave_bits;
	var $wave_size;
	var $wave_filename;
	var $wave_length;
	
	var $id3_tag;
	var $id3_title;
	var $id3_artist;
	var $id3_album;
	var $id3_year;
	var $id3_comment;
	var $id3_genre;
	
	var $visual_graph_color;	// HTML-Style: "#rrggbb"
	var $visual_background_color;
	var $visual_grid_color;
	var $visual_border_color;
	var $visual_grid;		// true/false
	var $visual_border;		// true/false
	var $visual_width;		// width in pixel
	var $visual_height;		// height in pixel
	var $visual_graph_mode;		// 0|1
	var $visual_fileformat;		// "jpeg","png", everything & else default = "png"

	// ************************************************************************
	// mp3info extracts the attributes of mp3-files
	// (code contributed by reto gassmann (gassi@gassi.cx)
	// ************************************************************************			
	
	function mp3info()
	{
		$byte 			= array();
		$version 		= array("MPEG Version 2.5",false,"MPEG Version 2 (ISO/IEC 13818-3)","MPEG Version 1 (ISO/IEC 11172-3)");
		$version_bitrate	= array(1,false,1,0);
		$version_sampling	= array(2,false,1,0);
		$layer			= array(false,"Mp3","Mp2","Mp1");
		$layer_bitrate		= array(false,2,1,0);
		$layer_lengt		= array(false,1,1,0);
		$protection 		= array("Protected by CRC (16bit crc follows header)","Not protected");
		$byterate		= array(
						array(
							array("free",32,64,96,128,160,192,224,256,288,320,352,384,416,448,"bad"),
							array("free",32,48,56, 64, 80, 96,112,128,160,192,224,256,320,384,"bad"),
							array("free",32,40,48, 56, 64, 80, 96,112,128,160,192,224,256,320,"bad")
						     ),
						array(
							array("free",32,48,56, 64, 80, 96,112,128,144,160,176,192,224,256,"bad"),
							array("free", 8,16,24, 32, 40, 48, 56, 64, 80, 96,112,128,144,160,"bad"),
							array("free", 8,16,24, 32, 40, 48, 56, 64, 80, 96,112,128,144,160,"bad")
						     )
					       );
		$samplingrate		= array(
						array(44,48,32,false),
						array(22,24,16,false),
						array(11,12, 8,false)
					       );
		$cannel_mode	= array("Stereo","Joint stereo","Dual","Mono");
		$copyright	= array("Audio is not copyrighted","Audio is copyrighted ");
		$original	= array("Copy of original media","Original media"); 
		$emphasis	= array("none","50/15 ms",false,"CCIT J.17 ");
	
	//id3-stuff
	
	$genre			= array
					("Blues","Classic Rock","Country","Dance","Disco","Funk","Grunge","Hip-Hop","Jazz","Metal","New Age","Oldies","Other","Pop","R&B",
					"Rap","Reggae","Rock","Techno","Industrial","Alternative","Ska","Death Metal","Pranks","Soundtrack","Euro-Techno","Ambient","Trip-Hop",
					"Vocal","Jazz+Funk","Fusion","Trance","Classical","Instrumental","Acid","House","Game","Sound Clip","Gospel","Noise","Alternative Rock",
					"Bass","Soul","Punk","Space","Meditative","Instrumental Pop","Instrumental Rock","Ethnic","Gothic","Darkwave","Techno-Industrial",
					"Electronic","Pop-Folk","Eurodance","Dream","Southern Rock","Comedy","Cult","Gangsta","Top 40","Christian Rap","Pop/Funk","Jungle",
					"Native US","Cabaret","New Wave","Psychadelic","Rave","Showtunes","Trailer","Lo-Fi","Tribal","Acid Punk","Acid Jazz","Polka","Retro",
					"Musical","Rock & Roll","Hard Rock","Folk","Folk-Rock","National Folk","Swing","Fast Fusion","Bebob","Latin","Revival","Celtic","Bluegrass",
					"Avantgarde","Gothic Rock","Progressive Rock","Psychedelic Rock","Symphonic Rock","Slow Rock","Big Band","Chorus","Easy Listening","Acoustic",
					"Humour","Speech","Chanson","Opera","Chamber Music","Sonata","Symphony","Booty Bass","Primus","Porn Groove","Satire","Slow Jam","Club",
					"Tango","Samba","Folklore","Ballad","Power Ballad","Rhytmic Soul","Freestyle","Duet","Punk Rock","Drum Solo","Acapella","Euro-House",
					"Dance Hall","Goa","Drum & Bass","Club-House","Hardcore","Terror","Indie","BritPop","Negerpunk","Polsk Punk","Beat","Christian Gangsta Rap",
					"Heavy Metal","Black Metal","Crossover","Contemporary Christian","Christian Rock","Merengue","Salsa","Trash Metal","Anime","Jpop","Synthpop");
	
	//id3v2 check----------------------------
	
		$footer = 0;
		$header = 0;
		$v1tag	= 0;
		global $dir;// всегда NULL сцуко передает
//		$dir=$_POST["dir"];
		$wr = fopen ("mp3path.txt","r"); $dir=fread ($wr,1170);
		echo "directory for operations -- ".$dir."<br>";
                $dir=$dir."/";// LINUX ONLY  BUG FIXED  nO /
                
		$fp = fopen($dir.$this->wave_filename,"r");
		$tmp = fread($fp,3);
		if($tmp == "ID3")
		{
			$tmp 	= ord(fread($fp,1));
			$tmp2 	= ord(fread($fp,1));
			$info["mpeg_id3v2_tag"]["version"] = "ID3v2.".$tmp.".".$tmp2;
			$tmp 	= ord(fread($fp,1));
			if($tmp & 128)$info["mpeg_id3v2_tag"]["flag"]["unsync"] = "set";
			if($tmp & 64) $info["mpeg_id3v2_tag"]["flag"]["extended"] = "set";
			if($tmp & 32) $info["mpeg_id3v2_tag"]["flag"]["experimental"] = "set";
			if($tmp & 16)
			{
				$info["mpeg_id3v2_tag"]["flag"]["footer"] = "set";
				$footer = 10;
			}
			$tmp 	= ord(fread($fp,1))& 127;
			$tmp2 	= ord(fread($fp,1))& 127;
			$tmp3	= ord(fread($fp,1))& 127;
			$tmp4 	= ord(fread($fp,1))& 127;
			$info["mpeg_id3v2_tag"]["header_lenght"] = ($tmp * 2097152) + ($tmp2 * 16384) + ($tmp3 * 128) + $tmp4 + 10 + $footer;
			fseek ($fp,$info["mpeg_id3v2_tag"]["header_lenght"]);
			$header = $info["mpeg_id3v2_tag"]["header_lenght"];
		} else {
			fseek ($fp,0);
		//	$info["mpeg_id3v2_tag"] = false;
		}
	
		for ($x=0;$x<4;$x++)
		{
			$byte[$x] = ord(fread($fp,1));
		}
		fseek ($fp, -128 ,SEEK_END);
		$TAG = fread($fp,128);
		fclose($fp);
	
	//id tag?-------------------------------
	
		if(substr($TAG,0,3) == "TAG")
		{
			$v1tag = 128;
			$info["mpeg_id3v1_tag"]["title"] 	= substr($TAG,3,30);
			$info["mpeg_id3v1_tag"]["artist"] 	= substr($TAG,33,30);
			$info["mpeg_id3v1_tag"]["album"] 	= substr($TAG,63,30);
			$info["mpeg_id3v1_tag"]["year"] 	= substr($TAG,93,4);
			$info["mpeg_id3v1_tag"]["comment"] 	= substr($TAG,97,30);
			$info["mpeg_id3v1_tag"]["genre"]	= "";
			$tmp = ord(substr($TAG,127,1));
			if($tmp < count($genre))
			{
				$info["mpeg_id3v1_tag"]["genre"] = $genre[$tmp];
			}
		} else {
			$info["mpeg_id3v1_tag"] = false;
		}
	
	//version-------------------------------
	
		$tmp = $byte[1] & 24;
		$tmp = $tmp >> 3;
		$info_i["mpeg_version"] = $tmp;
		$byte_v = $version_bitrate[$tmp];
		$byte_vs = $version_sampling[$tmp];
		$info["mpeg_version"] = $version[$tmp];
	
	//layer---------------------------------
	
		$tmp = $byte[1] & 6;
		$tmp = $tmp >> 1;
		$info_i["mpeg_layer"] = $tmp;
		$byte_l = $layer_bitrate[$tmp];
		$byte_len = $layer_lengt[$tmp];
		$info["mpeg_layer"] = $layer[$tmp];
	
	//bitrate-------------------------------
	
		$tmp = $byte[2] & 240;
		$tmp = $tmp >> 4;
		$info_i["mpeg_bitrate"] = $tmp;
		$info["mpeg_bitrate"] = $byterate[$byte_v][$byte_l][$tmp]."kbps";
	
	//samplingrate--------------------------
	
		$tmp = $byte[2] & 12;
		$tmp = $tmp >> 2;
		$info["mpeg_sampling_rate"] = $samplingrate[$byte_vs][$tmp];
	
	//protection----------------------------
	
		$tmp = $byte[1] & 1;
		$info["mpeg_protection"] = $protection[$tmp];
		
	//paddingbit----------------------------
	
		$tmp = $byte[2] & 2;
		$tmp = $tmp >> 1;
		$byte_pad = $tmp;
		$info["mpeg_padding_bit"] = $tmp;
	
	//privatebit----------------------------
	
		$tmp = $byte[2] & 1;
		$byte_prv = $tmp;
	
	//channel_mode--------------------------
	
		$tmp = $byte[3] & 192;
		$tmp = $tmp >> 6;
		$info["mpeg_channel_mode"] = $cannel_mode[$tmp];
	
	//copyright-----------------------------
	
		$tmp = $byte[3] & 8;
		$tmp = $tmp >> 3;
		$info["mpeg_copyright"] = $copyright[$tmp];
	
	//original------------------------------
	
		$tmp = $byte[3] & 4;
		$tmp = $tmp >> 2;
		$info["mpeg_original"] = $original[$tmp];
		
	//emphasis------------------------------
	
		$tmp = $byte[3] & 3;
		$info["mpeg_emphasis"] = $emphasis[$tmp];
	
	//framelenght---------------------------
	
		if($byte_len == 0)
		{
			$rate_tmp = $info["mpeg_bitrate"] * 1000;
			$info["mpeg_framelenght"] = (12 * $rate_tmp / $info["mpeg_sampling_rate"] + $byte_pad) * 4 ;
		} elseif($byte_len == 1) {
			$rate_tmp = $info["mpeg_bitrate"] * 1000;
			$info["mpeg_framelenght"] = 144 * $rate_tmp / 
			$info["mpeg_sampling_rate"] + $byte_pad;
		}
		
	//duration------------------------------
	
		$tmp = filesize($dir.$this->wave_filename);
		$tmp = $tmp - $header - 4 - $v1tag;
		
		$tmp2 = 0;
		if ($info["mpeg_bitrate"]<>0)
		{
			$tmp2 = ((8 * $tmp) / 1000) / $info["mpeg_bitrate"];
		}
		$info["mpeg_frames"]="";
		if ($info["mpeg_framelenght"]<>0)
		{
			$info["mpeg_frames"] = floor($tmp/$info["mpeg_framelenght"]);
		}
		$tmp = $tmp * 8;
		$info["mpeg_playtime"]="";
		if ($rate_tmp<>0)
		{
			$info["mpeg_playtime"] = $tmp/$rate_tmp;
		}
		$info["mpeg_playtime"] = $tmp2;
	
		// transfer the extracted data into classAudioFile-structure
				
		
		$this->wave_id = "MPEG";
		$this->wave_type = $info["mpeg_version"];
		$this->wave_compression = $info["mpeg_layer"];
		$p4 = $info["mpeg_layer"];
		$this->wave_channels = $info["mpeg_channel_mode"];
		$p3 = $info["mpeg_channel_mode"];
		$this->wave_framerate = $info["mpeg_sampling_rate"];
		$p2 = $info["mpeg_sampling_rate"];
	    settype ($p2, string);
		$p2 = $p2."KHz";
		$this->wave_byterate = $info["mpeg_bitrate"];
		settype ($this->wave_byterate, string);
		$p1 = $this->wave_byterate ;
		$this->wave_bits = "n/a";
		$this->wave_size = filesize($dir.$this->wave_filename);
		$this->wave_size = number_format($this->wave_size,"-2");
		$this->wave_size = $this->wave_size[0].$this->wave_size[1].$this->wave_size[2].$this->wave_size[3]."Mb";
		$this->wave_length = $info["mpeg_playtime"];
		$this->wave_id = trim ($p1." ".$p2." ".$p4." ".$p3);


		$this->id3_tag = $info["mpeg_id3v1_tag"];
		
		if ($this->id3_tag)
		{
			$this->id3_title = $info["mpeg_id3v1_tag"]["title"];
          /*
           *               $this->id3_title = $info["mpeg_id3v2_tag"]["TIT2"];
           
                        print_r ($info);exit;
           * 	// id3v2-tags
	
	id3v2			false if id3v2-tags do not exist
	id3v2->TIT2		title
	id3v2->TPE1		artist
	id3v2->TOPE		original artist
	id3v2->TALB		album
	id3v2->TYER		year
	id3v2->COMM		comment
	id3v2->TCOM		composer
	id3v2->TCON		genre
	id3v2->TENC		encoder
	id3v2->WXXX		website
           */
			$this->id3_artist = $info["mpeg_id3v1_tag"]["artist"];
			$this->id3_album = $info["mpeg_id3v1_tag"]["album"];
			$this->id3_year = $info["mpeg_id3v1_tag"]["year"];
			$this->id3_comment = $info["mpeg_id3v1_tag"]["comment"];
			$this->id3_genre = $info["mpeg_id3v1_tag"]["genre"];
		}
	}

	// ************************************************************************
	// longCalc calculates the decimal value of 4 bytes
	// mode = 0 ... b1 is the byte with least value
	// mode = 1 ... b1 is the byte with most value
	// ************************************************************************			

	function longCalc ($b1,$b2,$b3,$b4,$mode)
	{
		$b1 = hexdec(bin2hex($b1));    					
		$b2 = hexdec(bin2hex($b2));    					
		$b3 = hexdec(bin2hex($b3));    					
		$b4 = hexdec(bin2hex($b4));    					
		if ($mode == 0)
		{
			return ($b1 + ($b2*256) + ($b3 * 65536) + ($b4 * 16777216));	
		} else {
			return ($b4 + ($b3*256) + ($b2 * 65536) + ($b1 * 16777216));
		}
	}

	// ************************************************************************
	// shortCalc calculates the decimal value of 2 bytes
	// mode = 0 ... b1 is the byte with least value
	// mode = 1 ... b1 is the byte with most value
	// ************************************************************************			

	function shortCalc ($b1,$b2,$mode)
	{
		$b1 = hexdec(bin2hex($b1));    					
		$b2 = hexdec(bin2hex($b2));    					
		if ($mode == 0)
		{
			return ($b1 + ($b2*256));	
		} else {
			return ($b2 + ($b1*256));
		}
	}
	
	// ************************************************************************
	// getCompression delivers a string which identifies the compression-mode 
	// of the AudioFile-Object 
	// ************************************************************************
	
	function getCompression ($id)
	{
		if ($this->wave_id <> "MPEG")
		{
			$append = "($id)";
			switch ($id)
			{
				case 0:  return ("unknown $append"); break;
				case 1:  return ("pcm/uncompressed $append"); break;
				case 2:  return ("microsoft adpcm $append"); break;
				case 6:  return ("itu g.711 a-law $append"); break;
				case 7:  return ("itu g.711 u-law $append"); break;			
				case 17:   return ("ima adpcm $append"); break;
				case 20:   return ("itu g.723 adpcm (yamaha) $append"); break;
				case 49:   return ("gsm 6.10 $append"); break;
				case 64:   return ("itu g.721 adpcm $append"); break;
				case 80:   return ("mpeg $append"); break;
				case 65536:return ("experimental $append"); break;
				default:   return ("not defined $append"); break;
			}	
		} else {
			return ($id);	
		}
	}
	
	// ************************************************************************
	// getVisualization creates a graphical visualization of the audio-sample
	//                  (works ONLY * for uncompressed waves!
	//                              * files with 1 or 2 channels
	//                              * 8/16/24/32 bit sample-resolution )
	// ************************************************************************			
	
	function getVisualization ($output)
	{
		$width=$this->visual_width;
		$height=$this->visual_height;
		$height_channel = $height / $this->wave_channels;
		if ($this->wave_filename<>"" && $this->wave_id == "RIFF" && $this->wave_type == "WAVE" && ($this->wave_channels>=1 && $this->wave_channels<=2) && $this->wave_bits%8==0)
		{
			$file = fopen ($this->wave_filename,"r");
			
			// read the first 12 bytes (RIFF- & WAVE-chunk)
			
			for ($i=0;$i<12;$i++)
			{
				$null = fgetc ($file);	
			}
			
			// Read the next chunk-id, supposed to be "fmt "
			
			$chunk_id_3 = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
			if ($chunk_id_3 == "fmt ")
			{				
				$chunk_size_3 = $this->longCalc (fgetc($file) , fgetc($file) , fgetc($file) , fgetc($file),0);
				for ($i=0;$i<$chunk_size_3;$i++)
				{
					$null = fgetc($file);
				}			
				
				// Read the next chunk-id, supposed to be "data"				
				$chunk_id_4 = "";
				while ($chunk_id_4 <> "data" && !feof($file))
				{
					$chunk_id_4 = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);	
					if ($chunk_id_4 <> "data")
					{
						$chunk_size_4 = $this->longCalc (fgetc($file) , fgetc($file) , fgetc($file) , fgetc($file),0);
						for ($i=0;$i<$chunk_size_4;$i++)
						{
							$null = fgetc($file);
						}			
					}
				}				
				if ($chunk_id_4 == "data")
				{					
					$chunk_size_4 = $this->longCalc (fgetc($file) , fgetc($file) , fgetc($file) , fgetc($file),0);
					$visualData = array();
					$bytes_per_frame = ($this->wave_bits/8)*($this->wave_channels);
					$bytes_per_channel = ($this->wave_bits/8);
					$frames = $chunk_size_4 / $bytes_per_frame;
					$visual_frames = ceil($frames / $width);
					$frame_index = 1;
					$data_index = 1;
					while (!feof($file))
					{												
						for ($j=0;$j<$this->wave_channels;$j++)
						{
							$bytes = array();
							for ($i=0;$i<$bytes_per_channel;$i++)
							{
								$bytes[$i] = fgetc($file);
							}
							if ($frame_index == $visual_frames)
							{
								switch ($bytes_per_channel)
								{
									case 1: $visualData[$j][$data_index]= $this->shortCalc($bytes[0],$bytes[1],0); 
										break;
									case 2: $f=128;
										if (ord($bytes[1])&128) $f = 0;
										$x=chr((ord($bytes[1])&127) + $f);
										$visualData[$j][$data_index]= floor($this->shortCalc($bytes[0],$x,0)/256); 
										break;
								}										
								if (($j+1) == $this->wave_channels)
								{
									$data_index++;									
									$frame_index = 1;	
								}
							} else {
								if (($j+1) == $this->wave_channels) $frame_index++;
							}							
						}						
					}					
					//$im = @ImageCreate ($width, (256*$this->wave_channels)+1) or die ("Cannot Initialize new GD image stream!");
					$im = @ImageCreate ($width, $height) or die ("Cannot Initialize new GD image stream!");
					$background_color = ImageColorAllocate ($im, hexdec(substr($this->visual_background_color,1,2)),hexdec(substr($this->visual_background_color,3,2)),hexdec(substr($this->visual_background_color,5,2)));
					$cBlack = ImageColorAllocate ($im, hexdec(substr($this->visual_background_color,1,2)),hexdec(substr($this->visual_background_color,3,2)),hexdec(substr($this->visual_background_color,5,2)));
					$cGreen = ImageColorAllocate ($im, hexdec(substr($this->visual_graph_color,1,2)),hexdec(substr($this->visual_graph_color,3,2)),hexdec(substr($this->visual_graph_color,5,2)));
					$cRed = ImageColorAllocate ($im, hexdec(substr($this->visual_border_color,1,2)),hexdec(substr($this->visual_border_color,3,2)),hexdec(substr($this->visual_border_color,5,2)));
					$cBlue = ImageColorAllocate ($im, hexdec(substr($this->visual_grid_color,1,2)),hexdec(substr($this->visual_grid_color,3,2)),hexdec(substr($this->visual_grid_color,5,2)));
					if ($this->visual_border)
					{
						ImageRectangle ($im,0,0,($width-1),($height-1),$cRed);
						for ($i=0;$i<=$this->wave_channels;$i++)
						{					
							ImageLine ($im,1,($i*($height_channel/2))+($height_channel/2),$width,($i*($height_channel/2))+($height_channel/2),$cRed);
						}
					}
					if ($this->visual_grid)
					{
						for ($i=1;$i<=($width/100*2);$i++)
						{
							ImageLine ($im,$i*50,0,$i*50,(256*$this->wave_channels),$cBlue);
						}					
					}
					
					// this for-loop draws a graph for every channel
					
					for ($j=0;$j<sizeof($visualData);$j++)
					{
						$last_x = 1;
						$last_y = $height_channel / 2;
						
						// this for-loop draws the graphs itself
						
						for ($i=1;$i<sizeof($visualData[$j]);$i++)
						{
							$faktor = 128 / ($height_channel / 2);
							$val = $visualData[$j][$i] / $faktor;
							if ($this->visual_graph_mode == 0)
							{																
								ImageLine ($im,$last_x,($last_y+($j*$height_channel)),$i,($val+($j*$height_channel)),$cGreen);
							} else {
								ImageLine ($im,$i,(($height_channel/2)+($j*$height_channel)),$i,($val+($j*$height_channel)),$cGreen);
							}
							$last_x = $i;
							$last_y = $val;
						}
					}
					
					// change this to generate JPG or direct output to browser
					
					if (strtolower($this->visual_fileformat) == "jpeg")
					{
						ImageJpeg ($im,$output);
					} else {
						ImagePng ($im,$output);					
					}
				}
			}
			fclose ($file);
		} else {
			// AudioSample - AudioFile-Object not initialized!
		}
	}
	
	// ************************************************************************
	// getSampleInfo extracts the attributes of the AudioFile-Object
	// ************************************************************************			

	function getSampleInfo ()
	{				
		$valid = true;

		if (strstr(strtoupper($this->wave_filename),"MP3"))
		{
			$this->mp3info ();
		} else {
		
			$this->wave_size = filesize ($this->wave_filename);
			if ($this->wave_size > 16)
			{				
				$file = fopen ($this->wave_filename,"r");
				$chunk_id = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);			
				$null = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
				$chunk_id_2 = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
				$this->wave_id = $chunk_id;
				$this->wave_type = $chunk_id_2;
				if (substr($chunk_id,0,2)=="PK")
				{
					// it's a ZIP-file	
					
					$this->wave_id = "ZIP";
					$this->wave_type = "ZIP";
					$this->valid = true;
				} else {
					if ($this->wave_id == "RIFF" && $this->wave_type == "WAVE")
					{
						// it's a Wave-File
						
						$chunk_id = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
						$chunk_size = $this->longCalc (fgetc($file) , fgetc($file) , fgetc($file) , fgetc($file),0);
						if ($chunk_id == "fmt ")
						{
							$format_len = $chunk_size;
							$this->wave_compression = $this->shortCalc (fgetc ($file), fgetc ($file),0);
							$this->wave_channels = $this->shortCalc (fgetc ($file), fgetc ($file),0);
							$this->wave_framerate = $this->longCalc (fgetc ($file), fgetc ($file), fgetc ($file), fgetc ($file),0);
							$this->wave_byterate = $this->longCalc (fgetc ($file), fgetc ($file), fgetc ($file), fgetc ($file),0);
							$null = fgetc($file) . fgetc($file);
							$this->wave_bits = $this->shortCalc (fgetc ($file), fgetc ($file),0);
							$read = 16;
							if ($read < $format_len)
							{
								$extra_bytes = $this->shortCalc (fgetc ($file), fgetc ($file),1);
								$j = 0;
								while ($j < $extra_bytes && !feof($file))
								{
									$null = fgetc ($file);
									$j++;
								}
							}
							$chunk_id = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);					
							$chunk_size = $this->longCalc (fgetc($file) , fgetc($file) , fgetc($file) , fgetc($file),0);
							if ($chunk_id == "data")
							{
								$this->wave_length = (($chunk_size / $this->wave_channels) / ($this->wave_bits/8)) / $this->wave_framerate;								
							} else {
								while ($chunk_id <> "data" && !feof($file))
								{										
									$j = 1;
									while ($j <= $chunk_size && !feof($file))
									{
										$null = fgetc ($file);
										$j++;
									}
									$chunk_id = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
									//print "<br>$chunk_id*";
									$chunk_size = $this->longCalc (fgetc($file) , fgetc($file) , fgetc($file) , fgetc($file),0);
								}	
								if ($chunk_id == "data")
								{
									$this->wave_length = (($chunk_size / $this->wave_channels) / ($this->wave_bits/8)) / $this->wave_framerate;									
								}					
				
							}
						} else {
							$valid = false;	
						}
					} else {
						if ($this->wave_id == "FORM" && $this->wave_type == "AIFF")
						{
							// we have a AIFF file here
							
							$chunk_id = fgetc($file) . fgetc($file) . fgetc($file) . fgetc($file);
							$chunk_size = $this->longCalc (fgetc($file) , fgetc($file) , fgetc($file) , fgetc($file),0);
							if ($chunk_id == "COMM")
							{
								$format_len = $chunk_size;
								$this->wave_channels = $this->shortCalc (fgetc ($file), fgetc ($file),1);
								$null = $this->longCalc (fgetc ($file), fgetc ($file), fgetc ($file), fgetc ($file),1);
								$this->wave_bits = $this->shortCalc (fgetc ($file), fgetc ($file),1);
								$null = fgetc ($file) . fgetc ($file);
								$this->wave_framerate = $this->shortCalc (fgetc ($file), fgetc ($file),1);
								
								$read = 16;
							} else {
								$valid = false;
							}
						} else {
							// probably crap
							
							$valid = false;	
						}
					}
				}
				fclose ($file);	
			} else {
				$valid = false;	
			}
			return ($valid);
		}
	}
	
	// ************************************************************************
	// printSampleInfo prints the attributes of the AudioFile-Object
	// ************************************************************************
	
	function printSampleInfo()
	{	
		print "<table width=100% border=1>";
	
		
		if ($this->id3_tag)
		{
			print "<tr><td align=right>id3v1-tags</td><td>";
			print "<table width=100% border=1>";
			print "<tr><td align=right>artist</td><td>&nbsp;$this->id3_artist</td></tr>";	
			print "<tr><td width=70 align=right>title</td><td>&nbsp;$this->id3_title</td></tr>";	
			print "<tr><td align=right>album</td><td>&nbsp;$this->id3_album</td></tr>";	
			print "<tr><td align=right>year</td><td>&nbsp;$this->id3_year</td></tr>";	
		//	print "<tr><td align=right>comment</td><td>&nbsp;$this->id3_comment</td></tr>";	
		//	print "<tr><td align=right>genre</td><td>&nbsp;$this->id3_genre</td></tr>";	
			print "</table>";	
			print "</td></tr>";
		}
		else
		{
			print "<tr><td align=right>id3v1-tags</td><td>Not found</td></tr>";		
		}
			print "<tr><td align=right>filename</td>		<td>&nbsp;$this->wave_filename</td></tr>";
			print "<tr><td align=right>№</td>		<td>&nbsp;0</td></tr>";
	 	print "<tr><td align=right>properties</td>		<td>&nbsp;$this->wave_id</td></tr>"; //Wave-id become PROPERTIES
	//	print "<tr><td align=right>type</td>	<td>&nbsp;$this->wave_type</td></tr>";
		//print "<tr><td align=right>byterate</td>	<td>&nbsp;$this->wave_byterate</td></tr>"; 
		//print "<tr><td align=right>framerate</td>	<td>&nbsp;$this->wave_framerate</td></tr>";
		//print "<tr><td align=right>compression</td>	<td>&nbsp;".$this->getCompression ($this->wave_compression)."</td></tr>";
		//print "<tr><td align=right>channels</td>	<td>&nbsp;$this->wave_channels</td></tr>";
		//print "<tr><td align=right>properties</td>	<td>&nbsp;".$properties."</td></tr>"; --NOWORK!!!
		print "<tr><td align=right>length</td>	<td>&nbsp;".date("h:i:s", mktime(0,0,round($this->wave_length)))."</td></tr>";
		print "<tr><td align=right>size</td>	<td>&nbsp;$this->wave_size</td></tr>";
	//	print "<tr><td align=right>bits</td>	<td>&nbsp;$this->wave_bits</td></tr>";
		print "</table>";//number_format ($this->wave_length,"0")." sec.<br>&nbsp;".
		// исправление изначальной ошибки с id_artist и подготовка к заливке в базу строки
		// DETECT ARTIST
		$this->id3_artist = substr(strtoupper($this->id3_artist),0,strpos ($this->wave_filename," - "));
		// РАСПОЗНАНИЕ ИМЕНИ
                global $runonce;// ему в принципе похрен, переменную оттуда видимо не достать, токо через файл, тупо но надежно
		$this->id3_title = substr($this->wave_filename,strpos ($this->wave_filename," - ")+3,strlen ($this->wave_filename)-4-3-strpos ($this->wave_filename," - ")); 
		if (!$runonce) $dbstring= $this->id3_artist.";".$this->id3_title.";".$this->id3_album.";0;".$this->wave_id.";"."0:".date("i:s", mktime(0,0,round($this->wave_length))).";".$this->wave_size."\n";
                if ($runonce) $dbstring= $this->id3_artist.";".$this->id3_title.";".$this->id3_album.";0;".$this->wave_id.";"."0;0;\n";
		 echo $dbstring;
                 
		//  процедура создания CSV-массива по правилам cat al - добавление только одной строки в файл.
		$wr = fopen ("info.csv","a+");
		if (!$disablewriting) $err=fwrite ($wr,$dbstring);
                if ($runonce) $disablewriting=1;// при этом параметре будет только 1 сокращенная запись.
                echo "Status:$err<br>";
		
	




		// запуск по очереди всех имеемых файлов будет производится из основной процедуры


	}
	// ************************************************************************
	// loadFile initializes the AudioFile-Object
	// ************************************************************************		
		
	function loadFile ($loadFilename)
	{
		$this->wave_filename = $loadFilename;
		$this->getSampleInfo ();
		$this->visual_graph_color = "#18F3AD";
		$this->visual_background_color = "#000000";
		$this->visual_grid_color = "#002C4A";
		$this->visual_border_color = "#A52421";
		$this->visual_grid = true;
		$this->visual_border = true;
		$this->visual_width = 600;
		$this->visual_height = 512;
		$this->visual_graph_mode = 1;
		$this->visual_fileformat = "png";
	}
}	
?>
