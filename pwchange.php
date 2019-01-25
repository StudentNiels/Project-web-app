<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/style.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <title>Wachtwoord veranderen</title>
    </head>
    <body style="background-color: #202534; color: white;">

        <?php
        include('conn.php');
        include('sidebar.php');
        $username = $password = $confirm_password = $result = $email = "";
        $username_err = $password_err = $confirm_password_err = $email_err = $email_result = $email_confirm = "";
        $userId = $_SESSION['userId'];

        if (isset($_POST['submitEmail'])) {
            $email = trim($_POST['email']);
            $email_confirm = trim($_POST['email_confirm']);
            if (!empty($email) && !empty($email_confirm)) {
                if ($email != $email_confirm) {
                    $email_err = "Email komt niet overeen.";
                } else {
                    $sql = "SELECT email FROM user WHERE email = ?";
                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_stmt_store_result($stmt);
                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                $sql = "UPDATE user SET Email = ? WHERE userID = " . $userId;
                                if ($stmt = mysqli_prepare($conn, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "s", $email);
                                    if (mysqli_stmt_execute($stmt)) {
                                        $email_result = "Email succesvol veranderd.";
                                        $_SESSION['username'] = $email;
                                    } else {
                                        $email_result = "Something went wrong";
                                    } mysqli_stmt_close($stmt);
                                }
                            } else {
                                $email_result = "Dit email-adres is al in gebruik.";
                            }
                        } else $email_result = "Something went wrong.";
                    }
                }
            } else {
                $email_err = "Vul beide velden in.";
            }
        }

        if (isset($_POST['submitpw'])) {

            $password = $_POST['password'];
            $sql = "SELECT Wachtwoord FROM user WHERE userID= " . $userId;
            if ($stmt = mysqli_prepare($conn, $sql)) {

                if (mysqli_stmt_execute($stmt)) {

                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {

                        mysqli_stmt_bind_result($stmt, $hashed_password);
                        echo $hashed_password;
                        if (mysqli_stmt_fetch($stmt)) {

                            if (password_verify($password, $hashed_password)) {

                                if (empty(trim($_POST["new_password"]))) {
                                    $password_err = "Please enter a new password.";
                                } elseif (strlen(trim($_POST["new_password"])) < 6) {
                                    $password_err = "Password must have atleast 6 characters.";
                                } else {
                                    $new_password = trim($_POST["new_password"]);
                                }

                                if (empty(trim($_POST["repeat_password"]))) {
                                    $confirm_password_err = "Please confirm password.";
                                } else {
                                    $confirm_password = trim($_POST["repeat_password"]);
                                    if (empty($password_err) && ($new_password != $confirm_password)) {
                                        $confirm_password_err = "Password did not match.";
                                    }
                                }
                                $sql = "UPDATE user SET Wachtwoord = ? WHERE userID =" . $userId;
                                if ($stmt = mysqli_prepare($conn, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "s", $param_password);
                                    $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                                    if (mysqli_stmt_execute($stmt)) {
                                        $result = "Password changed succesfully!";
                                    } else {
                                        $result = "Something went wrong";
                                    }
                                } else {
                                    $result = "Something went wrong";
                                }
                            } else {
                                $password_err = "Wrong password";
                            }
                        }
                    } else {
                        $result = "Something went wrong";
                    }
                }
            }
        }
        $sql = "SELECT Email FROM user WHERE userID =" . $userId;
        if ($stmt = mysqli_prepare($conn, $sql)) {
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $email);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_fetch($stmt)) {
                    ?>
                    <div id = 'mijnflix' class = "center">
                        <h2>Account informatie</h2>
                        <h3>Verander email</h3>
                        <form action = "<?PHP echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "post" enctype = "multipart/form-data">
                            <div class = "form-group">
                                <label>Verander email</label>
                                <input type = "text" name = "email" class = "form-control" value = "<?php echo $email; ?>">
                            </div>
                            <div class = "form-group">
                                <label>Verander nieuwe email</label>
                                <input type = "text" name = "email_confirm" class = "form-control">
                                <span class = "help-block"> <?php echo $email_err ?></span>
                            </div>
                            <div class="form-group">
                                <?php echo $email_result; ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submitEmail" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }mysqli_stmt_close($stmt);
        }
        ?>
        <div id = 'mijnflix' class = "center">
            <h3>Verander wachtwoord</h3>
            <form action = "<?PHP echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "post" enctype = "multipart/form-data">
                <div class="form-group">
                    <label>Huidige wachtwoord</label>
                    <input type="password" name="password" class="form-control" value="">
                    <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Nieuw wachtwoord</label>
                    <input type="password" name="new_password" class="form-control" value="">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Herhaal wachtwoord</label>
                    <input type="password" name="repeat_password" class="form-control" value="">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <?php echo $result; ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="submitpw" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </body>
</html>
