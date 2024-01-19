<?php
header("Acces-Control-Origin: *");
header("Content-Type: application/json");

include_once("../../core/init.php");

$user = new User($db);

if(!isset($_GET["email"])){
  echo json_encode(array(
    "total_steps" => $user->get_total_steps()
  ));
}else{
  $user->email = $_GET["email"];
  if($user->get_user_steps()){
    echo json_encode(array(
      "num_steps" => $user->num_steps
    ));
  }else{
    echo json_encode(array(
      "message" => "No user with such email"
    ));
  }
}
?>
