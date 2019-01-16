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
</head>
<body>
  <div class='container'>
    <h5> login </h5>
    <form method="post">
      <p>
        <input type='text' name='login_username' placeholder="email">
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
        $TableName = 'user';
        $username = $_POST["login_username"];
        $postpw = $_POST['login_password'];

        $SQLstring = 'SELECT userId, Wachtwoord FROM ' . $TableName . ' WHERE Email = ?';
        if ($stmt = mysqli_prepare($conn, $SQLstring)) {
          mysqli_stmt_bind_param($stmt, 's', $username);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt, $userId, $hash);
          mysqli_stmt_store_result($stmt);
          mysqli_stmt_fetch($stmt);
          if (mysqli_stmt_num_rows($stmt) > 0) {
            if(password_verify($postpw,$hash)){
              session_start();
              $_SESSION['loggedin'] = true;
              $_SESSION['username'] = $username;
              $_SESSION['docent'] = 'test';
              $_SESSION['userId'] = $$userId;
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
</body>
