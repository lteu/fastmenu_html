<?php

include_once "com.configp.php";



$tavolo = $_SESSION['tavolo'];

$now = time();
$id =  substr (md5($now), 5,16);

$querytavolo = "update tavoli set stato='occupato' where id = $tavolo ";
$queryconto = "insert into conti (id, totale, tavolo, stato, time) values('$id','0','$tavolo','aperto','$now')";

$r1 = mysql_query($querytavolo);
$r2 = mysql_query($queryconto);
if ($r1 && $r2) {
	echo "ok;$id";
}else{
	echo "$querytavolo $queryconto";
}




?>