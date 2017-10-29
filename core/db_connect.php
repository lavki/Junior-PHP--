<?php

$user  = 'root';
$pass  = 'password';
$mysql = 'mysql: host=localhost; dbname=test; charset=utf8';

try {
	$dbh = new \PDO($mysql, $user, $pass, [\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION]);
} catch (\PDOException $e) {
	exit("З'єднання обірвано!");
}