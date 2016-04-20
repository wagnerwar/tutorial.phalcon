<?php
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Usuarios extends Model{

  public $username;
  public $senha;
  public $data_cadastro;

  public function  getDataCadastro(){
    return date("Y-m-d",strtotime($this->data_cadastro));
  }

  public function checkLogin(){
    $this->db = $this->getDi()->getShared('db');
    $stmt = $this->db->prepare("SELECT count(*) as qtd  FROM usuarios WHERE username = :username and senha = :senha");
    $stmt->execute(array('username' => $this->username,'senha' => $this->senha));
    if($stmt->fetchAll()[0]['qtd'] == 0){
      return false;

    }else{
        return true;
    }
  }
}
