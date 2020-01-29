<?php
session_start();
include("../baza.php");

function dodaj_korisnika ($ime, $prezime, $email, $lozinka, $konekcija){
    $sql = "INSERT INTO user VALUES (null, ?, ?, ?, ?)";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$ime, $prezime, $email, md5($lozinka)]);
}

function prijavi_korisnika ($email, $lozinka, $konekcija) {
    $sql = "SELECT * FROM user WHERE email=? AND lozinka=?";
    $upit = $konekcija->prepare($sql);
    $upit->execute([$email, md5($lozinka)]);
    $korisnik = $upit->fetch();
    if(!isset($korisnik["ime"])) return false;
    $_SESSION["email"] = $email;
    $_SESSION["lozinka"] = md5($lozinka);
    return true;
}

function provjeri_korisnika($konekcija){
    $sql = "SELECT * FROM user WHERE email=? AND lozinka=?";
    $upit = $konekcija->prepare($sql);
    if (!isset($_SESSION["email"])) return false;
    $upit->execute(
        [$_SESSION["email"], $_SESSION["lozinka"]]
    );
    $korisnik = $upit->fetch();
    if(!isset($korisnik["ime"])) return false;
    return $korisnik;
}
?>