<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link rel="stylesheet" href="../static/css/index.css">
</head>
<body>
   <header>
        <?php
         include '../frontend/navbar.php'
        ?>
   </header>
   <main>
      <div class="banner">
        <img src="../static/images/banner6.png" alt="">
        <div class="login-form">
            <h3>LOGIN</h3>
            <form action="../backend/login.php" method="post">
                <input type="text" name="username" type="email" placeholder="USERNAME" required>
                <input type="password" name="password" placeholder="PASSWORD" required>
                <button type="submit">LOGIN</button>
            </form>
        </div>
      </div>
   </main>
   <footer>

   </footer>
</body>
</html>