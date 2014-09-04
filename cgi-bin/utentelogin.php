<?php

include_once "com.configp.php";

$pin = $_POST['pin'];


$query = "select nome from personali where codice = '$pin' ";
$res = mysql_query($query);
if ($res) {
	$row = mysql_fetch_row($res);
	if ($row == null) {
		$_SESSION['operatore'] = "demo";
		echo "codice personale sbagliato";
	}else{
		$nome = $row[0];
		$_SESSION['operatore'] = $nome;
		echo "ok";
	}	
}else{
	$_SESSION['operatore'] = "demo";
	echo "see: $queryadd";
}


?>