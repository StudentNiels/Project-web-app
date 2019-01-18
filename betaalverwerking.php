

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
                            $_SESSION['betaald'] = '1';
                            echo '<h1> Bedankt voor de betaling, u word nu omgeleid naar de inlog pagina.</h1>';
                            echo "<meta http-equiv=\"refresh\" content=\"5;url=inlog.php\"/>";
                            $betaald = $_SESSION['betaald'];
                            if($betaald == 1){
                                
                            }
                            ?>
                            <script language="JavaScript">
                                window.onload = function () {

                                    (function () {
                                        var counter = 5;

                                        setInterval(function () {
                                            counter--;
                                            if (counter >= 0) {
                                                span = document.getElementById("count");
                                                span.innerHTML = counter;
                                            }
                                            // Display 'counter' wherever you want to display it.
                                            if (counter === 0) {
                                                clearInterval(counter);
                                            }

                                        }, 1000);

                                    })();

                                }
                            </script>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>

