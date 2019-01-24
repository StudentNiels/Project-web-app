<?php
include('conn.php');
include ('sidebar.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sideBar.css" rel="stylesheet">
        <link href="css/videoshow.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
        <title>I Learn Flix</title>
    </head>
    <body class="bcolor">
        <?php
        if ($_SESSION['loggedin'] == True) {
            $docentPerms = $_SESSION['docent'];
            if ($docentPerms === 1) {
                echo '<form method="post" action="uploadvideo.php" enctype="multipart/form-data">
                        <p>Enter het vak: 
                            <select name="vak">
                                <option value="PHP">PHP</option>
                                <option value="HTML/CSS">HTML/CSS</option>
                                <option value="Databases">Databases</option>
                            </select></p>
                        <p>Enter de titel: <input type="text" name="Titel_entered"/></p>
                        <p>Kies de taal waarin je wilt uploaden: <input type="radio" name="taal" value="(NL)"> Nederlands
                        <input type="radio" name="taal" value="(EN)"> Engels</p>
                        <input type="file" name="file" accept=".mp4"/>
                        <p><input type="submit" value="Upload" name="but_upload"></p>
                        </form>';

                if (isset($_POST['but_upload'])) {
                    if (empty($_POST['Titel_entered']) || empty($_POST['vak'])) {
                        echo "<p>Vul alle velden in</p>";
                    } else {
                        if (isset($_POST['but_upload'])) {
                            $taal = $_POST['taal'];
                            $userID = $_SESSION['userId'];
                            $name = $_FILES['file']['name'];
                            $titel = $taal . " " . $_POST['Titel_entered'];
                            $vak = $_POST['vak'];
                            $titelopslag = str_replace(' ', '', $titel);
                            $titelopslag1 = str_replace('.', '', $titelopslag);
                            $titelopslag2 = str_replace('/', '', $titelopslag1);
                            $target_location = "videos/" . $titelopslag2 . ".mp4";
                            if (($_FILES['file']['size'] === 0)) {
                                echo "Kies een video om up te loaden!";
                            } else {
                                $SQLString = "SELECT videoId FROM video WHERE titel = '{$titel}'";
                                if ($r = mysqli_prepare($conn, $SQLString)) {
                                    if (mysqli_stmt_execute($r)) {
                                        mysqli_stmt_bind_result($r, $id);
                                        mysqli_stmt_store_result($r);
                                        mysqli_stmt_fetch($r);
                                        if (mysqli_stmt_num_rows($r) === 0) {
                                            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_location)) {
                                                // Insert record
                                                $query = "INSERT INTO video(UserID, Titel, Vak, Locatie) VALUES( ?, ?, ?, ?)";
                                                if ($stmt = mysqli_prepare($conn, $query)) {
                                                    mysqli_stmt_bind_param($stmt, 'isss', $userID, $titel, $vak, $target_location);
                                                    $QueryResult = mysqli_stmt_execute($stmt);
                                                    if ($QueryResult === FALSE) {
                                                        echo "<p>Unable to execute the query.</p>"
                                                        . "<p>Error code "
                                                        . mysqli_errno($conn)
                                                        . ": "
                                                        . mysqli_error($conn)
                                                        . "</p>";
                                                    } else {
                                                        echo "<h1>Upload successfully.<h1>";
                                                    }
                                                } else {
                                                    echo "could not prepare statment";
                                                }
                                            } else {
                                                echo "<p>kan deze video niet uploaden.</p>";
                                            }
                                        } else {
                                            echo "<p>Er bestaat al een video met deze titel, kies alstublieft een andere titel voor uw video.</p>";
                                        }
                                    }
                                } else {
                                    echo "failed to prepare statment";
                                }
                            }
                        }
                    }
                }
            } else {
                echo "<p>U heeft niet de juiste rechten om deze functie te gebruiken</p>";
            } 
        } else {
            header('location: inlog.php');
        }
        ?>
    </body>
</html>