<?php

include_once "com.configp.php";

$nm = $_POST['nm'];
$pn = $_POST['pn'];
$dr = $_POST['dr'];

$queryadd = "insert into personali (nome,codice,diritto) values ('$nm','$pn','$dr')";
$res = mysql_query($queryadd);
if ($res) {
	echo "ok";
}else{
	echo "see: $queryadd";
}


?>