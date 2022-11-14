<?php
include "../classes/user.php";

//collect form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$avatar = "profile.jpg";
$grade = $_POST['grade'];

// Create an object
$user = new User;

// Call the method
$user->register($first_name, $last_name, $username, $password, $avatar, $grade);