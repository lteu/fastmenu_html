<?php

include_once("cgi-bin/com.configp.php");

$tables = array();

$query = "SELECT id,stato FROM tavoli";
$result = mysql_query($query);
if ($result) {
	while ($row = mysql_fetch_row($result)) {
	    $tables[] = array($row[0],$row[1]); 
	}
}
else{
	echo "sql error $query";
}

$operatore = $_SESSION['operatore'];

$tableshtml = "";
for ($i=0; $i < count($tables); $i++) { 
	$tid = $tables[$i][0];
	$tst = $tables[$i][1];

	if ($tst == "occupato") {
		$tableshtml .= "<a href='table.php?table=$tid'><button type='button' class='btn btn-warning btn-lg keypad'>$tid</button></a>";
	}else{
		$tableshtml .= "<a href='table.php?table=$tid'><button type='button' class='btn btn-info btn-lg keypad'>$tid</button></a>";
	}
}

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

		<script type='text/javascript' src='js/lib/jquery-1.8.3.min.js'></script>
		<link type='text/css' href='css/bootstrap.css' rel='stylesheet' />
		<script type='text/javascript' src='js/lib/bootstrap.min.js'></script>

		<link href="css/style.css" rel="stylesheet">

	</head>

	<body >


		<div class='container tablelist'>
			<nav class="navbar navbar-default" role="navigation">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li><a><div class="text-center">Lista tavoli</div></a></li>
                  <li><a><span class="glyphicon glyphicon-user"></span><?php echo $operatore; ?></a></li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </nav>

			<hr />
			<input class="form-control tablesearch" type="text" placeholder="Inseire ID tavolo per cercare">
			<br />
			<div class="tablePanel">
				<?php echo $tableshtml; ?>
		</div>
		</div>


		<div class="footer">
			<div class="container">
				<p class="muted credit">
					<button type="button" class="btn btn-info butt_libero">libero</button>
					<button type="button" class="btn btn-warning butt_occupato">occupato</button>
					<button type="button" class="btn btn-success butt_tutti">tutti</button>
				</p>
			</div>
		</div>

	</body>
	
	<script>
		arraytables = <?php  echo json_encode($tables); ?>;
	</script>
	<script type='text/javascript' src='js/tables.js'></script>
	</html>