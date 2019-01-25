<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link type="text/css" rel="stylesheet" href="css/index.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="styletest.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body>
        <div class="background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-7 mt-auto">
                        <div class="pic-center">
                            <a><img class="img-fluid"  id="logo" src="images/logoB-01.svg" alt="logo from I learn flix"></a>

                        </div>
                        <div class="text-center col-6 mx-auto">


                            <h3> Login </h3>
                            <form method="post">

                                <div class="form-group">
                                    <p>
                                        <input class="form-control" type='email' name='login_username' placeholder="Enter your email">
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p>
                                        <input class="form-control" type='password' name='login_password' placeholder="Enter your password">
                                    </p>
                                </div>
                                <div class="form-group">
                                    <p>
                                        <input class="form-control" type='submit' value='Login' name='login_submit'>
                                    </p>
                                </div>
                                <p>
                                    <a href='registratie_EN.php'> Don't have an account? Click here to register! </a><br>
                                    <a href='inlog.php'> Ben je Nederlands? klik hier </a>
                                </p>
                            </form>

                            <?php
                            session_start();
                            if (isset($_SESSION['loggedin'])) {
                                header('Location: index_EN.php');
                            }
                            include('conn.php');
                            if (isset($_GET['reg'])) {
                                echo 'Registration succesfull';
                            } elseif (isset($_GET['log'])) {
                                echo 'Log in before you continue!';
                            }
                            if (isset($_POST['login_submit'])) {
                                // checks
                                if (empty($_POST['login_username'])) {
                                    echo 'Enter an email';
                                } elseif (empty($_POST['login_password'])) {
                                    echo 'Enter a password';
                                } else {
                                    $TableName = 'user';
                                    $username = $_POST["login_username"];
                                    $postpw = $_POST['login_password'];
                                    $SQLstring = 'SELECT user.userId, Wachtwoord, SchoolID, DocentPerms, EindDatum FROM user INNER JOIN abonnement  ON user.userID = `abonnement`.userID WHERE Email = ?';
                                    if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                                        mysqli_stmt_bind_param($stmt, 's', $username);
                                        mysqli_stmt_execute($stmt);
                                        mysqli_stmt_bind_result($stmt, $userId, $hash, $schoolid, $docentperms, $abonnement);
                                        mysqli_stmt_store_result($stmt);
                                        mysqli_stmt_fetch($stmt);
                                        if (strtotime($abonnement) < time()) {
                                            echo 'Subscription has expired <br>';
                                            echo $abonnement;
                                        } else {
                                            if (mysqli_stmt_num_rows($stmt) > 0) {
                                                if (password_verify($postpw, $hash)) {
                                                    $_SESSION['loggedin'] = true;
                                                    $_SESSION['username'] = $username;
                                                    $_SESSION['userId'] = $userId;
                                                    $_SESSION['docent'] = $docentperms;
                                                    $_SESSION['schoolid'] = $schoolid;
                                                    echo 'Subscription has been approved <br>';
                                                    echo $abonnement;
                                                    echo '<br>';
                                                    header("Location: index.php");
                                                } else {
                                                    echo 'Login info incorrect';
                                                }
                                            } else {
                                                echo 'Login info incorrect';
                                            }
                                        }
                                        mysqli_stmt_close($stmt);
                                        mysqli_close($conn);
                                    } else {
                                        echo 'Prepare failed';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
