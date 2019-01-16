<html>
    <head>
        <title>MijnFlix</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    </head>
    <body>
        <h2>Kies je kijk plezier!</h2> 
            <?php
        echo"<form method='POST'>";
            echo"<p>KanaalNaam <input type='text' name='ProductName'/></p>";
            
            
            echo"<p>DocentID <input type='text' name='Version'/></p>";
            
            
            echo"<p>SchoolID <input type='text' name='HardwareType'/></p>";
            
            
            echo"<p>StudentEmail <input type='text' name='OperatingSystem'/></p>";
            
            
            echo"<p>VideoID<input type='text' name='FrequencyOccurence'/></p>";
            
            
            echo"<p>AbonnementID <input type='text' name='ProposedSol'/></p>";
            
            
            echo"<p><input type='submit' value='Submit' /></p>";
        echo"</form>"; 
        echo"<p><a href='ShowErrors.php'>Check out our bug collection!</a></p>";
        
        
       
    

$DBConnect = mysqli_connect("localhost", "root", ""); 
if ($DBConnect === FALSE) 
    { 
    echo "<p>Unable to connect to the database server.</p>" 
    . "<p>Error code " . mysqli_errno() . ": " . mysqli_error() 
    . "</p>"; 
    }

else { 
    $DBName = "ilearnflix"; 
    if(!mysqli_select_db ($DBConnect, $DBName))  
            { 
                echo "<p>There are no bugs!</p>";  
            }
    else { 
            $TableName = "bugs"; 
            $SQLstring = "SELECT countID, ProductName, Version, HardwareType, OperatingSystem, FrequencyOccurence, ProposedSol FROM ".$TableName;
            if ($stmt = mysqli_prepare($DBConnect, $SQLstring)) {  
                mysqli_stmt_execute($stmt); 

                mysqli_stmt_bind_result($stmt, $countID, $ProductName, $Version, $HardwareType, $OperatingSystem, $Frequency, $ProposedSol);  
                mysqli_stmt_store_result($stmt); 

                if (mysqli_stmt_num_rows($stmt) == 0) { 
                    echo "<p>There are no bugs!</p>";  
                } 
                else { 
                    echo "<p>Look at all the bugs!</p>";  
                    echo "<table width='100%' border='1'>";  
                    echo "<tr><th>Nr.</th><th>ProductName</th><th>Version</th><th>Hardware type</th><th>Operating System</th><th>Frequency</th><th>Proposed solution</th></tr>";  
                    while (mysqli_stmt_fetch($stmt)) 
                        {
                        echo "<tr><form action=UpdateBug.php?id=" . $countID . " method=post>";
                        echo "<td>".$countID."</td>";   
                        echo "<td>".$ProductName."</td>";   
                        echo "<td>".$Version."</td>";
                        echo "<td>".$HardwareType."</td>";  
                        echo "<td>".$OperatingSystem."</td>";
                        echo "<td>".$Frequency."</td>";  
                        echo "<td>".$ProposedSol."</td>";
                        echo "<td><p><input value=Update type='submit'></p></td>";
                        echo "</form></tr>";  
                        }
                        echo "<p><a href=BugReport.html>Add a new bug here</a></p>";
                        $id = $_GET['id'];
                    }   
                }   
            mysqli_stmt_close($stmt);  
            }  
    mysqli_close($DBConnect); 
         }
           echo '</pre>';
?>
     
    </body>
</html>

<?php

?>
