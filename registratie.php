<html>
<header>
</header>
<body>
  <div class='container'>

    <?php
    include('conn.php');

    if(isset($_POST['reg_submit'])){
      if(!empty($_POST['school']) && !empty($_POST['reg_password']) && !empty($_POST['reg_email'])){
        $Tn = 'HboStudent';
        $SQLstring2 = "SELECT StudentEmail FROM " . $Tn . " WHERE StudentEmail = '" . $_POST['reg_email'] . "'";
        if ($stmt3 = mysqli_prepare($conn, $SQLstring2)) {
          mysqli_stmt_execute($stmt3);
          mysqli_stmt_store_result($stmt3);
          if (mysqli_stmt_num_rows($stmt3) == 0) {
            $TableName = 'hboStudent';
            $query = "INSERT INTO " . $TableName . " (StudentEmail, SchoolId, Wachtwoord) VALUES ( ?, ?, ?)";
            if($stmt = mysqli_prepare($conn, $query)){
              $pwhash = password_hash($_POST['reg_password'], PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, 'sss', $_POST['reg_email'], $_POST['school'], $pwhash);
              mysqli_stmt_execute($stmt);
              header("Location: index.php");
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
        <input type='email' name='reg_email' placeholder="email">
      </p>
      <p>
        <input type='password' name='reg_password' placeholder="password">
      </p>
      <p>
        <?php
        $TableName2 = 'School';
        $SQLstring = "SELECT SchoolId, SchoolNaam FROM " . $TableName2;
        if ($stmt1 = mysqli_prepare($conn, $SQLstring)) {
          $exec = mysqli_stmt_execute($stmt1);
          if($exec == true){
            mysqli_stmt_store_result($stmt1);
            mysqli_stmt_bind_result($stmt1, $sId, $sNaam);

            if (mysqli_stmt_num_rows($stmt1) > 0) {
              echo '<select name="school">
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
      </p>
      <p>
        <input type='submit' value='verzenden' name='reg_submit' class='btn'>
      </p>
    </form>
  </div>
</body>
</html>
