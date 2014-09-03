<?php

include_once "com.configp.php";

$tavolo = $_SESSION['tavolo'];
$conto = $_POST['conto'];

$querysum = "SELECT sum(prezzo) FROM ordini WHERE refConto = '$conto'";
$qs = mysql_query($querysum);
$row = mysql_fetch_row($qs);
$sum = $row[0];

$query = "update tavoli set stato='libero' where id = $tavolo ";
$querychiudiconto = "update conti set stato='chiuso', totale='$sum' where id = '$conto' ";

$r1 = mysql_query($query);
$r2 = mysql_query($querychiudiconto);
if ($r1 && $r2) {
	echo "ok";
}else{
	echo "$querychiudiconto";
}


?>