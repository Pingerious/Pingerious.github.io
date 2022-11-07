<?php
require_once 'connection.php';
session_start();

// ok
function displayUserPosts($user_id){
    $conn = dbConnect();
    $sql = "SELECT * FROM record WHERE user_id = $user_id ORDER BY 'date'";

    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "
                    <tr>
                        <td>".$row['record_id']."</td>
                        <td>".$row['date']."</td>
                        <td>".$row['subject']."</td>
                        <td>".$row['how_long']."</td>
                        <td>".$row['problem']."</td>
                        <td>
                           <a href='post-details.php?record_id=".$row['record_id']."' class='btn btn-sm btn-outline-dark'><i class='fas fa-angle-double-right'></i> Details</a>
                        </td>
                    </tr>
                ";
            }
        } else {
            echo "<tr>
                <td colspan='5' class='text-center lead fst-italic fw-bold'>
                    No Records Found
                </td>
            </tr>";
        }
    } else {
        die("Error: " . $conn->error);
    }
}

// ok
function displayCategories(){
    $conn = dbConnect();

    $sql = "SELECT * FROM categories";

    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            echo "<option value='' hidden>CATEGORY</option>";
            while($row = $result->fetch_assoc()){
                echo "<option value='".$row['category_id']."'>".$row['category_name']."</option>";
            }
        }else{
            echo "<option value='' hidden>No Category Found</option>";
        }
    } else {
        die("Error: " . $conn->error);
    }
}

// ok
function displayUsers(){
    $conn = dbConnect();
    $sql = "SELECT account_id, username FROM accounts";

    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<option value='".$row['account_id']."'>".$row['username']."</option>";
            }
        }else{
            echo "<option value='' hidden>No Records Found</option>";
        }
    } else{
        die("Error: " . $conn->error);
    }
}

// ok
// function addPost(){
//     $conn = dbConnect();
//     $date = $_POST['date'];
//     $subject = $_POST['subject'];
//     $how_long = $_POST['how_long'];
//     $problem = $_POST['problem'];

//     $sql = "INSERT INTO record (`date`, `subject`, `how_long`, `problem`) VALUES ('$date','$subject', '$how_long', '$problem')";
    
//     if($conn->query($sql)){
//         header("location: record.php");
//         exit;
//     }else{
//         die("Error: " . $conn->error);
//     }
// }

function addPostByUser(){
    $conn = dbConnect();
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $how_long = $_POST['how_long'];
    $problem = $_POST['problem'];
    $user_id = $_SESSION['user_id'];
    

    $sql = "INSERT INTO record (date, subject, how_long, problem,user_id) VALUES ('$date','$subject', $how_long, '$problem', '$user_id')";
    
    if($conn->query($sql)){
        header("location: record.php");
        exit;
    }else{
        die("Error: " . $conn->error);
    }
}

// ok
function getPostDetails($post_id){
    $conn = dbConnect();
    
    $sql = "SELECT * FROM posts 
            INNER JOIN categories ON categories.category_id = posts.category_id 
            INNER JOIN users ON users.account_id = posts.account_id 
            WHERE post_id = $post_id";

    if($result = $conn->query($sql)){
        return $result->fetch_assoc();
    } else {
        die("Error: ". $conn->error);
    }        
}

// ok
function updatePost($post_id){
    $conn = dbConnect();
    $title = $_POST['title'];
    $date_posted = $_POST['date_posted'];
    $category_id = $_POST['category_id'];
    $author_id = $_POST['author_id'];
    $message = $_POST['message'];

    $sql = "UPDATE posts 
            SET post_title = '$title',
                date_posted = '$date_posted',
                category_id = $category_id,
                post_message = '$message',
                account_id = $author_id
            WHERE post_id = $post_id";

    if($conn->query($sql)){
        header("location: posts.php");
        exit;
    }else{
        die("Error: " . $conn->error);
    }
}

function updatePostByUser($post_id){
    $conn = dbConnect();
    $title = $_POST['title'];
    $date_posted = $_POST['date_posted'];
    $category_id = $_POST['category_id'];
    $message = $_POST['message'];

    $sql = "UPDATE posts 
            SET post_title = '$title',
                date_posted = '$date_posted',
                category_id = $category_id,
                post_message = '$message'
            WHERE post_id = $post_id";

    if($conn->query($sql)){
        header("location: posts.php");
        exit;
    }else{
        die("Error: " . $conn->error);
    }
}

// function getPost($post_id){
//     $conn = dbConnect();

//     $sql = "SELECT * FROM posts INNER JOIN categories ON categories.category_id = posts.category_id WHERE posts.post_id = $post_id";

//     if($result = $conn->query($sql)){
//         return $result->fetch_assoc();
//     } else {
//         die("Error: " . $conn->error);
//     }
// }