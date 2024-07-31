<?php
require_once('db_pdo.php');
$DB = new db_pdo();
$DB->connect();
$result = $DB->query('SELECT * from users');
var_dump($result);
echo $result->rowCount();
$users = $DB->querySelect('SELECT * from users');
var_dump($users);

$customers = $DB->table('customers');
var_dump($customers);
