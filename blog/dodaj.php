<?php
include ("../login/funkcije.inc.php");
include ("funkcije.inc.php");

$direktorij = "../ucitavanja/";
$korisnik = provjeri_korisnika($konekcija);

if (!$korisnik) {
    header("Location: ../login/login.php");
}

if (isset($_POST["naslov"])){

    $naslov = $_POST["naslov"];
    $tekst = $_POST["tekst"];
    $datum = $_POST["datum"];

    $naziv_slike = $_FILES["slika"]["name"];
    $putanja_slike = $direktorij . $naziv_slike;
    move_uploaded_file($_FILES["slika"]["tmp_name"], $putanja_slike);
    dodaj_objavu($naslov, $tekst, $naziv_slike, $datum, $konekcija);
}

$objave = dohvati_objave($konekcija);
$naslov = "Dodajte objavu";

include ("../zaglavlje.php");
?>
    <div class="row">
        <div class="col">
            <p class="alert alert-info">
                Prijavljeni ste kao 
                <?php 
                echo ($korisnik["ime"] . " " . $korisnik["prezime"]) 
                ?> 
                odjavite se 
                <a href="../login/logout.php">ovdje</a>.
            </p>
            <form method="POST" enctype="multipart/form-data" action="dodaj.php">
                <div class="form-group">
                    <label>Unesite naslov objave:</label>
                    <input type="text" name="naslov" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Datum objave:</label>
                    <input type="date" class="form-control" name="datum" />
                </div>
                <div class="form-group">
                    <label>Slika objave:</label>
                    <input type="file" class="form-control" name="slika" />
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
            <?php if ($objava["slika"] != "") { ?>
            <img class="img img-fluid" src="../ucitavanja/<?php echo ($objava["slika"]); ?>" />
            <?php } ?>
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