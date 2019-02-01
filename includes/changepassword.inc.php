<?php
    
// Was the form submitted?
if (isset($_POST["submit"]))
{
	include 'dbh.inc.php';

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$pwdConfirm = mysqli_real_escape_string($conn, $_POST['pwd-confirm']);
	$hash = $_POST["q"];

	$options = [
        'salt' => "ULEobr!Q6sTxLWQ8%t489FfBAOGnu@)M82)Zi8MT",
        'cost' => 12 // the default cost is 10
    ];

	// Use the same salt from the forgotpassword.inc.php file
	$salt = "ULEobr!Q6sTxLWQ8%t489FfBAOGnu@)M82)Zi8MT";

	// Generate the reset key
	$resetkey = hash('sha512', $salt.$email);

	// Does the new reset key match the old one?
	if ($resetkey == $hash)
	{
		if ($pwd == $pwdConfirm)
		{
			//has and secure the password
			//$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT, $options);

				$sql = "UPDATE UsersMark SET user_pwd = '".$hashedPwd."' WHERE user_email = '".$email."'";
				mysqli_query($conn, $sql);

				header("Location: ../index.php?resetpassword=succes");
				exit();
		}
		else {
			header("Location: ../index.php?resetpassword=passwordsDontMatch");
			exit();
		} 
	} else {
		header("Location: ../index.php?resetpassword=HashDontMatch");
		exit();	
	}
	echo "okee1";
} else {
	header("Location: ../index.php?resetpassword=error");
	exit();
}

?>