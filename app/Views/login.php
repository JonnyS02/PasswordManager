<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php"?>

<body>
<?php
include "partials/header.php";
?>
<div class="containerSELF">
    <div class="centered-div">
        <div style="margin-left: 15%;margin-right: 15%;max-width: 400px">
            <form action="<?= base_url('index.php/login') ?>" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="emailInput">Email</label>
                    <input name="email" type="text"
                           class="form-control texinput <?= (isset($error['email'])) ? 'is-invalid' : '' ?> id=" email"
                    placeholder="Enter your email"
                    value="<?php if (isset($email)) {
                        echo $email;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['email'])) echo $error['email']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div id="alert">
                        <label for="password">
                            <?php if (!isset($verify)) {
                                echo "Password";
                            } else {
                                $error = "Keine Übereinstimmung mit Login-Daten!";
                                include "templates/error.php";
                            } ?>
                        </label></div>
                    <input name="password" type="password"
                           class=" form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>" id="password"
                           placeholder="Passwort" value="<?php if (isset($password)) {
                        echo $password;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['password'])) echo $error['password']; ?>
                    </div>
                </div>
                <br>
                <div class="d-inline mb-3">
                    <input type="checkbox" id="agb" value="1" name="agb"
                           class="form-check-input <?= (isset($error['agb'])) ? 'is-invalid' : '' ?>" <?php if (isset($agb)) echo 'checked'; ?>>
                    <?php if (!isset($error['agb'])) echo ' <label for="agb">Accept terms and conditions</label><br><br>'; ?>
                    <?php if (isset($error['agb'])) echo ' <label for="agb" style="color: rgb(218,53,69)">' .$error['agb'].'</label><br><br>'; ?>

                </div>
                <input type="submit" class="btn btn-primary font-weight-bold" value="Einloggen">
            </form>
            <br>
            <div class="d-inline">
                <div id="message"></div>
                <small>Noch nicht registriert?</small>
                <small><a class="text-decoration-none" href="<?php echo base_url("/index.php/register") ?>">Komm in die Gruppe ;)</a></small>
                <p></p>
                <p></p>
                <form id="myForm" action="<?= base_url('index.php/login/set') ?>" method="post">
                    <input type="hidden" name="email" value="test@testheimer.test">
                    <input type="hidden" name="password" value="test">
                    <input type="hidden" name="agb" value="1">
                    <input type="submit" class="btn btn-primary font-weight-bold" value="Test Login">
                </form>
            </div>
            <br>
        </div>
    </div>
</div>
<?php include "partials/footer.php"?>
</body>
</html>
