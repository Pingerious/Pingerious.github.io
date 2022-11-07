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

  public function insertSubject($subject_id,$subject_name){
    $sql = "INSERT INTO `record` (`subject_id`,`subject_name`) VALUES('$subject_id','$subject_name')";

    if($this->conn->query($sql)){
        header("location: ../views/study-record.php");
    } else {
        die("Error inserting the data!" .$this->conn->error);
    }
  }

  function getStudyRecords() {
    $sql = 
    "SELECT s.subject_id, s.subject_name, r.clock_in, r.clock_out, TIMEDIFF(r.clock_out,r.clock_in), r.note FROM record r
    INNER JOIN subjects s
    ON r.subject_id = s.subject_id
    INNER JOIN users u
    ON r.user_id = u.user_id;
    WHERE u.user_id = 1
    ";
  
    if($result = $this->conn->query($sql))
    {
      return $result;
    }
    else {
      echo $this->error;
    }
  }
}