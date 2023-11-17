<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>
<?php include "partials/home_script.html"; ?>

<body>
<?php
$name = "&nbsp" . $user;
include "partials/header.php";
?>

<?= (isset($notDeleted)) ? "    <script>
        window.onload = function () {
            openConfirmationModal('confirmationModal-account', 'modalContent-account');
        };
    </script>" : ""; ?>


<div id="confirmationModal-account" class="confirmationModal" style="<?= (isset($notDeleted)) ? 'opacity: 1':""?>">
    <div id="modalContent-account" class="modalContent" style="<?= (isset($notDeleted)) ? 'opacity: 1':""?>">
        <h3>Delete Account</h3>
        <hr>
        <p>Are you sure you want to delete your account?</p>
        <p>Your user-information and passwords will immediately be deleted.</p>
        <form action="<?= base_url('index.php/deleteUser') ?>" method="POST" class="mt-4" id="deleteUser">
            <div class="form-group">
                <label for="password_account">Confirmation Password</label>
                <input name="password_account" type="password"
                       class=" form-control texinput <?= (isset($notDeleted)) ? 'is-invalid' : '' ?>"
                       id="password_account"
                       placeholder="Enter your passwort" value="<?php if (isset($password_account)) {
                    echo $password_account;
                } ?>">
                <div class="invalid-feedback">
                    <?php if (isset($notDeleted)) echo $notDeleted; ?>
                </div>
            </div>
            <p></p>
        </form>
        <input type="submit" class="btn btn-danger font-weight-bold" onclick="send_Form('deleteUser')" value="Delete Account">

        &nbsp&nbsp
        <button class="btn btn-primary btn-sm"
                onclick="closeConfirmationModal('confirmationModal-account','modalContent-account');
                document.getElementById('password_account').classList.remove('is-invalid'); document.getElementById('password_account').value ='' ">Abort
        </button>
    </div>
</div>

<div id="confirmationModal-noKey" class="confirmationModal">
    <div id="modalContent-noKey" class="modalContent">
        <h3>No Key</h3>
        <hr>
        <p>Please enter your Key to decrypt the password</p>
        <button class="btn btn-primary btn-sm"
                onclick="closeConfirmationModal('confirmationModal-noKey','modalContent-noKey')">Okay
        </button>
    </div>
</div>

<div class="containerSELF">
    <div class="centered-div">
        <div class="left side">
            <div class="side-element empty">
            </div>
            <div class="side-element">
                <a class="text-decoration-none" href="<?= base_url('index.php/editProfile') ?>">Edit Profile</a>
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
                            <i class="fa-regular fa-eye" style="font-size: 1.2em"
                               onclick="dehas('<?= $passwordFormList['Password'] ?>','confirmationModal-noKey','modalContent-noKey')"></i>&nbsp
                            <i class="fa-regular fa-copy" style="font-size: 1.2em"
                               onclick="dehasCopy('<?= $passwordFormList['Password'] ?>','confirmationModal-noKey','modalContent-noKey')"></i>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <form style="margin: 0;padding: 0" id="editPassword<?= $c ?>"
                                      action="<?= base_url('index.php/deletePassword') ?>" method="POST">
                                    <input type="hidden" value="<?= $passwordFormList['ID'] ?>" name="passwordID">
                                    <i class="fa-regular fa-pen-to-square" style="font-size: 1.2em"></i>&nbsp;&nbsp;
                                </form>
                                <input type="hidden" value="<?= $passwordFormList['ID'] ?>" name="passwordID">
                                <i class="fa-regular fa-trash-can" style="font-size: 1.2em"
                                   onclick="openConfirmationModal('confirmationModal-password<?= $c ?>','modalContent-password<?= $c ?>')"></i>&nbsp;&nbsp;
                            </div>
                        </td>
                    </tr>
                    <div id="confirmationModal-password<?= $c ?>" class="confirmationModal">
                        <div id="modalContent-password<?= $c ?>" class="modalContent">
                            <h3>Delete Password</h3>
                            <hr>
                            <p>Are you sure you want to delete the password for
                                <b><?= $passwordFormList['Plattform'] ?></b> ?</p>
                            <button class="btn btn-danger btn-sm"
                                    onclick="confirmRedirect('<?= base_url('index.php/deletePassword?ID=' . $passwordFormList['ID']) ?>')">
                                Yes
                            </button>
                            &nbsp&nbsp
                            <button class="btn btn-primary btn-sm"
                                    onclick="closeConfirmationModal('confirmationModal-password<?= $c ?>','modalContent-password<?= $c ?>')">
                                Abort
                            </button>
                        </div>
                    </div>
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
                                   style="width: calc(100% - 48px);float: left;margin-right: 10px"
                                   class="form-control texinput "
                                   id="additional" placeholder="Enter additional information"
                                   value="<?php if (isset($additional)) {
                                       echo $additional;
                                   } ?>">
                            <button type="button" class="btn btn-success btn-sm"
                                    onclick="generatePassword_and_sendForm()"
                                    style="width: 38px;float: left;">
                                <i class="fa-regular fa-floppy-disk" style="font-size: 1.7em"></i>
                            </button>
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
                <a onmouseover="this.style.cursor='pointer'" onmouseout="this.style.cursor='default'"
                   class="text-decoration-none"
                   onclick="openConfirmationModal('confirmationModal-account','modalContent-account')">Delete
                    Account</a>
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
