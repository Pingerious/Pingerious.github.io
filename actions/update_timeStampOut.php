<?php
session_start();
date_default_timezone_set('Asia/Tokyo');
include_once "../classes/subject.php";

$stamp = date("Y-m-d H:i:s");
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];


$student = new Subject;

$student -> updateTimestampOut($stamp,$id);
$student -> getTotalTime($id,$stamp, $stamp);
header("location: http://localhost/study-management/views/study-record.php?id=$user_id");
?>