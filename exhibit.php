<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
<body>
    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        Bootstrap
      </a>
    </nav>
    
    
    <div class="container">
      <?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();

      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $db->stmt_init();
        if($stmt->prepare('SELECT * FROM animals NATURAL JOIN Part_Of WHERE exhibit_name = \''.$_GET['name'].'\'') or die(mysqli_error($db))) {
          $stmt->execute();
          $stmt->bind_result($animal_name, $pupulation, $type, $exhibit_name);

          while($stmt->fetch()) {
            echo '<div class="card" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">'.$animal_name.'</h5>
                <h6 class="card-subtitle mb-2 text-muted">'.$type.'</h6>
                <p class="card-text">'.$pupulation.'</p>
                <a href="#" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
              </div>
            </div>';
          }
          $stmt->close(); 
        }
      }
      $db->close();
      ?>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>