<?php

require 'vendor/autoload.php';

use Kantas_net\Database\{QueryBuilder,Connection} ;

$database = new QueryBuilder(Connection::make(require 'Data/configDB.php'));

$users = $database->selectAll('user');

//var_dump($users);

echo "Username of user with id {$users[0]->id} is {$users[0]->username}" ;