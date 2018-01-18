<?php

if (isset($_POST['submit'])) {
    $property_type = htmlspecialchars($_POST['property_type']);
    $municipalities = htmlspecialchars($_POST['municipalities']);
    $address = htmlspecialchars($_POST['address']);
    $quadrature = htmlspecialchars($_POST['quadrature']);
    $price = htmlspecialchars($_POST['price']);
    
    $floor;
    $heat;
    $building_floors;
    $accommodation;
    $parking;
    $structure;
    
    
    switch ($property_type) {
        case 1: //kuca
            $floor = NULL;
            $heat = htmlspecialchars($_POST['heat']);        
            $building_floors = htmlspecialchars($_POST['building_floors']);        
            $structure = htmlspecialchars($_POST['structure']);        
            $parking = htmlspecialchars($_POST['parking']);
            $accommodation = htmlspecialchars($_POST['accommodation']);
            break;
        case 3: //lokal
            $floor = NULL;
            $heat = NULL;
            $building_floors = NULL;
            $structure = NULL;
            $parking = htmlspecialchars($_POST['parking']);
            $accommodation = htmlspecialchars($_POST['accommodation']);
            break;
        case 4: //garaza
            $floor = NULL;
            $heat = NULL;
            $building_floors = NULL;
            $structure = NULL;
            $parking = NULL;
            $accommodation = NULL;
            break;
        default: //stan
            $floor = htmlspecialchars($_POST['floor']);     
            $heat = htmlspecialchars($_POST['heat']);        
            $building_floors = htmlspecialchars($_POST['building_floors']);        
            $structure = htmlspecialchars($_POST['structure']);        
            $parking = htmlspecialchars($_POST['parking']);
            $accommodation = htmlspecialchars($_POST['accommodation']);
    }                                   
    
    require 'database_connection.php';
    $prep = $db->prepare('SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?;');
    $prep->execute(['singi_stan', 'nekretnina']);
    $res = $prep->fetchAll(PDO::FETCH_OBJ);
    
    $curdir = getcwd();
    mkdir($curdir . "/../assets/img/property_images/" . $res[0]->AUTO_INCREMENT, 0777);

    $prep2 = $db->prepare('INSERT INTO nekretnina (adresa, povrsina, struktura, parking, grejanje, namestenost, sprat, spratnost, cena, id_opstina, id_tip_nekretnine) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    $prep2->execute([$address, $quadrature, $structure, $parking, $heat, $accommodation, $floor, $building_floors, $price, $municipalities, $property_type]);
    
    for ($i = 0; $i < count($_FILES["file"]["name"]); $i++) {
        $file_tmp = $_FILES["file"]["tmp_name"][$i];
        $file_name = $_FILES["file"]["name"][$i];
        $file_type = $_FILES["file"]["type"][$i];
        $file_path = "assets/img/property_images/" . $res[0]->AUTO_INCREMENT . "/" . $file_name;
        
        move_uploaded_file($file_tmp, "C:/xampp/htdocs/razvoj_aplikativnog_softvera/assets/img/property_images/" . $res[0]->AUTO_INCREMENT . "/" . $file_name);            
                                
        $prep3 = $db->prepare('INSERT INTO slika (id_nekretnina, ime_slike, putanja_slike, tip_slike) VALUES (?, ?, ?, ?);');
        $prep3->execute([$res[0]->AUTO_INCREMENT, $file_name, $file_path, $file_type]);        
    }

    die (header('Location: ../agent_new_property.php?msg=property_has_been_successfully_added'));
}
?>

