<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>

<body>
<?php
$name = $success;
include "partials/header.php";
?>
<div class="containerSELF">
    <div class="centered-div">
        <div class="formHead">
            <form action="<?= base_url('index.php/register') ?>" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="emailInput">Username</label>
                    <input name="username" type="text"
                           class="form-control texinput <?= (isset($error['username'])) ? 'is-invalid' : '' ?>"
                           id=" username"
                           placeholder="Enter your Username"
                           value="<?php if (isset($username)) {
                               echo $username;
                           } ?>" <?= ($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?php if (isset($error['username'])) echo $error['username']; ?>
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label for="emailInput">Email</label>
                    <input name="email" type="text"
                           class="form-control texinput <?= (isset($error['email'])) ? 'is-invalid' : '' ?>" id=" email"
                           placeholder="Enter your email"
                           value="<?php if (isset($email)) {
                               echo $email;
                           } ?>" <?= ($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?php if (isset($error['email'])) echo $error['email']; ?>
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password"
                           class=" form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>"
                           id="password"
                           placeholder="Enter your password" value="<?php if (isset($password)) {
                        echo $password;
                    } ?>" <?= ($finished) ? 'disabled' : '' ?>>
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
                           placeholder="Repeat your password" value="<?php if (isset($repeatpassword)) {
                        echo $repeatpassword;
                    } ?>" <?= ($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?php if (isset($error['repeatpassword'])) echo $error['repeatpassword']; ?>
                    </div>
                </div>
                <p id="agb-divider"></p>
                <div class="d-inline mb-3">
                    <input type="checkbox" id="agb" value="1" name="agb"
                           class="form-check-input <?= (isset($error['agb'])) ? 'is-invalid' : '' ?>" <?php if (isset($agb) && $agb != "") echo 'checked'; ?> <?= ($finished) ? 'disabled' : '' ?>>
                    <?php if (!isset($error['agb'])) echo ' <label for="agb">Accept terms and conditions</label><br><br>'; ?>
                    <?php if (isset($error['agb'])) echo ' <label for="agb" style="color: rgb(218,53,69)">' . $error['agb'] . '</label><br><br>'; ?>
                </div>
                <?php if (!$finished) {
                    echo '<input type="submit" class="btn btn-primary font-weight-bold" value="Submit registration"> <a href="' . base_url() . '" class="btn btn-secondary">Abort</a>';
                } else {
                    echo '<a href="' . base_url() . '" class="btn btn-primary">Back to login</a>';
                } ?>
            </form>
            <br>
        </div>
    </div>
</div>
<?php include "partials/footer.php" ?>
</body>
</html>
