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
            <title>Student Details</title>
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

                <div class="student-details-buttons">
                    <input type="text" hidden name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="update" class="book-btn book-btn-update">Upadte</button>
                    <button type="submit" name="delete" class="book-btn book-btn-delete" onclick="return confirm('Are you sure you want to delete this book?');">Delete</button>
                    <a href="../frontend/students.php" class="book-btn book-btn-back">Back</a>
                </div>
            </form>

            <div class="student-transactions">
                <center><h2>TRANSACTIONS</h2></center>
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Year of Publication</th>
                    <th>Description</th>
                    <th>UID Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
             <?php
                include '../backend/connection.php';
                $sql = "SELECT book_id,status FROM table_transactions WHERE student_id='$id'";
                $res = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($res)){
                    $book_id = $row["book_id"];
                    $qry = "SELECT * FROM table_books WHERE id='$book_id'";
                    $res1 = mysqli_query($conn,$qry);
                    while($row1 = mysqli_fetch_assoc($res1)){
                ?>
                    <tr>
                    <td><?php echo $row1["title"]; ?></td>
                    <td><?php echo $row1["author"]; ?></td>
                    <td><?php echo $row1["year_of_publication"]; ?></td>
                    <td><?php echo $row1["description"];?></td>
                    <td><?php echo $row1["uid"]; ?></td> 
                    <td><?php echo $row["status"]; ?></td>
                    </form></td>
                </tr>

                <?php
                }
            }
            ?> 
            </tbody>
        </table>
            </div>
        </body>
        </html>
<?php
    } else {
        ?>
        <script>
            alert('Student not found!');
            window.location.href='students.php';
        </script>
        <?php
    }
?>
