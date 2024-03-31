<div class="right side <?= $responsiveClass ?? '' ?>">
    <div class="side-element empty">
    </div>
    <div class="side-element">
        <a class="text-decoration-none" href="<?= base_url('index.php') ?>">Sign Off</a>
    </div>
    <div class="side-element">
        <a onmouseover="this.style.cursor='pointer'" onmouseout="this.style.cursor='default'"
           class="text-decoration-none"
           onclick="openConfirmationModal('confirmationModal-account','modalContent-account')">Delete
            Account</a>
    </div>
    <div class="side-element">
        <input type="password" id="<?= $inputname ?>" placeholder="🔑 Key" class="form-control textinput"
               onkeyup="triggerKeyAlert()" disabled>
    </div>
</div>