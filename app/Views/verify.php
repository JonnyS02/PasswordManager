<script>
    function makeAjaxRequest() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "https://jonathan-stengl.de/PassSafePro/public/index.php/isverified", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText.trim())

                if (xhr.responseText.trim().startsWith(1)) {
                    console.log(xhr.responseText.trim())
                    window.location.href = "https://jonathan-stengl.de/PassSafePro/public/index.php/verified?email=<?= $email . '"' ?? '"'?>;
                }
            }
        };
        xhr.onerror = function () {
            console.error("Ajax-Error.");
        };
        var data = <?= '"email=' . $email . '"'?>;
        xhr.send(data);
    }

    setInterval(makeAjaxRequest, 5000);
</script>

<div class="containerSELF">
    <div class="centered-div" style="text-align: center">
        <img style="margin-top: 10px" id="deinGIF" src="<?= base_url('assets/verify.gif') ?>"
             alt="verify your email address">
        <hr style="margin-left: calc(50% - 220px);width: 440px">
        <p style="font-size: 20px; text-align: center">Please confirm the verification email we sent you.</p>
    </div>
</div>
