<?php
    include '../backend/connection.php';
    session_start();
    $id = $_GET["id"]? $_GET["id"] : $_SESSION["id_of_details"] ;
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
                        <td><input type="text" name="title" value="<?php echo htmlspecialchars($row["title"]); ?>"></td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><input type="text" name="author" value="<?php echo htmlspecialchars($row["author"]); ?>"></td>
                    </tr>
                    <tr>
                        <th>Year of Publication</th>
                        <td><input type="text" name="yop" value="<?php echo htmlspecialchars($row["year_of_publication"]); ?>"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input type="text" name="description" value="<?php echo htmlspecialchars($row["description"]); ?>"></td>
                    </tr>
                    <tr>
                        <th>Unique ID</th>
                        <td><?php echo htmlspecialchars($row["uid"]); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?php echo htmlspecialchars($row["status"]); ?></td>
                    </tr>
                </table>

                <div class="book-details-buttons">
                    <input type="text" hidden name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update" class="book-btn book-btn-update">Upadte</button>
                    <button type="submit" name="delete" class="book-btn book-btn-delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                    <a href="../frontend/book.php" class="book-btn book-btn-back">Back</a>
                </div>
            </form>
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
