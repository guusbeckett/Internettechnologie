<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>	
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/animations.css">
	<script src="js/jquery-1.11.0.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.simpleWeather/3.0.2/jquery.simpleWeather.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<div class="container mainBlock">
		<div class="menu">
			<img src="img/ComfyCorpLogoConcept.png">
			<h1>Comfy Corp</h1>
		</div>
		<div class="banner">
			<div class="like pulse"><a href="#"><img class="heart" src="img/icon/heart.png"> Like?</a></div>
			<div class="title slideUp">Koude Kerst 2</div>
			<div class="subtitle slideUp">Sven van Heugten</div>
			<div class="bottom">
				<div id="play" class="item active">
					<div class="colorbar purple stretchRight"></div>
					<i class="fa fa-play"></i> Stream
				</div>
				<div id="nieuws" class="item">
					<div class="colorbar orange stretchRight"></div>
					<i class="fa fa-newspaper-o"></i> Nieuws
				</div>
				<div id="weer" class="item">
					<div class="colorbar blue stretchRight"></div>
					<i class="fa fa-cloud"></i> Weer
				</div>
			</div>
		</div>
		<div id="stream" class="content">
			Hier is stream straks
		</div>
		<div id="news" class="content">
			hier is news hier
		</div>
		<div  id="weather" class="content">
			<div id="weatherdiv"></div>
		</div>
	</div>
</body>
</html>