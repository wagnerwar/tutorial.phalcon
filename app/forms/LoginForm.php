<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Password;

use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class LoginForm extends Form{

  public function initialize($entity=null,$options=array()){
  $element = new Text("username");
  $element->setLabel("Usuário: ");
  $this->add($element);

  $element  = new Password("senha");
  $element->setLabel("Senha ");
  $this->add($element);
}



}
