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
          <div class="text-center col-6 mx-auto">
            <?php
            include('conn.php');
            session_start();
            if(isset($_POST['reg_submit'])){
              if(!empty($_POST['school']) && !empty($_POST['reg_password']) && !empty($_POST['reg_email']) && isset($_SESSION['betaald'])){
                if($_SESSION['betaald'] == '1'){
                  $Tn = 'user';
                  $SQLstring2 = "SELECT Email FROM " . $Tn . " WHERE Email = '" . $_POST['reg_email'] . "'";
                  if ($stmt3 = mysqli_prepare($conn, $SQLstring2)) {
                    mysqli_stmt_execute($stmt3);
                    mysqli_stmt_store_result($stmt3);
                    if (mysqli_stmt_num_rows($stmt3) == 0) {
                      $TableName = 'user';
                      $query = "INSERT INTO " . $TableName . " (Email, SchoolId, Wachtwoord, DocentPerms) VALUES ( ?, ?, ?, 0)";
                      if($stmt = mysqli_prepare($conn, $query)){
                        $pwhash = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt, 'sss', $_POST['reg_email'], $_POST['school'], $pwhash);
                        $exec = mysqli_stmt_execute($stmt);
                        if($exec == true){
                          $_SESSION['betaald'] = '0';
                          header("Location: inlog.php?reg=1");
                        }
                      } else {
                        echo "<br>Error: " . $query . "<br>" . mysqli_error($conn);
                      }
                    }else{
                      echo 'emailadres is al in gebruik.';
                    }
                  }
                }
                // echo 'poging';
                else {
                  echo 'Controleer of je alle velden hebt ingevuld en het abbonoment hebt betaald';
                }
              }else{
                echo 'betaal het abbonement';
                print_r($_SESSION);
              }
            }

            ?>
            <h3> register </h3>
            <form method="post">
              <p>
                <div class="form-group">
                  <input class="form-control" type='email' name='reg_email' placeholder="email">
                </div>
              </p>
              <p>
                <div class="form-group">
                  <input class="form-control" type='password' name='reg_password' placeholder="password">
                </div>
              </p>

              <p>
                <div class="form-group">
                  <?php
                  $TableName2 = 'School';
                  $SQLstring = "SELECT SchoolId, SchoolNaam FROM " . $TableName2;
                  if ($stmt1 = mysqli_prepare($conn, $SQLstring)) {
                    $exec = mysqli_stmt_execute($stmt1);
                    if($exec == true){
                      mysqli_stmt_store_result($stmt1);
                      mysqli_stmt_bind_result($stmt1, $sId, $sNaam);

                      if (mysqli_stmt_num_rows($stmt1) > 0) {
                        echo '<select class="form-control" name="school">
                        ';
                        while (mysqli_stmt_fetch($stmt1)) {
                          echo '<option value="' . $sId . '">' . $sNaam . '</option>';
                        }
                        echo '</select>';
                      }else{
                        echo "<p>There are no schools registered!</p>";
                      }
                    }
                  }else{
                    echo 'query ging fout!';
                  }
                  ?>
                </div>
              </p>
              <p>
                <a href='betaling.php' target="_blank">Betaal abbonement
                </a>
              </p>
              <p>
                <input type='submit' value='verzenden' name='reg_submit' class='btn'>
              </p>
              <p>
                <a href='inlog.php'> Heb je al een account? klik hier </a>
              </p>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</body>
</html>
