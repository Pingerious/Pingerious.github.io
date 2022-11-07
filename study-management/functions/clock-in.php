<?php
require_once 'connection.php';

function clockIn($subject_id){
    $conn = dbConnect();
    $sql = "UPDATE record SET `time_in` = NOW() WHERE `subject_id` = $subject_id";
         if($conn->query($sql)){
            header("location:study-record.php");
         } else{
            die("Error: .$conn->error");
         }
    }

 ?>