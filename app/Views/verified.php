<div class="containerSELF">
    <div class="centered-div" style="text-align: center">
        <img src="<?= base_url('assets/verified.gif') ?>" alt="GIF" id="gif">
        <img src="<?= base_url('assets/verified.png') ?>" alt="Last Frame" id="lastFrame" class="hidden">
        <hr style="margin-left: calc(50% - 210px);width: 420px">
        <?php if (isset($main) == 1) {
            echo '<p style="font-size: 20px; text-align: center">Your email address has been verified.<br>You can now use your PassSafePro Account.</p>';
            echo '<a href="' . base_url() . '" class="btn btn-primary">Back to login</a>';
        }
        ?>
        <?php if (!isset($main)) echo '<p style="font-size: 20px; text-align: center">Your email address has been verified.<br>You may close this page now.</p>'; ?>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            document.getElementById('gif').classList.add('hidden');
            document.getElementById('lastFrame').classList.remove('hidden');
        }, 3250);
    });
</script>
