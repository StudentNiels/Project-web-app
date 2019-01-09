<?php
include('conn.php');
?>
<!DOCTYPE html>
<html>
<body>
    <form method="post" action="uploadvideoresult.php" enctype='multipart/form-data'>
	
	Enter het vak:
	<?php
	$TableName = 'video';
	$SQLstring = "SELECT VideoID, Vak FROM " . $TableName . " GROUP BY Vak";
      if ($stmt = mysqli_prepare($conn, $SQLstring)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $VideoID, $Vak);

        if (mysqli_stmt_num_rows($stmt) > 0) {
          echo '<select name="video">
         <option> Kies een vak </option>';
          while (mysqli_stmt_fetch($stmt)) {
            echo '<option value="' . $VideoID . '">' . $Vak . '</option>';
          }
          echo '</select>';
        }else{
          echo "<p>There are no courses registered!</p>";
        }
		}else{
        echo 'query ging fout!';
      }
?>

	<p>Enter de titel: <input type="text" name="Titel_entered"/></p><br><br>
      <input type='file' name='file' />
      <input type='submit' value='Upload' name='but_upload'>
    </form>
	<p><a href="readvideo.php">Voorgaande Uploads.</a></p>
  </body>
</html>