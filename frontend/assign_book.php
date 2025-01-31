<?php
    include '../backend/connection.php';
    session_start();
    $admission_number = $_POST["admission_number"];
    $sql = "SELECT * FROM table_students WHERE admission_number ='$admission_number'";
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
                    <form action="../backend/complete_transaction.php" method="post">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $row["name"]; ?></td>
                    </tr>
                    <tr>
                        <th>Admission Number</th>
                        <td><?php echo $row["admission_number"]; ?></td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td><?php echo $row["department"]; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $row["email"]; ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $row["phone"]; ?></td>
                    </tr>
                </table>

                <div class="student-details-buttons">
                    <input type="text" hidden name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="assign-book" class="book-btn book-btn-update">Assign</button>
                    <a href="../frontend/details.php" class="book-btn book-btn-back">Back</a>
                </div>
            </form>
        </body>
        </html>
<?php
    } else {
        ?>
        <script>
            alert('Student not found!');
            window.location.href='details.php';
        </script>
        <?php
    }
?>
