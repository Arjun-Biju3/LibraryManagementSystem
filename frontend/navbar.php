<nav>
    <div class="logo">
        <img src="../static/images/logo.png" alt="Logo">
        <div class="title">LIBRARY MANAGEMENT</div>
    </div>
    <div class="nav-options">
        <ul>
            <?php
                $status = isset($_SESSION["is_logged_in"]) ? $_SESSION["is_logged_in"] : false;
                if($status){
                    ?>
                    <li><a href="../frontend/home.php">HOME</a></li>
                    <li><a href="../frontend/book.php">BOOKS</a></li>
                    <li><a href="../frontend/students.php">STUDENTS</a></li>
                    <li><a href="../frontend/transactions.php">TRANSACTIONS</a></li>
                    <li><a href="../backend/logout.php">LOGOUT</a></li>
                    <?php        
                }
            ?>
        </ul>
    </div>
</nav>