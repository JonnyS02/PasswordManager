<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>
<?php include "partials/home_script.html"; ?>

<body>
<?php
$name = $success;
include "partials/header.php";
?>
<div class="containerSELF">
    <div class="centered-div" style="padding-top: 20px">
        <div class="left side" style="background-color: rgba(0,0,0,0)">
        </div>

        <div class="middle">
            <div class="insertPassword passwordGenerator" style="margin-right: 10px;">
                <div class="generator-container" style="padding: 10px;">
                    <h3 style="font-family: 'Brush Script MT', cursive;">Password Generator</h3>
                    <br>
                    <label for="passwordLength">Passwort Länge: <span id="passwordLengthDisplay">12</span></label>
                    <br>
                    <input type="range" id="passwordLength" name="passwordLength" min="1" max="30" value="12"
                           oninput="updatePasswordLength(this.value)" class="form-range">
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="includeLetters"
                               name="zahlen" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked" id="includeLetters">Mit
                            Buchstaben</label>
                    </div>
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="includeNumbers"
                               name="zahlen" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked" id="includeNumbers">Mit
                            Zahlen</label>
                    </div>
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="includeSpecialChars"
                               name="sonderzeichen" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Mit Sonderzeichen</label>
                    </div>
                    <hr>
                    <div class="d-inline">
                        <input type="submit" class="btn btn-primary btn-sm" value="Generieren"
                               onclick="generatePassword()">
                    </div>
                    <a onclick="resetSettings()" class="btn btn-info btn-sm text-white">Reset</a>
                    <br>
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" checked
                               onclick="passwortSichtbarMachen()">
                        <label class="form-check-label">Passwort anzeigen</label>
                    </div>
                </div>
            </div>
            <div class="insertPassword" style="margin-left: 10px;">
                <div class="form-group">
                    <label for="emailInput">Password-Key</label>
                    <input name="username" type="password"
                           class="form-control texinput "
                           id="key" placeholder="Enter the key to encrypt your password"
                           value="">
                    <div class="invalid-feedback" id="key-invalid">
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label for="emailInput">Password</label>
                    <input name="password" type="text"
                           class="form-control texinput "
                           id="password" placeholder="Enter your password"
                           value="">
                    <div class="invalid-feedback" id="password-invalid">
                    </div>
                </div>
                <p></p>

                <?= ($error['plattform'] != "") ? '<script>window.onload = scrollToEnd();</script>' : ''; ?>

                <form action="<?= base_url('index.php/insertPassword') ?>" method="POST" id="submitPassword">
                    <input type="hidden" value=""
                           name="passwortVerschlusselt" id="passwortVerschlusselt">
                    <div class="form-group">
                        <label for="emailInput">Plattform</label>
                        <input name="plattform" type="text"
                               class="form-control texinput <?= ($error['plattform'] != "") ? 'is-invalid' : '' ?>"
                               id="plattform" placeholder="Enter plattform"
                               value="<?php if (isset($plattform)) {
                                   echo $plattform;
                               } ?>">
                        <div class="invalid-feedback" id="plattform-invalid">
                            <?= $error['plattform'] ?>
                        </div>
                    </div>
                    <p></p>
                    <div class="form-group">
                        <label for="emailInput">Username</label>
                        <input name="username" type="text"
                               class="form-control texinput"
                               id="username" placeholder="Enter your username"
                               value="<?php if (isset($username)) {
                                   echo $username;
                               } ?>">
                    </div>
                    <p></p>
                    <div class="form-group">
                        <label for="emailInput">Other</label>
                        <div style="display: flex; justify-content: center;align-items: center;">
                            <input name="additional" type="text"
                                   class="form-control texinput "
                                   id="additional" placeholder="Enter additional information"
                                   value="<?php if (isset($additional)) {
                                       echo $additional;
                                   } ?>">
                        </div>
                    </div>
                    <p></p>

                    <a onclick="generatePassword_and_sendForm()" class="btn btn-primary">Submit password</a> <a href="<?= base_url('index.php/home')?>" class="btn btn-secondary">Abort</a>

                </form>
            </div>
        </div>
        <div class="right side" style="background-color: rgba(0,0,0,0)">

        </div>

    </div>
</div>
<?php include "partials/footer.php" ?>
</body>
</html>
