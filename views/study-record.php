<?php
session_start();
include_once "../classes/subject.php";
date_default_timezone_set('Asia/Tokyo');

$subject = new Subject;
$user_id = $_SESSION['user_id'];
$date_today = date("Y-m-d");
$get_record = $subject->getStudyRecords($user_id);
$total_hours = $subject->getTodayTotal($user_id);

// $user = new User;（２つめのinstantiateはできる？）
// $daily_goal = $user->displayDailyGoal($user_id);
// $weekly_goal = $user->displayWeeklyGoal($user_id);

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
    <div class="container-fluid bg-primary bg-gradient text-white p-4 ps-5">
        <h2 class="display-2 ms-2"><i class="bi bi-pencil"></i>  Study Record</h2>        
    </div>
</header>
<body>
  <div class="row ms-3 mt-3">
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h1 class="h4 text-center">Today's Effort</h1>
        </div>
        <div class="card-body fw-bold text-center h3">
        <?= gmdate('H \h i \m s \s', $total_hours['total']); ?>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h1 class="h4 text-center">Daily Goal</h1>
        </div>
        <div class="card-body fw-bold text-center h3">
        <?= gmdate('H \h i \m s \s', $total_hours['total']); ?>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <h1 class="h4 text-center">Weekly Goal</h1>
          <?= $weekly_goal?>
        </div>
        <div class="card-body fw-bold text-center h3">
        <?= gmdate('H \h i \m s \s', $total_hours['total']); ?>
        </div>
      </div>
    </div>
  </div> 

   <div class="row ms-3 mt-3 me-3">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
            <h1 class="h3"><?=date("Y-m-d")?></h1>
        </div>
          <div class="card-body">
            <table class="col-12">
              <thead>
                <tr>
                  <th>Subject ID</th>
                  <th>Subject Names</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Total Study Hours</th>
                  <th>Clock Out</th>
                </tr>
              </thead>  
              <tbody>
                
                <?php 
                while($row = $get_record->fetch_assoc()){ ?>
                
                <tr>
                  <td><?= $row['subject_id']; ?></td>
                  <td><?= $row['subject_name']; ?></td>
                  <td><?= $row['clock_in']; ?></td>
                  <td><?= $row['clock_out']; ?></td>
                  <td><?= gmdate('H \h i \m s \s', $row['total']); ?></td> 
                  <td>
                  <a href="../actions/update_timeStampOut.php?id=<?= $row['record_id'];?>" name ="clock_in" class="btn btn-info" id="clock_out"><i class="bi bi-stopwatch"></i> Clock Out</a>
                  </td>
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
</html>

