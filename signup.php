<?php
  include_once 'header.php';
?>    
    <section class="main-container">
        <div class="main-wrapper">
          <h2>Signup</h2>
          <form class="signup-form" action="includes/signup.inc.php" method="POST">
              <input type="text" name="name" placeholder="Name">
              <input type="text" name="email" placeholder="Email">
              <input type="password" name="pwd" placeholder="Password">
              <input type="password" name="pwd-confirm" placeholder="Confirm password">
              <button type="submit" name="submit">Sign up</button>
          </form>
        </div>
    </section>

<?php
  include_once 'footer.php';
?>