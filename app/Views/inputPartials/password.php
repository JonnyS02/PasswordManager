<div class="form-group">
    <label><?= $newPassword ?? '' ?> Password</label>
    <input name="password" type="password"
           class=" form-control textinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>"
           id="password" placeholder="Enter your password"
           value="<?= $password ?? '' ?>"
        <?= isset($finished) ? 'disabled' : '' ?>>
    <div class="invalid-feedback">
        <?= $error['password'] ?? '' ?>
    </div>
</div>