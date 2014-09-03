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

// $tables = array(
// 	array(1,"libero"),
// 	array(2,"occupato"),
// 	array(3,"libero"),
// 	array(4,"libero"),
// 	array(5,"libero"),
// 	array(6,"libero"),
// 	array(7,"libero"),
// 	array(8,"libero"),
// 	array(9,"libero"),
// 	array(10,"libero")
// 	);


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
			<h2 class="text-center">Lista tavoli</h2>
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