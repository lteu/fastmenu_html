<?php

include_once "com.configp.php";

$nm = $_POST['nm'];
$pz = $_POST['pz'];
$id = $_POST['id'];
$ig = $_POST['ig'];
$ct = $_POST['ct'];




$query = " SELECT id FROM piatti WHERE nome = '$nm' ";
$result = mysql_query($query);
if (!$result) {
	die("errore SQL $query");
} else {
	$row = mysql_fetch_row($result);
	if ($row == null) {
		$queryadd = "insert into piatti (id,nome,prezzo,dettaglio,categoria) values ('$id','$nm','$pz','$ig','$ct')";
		$res = mysql_query($queryadd);
		if ($res) {
			echo "ok";
		}else{
			echo "see: $queryadd";
		}
	}else{
		$querymof = "update piatti set id = '$id', prezzo = '$pz', dettaglio='$ig',categoria = '$ct' where nome = '$nm' ";
		$res2 = mysql_query($querymof);
		if ($res2) {
			echo "ok";
		}else{
			echo "see: $querymof";
		}
	}
}


?>