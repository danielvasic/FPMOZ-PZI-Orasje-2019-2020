<?php
include ("funkcije.inc.php");

if (isset($_POST["email"])) {
    $status = prijavi_korisnika(
        $_POST["email"],
        $_POST["lozinka"],
        $konekcija
    );

    if ($status == false) {
        $greska = "Neispravni korisnički podaci.";
    } else {
        header("Location: ../blog/dodaj.php");
    }
}

$naslov = "Registrirajte se na sustav";
include ("../zaglavlje.php");
?>

    <div class="row">
        <div class="col">
        <?php if (isset($greska)) { ?>
            <div class="alert alert-danger">
            <?php echo ($greska); ?>
            </div>
        <?php } ?>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Lozinka:</label>
                    <input type="password" name="lozinka" class="form-control" />
                </div>
                
                <input type="submit" value="Prijavi se" class="btn btn-primary" />
            </form>
        </div>
    </div>

<?php
include ("../podnozje.php");
?>