<?php
include '../backend/connection.php';
session_start();
session_unset();
session_destroy();
mysqli_close($conn);
header("Location: ../frontend/index.php");
exit();
?>