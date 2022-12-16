<?php
session_start();

date_default_timezone_set('Asia/Tokyo');
require_once "../classes/database.php";
include_once "../classes/subject.php";

$stamp = date("Y-m-d H:i:s");
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$con=mysqli_connect("localhost","root","","student_management_program");

$student = new Subject;

$student -> updateTimestampOut($stamp,$id);
$student -> getTotalTime($id,$stamp, $stamp);

if(isset($_GET['id'])) {
    $record_id = $_GET['id'];
    $sql_update_toggle = "UPDATE `record` SET `toggler` = 1 WHERE `record_id` = $id";
    mysqli_query($con,$sql_update_toggle);
}
header("location: ../views/study-record.php?id=$user_id");
?>