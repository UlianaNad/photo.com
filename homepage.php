<?php
session_start();
include('control/database.php');
global $connection;

?>
<?php

$logined = false;
if (!$_SESSION['hash']) {
    //header('Location:  index.php');
} else {

    $userHash = $_SESSION['hash'];
    $sql = "SELECT * FROM register_form WHERE password = '$userHash'";

    $result = mysqli_query($connection, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (!empty($user)) {
        $logined = true;
    }
}

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
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                        <circle cx="12" cy="13" r="4" />
                    </svg>
                    <h2 class="color1 text-uppercase marg">Kuvio</h2>
                </a>
                <div class="vr marg"></div>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="homepage.php" class="nav-link px-2 text-white">Homepage</a></li>
                    <li><a href="my_galleries.php" class="nav-link px-2 text-white">Galleries</a></li>
                    <li><a href="new_gallery_form.php" class="nav-link px-2 text-white">Create a new gallery</a></li>
                    <li><a href="profile.php" class="nav-link px-2 text-white">Profile settings</a></li>
                    <li><a href="contact.php" class="nav-link px-2 text-white">Contact us</a></li>
                </ul>

                <div class="text-end">
                    <?php if (isset($_SESSION['hash'])) echo '<a href="control/logout.php"><button type="button" class="btn btn-outline-light me-2">Log out</button></a>' ?>
                    <?php if (empty($_SESSION['hash']))
                        header('Location: index.php');
                    ?>
                </div>
            </div>
        </div>

    </header>

    <div class="main mb-5">
        <div class="container">
            <h2 class="pb-2 border-bottom">Homepage</h2>
            <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
            </div>
            <div class="container marketing mb-4">
                <div class="main ">
                    <div class="row mx-auto">
                        <div class="col-lg-4 mx-auto text-center">
                            <img src="img/user.png" alt="" style="width: 100px;">
                            <h2 class="fw-normal text-center">My profile</h2>
                            <p class="text-center">My profile information</p>
                            <button class="btn btn-dark text-center"><a style="color:white; text-decoration:none" ; href="profile.php">View details &raquo;</a></button>
                        </div>
                        <div class="col-lg-4 mx-auto text-center">
                            <img src="img/add-photo.png" alt="" style="width: 100px;">
                            <h2 class="fw-normal text-center">Create a new gallery</h2>
                            <p class="text-center">Exite your clients wiyh the new way of sharing photos!
                            </p>
                            <button class="btn btn-dark text-center"><a style="color:white; text-decoration:none" ; href="new_gallery_form.php">Create &raquo;</a></button>
                        </div>
                        <div class="col-lg-4 text-center">
                            <img src="img/add-image.png" alt="" style="width: 100px;">
                            <h2 class="fw-normal text-center">Watch my galleries</h2>
                            <p class="text-center">You can check your personal photo gallery which can halp you to find more customers!</p>
                            <button class="btn btn-dark text-center"><a style="color:white; text-decoration:none" ; href="my_galleries.php">Watch &raquo;</a></button>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            include_once("includes/footer.php");
            ?>