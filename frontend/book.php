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
    <div class="book-details">
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Year of Publication</th>
                    <th>Description</th>
                    <th>UID Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../backend/connection.php';
                $sql = "SELECT * FROM table_books";
                $res = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($res)){
                ?>
                    <tr>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["year_of_publication"]; ?></td>
                    <td><?php echo $row["description"];?></td>
                    <td><?php echo $row["uid"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><form action="../frontend/details.php" method="get">
                        <input type="text" name="id" hidden value="<?php echo $row['id']; ?>">
                        <button class="btn">ViEW DETAILS</button>
                    </form></td>
                </tr>

                <?php
                }
            ?>
            </tbody>
        </table>
        <a href="../frontend/add_book.php"><button class="add">+</button></a>
    </div>
</body>
</html>
    <?php
  }
?>
