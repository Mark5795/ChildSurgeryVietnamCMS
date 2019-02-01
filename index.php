<?php
  include_once 'header.php';
?>
    
    <section class="main-container">
        <div class="main-wrapper">
          <h2>Home</h2>
          <?php
            if (isset($_SESSION['u_id'])) {

              include 'includes/dbh.inc.php';

              $sql = "SELECT * FROM UsersMark WHERE user_id='".$_SESSION['u_id']."'";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck < 1) {
                echo 'failed';
                exit();
              } else {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                echo "Id: " . $row["user_id"]. "<br> Name: " . $row["name"]. "<br> Email: " . $row["user_email"]. "<br> Points: "  . $row["user_points"]."";
                }
              }
            }
          ?>
        </div>
    </section>

<?php
  include_once 'footer.php';
?>