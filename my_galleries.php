<?php

session_start();
include_once("control/database.php");


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

    <div class="container">

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-6 ">

                    <?php
                    $galleries = mysqli_query($connection, "SELECT * FROM `galleries` ORDER BY `id` DESC");
                    foreach ($galleries as $gallery) {
                    ?>

                        <div class="col grid-wr mb-3">
                            <div class="card shadow-sm card-wr ">
                                <div class="wr">
                                    <a href="customer_gallery.php?gallery_id=<?php echo $gallery['id'] ?>">
                                        <img class="image-wr" src="temp_cover/<?= $gallery['cover'] ?>" alt="">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h5 class=" lh-1"><?= $gallery['gallery_name'] ?></h5>
                                    <div class="py-1">
                                        <small class="text-muted ">Date of shooting:<b> <?= $gallery['date'] ?></b></small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="gallery.php?gallery_id=<?php echo $gallery['id'] ?>" style="text-decoration: none;">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            </a>
                                            <a href="customer_gallery.php?gallery_id=<?php echo $gallery['id'] ?>">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                                            </a>
                                        </div>
                                        <!-- Button trigger modal -->

                                        <!-- <a href="?gallery_id=<?php echo $gallery['id'] ?>" style="text-decoration: none;"> -->
                                        <input type="button" value="Delete" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $gallery['id'] ?>">
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $gallery['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="control/delete_gallery.php" method="post">
                                    <div class="modal-content">
                                       
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete the gallery</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Do you really want to delete the photo gallery: <?php echo $gallery['gallery_name'] ?> ? </p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancel</button>
                                            <input type="hidden" name="id" value="<?php echo $gallery['id'] ?>">
                                            <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?php
    include_once("includes/footer.php");
    ?>