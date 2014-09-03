<?php

include_once "com.configp.php";

$conto = $_POST['conto'];
$piatto = $_POST['piatto'];
$prezzo = $_POST['prezzo'];
$nota = $_POST['nota'];
$piattoid = $_POST['piattoid'];


$query = " INSERT INTO ordini (id,piatto,prezzo,nota,refConto) VALUES ('$piattoid','$piatto','$prezzo','$nota','$conto')";
$result = mysql_query($query);
if (!$result) {
	die("errore SQL $query");
} else {
	echo "ok";
}


?>