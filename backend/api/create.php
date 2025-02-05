<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once __DIR__ . '/../core/init.php';

$user = new Users($db);

$data = json_decode(file_get_contents("php://input"));

$user->full_name = $data->full_name;
$user->login = $data->login;
$user->password = $data->password;
$user->role_id = $data->role_id;
$user->is_blocked = $data->is_blocked;

// create user
if($user->create()) {
    http_response_code(200);
    echo json_encode(
        array('message' => 'Post created')
    );
} else {
    http_response_code(400);
    echo json_encode(
        array('message' => 'Post could not be created')
    );
}