<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//SELECT CATEGORIE
function SelectProfiel() {
mysqli_select_db($conn, "ilearnflix");
            
            //Get all mesages in the database
            $query = "SELECT msgId, userId, message
                     FROM nhl_stenden_messages";
            
            if($statement = mysqli_prepare($conn, $query))
            {
                //execute select query
               if(mysqli_stmt_execute($statement)) 
               {
               echo"Our latest messages...";
               }
               else {
               die (mysqli_error($connect));
               }

               mysqli_stmt_bind_result($statement, $msgId, $userId, $message);
               //buffer the result if you want to display the data
               mysqli_stmt_store_result($statement);

               //are there results
               if(mysqli_stmt_num_rows($statement) != 0)
               {
                   echo "Number of rows: " . mysqli_stmt_num_rows($statement);
               //Could make table
                   echo "<table border='1'>";
               //Table header
                   echo "<th style='text-align: left;'>msgId</th><th>userId</th><th>message</th>";
               //fetch up next
                   While (mysqli_stmt_fetch($statement)) {
                       //Create row
                       echo "<tr>";

                       // Create cells
                       echo "<td>" . $msgId . "</td>";
                       echo "<td>" . $userId . "</td>";
                       echo "<td" . $message . "</td";

                       //Close row
                       echo "</tr>";
                   }
                   //Close table
                   echo "</table>";
               }
               else {
                   echo "No messages found";
               }

            //Close the statement and free memory
            mysqli_stmt_close($statement);
            }
            else{   
                die(mysqli_error($connect));
            }
            mysqli_close($connect);
}
            
//NEW FUNCTION
            


?>