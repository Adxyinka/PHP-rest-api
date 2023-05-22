<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include '../config/Database.php';
    include '../src/User.php';

    $database = new Database();
    $db = $database->connection();
    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));

    
    // $item->user_id = $data->user_id;
    $item->username = $data->username;
    $item->password = $data->password;

    if($item->createUser()) {
        http_response_code(201);
        echo "User created succcessfuly";
    } else {
        echo "User creation error";
    }