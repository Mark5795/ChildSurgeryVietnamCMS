<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<html>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="login.php">login</a></li>
        <li><a href="registration.php">register</a></li>
        <li><a href="logout.php">logout</a></li>
        <li><a href="passwordforgotten.php">password forgotten</a></li>
    </ul>

    <?php if(!empty($success_message)) { ?>	
        <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
        <?php } ?>
        <?php if(!empty($error_message)) { ?>	
        <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
	<?php } ?>

    <form action="registration.php" method="post">
        Name: <input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>"><br>
        E-mail: <input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>"><br>
        Password: <input type="password" name="password" value=""><br>
        Confirm password: <input type="password" name="confirm_password" value=""><br>
        <input type="submit">
    </form>
</html>


<?php
        /* Form Required Field Validation */
    foreach($_POST as $key=>$value) {
        if(empty($_POST[$key])) {
        $error_message = "All Fields are required";
        break;
        }
    }
    
    /* Password Matching Validation */
    if($_POST['password'] != $_POST['confirm_password']){ 
        $error_message = 'Passwords should be same<br>'; 
    }
    
        /* Email Validation */
    if(!isset($error_message)) {
        if (!filter_var($_POST["username"], FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid Email Address";
        }
    }     
        
        if(!isset($error_message)) {
            require_once("dbcontroller.php");
            $db_handle = new DBController();
            //session_start();
            $query = "INSERT INTO PersoonMark (name, username, password) VALUES
            ('" . $_POST["name"] . "', '" . $_POST["username"] . "', '" . $_POST["password"] . "')";
            $db_handle->insertQuery($query);
            echo "Registreren gelukt!";
        }

?>