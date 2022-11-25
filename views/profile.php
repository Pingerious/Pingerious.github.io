<?php
session_start();

include "../classes/user.php";
$user = new User;
$user_details = $user->getUser($_SESSION['user_id']);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="https://kit.fontawesome.com/8f1b3de5ef.js" crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

</head>
<body>
<header>  
<?php
  include '../views/navbar.php';
  ?>
</header>
  <div class="bg-success bg-gradient text-white p-4 ps-5">
    <h2 class="display-2 p-4">
      <i class="fa-solid fa-pen-fancy"></i>
      </i>Profile
    </h2>
  </div>
  <main class="card w-25 mx-auto my-5">
        <img src="../assets/images/<?= $user_details['avatar'] ?>" alt="Profile Picture" class="card-img-top">
        <div class="card-body">
            <form action="../actions/upload-photo.php" method="post" enctype="multipart/form-data">
                <div class="input-group input-group-sm">
                    <input type="file" name="avatar" id="photo" class="form-control" accept="image/*" required>
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-arrow-circle-up"></i></button>
                </div>
            </form>
        </div>
        <div class="card-footer border-0 bg-white">
            <p class="lead fw-bold mb-0 text-center">Name: <?= $user_details['first_name'] . " " . $user_details['last_name']; ?></p>
            <p class="lead text-center">Username: <?= $user_details['username'] ?></p>
        </div>
        <div>
          <a href="../views/password-update.php?id=<?=$_SESSION['user_id']?>" class="text-center d-block mb-3">Change your Password?</a>
        </div>
  </main>
  </body>
</html>