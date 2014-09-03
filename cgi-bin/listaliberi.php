<?php

include_once "com.configp.php";



$array = array();
$query = " SELECT id FROM tavoli WHERE stato='libero' ";
$result = mysql_query($query);
if (!$result) {
	die("errore SQL $query");
} else {
	while($row = mysql_fetch_row($result)){
		$array[] = array($row[0]);
	}
	
}

echo json_encode($array);
?>