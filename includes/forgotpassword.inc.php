<?php

if (isset($_POST['submit'])) {

    include 'dbh.inc.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $salt = "ULEobr!Q6sTxLWQ8%t489FfBAOGnu@)M82)Zi8MT";

    //Error handlers
    //Check if input are empty
    if (empty($email)) {
        header("Location: ../index.php?email=empty");
        exit();
    } else {
        //Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../index.php?email=error");
            exit();  
        } else {
                $sql = "SELECT * FROM UsersMark WHERE user_email='$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck < 1) {
                    header("Location: ../index.php?email=error");
                    exit();
                } else {
                    if ($row = mysqli_fetch_assoc($result)) {                    
                    // Create the unique user password reset key
                    $hashedPwd = hash('sha512', $salt.$email);

                    // Create a url which we will direct them to reset their password
                    $pwrurl = "www.sm2018a4.infhaarlem.nl/mark/resetpassword.php?q=".$hashedPwd;

                    // Mail them their key
                    $mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it.
                     It appears that you have requested a password reset at our website www.sm2018a4.infhaarlem.nl\n\nTo
                      reset your password, please click the link below. If you cannot click it, please paste it
                       into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nThe Administration";

                    mail($email, "www.sm2018a4.infhaarlem.nl - Password Reset", $mailbody);
                    header("Location: ../index.php?email=succes");
                    } else {                        
                        header("Location: ../index.php?email=error");
                        exit();
                    }
                }
            }
        }
    } else {
        header("Location: ../index.php?email=error");
        exit();
    }
?>