<?php
session_start();
if (isset($_POST['change_profile'])) {
    require 'database_connection.php';
    
    $tel_prefix = '+381';
    $name = htmlspecialchars($_POST['firstname']);
    $surname = htmlspecialchars($_POST['lastname']);
    $jmbg = htmlspecialchars($_POST['jmbg']);
    $address = htmlspecialchars($_POST['address']);
    $tel = htmlspecialchars($_POST['tel']);
    $tel_prefix .= $tel;
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    
    
    
    if ($_SESSION['user_type'] === "kupac") {
        $prep = $db->prepare("UPDATE kupac SET ime=?, prezime=?, jmbg=?, adresa=?, telefon=?, korisnicko_ime=?, sifra=?, email=? WHERE korisnicko_ime=?;");
        $prep->execute([$name,$surname,$jmbg,$address, $tel,$username,$password,$email,$_SESSION['username']]);
        
        if ($_FILES["file"]['name'][0] != '') {
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_name = $_FILES["file"]["name"];
            $file_type = $_FILES["file"]["type"];
            $file_path = "assets/img/profile_images/" . $file_name;

            move_uploaded_file($file_tmp, "C:/xampp/htdocs/razvoj_aplikativnog_softvera/assets/img/profile_images/" . $file_name);
            $prep2 = $db->prepare("UPDATE kupac SET putanja_slike=? WHERE korisnicko_ime=?;");
            $prep2->execute([$file_path, $_SESSION['username']]);
        }
        
        $_SESSION['username'] = $username;
        die (header('Location: ../profile.php?msg=success'));
    }
    elseif ($_SESSION['user_type'] === "agent") {
        $prep = $db->prepare("UPDATE agent SET ime='?', prezime='?', jmbg='?', adresa='?', telefon='?', korisnicko_ime='?', sifra='?', email='?' WHERE korisnicko_ime='?';");
        $prep->execute([$name,$surname,$jmbg,$address, $tel_prefix,$username,$password,$email,$_SESSION['username']]);
        
        if ($_FILES["file"]['name'][0] != '') {
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_name = $_FILES["file"]["name"];
            $file_type = $_FILES["file"]["type"];
            $file_path = "assets/img/profile_images/" . $file_name;

            move_uploaded_file($file_tmp, "C:/xampp/htdocs/razvoj_aplikativnog_softvera/assets/img/profile_images/" . $file_name);
            $prep2 = $db->prepare("UPDATE agent SET putanja_slike=? WHERE korisnicko_ime=?;");
            $prep2->execute([$file_path, $_SESSION['username']]);
        }
        
        $_SESSION['username'] = $username;
        die (header('Location: ../profile.php?msg=success'));
    }
    
    
}

