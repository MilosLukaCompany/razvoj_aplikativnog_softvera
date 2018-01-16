<?php

$property_type = htmlspecialchars($_POST['property_type2']);
$municipalities = htmlspecialchars($_POST['municipalities']);
$address = htmlspecialchars($_POST['address']);
$quadrature = htmlspecialchars($_POST['quadrature']);
$structure = htmlspecialchars($_POST['structure']);
$accommodation = htmlspecialchars($_POST['accommodation']);
$heat= htmlspecialchars($_POST['heat']);
$floor= htmlspecialchars($_POST['floor']);
$building_floors = htmlspecialchars($_POST['building_floors']);
$price = htmlspecialchars($_POST['price']);

require 'database_connection.php';

?>

