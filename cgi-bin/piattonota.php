<?php

include_once "com.configp.php";


$piattoid = $_POST['piattoid'];
$nota = $_POST['nota'];

$query = "update ordini set nota='$nota' where id = '$piattoid' ";
$r = mysql_query($query);


if ($r) {
	echo "ok";
}else
echo "no $query";

?>