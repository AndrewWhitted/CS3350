<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sth = mysqli_query($db, 'SELECT event_name, group_size, schedule_date, schedule_time 
                        FROM (Events NATURAL JOIN Has NATURAL JOIN Event_Schedule NATURAL JOIN Held_in)
                        WHERE exhibit_name = "'.$_GET['name'].'"');
    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    $textToWrite = json_encode($rows);
    $file = "event-data.json";
    file_put_contents($file, $textToWrite);

    header("Content-type: text/plain");
    header("Content-Disposition: attachment; filename={$file}");
    readfile($file);
}
?>