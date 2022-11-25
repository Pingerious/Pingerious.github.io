<?php
session_start();
include '../classes/user.php';

$user = new User;
$user_id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-zCompatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
<div class="container" style="margin-top:1em;">
    <form action="../actions/password-update.php" method="post">  
        <div class="card col-6 d-block mx-auto mt-5">
            <div class="card-header">
                <h1 class="h4 text-center fw-bold">Change Your Password</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="mx-auto">
                      <label for="current password" class="form-label">Current Password</label>
                      <input type="password" name="current_password" id="currentPassword" required placeholder="Enter Current Password" class="form-control mb-3">
                    </div>
                </div>
                <div class="row">
                    <div class="mx-auto">
                    <label for="New password" class="form-label">New Password</label>
                    <input type="password" name="new_password" id="newPassword" required placeholder="Enter new password" class="form-control mb-3">
                    </div>
                </div>
                <div class="row">
                    <div class="mx-auto">
                      <label for="Confirm password" class="form-label">Confirm New Password</label>
                      <input type="password" name="confirm_new_password" id="confNewPassword" required placeholder="Enter New Password Again" class="form-control mb-3">
                    </div>
                </div>
                <div class="row">
                    <div class="mx-auto">
                      <button type="submit" class="btn btn-primary w-100" name="btn_update">UPDATE</a>
                    </div>
                </div>
            </div>
        </div> 
    </form>
</div>
    <?php include "../views/footer.php"; ?>
</body>

</html>