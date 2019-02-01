<?php

session_start();

if (isset($_POST['submit'])) {

    include 'dbh.inc.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $salt = "ULEobr!Q6sTxLWQ8%t489FfBAOGnu@)M82)Zi8MT";

    //Error handlers
    //Check if input are empty
    if (empty($email) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM UsersMark WHERE user_email='$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                //$hashedPwdInput = hash('sha512', $salt.$pwd);
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);

                if ($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    //Log in the user here
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_name'] = $row['name'];
                    $_SESSION['u_email'] = $row['user_email'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
        }
    }
    } else {
        header("Location: ../index.php?login=error");
        exit();
    }
?>