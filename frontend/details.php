<?php
    include '../backend/connection.php';
    session_start();
    $id = $_GET["id"]? $_GET["id"] : $_SESSION["id_of_details"] ;
    $_SESSION["id_of_details"] = $id;
    $sql = "SELECT * FROM table_books WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Book Details</title>
            <link rel="stylesheet" href="../static/css/index.css"> 
            <link rel="stylesheet" href="../static/css/details.css"> 
        </head>
        <body>
            <?php include '../frontend/navbar.php'; ?>
            
                <table class="book-details-table">
                    <form action="../backend/update_book.php" method="post">
                    <tr>
                        <th>Title</th>
                        <td><input type="text" name="title" value="<?php echo $row["title"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><input type="text" name="author" value="<?php echo $row["author"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Year of Publication</th>
                        <td><input type="text" name="yop" value="<?php echo $row["year_of_publication"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input type="text" name="description" value="<?php echo $row["description"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Unique ID</th>
                        <td><?php echo $row["uid"]; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php 
                            echo $row["status"]; 
                            ?>
                        </td>
                    </tr>
                </table>

                <div class="book-details-buttons">
                   <div class="book-details-operations">
                   <input type="text" hidden name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update" class="book-btn book-btn-update">Upadte</button>
                    <button type="submit" name="delete" class="book-btn book-btn-delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                    <a href="../frontend/book.php" class="book-btn book-btn-back">Back</a>
                    </form>
                  </div>
                    
                  <?php
                        if($row['status'] == "Available")
                        {
                            ?>
                            <div class="assign-book">
                                <form action="../frontend/assign_book.php" method="post">
                                <input type="text" name="admission_number" required placeholder="Admission Number">
                                <a href="#details"><button type="submit" name="assign" class="book-btn book-btn-update">Assign Book</button></a>
                                </form>
                            </div>
                            <?php
                        }
                ?>
                </div>
        </body>
        </html>
<?php
    } else {
        ?>
        <script>
            alert('Book not found!');
            window.location.href='book.php';
        </script>
        <?php
    }
?>
