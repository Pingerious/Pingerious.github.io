<?php
session_start();
date_default_timezone_set('Asia/Tokyo');
include_once "../classes/subject.php";

$stamp = date("Y-m-d H:i:s");
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];


$student = new Subject;

$student -> updateTimestampIn($stamp,$id);
header("location: http://localhost/Pingerious.github.io/study-management/views/study-record.php?id=$user_id");
?>