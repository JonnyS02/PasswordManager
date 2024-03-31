<script>
    function makeAjaxRequest() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?= $request ?? ''?>", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText.trim())
                if (xhr.responseText.trim().startsWith("1")) {
                    console.log(xhr.responseText.trim())
                    window.location.href = "<?= $redirection ?? ''?>";
                }
            }
        };
        xhr.onerror = function () {
            console.error("Ajax-Error.");
        };
        var data = "email=<?= $email ?? ''?>";
        xhr.send(data);
    }
    setInterval(makeAjaxRequest, 5000);
</script>