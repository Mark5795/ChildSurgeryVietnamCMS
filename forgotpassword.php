<?php
  include_once 'header.php';
?>    
    <section class="main-container">
        <div class="main-wrapper">
          <h2>Password forgotten?</h2>
          <p>We send you a link to reset your password!</p>
          <form class="forgotpassword-form" action="includes/forgotpassword.inc.php" method="POST">
              <input type="text" name="email" placeholder="Email">
              <button type="submit" name="submit">Send Email</button>
          </form>
        </div>
    </section>

<?php
  include_once 'footer.php';
?>