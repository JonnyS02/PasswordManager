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
            <span style="text-align: center; width: 100%; float: left">Password</span>
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
