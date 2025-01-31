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
    <title>Transactions</title>
    <link rel="stylesheet" href="../static/css/index.css">
</head>
<body>
    <?php
        include '../frontend/navbar.php';
    ?>
    <div class="book-details">
        <table id="transaction">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>UID Number</th>
                    <th>STUDENT</th>
                    <th>ADMISSION NUMBER</th>
                    <th>Issued Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../backend/connection.php';
                $sql = "SELECT * FROM table_transactions";
                $res = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($res)){
                    $book_id = $row["book_id"];
                    $student_id = $row["student_id"];
                    $qry = "SELECT * FROM table_books WHERE id='$book_id'";
                    $res1 = mysqli_query($conn,$qry);
                    while($row1 = mysqli_fetch_assoc($res1)){
                        $qry2 = "SELECT * FROM table_students WHERE id='$student_id'";
                        $res2 = mysqli_query($conn,$qry2);
                        while($row2 = mysqli_fetch_assoc($res2))
                        {
                            ?>
                                <tr>
                                    <td><?php echo $row1["title"]; ?></td>
                                    <td><?php echo $row1["uid"]; ?></td>
                                    <td><?php echo $row2["name"]; ?></td>
                                    <td><?php echo $row2["admission_number"];?></td>
                                    <td><?php echo $row["issued_date"];?></td>
                                    <td><?php echo $row["return_date"];?></td>
                                    <td><?php echo $row["status"]; ?></td>
                                    <td>
                                        <?php
                                            if($row["status"] != "Returned")
                                            {
                                                ?>
                                                <form action="../backend/change_transaction_status.php" method="post">
                                                <input type="text" name="id" hidden value="<?php echo $row['id']; ?>">
                                                <button id="return-btn" class="btn" type="submit" onclick="return confirm('Do you want to change status?');">RETURN</button>
                                                </form>
                                                <?php
                                            }
                                            else
                                            {
                                                echo "Not Applicable";
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                ?>

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
  }
?>
