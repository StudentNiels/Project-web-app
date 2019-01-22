<html>
    <head>
        <title>MijnFlix</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sideBar.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <div class="container-fluid">
        <div class="row d-flex d-md-block flex-nowrap wrapper">
            <div class="col-md-2 col-sm-1 float-left col-1 pl-0 pr-0 collapse width show logobg"  id="sidebar">
                <a><img class="img-fluid" id="logo" src="images/logoB-01.svg"></a>
                <div class="list-group border-0 card text-center text-md-left">
                    <a href="#" class="list-group-item d-inline-block collapsed" data-toggle="collapse" aria-expanded="false"><i class="fa fa-home"></i> <span class="d-none d-md-inline">Home</span></a>
                    <a href="#" class="list-group-item d-inline-block collapsed"><i class="fa fa-film"></i> <span class="d-none d-md-inline">MijnFlix</span></a>
                    <a href="#" class="list-group-item d-inline-block collapsed" data-toggle="collapse" aria-expanded="false"><i class="fa fa-star"></i> <span class="d-none d-md-inline">Favorieten </span></a>
                    <a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-registered"></i> <span class="d-none d-md-inline">Registreren</span></a>

                    <!--<div class="list-group border-0 card text-center text-md-left">-->
                    <div class="row socialbar d-sm-none d-md-block">
                        <!--<a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="col-auto fab fa-facebook sicons"></i><i class="col-md-2 col-lg-4 fab fa-twitter sicons"></i> <i class="col-md-4 col-lg-4 fab fa-instagram sicons"></i> <span class="d-none d-md-inline"></span></a>-->
                        <a href="https://www.facebook.com" target="_BLANK" class="list-group-item d-inline-block collapsed sicons" data-parent="#sidebar"><i class="col-12 fab fa-facebook"></i><span class="d-none d-lg-inline"></span></a>
                        <a href="https://www.twitter.com" target="_BLANK" class="list-group-item d-inline-block collapsed sicons" data-parent="#sidebar"><i class="col-12 fab fa-twitter"></i><span class="d-none d-lg-inline"></span></a>
                        <a href="https://www.instagram.com" target="_BLANK" class="list-group-item d-inline-block collapsed sicons" data-parent="#sidebar"><i class="col-12 fab fa-instagram"></i><span class="d-none d-lg-inline"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>         <div class="vak">
    </head>
    <body>
        <?php
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        print_r($_POST);
        echo '<pre>';
        session_start();
        include('conn.php');
        echo"<h2>MijnFlix</h2>";
        Print_r($_SESSION);
        $query = "SELECT Email, SchoolNaam, AbonnementID, Wachtwoord, DocentPerms FROM user, school  WHERE user.userId = " . $_SESSION['userId'] . " AND user.SchoolID = school.SchoolID;";

        if ($stmt1 = mysqli_prepare($conn, $query)) {
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1, $Email, $SchoolNaam, $AbonnementID, $Wachtwoord, $DocentPerms);
            mysqli_stmt_store_result($stmt1);
            if (mysqli_stmt_num_rows($stmt1) == 0) {
                echo "nothing found";
            } else {
                echo"<form method='POST'>";
                echo "<p>Your profile</p>";
                echo"<p>" . $_SESSION['username'] . "</p>";
                echo"<p>AbonnementID</p>";
                echo"<p>Wachtwoord wijzigen <a href=mijnFlix.php>edit</a></p>";
                while (mysqli_stmt_fetch($stmt1)) {
                    echo $SchoolNaam;
                }
                if ($_SESSION['docent'] = 1) {
                    echo"<p>Leraar Privileges toegekend <img src='images/approved.png' alt='goedgekeurd' height='90px' width='105'></p>";
                }
                echo"</form>";
                echo"<p><a href='index.php'>Terug</a></p>";

                if ($_SESSION['docent'] === 1) {
                    echo "<p><a href=uploadvideo.php>Upload a video</a></p>";
                } else {
                    echo"Indien u een leraar bent en u graag een video wil uploaden contacteer dan de administratie via admin@email.com";
                }
                $conn = mysqli_connect("localhost", "root", "");

                mysqli_stmt_close($stmt1);
            }
            mysqli_close($conn);
        }
        echo '</pre>';
        ?>





    </body>
</html>

