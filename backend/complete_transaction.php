<?php
include '../backend/connection.php';
session_start();
$student_id = $_POST["id"];
$book_id = $_SESSION["id_of_details"];
$today = date("Y-m-d");

$sql = "INSERT INTO table_transactions VALUES('','$book_id','$student_id','$today','','Issued')";
$qry = "UPDATE table_books SET status='Unavailable' WHERE id='$book_id'";
$res = mysqli_query($conn,$sql);
$res1 = mysqli_query($conn,$qry);
if($res && $res1)
{
    ?>
        <script>
            alert("Book Assigned Succesfully");
            window.location.href = '../frontend/details.php';
        </script>
    <?php
}
else
{
    ?>
        <script>
            alert("Book assignment failed");
            window.location.href = '../frontend/details.php';
        </script>
    <?php
}
?>