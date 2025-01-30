<?php
include '../backend/connection.php';

$title = $_POST["title"];
$author = $_POST["author"];
$year_of_publication = $_POST["year_of_publication"];
$description = $_POST["description"];
$uid = $_POST["uid"];
$status =$_POST["status"];

$sql = "INSERT INTO table_books VALUES('','$title','$author','$year_of_publication','$description','$uid','$status')";
$res = mysqli_query($conn,$sql);

if($res)
{
    ?>
        <script>
        alert("Book Added Succesfully");
        window.location.href = '../frontend/book.php';
        </script>
        
    <?php
}
else
{
    ?>
    <script>alert("Unable to add book");</script>
    <?php
}
?>