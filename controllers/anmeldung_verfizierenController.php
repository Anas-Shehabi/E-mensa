
<?php



require_once('../config/db.php');
require_once('../models/add_admin.php');


class anmeldung_verfizierenController {


    /** Route /login_check */
    public function check(RequestData $rd)
    {
        session_start();

        $GLOBALS['SALT'] = "dbwt";

        $_SESSION['login_result_message'] = null;
        $_SESSION['benutzerTyp'] = null;
        $_SESSION['User'] = $_POST['Email'];

        if (isset($_POST['Login']))
        {
            if (empty($_POST['Email']) || empty($_POST['Password']))
            {
                header('location: /anmeldungController?Empty
                = Please Fill in the Blanks');
            }else
            {

                $passtotest = sha1($GLOBALS["SALT"] . $_POST['Password']);
                $link = connectdb();
                $query = "select * from benutzer where email='" . $_POST['Email'] . "' and passwort='" . $passtotest . "'";
                $result = mysqli_query($link, $query);
                $ergbnis = mysqli_fetch_array($result);

                if ($ergbnis)
                {
                    if($ergbnis['admin'] == 1)
                    {
                        $_SESSION['benutzerTyp'] = 'admin';
                        $_SESSION['counter'] = 1;
                        setanmeldungDATETIME();
                        $_SESSION['login_ok'] = true;
                        $User=$_SESSION['User'];
                    }elseif ($ergbnis['admin'] == 0)
                    {
                        $_SESSION['benutzerTyp'] = 'User';
                        $_SESSION['counter'] = 1;
                        setanmeldungDATETIME();
                        $_SESSION['login_ok'] = true;
                        $User=$_SESSION['User'];
                    }
                    header('Location: /werbeseite');
                    logger()->INFO('Information Anmeldung',[$User]);


                }else {
                    setanmeldungfehlerDateTime();
                    $_SESSION['login_result_message'] = 'Benutzer- oder Passwort falsch';
                    header('location: /anmeldungController?Invalid= Benutzer- oder Passwort falsch ');

                    $query1 = "select * from benutzer where email='" . $_POST['Email'] . "'";
                    $result1 = mysqli_query($link, $query1);



                    if( mysqli_fetch_assoc($result1))
                        logger()->WARNING('Warning',[$_POST['Email']]);


                }

            }

        }


    }
}

