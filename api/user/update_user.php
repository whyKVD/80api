<?php
header("Access-Control-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Method: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Origin,Access-Control-Allow-Method,Content-Type,X-Requested-With");

include_once("../../core/init.php");

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if(isset($data->new_email)){
  $user->email = $data->new_email;

  if($user->update_email($data->old_email)){
    echo json_encode(array("message" => "User updated"));
  }else{
    echo json_encode(array("message" => "Some error has occurred while updating the user"));
  }
}else if(isset($data->steps_to_add)){
  $user->email = $data->email;

  if($user->update_steps($data->steps_to_add)){
    echo json_encode(array(
      "message" => "Steps updated successfully"
    ));
  }else{
    echo json_encode(array(
      "message" => "Some error has occurred while updating the steps"
    ));
  }
}
?>
