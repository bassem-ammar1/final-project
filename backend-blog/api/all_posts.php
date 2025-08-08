<?php
include '../connection.php';

//select posts most recent first
$result1=$connection->query("SELECT * FROM posts ORDER BY id DESC");
$raw1=$result1->fetch_assoc();
$posts=[];
while($raw1){
    $posts[]=$raw1;
    $raw1=$result1->fetch_assoc();
}
//select count of comments on each post ordered by post_id of each comment(so that the two results match)
$result2=$connection->query("SELECT post_id,COUNT(id)  AS count FROM comments
 GROUP BY post_id ORDER BY post_id DESC");
$raw2=$result2->fetch_assoc();
$count=[];
while($raw2){
    $count[]=$raw2;
    $raw2=$result2->fetch_assoc();
}
//validations if their exist posts or not 
if(empty($posts)){
    echo json_encode(["status"=>"failed", "message"=>"there is no posts"]);
    exit();
}else{
    echo json_encode([
        "status"=>"success",
        "message"=>"there are posts",
        "posts"=>$posts,
        "count of comments on each post"=>$count
        
    ]);
}