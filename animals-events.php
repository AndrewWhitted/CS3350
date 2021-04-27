<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Hello, world!</title>
    <!-- <script src="js/jquery-1.6.2.min.js" type ="text/javascript"></script>
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
                $( "#animalInput" ).change(function() {
                    $.ajax({
                        url: 'filterAnimalName.php',
                        data: {filterAnimalName: $( "#animalInput" )}.val()},
                        success: function(data){
                            $( '#filterAnimalNameResult' ).html(data);
                        }
                    });
                });
            });

        </script> -->
  </head>
  <style>
  .container h1 {
    margin-top: 2rem;
  }
  </style>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="./dashboard.php">
          A Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        </div>
      <!-- </div> -->
    </nav>
    
<div class="container">
  <h1>Animals</h1>
  <input class = "xlarge" id="animalInput" type="search" size="28" placeholder="Animal Search"/>
  <!-- <div id="filterAnimalNameResult"> -->
  <table class="table">
    
    <thead class="thead-light"><tr>
      <th scope="col">Animal Name</th>
      <th scope="col">Type</th>
      <th scope="col">Population</th>
      <th scope="col">Region</th>
    </tr></thead>
    <tbody>
    <?php
    require_once "dbutil.php";
    $db = DbUtil::loginConnection();

    $stmt = $db->stmt_init();

    if($stmt->prepare("SELECT * FROM Animals where animal_name like ?") or die(mysqli_error($db))) {
        $searchString = '%' . $_GET['filterAnimalName'] . '%';
        $stmt->bind_param(s, $searchString);
        $stmt->execute();
        $stmt->bind_result($animal_name, $population, $type, $region);

        while ($stmt->fetch()) {
            echo '<tr>
            <th scope="row">'.$animal_name.'</th>
            <td>'.$type.'</td>
            <td>
              '.$population.'
              </td>
            <td>'.$region.'</td>
          </tr>';
        }
        $stmt->close();
        }
    $db->close();

?>
    </tbody>
  </table>
    <!-- </div> -->
    </div>
</div>

  <hr />

  <div class="container">
    <h1>Events</h1>
    <table class="table">
    <thead class="thead-light"><tr>
      <th scope="col">Event Name</th>
      <th scope="col">Group Size</th>
      <th scope="col">Schedule Date</th>
      <th scope="col">Schedule Time</th>
        </tr></thead>
        <tbody>
        <?php
                // require "dbutil.php";
                $db = DbUtil::loginConnection();
                $stmt = $db->stmt_init();
                if (mysqli_connect_errno()) {
                    echo("Can't connect to MySQL Server. Error code: " .
                    mysqli_connect_error());
                    return null;
                    }
                if($stmt->prepare('SELECT schedule_id, event_name, group_size, schedule_date, schedule_time FROM (Events NATURAL JOIN Has NATURAL JOIN Event_Schedule)') or die(mysqli_error($db))) {
                    $stmt->execute();
                    $stmt->bind_result($schedule_id, $event_name, $group_size, $schedule_date, $schedule_time);
                
                    while($stmt->fetch()) {
                        
                        echo '<tr>
                        <th scope="row">'.$event_name.'</th>
                        <td>'.$group_size.'</td>
                        <td>
                        '.$schedule_date.'
                        </td>
                    <td>'.$schedule_time.'</td>
                    </tr>';
                    }
                $stmt->close();
        }
      ?>
          
    </tbody>
    </table>
  </div>

  <hr />




<?php require 'wrapper2.html'; ?>

