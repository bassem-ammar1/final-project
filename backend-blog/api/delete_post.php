<?php


include '../connection.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
if (!isset($id)) {
    echo json_encode(["status" => "failed", "message" => "id is required"]);
    exit();
}else{
//validate if post exist or not
$validation=$connection->query("SELECT * FROM posts WHERE id='$id'");
$result=$validation->fetch_assoc();
// Delete comments first refferencing the post if they exist(to avoid errors since id is FK)
$statment1 = $connection->prepare("DELETE FROM comments WHERE post_id = ?");
$statment1->bind_param("i", $id);
$statment1->execute();

// Now we can delete the post
$statment2 = $connection->prepare("DELETE FROM posts WHERE id = ?");
$statment2->bind_param("i", $id);
$statment2->execute();
//see if post exist,then delete the post
if(empty($result)){
    echo json_encode(["status" => "failed",
     "message" => "post not found,enter valid id then try again"]);
     exit();
}else{

echo json_encode(["status" => "success", "message" => "Post deleted successfully"]);
}
}