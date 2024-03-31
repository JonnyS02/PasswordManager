<div class="form-group">
    <label>Email</label>
    <input name="email" type="text"
           class="form-control textinput <?= (isset($error['email'])) ? 'is-invalid' : '' ?>"
           id=" email" placeholder="Enter your email"
           value="<?= $email ?? '' ?>"
        <?= isset($finished) ? 'disabled' : '' ?>>
    <div class="invalid-feedback">
        <?= $error['email'] ?? '' ?>
    </div>
</div>