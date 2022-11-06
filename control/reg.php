<?php

    require 'database.php';
    global $connection;
    $mysqli = $connection;

    $errors = array(); 

if (isset($_POST['do_signup']))
    {
         // receive all input values from the form
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $firstname = mysqli_real_escape_string($mysqli, $_POST['fname']);
        $lastname = mysqli_real_escape_string($mysqli, $_POST['lname']);
        $telephone = mysqli_real_escape_string($mysqli, $_POST['tel']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $password_confirm = mysqli_real_escape_string($mysqli, $_POST['password_confirm']);

// form validation: ensure that the form is correctly filled ...
        if(empty($email)) {
            array_push($errors,  'Write your email');
        }
        if(empty($firstname)){
            array_push($errors, 'Write your firstname');
        }

        if(empty($lastname)){
            array_push($errors, 'Write your lastname');
        }

        if(empty($telephone)){
            array_push($errors,  'Write your phone number');
        }

        if(empty($password)){
            array_push($errors, 'Write your password');
        }

        if($password_confirm != $password){
            array_push($errors, 'Passwords do not match!');
        } 
    
        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM `register_form` WHERE `email`='$email' LIMIT 1";
        $result = mysqli_query($mysqli, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if ($user) { // if user exists
        
            if ($user['email'] === $email) {
              array_push($errors, "Email already exists");
            }
          }
        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password_confirm); //encrypt the password before saving in the database

            $query = "INSERT INTO `register_form` (`fname`, `lname`, `email`, `telephone`, `password`) 
                      VALUES ('$firstname', '$lastname', '$email', '$telephone', '$password')";
            mysqli_query($mysqli, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            $_SESSION['message'] = "You are regestered";
            header('Location: authorise.php');
        }
    }








//         if($password === $password_confirm) {
                          
//             $password = md5($password);
    
//             mysqli_query($mysqli, "INSERT INTO `register_form` (`fname`, `lname`, `email`, `telephone`, `password`) 
//                 VALUES ('$firstname', '$lastname', '$email', '$telephone', '$password')");

//                 $_SESSION['message'] = 'Registration is succesfull!';
//                 header('Location: ../authorise.php');
//              } 
        
    

// ?>