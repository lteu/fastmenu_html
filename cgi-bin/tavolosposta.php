<?php

include_once "com.configp.php";

$daTavolo = $_SESSION['tavolo'];
$aTavolo = $_POST['tavolo'];


$query1 = "update tavoli set stato='occupato' where id = $aTavolo ";
$query2 = "update tavoli set stato='libero' where id = $daTavolo ";
$query3 = "update conti set tavolo=$aTavolo where tavolo = $daTavolo ";

$r1 = mysql_query($query1);
$r2 = mysql_query($query2);
$r3 = mysql_query($query3);

if ($r1 && $r2 && $r3) {
	echo "ok";
}else
echo "no";

?>