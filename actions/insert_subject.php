<?php
    
    session_start();
    date_default_timezone_set('Asia/Tokyo');
    include_once "../classes/subject.php";

    $subject = new Subject;
    $subject_id = $_POST['subject'];
    $user_id = $_SESSION['user_id'];
    $clock_in = date('Y-m-d H:i:s');

    $subject->insertSingleSubject($subject_id,$user_id,$clock_in);

?>