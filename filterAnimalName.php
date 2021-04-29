<?php
    require_once "dbutil.php";
    $db = DbUtil::loginConnection();

    $stmt = $db->stmt_init();

    if($stmt->prepare("SELECT * FROM Animals where animal_name like ?") or die(mysqli_error($db))) {
        $searchString = '%' . $_GET['filterAnimalName'] . '%';
        $stmt->bind_param(s, $searchString);
        $stmt->execute();
        $stmt->bind_result($animal_name, $population, $type, $region);
        echo '  <table class="table">
    
        <thead class="thead-light"><tr>
          <th scope="col">Animal Name</th>
          <th scope="col">Population</th>
          <th scope="col">Type</th>
          <th scope="col">Region</th>
        </tr></thead>
        <tbody>';
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
        echo '</tbody></table>';
        $stmt->close();
        }
    // $db->close();

?> 