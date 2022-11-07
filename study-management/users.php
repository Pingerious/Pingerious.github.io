<?php
session_start();
include 'functions/user-functions.php';
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
        <?php include "admin-menu.php";?>
        <div class="container-fluid bg-warning bg-gradient text-white p-4 ps-5">
            <h2 class="display-2"><i class="fas fa-user-edit me-3"></i>User</h2>
        </div>
    </header>
    <main class="container">
        <div class="w-50 mx-auto">
            <form method="post">
                <h3 class="display-4">Add User</h3>
                <div class="row mb-2">
                    <div class="col-6">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required autofocus>
                    </div>
                    <div class="col-6">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" required>
                    </div>
                    <div class="col-6">
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                    </div>
                </div>
                <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" minlength="8" required>
                <button type="submit" name="add" class="btn btn-warning w-100 text-uppercase text-white fw-bold">Add</button>
            </form>
            <?php
            // Placed here for the ALERT message
            if(isset($_POST['add'])){
                addUser();
            }
            ?>
        </div>
        
        <table class="table table-hover table-striped my-5">
            <thead class="table-dark text-uppercase">
                <th>Account ID</th>
                <th>Full Name</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Username</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php
                displayAllUsers();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>