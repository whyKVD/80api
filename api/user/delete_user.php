<?php
header("Access-Control-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Origin,Access-Control-Allow-Method,Content-Type,X-Requested-With");

include_once("../../core/init.php");

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;

if($user->del_user()){
  echo json_encode(array("message" => "User deleted"));
}else{
  echo json_encode(array("message" => "Some error has occurred while deleting the user"));
}

?>
