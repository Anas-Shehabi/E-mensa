<?php
require_once"../vendor/autoload.php";
require_once "../config/orm.php";

class Bewertung extends Illuminate\Database\Eloquent\Model

{
    public $table='bewertung';
    public $primaryKey='Bewertungid';
    public  $timestape =false;
    public $incrementing =true;
}