<?php
session_start();
include "../classes/user.php";

$user = new User;

$user_id = $_SESSION['user_id'];
$daily_goal = $_POST['daily_goal'];
$weekly_goal = $_POST['weekly_goal'];

$user -> insertGoals($user_id, $daily_goal, $weekly_goal);


