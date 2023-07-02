<?php
$host='localhost';
$user='root';
$pass='';
$db='accounts';
$mysqli= new myslqi($host, $user, $pass, $db) or die($mysqli->error);