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
    if (isset($_POST["id"]))
        uredi_objavu(intval($_POST["id"]), $naslov, $tekst, $naziv_slike, $datum, $konekcija);
    else
        dodaj_objavu($naslov, $tekst, $naziv_slike, $datum, $konekcija);
}

if (isset($_GET["id"])){
    $objava = dohvati_objavu(intval($_GET["id"]), $konekcija);
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
                <?php if (isset($objava["id"])) { ?>
                    <input type="hidden" name="id" value="<?php echo ($objava["id"]); ?>" />
                <?php } ?>
                <div class="form-group">
                    <label>Unesite naslov objave:</label>
                    <input type="text" <?php if (isset($objava["naziv"])){ ?>value="<?php echo($objava["naziv"]); }?>" name="naslov" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Datum objave:</label>
                    <input type="date" class="form-control" <?php if (isset($objava["datum"])){ ?>value="<?php echo($objava["datum"]); }?>" name="datum" />
                </div>
                <div class="form-group">
                    <label>Slika objave:</label>
                    <input type="file" class="form-control" name="slika" />
                    <?php if (isset($objava["slika"]) && $objava["slika"] != "") { ?>
                    <img class="img img-fluid" src="../ucitavanja/<?php echo ($objava["slika"]); ?>" />
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label>Unesite tekst objave</label>
                    <textarea name="tekst"  class="form-control"><?php if (isset($objava["tekst"])){ echo($objava["tekst"]); }?></textarea>
                </div>
                <input type="submit" value="<?php if (isset($objava["datum"])){ echo("Uredi objavu"); } else { echo("Dodaj objavu"); }?>"" class="btn btn-primary" />
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
            <a href="dodaj.php?id=<?php echo ($objava["id"]) ?>" class="btn btn-info">Uredi</a>
            <?php
            }
            ?>
        </div>
    </div>
<?php
include ("../podnozje.php");
?>