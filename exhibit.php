<?php require 'wrapper1.html'; ?>

<div class="container">
  <h1>Animals</h1>
  <table class="table">
    <thead class="thead-light"><tr>
      <th scope="col">Animal Name</th>
      <th scope="col">Type</th>
      <th scope="col">Population</th>
      <th scope="col">Region</th>
      <th scope="col">Operations</th>
    </tr></thead>
    <tbody>
      <?php
      require "dbutil.php";
      $db = DbUtil::loginConnection();
      $stmt = $db->stmt_init();

      if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $stmt = $db->stmt_init();
        if($stmt->prepare('SELECT animal_name, population, type, region FROM Animals NATURAL JOIN Part_of WHERE exhibit_name = \''.$_GET['name'].'\'') or die(mysqli_error($db))) {
          $stmt->execute();
          $stmt->bind_result($animal_name, $population, $type, $region);
          while($stmt->fetch()) {
            echo '<tr>
              <th scope="row">'.$animal_name.'</th>
              <td>'.$type.'</td>
              <td>
                '.$population.'
                <button
                  type="button"
                  class="btn btn-primary btn-sm"
                  style="float: right"
                  data-toggle="modal"
                  data-target="#adjust_pop"
                  onclick="setAnimal(\''.$animal_name.'\')"
                >Change</button>
                </td>
              <td>'.$region.'</td>
              <td>
                <a href="./delete_animals.php?name='.$animal_name.'&exhibit='.$_GET['name'].'" class="btn btn-danger">Delete Row</a>
              </td>
            </tr>';
          }
          $stmt->close(); 
        }
      }
      ?>
    </tbody>
  </table>
  
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add an Animal</button>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enter the animal information</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="./add_animal.php?exhibit=<?php echo $_GET['name']; ?>" method="POST">
            <div class="form-group">
              <label for="animal_name" class="col-form-label">Animal Name:</label>
              <input type="text" maxlength="255" class="form-control" id="animal_name" name="animal_name">
            </div>
            <div class="form-group">
              <label for="type" class="col-form-label">Animal Type:</label>
              <input type="text" maxlength="255" class="form-control" id="type" name="type">
            </div>
            <div class="form-group">
              <label for="population" class="col-form-label">Animal Population:</label>
              <input type="number" min="0" max="1000000000" class="form-control" id="population" name="population">
            </div>
            <div class="form-group">
              <label for="region" class="col-form-label">Animal Region:</label>
              <input type="text" maxlength="255" class="form-control" id="region" name="region">
            </div>
            <button type="submit" class="btn btn-success">Add Animal</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="adjust_pop" tabindex="-1" role="dialog" aria-labelledby="adjust_pop" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Population</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="./change_population.php?exhibit=<?php echo $_GET['name']; ?>" method="POST">
            <input type="hidden" id="animal_name_for_pop" name="animal_name" value="">
            <div class="form-group">
              <label for="population" class="col-form-label">Animal Population:</label>
              <input type="number" min="0" max="1000000000" class="form-control" id="population_for_pop" name="population">
            </div>
            <button type="submit" class="btn btn-success">Change</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  function setAnimal(animalName) {
    console.log("selecting", animalName)
    animalSelected = animalName;
    document.getElementById("animal_name_for_pop").value = animalSelected;
  }
  </script>

  <hr />

  <h1>Events</h1>
  <div class="card-deck">
    <?php
    $stmt = $db->stmt_init();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $stmt = $db->stmt_init();
      if($stmt->prepare('SELECT schedule_id, event_name, group_size, schedule_date, schedule_time FROM (Events NATURAL JOIN Has NATURAL JOIN Event_Schedule NATURAL JOIN Held_in) WHERE exhibit_name = \''.$_GET['name'].'\'') or die(mysqli_error($db))) {
        $stmt->execute();
        $stmt->bind_result($schedule_id, $event_name, $group_size, $schedule_date, $schedule_time);

        while($stmt->fetch()) {
          echo '<div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">'.$event_name.'</h5>
              <h6 class="card-subtitle mb-2 text-muted">Group size: '.$group_size.'</h6>
              <p class="card-text"> Date: '.$schedule_date.' <br /> Time: '.$schedule_time.' </p>
            </div>
          </div>';
        }
        $stmt->close(); 
      }
    }
    $db->close();
    ?>
  </div>

  <hr />

  <h1>Export Event Data To JSON</h1>
  <a href="./export_events.php?name=<?php echo $_GET['name'];?>" class="btn btn-primary">Export JSON</a>
</div>

<?php require 'wrapper2.html'; ?>
