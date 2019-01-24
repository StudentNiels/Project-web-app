<?php
include('conn.php');
include('logcheck.php');
$videoId = $_GET['id'];
$selectString = "SELECT Locatie FROM `video` WHERE videoID = " . $videoId;
if ($stmt = mysqli_prepare($conn, $selectString)) { 
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_bind_result($stmt, $Locatie);
        mysqli_stmt_store_result($stmt);
        echo $Locatie;
        //unlink($Locatie);
    } else {
        echo "<p>Could not execute statement</p>";
    }
} else {
    echo "<p>Could not prepare statment</p>";
}

//$deleteString = "DELETE FROM video WHERE videoID = " . $videoId;
//if ($statement = mysqli_prepare($conn, $deleteString)) {
//    $result = mysqli_stmt_execute($statement);
//    if ($result === TRUE) {
//        header('location: videobeheer.php');
//    } else {
//        echo "<p>Could not execute statement</p>";
//    }
//} else {
//    echo "<p>Could not prepare statment</p>";
//}
//?>       