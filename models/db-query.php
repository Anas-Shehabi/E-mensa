<?php
session_start();
function db_gericht_name_intern_extern_prise() {
    $link = connectdb();

    $sql="SELECT id ,name , preis_intern , preis_extern,bildname FROM gericht ORDER BY name ASC LIMIT 5";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $ergebnis;
}
function db_Allergen() {
    $link = connectdb();

    $sql="SELECT DISTINCT a.code ,a.name AS Allergen_name  FROM (gericht AS g, allergen AS a) 
                JOIN gericht_hat_allergen AS gha ON a.code=gha.code AND g.id=gha.gericht_id ORDER BY g.name ASC LIMIT 10";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $ergebnis;
}

function db_Allergen_code_name() {
    $link = connectdb();

    $sql="SELECT a.code,a.name AS Allergen_name, g.name ,g.preis_intern,g.preis_extern FROM (gericht AS g, allergen AS a) 
                JOIN gericht_hat_allergen AS gha ON a.code=gha.code AND g.id=gha.gericht_id ORDER BY g.name ASC ";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_all($result, MYSQLI_BOTH);


    mysqli_close($link);
    return $ergebnis;
}

function get_gerichte_zahl(){


    $link = connectdb();

    $sql="SELECT COUNT(id) AS anzahl FROM gericht";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_all($result, MYSQLI_BOTH);


    mysqli_close($link);
    return $ergebnis;



}




function get_bild_name($gericht_id) {
    $link = connectdb();

    $sql="SELECT name , id ,bildname FROM gericht WHERE id='".$_GET['gerichtid']."'";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_array($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $ergebnis;
}


function get_benutzer_id(){
    $link = connectdb();

    $sql="SELECT id  FROM benutzer WHERE email='".$_SESSION['User']."'";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_array($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $ergebnis;
}


function bewertung_form($bemerkung,$sterne_bewertung,$gerichtid,$benutzer_id) {

    $link = connectdb();
    $sql="INSERT INTO bewertung(bemerkung,Bewertungszeitpunkt,hervorgehoben,Benutzerid,gerichtid,SterneBewertung) VALUES
('$bemerkung',NOW(),0,'$benutzer_id','$gerichtid','$sterne_bewertung')";
    mysqli_query($link, $sql);
    mysqli_close($link);

}


function get_bewertungen()
{
    $link = connectdb();

    $sql="SELECT DISTINCT  gericht.name, bewertung.hervorgehoben , bewertung.bemerkung, bewertung.SterneBewertung,bewertung.Bewertungszeitpunkt,bewertung.Bewertungid,bewertung.Benutzerid
FROM gericht, bewertung where gericht.id=bewertung.gerichtid ORDER BY Bewertungszeitpunkt DESC limit 30;";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $ergebnis;
}




function get_meinebewertungen($benutzer_id)
{
    $link = connectdb();

    $sql="SELECT DISTINCT  gericht.name, bewertung.hervorgehoben , bewertung.bemerkung, bewertung.SterneBewertung,bewertung.Bewertungszeitpunkt,bewertung.Bewertungid,bewertung.Benutzerid
FROM gericht, bewertung  WHERE bewertung.Benutzerid= '".$benutzer_id."' AND gericht.id=bewertung.gerichtid ORDER BY Bewertungszeitpunkt DESC;";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $ergebnis;
}


function loschen_eine_bewertung ($bewertungid){

    $link = connectdb();
    $sql="DELETE FROM bewertung WHERE Bewertungid='".$bewertungid."'";
    mysqli_query($link, $sql);
    mysqli_close($link);
}

function hervorheben_set($bewertung_id){

    $link = connectdb();
    $sql = "UPDATE bewertung SET hervorgehoben = '1' WHERE Bewertungid = '".$bewertung_id."'";
    mysqli_query($link, $sql);
    mysqli_close($link);

}


function hervorheben_delete($bewertung_id){

    $link = connectdb();
    $sql = "UPDATE bewertung SET hervorgehoben = '0' WHERE Bewertungid = '".$bewertung_id."'";
    mysqli_query($link, $sql);
    mysqli_close($link);
}


function get_hervorgehobene_bewertungen()
{
    $link = connectdb();

    $sql="SELECT DISTINCT  gericht.name, bewertung.hervorgehoben , bewertung.bemerkung, bewertung.SterneBewertung 
            FROM gericht, bewertung WHERE bewertung.hervorgehoben =1 AND gericht.id=bewertung.gerichtid";
    $result = mysqli_query($link, $sql);
    $ergebnis = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $ergebnis;
}




