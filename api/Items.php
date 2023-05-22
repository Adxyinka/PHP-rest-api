<?php


    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include '../config/Database.php';
    include '../src/User.php';

    
    $database = new Database();
    $db = $database->connection();
    $items = new User($db);
    $stmt = $items->getitems();
    $itemCount = $stmt->rowCount();
    
    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $itemArr = array();
        $itemArr["body"] = array();
        $itemArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "title" => $title,
                "body" => $body,
                "created_at" => $created_at
            );
            array_push($itemArr["body"], $e);
        }
        echo json_encode($itemArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }