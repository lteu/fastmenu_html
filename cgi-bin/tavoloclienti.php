<?php

include_once "com.configp.php";


$idconto =  $_SESSION['idconto'];
$clienti =  $_POST['nclienti'];

$query = "update conti set clienti=$clienti where id = '$idconto' ";

$r1 = mysql_query($query);
if ($r1) {
	echo "ok";
}else{
	echo "$query";
}




?>