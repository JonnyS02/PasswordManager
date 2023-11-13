<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>

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
                <a class="text-decoration-none" onclick="scrollToEnd()">Edit Passwords</a>
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
                    <th scope="col">Password</th>
                    <th scope="col">Other</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php $c = 1;
                    if (isset($passwords)): foreach ($passwords as $passwordFormList): ?>
                    <td><?= $c ?></td>
                    <td><?= $passwordFormList['Plattform'] ?></td>
                    <td><?= $passwordFormList['Username'] ?></td>
                    <td><?= $passwordFormList['Password'] ?></td>
                    <td><?= $passwordFormList['Additional'] ?></td>
                    <td></td>
                    <?php endforeach; endif; ?>
                </tr>
                </tbody>
            </table>
            <div class="insertPassword">
                PasswordGenerator
            </div>
            <div class="insertPassword">
                <div class="form-group">
                    <label for="emailInput">Password-Key</label>
                    <input name="username" type="text"
                           class="form-control texinput <?= (isset($error['key'])) ? 'is-invalid' : '' ?> id=" key"
                    placeholder="Enter the key to encrypt your password"
                    value="<?php if (isset($key)) {
                        echo $key;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['key'])) echo $error['key']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="emailInput">Password</label>
                    <input name="username" type="text"
                           class="form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?> id=" password"
                    placeholder="Enter your password"
                    value="<?php if (isset($password)) {
                        echo $password;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['password'])) echo $error['password']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="emailInput">Plattform</label>
                    <input name="username" type="text"
                           class="form-control texinput <?= (isset($error['plattform'])) ? 'is-invalid' : '' ?> id=" plattform"
                    placeholder="Enter plattform"
                    value="<?php if (isset($plattform)) {
                        echo $plattform;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['plattform'])) echo $error['plattform']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="emailInput">Username</label>
                    <input name="username" type="text"
                           class="form-control texinput <?= (isset($error['username'])) ? 'is-invalid' : '' ?> id=" username"
                    placeholder="Enter your Username"
                    value="<?php if (isset($username)) {
                        echo $username;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['username'])) echo $error['username']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="emailInput">Other</label>
                    <input name="username" type="text"
                           class="form-control texinput <?= (isset($error['additional'])) ? 'is-invalid' : '' ?> id=" additional"
                    placeholder="Enter additional information"
                    value="<?php if (isset($additional)) {
                        echo $additional;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['additional'])) echo $error['additional']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="right side">
            <div class="side-element empty">
            </div>
            <div class="side-element">
                <a class="text-decoration-none" href="<?= base_url('index.php/login') ?>">Sign off</a>
            </div>
            <div class="side-element">
                <a class="text-decoration-none" href="<?= base_url('index.php/login') ?>">Delete Account</a>
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
