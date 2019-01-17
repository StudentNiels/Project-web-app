<?php
session_start();
include('conn.php');
?>
<!DOCTYPE html>
<html>
    <body>
        <?php
        if ($_SESSION['loggedin'] == True) {
            if ($_SESSION['docent'] === 1) {
                echo '<form method="post" action="uploadvideo.php" enctype="multipart/form-data">
            <p>Enter het vak: 
                <select name="vak">
                    <option value="php">PHP</option>
                    <option value="html/css">HTML/CSS</option>
                    <option value="databases">Databases</option>
                    <option value="overige">Overige</option>
                </select></p>
            <p>Enter de titel: <input type="text" name="Titel_entered"/></p>
            <input type="file" name"file" accept=".mp4, .avi, .3gp, .mov, .mpeg"/>
            <p><input type="submit" value="Upload" name="but_upload"></p>
            </form>';

                if (isset($_POST['but_upload'])) {
                    if (empty($_POST['Titel_entered']) || empty($_POST['vak'])) {
                        echo "<p>Vul alle velden in</p>";
                    } else {
                        if (isset($_POST['but_upload'])) {
                            $maxsize = 5242880000;
                            $userID = $_SESSION['userID'];
                            $name = $_FILES['file']['name'];
                            $titel = $_POST['Titel_entered'];
                            $vak = $_POST['vak'];
                            $target_dir = "videos/";
                            $target_file = $target_dir . $titel . ".mp4";
                            if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                                echo "File too large";
                            } else {
                                // Upload
                                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                                    // Insert record
                                    $query = "INSERT INTO video(UserID, Titel, Vak, Locatie) VALUES(" . $userID . "'" . $titel . "','" . $vak . "','" . $target_file . "')";

                                    mysqli_query($conn, $query);
                                    echo "<h1>Upload successfully.<h1>";
                                }
                            }
                        }
                    }
                }
            } else {
                echo "<p>U heeft niet de juiste rechten om deze functie te gebruiken</p>";
            } 
            mysqli_close($DBConnect);
        } else {
            header('location: login.php');
        }
        ?>

    </body>
</html>