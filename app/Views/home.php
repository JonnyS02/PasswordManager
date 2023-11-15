<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>
<?php include "partials/script.html"; ?>

<body>
<?php
$name = "&nbsp" . $user;
include "partials/header.php";
?>
<div class="containerSELF">
    <div class="centered-div">
        <div class="left side">
            <div class="side-element empty">
            </div>
            <div class="side-element">
                <a class="text-decoration-none" href="<?= base_url('index.php/register') ?>">Edit Profile</a>
            </div>
            <div class="side-element">
                <a class="text-decoration-none" onclick="scrollToEnd()">Insert Password</a>
            </div>
            <div class="side-element">
                <input type="text" id="myInput" onkeyup="searchTable()" placeholder="🔍 Plattform" class="form-control">
            </div>
        </div>
        <div class="middle">
            <table class="table table-striped" id="myTable">
                <thead class="bg-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Plattform</th>
                    <th scope="col">Username</th>
                    <th scope="col">Other</th>
                    <th scope="col">Password</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                <?php $c = 1;
                if (isset($passwords)): foreach ($passwords as $passwordFormList): ?>
                    <tr>
                        <td><?= $c ?></td>
                        <td><?= $passwordFormList['Plattform'] ?></td>
                        <td><?= $passwordFormList['Username'] ?></td>
                        <td><?= $passwordFormList['Additional'] ?></td>
                        <td>
                            <i class="fa-regular fa-eye" style="font-size: 1.2em" onclick="dehas('<?= $passwordFormList['Password'] ?>')"></i>&nbsp
                            <i class="fa-regular fa-copy" style="font-size: 1.2em" onclick="dehasCopy('<?= $passwordFormList['Password'] ?>')"></i>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <form style="margin: 0;padding: 0" id="editPassword" action="<?= base_url('index.php/deletePassword') ?>" method="POST" onsubmit="return confirmDelete();">
                                    <input type="hidden" value="<?= $passwordFormList['ID'] ?>" name="passwordID">
                                    <i class="fa-regular fa-pen-to-square" style="font-size: 1.2em" onclick="confirmDelete()"></i>&nbsp;&nbsp;
                                </form>
                                <form style="margin: 0;padding: 0" id="editPassword" action="<?= base_url('index.php/deletePassword') ?>" method="POST" onsubmit="return confirmDelete();">
                                    <input type="hidden" value="<?= $passwordFormList['ID'] ?>" name="passwordID">
                                    <i class="fa-regular fa-trash-can" style="font-size: 1.2em" onclick="confirmDelete()"></i>&nbsp;&nbsp;
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php $c++ ?>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
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
                    <a href="<?= base_url('index.php/home') ?>" class="btn btn-info btn-sm text-white">Reset</a>
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
                           class="form-control texinput <?= (isset($error['key'])) ? 'is-invalid' : '' ?>"
                           id="key" placeholder="Enter the key to encrypt your password"
                           value="<?php if (isset($key)) {
                               echo $key;
                           } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['key'])) echo $error['key']; ?>
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label for="emailInput">Password</label>
                    <input name="password" type="text"
                           class="form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>"
                           id="password" placeholder="Enter your password"
                           value="<?php if (isset($password)) {
                               echo $password;
                           } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['password'])) echo $error['password']; ?>
                    </div>
                </div>
                <p></p>
                <form action="<?= base_url('index.php/insertPassword') ?>" method="POST" id="submitPassword">
                    <input type="hidden" value=""
                           name="passwortVerschlusselt" id="passwortVerschlusselt">
                    <div class="form-group">
                        <label for="emailInput">Plattform</label>
                        <input name="plattform" type="text"
                               class="form-control texinput <?= (isset($error['plattform'])) ? 'is-invalid' : '' ?>"
                               id="plattform" placeholder="Enter plattform"
                               value="<?php if (isset($plattform)) {
                                   echo $plattform;
                               } ?>">
                        <div class="invalid-feedback">
                            <?php if (isset($error['plattform'])) echo $error['plattform']; ?>
                        </div>
                    </div>
                    <p></p>
                    <div class="form-group">
                        <label for="emailInput">Username</label>
                        <input name="username" type="text"
                               class="form-control texinput <?= (isset($error['username'])) ? 'is-invalid' : '' ?>"
                               id="username" placeholder="Enter your username"
                               value="<?php if (isset($username)) {
                                   echo $username;
                               } ?>">
                        <div class="invalid-feedback">
                            <?php if (isset($error['username'])) echo $error['username']; ?>
                        </div>
                    </div>
                    <p></p>
                    <div class="form-group">
                        <label for="emailInput">Other</label>
                        <div style="display: flex; justify-content: center;align-items: center;">
                            <input name="additional" type="text"
                                   style="width: calc(100% - 48px);float: left;margin-right: 10px"
                                   class="form-control texinput <?= (isset($error['additional'])) ? 'is-invalid' : '' ?>"
                                   id="additional" placeholder="Enter additional information"
                                   value="<?php if (isset($additional)) {
                                       echo $additional;
                                   } ?>">
                            <button type="button" class="btn btn-success btn-sm" onclick="test()"
                                    style="width: 38px;float: left;">
                                <i class="fa-regular fa-floppy-disk" style="font-size: 1.7em"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">
                            <?php if (isset($error['additional'])) echo $error['additional']; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="right side">
            <div class="side-element empty">
            </div>
            <div class="side-element">
                <a class="text-decoration-none" href="<?= base_url('index.php/login') ?>">Sign Off</a>
            </div>
            <div class="side-element">
                <a class="text-decoration-none" href="<?= base_url('index.php/deleteUser') ?>">Delete Account</a>
            </div>
            <div class="side-element">
                <input type="password" id="schluesselHolder" placeholder="🔑 Key" class="form-control">
            </div>
        </div>
    </div>
</div>
<?php include "partials/footer.php" ?>
</body>
</html>
