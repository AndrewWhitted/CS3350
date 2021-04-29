<?php
    require "dbutil.php";
    $db = DbUtil::loginConnection();

    $stmt = $db->stmt_init();

    if($stmt->prepare("SELECT * FROM Events NATURAL JOIN Has NATURAL JOIN Event_Schedule WHERE event_name like ?") or die(mysqli_error($db))) {
        $searchString = '%' . $_GET['filterEventName'] . '%';
        $stmt->bind_param(s, $searchString);
        $stmt->execute();
        $stmt->bind_result($schedule_id, $event_name, $group_size, $schedule_date, $schedule_time);
        echo '  <table class="table">
    
        <thead class="thead-light"><tr>
          <th scope="col">Event Name</th>
          <th scope="col">Group Size</th>
          <th scope="col">Schedule Date</th>
          <th scope="col">Schedule Time</th>
        </tr></thead>
        <tbody>';
        while ($stmt->fetch()) {
          echo '<tr>
          <th scope="row">'.$event_name.'</th>
          <td>'.$group_size.'</td>
          <td>
            '.$schedule_date.'
            </td>
          <td>'.$schedule_time.'</td>
        </tr>';
      }
        echo '</tbody></table>';
        $stmt->close();
        }
    // $db->close();

?>