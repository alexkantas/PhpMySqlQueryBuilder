<?php

require 'vendor/autoload.php';

use Kantas_net\Database\{QueryBuilder,Connection} ;

$database = new QueryBuilder(Connection::make(require 'Data/configDB.php'));

//$users = $database->selectWhere('user','id','3');

$setData = ['username' => 'Alex', 'password' => 'Alex'];

$database->updateWhere('user','id',3,$setData);

echo 'done';