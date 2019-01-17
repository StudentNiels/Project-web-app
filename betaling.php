<html>
<div class=''>Paypal</div>
<form method='post'>
<input type='submit' value='Betalen' name='betaal'>
</form>
<?php
if(isset($_POST['betaal'])){
  session_start();
  $_SESSION['betaald'] = '1';
  echo '<h1> Bedankt voor de betaling, ga terug naar de registratie pagina om het registratie process te hervatten.</h1>';  
}
?>
