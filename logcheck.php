<?php
session_start();
  if(!isset($_SESSION['loggedin'])){
    header("Location: inlog.php?log=1");
  }
 ?>
