<?php

if (isset($_POST['submit'])) {
    require 'database_connection.php';
    
    $tel_prefix = '+381';
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $jmbg = htmlspecialchars($_POST['jmbg']);
    $address = htmlspecialchars($_POST['address']);
    $tel = htmlspecialchars($_POST['tel']);
    $tel_prefix .= $tel;
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    
    $prep = $db->prepare('SELECT korisnicko_ime FROM kupac WHERE korisnicko_ime=?;');
    $prep->execute([$username]);
    
    if ($prep->rowCount() > 0) {
        die (header('Location: ../register.php?msg=username_taken'));
    } else {    
        $prep = $db->prepare('INSERT INTO kupac (ime, prezime, jmbg, adresa, telefon, korisnicko_ime, sifra, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
        $prep->execute([$name, $surname, $jmbg, $address, $tel_prefix, $username, $password, $email]);
        
        die (header('Location: ../login.php'));
    }
}



