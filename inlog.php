<!DOCTYPE html>
<html>
<head>
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
  <div class="background">
  <div class="container">
      <div class="row justify-content-center">      
          <div class="col-sm-12 col-md-9 col-lg-7 mt-auto">
		  <div class="pic-center">
		   <a><img class="img-fluid"  id="logo" src="images/logoB-01.svg"></a>
		  
		  </div>
              <div class="text-center col-6 mx-auto">
                    
              

      <h5> login </h5>
      <form method="post">
        <p>
		 <div class="form-group">
          <input class="form-control" type='text' name='login_username' placeholder="username">
        </div>
		</p>
        <p>
		 <div class="form-group">
          <input class="form-control" type='password' name='login_password' placeholder="password">
        </div>
		</p>
        <p>
		 <div class="form-group">
          <input class="form-control" type='submit' value='Login' name='login_submit' class="">
        </div>
		</p>
      </form>

    <?php
    include('conn.php');
    if(isset($_GET['reg'])){
      echo 'registratie succesvol';
    }

    if(isset($_POST['login_submit'])){
      if(!empty($_POST['login_username']) && !empty($_POST['login_password'])){
        $TableName = 'user';
        $username = $_POST["login_username"];
        $postpw = $_POST['login_password'];

        $SQLstring = 'SELECT userId, Wachtwoord, DocentPerms FROM ' . $TableName . ' WHERE Email = ?';
        if ($stmt = mysqli_prepare($conn, $SQLstring)) {
          mysqli_stmt_bind_param($stmt, 's', $username);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt, $userId, $hash, $docentperms);
          mysqli_stmt_store_result($stmt);
          mysqli_stmt_fetch($stmt);
          if (mysqli_stmt_num_rows($stmt) > 0) {
            if(password_verify($postpw,$hash)){
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $username;
              $_SESSION['userId'] = $userId;
              $_SESSION['docent'] = $docentperms;
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
      }else{
        echo 'vul alle velden in';
      }
    }
    ?>
  </div>
          </div>
        
      </div>
  </div>
</div>
</body>
