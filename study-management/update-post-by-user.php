<?php
session_start();
include 'functions/post-functions.php';

$post_row = getPostDetails($_GET['post_id']);

if(isset($_POST['update'])){
    updatePostByUser($_GET['post_id']);        
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog: Update Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main-style.css">
    <link rel="stylesheet" href="css/add-post.css">
</head>

<body>
    <header>
        <?php 
        include 'user-menu.php';
        ?>
        <div class="container-fluid bg-primary bg-gradient text-white p-4 ps-5">
            <h2 class="display-2"><i class="fas fa-pen-nib me-3"></i>Post</h2>        
        </div>
    </header>
    <main class="container w-50 mx-auto">

        <a href="post-details.php?post_id=<?= $_GET['post_id'] ?>" class="text-secondary"><i class="fas fa-chevron-left fa-2x"></i></a>

        <h2 class="display-4 text-center my-4"><i class="fas fa-pen"></i> Update Post</h2>

        <div class="col-10 mx-auto">
            <form method="post">
                <input type="text" name="title" class="form-control mb-3" placeholder="TITLE" value="<?= $post_row['post_title'] ?>" required autofocus>

                <input type="date" name="date_posted" class="form-control mb-3" value="<?= $post_row['date_posted'] ?>" required>

                <select name="category_id" class="form-select mb-3" required>
                    <?php
                    displayCategories();
                    ?>
                </select>

                <textarea name="message" class="form-control mb-3" rows="7" placeholder="MESSAGE"><?= $post_row['post_message'] ?></textarea>
                
                <button type="submit" name="update" class="btn btn-dark w-100 mt-5 text-uppercase">Update</button>
            </form>
        </div>
    </main>
</body>

</html>