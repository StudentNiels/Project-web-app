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
    <title>I Learn Flix</title>
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

  <?php
  include('conn.php');
  ?>
  <h3> register </h3>
  <form method="post">
    <p>
      <input type='email' name='reg_email' placeholder="email">
    </p>
    <p>
      <input type='password' name='reg_password' placeholder="password">
    </p>
    <p>
      <?php
      $TableName2 = 'School';
      $SQLstring = "SELECT SchoolId, SchoolNaam FROM " . $TableName2;
      if ($stmt = mysqli_prepare($conn, $SQLstring)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $sId, $sNaam);

        if (mysqli_stmt_num_rows($stmt) > 0) {
          echo '<select name="school">
          // <option> Kies een school </option>
          ';
          while (mysqli_stmt_fetch($stmt)) {
            echo '<option value="' . $sId . '">' . $sNaam . '</option>';
          }
          echo '</select>';
        }else{
          echo "<p>There are no schools registered!</p>";
        }
      }else{
        echo 'query ging fout!';
      }

      ?>
    </p>
    <p>
      <input type='submit' value='verzenden' name='reg_submit' class='btn'>
    </p>
  </form>

  <?php
  if(isset($_POST['reg_submit'])){
    if(!empty($_POST['school']) && !empty($_POST['reg_password']) && !empty($_POST['reg_email'])){
      $TableName = 'HboStudent';
      $query = "INSERT INTO " . $TableName . " (StudentEmail, SchoolId, Wachtwoord) VALUES ( ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $query)){
        $pwhash = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, 'sss', $_POST['reg_email'], $_POST['school'], $pwhash);
        mysqli_stmt_execute($stmt);
        header("Location: index.php");
      } else {
        echo "<br>Error: " . $query . "<br>" . mysqli_error($conn);
      }
      echo 'poging';
    }else{
      echo 'vul beide velden in';
    }
  }
  ?>
</div>

</body>
</html>