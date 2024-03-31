function generatePassword() {
    var passwordLength = document.getElementById('passwordLength').value;
    var includeLetters = document.getElementById('includeLetters').checked;
    var includeNumbers = document.getElementById('includeNumbers').checked;
    var includeSpecialChars = document.getElementById('includeSpecialChars').checked;

    var charset = '';
    var lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
    var uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var numbers = '01234567890123456789';
    var specialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    charset += includeLetters ? lowercaseLetters : '';
    charset += includeLetters ? uppercaseLetters : '';

    charset += includeNumbers ? numbers : '';
    charset += includeSpecialChars ? specialChars : '';

    var password = '';
    for (var i = 0; i < passwordLength; i++) {
        var randomIndex = Math.floor(Math.random() * charset.length);
        password += charset.charAt(randomIndex);
    }

    document.getElementById("password").value = password;
}

function generatePassword_and_sendForm() {
    if (areInputsValid()) {
        var passwordInput = document.getElementById('password');
        var keyInput = document.getElementById('key');

        var encryptedPassword = verschluesseln(passwordInput.value, keyInput.value);
        document.getElementById('passwortVerschlusselt').value = encryptedPassword;

        var formElement = document.getElementById('submitPassword');
        formElement.submit();
    }
}

function send_Form(id) {
    const formElement = document.getElementById(id);
    formElement.submit();
}

function areInputsValid() {
    var inputs = ['key', 'password', 'plattform'];
    var valid = true;
    for (var i = 0; i < inputs.length; i++) {
        var invalid = document.getElementById(inputs[i] + '-invalid');
        var field = document.getElementById(inputs[i]);
        if (field.value === "" && field.disabled === false) {
            field.classList.add("is-invalid");
            invalid.innerHTML = "The " + inputs[i] + " field is required.";
            valid = false;
        } else {
            field.classList.remove("is-invalid");
            invalid.innerHTML = "";
        }
    }
    return valid;
}

function updatePasswordLength(length) {
    document.getElementById("passwordLengthDisplay").innerHTML = length;
}

function resetSettings() {
    document.getElementById('passwordLength').value = 12;
    updatePasswordLength(12);
    if (!document.getElementById('viewPassword').checked)
        viewPassword();
    ['includeLetters', 'includeNumbers', 'includeSpecialChars', 'viewPassword'].forEach(id => {
        document.getElementById(id).checked = true;
    });
}

function verschluesseln(passwort, schluessel) {
    let verschluesselt = CryptoJS.AES.encrypt(passwort, schluessel).toString();
    return verschluesselt;
}

function entschluesseln(verschluesselt, schluessel) {
    return CryptoJS.AES.decrypt(verschluesselt, schluessel).toString(CryptoJS.enc.Utf8);
}

function viewPassword() {
    var passwortFeld = document.getElementById("password");
    if (passwortFeld.type === "password") {
        passwortFeld.type = "text";
    } else {
        passwortFeld.type = "password";
    }
}

function dehas(passwort, modal_name, modalContent_name) {
    if (!triggerKeyAlert()) {
        openConfirmationModal(modal_name, modalContent_name);
    } else {
        let schluessel = document.getElementById("keyHolder").value;
        alert("Passwort: " + entschluesseln(passwort, schluessel));
    }
}

function triggerKeyAlert() {
    var field = document.getElementById('keyHolder');
    var fieldr = document.getElementById('keyHolder-r');
    var isEmpty = field.value === "";
    field.classList.toggle("is-invalid", isEmpty);
    fieldr.classList.toggle("is-invalid", isEmpty);
    return !isEmpty;
}

function dehasCopy(passwort, modal_name, modalContent_name) {
    var field = document.getElementById('keyHolder');
    if (document.getElementById("keyHolder").value === "") {
        openConfirmationModal(modal_name, modalContent_name);
        field.classList.add("is-invalid");
        return
    }
    field.classList.remove("is-invalid");
    let schluessel = document.getElementById("keyHolder").value;
    copy(entschluesseln(passwort, schluessel), "Das Passwort")
}

function copy(content) {
    ["plattformHolder", "keyHolder", "plattformHolder-r", "keyHolder-r"].forEach(function (id) {
        document.getElementById(id).disabled = true;
    });
    let hiddenInput = document.createElement("input");
    Object.assign(hiddenInput, {type: "text", value: content});
    document.body.appendChild(hiddenInput);
    hiddenInput.select();
    document.execCommand("copy");
    document.body.removeChild(hiddenInput);
    removeDisabled();
}

function removeDisabled() {
    setTimeout(function () {
        ["plattformHolder", "keyHolder", "plattformHolder-r", "keyHolder-r"].forEach(function (id) {
            document.getElementById(id).disabled = false;
        });
    }, 700);
}

var pageLoadTime = new Date().getTime();

function searchTable(plattformHolder) {
    var currentTime = new Date().getTime();
    if (currentTime - pageLoadTime > 1000) {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById(plattformHolder);
        filter = input.value.toUpperCase();
        table = document.getElementById("mainTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}

function openConfirmationModal(modal_name, modalContent_name) {
    var modal = document.getElementById(modal_name);
    modal.style.display = 'flex';
    setTimeout(function () {
        modal.style.opacity = '1';
        document.getElementById(modalContent_name).style.opacity = '1';
    }, 10);
}

function closeConfirmationModal(modal_name, modalContent_name) {
    var modal = document.getElementById(modal_name);
    modal.style.opacity = '0';
    document.getElementById(modalContent_name).style.opacity = '0';
    setTimeout(function () {
        modal.style.display = 'none';
    }, 500);
}

function synchronizeInputs(inputId1, inputId2) {
    const input1 = document.getElementById(inputId1);
    const input2 = document.getElementById(inputId2);

    input1.addEventListener('input', () => {
        input2.value = input1.value;
    });

    input2.addEventListener('input', () => {
        input1.value = input2.value;
    });
}

function enableFields(field1, placeholder1, field2, placeholder2) {
    var field1Element = document.getElementById(field1);
    var field2Element = document.getElementById(field2);
    var generateButton = document.getElementById("generateButton");
    [{element: field1Element, placeholder: placeholder1},
        {element: field2Element, placeholder: placeholder2
        }].forEach(function (item) {
        item.element.disabled = !item.element.disabled;
        item.element.value = item.element.disabled ? "" : item.element.value;
        item.element.placeholder = item.element.disabled ? "" : item.placeholder;
        item.element.classList.remove("is-invalid");
    });
    if (generateButton) {
        generateButton.disabled = !generateButton.disabled;
    }
}