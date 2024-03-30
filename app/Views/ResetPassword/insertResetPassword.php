<!DOCTYPE html>
<html lang="en">

<?php include_once(dirname(__FILE__) . '/../partials/head.php') ?>

<body>
<?php
$name = $success;
include_once(dirname(__FILE__) . '/../partials/header.php');
?>
<div class="containerSELF">
    <div class="centered-div">
        <div class="formHead">
            <form action="<?= base_url('index.php/submitResetPassword') ?>" method="POST" class="mt-4">
                <input type="hidden" id="email" name="email" value="<?= $email ?>">
                <input type="hidden" id="xyz" name="xyz" value="<?= $xyz ?>">
                <input type="hidden" id="username" name="username" value="<?= $username ?>">

                <p style="font-size: 20px">Hello <?= $username ?>,
                    <br>
                    reset your password here.
                </p>
                <br>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input name="password" type="password"
                           class=" form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>"
                           id="password"
                           placeholder="Enter your new password" value="<?php if (isset($password)) {
                        echo $password;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['password'])) echo $error['password']; ?>
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label for="repeatpassword">Password verification</label>
                    <input name="repeatpassword" type="password"
                           class=" form-control texinput <?= (isset($error['repeatpassword'])) ? 'is-invalid' : '' ?>"
                           id="repeatpassword"
                           placeholder="Repeat your new password" value="<?php if (isset($repeatpassword)) {
                        echo $repeatpassword;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['repeatpassword'])) echo $error['repeatpassword']; ?>
                    </div>
                </div>
                <p></p>
                <input type="submit" class="btn btn-primary font-weight-bold" value="Reset Password">
                <a href="<?= $link ?>" class="btn btn-secondary">Abort</a>
            </form>
            <br>
        </div>
    </div>
</div>
<?php include_once(dirname(__FILE__) . '/../partials/footer.php') ?>
</body>
</html>
