<!doctype html>
<html lang="en">
<head>
	<title><?= isset($title) ? $title : 'Stylite' ?></title>

	<script type="text/javascript" src="//use.typekit.net/tod8kni.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link rel="icon" type="image/ico" href="favicon.ico"/>
	<?php echo Asset::css('main.css'); ?>

	<script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
	<?php echo Asset::js('jquery.countdown.min.js'); ?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-34570029-1']);
			_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
  </script>
</head>
<body class="tk-apertura">
<div id="container">
<div id="wrapper">
	<header>
		<h1 title="logo"></h1>
		<nav>
			<ul>
				<li><a href="#app" class="active">App</a></li>
				<li><a href="#launch">Launch</a></li>
				<li><a href="#architects">Architects</a></li>
			</ul>
		</nav>
	</header>
	
	<?= isset($content) ? $content : null ?>
	
</div><!-- close WRAPPER -->
</div><!-- close CONTAINER -->

<?= Asset::js('main.js') ?>
<?= Casset::render_js() ?>

</body>
</html>