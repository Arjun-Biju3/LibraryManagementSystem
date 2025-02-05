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
    <link rel="stylesheet" href="../static/css/search.css">
</head>
<body>
    <?php
        include '../frontend/navbar.php';
    ?>
    <div class="add-search-btn">
     <form action="" method="post">
        <input type="text" name="key" required placeholder="ADMISSION NUMBER">
        <button type="submit" id="search">SEARCH</button>
     </form>
    </div>
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
                    <th>Fine</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../backend/connection.php';
                if(isset($_POST["key"])){
                    $key =$_POST["key"];
                    $search_qry = "SELECT * FROM table_students WHERE admission_number='$key'";
                    $search_result = mysqli_query($conn,$search_qry);
                    if($search_result && mysqli_num_rows($search_result) > 0)
                    {
                       while( $searched_item = mysqli_fetch_assoc($search_result))
                       {
                            $a =$searched_item["id"];
                            $fetch_qry = "SELECT * FROM table_transactions WHERE student_id='$a'";
                            $fetch_res =mysqli_query($conn,$fetch_qry);
                            if($fetch_res && mysqli_num_rows($fetch_res)>0)
                            {
                                while($fetched_item = mysqli_fetch_assoc($fetch_res))
                                {
                                    $book_id = $fetched_item["book_id"];
                                    $fetch_book_qry = "SELECT * FROM table_books WHERE id='$book_id'";
                                    $fetch_book_res = mysqli_query($conn,$fetch_book_qry);
                                    while($book = mysqli_fetch_assoc($fetch_book_res))
                                    {
                                        ?>
                                    <tr>
                                    <td><?php echo $book["title"]; ?></td>
                                    <td><?php echo $book["uid"]; ?></td>
                                    <td><?php echo $searched_item["name"]; ?></td>
                                    <td><?php echo $searched_item["admission_number"];?></td>
                                    <td><?php echo $fetched_item["issued_date"];?></td>
                                    <td><?php echo $fetched_item["return_date"];?></td>
                                    <td><?php echo $fetched_item["status"]; ?></td>
                                    <td>
                                        <?php
                                            if($fetched_item["status"] != "Returned")
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
                                    
                                }
                            }
                            else
                            {
                                ?>
                                    <script>
                                        alert("No transcation found");
                                        window.location.href ="../frontend/transactions.php";
                                    </script>  
                                <?php
                            }
                       }
                    }
                    else
                    {
                        ?>
                            <script>
                                alert("No student found");
                                window.location.href ="../frontend/transactions.php";
                            </script>
                        <?php
                    }
                }
                else{
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
                            
                                    $issued_date = strtotime($row["issued_date"]);
                                    $todays_date = date("Y-m-d");
                                    $today = strtotime($todays_date);
                                    $gap = $today - $issued_date;
                                    $diff = round($gap / (60 * 60 * 24));
                                    
                                   
                                    if ($diff <= 10) {
                                        echo "NO fines";
                                    } else {
                                        $days_overdue = $diff - 10; 
                                        $fine = pow(2, $days_overdue - 1); 
                                        echo $fine;
                                    }
                                    ?>
                                    

                                    </td>
                                    <td>
                                        <?php
                                            if($row["status"] != "Returned")
                                            {
                                                ?>
                                                <form action="../backend/change_transaction_status.php" method="post">
                                                <input type="text" hidden name="fine" value="<?php echo $fine; ?>">
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
