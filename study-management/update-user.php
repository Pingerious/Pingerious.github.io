<?php
session_start();
include 'functions/user-functions.php';
$user_details = displayProfile($_GET['account_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog: User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main-style.css">
</head>
<body>
    <header>
        <?php include "admin-menu.php"; ?>
        <div class="container-fluid bg-warning bg-gradient text-white p-4 ps-5">
            <h2 class="display-2"><i class="fas fa-user-edit me-3"></i>Update User</h2>
        </div>
    </header>
    <main class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-8 px-5">
                <?php
                if (isset($_POST['update'])) {
                    updateProfile($_GET['account_id']);
                }
                ?>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="first-name" class="small form-label">First Name</label>
                            <input type="text" name="first_name" id="first-name" class="form-control" required autofocus value="<?= $user_details['first_name'] ?>">
                        </div>
                        <div class="col-6">
                            <label for="last-name" class="small form-label">Last Name</label>
                            <input type="text" name="last_name" id="last-name" class="form-control" required value="<?= $user_details['last_name'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="address" class="small form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control" required value="<?= $user_details['address'] ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="contact-number" class="small form-label">Contact Number</label>
                            <input type="text" name="contact_number" id="contact-number" class="form-control" required value="<?= $user_details['contact_number'] ?>">
                        </div>
                    </div>

                    <label for="username" class="small form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control mb-3" required value="<?= $user_details['username'] ?>">

                    <label for="password" class="small form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password to confirm" required>

                    <div class="mt-4 text-center">
                        <a href="users.php" class="btn btn-outline-primary">Cancel</a>
                        <button type="submit" class="btn btn-primary text-uppercase px-5" name="update">Update</button>
                    </div>
                </div>
                <div class="col-4">
                    <img src="images/<?= $user_details['avatar'] ?>" class='w-100 mb-2'>
                    <input type="file" name="avatar" class="form-control" aria-label="Choose Photo" accept="image/*">
                </div>
            </div>
        </form>
    </main>
</body>
</html>