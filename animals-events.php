<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
    <script src="js/jquery-1.6.2.min.js" type ="text/javascript"></script>
    <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php
    require "dbutil.php";
    $db = DbUtil::loginConnection();
    $stmt = $db->stmt_init();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
        header("location: ./login.php");
        exit;
    }
    $db->close();
?>
    
    
    <title>Aquarium</title>
    
    <script>
      $(document).ready(function() {
          $( "#eventInput" ).change(function() {

              // e.preventDefault();

              $.ajax({
                  url: 'filterEventName.php',
                  
                  data: {filterEventName: $( "#eventInput" ).val()},
                  success: function(data){
                      $('#filterEventNameResult').html(data);
                  }
              });
          });
      });

  </script>
        <script>
            $(document).ready(function() {
                $( "#animalInput" ).change(function() {

                    // e.preventDefault();

                    $.ajax({
                        url: 'filterAnimalName.php',
                        
                        data: {filterAnimalName: $( "#animalInput" ).val()},
                        success: function(data){
                            $('#filterAnimalNameResult').html(data);
                        }
                    });
                });
            });

        </script>

  </head>
  <style>
  .container h1 {
    margin-top: 2rem;
  }
  </style>

    <?php require 'wrapper3.html'; ?>

<div class="container">
  <h1>Animals</h1>
  <input class = "xlarge" id="animalInput" type="search" size="28" placeholder="Animal Search"/>
  <!-- <button type="button" id="animalInput">Sort By Animal</button> -->
  <div id="filterAnimalNameResult">
    </div>

</div>

  <hr />

  <div class="container">
    <h1>Events</h1>
    <input class = "xlarge" id="eventInput" type="search" size="28" placeholder="Event Search"/>
    <div id="filterEventNameResult">
    </div>

        <?php
                require "dbutil.php";
                $db = DbUtil::loginConnection();
                $stmt = $db->stmt_init();
                if (mysqli_connect_errno()) {
                    echo("Can't connect to MySQL Server. Error code: " .
                    mysqli_connect_error());
                    return null;
                    }
                if($stmt->prepare('SELECT schedule_id, event_name, group_size, schedule_date, schedule_time FROM (Events NATURAL JOIN Has NATURAL JOIN Event_Schedule)') or die(mysqli_error($db))) {
                    $stmt->execute();
                    $stmt->bind_result($a, $b, $c, $d, $e);
                
                    while($stmt->fetch()) {
                        
                        echo '<tr>
                        <th scope="row">'.$b.'</th>
                        <td>'.$c.'</td>
                        <td>
                        '.$d.'
                        </td>
                    <td>'.$e.'</td>
                    </tr>';
                    }
                $stmt->close();
        }
      ?>

  </div>

  <hr />



