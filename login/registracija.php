<?php
include ("funkcije.inc.php");

if (isset($_POST["ime"])) {
    dodaj_korisnika(
        $_POST["ime"],
        $_POST["prezime"],
        $_POST["email"],
        $_POST["lozinka"],
        $konekcija
    );
}

include ("../zaglavlje.php");
?>

    <div class="row">
        <div class="col">
            <form method="POST" action="/pzi-blog/login/registracija.php">
                <div class="form-group">
                    <label>Ime:</label>
                    <input type="text" name="ime" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Prezime:</label>
                    <input type="text" name="prezime" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Lozinka:</label>
                    <input type="password" name="lozinka" class="form-control" />
                </div>
                
                <input type="submit" value="Registriraj se" class="btn btn-primary" />
            </form>
        </div>
    </div>

<?php
include ("../podnozje.php");
?>