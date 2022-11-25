<?php
include '../classes/record.php';

session_start();

$record = new Record;
$user_id = $_SESSION['user_id'];
$getAllTimeRecord = $record->allTimeAdd($user_id);

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
          while($row = $getAllTimeRecord->fetch_assoc()) {
            echo $row['TOTAL'];
          }
       ?> 
      </div>
    </div>  
    <div class="card ms-3 mt-4">
      <div class="card-header">
        <h1 class="h4 text-center">Daily Best Record</h1>
      </div>
      <div class="card-body fw-bold text-center h3">

      </div>
    </div>
    <div class="card ms-3 mt-4">
      <div class="card-header">
        <h1 class="h4 text-center">Weekly Best Record</h1>
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
            <p>subject</p>
          </div>
          <div class="col-6">
            <p>hours</p>
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
            <p>subject</p>
          </div>
          <div class="col-6">
            <p>hours</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  

    <div class="row">
      <div class="col-4">
        <div class="card ms-3 mt-4">
          <div class="card-header">
              <h1 class="h3"><?=date("Y-m-d")?></h1>
          </div>
            <div class="card-body">
              <table class="col-12">
                <thead>
                  <tr>
                    <th>Subject Name</th>
                    <th>How long?</th>
                  </tr>
                </thead>  
                <tbody>
                  <?php 
                  while($row = $get_record->fetch_assoc()){ ?>
                  
                  <tr>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['total']; ?></td>
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