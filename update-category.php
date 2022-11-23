<?php
session_start();
include 'functions/category-functions.php';

$cat_details = getCategory($_GET['cat_id']);

if(isset($_POST['update'])){
    updateCategory($_GET['cat_id']);
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog: Update Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/update-category.css">
</head>

<body>
    <header>
        <?php include 'admin-menu.php';?>
        <div class="container-fluid bg-success bg-gradient text-white p-4 ps-5">
            <h2 class="display-2"><i class="fas fa-folder me-3"></i>Category</h2>
        </div>
    </header>

    <main class="container">
        <div class="w-25 mx-auto">
            <form method="post">
                <input type="text" name="cat_name" class="form-control mb-4" value="<?= $cat_details['category_name'] ?>" autofocus>
                <button type="submit" name="update" class="btn btn-dark text-uppercase w-100 mb-2">Update</button>
                <a href="categories.php" class="btn btn-outline-dark w-100">Cancel</a>
            </form>
        </div>
    </main>
</body>
</html>