<?php

include_once("cgi-bin/com.configp.php");

$_SESSION['tavolo'] = $_GET['table'];
$idtavolo = $_GET['table'];

//recuprra lista piatti
$listapiatti = array();
$query = " SELECT id, nome, prezzo, dettaglio FROM piatti";
$result = mysql_query($query);
if (!$result) {
	die("errore SQL $query");
} else {
	while($row = mysql_fetch_row($result)){
		$listapiatti[] = array($row[0], $row[1], $row[2],$row[3]);
	}
	
}

//recupera stato tavolo
$query = " SELECT stato FROM tavoli WHERE id = $idtavolo ";
$result = mysql_query($query);
$row = mysql_fetch_row($result);
$stato = $row[0];

if ($stato == "occupato") {
	$queryidconto = "SELECT id FROM conti WHERE stato = 'aperto' AND tavolo = '$idtavolo' ORDER BY time desc";
	$resultconto = mysql_query($queryidconto);
	if (!$resultconto) {
		echo "$queryidconto";
	}
	$row = mysql_fetch_row($resultconto);
	$idconto = $row[0];

	//$piatti = array();
	$msgpiatti = "";
	$querypiatti = "SELECT id,piatto,prezzo,nota FROM ordini WHERE refConto = '$idconto' ";
	$results = mysql_query($querypiatti);
	while($row = mysql_fetch_row($results)){
		//echo $row[1];
		$msgpiatti .= $row[0].";".$row[1].";".$row[2].";".$row[3]."@";
		//$piatti[] = array("id" => $row[0], "piatto" => $row[1], "prezzo" => $row[2],"nota" => $row[3]);
	}
	//echo "$idconto lla";
}

// $piatti = array(
// 	array(1,"spaghetti al mare","8","vongole fresche, pesce crudo"),
// 	array(2,"pasta al boscaiola","8","cotto, piselli, panna, pepe"),
// 	array(3,"caffè shakerato","1"),
// 	array(4,"espresso","1"),
// 	array(5,"caffè macchiato","1"),
// 	array(6,"carne al ferro","10","peperoncino salsa greca"),
// 	array(7,"stinco al camomila","12","camomila, stinco di modena, aceto balsamico"),
// 	array(8,"passetelle al brodo","6","pasta fatta a mano, brodo di vitello"),
// 	array(9,"ravioli al granchio","8","ravioli grandi con ripieno di granchio"),
// 	array(10,"torta alle carote","4")
// 	);


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
		<h3>
			<div class="pull-left">
				<a href="tables.php">
					<button class="btn btn-default">
						<span class="glyphicon glyphicon-arrow-left"></span>
					</button>
				</a>
			</div>
			<div class="text-center">
				Tavolo <?php echo $idtavolo; ?> - totale <span class="prezzototale">0</span>€
			</div>
		</h3>

		<hr />
		
		<div class="panel panel-default panellopiatti">
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="muted credit">
				<button type="button" class="btn btn-success apbutt">Apri</button>
				<button type="button" class="btn btn-primary funcbutt" data-toggle="modal" data-target="#dialog">Aggiungi</button>
				<button type="button" class="btn btn-warning funcbutt spbutt" data-toggle="modal" data-target="#dialogSpostaConto">Sposta</button>
				<button type="button" class="btn btn-danger funcbutt" data-toggle="modal" data-target="#dialogChiusura" >Chiudi</button>
			</p>
		</div>
	</div>

<!-- 
**********************************

			Dialoghi 

**********************************
-->


<!-- Dialogo per ordine -->
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

							<input id='nomepiatto'  class='form-control typeahead' placeholder="Nome piatto" type='text'  />

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
							<input id='notapiatto'  class='form-control' placeholder="ingredienti, grado cottura etc (Facoltativo)" type='text'  />
						</div>
					</div>
					<div class="ricetta">

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


<div id="dialogSpostaConto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Cambio tavolo</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-sm-2 control-label" for='nomepiatto'>Sposta a:</label>
						<div class='col-sm-10 listatavoli'>

							<div class="notif spostaNotif"></div>
						</div>
					</div>

				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
			</div>
		</div>
	</div>
</div>
<div id="dialogChiusura" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Chiusura Conto</h4>
			</div>
			<div class="modal-body">
				<h2>Siete sicuri di chiudere il conto?</h2>

				<h2 class="form-group">Totale:<span class="prezzototale"></span>€</h2>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button id='confermaChiusura' type="button" class="btn btn-primary">Conferma</button>
			</div>
		</div>
	</div>
</div>
</body>
<script>
arraypiatti = <?php  echo json_encode($listapiatti); ?>;
stato = <?php  echo json_encode($stato); ?>;
idconto = <?php  echo json_encode($idconto); ?>;
idtavolo = <?php  echo json_encode($idtavolo); ?>;
piattiltfomat = <?php  echo json_encode($msgpiatti); ?>;
	//var xx = jQuery.parseJSON(piattijsonobj);
	//var x = xx[0];
	//alert(piattijsonobj[0]);
	</script>
	<script type='text/javascript' src='js/ajax.js'></script>
	<script type='text/javascript' src='js/lib/typeahead.bundle.js'></script>
	<script type='text/javascript' src='js/table.js'></script>
	</html>