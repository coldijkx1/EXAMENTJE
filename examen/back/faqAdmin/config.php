<?php
 
$host = 'localhost';
$user = '84222';
$password = 'Hamster2003';
$db = 'Examen';
 
$con = mysqli_connect($host,$user,$password,$db);
 
if(!$con)
{
	die(mysqli_error());
}
?>