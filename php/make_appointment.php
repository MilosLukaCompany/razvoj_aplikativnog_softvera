<?php
require 'database_connection.php';
$user_id = $_POST['user_id'];
$property_id = $_POST['property_id'];
$date = $_POST['date'];

$prep = $db->prepare("INSERT INTO gledanje_nekretnine (vreme, id_kupac, id_nekretnina) VALUES (?, ?, ?);");
$prep->execute([$date, $user_id, $property_id]);

if ($prep) {
    echo "Uspesno ste zakazali termin za datum: " . $date . ".<br />\n";
    echo "Bicete naknadno kontaktirani putem telefona.<br />\n";
    echo "Hvala na poverenju!\n";
}
