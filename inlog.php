<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/index.css"  />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
                        <div class="text-center col-6 mx-auto">



                            <h3>Login</h3>
                            <form method="post">
                                <p>
                                <div class="form-group">
                                    <input class="form-control" type='text' name='login_username' placeholder="Enter your Username">
                                </div>
                                </p>
                                <p>
                                <div class="form-group">
                                    <input class="form-control" type='password' name='login_password' placeholder="Password">
                                </div>
                                </p>
                                <p>
                                <div class="form-group">
                                    <input class="form-control" type='submit' value='Login' name='login_submit' class="">
                                </div>
                                </p>
                                <p>
                                    <a href='registratie.php'> Heb je nog geen account? klik hier </a>
                                </p>
                            </form>

                            <?php
                            session_start();
                            if (isset($_SESSION['loggedin'])) {
                                header('Location: index.php');
                            }


                            include('conn.php');
                            if (isset($_GET['reg'])) {
                                echo 'registratie succesvol';
                            } elseif (isset($_GET['log'])) {
                                echo 'Log in voordat je verder gaat!';
                            }



                            if (isset($_POST['login_submit'])) {
                                // checks
                                if (empty($_POST['login_username'])) {
                                    echo 'vul een email in';
                                } elseif (empty($_POST['login_password'])) {
                                    echo 'vul een wachtword in';
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
                                        if (strtotime($abonnement) > time()) {
                                            echo 'Abonnement is verlopen';
                                        } else {
                                            if (mysqli_stmt_num_rows($stmt) > 0) {
                                                if (password_verify($postpw, $hash)) {
                                                    $_SESSION['loggedin'] = true;
                                                    $_SESSION['username'] = $username;
                                                    $_SESSION['userId'] = $userId;
                                                    $_SESSION['docent'] = $docentperms;
                                                    $_SESSION['schoolid'] = $schoolid;

                                                    // header("Location: index.php");
                                                } else {
                                                    // print_r($postpw);
                                                }
                                            } else {
                                                echo 'Inlog mislukt';
                                            }
                                        }
                                    } else {
                                        echo 'prepare mislukt';
                                    }
                                }
                                mysqli_stmt_close($stmt);
                                mysqli_close($conn);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
