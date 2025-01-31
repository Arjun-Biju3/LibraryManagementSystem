<?php
    include '../backend/connection.php';
    session_start();
    $id = $_POST['id'];
    $title = $_POST["title"];
    $author = $_POST['author'];
    $yop = $_POST['yop'];
    $description = $_POST['description'];

   if(isset($_POST['update']))
   {
    $sql = "UPDATE table_books SET title='$title',author='$author',year_of_publication='$yop',description='$description' WHERE id='$id'";
    $res = mysqli_query($conn,$sql);
    if($res){
        // $_SESSION["id_of_details"]=$id;
        ?>
            <script>
            alert("Details updated successfully");
            window.location.href='../frontend/details.php';
            </script>
        <?php
    }
   }

   if(isset($_POST['delete']))
   {
    $sql = "DELETE FROM table_books WHERE id='$id'";
    $res = mysqli_query($conn,$sql);
    if($res){
        ?>
            <script>
                alert("Deleted successfully");
                window.location.href = '../frontend/book.php';
            </script>
        <?php
    }
   }
?>