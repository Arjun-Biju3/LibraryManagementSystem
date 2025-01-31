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
    <title>Add Book</title>
    <link rel="stylesheet" href="../static/css/index.css">
    <link rel="stylesheet" href="../static/css/details.css"> 
</head>
<body>
   <?php include '../frontend/navbar.php'; ?>
   
   <div class="form-container">
        <center><h2>Add New Book</h2></center>
        <form action="../backend/save_book.php" method="POST">
            <table class="book-details-table">
                <tr>
                    <th>Book Title:</th>
                    <td><input type="text" name="title" required></td>
                </tr>
                <tr>
                    <th>Author:</th>
                    <td><input type="text" name="author" required></td>
                </tr>
                <tr>
                    <th>Year of Publication:</th>
                    <td><input type="number" name="year_of_publication" required></td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td><textarea name="description" required></textarea></td>
                </tr>
                <tr>
                    <th>UID Number:</th>
                    <td><input type="text" name="uid" required></td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        <select name="status">
                            <option value="Available">Available</option>
                            <option value="Issued">Issued</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="book-add-buttons">
                <button type="submit" class="book-btn book-btn-update">Add Book</button>
                <a href="../frontend/book.php" class="book-btn book-btn-back">Back</a>
            </div>
        </form>
   </div>
</body>
</html>

    <?php
  }
?>
