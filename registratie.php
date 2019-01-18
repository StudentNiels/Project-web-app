<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="styletest.css" rel="stylesheet">
    </head>
    <body>
        <div class="background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-7 mt-auto">
                        <div class="pic-center">
                            <a><img class="img-fluid"  id="logo" src="images/logoB-01.svg"></a>

                        </div>
                        <hr>
                        <div class="text-center col-6 mx-auto">
                            <?php
                            include('conn.php');
                            session_start();
                            $Tn = 'user';
                            $email = $email_err = $password = $password_err = "";
                            $password_confirm = $password_confirm_err = $form_err = "";
                            $school = $school_err = $betaal = $betaal_err = "";
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (empty(trim($_POST['reg_email']))) {
                                    $email_err = "Vul een email in.";
                                } else {
                                    $sql = "SELECT email FROM " . $Tn . " WHERE email =?";
                                    if ($stmt = mysqli_prepare($conn, $sql)) {
                                        mysqli_stmt_bind_param($stmt, "s", $param_email);
                                        $param_email = trim($_POST['reg_email']);
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_store_result($stmt);
                                            if (mysqli_stmt_num_rows($stmt) == 1) {
                                                $email_err = "Email is already used.";
                                                echo $email_err;
                                            } else {
                                                $email = trim($_POST['reg_email']);
                                            }
                                        } else {
                                            echo "Something went wrong.";
                                        }
                                    }
                                }
                                if (empty(trim($_POST['reg_password']))) {
                                    $password_err = "Fill in a password.";
                                } elseif (strlen(trim($_POST["reg_password"])) < 6) {
                                    $password_err = "Password must have atleast 6 characters.";
                                } else {
                                    $password = trim($_POST['reg_password']);
                                }
                                if (empty(trim($_POST['reg_confirm_password']))) {
                                    $password_confirm_err = "Fill in both passwords";
                                } else {
                                    $password_confirm = trim($_POST['reg_confirm_password']);
                                    if (empty($password_err) && ($password != $password_confirm)) {
                                        $password_err = "Passwords don't match";
                                    }
                                }
                                if ($_POST['reg_school'] == 0) {
                                    $school_err = "Please select a school.";
                                } else {
                                    $school = trim($_POST['reg_school']);
                                }

                                if (empty($email_err) && empty($password_err) && empty($school_err)) {
                                    $sql = "INSERT INTO " . $Tn . " (Email, SchoolId, Wachtwoord, DocentPerms) VALUES ( ?, ?, ?, 0)";
                                    if ($stmt = mysqli_prepare($conn, $sql)) {
                                        mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_school, $param_password);
                                        $param_email = $email;
                                        $param_school = $school;
                                        $param_password = password_hash($password, PASSWORD_DEFAULT);
                                        if (mysqli_stmt_execute($stmt)) {
                                            header('location: betaling.php');
                                        } else {
                                            echo "Something went wrong";
                                        }
                                    }
                                } else {
                                    $form_err = "Something went wrong";
                                }
                            }
                            ?>
                            <h3> Register </h3>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                    <label>Email</label>
                                    <input type="email" name="reg_email" class="form-control" value="<?php echo $email; ?>">
                                    <span class="help-block"><?php echo $email_err; ?></span>
                                </div> 
                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label>Password</label>
                                    <input type="password" name="reg_password" class="form-control">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                    <label>Confirm Password</label>
                                    <input type="password" name="reg_confirm_password" class="form-control">
                                    <span class="help-block"><?php echo $password_confirm_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Select your school</label>
                                    <?php
                                    $TableName2 = 'School';
                                    $SQLstring = "SELECT SchoolId, SchoolNaam FROM " . $TableName2;
                                    if ($stmt1 = mysqli_prepare($conn, $SQLstring)) {
                                        $exec = mysqli_stmt_execute($stmt1);
                                        if ($exec == true) {
                                            mysqli_stmt_store_result($stmt1);
                                            mysqli_stmt_bind_result($stmt1, $sId, $sNaam);

                                            if (mysqli_stmt_num_rows($stmt1) > 0) {
                                                echo "<select class='form-control' name='reg_school'>"
                                                . "<option value='0'>Select your school</option>'";
                                                while (mysqli_stmt_fetch($stmt1)) {
                                                    echo '<option value="' . $sId . '">' . $sNaam . '</option>';
                                                }
                                                echo '</select>';
                                            } else {
                                                echo "<p>There are no schools registered!</p>";
                                            }
                                        }
                                    } else {
                                        echo 'Query ging fout!';
                                    }
                                    ?>
                                    <span class="help-block"><?php echo $school_err; ?></span>
                                </div>
                                <?php echo $form_err; ?>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                                <p>
                                    <a href='inlog.php'> Heb je al een account? klik hier </a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
