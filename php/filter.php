<?php

if (isset($_POST['submit'])) {    
    
    $property_type = htmlspecialchars($_POST['property_type']);
    $municipalities = htmlspecialchars($_POST['municipalities']);
    $price_range = htmlspecialchars($_POST['price_range']);
    $quadrature_range = htmlspecialchars($_POST['quadrature_range']);
    $structure = $_POST['structure'];
    $parking = $_POST['parking'];
    $accommodation = $_POST['accommodation'];
    
    $sql = 'SELECT * FROM nekretnina';    
    $conditions = array();    
    
    if ($property_type !== "") {
        $conditions[] = "id_tip_nekretnine = '$property_type'";
    }
    
    if ($municipalities !== "") {
        $conditions[] = "id_opstina = '$municipalities'";
    }
    
    if ($price_range !== "") {
        $price_array = explode(",", $price_range);
        
        $conditions[] = "(cena BETWEEN '$price_array[0]' AND '$price_array[1]')";
    } 
    
    if ($quadrature_range !== "") {
        $quadrature_array = explode(",", $quadrature_range);
        
        $conditions[] = "(povrsina BETWEEN '$quadrature_array[0]' AND '$quadrature_array[1]')";
    }
    
    $structure_sql = "(";
    if (count($structure) > 0) {
        if (count($structure) === 1) {
            $conditions[] = "struktura = '$structure[0]'";
        } else {
            foreach ($structure as $s) {
                $structure_sql .= "struktura = '$s' OR ";
            }
            $structure_sql = substr($structure_sql, 0, -4);
            $structure_sql .= ")";
            $conditions[] = $structure_sql;
        }
    }
    
    $parking_sql = "(";
    if (count($parking) > 0) {
        if (count($parking) === 1) {
            $conditions[] = "parking = '$parking[0]'";
        } else {
            foreach ($parking as $p) {
                $parking_sql .= "parking = '$p' OR ";
            }
            $parking_sql = substr($parking_sql, 0, -4);
            $parking_sql .= ")";
            $conditions[] = $parking_sql;
        }
    }
    
    $accommodation_sql = "(";
    if (count($accommodation) > 0) {
        if (count($accommodation) === 1) {
            $conditions[] = "namestenost = '$accommodation[0]'";
        } else {
            foreach ($accommodation as $a) {
                $accommodation_sql .= "namestenost = '$a' OR ";
            }
            $accommodation_sql = substr($accommodation_sql, 0, -4);
            $accommodation_sql .= ")";
            $conditions[] = $accommodation_sql;
        }
        
    }
    

    $query = $sql;
    if (count($conditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }
    $query .= ";";
    
    require 'database_connection.php';
    $prep = $db->prepare($query);
    $prep->execute();
    
    if ($prep->rowCount() > 0) {
        $res = $prep->fetchAll(PDO::FETCH_OBJ);
        print_r($res);
    } else {
        echo "Nema rezultata koji podudaraju vase filtere.";
    }

}

?>
