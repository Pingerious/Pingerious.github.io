<?php
require_once 'connection.php';

function getProfileDetails($user_id){
    $conn = dbConnect();
    $sql = "SELECT * FROM users WHERE user_id = $user_id";

    if($result = $conn->query($sql)){
        return $result->fetch_assoc();
    } else {
        die("Error: " . $conn->error);
    }
}

function updateProfile($user_id){
    $conn = dbConnect();
    $password = $_POST['password'];
    $db_password = getPassword($user_id);

    if(password_verify($password, $db_password)){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_tmp = $_FILES['avatar']['tmp_name'];

        $sql = "UPDATE users SET first_name = '$first_name',
                                 last_name = '$last_name',
                                 username  = '$username'
                             WHERE user_id = $user_id";

        if($conn->query($sql)){
            // Update a session variable
            $_SESSION['full_name'] = "$first_name $last_name";

            // New avatar
            if(!empty($avatar_name)){
                $sql_avatar = "UPDATE users SET avatar = '$avatar_name' WHERE user_id = $user_id";

                if($conn->query($sql_avatar)){
                    $destination = "images/$avatar_name";
                    move_uploaded_file($avatar_tmp, $destination);
                } else{
                  die("Error: " . $conn->error);
                }
            }
            header("refresh: 0");
        } else {
            die("Error: " . $conn->error);
        }
    } else {
        echo "<div class='alert alert-danger text-center fw-bold' role='alert'>Incorrect password.</div>";
    }    
}

function changePassword($account_id){
    $conn = dbConnect();
    $current_passw = $_POST['current_passw'];
    $db_passw = getPassword($account_id);
    $new_passw = $_POST['new_passw'];
    $conf_new = $_POST['conf_new'];

    if (password_verify($current_passw, $db_passw)) {
        if ($new_passw === $conf_new) {
            if($current_passw != $new_passw){
                $new_passw = password_hash($new_passw, PASSWORD_DEFAULT);
    
                $sql = "UPDATE accounts SET `password` = '$new_passw' WHERE account_id = $account_id";
                
                if($conn->query($sql)){
                    header("location: profile.php");
                    exit;
                } else {
                    die("Error updating password: " . $conn->error);
                }
            } else {
                echo "<div class='mt-3 text-center fw-bold alert alert-danger' role='alert'>New Password cannot be the same as Current Password.</div>";
            }
        } else {
            echo "<div class='mt-3 text-center fw-bold alert alert-danger' role='alert'>New Password and Confirm Password do not match. </div>";
        }
    } else {
        echo "<div class='mt-3 text-center fw-bold alert alert-danger' role='alert'>Incorrect password.</div>";
    }
}

function getPassword($user_id) {
    $conn = dbConnect();
    $sql = "SELECT `password` FROM users WHERE user_id = $user_id";

    if($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        return $row['password'];
    }
}

function deleteAccount($user_id){
    $conn = dbConnect();
    $password = $_POST['password'];
    $db_passw = getPassword($user_id);

    if (password_verify($password, $db_passw)) {
        $tables = ['users', 'accounts', 'posts'];
        foreach($tables as $table){
            $sql = "DELETE FROM $table WHERE account_id = $user_id";
            
            $conn->query($sql);

            if($conn->error){
                die("Error: " . $conn->error);
            }
        }
        header("location: logout.php");
        exit;
    } else {
        echo "<div class='mt-3 text-center fw-bold alert alert-danger' role='alert'>Incorrect password.</div>";
    }
}
    function sum($user_id, $subject){
    $conn = dbConnect();
    $sql = "SELECT SUM(how_long) AS 'hours' FROM record WHERE `subject` = '$subject' AND`user_id` = $user_id";
    if($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        return $row['hours'];
    }

    
}