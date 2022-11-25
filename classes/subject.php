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
      header("location: ../views/study-record.php");
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



  function getStudyRecords($user_id,$date_today) {
    
    $sql = "SELECT s.subject_id, s.subject_name, r.clock_in, r.clock_out, total, r.note,r.record_id FROM record r INNER JOIN subjects s ON r.subject_id = s.subject_id INNER JOIN users u ON r.user_id = u.user_id WHERE u.user_id = $user_id AND r.clock_in like '$date_today%'";
  
    if($result = $this->conn->query($sql)) {
      if ($result -> num_rows > 0) {
  
       return $result;
      }
    }
    else {
      echo "<p class='text-danger fw-bold text-center'>No records Found!</p>";
    }
  }

  public function getTodayTotal($user_id){
    $date_today = date('Y-m-d');
    $sql = "SELECT SUM(total) AS 'total' FROM record WHERE user_id = $user_id AND clock_in LIKE '$date_today%'";

    if($result = $this->conn->query($sql)){
        // expecting one row only
        return $result->fetch_assoc();
    } else {
        die("Error retrieving user: " . $this->conn->error);
    }
}

  function displayDailyBestRecord($user_id,$date) {
    $msg =  "<p class='text-danger'> NO RECORDS FOUND </p>";
    $sql = " 
    with date_time as (
      SELECT DATE_FORMAT(DATE(clock_in),'%M %d %Y') as date_in, DATE(clock_out) as date_out, max(total) as max
      FROM record WHERE user_id = $user_id and DATE(clock_in) = '$date' GROUP by date_in, date_out
    )
    SELECT max,date_in from date_time";
    if($result = $this->conn->query($sql)) {
      if(mysqli_num_rows($result) == 0) {
        echo $msg;
      }
    }
    return $result;

  }

  function displayWeeklyBestRecord($user_id, $date_from, $date_to) {
    $msg =  "<p class='text-danger'> NO RECORDS FOUND </p>";
    $sql = " SELECT date(clock_in) as FROM_WEEK, date_sub(date(clock_in), INTERVAL -1 week) as TO_WEEK, max(total) as TOTAL FROM record
             WHERE clock_in BETWEEN '$date_from' and '$date_to' and `user_id` = $user_id;
      ";
    if($result = $this->conn->query($sql)) {
      if(mysqli_num_rows($result) == 0) {
        echo $msg;
      }
    }
    return $result;
  }


  
  
}