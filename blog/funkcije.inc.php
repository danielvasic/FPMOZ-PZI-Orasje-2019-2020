<?php

include("baza.php");

function dodaj_objavu($naziv, $tekst, $datum, $konekcija){
    $sql = "INSERT INTO post VALUES (null, ?, ?, ?)";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$naziv, $tekst, $datum]);
}

function pobrisi_objavu($id, $konekcija){
    $sql = "DELETE FROM post WHERE id=?";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$id]);
}

function dohvati_objave($konekcija){
    $sql = "SELECT * FROM post";
    return $konekcija->query($sql)->fetchAll();
}

?>