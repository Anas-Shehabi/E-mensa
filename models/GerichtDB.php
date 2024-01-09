<?php


require_once "../vendor/autoload.php";
require_once "../config/orm.php";

class GerichtDB extends Illuminate\Database\Eloquent\Model
{
    public $table = 'gericht';
    public $primaryKey = 'id';
    public $timestape = false;
    public $incrementing = true;


    function getPreisExternAttribute($preis_extern) {

        return number_format($preis_extern, 2, ',', ' ');

    }
    function getPreisInternAttribute($preis_extern) {

        return number_format($preis_extern, 2, ',', ' ');

    }

    function setVegetarischAttribute($vegetarisch)
    {
        $data=trim($vegetarisch);
        $vegetarisch1=ucfirst($data);
        if($vegetarisch1 =='Yes' || $vegetarisch1 =='Ja')
            $this->attributes['vegetarisch']='1';
        elseif ($vegetarisch1 == 'No' || $vegetarisch1 == 'Nein')
            $this->attributes['vegetarisch']='0';
        else
            return;

    }

    function setVeganAttribute($vegan)
    {
        /*$data=trim($vegan);
        $vegan1=ucfirst($data);
        if($vegan1=='Yes' || $vegan1 =='Ja')
            $this->attributes['vegan']='1';
        elseif ($vegan1 == 'No' || $vegan1 == 'Nein')
            $this->attributes['vegan']='0';
        else
            return;*/

        if(stripos($vegan,"ja")|| stripos($vegan,"yes"))
            $this->attributes['vegan']='1';
        elseif (stripos($vegan,"no")|| stripos($vegan,"nein"))
            $this->attributes['vegan']='0';

    }

}
