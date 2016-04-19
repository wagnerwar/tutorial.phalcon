<?php

use Phalcon\Mvc\Model;

class Noticias extends Model{
  public $id;
  public $nome;
  public $descricao;
  public $data_publicacao;

  public function  getDataPublicacao(){
    return date("Y-m-d",strtotime($this->data_publicacao));
  }
}
