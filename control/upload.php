<?php
    session_start();
    include_once("database.php");

    if(isset($_POST['submit'])){

        $fileCount = count($_FILES['file']['name']);
        for($i=0; $i<$fileCount; $i++){
            $fileName = $_FILES['file']['name'][$i];

            $gallery_id = $_POST['gallery_name'];

            $sql = "INSERT INTO files (title, image, gallery_id) VALUES ('$fileName','$fileName', '$gallery_id')";

            if($connection->query($sql) === TRUE){
                echo "Success" . '<br>';
            }else{
                echo"error";
            }

            move_uploaded_file($_FILES['file']['tmp_name'][$i], '../temp/'.$fileName);
        }
        
        header('Location: ../my_galleries.php');

    }



?>