<?php
$connection=new mysqli("localhost", "root", "bassem123admin", "blog");
header("content-type: application/json" );

if($connection->connect_error) {
    http_response_code(500);
    echo json_encode(["status"=>"error", "message" => "Database connection failed: " . $connection->connect_error]);
}else {
    http_response_code(200);
    echo json_encode(["status"=>"success", "message" => "connected to database successfully"]);
}