<?php

require_once('../models/gericht.php');
require_once('../models/db-query.php');
require_once('../models/add_admin.php');
//require_once('../models/gerichtDB.php');

class indexhomeController{

    public function firstwerbseite(RequestData $rd) {

        logger()->INFO('Information Zugriff auf die Hauptseite. ');


        $dbAllergen = db_Allergen_code_name();
        $dbgerichte = db_gericht_name_intern_extern_prise();
        /* $dbgerichte=GerichtDB::query()
            ->orderBy('name')->limit(5)->get();*/
        $arr = db_Allergen();
        $besucher = $this->get_besucher();
        $gerichte = get_gerichte_zahl();
        $vars = $this->do_form();
        $anmeldungen = $this->get_anmeldungszahl();


        $gaeste_meinungen=get_hervorgehobene_bewertungen();
        return view('WebSeite', ['gaeste_meinungen'=> $gaeste_meinungen,'dbgerichte' => $dbgerichte, 'dbAllergen' => $dbAllergen, 'Allergen' => $arr, 'besucher' => $besucher,
            'anmeldungen' => $anmeldungen, 'gerichte' => $gerichte, 'vars' => $vars

        ]);
    }


    public function get_besucher()
    {

        $fp = fopen("../models/counter.txt", "r");
        $count = 0;
        $count = fread($fp, 1024);
        fclose($fp);
        $count = $count + 1;
        $fp = fopen("../models/counter.txt", "w");
        fwrite($fp, $count);

        fclose($fp);
        return $count;
    }

    public function get_anmeldungszahl()
    {


        $Newsletter_str = file_get_contents("../models/Newsletter_anmeldung.txt");
        $Newsletter_arr = explode("\n", $Newsletter_str);
        $anmeldungen = count($Newsletter_arr);
        return $anmeldungen;

    }


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function do_form()
    {

        $nameErr = $emailErr = $datenschutzErr = "";
        $name = $email = $datenschutz = "";
        $post_vorname = $_POST['Vorname'];
        $post_sprache = $_POST['Sprache'];
        $post_email = $_POST['E-Mail'];
        $post_datenschutz = $_POST['Datenschutz'];
        $post_schicken = $_POST['schicken'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["Vorname"])) {
                $nameErr = "*Der Name muss gesetzt sein";
            } elseif (ctype_space($_POST["Vorname"])) {

                $nameErr = "*Der Name kann nicht leerzeichnen sein";
            } else {
                $name = $this->test_input($_POST["Vorname"]);
            }

            if (empty($post_email)) {
                $emailErr = "*Die E-mail muss gesetzt sein";
            } elseif ((!filter_var($_POST["E-Mail"], FILTER_VALIDATE_EMAIL)) || (!filter_var($_POST["E-Mail"], FILTER_VALIDATE_DOMAIN))) {
                $emailErr = "*Die E-mail ist ungültig";
            }
            if ((strpos($post_email, "trashmail") !== false) || (strpos($post_email, "spam") !== false) || (strpos($post_email, "rcpt") !== false)) {
                $emailErr = "*Es darf nicht Spam oder Trash E-mails zu benutzen";
            } else {

                $email = $this->test_input($post_email);
            }

            if (empty($_POST["Datenschutz"])) {
                $datenschutzErr = "*Datenschutzbestimmung ist erforderlich";
            } else {
                $datenschutz = $this->test_input($_POST["Datenschutz"]);
            }

        }

        $newsletter = $_POST['Sprache'];
        if (isset($_POST['schicken']) && $nameErr == "" && $emailErr == "" && $datenschutzErr == "") {
            $line = $name . ";" . $email . ";" . $newsletter . ";" . $datenschutz . ";" . "\n";
            $file = fopen("../models/Newsletter_anmeldung.txt", 'a');
            fwrite($file, $line);
            fclose($file);
            $correct = "*Daten ist erfolgreich gespeichert";
        }

        $vars = [
            'post_datenschutz' => $post_datenschutz,
            'post_email' => $post_email,
            'post_schicken' => $post_schicken,
            'post_vorname' => $post_vorname,
            'post_sprache' => $post_sprache,
            'correct' => $correct,
            'nameErr' => $nameErr,
            'datenschutzErr' => $datenschutzErr,
            'emailErr' => $emailErr

        ];


        return $vars;
    }

}