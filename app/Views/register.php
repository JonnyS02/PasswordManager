<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aufgabenplaner</title>
    <link href="https://unpkg.com/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-height: 100vh;
        }

        .containerSELF {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .centered-div {
            min-height: calc(100vh - 274px);
            width: 100%;
            max-width: 1920px;
            background-color: rgba(0, 188, 255, 0);
            padding: 20px;
        }
        #footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
$name = "Register";
include "partials/header.php";
?>
<div class="containerSELF">
    <div class="centered-div">
        <div style="margin-left: 15%;margin-right: 15%;max-width: 400px">
            <form action="<?= base_url('index.php/login') ?>" method="POST" class="mt-4">
                <div class="form-group">
                    <label for="emailInput">Email</label>
                    <input name="email" type="text"
                           class="form-control texinput <?= (isset($error['email'])) ? 'is-invalid' : '' ?> id=" email"
                    placeholder="Enter your email"
                    value="<?php if (isset($email)) {
                        echo $email;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['email'])) echo $error['email']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div id="alert">
                        <label for="password">
                            <?php if (!isset($verify)) {
                                echo "Password";
                            } else {
                                $error = "Keine Übereinstimmung mit Login-Daten!";
                                include "templates/error.php";
                            } ?>
                        </label></div>
                    <input name="password" type="password"
                           class=" form-control texinput <?= (isset($error['password'])) ? 'is-invalid' : '' ?>" id="password"
                           placeholder="Enter your password" value="<?php if (isset($password)) {
                        echo $password;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['password'])) echo $error['password']; ?>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div id="alert">
                        <label for="repeatpassword">
                            <?php if (!isset($verify)) {
                                echo "Repeat Password";
                            } else {
                                $error = "Keine Übereinstimmung mit Login-Daten!";
                                include "templates/error.php";
                            } ?>
                        </label></div>
                    <input name="repeatpassword" type="repeatpassword"
                           class=" form-control texinput <?= (isset($error['repeat-password'])) ? 'is-invalid' : '' ?>" id="repeatpassword"
                           placeholder="Repeat your password" value="<?php if (isset($repeatpassword)) {
                        echo $repeatpassword;
                    } ?>">
                    <div class="invalid-feedback">
                        <?php if (isset($error['repeatpassword'])) echo $error['repeatpassword']; ?>
                    </div>
                </div>
                <br>
                <div class="d-inline mb-3">
                    <input type="checkbox" id="agb" value="1" name="agb"
                           class="form-check-input <?= (isset($error['agb'])) ? 'is-invalid' : '' ?>" <?php if (isset($agb)) echo 'checked'; ?>>
                    <?php if (!isset($error['agb'])) echo ' <label for="agb">Accept terms and conditions</label><br><br>'; ?>
                    <?php if (isset($error['agb'])) echo ' <label for="agb" style="color: rgb(218,53,69)">' .$error['agb'].'</label><br><br>'; ?>
                </div>
                <input type="submit" class="btn btn-primary font-weight-bold" value="Submit registration">
            </form>
            <br>
        </div>
    </div>
</div>
<div id="footer">
    © 2023 Jonathan Stengl
</div>
</body>
</html>
