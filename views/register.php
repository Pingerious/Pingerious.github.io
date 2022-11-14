<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <main class="container">
        <div class="card mx-auto w-50 border border-0">
            <div class="card-header darko border-0">
                <h1 class="text-center text-uppercase fw-bold">Study Management Program</h1>
                <p class="text-center text-uppercase text-decoration-underline mb-4 h4">Registration</p>
            </div>
            <div class="card-body">
                <form action="../actions/register.php" method="post">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="first-name" class="form-label">First Name <span>*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control darko mb-4" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="last-name" class="form-label">Last Name <span>*</span></label>
                            <input type="text" name="last_name" id="last-name" class="form-control darko" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="username" class="form-label">Username <span>*</span></label>
                        <input type="text" name="username" id="username" class="form-control darko" maxlength="15" required>
                    </div>
                    <div class="mb-5">
                        <label for="password" class="form-label">Password <span style="color: crimson">*</span></label>
                        <input type="password" name="password" id="password" class="form-control darko" minlength="8" required>
                    </div>
                    <div class="mb-5">
                         <label for="username" class="form-label">Your Grade <span>*</span></label>
                         <select name="grade" class="form-select">
                           <option hidden>Choose Your Grade</option>
                           <option value="1st-Grade">1st Grade</option>
                           <option value="2nd-Grade">2nd Grade</option>
                           <option value="3rd-Grade">3rd Grade</option>
                         </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="register" class="btn btn-dark px-5 py-2 text-uppercase">Register</button>
                        </div>
                        <div class="col position-relative">
                            <p class="mb-0 position-absolute" style="bottom: 0; right: 0"><span class="text-white">Have an account? </span><a href="../views/index.php">Sign In</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>