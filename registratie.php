<html>
<header>
</header>
<body>
  <div class='container'>

    <?php
    include('conn.php');

    if(isset($_POST['reg_submit'])){
      if(!empty($_POST['school']) && !empty($_POST['reg_password']) && !empty($_POST['reg_email'])){
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
              mysqli_stmt_execute($stmt);
              header("Location: inlog.php?reg=1");
            } else {
              echo "<br>Error: " . $query . "<br>" . mysqli_error($conn);
            }
          }else{
            echo 'emailadres is al in gebruik.';
          }
          // echo 'poging';
        }else{
          echo 'vul beide velden in';
        }
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
        <input type='submit' value='verzenden' name='reg_submit' class='btn'>
      </p>
    </form>
  </div>
</body>
</html>
