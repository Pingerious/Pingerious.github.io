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

}