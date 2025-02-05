<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once __DIR__ . '/../core/init.php';

$user = new Users($db);

$result = $user->getAll();

$num = $result->rowCount();

if($num > 0) {
  $user_arr = array();
  $user_arr['data'] = array();

  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $user_item = array(
        'id' => $id,
        'full_name' => $full_name,
        'login' => $login,
        'is_blocked' => $is_blocked,
        'role_name' => $role_name
    );
    array_push($user_arr['data'], $user_item);
  }

  // convert to json
  echo json_encode($user_arr);

} else {
  echo json_encode(array('msg' => 'Not found of users'));
}