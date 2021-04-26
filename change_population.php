<?php

require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $db->stmt_init();
  if($stmt->prepare('UPDATE Animals SET population = ? WHERE animal_name = ?') or die(mysqli_error($db))) {
    $stmt->bind_param('ss', $_POST['population'], $_POST['animal_name']);
    $stmt->execute();
    $stmt->close(); 
  }

}

header('Location: /exhibit.php?name='.$_GET['exhibit']);

?>
