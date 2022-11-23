

<nav class="navbar navbar-expand-md bg-dark navbar-dark px-5">
    <a href="dashboard.php" class="navbar-brand">
        <h1 class="h3">Study Management for Teachers</h1>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="users.php" class="nav-link text-white">Users</a>
        </li>
        <li class="nav-item">
            <a href="user-ranking.php" class="nav-link text-white">User Ranking</a>
        </li>
    </ul>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="profile.php" class="nav-link text-white"><i class="me-1 fas fa-user"></i>Welcome <?= $_SESSION['full_name'] ?></a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link text-white"><i class="me-1 fas fa-user"></i>Logout</a>
        </li>
    </ul>
</nav>