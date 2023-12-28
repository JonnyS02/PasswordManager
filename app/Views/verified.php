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
        <hr style="margin-left: calc(50% - 220px);width: 400px">
        <?php if (isset($main) == 1){ echo '<p style="font-size: 20px; text-align: center">Your email address has been verified.<br>You can now use your PassSafePro Account.</p>';
            echo '<a href="' . base_url() . '" class="btn btn-primary">Back to login</a>';}
        ?>
        <?php if (!isset($main)) echo '<p style="font-size: 20px; text-align: center">Your email address has been verified.<br>You may close this page now.</p>'; ?>
    </div>
</div>

<?php include "partials/footer.php" ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            document.getElementById('gif').classList.add('hidden');
            document.getElementById('lastFrame').classList.remove('hidden');
        }, 3200);
    });
</script>

</body>
</html>
