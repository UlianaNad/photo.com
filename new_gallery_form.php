<?php
session_start();

include_once("control/database.php");

global $connection;

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
                    <?php if (isset($_SESSION['hash'])) echo '<a href="control/logout.php"><button type="button" class="btn btn-outline-light me-2">Log out</button></a>'?>
                    <?php if  (empty($_SESSION['hash'])) 
                        header('Location: index.php');
                    ?>
                </div>
            </div>
        </div>

    </header>

    <div class="container">
        <h2 class="pb-2 border-bottom">Create a new gallery:</h2>
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-2">
        </div>
        <form action="control/gallery_form.php" method="post" enctype="multipart/form-data">
            <div class="container ">
                <div class="mb-3">
                    <label for="gallery_name" class="form-label">Name your gallery:</label>
                    <input type="text" name="gallery_name" class="form-control" id="gallery_name" placeholder="Ex.: Taylor and Teresa" require>
                </div>
                <div class="mb-3">
                    <label for="storage_period" class="form-label">Storage reriod:</label>
                    <input class="form-control" name="storage_period" list="datalistOptions" id="storage_period" placeholder="Forever">
                    <datalist id="datalistOptions">
                        <option value="1 months">
                        <option value="2 months">
                        <option value="3 months">
                        <option value="6 months">
                        <option value="1 year">
                    </datalist>
                </div>

                <div class="mb-3">
                    <label for="date">Date of photo shooting:</label><br>
                    <input type="text" class="form-control" id="date" name="date" require>

                </div>
                <div class="mb-3">
                    <label for="cover" class="form-label">Choose the cover for the new gallery:</label>
                    <input type="file" name="cover" class="form-control" id="cover" aria-describedby="inputGroupFileAddon04" aria-label="Upload" require>

                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="using" value="privat" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Privat gallery
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="using" value="public" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Public gallery
                        </label>
                    </div>
                </div>
                <a class="text-decoration-none" href="upload_page.php" value="Create"><input type="submit" class="btn btn-dark"></button></a>
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<p class="message">' . $_SESSION['message'] . '</p>';
                }
                unset($_SESSION['message']);
                ?>
            </div>
        </form>

    </div>