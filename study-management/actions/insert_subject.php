<?php
    
    session_start();
    include_once "../classes/subject.php";

    $subject = new Subject;
    $subject_id = $_GET['subject_id'];
    $user_id = $_SESSION['user_id'];

    $subject->insertSingleSubject($subject_id,$user_id);

?>