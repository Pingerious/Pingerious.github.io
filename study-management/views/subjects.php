<?php
session_start();
include '../classes/subject.php';

$subject = new Subject; 
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/8f1b3de5ef.js" crossorigin="anonymous"></script>
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="card w-50 mx-auto mt-5">
      <div class="card-header text-center p-3">
          <h1><span class="text-primary">Hi!  Good to see you!</span><br>  <i class="bi bi-stars text-warning"></i><?=$_SESSION['full_name']?><i class="bi bi-stars text-warning"></i></i></h1>
      </div>
      <div class="card-body">
        <h4 class="text-center text-danger"> What subject are you going to study today? </h4>
        <hr>
        <form action="../actions/" method="post">
          <select name="subject" class="d-block mx-auto form-select-lg form-select-box-shadow form-control">
        <?php
        $subject_options = $subject->displayAllSubjects();
        if($subject_options && $subject_options->num_rows > 0){
          while($option = $subject_options->fetch_assoc()){
           echo "<option value ='".$option['subject_id']."'>".$option['subject_name']."</option>";
          }
        } else{
          echo "<option> No Subjects to display </option>";

        }
        ?>
          </select>
        </form>  
      </div>
      <div class="card-footer">  
          <a href="study-record.php?id=" class="btn btn-success w-50 d-block mx-auto fw-bold p-2" name="submit">Go!</a>

      </div>

      <?php
      if(isset($_POST['submit'])){
        $this->getSubject();
      }
      ?>
    </div>
  </div>

</body>
</html>