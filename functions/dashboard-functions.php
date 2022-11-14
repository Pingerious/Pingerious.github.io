<?php
require_once 'connection.php';

function displayAllPosts(){
    $conn = dbConnect();
    $sql = "SELECT post_id, post_title, username, category_name, date_posted FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN accounts ON posts.account_id = accounts.account_id ORDER BY date_posted";

    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "
                    <tr>
                        <td>".$row['post_id']."</td>
                        <td class='fw-bold'>".$row['post_title']."</td>
                        <td>".$row['username']."</td>
                        <td>".$row['category_name']."</td>
                        <td>".date("M d, Y", strtotime($row['date_posted']))."</td>
                        <td>
                            <a href='post-details.php?post_id=".$row['post_id']."' class='btn btn-sm btn-outline-dark'><i class='fas fa-angle-double-right'></i> Details</a>
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

function countPosts($account_id){
    $conn = dbConnect();
    $sql = "SELECT COUNT(post_id) AS post_count FROM posts WHERE account_id = $account_id";

    if($result = $conn->query($sql)){
        $result_assoc = $result->fetch_assoc();
        return $result_assoc['post_count'];
    } else {
        die("Error: " . $conn->error);
    }
}

function countCategories(){
    $conn = dbConnect();
    $sql = "SELECT COUNT(category_id) AS category_count FROM categories";

    if($result = $conn->query($sql)){
        $result_assoc = $result->fetch_assoc();
        return $result_assoc['category_count'];
    } else {
        die("Error: " . $conn->error);
    }
}

function countUsers(){
    $conn = dbConnect();
    $sql = "SELECT COUNT(account_id) AS users_count FROM accounts WHERE `role` = 'U'";

    if($result = $conn->query($sql)){
        $result_assoc = $result->fetch_assoc();
        return $result_assoc['users_count'];
    } else {
        die("Error: " . $conn->error);
    }
}