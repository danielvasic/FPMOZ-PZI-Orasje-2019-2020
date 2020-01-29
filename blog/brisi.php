<?php
include ("../login/funkcije.inc.php");
include ("funkcije.inc.php");

$korisnik = provjeri_korisnika($konekcija);

if (!$korisnik) {
    header("Location: ../login/login.php");
}

$id = intval($_GET["id"]);

pobrisi_objavu($id, $konekcija);
header("Location: dodaj.php");