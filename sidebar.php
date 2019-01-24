<!DOCTYPE html>
<?php
include('logcheck.php');
?>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sideBar.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <title>I Learn Flix</title>
    </head>

    <div class="container-fluid">
        <div class="row d-flex d-md-block flex-nowrap wrapper">
            <div class="col-md-2 col-sm-3 col-lg-3 float-left col-3 pl-0 pr-0 collapse width show logobg"  id="sidebar">
                <a href="index.php"><img class="img-fluid" id="logo" src="images/logoB-01.svg"></a>
                <div class="list-group border-0 card text-center text-md-left">
                    <a href="index.php" class="list-group-item d-inline-block collapsed uwu"><i class="fa fa-home"></i> <span class="d-none d-md-inline">Home</span></a>
                    <a href="mijnFlix.php" class="list-group-item d-inline-block collapsed uwu"><i class="fa fa-film"></i> <span class="d-none d-md-inline">MijnFlix</span></a>
                    <a href="loguit.php" class="list-group-item d-inline-block collapsed uwu" data-parent="#sidebar"><i class="fas fa-sign-out-alt"></i> <span class="d-none d-md-inline">Uitloggen</span></a>
                    <form method="post" action="search.php">
                        <div class="form-group list-group-item d-inline-block collapsed">
                            <input class="form-control" type="text" name="searchstr" placeholder="" required>
                        </div>
                        <div class="form-group list-group-item d-inline-block collapsed">
                            <input class="form-control" type="submit" name="search" value="Search">
                        </div>
                    </form>
                    <!--<div class="list-group border-0 card text-center text-md-left">-->
                    <div class="row socialbar d-sm-none d-md-block">
                        <div class="col-sm-12 col-md-12 col-lg-12 offset-sm-1">
                         <!--<a href="#" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="col-auto fab fa-facebook sicons"></i><i class="col-md-2 col-lg-4 fab fa-twitter sicons"></i> <i class="col-md-4 col-lg-4 fab fa-instagram sicons"></i> <span class="d-none d-md-inline"></span></a>-->
                            <a href="https://www.facebook.com" target="_BLANK" class="list-group-item d-inline-block collapsed sicons" data-parent="#sidebar"><i class="col-12 fab fa-facebook"></i><span class="d-none d-lg-inline"></span></a>
                            <a href="https://www.twitter.com" target="_BLANK" class="list-group-item d-inline-block collapsed sicons" data-parent="#sidebar"><i class="col-12 fab fa-twitter"></i><span class="d-none d-lg-inline"></span></a>
                            <a href="https://www.instagram.com" target="_BLANK" class="list-group-item d-inline-block collapsed sicons" data-parent="#sidebar"><i class="col-12 fab fa-instagram"></i><span class="d-none d-lg-inline"></span></a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>
