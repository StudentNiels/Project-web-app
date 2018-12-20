
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
      $TableName2 = 'school';
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
      echo 'poging';
    }else{
      echo 'vul beide velden in';
    }
  }
  ?>
</div>
</body>
