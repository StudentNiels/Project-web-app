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
                <div class="col-md-10 col-sm-11 col-xs-11 float-left col-1 pl-0 pr-0">
                    <div class="videos">
                        <div class="vak">
                            <?php
                            $SQLstring = "SELECT Vak FROM video GROUP BY Vak";
                            if ($statement = mysqli_prepare($conn, $SQLstring)) {
                                if (mysqli_stmt_execute($statement) === TRUE) {
                                    mysqli_stmt_bind_result($statement, $vak);
                                    mysqli_stmt_store_result($statement);
                                    $vaktitel = ucfirst($vak);
                                    if (mysqli_stmt_num_rows($statement) == 0) {

                                    } else {
                                        while (mysqli_stmt_fetch($statement)) {
                                            echo "<div class='vakHeader'>
                                                    <a href='videolijst.php?vak=" . $vak . "'><h2 class='vakTitel'>" . $vak . "</h2></a>
                                                    <a href='addfav.php?vak=" . $vak . "&cat=add'><h5>Favoriet</h5></a>
                                                </div>";
                                            echo $vaktitel;
                                            $query = "SELECT Locatie, Titel, Email FROM video JOIN user ON video.userID = user.userID WHERE vak = '{$vak}' ORDER BY VideoID DESC LIMIT 4";
                                            if ($stmt = mysqli_prepare($conn, $query)) {
                                                if (mysqli_stmt_execute($stmt) === TRUE) {
                                                    mysqli_stmt_bind_result($stmt, $locatie, $titel, $user);

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
                                                    echo "execution failed";
                                                }
                                            } else {
                                                echo "Could not prepare the statement";
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
