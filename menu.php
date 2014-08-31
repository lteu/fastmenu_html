<?php

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
	<div class='container'>
		<h2>Menu</h2>

		<input class="form-control" type="text" placeholder="Digita qualcosa per cercare il piatto">

		<div class="panel panel-success">
			<div class="panel-heading"><!-- item begins -->
				<h4 class="panel-title">#1 Risotto allo zafferano 10 euro
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
						<span class="pull-right">+</span>
					</a>
				</h4>
			</div>

			<div id="collapse1" class="panel-collapse collapse">
				<a  class="list-group-item" href="#">
					<span>Riso romano, zafferano, carne, brodo, pepe</span> <div class="pull-right"></div> 
					<div><input class="form-control" type="text" placeholder="inserire una nota"></div>
				</a>
			</div><!-- item ends -->

			<div class="panel-heading"><!-- item begins -->
				<h4 class="panel-title">#1 Fegato al mantovano 10 euro
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
						<span class="pull-right">+</span>
					</a>
				</h4>
			</div>

			<div id="collapse2" class="panel-collapse collapse">
				<a  class="list-group-item" href="#">
					<span>fegato di giorno, pepe, salsa di erba</span> <div class="pull-right"></div> 
					<div><input class="form-control" type="text" placeholder="inserire una nota"></div>
				</a>
			</div><!-- item ends -->

		</div>

	</div>

	<div class="footer">
		<div class="container">
			<p class="muted credit"><button type="button" class="btn btn-info">Azzera</button><button type="button" class="btn btn-primary"><a href="table.php">OK</a></button></p>
		</div>
	</div>
</body>

</html>