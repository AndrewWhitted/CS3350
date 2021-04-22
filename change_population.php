<?php

require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $db->stmt_init();
  if($stmt->prepare('UPDATE Animals SET population = "'.$_POST['population'].'" WHERE animal_name = "'.$_POST['animal_name'].'" ') or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->close(); 
  }

}

header('Location: ./exhibit.php?name='.$_GET['exhibit']);

?>
