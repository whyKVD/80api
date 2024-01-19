<?php
header("Acces-Control-Origin: *");
header("Content-Type: application/json");

include_once("../../core/init.php");

$user = new User($db);

if(!isset($_GET["email"])){
  $result = $user->read();

  if($result->rowCount() > 0){
    $user_arr = array();
    $user_arr["data"] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);

      $user_item = array(
        "id" => $id,
        "email" => $email,
        "num_steps" => $num_steps
      );

      array_push($user_arr["data"], $user_item);
    }

    echo json_encode($user_arr);
  }else{
    echo json_encode(array("message" => "Database empty"));
  }
}else{
  $user->email = $_GET["email"];

  if($user->read_one()){
    echo json_encode(array(
      "email"     => $user->email,
      "num_steps" => $user->num_steps
    ));
  }else{
    echo json_encode(array(
      "message" => "No user with such email"
    ));
  }
}
?>
