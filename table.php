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
		<h2>Ordini</h2>
		<div>totale:80 euro</div>

		<div class="panel panel-success">

			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">	
					<h4 class="panel-title">
						Pasta alle zucchine e gamberetti
						<div class="pull-right">+</div>
					</h4>
				</a>
			</div>

			<div id="collapse1" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="list-group">

						<a id="plate_6" class="list-group-item plate" href="#">
							#1 <span class="plate_name">richiesta</span> <div class="pull-right"><span class="price">operatore</span> 1</div> 
							<div>pasta deve essere morbida</div>

						</a>

					</div><!-- cls list group -->
				</div><!-- cls panel body -->
			</div><!-- cls panel collapse -->

			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">	
					<h4 class="panel-title">
						Tagliolini con le seppie
					</h4>
				</a>
			</div>


			<div class="panel-heading">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">	
					<h4 class="panel-title">
						Fegato al mantovano
						<div class="pull-right">+</div>
					</h4>
				</a>

			</div>

			<div id="collapse3" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="list-group">

						<a id="plate_6" class="list-group-item plate" href="#">
							#1 <span class="plate_name">richiesta</span> <div class="pull-right"><span class="price">operatore</span> 1</div> 
							<div>piccante</div>
						</a>

					</div><!-- cls list group -->
				</div><!-- cls panel body -->
			</div><!-- cls panel collapse -->
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="muted credit">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dialog">aggiungi</button>
				<button type="button" class="btn btn-info">modifica</button>
				<button type="button" class="btn btn-success"><a href="tables.php">sposta conto</a></button>
				<button type="button" class="btn btn-danger">Chiudi</button>
			</p>

		</div>
	</div>




<!-- Dialog of contact -->
<div id="dialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Aggiungi piatto manualemente</h4>
			</div>
			<div class="modal-body">
					<div class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-sm-2 control-label" for='nomepiatto'>Piatto:</label>
							<div class='col-sm-10'>
								<input id='nomepiatto'  class='form-control' placeholder="Nome piatto" type='text'  />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for='prezzopiatto'>Prezzo:</label>
							<div class='col-sm-10'>
								<input id='prezzopiatto'  class='form-control' placeholder="Prezzo piatto" type='text'  />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for='notepiatto'>Nota:</label>
							<div class='col-sm-10'>
								<input id='notepiatto'  class='form-control' placeholder="ingredienti, grado cottura etc (Facoltativo)" type='text'  />
							</div>
						</div>
					</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
				<button id='confermapiatto' type="button" class="btn btn-primary">Conferma</button>
			</div>
		</div>
	</div>
</div>
</body>
</html>