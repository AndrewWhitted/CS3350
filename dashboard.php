
<?php require 'wrapper1.html'; ?>

    <div class="container">
      <h1>Exhibits</h1>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
        <?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();
        $stmt = $db->stmt_init();
        session_start();
        $username = $_SESSION['username'];
        if (!isset($_SESSION['username']))
	{
    		header("Location: login.php");
    		die();
	}
        if($stmt->prepare("SELECT * FROM Exhibit") or die(mysqli_error($db))) {
          $stmt->execute();
          $stmt->bind_result($exhibit_name, $details);
          while($stmt->fetch()) {
            echo '<a href="exhibit.php?name='.$exhibit_name.'">
              <div class="col">
                '.$exhibit_name.'
              </div>
            </a>';
          }
          $stmt->close();
        }
        $db->close();
        ?>
      </div>
    </div>


<?php require 'wrapper2.html'; ?>
