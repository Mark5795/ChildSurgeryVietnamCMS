<?php

    if (isset($_POST['submit'])) {
        session_start();
        $_SESSION['u_id']=null;
        header("Location: ..//index.php");
        exit();
    }
?>