<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kelurahanpahandut';

$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
?>