<!DOCTYPE html>
<html lang="en">

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
        <!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet">
		<title>I Learn Flix</title>
    </head>

    <body class="bcolor">
        <?php
        include('conn.php');
        include('sidebar.php');
        ?>
        <div class="container-fluid">
            <div class="row d-flex d-md-block flex-nowrap wrapper">
                <div class="col-md-10 col-sm-11 col-xs-11 float-left pl-0 pr-0">
                    <div class="videos">
                        <div class="vak">
                            <?php
                            $SQLstring = "
                            SELECT video.Vak
                            FROM video
                            INNER JOIN favorieten
                            ON favorieten.vak = video.vak
                            WHERE favorieten.userID = " . $_SESSION['userId'] . "
                            GROUP BY video.Vak";
                            if ($statement = mysqli_prepare($conn, $SQLstring)) {
                                if (mysqli_stmt_execute($statement) === TRUE) {
                                    mysqli_stmt_bind_result($statement, $vak);
                                    mysqli_stmt_store_result($statement);
                                    $vaktitel = ucfirst($vak);
                                    if (mysqli_stmt_num_rows($statement) == 0) {
                                      echo '<br><br><h3> Klik op de homepagina op \'favoriet\' om een vak toe te voegen aan favorieten</h3>';
                                    } else {
                                        while (mysqli_stmt_fetch($statement)) {
                                            echo "<div class='vakHeader'>
                                                    <a href='videolijst.php?vak=" . $vak . "'><h2 class='vakTitel'>" . $vak . "</h2></a>
                                                    <a class='vakTitel' href='addfav.php?vak=" . $vak . "&cat=del'><h7>verwijder favoriet</h7></a>
                                                </div>";
                                            echo $vaktitel;
                                            $query = "SELECT Locatie, Titel, Email, VideoID FROM video JOIN user ON video.userID = user.userID WHERE vak = '{$vak}' GROUP BY vak ORDER BY VideoID DESC";
                                            if ($stmt = mysqli_prepare($conn, $query)) {
                                                if (mysqli_stmt_execute($stmt) === TRUE) {
                                                    mysqli_stmt_bind_result($stmt, $locatie, $titel, $user, $videoId);
                                                    mysqli_stmt_store_result($stmt);
                                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                                    } else {
                                                        while (mysqli_stmt_fetch($stmt)) {
                                                            $shortTitle = mb_strimwidth($titel, 0, 30, '...');
                                                            echo "<div class='videobox'>
                                                                <div class='video'>
                                                                    <video controls>
                                                                    <source src=" . $locatie . " type='video/mp4'>
                                                                    </video>
                                                                </div>
                                                                <div class='videoInfo'>
                                                                    <h4 class='titel'>" . $shortTitle . "</h4>
                                                                </div>
                                                                </div>";
                                                        }
                                                    }
                                                    mysqli_stmt_close($stmt);
                                                } else {
                                                    echo "Er ging iets fout";
                                                }
                                            } else {
                                                echo "Er ging iets fout";
                                            }
                                        }
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
</html>
