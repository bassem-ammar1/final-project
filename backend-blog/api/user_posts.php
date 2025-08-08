<?php
include "../connection.php";

$data = json_decode(file_get_contents('php://input'), true);
$user_id=$data['user_id'];
if(!isset($user_id)){
    echo json_encode(["status"=>"failed",
    "message"=>"user_id is required"]);
exit();
}else{
//select the latest 10 posts posted by a spacific user ordered by most recent first 
$result=$connection->query("SELECT id,title,content FROM posts
 WHERE user_id=$user_id ORDER BY id DESC LIMIT 10");
$raw=$result->fetch_assoc();
$posts=[];
while($raw){
    $posts[]=$raw;
    $raw=$result->fetch_assoc();
}

//validations if user have posted or not
if(empty($posts)){
    echo json_encode([
        "status"=>"failed",
        "message"=>"user_id isn't found, enter a valid user_id then try again"
    ]);
    exit();
}else{
echo json_encode([
    "status"=>"success",
    "message"=>"their by are posts",
    "posts"=>$posts
]);
}
}