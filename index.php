<?php
	$market = "https://www.bitstamp.net/api/ticker/";
	$file = "tickerbitstamp.json";
	$last_mod = filemtime($file);

	if(time() >= $last_mod + (3)) { // 60 * 5 is 5 minutes
		$jsondata_market = file_get_contents($market);
		$json_market = json_decode($jsondata_market,true);
		$jsonsave = file_put_contents($file, json_encode($json_market));
	} else {
		return false;
	}
	$jsondata = file_get_contents($file);
	$json = json_decode($jsondata,true);
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $json["last"]." USD"; ?> - Bitcoin Info</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/png">
<!-- Created by Sandro Milhano. http://www.twitter.com/sandr0g -->
<style>
#container {
	text-align: center;
	border-style: solid;
	border-width: 2px;
	box-shadow:5px 5px 10px grey;
	width: auto;
	max-width: 500px;
	min-width: 300px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 30px;
	background: #f9f9f9;
}

.container2 {
	text-align: center;
	border-style: solid;
	border-width: 1px;
	border-radius: 3px;
	width: 200px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
}

.container3 {
	text-align: center;
	border-style: solid;
	border-width: 1px;
	border-radius: 3px;
	width: 200px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
}

#menu {
    padding: 10px;
    background: rgba(0, 0, 0, 0.5);
	border-style: solid;
	border-width: 1px;
	border-radius: 3px;
	box-shadow:5px 5px 10px grey;
}

li {
	display: inline;
    padding: 0px 10px 0px 10px;
}

body {
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
	width: auto;
	max-width: 500px;
	min-width: 300px;
}

h1 {
	text-decoration: underline;
}

#green {
	color: green;
}

#red {
	color: red;
}

#black {
	color: black;
}

header {
	text-align: center;
	width: auto;
	max-width: 500px;
	min-width: 300px;
	margin-left: auto;
	margin-right: auto;
}

a:visited {
	color: blue;
}
</style>
<meta http-equiv="refresh" content="3" >
</head>
<body>
	<header>
	<h1>Bitcoin Info Live</h1>
	
	<ul id="menu">
		<li><a href="http://mustsee.comli.com/">Bitstamp</a></li>
		<li><a href="#">MtGox</a></li>
		<li><a href="#">BTC-E</a></li>
	</ul>
	</header>
	<div id="container">
		<ul>

			<?php
				if ($json["last"] == $json["high"]) {
					echo "<div class='container3'><b><h3>"."24h HIGH!"."</h3></b></div>";
				}
				if ($json["last"] == $json["low"]) {
					echo "<div class='container3'><b><h3>"."24h LOW!"."</h3></b></div>";
				}
			?>

			<?php
			echo "<div class='container2'><h3>"."Last price: ".$json["last"]." USD"."</h3></div>";
			
			echo "<h2>Based on the last 24H:</h4>";
			
			$average = (($json["high"]+$json["low"])/2);
			$percentage = ((($json["last"]*100)/$average)-100);
			if ($percentage > 0) {
				echo "<p id='green'>"."+".round($percentage, 2)."%"."</p>";
			} elseif($percentage == 0) {
				echo "<p id='black'>".round($percentage, 2)."%"."</p>";
			} else {
				echo "<p id='red'>".round($percentage, 2)."%"."</p>";
			}
			
			echo "<h3>"."High: ".$json["high"]."</h3>";
			echo "<h3>"."Low: ".$json["low"]."</h3>";
			echo "<h3>"."Volume: ".$json["volume"]." BTC"."</h3>";
			?>
		</ul>
	</div>
	<br>
	<hr>
	Developed by: <a href="http://twitter.com/sandr0g" target="_blank">Sandro Milhano</a>
</body>
</html>
