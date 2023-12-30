<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>

<body>
<?php
include "partials/header.php";
?>
<div class="containerSELF">
    <div class="centered-div">
        <div class="formHead">
            <form action="<?= base_url('index.php/login') ?>" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="emailInput">Email</label>
                    <input name="email" type="text"
                           class="form-control texinput <?= (isset($error['email'])) ? 'is-invalid' : '' ?>" id=" email"
                    placeholder="Enter your email"
                    value="<?php if (isset($email)) {
                        echo $email;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['email'])) echo $error['email']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password"
                           class=" form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>"
                           id="password"
                           placeholder="Enter your password" value="<?php if (isset($password)) {
                        echo $password;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['password'])) echo $error['password']; ?>
                    </div>
                </div>
                <br>
                <input type="submit" class="btn btn-primary font-weight-bold" value="Login">
            </form>
            <br>
            <small>Not registered yet?</small>
            <small><a class="text-decoration-none" href="<?php echo base_url("/index.php/register") ?>">Join the group ;)</a></small>
        </div>
    </div>
</div>
<?php include "partials/footer.php" ?>
</body>
</html>
