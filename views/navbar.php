
<script src="https://kit.fontawesome.com/8f1b3de5ef.js" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand bg-danger navbar-dark px-5">
    <a href="../views/study-record.php?id=<?=$_SESSION['user_id']?>" class="navbar-brand">
        <h1 class="h3">Study Management</h1>
    </a>
    <ul class="navbar-nav">
    <li class="nav-item">
            <a href="../views/past-record.php?id=<?=$_SESSION['user_id']?>" class="nav-link text-white">View Past Record</a>
        </li>
        <li class="nav-item">
            <a href="../views/subjects.php?id=<?=$_SESSION['user_id']?>" class="nav-link text-white">Study Another Subject</a>
        </li>
       
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="../views/profile.php" class="nav-link text-white"><i class="me-1 fas fa-user text-white mr-1"></i>Welcome <?= $_SESSION['full_name']; ?></a>
        </li>
        <li class="nav-item">
            <a href="../actions/logout.php" class="nav-link text-white" ><i class="me-1 fas fa-user"></i>Logout</a>
        </li>
    </ul>
  </nav>


