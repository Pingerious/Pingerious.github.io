<?php
include 'dbconnect.php';

// function insertSubject(){
//   $conn = dbConnect();
//   $sql = "INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES ($subject_name)";

//   if($conn->query($sql)){
//     header("location:study_record.php");
//     exit;
//   } else {
//     die("Error!" . $conn->error);
//   }
// }

function displayAllSubject(){
  $conn = dbconnect();
  $sql = "SELECT * FROM `subject` WHERE subject_id = 1";

    if($result = $conn->query($sql)){
      return $result;
  } else {
      die("Error: " . $conn->error);
  }
}
