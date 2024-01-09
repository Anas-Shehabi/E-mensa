<?php
require_once('../models/add_admin.php');
session_start();


class abmeldungController{

    function dologout()
    {
        if(isset($_SESSION['login_ok'])) {
            if (isset($_GET['logout'])) {
                updateanzahl_login();
                $User = $_SESSION['User'];
                logger()->INFO('Information abmeldung', [$User]);
                session_destroy();
                header('location: /');
            }

        }

        return view('anmeldung',[]);


    }

}