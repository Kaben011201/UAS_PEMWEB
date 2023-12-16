<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'uas_pemweb_bendry';

$connect = new mysqli($host, $user, $password, $db);

if(!$connect){
    die("Connection field: ".mysqli_connect_error());
}