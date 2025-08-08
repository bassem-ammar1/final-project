<?php
include "../connection.php";
$data = json_decode(file_get_contents('php://input'), true);
$id=$data['id'];
$content=$data['content'];
//validate if id and content are set in the body
if(!isset($id)){
    echo json_encode([
        "status"=>"failed",
        "message"=>"id is required"
    ]);
    exit();
}else{
if(!isset($content)){
    echo json_encode([
        "status"=>"failed",
        "message"=>"content is required"
    ]);
    exit();
}else{
// variable validation is used to see if comment exist or not    
$validation=$connection->query("SELECT * FROM comments WHERE id=$id");
$raw=$validation->fetch_assoc();
//if comment exist it will be updated
if(isset($raw)){
$statment=$connection->prepare("UPDATE comments SET content=? WHERE id=?");
$statment->bind_param("si",$content,$id);
$statment->execute();
$result=$statment->get_result();
echo json_encode([
    "status"=>"success",
    "message"=>"comment updated successfully"
]);

}
//if comment doesn't exist a message will be displayed 
else{
    echo json_encode([
        "status"=>"failed",
        "message"=>"enter a valid comment id then try again"
    ]);
}

}
}