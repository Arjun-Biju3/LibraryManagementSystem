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
</head>
<body>
    <?php
        include '../frontend/navbar.php';
    ?>
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
                $sql = "SELECT * FROM table_students";
                $res = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($res)){
                ?>
                    <tr>
                    <td><?php echo $row["name"]; ?></td>
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
            ?>
            </tbody>
        </table>
        <a href=""><button class="add">+</button></a>
    </div>
</body>
</html>
    <?php
  }
?>
