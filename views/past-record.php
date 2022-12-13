
<?php

session_start();
include_once "../classes/subject.php";

$subject = new Subject;

 $user_id = $_SESSION['user_id'];
 $get_record = $subject->getStudyRecords($user_id);
 $display_total_study_hours = $subject->displayTotalStudyHours($user_id);
 
 
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
<header>  
<?php
  include '../views/navbar.php';
  ?>
    <div class="container-fluid bg-warning bg-gradient text-white p-4 ps-5">
        <h2 class="display-2 ms-2"><i class="bi bi-calendar-check"></i> Past Record</h2>        
    </div>
</header>
<body>
<body>
  <div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <div class="card ms-3 mt-4">
        <div class="card-header">
          <h1 class="h4 text-center">Total Study Hours (Since Day1)</h1>
        </div>
        <div class="card-body fw-bold text-center h3">
            <?php 
              while($row = $display_total_study_hours -> fetch_assoc()) {
                echo $row['TOTAL'];
              }
            ?>
        </div>
      </div>  
      <div class="card ms-3 mt-4">
        <div class="card-header">
          <h1 class="h4 text-center">Review Daily Record</h1>
        </div>
        <div class="card-body h4">
          <div class="row">
            <div class="col-6 fw-bold">
              <form method="post" class="form-group">
                  <label for="date" class="form-label h4">Select a Day </label>
                  <input type="date" name="date" id="date" class="form-control d-inline-block w-75">
        
                  <button class="btn btn-outline-secondary" name="search" type="submit"><i class="bi bi-search"></i></button>
              </form>
            </div>
            <div class="col-6">
              <p class="fw-bold">Result</p>
            <?php 
                    if(isset($_POST["search"])) {
                      $date = $_POST["date"]; 
                      if($date ==""){
                        echo "Select a day";
                      } else {
                        
                        $display_daily_record = $subject ->displayDailyRecord($user_id,$date);
                      while($row = $display_daily_record ->fetch_assoc()) {
                      echo "<p class='small'>". $date." | ".$row['TOTAL']."</p>";
                      }
                      } 
                    } 
            ?>
            </div>
          </div>
        </div>
      </div>
      <div class="card ms-3 mt-4">
        <div class="card-header">
          <h1 class="h4 text-center">Weekly Record</h1>
        </div>
        <div class="card-body  h3">
            <div class="row">
              <div class="col-6">
                <form method="post" class="form-group">
                    <label for="date_from" class="form-label h4">Select a Date </label>
                    <input type="date" name="date_from" id="date_from" class="form-control">
                
                    <button class="btn btn-outline-success w-100 mt-2" name="search_2" type="submit"><i class="bi bi-search"></i></button>
              
                </form>
              </div>
              <div class="col-6">
              <p class="fw-bold h4">Result</p>
              <?php 
                    if(isset($_POST["search_2"])) {
                      $date_from = $_POST["date_from"]; 
                      $date_to = date("Y-m-d", strtotime($date_from . "+7 days"));
                      if($date_from ==""){
                        echo "<p class='h4'>Select a day</p>";
                      } 
                      else{
                        $display_weekly_record = $subject ->displayWeeklyRecord($user_id,$date_from);
                      while($row = $display_weekly_record ->fetch_assoc()) {
                  
                        echo "<p class='h5 my-3'>Starting Week <span class='float-end fw-bold'>".$date_from."</span></p>";
                        echo "<p class='h5 my-3'>Week Ending <span class='float-end fw-bold'>".$date_to." </p>";
                        echo "<p class='h5'>Week Total <span class='float-end fw-bold'>".$row['TOTAL']."</p>";
                      }
                      }  
                    } 
              ?>
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card mt-4">
        <div class="card-header">
          <h1 class="h4 text-center"> My Study Record (Since Day 1)</h1>
        </div>
        <div class="card-body fw-bold text-center h3">
          <div class="row">
          <div class="col-6">
              <p class="text-decoration-underline text-uppercase">Subject</p>
              <?php $hours_studied = $subject->displayHoursStudied($user_id); 
                    while($row = $hours_studied->fetch_assoc()) {
                      echo "<p class='fw-normal h4'>". $row['subject_name']."</p>";
                    }
              ?>
            </div>
            <div class="col-6">
              <p class="text-decoration-underline text-uppercase">Hours</p>
              <?php $hours_studied = $subject->displayHoursStudied($user_id); 
                    while($row = $hours_studied->fetch_assoc()) {                    
                      echo "<p class='fw-normal h4'>". $row['TOTAL']."</p>";
                    }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>