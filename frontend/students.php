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
    <title>Students</title>
    <link rel="stylesheet" href="../static/css/index.css">
    <link rel="stylesheet" href="../static/css/search.css">
</head>
<body>
    <?php
        include '../frontend/navbar.php';
    ?>
    <div class="add-search-btn">
     <a href="../frontend/add_student.php"><button id="add-btn" class="add-btn">ADD STUDENT</button></a>
     <form action="" method="post">
        <input type="text" name="key" required placeholder="ADMISSION NUMBER">
        <button type="submit" id="search">SEARCH</button>
     </form>
    </div>
    <div class="book-details">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Admission Number</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../backend/connection.php';
                if(isset($_POST["key"]))
                {
                    $key = $_POST["key"];
                    $qry = "SELECT * FROM table_students WHERE admission_number='$key'";
                    $result = mysqli_query($conn,$qry);
                    if(mysqli_num_rows($result)<1)
                    {
                        ?>
                            <script>
                                alert("No Student Found");
                                window.location.href = "../frontend/students.php";
                            </script>
                        <?php
                    }
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <tr>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $row["admission_number"]; ?></td>
                    <td><?php echo $row["department"]; ?></td>
                    <td><?php echo $row["email"];?></td>
                    <td><?php echo $row["phone"]; ?></td>
                    <td><form action="../frontend/student_details.php" method="get">
                        <input type="text" name="id" hidden value="<?php echo $row['id']; ?>">
                        <button class="btn">ViEW DETAILS</button>
                    </form></td>
                </tr>
                <?php
                }
                else{
                $sql = "SELECT * FROM table_students";
                $res = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($res)){
                ?>
                    <tr>
                    <td><?php echo $row["name"];?></td>
                    <td><?php echo $row["admission_number"]; ?></td>
                    <td><?php echo $row["department"]; ?></td>
                    <td><?php echo $row["email"];?></td>
                    <td><?php echo $row["phone"]; ?></td>
                    <td><form action="../frontend/student_details.php" method="get">
                        <input type="text" name="id" hidden value="<?php echo $row['id']; ?>">
                        <button class="btn">ViEW DETAILS</button>
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
  }
?>
