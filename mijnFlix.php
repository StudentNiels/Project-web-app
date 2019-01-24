<html>
    <head>
        <title>MijnFlix</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sideBar.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    </head>
    <body class="bcolor">

        <?php
        include('conn.php');
        include('sidebar.php');
        echo"<div id='mijnflix'><h1>MijnFlix</h1>";
        $query = "SELECT Email, SchoolNaam, AbonnementID, Wachtwoord, DocentPerms FROM user, school  WHERE user.userId = " . $_SESSION['userId'] . " AND user.SchoolID = school.SchoolID;";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $Email, $SchoolNaam, $AbonnementID, $Wachtwoord, $DocentPerms);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_fetch($stmt);
            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "nothing found";
            } else {
                echo "<div class='container-fluid'>";
                echo "<h3>Your profile</h3>";
                echo "<table>";
                echo "<tr><th>Username/Email</th></tr>";
                echo"<tr><td><p>" . $Email . "</p></td></tr>";

                echo "<tr><th>Wachtwoord of Email wijzigen</th></tr>";
                echo"<tr><td><p><a href=pwchange.php>Klik hier</a></p></td></tr>";

                echo "<tr><th>School</th></tr>";
                echo "<tr><td><p>" . $SchoolNaam . "</p></td></tr>";
                if ($_SESSION['docent'] === 1) {
                    echo "<tr><th>Privileges</th></tr>";
                    echo"<td><p>Leraar Privileges toegekend </p></td></tr>";
                }
                echo "</table>";
                echo "</div>";
                echo"<p><a href='index.php'>Terug</a></p>";

                if ($_SESSION['docent'] === 1) {
                    echo "<p><a href=uploadvideo.php>Upload een video</a></p>";
                    echo "<p><a href=videobeheer.php>Beheer je video's</a></p></div>";
                } else {
                    echo"Indien u een leraar bent en u graag een video wilt uploaden contacteer dan de administratie via admin@email.com</div>";
                }
                $conn = mysqli_connect("localhost", "root", "");

                mysqli_stmt_close($stmt);
            }
            mysqli_close($conn);
        }
        ?>





    </body>
</html>

