<div class="containerSELF">
    <div class="centered-div" style="padding-top: 20px">
        <div class="generator-spacer left side" style="background-color: rgba(0,0,0,0)">
        </div>
        <div class="middle">
            <div class="insertPassword passwordGenerator" style="margin-right: 10px;">
                <div class="generator-container" style="padding: 10px;">
                    <h3 style="font-family: 'Brush Script MT','Dancing Script', 'Calibri', 'Arial', cursive;">Password
                        generator</h3>
                    <br>
                    <label>Password length: <span id="passwordLengthDisplay">12</span></label>
                    <br>
                    <input type="range" id="passwordLength" name="passwordLength" min="1" max="30" value="12"
                           oninput="updatePasswordLength(this.value)" class="form-range">
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="includeLetters" name="letters"
                               checked>
                        <label>With letters</label>
                    </div>
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="includeNumbers" name="numbers"
                               checked>
                        <label>With numbers</label>
                    </div>
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="includeSpecialChars"
                               name="includeSpecialChars" checked>
                        <label>With special characters</label>
                    </div>
                    <hr>
                    <div class="d-inline">
                        <input type="submit" class="btn btn-primary btn-sm" value="Generate" id="generateButton"
                               onclick="generatePassword()" <?= isset($id) ? 'disabled' : '' ?>>
                    </div>
                    <a onclick="resetSettings()" class="btn btn-info btn-sm text-white">Reset</a>
                    <br>
                    <br>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="viewPassword" checked
                               onclick="viewPassword()">
                        <label>Show password</label>
                    </div>
                </div>
            </div>
            <div class="insertPassword" style="margin-left: 10px;">
                <div class="form-group">
                    <label>Password-Key</label>
                    <input name="key" type="password" class="form-control textinput" id="key"
                           placeholder="<?= !isset($id) ? 'Enter the key to encrypt your password' : '' ?>"
                           value="" <?= isset($id) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback" id="key-invalid">
                    </div>
                </div>
                <p></p>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="text" class="form-control textinput " id="password"
                           placeholder="<?= !isset($id) ? 'Enter your password' : '' ?>"
                           value="" <?= isset($id) ? 'disabled' : '' ?>>
                    <div class="invalid-feedback" id="password-invalid">
                    </div>
                </div>
                <form action="<?= base_url('index.php/insertPassword') ?>" method="POST" id="submitPassword">
                    <p></p>
                    <?php if (isset($id)): ?>
                        <div class="d-inline mb-3">
                            <input type="checkbox" id="changePassword" value="1" name="changePassword" style="margin-bottom: -100px"
                                   class="form-check-input"
                                   onclick="enableFields('key','Enter the key to encrypt your password','password','Enter your password')">
                            <label>Change password</label>
                        </div>
                    <?php endif; ?>
                    <div class="passwordHighlighter"></div>
                    <input type="hidden" value="" name="passwortVerschlusselt" id="passwortVerschlusselt">
                    <div class="form-group">
                        <label>Platform</label>
                        <input name="plattform" type="text"
                               class="form-control textinput <?= ($error['plattform'] != "") ? 'is-invalid' : '' ?>"
                               id="plattform" placeholder="Enter platform"
                               value="<?= $plattform ?? '' ?>">
                        <div class="invalid-feedback" id="plattform-invalid">
                            <?= $error['plattform'] ?>
                        </div>
                    </div>
                    <p></p>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text"
                               class="form-control textinput"
                               id="username" placeholder="Enter your username"
                               value="<?= $username ?? '' ?>">
                    </div>
                    <p></p>
                    <div class="form-group">
                        <label>Additional</label>
                        <div style="display: flex; justify-content: center;align-items: center;">
                            <input name="additional" type="text"
                                   class="form-control textinput "
                                   id="additional" placeholder="Enter additional information"
                                   value="<?= $additional ?? '' ?>">
                        </div>
                    </div>
                    <p></p>
                    <a onclick="generatePassword_and_sendForm()" class="btn btn-primary">Submit password</a>
                    <a href="<?= base_url('index.php/home') ?>" class="btn btn-secondary">Abort</a>
                    <?= isset($id) ? '<p></p><label style="color: rgb(218,53,69)">Changes can not be undone.</label>' : '' ?>
                </form>
            </div>
        </div>
        <div class="generator-spacer right side" style="background-color: rgba(0,0,0,0)">
        </div>
    </div>
</div>
