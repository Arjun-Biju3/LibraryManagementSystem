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
    <style>   
    .add-btn
    {
     width: 200px;
      
    }
    .book-details table
    {
        margin-top:30px;
    }
    .add-search-btn input
    {
        width: 200px;
        height:30px;
    }
    .add-search-btn form
    {
        display:flex;
        flex-direction:row;
    }
    .add-search-btn 
    {
        display:flex;
        flex-direction:row;
        gap:70px;
        margin-top:100px; 
        margin-left:80px; 
    }
    #search
    {
        width:100px;
        background-color:grey;
    }
    #search:hover
    {
        opacity:0.9;
    }
    .add-search-btn input{
        border:2px solid black;
        border-radius:5px;
    }
    </style>
</head>
<body>
    <?php
        include '../frontend/navbar.php';
    ?>
    <div class="add-search-btn">
     <a href="../frontend/add_book.php"><button id="add-btn" class="add-btn">ADD STUDENT</button></a>
     <form action="" method="post">
        <input type="text" name="key" placeholder="Admission Number">
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
