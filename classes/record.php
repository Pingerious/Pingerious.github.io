<?php
require "database.php";

class Record extends Database{
  public function allTimeAdd($user_id){
    $sql="SELECT SEC_TO_TIME(sum(total)) as TOTAL FROM record WHERE `user_id` = $user_id";

    if($result = $this->conn->query($sql)){
      return $result;
    } else { 
      die ("Error " .$this->conn->error);
    }
  } 
}