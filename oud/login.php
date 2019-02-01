<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("dbcontroller.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
        
    require_once("dbcontroller.php");
    //$db_handle = new DBController();

    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

    $query = "SELECT * FROM PersoonMark WHERE username='$myusername'";
    $result = mysqli_query($conn,$query);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1)    {
        $error = "error";
        exit();
    }   else{
        if ($row = mysqli_fetch_assoc($result)) {
            $hashedPwdCheck = password_verify($mypassword, $row['password']);
            if ($hashedPwdCheck == false) {
                header
            }
        }
    }
    //$conn->insertQuery($query);
    
    
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    if($count == 0) {
        //session_register("myusername");
        $_SESSION['login_user'] = $myusername;
        echo $_SESSION['login_user'];
        header("location: index.php");
     }else {
        $error = "Your Login Name or Password is invalid";
     }
}
?>

<html>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">login</a></li>
        <li><a href="registration.php">register</a></li>
        <li><a href="logout.php">logout</a></li>
        <li><a href="passwordforgotten.php">password forgotten</a></li>
    </ul>

    <form action="login.php" method="post">
        Username: <input type = "text" name = "username" class = "box">
        Password: <input type = "text" name = "password" class = "box">
        <input type = "submit" value = " Log in "/>
    </form>
    <?php echo $error; ?>
</html>