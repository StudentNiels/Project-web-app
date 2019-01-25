<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/bootstrap.min.css" rel="stylesheet">


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
                <div class="col-md-12 col-sm-12 col-xs-12 col-1 pl-0 pr-0">
                    <div class="videos">
                        <div class="vak">
                            <!-- Search form -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 mx-auto">
                                        <form class="form-inline" method="POST" action="searchpage.php">
                                            <i class="fas fa-search" aria-hidden="true"></i>
                                            <p><br>
                                                <input class="form-control form-control-sm ml-3 w-100" type="text" name="searchstr" placeholder="Search"  aria-label="Search">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                            if (!empty($_POST['searchstr'])) {
                                $searchstr = htmlentities($_POST['searchstr']);
                                $searchArray = explode(" ", $searchstr);
                                $query = "";
                                foreach ($searchArray as $val) {
                                    $search = mysqli_real_escape_string($conn, trim($val));
                                    if (!empty($query)) {
                                        $query = $query . " OR "; // or AND, depends on what you want
                                    }

                                    $query = $query . "`titel` LIKE '%$search%'";
                                }

                                if (!empty($query)) {
                                    $sql = "SELECT Locatie, Titel, Email FROM video JOIN user ON video.userID = user.userID WHERE " . $query . " ORDER BY VideoID DESC";
                                    if ($stmt = mysqli_prepare($conn, $sql)) {
                                        if (mysqli_stmt_execute($stmt)) {
                                            mysqli_stmt_bind_result($stmt, $locatie, $titel, $user);
                                            mysqli_stmt_store_result($stmt);
                                        } if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<div class='vakHeader'>
                                                    <h2 class='vakTitel'>Geen Resultaten</h2>
                                                </div>";
                                        } else {
                                            echo "<div class='vakHeader'>
                                                    <h2 class='vakTitel'>Resultaten</h2>
                                                </div>";
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo "<div class='videobox'>
                                                                <div class='video'>
                                                                    <video controls>
                                                                    <source src=" . $locatie . " type='video/mp4'>
                                                                    </video>
                                                                </div>
                                                                <div class='videoInfo'>
                                                                    <h4 class='titel'>" . $titel . "</h4>
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
                            ?>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
