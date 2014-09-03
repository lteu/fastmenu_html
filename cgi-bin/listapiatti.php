<?php

include_once "com.configp.php";



$array = array();
$query = " SELECT id, nome, prezzo FROM piatti";
$result = mysql_query($query);
if (!$result) {
	die("errore SQL $query");
} else {
	while($row = mysql_fetch_row($result)){
		$array[] = array("id" => $row[0], "nome" => $row[1], "prezzo" => $row[2]);
	}
	
}

echo json_encode($array);
?>