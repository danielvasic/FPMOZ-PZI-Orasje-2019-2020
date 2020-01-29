<?php

include("../baza.php");

function dodaj_objavu($naziv, $tekst, $naziv_slike, $datum, $konekcija){
    $sql = "INSERT INTO post VALUES (null, ?, ?, ?, ?)";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$naziv, $tekst, $naziv_slike, $datum]);
}

function uredi_objavu($id, $naziv, $tekst, $naziv_slike, $datum, $konekcija){
    $sql = "UPDATE post SET naziv=?, tekst=?, slika=?, datum=? WHERE id=?";
    $upit = $konekcija->prepare($sql);
    return $upit->execute([$naziv, $tekst, $naziv_slike, $datum, $id]);
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

function dohvati_objavu($id, $konekcija){
    $sql = "SELECT * FROM post WHERE id=?";
    $upit = $konekcija->prepare($sql);
    $upit->execute([$id]);
    return $upit->fetch();
}

?>