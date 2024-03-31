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
                <?php
                $newPassword = "New";
                include_once(dirname(__FILE__) . '/../inputPartials/password.php');
                ?>
                <p></p>
                <div class="form-group">
                    <label>Password verification</label>
                    <input name="repeatpassword" type="password"
                           class=" form-control textinput <?= (isset($error['repeatpassword'])) ? 'is-invalid' : '' ?>"
                           id="repeatpassword" placeholder="Repeat your new password"
                           value="<?= $repeatpassword ?? '' ?>">
                    <div class="invalid-feedback">
                        <?= $error['repeatpassword'] ?? '' ?>
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
