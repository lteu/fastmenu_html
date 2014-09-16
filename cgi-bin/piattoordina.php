<?php

include_once "com.configp.php";

$conto = $_POST['conto'];
$piatto = $_POST['piatto'];
$prezzo = $_POST['prezzo'];
$nota = $_POST['nota'];
$piattoid = $_POST['piattoid'];

$timeid = time();

$query1 = " SELECT id FROM piatti WHERE nome = '$piatto' ";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_row($result1);
if ($row1 == null) {
	$query2 = " INSERT INTO piatti (id,nome,prezzo) VALUES ('$timeid','$piatto','$prezzo')";
	mysql_query($query2);
}

$query = " INSERT INTO ordini (id,piatto,prezzo,nota,refConto) VALUES ('$piattoid','$piatto','$prezzo','$nota','$conto')";
$result = mysql_query($query);
if (!$result) {
	die("errore SQL $query");
} else {
	echo "ok";
}


?>