<!DOCTYPE html>
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
    <!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">
        <div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width show" id="sidebar">
            <a><img class="img-fluid" id="logo" src="images/logoB-01.svg"></a>
                <div class="list-group border-0 card text-center text-md-left">
                    
                    <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" aria-expanded="false"><i class="fa fa-home"></i> <span class="d-none d-md-inline">Home</span></a>
                    <div class="collapse" id="menu1" data-parent="#sidebar">
                    </div>
                    <a href="#" class="list-group-item d-inline-block collapsed"><i class="fa fa-film"></i> <span class="d-none d-md-inline">MijnFlix</span></a>
                    <a href="#menu3" class="list-group-item d-inline-block collapsed" data-toggle="collapse" aria-expanded="false"><i class="fa fa-star"></i> <span class="d-none d-md-inline">Favorieten </span></a>
                    <a href="registratie.php" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-registered"></i> <span class="d-none d-md-inline">Registreren</span></a>
                    <a href="inlog.php" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fas fa-sign-in-alt"></i> <span class="d-none d-md-inline">Inloggen</span></a>
                </div>
        </div>
    </div>
    <a href="#" data-target="#sidebar" data-toggle="collapse"><i class="fa fa-bars fa-2x py-2 p-1"></i></a>
</div>
  <div class='container'>
      <h5> login </h5>
      <form method="post" action='index.php'>
        <p>
          <input type='text' name='login_username' placeholder="username">
        </p>
        <p>
          <input type='password' name='login_password' placeholder="password">
        </p>
        <p>
          <input type='submit' value='verzenden' name='login_submit' class="">
        </p>
      </form>

      <?php
      include('conn.php');
      if(isset($_GET['reg'])){
        echo 'registratie succesvol';
      }

      if(isset($_POST['login_submit'])){
        if(!empty($_POST['login_username']) && !empty($_POST['login_password'])){
          $TableName = 'hboStudent';
          $username = $_POST["login_username"];
          $postpw = $_POST['login_password'];

          $SQLstring = 'SELECT Wachtwoord FROM ' . $TableName . ' WHERE StudentEmail = ?';
          if ($stmt = mysqli_prepare($conn, $SQLstring)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $hash);
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_fetch($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
              if(password_verify($postpw,$hash)){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("Location: index.php");
              }else{
                print_r($postpw);
              }
            }else{
              echo 'how is eem';
            }
          }else{
            printf('query gaat fout');
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
        }
      }
      ?>
    </div>
  </div>
</body>
