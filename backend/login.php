<?php
    include '../backend/connection.php';
    session_start();

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM table_admins WHERE username = '$username'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_array($result);

        if($row["password"] == "$password"){
            $_SESSION["is_logged_in"] = true;
            ?>
                <script>
                    alert("Welcome <?php echo $username; ?> ");
                    window.location.href = '../frontend/home.php';
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    alert("Incorrect Password");
                    window.location.href = '../frontend/index.php';
                </script>
            <?php
        }
    }
    else{
        ?>
        <script>
            alert("NO USER FOUND!");
            window.location.href = '../frontend/index.php';
        </script>
        <?php
    }
?>