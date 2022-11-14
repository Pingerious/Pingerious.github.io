<?php
require_once 'connection.php';



function displayAllUsers(){
    $conn = dbConnect();

    $sql = "SELECT * FROM users INNER JOIN accounts ON accounts.account_id = users.account_id WHERE accounts.role = 'U'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "
                <tr>
                    <td>".$row['account_id']."</td>
                    <td>".$row['first_name']." ".$row['last_name']."</td>
                    <td>".$row['contact_number']."</td>
                    <td>".$row['address']."</td>
                    <td>".$row['username']."</td>
                    <td><a href='update-user.php?account_id=".$row['account_id']."' class='btn btn-sm btn-warning text-white'>Update</a></td>
                    <td><a href='delete-user.php?account_id=".$row['account_id']."' class='btn btn-sm btn-danger text-white'>Delete</a></td>
                </tr>
            ";
        }
    }else{
        echo "<tr>
            <td colspan='7' class='text-center lead fw-bold fst-italic'>
                No Records Found
            </td>
        </tr>";
    }
}

function addUser(){
    $conn = dbConnect();
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $avatar = "profile.jpg";
    
    $sql_accounts = "INSERT INTO `accounts` (`username`, `password`) VALUES ('$username', '$password')";

    if($conn->query($sql_accounts)){
        $account_id = $conn->insert_id;

        $sql_users = "INSERT INTO users (first_name, last_name, `address`, contact_number, avatar, account_id) VALUES ('$first_name', '$last_name', '$address','$contact_number', '$avatar', $account_id)";

        if($conn->query($sql_users)){
            echo "<div class='mt-4 alert alert-success text-center fw-bold' role='alert'>NEW USER ADDED: $first_name $last_name</div>";
        }else{
            echo "<div class='alert alert-danger text-center fw-bold' role='alert'>Error: ".$conn->error."
            </div>";
        }
    }else{
        echo "<div class='alert alert-danger text-center fw-bold' role='alert'>
        Error: ".$conn->error."</div>";
    }
}

function deleteUser($account_id){
    $conn =dbConnect();
    $tables = ['users', 'accounts', 'posts'];
    foreach($tables as $table){
        $sql = "DELETE FROM $table WHERE account_id = $account_id";
        $conn->query($sql);
        if($conn->error){
            die("Error: ".$conn->error);
        }
    }
    header("location: users.php");
    exit;
}

function displayProfile($profile_id){
    $conn = dbConnect();

    $sql = "SELECT * FROM accounts INNER JOIN users ON accounts.account_id = users.account_id WHERE accounts.account_id = '$profile_id'";

    $result = $conn->query($sql);

    if($result->num_rows == 1){
        return $result->fetch_assoc();
    }else{
        echo "No User Found: ".$conn->error;
    }
}

function updateProfile($account_id){
    $conn = dbConnect();
    $password = $_POST['password'];
    $db_password = getPassword($account_id);

    if(password_verify($password, $db_password)){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $contact_number = $_POST['contact_number'];
        $username = $_POST['username'];
        $avatar_name = $_FILES['avatar']['name'];
        $avatar_tmp = $_FILES['avatar']['tmp_name'];

        $sql = "UPDATE accounts INNER JOIN users ON users.account_id = accounts.account_id
                SET users.first_name = '$first_name',
                users.last_name = '$last_name',
                users.address = '$address',
                users.contact_number = '$contact_number',
                accounts.username = '$username'
                WHERE accounts.account_id = $account_id";

        if($conn->query($sql)){
            // New avatar
            if(!empty($avatar_name)){
                $sql_avatar = "UPDATE users SET avatar = '$avatar_name' WHERE account_id = $account_id";

                $conn->query($sql_avatar);

                if($conn->error){
                    die("Error: " . $conn->error);
                }

                $destination = "images/$avatar_name";
                move_uploaded_file($avatar_tmp, $destination);
            }
            header("location: users.php");
            exit;
        } else {
            die("Error: " . $conn->error);
        }
    } else {
        echo "<div class='alert alert-danger text-center fw-bold' role='alert'>Incorrect password.</div>";
    }    
}

function getPassword($account_id){
    $conn = dbConnect();
    $sql = "SELECT `password` FROM accounts WHERE account_id = $account_id";
    if ($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        return $row['password'];
    }
}








    


?>