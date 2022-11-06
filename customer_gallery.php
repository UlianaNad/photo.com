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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
</head>

<body>
    <header class="p-3 text-bg-dark">
        <div class="container sm md text-center">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="#" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <h2 class="color1 text-uppercase marg">Kuvio</h2>
                </a>
            </div>
        </div>

    </header>

    <div class="container">
        <form action="" name="zip" method="post">
            <?php
            global $connection;

            $gallery_id = $_GET['gallery_id'];

            $sql = "SELECT * FROM files WHERE gallery_id = '$gallery_id'";

            $result = mysqli_query($connection, $sql);

            $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $sql_name = "SELECT * FROM galleries WHERE id = '$gallery_id'";

            $result_name = mysqli_query($connection, $sql_name);

            $gallery_name = mysqli_fetch_all($result_name, MYSQLI_ASSOC);

            ?>
            <div class="container">
                <div class="bl border-bottom">
                    <h2 class="pb-2 "><?php echo $gallery_name[0]['gallery_name']; ?> </h2>
                    <a style="text-decoration:none" ;>
                        <input type="checkbox" id="checkAll" />
                        <label>Select All</label>

                    </a>
                    <div class="btn">
                        <input type="submit" id="submit" class="btn btn-light" name="createzip" value="Download">
                        <img src="img/download.png" alt="" style="width: 25px" ;>
                    </div>


                    <?php
                    $error = "";
                    if (isset($_POST['createzip'])) {
                        $post = $_POST;
                        $file_folder = "temp/";
                        if (extension_loaded('zip')) {
                            if (isset($post['files']) and count($post['files']) > 0) {
                                $zip = new ZipArchive();
                                $zip_name = time() . ".zip";
                                if ($zip->open($zip_name, ZIPARCHIVE::CREATE) !== TRUE) {
                                    $error .= "* Sorry ZIP creation failed";
                                }
                                foreach ($post['files'] as $file) {
                                    $zip->addFile($file_folder . $file);
                                }
                                $zip->close();
                                if (file_exists($zip_name)) {
                                    header('Content-type: application/zip');
                                    header('Content-Disposition:attachment; filename="' . $zip_name . '"');
                                    readfile($zip_name);
                                    unlink($zip_name);
                                }
                            } else
                                $error .= "* Please select files to zip";
                        } else
                            $error .= "*You don't have ZIP extention";
                    } 
                    echo $error;
                    ?>


                </div>
                <h6 class="pb-2 mt-3 ">Date of photoshooting: <?php echo $gallery_name[0]['date']; ?></h6>

                <div class="wrapper">

                    <?php

                    global $connection;

                    $gallery_id = $_GET['gallery_id'];

                    $sql = "SELECT * FROM files WHERE gallery_id = '$gallery_id'";

                    $result = mysqli_query($connection, $sql);

                    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    if (empty($files)) {
                        echo 'no files';
                    } else {

                        foreach ($files as $file) {
                    ?>
                            <div class="container px-4 py-2">
                                <div class="gallery" ;>
                                    <a href="temp/<?= $file['image'] ?>" data-fancybox="gallery">
                                        <img src="temp/<?= $file['image'] ?>" class="galleryImg">
                                    </a>
                                </div>
                                <input class="chk" type="checkbox" name="files[]" value="<?= $file['image'] ?>" />
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
        </form>

    </div>

    <script src="js/jquery.js"></script>
    <script>
        $('#submit').prop("disabled", true);
        $("#checkAll").change(function() {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
            $('#submit').prop("disabled", false);
            if ($('.chk').filter(':checked').length < 1) {
                $('#submit').attr('disabled', true);
            }
        });

        $('input:checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('#submit').prop("disabled", false);
            } else {
                if ($('.chk').filter(':checked').length < 1) {
                    $('#submit').attr('disabled', true);
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        const config = {
            loop: true,
            infobar: false,
        };

        $('[data-fancybox="gallery"]').fancybox(config);
    </script>



    <?php
    include_once("includes/footer.php");
    ?>