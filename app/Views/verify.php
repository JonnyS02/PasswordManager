<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>

<body>
<?php
$name = $success;
include "partials/header.php";
?>
<style>
    .centered-div {
        text-align: center;
    }
</style>
<div class="containerSELF">
    <div class="centered-div">
        <img style="margin-top: 10px" id="deinGIF" src="<?= base_url('assets/verify.gif') ?>" alt="verify your email address" >
        <hr style="margin-left: calc(50% - 200px);width: 400px">
        <p style="font-size: 15px; text-align: center">Please confirm the verification email we sent you.</p>
    </div>
</div>
<?php include "partials/footer.php" ?>
</body>
</html>
