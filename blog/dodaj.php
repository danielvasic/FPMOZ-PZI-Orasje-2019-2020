<?php

include ("funkcije.inc.php");

if (isset($_POST["naslov"])){

    $naslov = $_POST["naslov"];
    $tekst = $_POST["tekst"];
    $datum = $_POST["datum"];

    dodaj_objavu($naslov, $tekst, $datum, $konekcija);
}

$objave = dohvati_objave($konekcija);

?>

<html>
<head>
    <title>Dodajte novu objavu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
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
</div>
</body>

</html>