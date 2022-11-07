<?php
session_start();
include "../classes/subject.php";
date_default_timezone_set('Asia/Tokyo');

$subject = new Subject;
// $subject_list = $subject->getSubject($record_id);


// include 'clock_in.php';

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
            <a href="study-record.php" class="nav-link text-white">My Study Record</a>
        </li>
        <li class="nav-item">
            <a href="add-post-by-user.php" class="nav-link text-white">Add Record</a>
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
    <div class="container-fluid bg-primary bg-gradient text-white p-4 ps-5">
        <h2 class="display-2 ms-2"><i class="bi bi-pencil"></i>  Study Record</h2>        
    </div>
</header>
<body>
    <div class="row ms-5 mt-5">
      <div class="col-9">
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
                    <th></th>
                    <th></th>
                    <th>Notes</th>
                  </tr>
                </thead>  
                <tbody>
                  <?php 
                  $get_record = $subject->getStudyRecords();
                  while($subject_details = $get_record->fetch_assoc()){ ?>
                  
                  <tr>
                    <td><?php echo $subject_details['subject_id']; ?></td>
                    <td><?= $subject_details['subject_name']?></td>
                    <td><?= $subject_details['clock_in']?></td>
                    <td><?= $subject_details['clock_out']?></td>
                    <td><?= $subject_details['note']?></td>
                    <td>
                      <a href="functions/clock-in.php" name ="clock_in" class="btn btn-light"><i class="bi bi-stopwatch"></i> Clock In</a>
                    </td>
                    
                    <td>
                      <button type="button" class="btn btn-danger"><i class="bi bi-stopwatch"></i>Clock Out</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Note Updated</button>
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
      <div class="ms-5 col-2">
        <div class="card">
          <div class="card-header">
            <h1 class="h3 text-center">Current Time</h1>
          </div>
          <div class="card-body fw-bold text-center h5">
          <?php date_default_timezone_set ('Asia/Tokyo');
            echo date('Y-m-d')."<br/>\n";
            echo date('H:i:s')."<br/>\n";
            ?>
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-header">
            <h1 class="h4 text-center">Total<br> Study Hours</h1>
          </div>
          <div class="card-body fw-bold text-center h3">
  
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-header">
            <h1 class="h4 text-center">Most studied</h1>
          </div>
          <div class="card-body fw-bold text-center h3">
  
          </div>
        </div>
        <div class="card mt-3">
          <div class="card-header">
            <h1 class="h4 text-center">Least studied</h1>
          </div>
          <div class="card-body fw-bold text-center h3">
  
          </div>
        </div>


        </div>
      </div>
  </div>
</div>


</body>
</html>

