<?php require 'wrapper3.html'; ?>
    
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

    if($stmt->prepare("SELECT animal_name, population, type, region FROM Animals where animal_name like ?") or die(mysqli_error($db))) {
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
          $db->close();
        }
      ?>
          
    </tbody>
    </table>
  </div>

  <hr />




<?php require 'wrapper2.html'; ?>

