<?php
include '../backend/connection.php';
$id = $_POST["id"];
$fine = NULL;
if(isset($_POST["fine"])){
 $fine = $_POST["fine"];
}
$qry = "SELECT book_id FROM table_transactions WHERE id='$id'";
$result =mysqli_query($conn,$qry);
$item = mysqli_fetch_assoc($result);
$book_id = $item["book_id"];
$today = date("Y-m-d");
$qry2 ="UPDATE table_books SET status='Available' WHERE id='$book_id'";
$sql = "UPDATE table_transactions SET status='Returned',return_date='$today',fine='$fine' WHERE id='$id'";
$res = mysqli_query($conn,$sql);
$res2 = mysqli_query($conn,$qry2);
if($res && $res2){
    ?>
        <script>
            alert("Status changed Successfully");
            window.location.href = "../frontend/transactions.php";
        </script>
    <?php
}
else{
    ?>
        <script>
            alert("Unable to change status");
            window.location.href = "../frontend/transactions.php";
        </script>
    <?php
}

?>
