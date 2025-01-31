<?php
    include '../backend/connection.php';
    session_start();
    $id = $_POST['id'];
    $name = $_POST["name"];
    $admission_number = $_POST['admission_number'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

   if(isset($_POST['update']))
   {
    $sql = "UPDATE table_students SET name='$name',admission_number='$admission_number',department='$department',email='$email',phone='$phone' WHERE id='$id'";
    $res = mysqli_query($conn,$sql);
    if($res){
        $_SESSION["id_of_student"]=$id;
        ?>
            <script>
            alert("Details updated successfully");
            window.location.href='../frontend/student_details.php';
            </script>
        <?php
    }
   }

   if(isset($_POST['delete']))
   {
    $sql = "DELETE FROM table_students WHERE id='$id'";
    $res = mysqli_query($conn,$sql);
    if($res){
        ?>
            <script>
                alert("Deleted successfully");
                window.location.href = '../frontend/students.php';
            </script>
        <?php
    }
   }
?>