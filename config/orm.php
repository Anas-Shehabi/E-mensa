<?php // config/orm.php

use
    Illuminate\Database\Capsule\Manager
    as Manager;


$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "emensawerbeseite",
    "username" => "root",
    "password" => "1234"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
