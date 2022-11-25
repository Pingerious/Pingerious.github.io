<?php
require 'database.php';

class User extends Database{
  public function register($first_name, $last_name, $username, $password, $avatar, $grade){
    $password = password_hash($password, PASSWORD_DEFAULT);
   
    $sql= "INSERT INTO users (`first_name`, `last_name`, `username`, `password`, `avatar`, `grade`) VALUES ('$first_name', '$last_name','$username','$password','$avatar','$grade')";

    if($this->conn->query($sql)){
            header("location: ../views/index.php"); //ここは？
            exit;
        }else{
            // die("Error inserting to account table: " . $conn->error);
            echo "<div class='alert alert-danger text-center fw-bold' role='alert'>
            Error registering: ".$this->conn->error."</div>";
        }
    }

  public function login($username, $password){
    $sql = "SELECT * FROM users WHERE username = '$username'";
    if($result = $this->conn->query($sql)){
        if($result->num_rows == 1){
            $user_details = $result->fetch_assoc();
            if(password_verify($password, $user_details['password'])){
                session_start();
                $_SESSION['user_id'] = $user_details['user_id'];
                // $_SESSION['role'] = $user_details['role'];
                $_SESSION['full_name'] = $this->getFullName($user_details['user_id']);

                header("location: ../views/subjects.php");
                exit;
                //（roleをつけるかそうでないか？）
                // if($user_details['role'] == 'T'){
                //     header("location: ../views/dashboard.php");
                // }else($user_details['role'] == 'S'){
                //     header("location: ../views/subject-choice.php");
                //     exit;
            } else{
             die("Password is incorrect");
            }
        } else {
            die("Username not found");
        } 
    } else {
        die("Error logging in." . $this->conn->error);
           }
    }

    public function getFullName($user_id){
        $sql = "SELECT first_name, last_name FROM users WHERE user_id = $user_id";
    
        if($result = $this->conn->query($sql)){
            $full_name = $result->fetch_assoc();
            return $full_name['first_name'] . " " . $full_name['last_name'];
        } else {
            die("Error: " . $this->conn->error);
        }
    }

    public function getUser($user_id){
        $sql = "SELECT first_name, last_name, username, avatar FROM users WHERE `user_id` = $user_id";

        if($result = $this->conn->query($sql)){
            // expecting one row only
            return $result->fetch_assoc();
        } else {
            die("Error retrieving user: " . $this->conn->error);
        }
    }

    public function updateUser($user_id, $first_name, $last_name, $username){
        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE `user_id` = $user_id";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        } else {
            die("Error updating user: " . $this->conn->error);
        }
    }

    public function deleteUser($user_id){
        $sql = "DELETE FROM users WHERE `user_id` = $user_id";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        } else {
            die("Error deleting user: " . $this->conn->error);
        }
    }

    public function uploadPhoto($user_id, $photo_name, $tmp_name){
        $sql = "UPDATE users SET avatar = '$photo_name' WHERE `user_id` = $user_id";

        // Step 1: Update the PHOTO column
        if($this->conn->query($sql)){
            // Step 2: Move the file to our server
            $destination = "../assets/images/$photo_name";
            if(move_uploaded_file($tmp_name, $destination)){
                header("location: ../views/profile.php");
                exit;
            } else {
                die("Error moving the photo.");
            }
        } else {
            die("Error uploading photo: " . $this->conn->error);
        }
    }

    // function changePassword($new_passw, $conf_new, $user_id){//sqlの位置が違う
    //   $sql = "UPDATE users SET `password` = $new_passw WHERE user_id = $user_id";
    //         if($new_passw ==$conf_new){
    //             $new_passw = password_hash($new_passw, PASSWORD_DEFAULT);
    //                 if($this->conn->query($sql)){
    //                     echo "<script> alert('Successfully changed your password')</script>";
    //                     header("location: ../views/profile.php");
    //                     exit;
    //                 } else {
    //                     die("Error updating password: " . $this->conn->error);
    //                 }
    //         } else {
    //             echo "<div class='mt-3 text-center fw-bold alert alert-danger' role='alert'>New Password and Confirm Password do not match. </div>";
    //         } 
    //     }

        function changePassword($user_id,$current_passw, $db_passw,$new_passw,$conf_new){
            // $current_passw = $_POST['current_password'];
            // $db_passw = getPassword($user_id);
            // $new_passw = $_POST['new_password'];
            // $conf_new = $_POST['confirm_new_password'];
        
            if (password_verify($current_passw, $db_passw)) {
                if ($new_passw === $conf_new) {
                    if($current_passw != $new_passw){
                        $new_passw = password_hash($new_passw, PASSWORD_DEFAULT);
            
                        $sql = "UPDATE users SET `password` = '$new_passw' WHERE user_id = $user_id";
                        
                        if($this->conn->query($sql)){
                            header("location: ../views/profile.php");
                            exit;
                        } else {
                            die("Error updating password: " . $this->conn->error);
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
        
            $sql = "SELECT `password` FROM users WHERE user_id = $user_id";
        
            if($result = $this->conn->query($sql)) {
                $row = $result->fetch_assoc();
                return $row['password'];
            }
        }
    
    
    // function getPassword($user_id) {
    //     $sql = "SELECT `password` FROM user WHERE user_id = $user_id";
    
    //     if($result = $this->conn->query($sql)) {
    //         $row = $result->fetch_assoc();
    //         return $row['password'];
    //     }
    // }


}