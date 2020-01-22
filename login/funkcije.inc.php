<?php

include("../baza.php");

function dodaj_korisnika ($ime, $prezime, $email, $lozinka, $konekcija){
    $sql = "INSERT INTO user VALUES (null, ?, ?, ?, ?)";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$ime, $prezime, $email, md5($lozinka)]);
}
?>