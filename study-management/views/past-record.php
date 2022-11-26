<?php

session_start();
include_once "../classes/subject.php";

$subject = new Subject;

 $user_id = $_GET['id'];
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
  <nav class="navbar navbar-expand bg-danger navbar-dark px-5">
    <a href="profile.php" class="navbar-brand">
        <h1 class="h3">Study Management</h1>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="../views/study-record.php" class="nav-link text-white">My Study Record</a>
        </li>
        <li class="nav-item">
            <a href="../views/subjects.php" class="nav-link text-white">Study Another Subject</a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="profile.php" class="nav-link text-white"><i class="me-1 fas fa-user text-white mr-1"></i>Welcome <?= $_SESSION['full_name']; ?></a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link text-white" ><i class="me-1 fas fa-user"></i>Logout</a>
        </li>
    </ul>
  </nav>
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
        <h1 class="h4 text-center">Daily Best Record</h1>
      </div>
      <div class="card-body h4">
        <div class="row">
          <div class="col-6 fw-bold">
            <form method="post" class="form-group" id="form_submit">
                <label for="date_from" class="form-label small">Select a Day </label>
                <input type="date" name="date_from" id="date_from" class="form-control d-inline-block w-75">
      
                <button class="btn btn-outline-secondary" name="search" type="submit"><i class="bi bi-search"></i></button>
          
            </form>
          </div>
          <div class="col-6">
            <p class="fw-bold">Result</p>
          <?php 
                  if(isset($_POST["search"])) {
                    $date = $_POST["date_from"]; 
                  
                    $display_best_record = $subject ->displayDailyBestRecord($user_id,$date);
                    while($row = $display_best_record ->fetch_assoc()) {
                     echo "<p class='small'>". $row['date_in']." | ".$row['max']."</p>";
                    }  
                  } 
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card ms-3 mt-4">
      <div class="card-header">
        <h1 class="h4 text-center">Weekly Best Record</h1>
      </div>
      <div class="card-body  h3">
          <div class="row">
            <div class="col-6">
              <form method="post" class="form-group" id="form_submit">
                  <label for="date_from" class="form-label small">Select Starting Week </label>
                  <input type="date" name="date_from" id="date_from" class="form-control  ">
                  <label for="date_to" class="form-label small mt-2">Select Ending Week </label>
                  <input type="date" name="date_to" id="date_to" class="form-control ">
                  <button class="btn btn-outline-success w-100 mt-2" name="search_2" type="submit"><i class="bi bi-search"></i></button>
            
              </form>
            </div>
            <div class="col-6">
            <p class="fw-bold">Result</p>
            <?php 
                  if(isset($_POST["search_2"])) {
                    $date_from = $_POST["date_from"]; 
                    $date_to = $_POST["date_to"]; 
                  
                    $display_weekly_best_record = $subject ->displayWeeklyBestRecord($user_id,$date_from,$date_to);
                    while($row = $display_weekly_best_record ->fetch_assoc()) {
                      echo "<p class='h5 my-3'>Starting Week <span class='float-end fw-bold'>".$row['FROM_WEEK']."</span></p>";
                      echo "<p class='h5 my-3'>Week Ending <span class='float-end fw-bold'>".$row['TO_WEEK']." </p>";
                      echo "<p class='h5'>Total Hours <span class='float-end fw-bold'>".$row['TOTAL']." </p>";
                    }  
                  } 
            ?>
            </div>
          </div>
      </div>
    </div>
    <div class="card ms-3 mt-4">
      <div class="card-header">
        <h1 class="h4 text-center">Monthly Best Record</h1>
      </div>
      <div class="card-body fw-bold text-center h3">

      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card mt-4">
      <div class="card-header">
        <h1 class="h4 text-center">Most studied</h1>
      </div>
      <div class="card-body fw-bold text-center h3">
        <div class="row">
          <div class="col-6">
            <p class="text-capitalize">subject</p>
            <?php $most_hours_studied = $subject->displayMostStudied($user_id); 
                  while($row = $most_hours_studied->fetch_assoc()) {
                    echo $row['subject_name'];
                  }
            ?>
          </div>
          <div class="col-6">
            <p class="text-capitalize">hours</p>
            <?php $most_hours_studied = $subject->displayMostStudied($user_id); 
                  while($row = $most_hours_studied->fetch_assoc()) {
                    echo $row['TOTAL'];
                  }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-4">
      <div class="card-header">
        <h1 class="h4 text-center">Least studied</h1>
      </div>
      <div class="card-body fw-bold text-center h3">
        <div class="row">
          <div class="col-6">
            <p class="text-capitalize">subject</p>
            <?php $least_hours_studied = $subject->displayLeastStudied($user_id); 
                  while($row = $least_hours_studied->fetch_assoc()) {
                    echo "<p class='d-block'>".$row['subject_name']."</p>";
                  }
            ?>
          </div>
          <div class="col-6">
            <p class="text-capitalize">hours</p>
            <?php $least_hours_studied = $subject->displayLeastStudied($user_id); 
                  while($row = $least_hours_studied->fetch_assoc()) {
                    echo "<p class='d-block'>".$row['TOTAL']."</p>";
                  }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

  

    <div class="row">
      <div class="col-12">
        <div class="card ms-3 mt-4">
          <div class="card-header">
              <h1 class="h3"><?=date("Y-m-d")?></h1>
          </div>
            <div class="card-body">
              <table class="col-12">
                <thead>
                  <tr>
                    <th>Subject Name</th>
                    <th>Total Study Hours</th>
                    <th>Total</th>
                    <th>Notes</th>
                
                  </tr>
                </thead>  
                <tbody>
                  <?php 
                  while($row = $get_record->fetch_assoc()){ ?>
                  
                  <tr>
                    <td><?php echo $row['subject_id']; ?></td>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['note']; ?></td>
                    
                  </tr>
                  <?php
                    } 
                  ?>
                </tbody>  
              </table>
            </div>  
        </div>  
      </div>
    </div>
  </div> 
</body>
  


<script>
  var myForm = document.getElementById('form_submit');

  function handleForm(event) {
    event.preventDefault();
  }
  myForm.addEventListener('submt',handleForm);
</script>


  
</body>
</html>