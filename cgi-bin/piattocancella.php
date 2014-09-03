<?php

include_once "com.configp.php";

$pid = $_POST['piattoid'];

$query = "DELETE FROM ordini WHERE id = '$pid' ";

$r = mysql_query($query);

if ($r) {
	echo "ok";
}else
echo "no $query";

?>