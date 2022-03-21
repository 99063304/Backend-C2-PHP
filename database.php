<?php
function opendatabase()
{
try {
  $conn = new PDO('mysql:host=localhost;dbname=databank', 'root', 'mysql');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $conn;
}catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
}

 ?>
