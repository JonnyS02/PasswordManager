<div class="containerSELF">
    <div class="centered-div">
        <div class="formHead">
            <form action="<?= base_url('index.php/register') ?>" method="POST" class="mt-4">
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text"
                           class="form-control textinput <?= (isset($error['username'])) ? 'is-invalid' : '' ?>"
                           id=" username" placeholder="Enter your Username"
                           value="<?= $username ?? '' ?>"
                        <?= isset($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?= $error['username'] ?? '' ?>
                    </div>
                </div>
                <p></p>
                <?php include 'inputPartials/email.php'?>
                <p></p>
                <?php include 'inputPartials/password.php'?>
                <p></p>
                <div class="form-group">
                    <label>Password verification</label>
                    <input name="repeatpassword" type="password"
                           class=" form-control textinput <?= (isset($error['repeatpassword'])) ? 'is-invalid' : '' ?>"
                           id="repeatpassword" placeholder="Repeat your password"
                           value="<?= $repeatpassword ?? '' ?>"
                        <?= isset($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?= $error['repeatpassword'] ?? '' ?>
                    </div>
                </div>
                <p id="agb-divider"></p>
                <div class="d-inline mb-3">
                    <input type="checkbox" id="agb" value="1" name="agb"
                           class="form-check-input <?= (isset($error['agb'])) ? 'is-invalid' : '' ?>"
                        <?= (isset($agb) && $agb) != "" ? 'checked' : '' ?>
                        <?= isset($finished) ? 'disabled' : '' ?>>
                    <?php
                    if (isset($error['agb'])) {
                        echo ' <label style="color: rgb(218,53,69)">' . $error['agb'] . '</label><br><br>';
                    } else {
                        echo ' <label>Accept terms and conditions</label><br><br>';
                    }
                    ?>
                </div>
                <?php if (isset($finished)) {
                    echo '<a href="' . base_url() . '" class="btn btn-primary">Back to login</a>';
                } else {
                    echo '<input type="submit" class="btn btn-primary font-weight-bold" value="Submit registration"> <a href="' . base_url() . '" class="btn btn-secondary">Abort</a>';
                } ?>
            </form>
            <br>
        </div>
    </div>
</div>
