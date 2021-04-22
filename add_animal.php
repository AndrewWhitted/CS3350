<?php

require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $stmt = $db->stmt_init();
  if($stmt->prepare('INSERT INTO Animals (animal_name, type, population, region) 
                      VALUES ("'.$_POST['animal_name'].'", "'.$_POST['type'].'", '.$_POST['population'].', "'.$_POST['region'].'")') or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->close(); 
  }

  $stmt = $db->stmt_init();
  if($stmt->prepare('INSERT INTO Part_of
                      VALUES ("'.$_POST['animal_name'].'", "'.$_GET['exhibit'].'")') or die(mysqli_error($db))) {
    $stmt->execute();
    $stmt->close(); 
  }
}

header('Location: ./exhibit.php?name='.$_GET['exhibit']);

?>
