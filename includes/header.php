
<?php 

  $logined = false;
  if (!$_SESSION['hash']){
    header('Location: ../index.php');
  }else{

  $userHash = $_SESSION['hash'];
  $sql = "SELECT * FROM register_form WHERE password = '$userHash'";
     
  $result = mysqli_query($connection, $sql);
  $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

  if (!empty($user)){
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
                    <li><a href="index.php" class="nav-link px-2 text-white">Homepage</a></li>
                    <li><a href="my_galleries.php" class="nav-link px-2 text-white">Galleries</a></li>
                    <li><a href="profile.php" class="nav-link px-2 text-white">My profile</a></li>
                    <li><a href="contact.php" class="nav-link px-2 text-white">Contact me</a></li>
                   
                </ul>

                <div class="text-end">
                    <?php if ($logined) echo '<a href="control/logout.php"><button type="button" class="btn btn-outline-light me-2">Log out</button></a>'?>
                    <?php if ($logined = false) echo
                    '<a href="authorise.php"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
                    <a href="register.php"><button type="button" class="btn btn-outline-light me-2">Sign-up</button></a>'
                    ?>
                </div>
            </div>
        </div>
        
    </header>