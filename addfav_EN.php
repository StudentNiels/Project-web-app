<?php
include('conn.php');
session_start();
$vak = $_GET['vak'];
$cat = $_GET['cat'];
$tn = 'favorieten';

if($cat == 'add'){
  $sql = "INSERT INTO " . $tn . " (userID, Vak) VALUES (?, ?)";
  if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userId'], $vak);
      if (mysqli_stmt_execute($stmt)) {
          header('location: index_EN.php');
      }else{
          header('location: index_EN.php');
      }
    }else{
      echo 'Something went wrong';
    }
}elseif($cat=='del'){
  $sql = "DELETE FROM " . $tn . " WHERE Vak = ? AND userID = ?";
  if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $vak, $_SESSION['userId'] );
      if (mysqli_stmt_execute($stmt)) {
          header('location: favorieten_EN.php');
      }else{
          header('location: favorieten_EN.php');
      }
    }else{
      echo 'er ging iets fout';
    }
}

 ?>
