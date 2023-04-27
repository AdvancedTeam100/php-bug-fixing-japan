<?php
include('util/get-env.php');
$dsn = $env['driver'].':dbname='.$env['db'].';host='.$env['host'].";port=".$env['port'].';charset=utf8;';
$user = $env['user'];
$pass = $env['pass'];

?>