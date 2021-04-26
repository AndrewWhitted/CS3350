<?php

require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $db->stmt_init();
  if($stmt->prepare('INSERT INTO Animals (animal_name, type, population, region)
                     VALUES (?, ?, ?, ?)') or die(mysqli_error($db))) {
    $stmt->bind_param('ssis', $_POST['animal_name'], $_POST['type'], $_POST['population'], $_POST['region']);
    $stmt->execute();
    $stmt->close(); 
  }

  $stmt = $db->stmt_init();
  if($stmt->prepare('INSERT INTO Part_of
                     VALUES (?, ?)') or die(mysqli_error($db))) {
    $stmt->bind_param('ss', $_POST['animal_name'], $_GET['exhibit']);
    $stmt->execute();
    $stmt->close(); 
  }
}

header('Location: /exhibit.php?name='.$_GET['exhibit']);

?>
