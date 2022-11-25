<?php
session_start();
include "../classes/user.php";

$user = new User;

$user_id = $_SESSION['user_id'];
$cur_passw = $_POST['current_password'];
$db_passw = $user->getPassword($_SESSION['user_id']);
$new_passw = $_POST['new_password'];
$conf_new = $_POST['confirm_new_password'];

$user->changePassword($user_id,$cur_passw,$db_passw,$new_passw,$conf_new);


