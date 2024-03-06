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

    .hidden {
        display: none;
    }
</style>

<div class="containerSELF">
    <div class="centered-div">
        <img src="<?= base_url('assets/verified.gif') ?>" alt="GIF" id="gif">
        <img src="<?= base_url('assets/verified.png') ?>" alt="Last Frame" id="lastFrame" class="hidden">
        <hr style="margin-left: calc(50% - 210px);width: 420px">
        <p style="font-size: 20px; text-align: center">Your password has been reset.<br>You may now return to your
            PassSafePro Account.</p>
        <?= '<a href="' . base_url() . '" class="btn btn-primary">Back to login</a>' ?>
    </div>
</div>

<?php include "partials/footer.php" ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            document.getElementById('gif').classList.add('hidden');
            document.getElementById('lastFrame').classList.remove('hidden');
        }, 3250);
    });
</script>

</body>
</html>
