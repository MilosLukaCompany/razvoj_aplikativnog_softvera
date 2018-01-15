<?php
if (!isset($_SESSION['username'])) {
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $subject = htmlspecialchars($_POST['subject']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
} else {
    require 'database_connection.php';
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);    
}

?>