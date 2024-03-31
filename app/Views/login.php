<div class="containerSELF">
    <div class="centered-div">
        <div class="formHead">
            <form action="<?= base_url('index.php/login') ?>" method="POST" class="mt-4">
                <?php include 'inputPartials/email.php'?>
                <br>
                <?php include 'inputPartials/password.php'?>
                <br>
                <input type="submit" class="btn btn-primary font-weight-bold" value="Login">
            </form>
            <br>
            <small>Not registered yet?</small>
            <small>
                <a class="text-decoration-none" href="<?php echo base_url("/index.php/register") ?>">Join the group;)</a>
            </small>
        </div>
    </div>
</div>

