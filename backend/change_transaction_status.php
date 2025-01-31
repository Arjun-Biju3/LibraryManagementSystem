<?php
include '../backend/connection.php';
$id = $_POST["id"];

$sql = "UPDATE table_transactions SET status='Returned' WHERE id='$id'";
$res = mysqli_query($conn,$sql);
if($res){
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
