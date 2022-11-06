<?php
    session_start();
    include_once 'database.php';

    global $connection;
    
    $errors = array(); 

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
  
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM `register_form` WHERE `email`='$email' AND password='$password'";
        $results = mysqli_query($connection, $query);

        if (mysqli_num_rows($results) == 1) {
          $_SESSION['user'] = $email;
          $_SESSION['hash'] = $password;
          $_SESSION['success'] = "You are now logged in";
          header('location: homepage.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
  ?>
   