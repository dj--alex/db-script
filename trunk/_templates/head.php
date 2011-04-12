<head>	<style media="all" type="text/css">@import "_templates/style/style.css";</style>
	<script type="text/javascript" src="_templates/js/navigation.js"></script>
      
</head>
<? /*
<!--Дизайн от DeusModus, обитающего на форуме getmangos.org-->
*/?>
<body>
	<div id="container">
	<? /*	<!-- Шапка -->*/?>
		<div id="header">
			<a href="login.php"><img src="_templates/images/logo.gif" border=0 alt="" id="logo" /></a>
			
			<ul id="top-navigation">
			   <? $link="login.php"; if ($ADM>0) { $link="login.php?resetcookie=".cmsg(LOGOUT).""; } ?>
				<li><a href=<?=$link?> id="tn_login"><?
				if ($ADM==0) lprint (ENTER);
				if ($ADM>0) lprint (LOGOUT); 
			/* Это форма для поиска. Используй только её!
			<form action="#" class="search">
				<input type="text" class="text" >
				<input type="image" src="images/but_search.gif" value="search" >
			</form>
                        
			*/	?></a></li>
			</ul>
			
		</div>
		<? /*<!-- Конец шапки. -->
		<!-- Главное тело --> */?>
		<div id="mainx">
			<div class="doors" id="doors">
			</div>
			<? /*тут чето таблицы с широкими данными режутся, пришлось под X ить :) некрасиво, но зато работает*/?>
			<div class="wrapx" id="wrapx"> 
			<? /*<!-- В этом блоке должны находится все твои страницы.  1614 wphp--> */?>
			
			
