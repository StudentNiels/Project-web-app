<?php
include('conn.php');
include ('sidebar.php');
?>
<!DOCTYPE html>
<html>
    <body>
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
                                <option value="Overige">Overige</option>
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
                            $titelopslag = str_replace(' ', '', $titel);
                            $titelopslag1 = str_replace('.', '', $titelopslag);
                            $titelopslag2 = str_replace('/', '', $titelopslag1);
                            $target_location = "videos/" . $titelopslag2 . ".mp4";
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
                                            . mysqli_errno($conn)
                                            . ": "
                                            . mysqli_error($conn)
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