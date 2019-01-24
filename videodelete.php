<?php
include('conn.php');
include('logcheck.php');
$videoId = $_GET['id'];
$selectString = "SELECT locatie FROM `video` WHERE videoId = ?";

if ($r = mysqli_prepare($conn, $selectString)) {
    mysqli_stmt_bind_param($r, 'i', $videoId);   
    if (mysqli_stmt_execute($r)) {
        mysqli_stmt_bind_result($r, $locatie);
        mysqli_stmt_store_result($r);
        mysqli_stmt_fetch($r);
        if (mysqli_stmt_num_rows($r) === 0) {
            echo "kan geen info vinden";
        } else {
           unlink($locatie);
        } mysqli_stmt_close($r);
    } else {echo "could not execute statment";}
} else {echo "<p>Could not prepare statment</p>";}

$deleteString = "DELETE FROM video WHERE videoID = " . $videoId;
if ($statement = mysqli_prepare($conn, $deleteString)) {
    $result = mysqli_stmt_execute($statement);
    if ($result === TRUE) {
        header('location: videobeheer.php');
    } else {
        echo "<p>Could not execute statement</p>";
    }
} else {
    echo "<p>Could not prepare statment</p>";
}
?>       