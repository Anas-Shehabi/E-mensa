<?php

require_once('../models/db-query.php');

require_once('../models/bewertung.php');
require_once('../models/gerichtDB.php');
require_once "../config/orm.php";


session_start();


$GLOBALS['bewertungid'] = $_GET['bewertungid'];


class bewertungController
{

    public function bewertung()
    {
        if (!isset($_SESSION['login_ok']))
        {
            $_SESSION['target'] = '/werbeseite';
            header('Location: /anmeldungController');
            return;
        }

        $ergebnis=get_bild_name($_GET['gerichtid']);

        $ergebnis1=GerichtDB::find($_GET['gerichtid']);
        $ergebnisname=$ergebnis1->name;
        return view('bewertung', ['ergebnis'=> $ergebnis, 'ergebnisname'=>$ergebnisname ]);
    }

    public  function check()
    {

        $textarea=$_POST['bemerkung'];
        $select_option=$_POST['sterne_bewertung'];
        $gerichtID=$_GET['gerichtid'];
        $benutzer_id = get_benutzer_id()['id'];

        bewertung_form($textarea,$select_option,$gerichtID,$benutzer_id);

        return view('bewertung', ['benutzer'=>$benutzer_id,'select'=>$select_option,'text'=>$textarea]);

    }



    public  function show()
    {

        $benutzer_id = get_benutzer_id()['id'];
        $ergebnis=get_bewertungen();
        $status = $_SESSION['benutzerTyp'];
        $count=count($ergebnis);

        return view('bewertungen', ['ergebnis'=>$ergebnis,'benutzer_id'=>$benutzer_id,'status'=>$status,'count'=>$count]);

    }



    public  function meinebewertungen()
    {
        $benutzer_id = get_benutzer_id()['id'];
        $ergebnis=get_meinebewertungen($benutzer_id);
        $status = $_SESSION['benutzerTyp'];
        $count=count($ergebnis);

        return view('meinebewertungen', ['ergebnis'=>$ergebnis,'benutzer_id'=>$benutzer_id,'status'=>$status,'count'=>$count]);

    }


    public function loeschen(){

        //  loschen_eine_bewertung($_GET['bewertungid']);
        Bewertung::query()->where('Bewertungid','=',$_GET['bewertungid'])->delete();
        $benutzer_id = get_benutzer_id()['id'];
        $ergebnis=get_bewertungen();
        $status = $_SESSION['benutzerTyp'];
        $count=count($ergebnis);

        return view('bewertungen', ['ergebnis'=>$ergebnis,'benutzer_id'=>$benutzer_id,'status'=>$status,'count'=>$count]);


    }

    public function hervorheben(){


        Bewertung::where('Bewertungid', $_GET['bewertungid'])
            ->update(['hervorgehoben' => 1]);



        //  hervorheben_set($_GET['bewertungid']);
        $benutzer_id = get_benutzer_id()['id'];
        $ergebnis=get_bewertungen();
        $status = $_SESSION['benutzerTyp'];
        $count=count($ergebnis);

        return view('bewertungen', ['ergebnis'=>$ergebnis,'benutzer_id'=>$benutzer_id,'status'=>$status,'count'=>$count]);

    }

    public function delete_hervorheben(){

        Bewertung::where('Bewertungid', $_GET['bewertungid'])
            ->update(['hervorgehoben' => 0]);


        // hervorheben_delete($_GET['bewertungid']);
        $benutzer_id = get_benutzer_id()['id'];
        $ergebnis=get_bewertungen();
        $status = $_SESSION['benutzerTyp'];
        $count=count($ergebnis);

        return view('bewertungen', ['ergebnis'=>$ergebnis,'benutzer_id'=>$benutzer_id,'status'=>$status,'count'=>$count]);

    }
}
