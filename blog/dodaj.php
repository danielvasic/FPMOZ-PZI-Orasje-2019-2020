<?php

include ("funkcije.inc.php");

if (isset($_POST["naslov"])){

    $naslov = $_POST["naslov"];
    $tekst = $_POST["tekst"];
    $datum = $_POST["datum"];

    dodaj_objavu($naslov, $tekst, $datum, $konekcija);
}

$objave = dohvati_objave($konekcija);
include ("../zaglavlje.php");
?>
    <div class="row">
        <div class="col">
            <form method="POST" action="/pzi-blog/blog/dodaj.php">
                <div class="form-group">
                    <label>Unesite naslov objave:</label>
                    <input type="text" name="naslov" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Datum objave:</label>
                    <input type="date" class="form-control" name="datum" />
                </div>
                <div class="form-group">
                    <label>Unesite tekst objave</label>
                    <textarea name="tekst"  class="form-control"></textarea>
                </div>
                <input type="submit" value="Dodaj objavu" class="btn btn-primary" />
            </form>
        </div>
        <div class="col">
            <?php
            foreach ($objave as $objava) {
            ?>
            <h3><?php echo ($objava["naziv"]) ?></h3>
            <small><?php echo ($objava["datum"]) ?></small>
            <p>
            <?php echo ($objava["tekst"]) ?>
            </p>
            <a href="brisi.php?id=<?php echo ($objava["id"]) ?>" class="btn btn-danger">Pobrisi</a>
            <?php
            }
            ?>
        </div>
    </div>
<?php
include ("../podnozje.php");
?>