<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Date;

use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class EditarNoticiaForm extends Form{

  public function initialize($entity=null,$options=array()){
      $this->add(new Hidden("id"));

      $element = new Text("nome");
      $element->setLabel("Titulo");
      $element->setFilters(array('striptags','string'));
      $this->add($element);

      $element = new TextArea("descricao");
      $element->setLabel("Descricao");
      $element->setFilters(array('striptags','string'));
      $this->add($element);


        $element =  new Select(
              "status",
              array(
                  "PUBLICADO" => 'Publicar',
                  "PRIVADO" => 'Privado'
              )
          );

        $element->setLabel("Status");
        $this->add($element);


      // Data
      $element = new Date("data_publicacao");
      $element->setLabel("Data de publicacao");
      //$element->setFilters(array(''));
      $this->add($element);


  }
}
