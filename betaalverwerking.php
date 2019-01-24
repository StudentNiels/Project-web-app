

<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="styletest.css" rel="stylesheet">
    </head>
    <body>
        <div class="background">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-9 col-lg-7 mt-auto">
                        <div class="pic-center">
                            <a><img class="img-fluid"  id="logo" src="images/logoB-01.svg"></a>

                        </div>
                        <hr>
                        <div class="text-center mx-auto">
                            <?php
                            session_start();
                            include 'conn.php';
                            $_SESSION['betaald'] = '1';
                            $userid_query = 'SELECT UserID FROM user WHERE Email = ?';
                           if($id_stmt = mysqli_prepare($conn, $userid_query)){
                             mysqli_stmt_bind_param($id_stmt, 's', $_SESSION['temp_betaling']);
                             if(mysqli_stmt_execute($id_stmt)){
                               mysqli_stmt_store_result($id_stmt);
                               mysqli_stmt_bind_result($id_stmt, $userid);
                               mysqli_stmt_fetch($id_stmt);
                             } else {
                                 echo "Something went wrong.";
                             }
                             if($betaald == 1){
                                 $sql = "INSERT INTO abonnement (UserID, BetaalDatum, EindDatum) VALUES( ? , CURDATE(), curdate() + INTERVAL 1 YEAR)";
                                 if($stmt = mysqli_prepare($conn, $sql)){
                                   $param_userid = $userid;
                                     mysqli_stmt_bind_param($stmt, "i", $param_userid);
                                     if(mysqli_stmt_execute($stmt)){

                                     } else {
                                         echo "Something went wrong.";
                                     }
                                 }
                             }
                                }
                            </script>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
