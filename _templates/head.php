<head>	<style media="all" type="text/css">@import "_templates/style/style.css";</style>
	<script type="text/javascript" src="_templates/js/navigation.js"></script>
      
</head>
<? /*
<!--������ �� DeusModus, ���������� �� ������ getmangos.org-->
*/?>
<body>
	<div id="container">
	<? /*	<!-- ����� -->*/?>
		<div id="header">
			<a href="login.php"><img src="_templates/images/logo.gif" border=0 alt="" id="logo" /></a>
			
			<ul id="top-navigation">
			   <? $link="login.php"; if ($ADM>0) { $link="login.php?resetcookie=".cmsg(LOGOUT).""; } ?>
				<li><a href=<?=$link?> id="tn_login"><?
				if ($ADM==0) lprint (ENTER);
				if ($ADM>0) lprint (LOGOUT); 
			/* ��� ����� ��� ������. ��������� ������ �!
			<form action="#" class="search">
				<input type="text" class="text" >
				<input type="image" src="images/but_search.gif" value="search" >
			</form>
                        
			*/	?></a></li>
			</ul>
			
		</div>
		<? /*<!-- ����� �����. -->
		<!-- ������� ���� --> */?>
		<div id="mainx">
			<div class="doors" id="doors">
			</div>
			<? /*��� ���� ������� � �������� ������� �������, �������� ��� X ��� :) ���������, �� ���� ��������*/?>
			<div class="wrapx" id="wrapx"> 
			<? /*<!-- � ���� ����� ������ ��������� ��� ���� ��������.  1614 wphp--> */?>
			
			
