<?php
 require 'database_connection.php';
 
 $id = (int) @$_REQUEST['ID'];

 $prep = $db->prepare('SELECT id, id_nekretnina FROM gledanje_nekretnine WHERE id_kupac=?;');
 $prep->execute([$id]);
 $prep->fetch();
 
 $prep1 = $db->prepare('SELECT id, id_nekretnina FROM ugovor WHERE id_kupac=?;');
 $prep1->execute([$id]);
 $prep1->fetch();
($prep->rowCount())+($prep1->rowCount());
 if (($prep->rowCount())+($prep1->rowCount()) > 0) {
 

  die (header('Location: ../customers.php?msg=delete_restrict'));
 }
    else {
        $prep = $db->prepare('DELETE FROM kupac WHERE id=?;');
        $prep->execute([$id]);
        
         die (header('Location: ../customers.php?msg=success'));
}