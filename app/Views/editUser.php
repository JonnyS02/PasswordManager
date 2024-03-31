<div class="containerSELF">
    <div class="centered-div">
        <div class="formHead">
            <form action="<?= base_url('index.php/insertChangesProfile') ?>" method="POST" class="mt-4">
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text"
                           class="form-control textinput <?= (isset($error['username'])) ? 'is-invalid' : '' ?>"
                           id=" username" placeholder="Enter your Username"
                           value="<?= $username ?? "" ?>"
                        <?= isset($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?= $error['username'] ?? '' ?>
                    </div>
                </div>
                <p></p>
                <?php include 'inputPartials/email.php' ?>
                <p></p>
                <div class="passwordHighlighter"></div>
                <div class="form-group">
                    <label>New password</label>
                    <input name="password" type="password" <?= (!(isset($changePassword))) ? 'disabled' : '' ?>
                           class=" form-control textinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>"
                           id="password" placeholder="<?= (isset($changePassword)) ? 'Enter your new password' : '' ?>"
                           value="<?= $password ?? '' ?>"
                        <?= isset($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?= $error['password'] ?? '' ?>
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label>Password verification</label>
                    <input name="repeatpassword" type="password" <?= (!(isset($changePassword))) ? 'disabled' : '' ?>
                           class=" form-control textinput <?= (isset($error['repeatpassword'])) ? 'is-invalid' : '' ?>"
                           id="repeatpassword"
                           placeholder="<?= (isset($changePassword)) ? 'Repeat your new password' : '' ?>"
                           value="<?= $repeatpassword ?? '' ?>"
                        <?= isset($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?= $error['repeatpassword'] ?? '' ?>
                    </div>
                </div>
                <p></p>
                <div class="d-inline mb-3">
                    <input type="checkbox" id="changePassword" value="1" name="changePassword"
                           style="margin-bottom: -100px" class="form-check-input"
                        <?= (isset($changePassword)) ? 'checked' : '' ?>
                        <?= isset($finished) ? 'disabled' : '' ?>
                           onclick="enableFields('repeatpassword','Repeat your new password','password','Enter your new password')">
                    <label>Change password</label>
                </div>
                <div class="passwordHighlighter"></div>
                <div class="form-group">
                    <label>Confirmation password</label>
                    <input name="password_old" type="password"
                           class=" form-control textinput <?= (isset($error['password_old'])) ? 'is-invalid' : '' ?>"
                           id="password_old" placeholder="Enter your current password"
                           value="<?= $password_old ?? '' ?>"
                        <?= isset($finished) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback">
                        <?= $error['password_old'] ?? '' ?>
                    </div>
                </div>
                <?php if (isset($noChange)) {
                    echo '                    
                    <div style="color: rgb(218,53,69); margin-top: 20px">
                        The changes are identical to the current profile. 
                    </div>
                    ';
                }
                ?>
                <br>
                <?php if (isset($finished)) {
                    echo '<a href="' . base_url("index.php/home") . '" class="btn btn-primary">Back to home</a>';
                } else {
                    echo '<input type="submit" class="btn btn-primary font-weight-bold" value="Submit changes">
                            <a href="' . base_url("index.php/home") . '" class="btn btn-secondary">Abort</a>';
                }
                ?>
            </form>
            <br>
        </div>
    </div>
</div>
