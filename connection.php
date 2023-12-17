<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'uas_pemweb_bendry';

$connect = mysqli_connect($host, $user, "", $db);

if(!$connect){
    die("Connection field: ".mysqli_connect_error());
}