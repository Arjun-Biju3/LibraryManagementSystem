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
    <title>Books</title>
    <link rel="stylesheet" href="../static/css/index.css">
<style>
    .add-btn
    {
     width: 100px;
      
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
        gap:2px;
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
        height:33px;
    }
</style>
</head>
<body>
    <?php
        include '../frontend/navbar.php';
    ?>
     <div class="add-search-btn">
     <a href="../frontend/add_book.php"><button class="add-btn">ADD BOOK</button></a>
     <form action="" method="post">
        <input type="text" name="key" required placeholder="TITLE OF BOOK">
        <button type="submit" id="search">SEARCH</button>
     </form>
    </div>
    <div class="book-details">
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Year of Publication</th>
                    <th>Description</th>
                    <th>UID Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../backend/connection.php';
                if(isset($_POST["key"]))
                {
                    $key = $_POST["key"];
                    $qry = "SELECT * FROM table_books WHERE title='$key'";
                    $result = mysqli_query($conn,$qry);
                    if(mysqli_num_rows($result)<1)
                    {
                        ?>
                            <script>
                                alert("No Book Found");
                                window.location.href = "../frontend/book.php";
                            </script>
                        <?php
                    }
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <tr>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["year_of_publication"]; ?></td>
                    <td><?php echo $row["description"];?></td>
                    <td><?php echo $row["uid"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><form action="../frontend/details.php" method="get">
                        <input type="text" name="id" hidden value="<?php echo $row['id']; ?>">
                        <button class="btn">ViEW DETAILS</button>
                    </form></td>
                </tr>
                <?php
                }
                else{
                $sql = "SELECT * FROM table_books";
                $res = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($res)){
                ?>
                    <tr>
                    <td><?php echo $row["title"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["year_of_publication"]; ?></td>
                    <td><?php echo $row["description"];?></td>
                    <td><?php echo $row["uid"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><form action="../frontend/details.php" method="get">
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
