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
    <title>Add Student</title>
    <link rel="stylesheet" href="../static/css/index.css">
    <link rel="stylesheet" href="../static/css/details.css"> 
</head>
<body>
   <?php include '../frontend/navbar.php'; ?>
   
   <div class="form-container">
        <center><h2>Add New Book</h2></center>
        <form action="../backend/save_student.php" method="POST">
            <table class="book-details-table">
                <tr>
                    <th>Name</th>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <th>Admission Number</th>
                    <td><input type="text" name="admission_number" required></td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td><input type="text" name="department" required></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="text" name="email" required></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><input type="text" name="phone" required></td>
                </tr>
            </table>
            <div class="book-add-buttons">
                <button type="submit" class="book-btn book-btn-update">Add Student</button>
                <a href="../frontend/students.php" class="book-btn book-btn-back">Back</a>
            </div>
        </form>
   </div>
</body>
</html>

    <?php
  }
?>
