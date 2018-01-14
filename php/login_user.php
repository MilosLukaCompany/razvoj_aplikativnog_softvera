<?php
session_start();
    
$db = new PDO('mysql:host=localhost;dbname=singi_stan;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

if ($username === 'gazda' && $password === 'gazda') {
    $_SESSION['username'] = $username;
    die (header('Location: ../index.php?msg=success'));
} else {
    $prep = $db->prepare('SELECT kupac.korisnicko_ime, kupac.sifra FROM kupac WHERE kupac.korisnicko_ime=? AND kupac.sifra=? 
                        UNION
                        SELECT agent.korisnicko_ime, agent.sifra FROM agent WHERE agent.korisnicko_ime=? AND agent.sifra=?');
    $prep->execute([$username, $password, $username, $password]);

    if ($prep->rowCount() > 0) {
        $res = $prep->fetchAll();
        $_SESSION['username'] = $username;

        die (header('Location: ../index.php?msg=success'));
    } else {
        die (header('Location: ../login.php?msg=failed'));
    }
}
?>
