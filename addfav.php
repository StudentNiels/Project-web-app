<?php
include('conn.php');
session_start();
$cat = $_GET['cat'];
$vak = $_GET['vak'];
$tn = 'favorieten';

if($cat == 'add'){
  $sql = "INSERT INTO " . $tn . " (userID, Vak) VALUES (?, ?)";
  if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "is", $_SESSION['userId'], $vak);
      if (mysqli_stmt_execute($stmt)) {
          header('location: index.php');
      }else{
          header('location: index.php');
      }
    }else{
      echo 'er ging iets fout';
    }
}elseif($cat=='del'){
  $sql = "DELETE FROM " . $tn . " WHERE Vak = ? AND userID = ?";
  if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $vak, $_SESSION['userId'] );
      if (mysqli_stmt_execute($stmt)) {
          header('location: favorieten.php');
      }else{
          header('location: favorieten.php');
      }
    }else{
      echo 'er ging iets fout';
    }
}

 ?>

 ?>
