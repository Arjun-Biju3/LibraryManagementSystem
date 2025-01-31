<?php
    include '../backend/connection.php';
    session_start();
    $id = $_GET["id"]? $_GET["id"] : $_SESSION["id_of_student"] ;
    $sql = "SELECT * FROM table_students WHERE id = $id";
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
                    <form action="../backend/update_student.php" method="post">
                    <tr>
                        <th>Name</th>
                        <td><input type="text" name="name" value="<?php echo $row["name"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Admission Number</th>
                        <td><input type="text" name="admission_number" value="<?php echo $row["admission_number"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td><input type="text" name="department" value="<?php echo $row["department"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" name="email" value="<?php echo $row["email"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><input type="text" name="phone" value="<?php echo $row["phone"]; ?>"></td>
                    </tr>
                </table>

                <div class="book-details-buttons">
                    <input type="text" hidden name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update" class="book-btn book-btn-update">Upadte</button>
                    <button type="submit" name="delete" class="book-btn book-btn-delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                    <a href="../frontend/students.php" class="book-btn book-btn-back">Back</a>
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
