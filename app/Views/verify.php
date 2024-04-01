<?php
$request = base_url('index.php/isverified');
$redirection = base_url("index.php/verified?email=$email");
include 'scripts/ajaxRequest.php';
?>

<div class="containerSELF">
    <div class="centered-div" style="text-align: center">
        <img style="margin-top: 10px" src="<?= base_url('assets/verify.gif') ?>" alt="verify your email address">
        <hr style="margin-left: calc(50% - 220px);width: 440px">
        <p style="font-size: 20px; text-align: center">Please confirm the verification email we sent you.</p>
    </div>
</div>
