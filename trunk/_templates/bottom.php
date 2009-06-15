	<br>
			</div>
			<!-- end -->
		</div>
		<? /*<!-- Конец тела -->
		<!-- Нажняя часть -->*/?>
		<div id="bottom">
			<ul class="second-navigation">
				<li><a href="http://dj.chg.su/dbscript" id="off_site"><?=cmsg (DEVSIT)?></a></li>
				<li><a href="http://dj.chg.su/dbscript/DBSCRIPTinstruction.doc" id="sn_tutorials"><?=cmsg (MANUAL)?></a></li>
				<li><a href="r.php?viewid=.ver&base=0" id="addons_download"><?=cmsg (VERS)?></a></li>
				<li><a href="mailto:dj--alex@ya.ru" id="sn_signup"><?if ($codekey>6) lprint (REGI_DBS);?></a></li>
			</ul>
			<div class="txt">
		<? 
		if (($prauth[$ADM][16]==false)AND($write==true) ) {
			$messageid=rmsg ($write);
			$msghelpid="F1_".$messageid;//	echo "msg for key $msghelpid is ".cmsg ($msghelpid)."<br>";
			lprint ($msghelpid);
		}
		
		
		?>
			</div>
			<div class="contact">
				<h6><?=cmsg (CONINF)?></h6>
				<ul>
					<li><?=cmsg (MAINDEV)?>: <a href="#">dj--alex@ya.ru</a></li>
					
					<li><?=cmsg (DESIGN)?>: <a href="#">DeusModus@Mangos.ru</a></li>
				</ul>
			</div>
		</div>
		<? /*<!-- конец нижней части -->
		<!-- совсем низ =) -->*/?>
		<div id="footer">
			<a href="#" target="_blank">Designed by DeusModus</a><br />
	  </div>
		<? /*<!-- конец совсем низа-->
		<!-- дочерняя навигация   add by dj--alex  тут получаем данные из pages.cfg,языкозависимые--> */?>
		<ul id="navigation">
		<?
		// function used li and ul tags function genericmenu 
	
		for ($a=0;$a<15;$a++) {
	if ($pgheader[$a]==$languageprofile) $thislanguagepagescolumn=$a;
} 
for ($a=0;$a<$pgcnt;$a++) {
    	if ($pgcontent[$a+1][1]=="") continue;
  $b=$a+1;
     $printmenuoption=$pgcontent[$b][3];
 if ($thislanguagepagescolumn) $printmenuoption=$pgcontent[$b][$thislanguagepagescolumn];
     //....if ($pgcontent[$b][8]==1) { echo "<ul>"; }
 if ($pgcontent[$b][9]!=1) echo "<li><a href=\"".$pgcontent[$b][1]."\">".$printmenuoption."</a></li>"; // target=\"_top\"  echo "onClick=\"MM";
// if ($pgcontent[$b][8]==2) { echo "</ul>"; }
 }  // cцуко бажит блин сутки потратил но меню разворачиваться не хочет, ну и туды его в качель. 
 
    /*<!-- конец навигации -->*/ ?>
	</div>
</body>
</html>
                        <div style="text-align: center; margin-top: 1.0em;">
                        Service provided by <a href="#">Dj--alex</a>
                        </div>
                