<div class="left side <?= $responsiveClass ?? '' ?>">
    <div class="side-element empty ">
    </div>
    <div class="side-element">
        <a class="text-decoration-none" href="<?= base_url('index.php/editProfile') ?>">Edit Profile</a>
    </div>
    <div class="side-element">
        <a class="text-decoration-none" href="<?= base_url('index.php/password') ?>">Insert Password</a>
    </div>
    <div class="side-element">
        <input type="text" id="<?= $inputname ?>" onkeyup="searchTable('<?= $inputname ?>')"
               placeholder="🔍 Platform" class="form-control textinput" disabled>
    </div>
</div>