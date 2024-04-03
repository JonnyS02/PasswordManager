<script>
    <?php if (isset($notDeleted)) echo "
        window.onload = function () {
            openConfirmationModal('confirmationModal-account', 'modalContent-account');
        };
    ";
    ?>
    document.addEventListener('DOMContentLoaded', function () {
        removeDisabled();
        synchronizeInputs('keyHolder', 'keyHolder-r');
        synchronizeInputs('plattformHolder', 'plattformHolder-r');
    });
</script>

<div id="confirmationModal-account" class="confirmationModal" style="<?= (isset($notDeleted)) ? 'opacity: 1' : "" ?>">
    <div id="modalContent-account" class="modalContent" style="<?= (isset($notDeleted)) ? 'opacity: 1' : "" ?>">
        <h3>Delete Account</h3>
        <hr>
        <p>Are you sure you want to delete your account?</p>
        <p>Your user-information and passwords will immediately be deleted.</p>
        <form action="<?= base_url('index.php/deleteUser') ?>" method="POST" class="mt-4" id="deleteUser">
            <div class="form-group">
                <label>Confirmation Password</label>
                <input name="password_account" type="password"
                       class=" form-control textinput <?= (isset($notDeleted)) ? 'is-invalid' : '' ?>"
                       id="password_account" placeholder="Enter your passwort"
                       value="<?= $password_account ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $notDeleted ?? '' ?>
                </div>
            </div>
            <p></p>
        </form>
        <input type="submit" class="btn btn-danger" onclick="send_Form('deleteUser')" value="Delete Account">
        <button class="btn btn-primary"
                onclick="closeConfirmationModal('confirmationModal-account','modalContent-account');
                document.getElementById('password_account').classList.remove('is-invalid'); document.getElementById('password_account').value ='' ">
            Abort
        </button>
    </div>
</div>

<div id="confirmationModal-noKey" class="confirmationModal">
    <div id="modalContent-noKey" class="modalContent">
        <h3>No Key</h3>
        <hr>
        <p>Please enter your Key to decrypt the password</p>
        <button class="btn btn-primary btn-sm"
                onclick="closeConfirmationModal('confirmationModal-noKey','modalContent-noKey')">Okay
        </button>
    </div>
</div>

<div class="containerSELF">
    <div class="centered-div">
        <?php
        $inputname = 'plattformHolder';
        include 'partials/leftMenu.php';

        $responsiveClass = 'responsive-side';
        $inputname = 'plattformHolder-r';
        include 'partials/leftMenu.php';

        $inputname = 'keyHolder-r';
        include 'partials/rightMenu.php';
        $responsiveClass = null;
        ?>
        <div class="middle">
            <div id="tableContainer">

                <table class="table table-striped" id="mainTable">
                    <thead class="bg-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Platform</th>
                        <th scope="col">Username</th>
                        <th scope="col">Additional</th>
                        <th scope="col">Password</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $c = 1;
                    if (isset($passwords)): foreach ($passwords as $passwordFormList): ?>
                        <tr>
                            <td><?= $c ?></td>
                            <?php
                            $tdContent = 'Plattform';
                            include 'partials/tdElement.php';

                            $tdContent = 'Username';
                            include 'partials/tdElement.php';

                            $tdContent = 'Additional';
                            include 'partials/tdElement.php';
                            ?>
                            <td>
                                <i class="fa-regular fa-eye interactive"
                                   onclick="dehas('<?= $passwordFormList['Password'] ?>','confirmationModal-noKey','modalContent-noKey')"></i>&nbsp
                                <i class="fa-regular fa-copy interactive"
                                   onclick="dehasCopy('<?= $passwordFormList['Password'] ?>','confirmationModal-noKey','modalContent-noKey')"></i>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <form style="margin: 0;padding: 0" id="editPassword<?= $c ?>"
                                          action="<?= base_url('index.php/password') ?>" method="POST">
                                        <input type="hidden" value="<?= $passwordFormList['ID'] ?>" name="passwordID">
                                        <i class="fa-regular fa-pen-to-square interactive"
                                           onclick="send_Form('editPassword<?= $c ?>')"></i>&nbsp;&nbsp;
                                    </form>
                                    <input type="hidden" value="<?= $passwordFormList['ID'] ?>" name="passwordID">
                                    <i class="fa-regular fa-trash-can interactive"
                                       onclick="openConfirmationModal('confirmationModal-password<?= $c ?>','modalContent-password<?= $c ?>')"></i>&nbsp;&nbsp;
                                </div>
                            </td>
                        </tr>
                        <div id="confirmationModal-password<?= $c ?>" class="confirmationModal">
                            <div id="modalContent-password<?= $c ?>" class="modalContent">
                                <h3>Delete Password</h3>
                                <hr>
                                <p>Are you sure you want to delete the password for
                                    <b><?= $passwordFormList['Plattform'] ?></b> ?</p>
                                <button class="btn btn-danger btn-sm"
                                        onclick="window.location.href ='<?= base_url('index.php/deletePassword?ID=' . $passwordFormList['ID']) ?>'">
                                    Yes
                                </button>
                                <button class="btn btn-primary btn-sm"
                                        onclick="closeConfirmationModal('confirmationModal-password<?= $c ?>','modalContent-password<?= $c ?>')">
                                    Abort
                                </button>
                            </div>
                        </div>
                        <?php $c++ ?>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        $inputname = 'keyHolder';
        include 'partials/rightMenu.php';
        ?>
    </div>
</div>