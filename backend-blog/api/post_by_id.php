<?php
include '../connection.php';
$data = json_decode(file_get_contents('php://input'), true);
$id=$data['id'];
//validate the the user input contain id of post
if(!isset($id)){
    echo json_encode(["status"=>"failed", "message"=>"'id' of the post is required"]);
    exit();
}else{
// returning the post by its id 
$statment1=$connection->prepare("SELECT title,content,user_id FROM posts WHERE id=?");
$statment1->bind_param("i", $id);
$statment1->execute();
$result1=$statment1->get_result();
$raw1=$result1->fetch_assoc();
$post=[];
while($raw1){
    $post[]=$raw1;
    $raw1=$result1->fetch_assoc();
}
//returning the latest 15 comments on that post
// where order by id desc used to choose by decreasing order
// and limit 15 to limit the number of comments returned
$statment2=$connection->prepare("SELECT id,content,user_id FROM comments WHERE post_id=? 
ORDER BY id DESC LIMIT 15");
$statment2->bind_param("i", $id);
$statment2->execute();
$result2=$statment2->get_result();
$raw2=$result2->fetch_assoc();
$comments=[];
while($raw2){
    $comments[]=$raw2;
    $raw2=$result2->fetch_assoc();
}
//validations if post and comments exists 
if(empty($post)){
    echo json_encode(["status"=>"failed", "message"=>"there is no post with this id"]);
    exit();
}else{
     if(empty($comments)){
    echo json_encode([
        "status"=>"success",
        "message"=>"there by post",
        "post"=>$post,
        "comments"=>"no comments on this post yet"
        
    ]);
}else{
echo json_encode([
    "status"=>"success",
    "message 1"=>"there by post",
    "post"=>$post,
    "message 2"=>"their are comments on this post",
    "comments"=>$comments
]);
}
}
}