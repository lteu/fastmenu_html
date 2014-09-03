<?php


//date_default_timezone_set('Europe/Rome');

session_start(); 

$user = 'liu';
$pwd = '123';
$table='fastmenu';



$dbconn = mysql_connect('localhost', $user, $pwd);
if (!$dbconn) {
    die('Non riesco a connettermi: ' . mysql_error());
}
if (!mysql_select_db($table))
    die("Can't select database");
MySQL_query("set names UTF8");




?>