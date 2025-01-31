<?php
  session_start();  
  $log_status = isset($_SESSION["is_logged_in"]) ? $_SESSION["is_logged_in"] : false;
  if(!$log_status)
  {
     header("Location: ../frontend/index.php");
     exit();
  }
  else{
    ?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../static/css/index.css">
</head>
<body>
    <?php
        include '../frontend/navbar.php';
    ?>
    <div class="home-banner">
      <center><img src="../static/images/banner-home.jpg" alt=""></center>
    </div>
</body>
</html>
    <?php
  }
?>
