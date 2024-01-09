<?php

session_start();

function add_admin()
{


    /** **/
    $link = connectdb();

    $sql = "SELECT * FROM benutzer";
    $result = mysqli_query($link, $sql);
    $rowcount=mysqli_num_rows($result);

    if($rowcount == 0){
        $Salt = "dbwt";
        $password = "123456";
        $passwithashandSalt = sha1($Salt.$password);

        $sql="INSERT INTO benutzer(email,passwort,admin,anzahlanmeldungen) VALUES ('admin@emensa.example', '$passwithashandSalt','1','1')";
        mysqli_query($link, $sql);
        mysqli_close($link);
    }
    else
        return;
}

function updateanzahl_login()
{

    if(isset($_SESSION['counter'])) {

        //$anzahlupdate = " anzahlanmeldungen = anzahlanmeldungen + 1";
        $email = $_SESSION['User'];
        /* Tell mysqli to throw an exception if an error occurs */
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $link = connectdb();
        /* Start transaction */
        mysqli_begin_transaction($link);
        try {

            $sql = "SELECT id FROM benutzer WHERE email= '".$email."'";
            $result= mysqli_query($link, $sql);
            mysqli_commit($link);
        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($link);

            throw $exception;
        }
        $ergebnis=mysqli_fetch_row($result);
        try {
            $sql1="CALL anzahlanmeldungen('$ergebnis[0]')";
            mysqli_query($link, $sql1);
            mysqli_commit($link);

        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($link);

            throw $exception;
        }

    }

    mysqli_close($link);


}

function setanmeldungDATETIME(){

    $email = $_SESSION['User'];
    /* Tell mysqli to throw an exception if an error occurs */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = connectdb();
    /* Start transaction */
    mysqli_begin_transaction($link);
    try {
        $sql = "UPDATE benutzer SET letzteanmeldung = NOW() WHERE email = '".$email."'";
        mysqli_query($link, $sql);

        /* If code reaches this point without errors then commit the data in the database */
        mysqli_commit($link);
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($link);

        throw $exception;
    }
    mysqli_close($link);
}


function setanmeldungfehlerDateTime()
{

    $email = $_SESSION['User'];

    /* Tell mysqli to throw an exception if an error occurs */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $link = connectdb();
    /* Start transaction */
    mysqli_begin_transaction($link);
    try {
        $sql = "SELECT email FROM benutzer WHERE email = '".$email."'";
        $result = mysqli_query($link, $sql);
        if (mysqli_fetch_assoc($result)) {

            $sql2 = "UPDATE benutzer SET letzterfehler = NOW() WHERE email = '".$email."'";
            mysqli_query($link, $sql2);

        }
        /* If code reaches this point without errors then commit the data in the database */
        mysqli_commit($link);

    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($link);

        throw $exception;
    }
    mysqli_close($link);

}