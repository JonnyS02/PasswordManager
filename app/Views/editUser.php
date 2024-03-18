<!DOCTYPE html>
<html lang="en">

<?php include "partials/head.php" ?>
<?php include "partials/script_enableFields.html"; ?>


<body>
<?php
$name = $success;
include "partials/header.php";
?>
<div class="containerSELF">
    <div class="centered-div">
        <div class="formHead">
            <form action="<?= base_url('index.php/insertChangesProfile') ?>" method="POST" class="mt-4">
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
                <div class="passwordHighlighter"></div>
                <div class="form-group">
                    <label for="password">New password</label>
                    <input name="password" type="password" <?php if (!(isset($changePassword))) echo 'disabled'; ?>
                           class=" form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>"
                           id="password"
                           placeholder="<?= (isset($changePassword)) ? 'Enter your new password' : '' ?>"
                           value="<?php if (isset($password)) {
                               echo $password;
                           } ?>" <?= ($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?php if (isset($error['password'])) echo $error['password']; ?>
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label for="repeatpassword">Password verification</label>
                    <input name="repeatpassword"
                           type="password" <?php if (!(isset($changePassword))) echo 'disabled'; ?>
                           class=" form-control texinput <?= (isset($error['repeatpassword'])) ? 'is-invalid' : '' ?>"
                           id="repeatpassword"
                           placeholder="<?= (isset($changePassword)) ? 'Repeat your new password' : '' ?>"
                           value="<?php if (isset($repeatpassword)) {
                               echo $repeatpassword;
                           } ?>" <?= ($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?php if (isset($error['repeatpassword'])) echo $error['repeatpassword']; ?>
                    </div>
                </div>
                <p></p>
                <div class="d-inline mb-3">
                    <input type="checkbox" id="changePassword" value="1" name="changePassword"
                           style="margin-bottom: -100px"
                           class="form-check-input" <?php if (isset($changePassword)) echo 'checked'; ?> <?= ($finished) ? 'disabled' : '' ?>
                           onclick="enableFields('repeatpassword','Repeat your new password','password','Enter your new password')"
                    >
                    <label for="changePassword">Change password</label>
                </div>
                <div class="passwordHighlighter"></div>
                <div class="form-group">
                    <label for="password">Confirmation password</label>
                    <input name="password_old" type="password"
                           class=" form-control texinput <?= (isset($error['password_old'])) ? 'is-invalid' : '' ?>"
                           id="password_old"
                           placeholder="Enter your current password" value="<?php if (isset($password_old)) {
                        echo $password_old;
                    } ?>" <?= ($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?php if (isset($error['password_old'])) echo $error['password_old']; ?>
                    </div>
                </div>
                <?php if (isset($noChange)) echo '                    
                    <div style="color: rgb(218,53,69); margin-top: 20px">
                        The changes are identical to the current profile. 
                    </div>' ?>
                <br>
                <?php if (!$finished) {
                    echo '<input type="submit" class="btn btn-primary font-weight-bold" value="Submit changes"> <a href="' . base_url("index.php/home") . '" class="btn btn-secondary">Abort</a>';
                } else {
                    echo '<a href="' . base_url("index.php/home") . '" class="btn btn-primary">Back to home</a>';
                } ?>
            </form>
            <br>
        </div>
    </div>
</div>
<?php include "partials/footer.php" ?>
</body>
</html>
