<?php
session_start();

include('database.php');
global $connection;

if($connection === false){
    die("ERROR: Could not connect. " . $connection->connect_error);
}
    $gallery_name = $_POST['gallery_name'];
    $storage_period = $_POST['storage_period'];
    $date = $_POST['date'];
    $using = $_POST['using'];
    $path = 'temp'.$_FILES['cover']['name'];
    if(!move_uploaded_file($_FILES['cover']['tmp_name'], '../temp_cover/'.$path)) {
        $_SESSION['message'] = 'Error in uploading!';
        header('Location: ../new_gallery_form.php');
    } else{
        mysqli_query($connection, "INSERT INTO `galleries` (`gallery_name`, `storage_period`, `date`, `cover`, `using`) 
                VALUES ('$gallery_name','$storage_period', '$date', '$path', '$using')");
        $_SESSION['message'] = 'You created a new gallery';
        header('Location: ../upload_page.php');
    }

    

?>