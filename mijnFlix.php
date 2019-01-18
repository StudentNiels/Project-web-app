<html>
    <head>
        <title>MijnFlix</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/index.css"  />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="styletest.css" rel="stylesheet">
    </head>
    <body>

        <?php
        session_start();
        include('conn.php');
        Print_r($_SESSION);
        $TableName = "user";
        $stmt1 = "SELECT Email, SchoolID, AbonnementID, Wachtwoord, DocentPerms FROM " . $TableName . "WHERE userId = " . $_SESSION['userId'];
        if ($stmt2 = mysqli_prepare($conn, $stmt1)) {
            mysqli_stmt_execute($stmt2);

            mysqli_stmt_bind_result($stmt2, $userID, $Email, $AbonnementID, $Wachtwoord, $DocentPerms);
            mysqli_stmt_store_result($stmt2);

            if (mysqli_stmt_num_rows($stmt2) == 0) {
                echo "<p>Your profile</p>";
                echo "<table width='100%' border='1'>";
                echo "<tr><th>Email</th><th>SchoolID</th><th>AbonnementID</th><th>Wachtwoord</th><th>DocentPerms</th></tr>";
                while (mysqli_stmt_fetch($stmt2)) {
                    echo "<tr>";
                    echo "<td>" . $_SESSION['$Email'] . "</td>";
                    echo "<td>" . $SchoolID . "</td>";
                    echo "<td>" . $AbonnementID . "</td>";
                    echo "<td>" . $Wachtwoord . "</td>";
                    echo "<td>" . $_SESSION['$DocentPerms'] . "</td>";
                    echo "<td><p><input name='mijnFlix.php' type='submit'></p></td>";
                    echo "</form></tr>";
                }
                echo "<p><a href=inlog.php>Add a new bug here</a></p>";
            }
            mysqli_stmt_close($stmt2);
        }
        mysqli_close($conn);


        echo '</pre>';
        ?>

        <h2>Jouw profiel</h2> 

        <?php
        echo"<form method='POST'>";

        echo"<p>" . $_SESSION['username'] . "</p>";

        if (isset($_SESSION['docent'])) {
            echo"<p>" . $_SESSION['docent'] . "</p>";
        }
        echo"<p>AbonnementID</p>";
        echo"<p>Wachtwoord wijzigen <a href=mijnFlix.php>edit</a></p>";
        echo"<p> $_SESSION[$SchoolID] </p>";
        echo"<p><input type='submit' value='Submit' /></p>";
        echo"</form>";
        echo"<p><a href='index.php'>Terug</a></p>";

        if ($_SESSION['docent'] === 1) {
            echo "<p><a href=uploadvideo.php>Upload a video</a></p>";
        } else {
            echo"Indien u een leraar bent en u graag een video wil uploaden contacteer dan de administratie via admin@email.com";
        }
        ?>



    </body>
</html>

