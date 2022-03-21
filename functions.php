<?php
require 'database.php';
function getLists(){
    $conn = opendatabase();
    $query = 'SELECT * FROM `lijsten`';
    $result = $conn->prepare($query);
    $result->execute();
    return $result->fetchAll();
}
function getTask($id,$sorter,$third){
  echo $third;
  if ($third == 'null') {
          $conn = opendatabase();
            if ($sorter == '1') {
              $query = 'SELECT * FROM `taken` WHERE `lijst_id` = :id ORDER BY `duur` ASC' ;
            }else {
              $query = 'SELECT * FROM `taken` WHERE `lijst_id` = :id ORDER BY `duur` DESC' ;
            }
          $result = $conn->prepare($query);
          $result->bindParam(':id',$id);
          $result->execute();
  } else {
          $conn = opendatabase();
          if ($sorter == '1') {
            $query = 'SELECT * FROM `taken` WHERE `lijst_id` = :id  AND `status` = :colum ORDER BY `duur` ASC' ;
          }else {
            $query = 'SELECT * FROM `taken` WHERE `lijst_id` = :id  AND `status` = :colum ORDER BY `duur` DESC' ;
          }

          $result = $conn->prepare($query);
          $result->bindParam(':id',$id);
          $result->bindParam(':colum',$third);

          $result->execute();
  }
            return $result->fetchAll();
}
function createList($naam){
  $conn = opendatabase();
  $query = 'INSERT INTO `lijsten` (`lijst_id`, `naam`) VALUES (null, :naam)';
  $result = $conn->prepare($query);
  $result->bindParam(':naam',$naam);
  $result->execute();
}
function deleteList($id){
  $conn = opendatabase();
  $query = 'DELETE FROM `lijsten` WHERE `lijsten`.`lijst_id` = :id';
  $result = $conn->prepare($query);
  $result->bindParam(':id',$id);
  $result->execute();
}
function addTask($id,$naam){
  $conn = opendatabase();
  $query = 'INSERT INTO `taken`(`lijst_id`, `taak_id`, `taak`, `status`, `duur`) VALUES (:id,null,:naam,"","")';
  $result = $conn->prepare($query);
  $result->bindParam(':id',$id);
  $result->bindParam(':naam',$naam);
  $result->execute();
}
function deleteTask($id){
  $conn = opendatabase();
  $query = 'DELETE FROM `taken` WHERE `taken`.`taak_id` = :id';
  $result = $conn->prepare($query);
  $result->bindParam(':id',$id);
  $result->execute();
}
function saveTask($id,$task,$duure,$statuss){
  $conn = opendatabase();
  $query = 'UPDATE `taken` SET `taak` = :taak, `duur` = :duur, `status` = :status  WHERE `taken`.`taak_id` = :id';
  $result = $conn->prepare($query);
  $result->bindParam(':taak',$task);
  $result->bindParam(':id',$id);
  $result->bindParam(':duur',$duure);
  $result->bindParam(':status',$statuss);
  $result->execute();
}
function saveListName($id,$name){
  $conn = opendatabase();
  $query = 'UPDATE `lijsten` SET `naam` = :naam WHERE `lijsten`.`lijst_id` = :id';
  $result = $conn->prepare($query);
  $result->bindParam(':naam',$name);
  $result->bindParam(':id',$id);
  $result->execute();
}
 ?>
