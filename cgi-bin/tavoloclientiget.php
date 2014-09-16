<?php

include_once "com.configp.php";


$_SESSION['idconto'] = $idconto;

$query = "select clienti from conti where id = $idconto ";

$r1 = mysql_query($query);
if ($r1) {
	$row = mysql_fetch_row($r1);
	$clienti = $row[0];
	echo $clienti;
}else{
	echo "$query";
}




?>