<?php

session_start();
include_once("database.php");

global $connection;

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    $query = "DELETE FROM galleries WHERE id='$id'";
    $sql = "DELETE FROM files WHERE gallery_id='$id'";
    $query_run = mysqli_query($connection, $query);
    $query_run2 = mysqli_query($connection, $sql);

    if(isset($query_run) && isset($query_run2)){
        echo '<p> The gallery was deleted!</p>';
        // header("location: ../galery.php");
    }else{
        echo '<p> The gallery was NOT deleted!</p>';
        // header("location: ../galery.php");
    }
}



?>
