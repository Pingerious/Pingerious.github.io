<?php
include_once "../classes/user.php";
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
    <main class="container">
        <div class="card mx-auto w-50 border border-0">
            <div class="card-header bg-white border-0">
                <h1 class="text-center text-uppercase mb-4">Login</h1>
            </div>
            <div class="card-body">
                <form action="../actions/login.php" method="post">
                    <input type="text" name="username" class="form-control mb-4" placeholder="USERNAME" required autofocus>
                    <input type="password" name="password" class="form-control mb-5" placeholder="PASSWORD" required>
                    <button type="submit" name="login" class="btn btn-danger text-uppercase text-black fw-bold py-2 w-100">Enter</button>
                </form>
            </div>
            <div class="card-footer bg-white border-0">
                <div class="text-center">
                        <a href="register.php">Create an Account</a>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>