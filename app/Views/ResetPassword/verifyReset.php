<?php
$request = "https://jonathan-stengl.de/PassSafePro/public/index.php/isReset";
$redirection = "https://jonathan-stengl.de/PassSafePro/public/index.php/resetVerified";
include_once(dirname(__FILE__) . '/../scripts/ajaxRequest.php');
?>

<div class="containerSELF">
    <div class="centered-div" style="text-align: center">
        <img style="margin-top: 10px" id="deinGIF" src="<?= base_url('assets/verify.gif') ?>"
             alt="verify your email address">
        <hr style="margin-left: calc(50% - 220px);width: 440px">
        <p style="font-size: 20px; text-align: center">Please use the email we sent you to reset your password.</p>
    </div>
</div>
