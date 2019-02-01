<?php

if (isset($_POST['submit'])) {
    
    include 'dbh.inc.php';
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $pwdConfirm = mysqli_real_escape_string($conn, $_POST['pwd-confirm']);

    $options = [
        'salt' => "ULEobr!Q6sTxLWQ8%t489FfBAOGnu@)M82)Zi8MT",
        'cost' => 12 // the default cost is 10
    ];

    //Error handlers
    //Check for empty fields
    if (empty($name) || empty($email) || empty($pwd) || empty($pwdConfirm)) {
        header("Location: ../signup.php?signup=empty");
        exit(); 
    } else {
        if ($pwd != $pwdConfirm ) {
            header("Location: ../signup.php?signup=passwordsDontMatch");
            exit(); 
        } else {
            //Check if input character are valid
            if (!preg_match("/^[a-zA-Z]*$/", $name)) {
                header("Location: ../signup.php?signup=invalid");
                exit(); 
            }
            else {
                //Check if email is valid
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../signup.php?signup=email");
                    exit();  
                } else {
                    $sql = "SELECT * FROM UsersMark WHERE user_email='$email'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        header("Location: ../signup.php?signup=usertaken");
                        exit();
                    } else {
                        //Hashing the the password
                        //$hashedPwd = password_hash($pwd, );
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT, $options);
                        //Insert the user into the database
                        $sql = "INSERT INTO UsersMark (name, user_email, user_pwd) VALUES ('$name', '$email', '$hashedPwd');";
                        mysqli_query($conn, $sql);
                        header("Location: ../signup.php?signup=succes");
                        exit();
                    }
                }
                
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}