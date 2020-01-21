<?php
include ("funkcije.inc.php");

$id = intval($_GET["id"]);

pobrisi_objavu($id, $konekcija);

header("Location: dodaj.php");