<?php
session_start();
include_once "../classes/subject.php";
date_default_timezone_set('Asia/Tokyo');

$subject = new Subject;
$user_id = $_GET['id'];
$date_today = date("Y-m-d");
$get_record = $subject->getStudyRecords($user_id,$date_today);
$total_hours = $subject->getTodayTotal($user_id);
// print_r($total_hours);


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
 <div class="row">
   <div class="ms-5 mt-3 col-3">
     <div class="card">
       <div class="card-header">
         <h1 class="h3 text-center">Current Time</h1>
       </div>
       <div class="card-body fw-bold text-center h5">
          <?= date_default_timezone_set ('Asia/Tokyo');
            echo date('Y-m-d')."<br/>\n";
            echo date('H:i:s')."<br/>\n";
          ?>
       </div>
     </div>
   </div>
   <div class="col-3">
     <div class="card mt-3">
       <div class="card-header">
         <h1 class="h4 text-center">Today's Effort</h1>
       </div>
       <div class="card-body fw-bold text-center h3">
       <?= gmdate('H \h i \m s \s', $total_hours['total']); ?>
       </div>
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
                  <th>Clock In</th>
                  <th>Clock Out</th>
                </tr>
              </thead>  
              <tbody>
                <tr>
                  <td><?php echo date("Y-m-d");?></td>
                </tr>
                <?php 
                while($row = $get_record->fetch_assoc()){ ?>
                
                <tr>
                  <td><?= $row['subject_id']; ?></td>
                  <td><?= $row['subject_name']; ?></td>
                  <td><?= $row['clock_in']; ?></td>
                  <td><?= $row['clock_out']; ?></td>
                  <td><?= gmdate('H \h i \m s \s', $row['total']); ?></td> 
                  <td>
                    <a href="../actions/update_timeStampIn.php?id=<?= $row['record_id'];?>" name ="clock_in" class="btn btn-success"><i class="bi bi-stopwatch"></i> Clock In</a>
                  </td>
                  
                  <td>
                  <a href="../actions/update_timeStampOut.php?id=<?= $row['record_id'];?>" name ="clock_in" class="btn btn-danger"><i class="bi bi-stopwatch"></i> Clock Out</a>
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

