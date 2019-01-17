<?php
include('conn.php');
?>
<!DOCTYPE html>
<html>
    <body>
        <?php
        session_start();
        if ($_SESSION['loggedin'] == True) {
            $docentPerms = $_SESSION['docent'];
            if ($docentPerms === 1) {
                echo '<form method="post" action="uploadvideo.php" enctype="multipart/form-data">
                        <p>Enter het vak: 
                            <select name="vak">
                                <option value="php">PHP</option>
                                <option value="html/css">HTML/CSS</option>
                                <option value="databases">Databases</option>
                                <option value="overige">Overige</option>
                            </select></p>
                        <p>Enter de titel: <input type="text" name="Titel_entered"/></p>
                        <input type="file" name="file" accept=".mp4"/>
                        <p><input type="submit" value="Upload" name="but_upload"></p>
                        </form>';

                if (isset($_POST['but_upload'])) {
                    if (empty($_POST['Titel_entered']) || empty($_POST['vak'])) {
                        echo "<p>Vul alle velden in</p>";
                    } else {
                        if (isset($_POST['but_upload'])) {
                            $userID = $_SESSION['userId'];
                            $name = $_FILES['file']['name'];
                            $titel = $_POST['Titel_entered'];
                            $vak = $_POST['vak'];

                            $target_location = "videos/" . $titel . ".mp4";
                            if (($_FILES['file']['size'] === 0)) {
                                echo "Kies een video om up te loaden!";
                            } else {
                                // Upload
                                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_location)) {
                                    // Insert record
                                    $query = "INSERT INTO video(UserID, Titel, Vak, Locatie) VALUES( ?, ?, ?, ?)";
                                    if ($stmt = mysqli_prepare($conn, $query)) {
                                        mysqli_stmt_bind_param($stmt, 'isss', $userID, $titel, $vak, $target_location);
                                        $QueryResult = mysqli_stmt_execute($stmt);
                                        if ($QueryResult === FALSE) {
                                            echo "<p>Unable to execute the query.</p>"
                                            . "<p>Error code "
                                            . mysqli_errno($DBConnect)
                                            . ": "
                                            . mysqli_error($DBConnect)
                                            . "</p>";
                                        } else {
                                            echo "<h1>Upload successfully.<h1>";
                                        }
                                    }
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