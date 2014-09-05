<?php

include_once("cgi-bin/com.configp.php");

$coperto = 3;
$copertohtml = "value = '$coperto' ";

$_SESSION['tavolo'] = $_GET['table'];
$idtavolo = $_GET['table'];

$operatore = $_SESSION['operatore'];

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

//recuprra lista piatti popolari
$piattipop = "";
$query = "SELECT piatto, count(*) FROM ordini GROUP BY piatto ORDER BY 2 DESC LIMIT 5";
$result = mysql_query($query);
if (!$result) {
	die("errore SQL $query");
} else {
	while($row = mysql_fetch_row($result)){
		$piattipop .= "<button type='button' class='btn btn-default btn-sm'>".$row[0]."</button>";
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

	<div class='container contentwrapper'>

		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header pull-left">
				<a class="navbar-brand" href="tables.php"><span class="glyphicon glyphicon-arrow-left"></span> </a>
			</div>

			<div class="navbar-brand pull-right">
				Tav <?php echo $idtavolo; ?> -  <span class="prezzototale">0</span>€ | <span class="glyphicon glyphicon-user"> </span> <?php echo $operatore; ?>
			</div>
		</nav>

		<div class="servizio-wrapper">
				<span class="personehtm">0</span> persone
				<span class="glyphicon glyphicon-remove"></span>
				coperto <?php echo $coperto;?> € <span class="copertohtm"></span> = <span class="prezzosingolo">0</span> €

				<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#dialogCoperto">
					<span class="glyphicon glyphicon-refresh"></span>
				</button>
		</div>
		<div class="panel panel-default panellopiatti">
			
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<p class="muted credit">
				<div class="btn-toolbar">
					<button type="button" class="btn btn-success apbutt">Apri</button>
					<div class="btn-group fgroup">
						<button type="button" class="btn btn-default btn-warning ">
							<span class="glyphicon glyphicon-cutlery"></span>
						</button>
						<button type="button" class="btn btn-default btn-warning funcbutt" data-toggle="modal" data-target="#dialog">Aggiungi</button>
					</div>

					<div class="btn-group fgroup">

						<button type="button" class="btn btn-default funcbutt spbutt" data-toggle="modal" data-target="#dialogSpostaConto">Sposta</button>
						<button type="button" class="btn btn-default funcbutt" data-toggle="modal" data-target="#dialogChiusura">Chiudi</button>
					</div>
				</div>

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
				<h4 class="modal-title">Aggiungi piatto</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal" role="form">
					<div class="form-group">
						<label class="col-sm-2 control-label" for='nomepiatto'>Piatto:</label>
						<div class='col-sm-10'>
							<input id='nomepiatto'  class='typeahead form-control ' placeholder="Nome piatto" type='text'  />
							<p class="err-explain exp1"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for='prezzopiatto'>Prezzo:</label>
						<div class='col-sm-10'>
							<input id='prezzopiatto'  class='form-control' placeholder="Prezzo piatto" type='text'  />
							<p class="err-explain exp2"></p>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for='notepiatto'>Nota:</label>
						<div class='col-sm-10'>
							<input id='notapiatto'  class='form-control' placeholder="ingredienti, grado cottura etc (Facoltativo)" type='text'  />
							<p class="err-explain exp3"></p>
						</div>
					</div>

					<div class="ricetta">
					</div>

					<div class="piattipop">
						<?php echo $piattipop; ?>
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

<div id="dialogCoperto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Numero di persone e coperto</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
						<label class="col-sm-2 control-label" for='numpersone'>Persone:</label>
						<div class='col-sm-10'>
							<select id='numpersone' class="form-control">
								  <option value="1">1</option>
								  <option value="2">2</option>
								  <option value="3">3</option>
								  <option value="4">4</option>
								  <option value="5">5</option>
								  <option value="6">6</option>
								  <option value="7">7</option>
								  <option value="8">8</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label" for='prezzocoperto'>Coperto:</label>
						<div class='col-sm-10'>
							<input id='prezzocoperto'  class='form-control' placeholder="Prezzo piatto" <?php echo $copertohtml ?> type='text'  />
						</div>
					</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				<button id='confermaCoperto' type="button" class="btn btn-primary">Conferma</button>
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