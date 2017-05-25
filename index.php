<?php

require 'vendor/autoload.php';

use Kantas_net\Database\{QueryBuilder,Connection} ;

$database = new QueryBuilder(Connection::make(require 'Data/configDB.php'));

$users = $database->selectWhere('user','id','2');

var_dump($users);

die();
echo 'done';