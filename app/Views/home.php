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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.getElementById("myInput").disabled = false;
            document.getElementById("schluesselHolder").disabled = false;
        }, 700);
    });

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            searchTable('myInput');
        }, 1500);
    });

</script>

<style>
    .form-control {
        transition: background-color 0.3s ease;
    }
</style>

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
                <a class="text-decoration-none" href="<?= base_url('index.php/password') ?>">Insert Password</a>
            </div>
            <div class="side-element">
                <input type="text" id="myInput" onkeyup="searchTable('myInput')" placeholder="🔍 Platform" class="form-control" disabled>
            </div>
        </div>
        <div class="middle">
            <table class="table table-striped" id="myTable">
                <thead class="bg-light">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Platform</th>
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
                                      action="<?= base_url('index.php/password') ?>" method="POST">
                                    <input type="hidden" value="<?= $passwordFormList['ID'] ?>" name="passwordID">
                                    <i class="fa-regular fa-pen-to-square" style="font-size: 1.2em" onclick="send_Form('editPassword<?= $c ?>')"></i>&nbsp;&nbsp;
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
                                    onclick="window.location.href ='<?= base_url('index.php/deletePassword?ID=' . $passwordFormList['ID']) ?>'">
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
                <input type="password" id="schluesselHolder" placeholder="🔑 Key" class="form-control" disabled>
            </div>
        </div>
    </div>
</div>
<?php include "partials/footer.php" ?>

</body>
</html>