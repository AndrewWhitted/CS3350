<?php
require "dbutil.php";
$db = DbUtil::loginConnection();
$stmt = $db->stmt_init();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $stmt = $db->stmt_init();
  if($stmt->prepare('DELETE FROM Part_of WHERE animal_name = ?') or die(mysqli_error($db))) {
    $stmt->bind_param('s', $_GET['name']);
    $stmt->execute();
    $stmt->close(); 
  }

  $stmt = $db->stmt_init();
  if($stmt->prepare('DELETE FROM Animals WHERE animal_name = ?') or die(mysqli_error($db))) {
    $stmt->bind_param('s', $_GET['name']);
    $stmt->execute();
    $stmt->close(); 
  }
}
$db->close();

header('Location: ./exhibit.php?name='.$_GET['exhibit']);

?>