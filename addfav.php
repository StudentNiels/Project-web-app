<?php
include('conn.php');
session_start();
$videoid = $_GET['id'];
$cat = $_GET['cat'];
$tn = 'favorieten';

if($cat == 'add'){
  $sql = "INSERT INTO " . $tn . " (userID, VideoID) VALUES (?, ?)";
  if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $_SESSION['userId'], $videoid);
      if (mysqli_stmt_execute($stmt)) {
          header('location: index.php');
      }else{
          header('location: index.php');
      }
    }else{
      echo 'er ging iets fout';
    }
}elseif($cat=='del'){
  $sql = "DELETE FROM " . $tn . " WHERE videoID = ? AND userID = ?";
  if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $videoid, $_SESSION['userId'] );
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
