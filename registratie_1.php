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
                $password_confirm = $password_confirm_err = "";
                $school = $school_err = $betaal = $betaal_err = "";
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if (empty(trim($_POST['reg_email']))) {
                        $email_err = "Vul een email in.";
                    } else {
                        $sql = "SELECT email FROM " . $tn . "WHERE email =?";
                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            mysqli_stmt_bind_param($stmt, "s", $email);
                            $param_email = trim($_POST['reg_email']);
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                                if (mysqli_stmt_num_rows($stmt) == 1) {
                                    $email_err = "Email is already used.";
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
                    } elseif (strlen(trim($_POST["password"])) < 6) {
                        $password_err = "Password must have atleast 6 characters.";
                    } else {
                        $password = trim($_POST['reg_password']);
                    }
                    if (empty(trim($_POST['reg_confirm_password']))) {
                        $password_confirm_err = "Fill in both passwords";
                    } else {
                        $password_confirm = trim($_POST['reg_password_cofirm']);
                        if ($password != $password_confirm) {
                            $password_err = "Passwords don't match";
                        }
                    }
                }





            
//              if(!empty($_POST['school']) && !empty($_POST['reg_password']) && !empty($_POST['reg_email']) && isset($_SESSION['betaald'])){
//                if($_SESSION['betaald'] == '1'){
//                  $Tn = 'user';
//                  $SQLstring2 = "SELECT Email FROM " . $Tn . " WHERE Email = '" . $_POST['reg_email'] . "'";
//                  if ($stmt3 = mysqli_prepare($conn, $SQLstring2)) {
//                    if(mysqli_stmt_execute($stmt3)){
//                    mysqli_stmt_store_result($stmt3);
//                    if (mysqli_stmt_num_rows($stmt3) == 0) {
//                      $TableName = 'user';
//                      $query = "INSERT INTO " . $TableName . " (Email, SchoolId, Wachtwoord, DocentPerms) VALUES ( ?, ?, ?, 0)";
//                      if($stmt = mysqli_prepare($conn, $query)){
//                        $pwhash = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
//                        mysqli_stmt_bind_param($stmt, 'sss', $_POST['reg_email'], $_POST['school'], $pwhash);
//                        if(mysqli_stmt_execute($stmt)){
//                          $_SESSION['betaald'] = '0';
//                          header("Location: betaling.php");
//                        }
//                      } else {
//                        echo "<br>Error: " . $query . "<br>" . mysqli_error($conn);
//                      }
//                    }else{
//                      echo 'emailadres is al in gebruik.';
//                    }
//                  } else {
//                      echo "Something went wrong.";
//                  }
//                  } 
//                }
//                // echo 'poging';
//                else {
//                  echo 'Controleer of je alle velden hebt ingevuld en het abbonoment hebt betaald';
//                }
//              }else{
//                echo 'betaal het abbonement';
////                print_r($_SESSION);
//              }
//            }
                            ?>
                            <h3> Register </h3>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                                    <span class="help-block"><?php echo $email_err; ?></span>
                                </div> 
                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" value="<?php echo $password_confirm_err; ?>">
                                    <span class="help-block"><?php echo $password_confirm_err; ?></span>
                                </div>
                                <div class="form-group">
                                    Select your school
                                    <?php
                                    $TableName2 = 'School';
                                    $SQLstring = "SELECT SchoolId, SchoolNaam FROM " . $TableName2;
                                    if ($stmt1 = mysqli_prepare($conn, $SQLstring)) {
                                        $exec = mysqli_stmt_execute($stmt1);
                                        if ($exec == true) {
                                            mysqli_stmt_store_result($stmt1);
                                            mysqli_stmt_bind_result($stmt1, $sId, $sNaam);

                                            if (mysqli_stmt_num_rows($stmt1) > 0) {
                                                echo '<select class="form-control" name="school">
                        ';
                                                while (mysqli_stmt_fetch($stmt1)) {
                                                    echo '<option value="' . $sId . '">' . $sNaam . '</option>';
                                                }
                                                echo '</select>';
                                            } else {
                                                echo "<p>There are no schools registered!</p>";
                                            }
                                        }
                                    } else {
                                        echo 'query ging fout!';
                                    }
                                    ?>
                                </div>
                                </p>
                                <p>
                                    <a href='betaling.php' target="_blank">
                                    </a>
                                </p>
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
    </div>
</body>
</html>
