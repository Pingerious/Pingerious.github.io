<?php
require "database.php";

class Subject extends Database{
  public function displayAllSubjects(){
    $sql = "SELECT * FROM `subjects`";
      if($result = $this->conn->query($sql)){
        return $result;
    } else {
        die("Error: " . $this->conn->error);
    }
  }

  function insertSingleSubject($subject_id,$user_id) {
    
    $sql = "INSERT INTO `record` (`subject_id`,`user_id`) VALUES ($subject_id,$user_id)";
    if($result = $this->conn->query($sql)){
      echo "<script>alert('Subject Inserted') </script>";
      header("location: ../views/subjects.php");
      return $result;
    } else {
      die ("Something went wrong".$this->conn->error);
    }
    
  }
  function updateTimestampIn($stamp_in,$id) {
    $sql = "UPDATE `record` SET clock_in = '$stamp_in' WHERE `record_id` = $id";

    if($result = $this->conn->query($sql)) {
      return $result;
      
    }
    else {
      die("Something went wrong ".$this->conn->error);
    }
}

  function updateTimestampOut($stamp_out,$id) {
    $sql = "UPDATE `record` SET clock_out = '$stamp_out' WHERE `record_id` = $id";

    if($result = $this->conn->query($sql)) {
      return $result;
      
    }
    else {
      die("Something went wrong ".$this->conn->error);
    }
  }

  function getTotalTime($id,$stamp_out, $stamp_in) {
    $sql = "UPDATE `record` SET total = TIMEDIFF(clock_out,clock_in) WHERE `record_id` =$id";

    $result = $this->conn->query($sql);
    return $result;
  }



  function getStudyRecords($user_id) {
    $sql = "SELECT s.subject_id, s.subject_name, r.clock_in, r.clock_out, total, r.note,r.record_id FROM record r INNER JOIN subjects s ON r.subject_id = s.subject_id INNER JOIN users u ON r.user_id = u.user_id WHERE u.user_id = $user_id";
  
    if($result = $this->conn->query($sql)) {
      if ($result -> num_rows > 0) {
       return $result;
      }
    }
    else {
      echo "<p class='text-danger fw-bold text-center'>No records Found!</p>";
    }
  }
}