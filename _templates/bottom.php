	<br>
			</div>
			<!-- end -->
		</div>
		<?php /*<!-- ����� ���� -->
		<!-- ������ ����� -->*/?>
		<div id="bottom">
			<ul class="second-navigation">
				<li><a href="http://dj.chg.su/dbscript" id="off_site"><?=cmsg ("DEVSIT")?></a></li>
				<li><a href="http://dj.chg.su/dbscript/DBSCRIPTinstruction.doc" id="sn_tutorials"><?=cmsg ("MANUAL")?></a></li>
				<li><a href="r.php?viewid=.ver&base=0" id="addons_download"><?=cmsg ("VERS")?></a></li>
				<li><a href="mailto:dj--alex@ya.ru" id="sn_signup"><?if ($codekey>6) lprint ("REGI_DBS");?></a></li>
			</ul>
			<div class="txt">
		<?php
		if (($prauth[$ADM][16]==false)AND($write==true) ) {
			$messageid=rmsg ($write);
			$msghelpid="F1_".$messageid;//	echo "msg for key $msghelpid is ".cmsg ($msghelpid)."<br>";
			lprint ($msghelpid);
		}
		
		
		?>
			</div>
			<div class="contact">
				<h6><?=cmsg ("CONINF")?></h6>
				<ul>
					<li><?=cmsg ("MAINDEV")?>: <a href="mailto:dj--alex@ya.ru?subject=DBscript">dj--alex</a></li>
					
					<li><?=cmsg ("DESIGN")?>: <a href="mailto:DeusModus@mail.ru?subject=DBscriptDESIGN">DeusModus</a></li>
                    	<li><?=cmsg ("ICQSUPPORT")?>: <a href="icq:492-386-106">Shkent</a></li>
				</ul>
			</div>
		</div>
		<?php /*<!-- ����� ������ ����� -->
		<!-- ������ ��� =) -->*/?>
		<div id="footer">
			<!-- ����� ����� ����� � ���� ������-��� ������� ������-->
	  </div>
		<?php /*<!-- ����� ������ ����-->
		<!-- �������� ���������   add by dj--alex  ��� �������� ������ �� pages.cfg,��������������--> */?>
		<ul id="navigation">
		<?php 		// function used li and ul tags function genericmenu
	
		for ($a=0;$a<64;$a++) {
	if ($pgheader[$a]==$languageprofile) $thislanguagepagescolumn=$a;
}
for ($a=0;$a<$pgcnt;$a++) {
    	if ($pgcontent[$a+1][1]=="") continue;
  $b=$a+1;
     $printmenuoption=$pgcontent[$b][3];
//��� openmenu ������ </li> �������� �������� ����
// ��� closemenu ������ <li> �������� </ut>
 if ($thislanguagepagescolumn) $printmenuoption=$pgcontent[$b][$thislanguagepagescolumn];
 if ($sd[19]=="utf-8") $printmenuoption=iconv("windows-1251","utf-8",$printmenuoption);
 if ($sd[19]=="utf-8") $pgcontent[$b][10]=iconv("windows-1251","utf-8",$pgcontent[$b][10]);
// $pgcontent[$b][8] - menu option  <ul> 1 - open 3 - close (only ending li tag)
     if ($pgcontent[$b][8]==1) { echo "<li id=".$b."><a href=\"#\">".$pgcontent[$b][10]."</a><ul class=\"menu\">"; $nolitag=1; } //opening menu id=".$b."
	if ($pgcontent[$b][8]!=="undefined") {echo "<li>";}// main li for menu opening  8
 if ($pgcontent[$b][9]!=1) {echo "<a href=\"".$pgcontent[$b][1]."\">".$printmenuoption."</a>"; }
 if ($pgcontent[$b][8]==3) { echo "</li></ul>";$nolitag=0; }// close menu
 if ($pgcontent[$b][8]!=="undefined") {echo "</li>"; }// close menu  main li for menu closing

 }  // c���� ����� ���� ����� �������� �� ���� ��������������� �� �����, �� � ���� ��� � ������. 
 // fuuuuuuuuuuuuuuuuuuuuuuuu  ���  ��� ����� ������ ���  ������ �� ��������.
    /*<!-- ����� ��������� -->*/ ?>
	</div>
                        <div class="service">Service provided by <a class="service" href="#">Dj--alex</a></div>
                        
</body>
</html>

