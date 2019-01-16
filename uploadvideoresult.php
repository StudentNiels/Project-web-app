<!doctype html>
<html>
    <head>
        <style>
            h1{
                font-size: 30px;
            }
        </style>  
        <?php
        include('conn.php');

        if (isset($_POST['but_upload'])) {
            $maxsize = 5242880000;

            $name = $_FILES['file']['name'];
            $titel = $_POST['Titel_entered'];
            $vak = $_POST['video'];
            $target_dir = "videos/";
            $target_file = $target_dir . $_FILES["file"]["name"];

            // Select file type
            $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

            // Check extension
            if (in_array($videoFileType, $extensions_arr)) {

                // Check file size
                if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
                    echo "File too large";
                } else {
                    // Upload
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                        // Insert record
                        $query = "INSERT INTO video(Titel, Vak, Locatie) VALUES('" . $titel . "','" . $vak . "','" . $target_file . "')";

                        mysqli_query($conn, $query);
                        echo "<h1>Upload successfully.<h1>";
                    }
                }
            } else {
                echo "Invalid file extension.";
            }
        }
        ?>
    </head>
    <body>
        <h1><a href="uploadvideo.php">Upload er nog één!</a></h1>
    </body>
</html>