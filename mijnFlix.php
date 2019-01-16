<html>
    <head>
        <title>MijnFlix</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    </head>
    <body>

        <?php
        session_start();
        $DBConnect = mysqli_connect("localhost", "root", "");
        if ($DBConnect === FALSE) {
            echo "<p>Unable to connect to the database server.</p>"
            . "<p>Error code " . mysqli_errno() . ": " . mysqli_error()
            . "</p>";
        } else {
            if (isset($_SESSION['user'])) {

                $DBName = "ilearnflix";
                if (!mysqli_select_db($DBConnect, $DBName)) {
                    echo "<p>error no  data found</p>";
                } else {
                    $TableName = "user";
                    $stmt1 = "SELECT userID, Email, SchoolID, AbonnementID, Wachtwoord, DocentPerms FROM " . $TableName;
                    if ($stmt2 = mysqli_prepare($DBConnect, $stmt1)) {
                        mysqli_stmt_execute($stmt2);

                        mysqli_stmt_bind_result($stmt2, $userID, $Email, $SchoolID, $AbonnementID, $Wachtwoord, $DocentPerms);
                        mysqli_stmt_store_result($stmt2);

                        if (mysqli_stmt_num_rows($stmt2) == 0) {
                            echo "<p>no data found for this profile,contact your administration</p>";
                        } else {
                            echo "<p>Your profile</p>";
                            echo "<table width='100%' border='1'>";
                            echo "<tr><th>Nr.</th><th>ProductName</th><th>Version</th><th>Hardware type</th><th>Operating System</th><th>Frequency</th><th>Proposed solution</th></tr>";
                            while (mysqli_stmt_fetch($stmt2)) {
                                echo "<tr>";
                                echo "<td>" . $userID . "</td>";
                                echo "<td>" . $Email . "</td>";
                                echo "<td>" . $SchoolID . "</td>";
                                echo "<td>" . $AbonnementID . "</td>";
                                echo "<td>" . $Wachtwoord . "</td>";
                                echo "<td>" . $DocentPerms . "</td>";
                                echo "<td><p><input name='mijnFlix.php' type='submit'></p></td>";
                                echo "</form></tr>";
                            }
                            echo "<p><a href=inlog.php>Add a new bug here</a></p>";
                            
                        }
                        
                    }
                    mysqli_stmt_close($stmt2);
                }
                mysqli_close($DBConnect);
            }
        }
        echo '</pre>';
        ?>

        <h2>Jouw profiel</h2> 

        <?php
        echo"<form method='POST'>";

        echo"<p>userID</p>";

        echo"<p>Email</p>";

        echo"<p>SchoolID</p>";


        echo"<p>AbonnementID</p>";


        echo"<p>Wachtwoord wijzigen</p>";


        echo"<p>DocentPerms yes or no</p>";


        echo"<p><input type='submit' value='Submit' /></p>";
        echo"</form>";
        echo"<p><a href='index.php'>Terug</a></p>";
        
        if ($_SESSION['docent'] === 1) {
                                echo "<p><a href=uploadvideo.php>Upload a video</a></p>";
                            } else {
                                echo"Indien u een leraar bent en u graag eene video wil uploaden contacteer dan de administratie via admin@email.com";
                            }
        ?>



    </body>
</html>

