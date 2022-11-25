<?php

include_once '../classes/subject.php';
session_start();

$subject = new Subject;
$user_id = $_SESSION['user_id'];
$date = $_POST['date_from'];

$display_best_record = $subject ->displayDailyBestRecord($user_id,$date);
header("location: ../views/past-record.php?id=$user_id");
?>