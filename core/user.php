<?php
class User{
  private $conn;
  private $table = "Users";

  //attributes
  public $id;
  public $email;
  public $num_steps;

  public function __construct($db){
    $this->conn = $db;
  }

  public function read(){
    $query = "SELECT * FROM ".$this->table;

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  public function read_one(){
    $query = "SELECT * FROM ".$this->table." WHERE email=:email";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email",$this->email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){
      $this->num_steps = $row["num_steps"];
      return true;
    }else{
      return false;
    }
  }

  public function create(){
    $query = "INSERT INTO ".$this->table."(email) VALUES (:email)";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email",$this->email);

    return $stmt->execute();
  }

  public function update_email($old_email){
    $query = "UPDATE ".$this->table." SET email=:new_email WHERE email=:old_email";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":new_email",$this->email);
    $stmt->bindParam(":old_email",$old_email);

    return $stmt->execute();
  }

  public function update_steps($steps_to_add){
    $this->get_user_steps();

    $this->num_steps += $steps_to_add;
    $query = "UPDATE ".$this->table." SET num_steps=:num_steps WHERE email=:email";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":num_steps",$this->num_steps);
    $stmt->bindParam(":email",$this->email);

    return $stmt->execute();
  }
  
  public function del_user(){
    $query = "DELETE FROM ".$this->table." WHERE email=:email";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email",$this->email);

    return $stmt->execute();
  }

  public function get_total_steps(){
    $query = "SELECT SUM(num_steps) as total_steps FROM ".$this->table." WHERE 1";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row["total_steps"];
  }

  public function get_user_steps(){
    $query = "SELECT num_steps FROM ".$this->table." WHERE email=:email";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email",$this->email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){
      $this->num_steps = $row["num_steps"];
      return true;
    }else{
      return false;
    }
  }
}
?>
