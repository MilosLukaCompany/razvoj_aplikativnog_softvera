<?php

if (isset($_GET['id'])) {
    require 'database_connection.php';
    
    $prep_delete_property = $db->prepare("DELETE FROM nekretnina WHERE nekretnina.id = ?;");
    $prep_delete_property->execute([$_GET['id']]);
    
    $prep_favouries = $db->prepare("SELECT * FROM lista_zelja WHERE id_nekretnina = ?;");
    $prep_favouries->execute([$_GET['id']]);
    
    if ($prep_favouries->rowCount() > 0) {
        $prep_delete_favourite = $db->prepare("DELETE FROM lista_zelja WHERE id_nekretnina = ?;");
        $prep_delete_favourite->execute([$_GET['id']]);
    }
    
    die (header('Location: ../property_list.php?msg=succesfully_deleted_property'));
}

?>

