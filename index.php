<?php

include_once("cgi-bin/com.configp.php");

?>

<!DOCTYPE html>
<html>

<head>
	<title>Fast Menu</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name='Description' content='fast menu mockup' />
	<meta name="author" content="liu tong">
	<link rel="shortcut icon" href="favicon.ico">

	<script type='text/javascript' src='js/lib/jquery-1.7.2.min.js'></script>
	<link type='text/css' href='css/bootstrap.css' rel='stylesheet' />
	<script type='text/javascript' src='js/lib/bootstrap.min.js'></script>

	<link href="css/style.css" rel="stylesheet">
</head>

<body >
	<div class=''>
		<h2 class="text-center">Fast Menu</h2>

		<button type="button" class="btn btn-primary btn-lg keypad">1</button>
		<button type="button" class="btn btn-primary btn-lg keypad">2</button>
		<button type="button" class="btn btn-primary btn-lg keypad">3</button>
		<button type="button" class="btn btn-primary btn-lg keypad">4</button>
		<button type="button" class="btn btn-primary btn-lg keypad">5</button>
		<button type="button" class="btn btn-primary btn-lg keypad">6</button>
		<button type="button" class="btn btn-primary btn-lg keypad">7</button>
		<button type="button" class="btn btn-primary btn-lg keypad">8</button>
		<button type="button" class="btn btn-primary btn-lg keypad">9</button>
		<div class="notif"></div>
	</div>

	<div id="footer">
		<div class="container">
			<div class="text-muted text-center">Inserire pin per loggarsi oppure clicca <a href="tables.php">DEMO</a></div>
		</div>
	</div>

</body>
<script type='text/javascript' src='js/login.js'></script>
</html>