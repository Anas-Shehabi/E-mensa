<?php
/**
 * Mapping of paths to controlls.
 * Note, that the path only support 1 level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as aspected
 */
return array(
    "/"=>"indexhomeController@firstwerbseite",
    "/werbeseite"  => "HomeController@index",
    "/anmeldungController"  => "anmeldungController@index",
    "/demo"        => "DemoController@demo",
    '/dbconnect'   => 'DemoController@dbconnect',
    '/anmeldung_verfizierenController' => 'anmeldung_verfizierenController@check',
    '/Fehler' =>"HomeController@fehler",
    '/abmeldungController' => 'abmeldungController@dologout',
    '/bewertung' => "bewertungController@bewertung",
    '/bewertungController'=>"bewertungController@check",
    '/bewertungen' =>"bewertungController@show",
    '/meinebewertungen'=>"bewertungController@meinebewertungen",
    '/loeschen'=>"bewertungController@loeschen",
    '/hervorheben' =>"bewertungController@hervorheben",
    '/hervorhebungabwaehlen'=>"bewertungController@delete_hervorheben"
);