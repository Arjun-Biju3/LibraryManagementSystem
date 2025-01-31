<?php
    include '../backend/connection.php';
    $name = $_POST["name"];
    $admission_number = $_POST['admission_number'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    $sql = "INSERT INTO table_students VALUES('','$name','$admission_number','$department','$email','$phone')";
    $res = mysqli_query($conn,$sql);
    if($res){
        $_SESSION["id_of_student"]=$id;
        ?>
            <script>
            alert("Added student successfully");
            window.location.href='../frontend/students.php';
            </script>
        <?php
    }
    else{
        ?>
            <script>
            alert("unable to add student");
            window.location.href='../frontend/students.php';
            </script>
        <?php
    }
    
?>