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
    
    $sql = "INSERT INTO `record` (`subject_id`,`user_id`,`clock_in`) VALUES ($subject_id,$user_id, CURRENT_TIMESTAMP)";
    if($this->conn->query($sql)){
      header("location: ../views/study-record.php");
      exit;
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
  
  function displayTotalStudyHours($user_id) {
    $sql_display_time = "SELECT SEC_TO_TIME(SUM(total)) as TOTAL FROM `record` WHERE user_id = $user_id";

    $result = $this->conn->query($sql_display_time);
    return $result;
  }

  function displayDailyRecord($user_id,$date) {
    $msg =  "<p class='text-danger'> NO RECORDS FOUND </p>";
    $sql = "SELECT SEC_TO_TIME(SUM(total)) AS TOTAL FROM record WHERE clock_in LIKE '$date%' AND  user_id = $user_id";
    // $sql = "SELECT DATE(clock_in) as date_in, SEC_TO_TIME(max(total)) as max
    // FROM record WHERE user_id = $user_id and DATE(clock_in) = '$date' GROUP by date_in";
    if($result = $this->conn->query($sql)) {
      if(mysqli_num_rows($result) == 0) {
        echo $msg;
      }
    }
    return $result;
     
  }

  function displayWeeklyRecord($user_id, $date_from) {
    $msg =  "<p class='text-danger'> NO RECORDS FOUND </p>";
    $sql = "SELECT SEC_TO_TIME(SUM(total)) AS TOTAL FROM record WHERE clock_in >= '$date_from' AND  user_id = $user_id";
    if($result = $this->conn->query($sql)) {
      if(mysqli_num_rows($result) == 0) {
        echo $msg;
      }
    }
    return $result;
  }

  function displayMonthlyRecord() {
    $msg =  "<p class='text-danger'> NO RECORDS FOUND </p>";
    $sql = "SELECT SEC_TO_TIME(`total`) FROM record WHERE DATE_FORMAT (clock_in, '%m%d%Y') = DATE_FORMAT (NOW(), '%m%d%Y')";
    if($result = $this->conn->query($sql)) {
      if(mysqli_num_rows($result) == 0) {
        echo $msg;
      }
    }
    return $result;
  }

  function displayHoursStudied($user_id) {
    $sql = "SELECT DISTINCT record.subject_id as subject_id, subjects.subject_name, 
    CASE 
        WHEN SEC_TO_TIME(SUM(record.total)) is not NULL then SEC_TO_TIME(SUM(record.total)) 
        WHEN SEC_TO_TIME(SUM(record.total)) is NULL then '0' END as TOTAL 
    FROM subjects
    JOIN record
        ON subjects.subject_id = record.subject_id
    JOIN users
      ON record.user_id = users.user_id
    WHERE record.subject_id = subjects.subject_id and users.user_id = $user_id
    GROUP by subject_id
    ORDER BY SEC_TO_TIME(SUM(record.total)) DESC";

    $result = $this->conn->query($sql);
    return $result; 
  }


  function getStudyRecords($user_id) {
    $is_clicked = false;
    $date_today = date('Y-m-d');
    $sql = "SELECT s.subject_id, s.subject_name, r.clock_in, r.clock_out, total,r.record_id FROM record r INNER JOIN subjects s ON r.subject_id = s.subject_id INNER JOIN users u ON r.user_id = u.user_id WHERE u.user_id = $user_id AND r.clock_in LIKE '$date_today%'";
  
    if($result = $this->conn->query($sql)) {
      if ($result -> num_rows > 0) {
       return $result;
      }
    }
    else {
      echo "<p class='text-danger fw-bold text-center'>No records Found!</p>";
    }
  }
  
  function getTodayTotal($user_id){
  $date_today = date('Y-m-d');
  $sql = "SELECT SUM(`total`) AS 'total' FROM `record` WHERE user_id = $user_id AND clock_in LIKE '$date_today%'";

  if($result = $this->conn->query($sql)){
    return $result->fetch_assoc();
} else {
    die("Error retrieving user: " . $this->conn->error);
}
}

}




