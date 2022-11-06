<?php
session_start();
require 'control/database.php';

global $connection;

$id = $_POST['id'];

if(isset($_POST['update'])){
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $telephone = $_POST['telephone'];
    $password = md5($_POST['password']);
    $password_confirm = md5($_POST['password_confirm']);

    $errors=[];

    if($password_confirm != $password){
        array_push($errors, 'Passwords do not match!');
    } 

    $query = "UPDATE register_form SET email='$email',fname='$fname', lname='$lname', telephone = '$telephone', password = '$password' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        echo "Updated";
      
    }else{
        echo "Not updated";
    }

}

    $query = "SELECT * FROM register_form WHERE id = '$id'";
    $query_run = mysqli_query($connection, $query);
    $row_user = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8vLyJu/v7wcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGtHIf9rRyH/a0ch/2tHIf9rRyH/a0ch/2tHIf9rRyH/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAj4+PDmtHIf9rRyH/a0ch/2tHIf9rRyH/a0ch/2tHIf8AAAAAa0ch/2tHIf8AAAAAAAAAAAAAAAAAAAAAAAAAAGtHIf9rRyH/qIdj/wAAAABrRyH/a0ch/2tHIf9rRyH/AAAAAGtHIf9rRyH/a0ch/wAAAAAAAAAAAAAAAGtHIf9rRyH/a0ch/2tHIf9rRyH/qIdj/4+PjwtrRyH/a0ch/wAAAABrRyH/a0ch/2tHIf9rRyH/AAAAAKiHY/9rRyH/a0ch/2tHIf9rRyH/a0ch/2tHIf9rRyH/AAAAAGtHIf+oh2P/a0ch/2tHIf9rRyH/a0ch/wAAAABrRyH/a0ch/2tHIf9rRyH/jo6OBAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKiHY/9rRyH/a0ch/2tHIf+oh2P/a0ch/2tHIf8AAAAAqIdj/2tHIf8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABrRyH/AAAAAAAAAABrRyH/a0ch/2tHIf8AAAAAa0ch/2tHIf9rRyH/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa0ch/2tHIf9rRyH/AAAAAGtHIf8AAAAAa0ch/2tHIf9rRyH/a0ch/2tHIf8AAAAAAAAAAAAAAAAAAAAAa0ch/2tHIf9rRyH/a0ch/2tHIf8AAAAAa0ch/2tHIf9rRyH/a0ch/6iHY/9rRyH/AAAAAAAAAAAAAAAAkpKSJGtHIf9rRyH/a0ch/2tHIf9rRyH/AAAAAAAAAABrRyH/a0ch/2tHIf8AAAAAa0ch/2tHIf8AAAAAa0ch/2tHIf9rRyH/a0ch/2tHIf9rRyH/a0ch/wAAAAAAAAAAa0ch/2tHIf9rRyH/AAAAAGtHIf9rRyH/a0ch/5CQkBaSkpI+a0ch/2tHIf9rRyH/a0ch/wAAAAAAAAAAAAAAAAAAAABrRyH/a0ch/6iHY/9rRyH/a0ch/2tHIf9rRyH/a0ch/wAAAAAAAAAAa0ch/2tHIf8AAAAAAAAAAAAAAAAAAAAAAAAAAGtHIf9rRyH/qIdj/2tHIf9rRyH/a0ch/2tHIf9rRyH/a0ch/5KSkjQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABrRyH/a0ch/2tHIf9rRyH/qIdj/wAAAAAAAAAAAAAAAAAAAAAAAAAA//8AAPAPAADgJwAAxCMAAIEhAAAAgQAAD+AAACfsAABH4gAAg8EAAAPBAACJAQAAiMMAAMAzAADgDwAA/B8AAA==" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/fontello.css">
    <title>Kuvio</title>
</head>

<body>
    <header class="p-3 text-bg-dark">
        <div class="container sm md text-center">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="homepage.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <h2 class="color1 text-uppercase marg">Kuvio</h2>
                </a>
                <div class="vr marg"></div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="homepage.php" class="nav-link px-2 text-white">Homepage</a></li>

                </ul>

                <div class="text-end">
                    <?php if (isset($_SESSION['hash'])) echo '<a href="control/logout.php"><button type="button" class="btn btn-outline-light me-2">Log out</button></a>' ?>
                    <?php if (empty($_SESSION['hash']))
                        //header('Location: index.php');
                    ?>
                </div>
            </div>
        </div>

    </header>

    <body>
        <?php
    if ($query_run) {
        foreach ($row_user as $row) {
        ?>
                <div class="container">
                    <div class="jumbotron">
                        <h2>Update</h2>
                        <hr>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3" value="<?php echo $row['email'] ?>" id="floatingInput" name="email" placeholder="name@example.com">
                                <label for="floatingInput">Email address:</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" value="<?php echo $row['fname'] ?>" id="floatingInput" name="fname" placeholder="Your name">
                                <label for="floatingInput">First name:</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" value="<?php echo $row['lname'] ?>" id="floatingInput" name="lname" placeholder="Your lastname">
                                <label for="floatingInput">Last name:</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control rounded-3" value="<?php echo $row['telephone'] ?>" id="floatingInput" name="telephone" placeholder="Phone number">
                                <label for="floatingInput">Enter a phone number:</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-3" value="<?php echo $row['password'] ?>" id="floatingPassword" name="password" placeholder="Password">
                                <label for="floatingPassword">Password:</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password_confirm" class="form-control rounded-3" value="<?php echo $row['password_confirm'] ?>" id="floatingPassword" name="password_confirm" placeholder="Password">
                                <label for="floatingPassword">Repeat your password:</label>
                            </div>
                            <input type="submit" id="submit" href="profile.php" class="btn btn-dark" name="update" value="Update your information">

                            <?php
                            if (isset($_SESSION['message'])) {
                                echo '<p class="message">' . $_SESSION['message'] . '</p>';
                            }
                            unset($_SESSION['message']);
                            ?>
                            <?php $errors = []; ?>
                            <?php if (count($errors) > 0) : ?>
                                <div class="error">
                                    <?php foreach ($errors as $error) : ?>
                                        <p class="message"><?php echo $error ?></p>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </form>
                    </div>
                </div>

        <?php
        }
    } else {
        echo '<script>("No record found")</script>';
    }


        ?>
        <?php
        include_once("includes/footer.php");
        ?>

    </body>

</html>