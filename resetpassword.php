<?php
  include_once 'header.php';
?>    
    <section class="main-container">
        <div class="main-wrapper">
          <h2>Reset your password!</h2>
          <p>Fill in the form to get a new password!</p>
          <?php echo '
          <form class="resetpassword-form" action="includes/resetpassword.inc.php" method="POST">
			      <input type="text" name="email" placeholder="Email">
			      <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-confirm" placeholder="Confirm password">
			      <input type="hidden" name="q" value="';
			      if (isset($_GET["q"])) {
					  echo $_GET["q"];
				    }
				    echo '" /><input type="submit" name="submit" value=" Change Password " />
          </form>';
          ?>
        </div>
    </section>

<?php
  include_once 'footer.php';
?>
