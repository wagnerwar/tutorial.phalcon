<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;

class SessionController extends Controller
{
    public function indexAction(){
        if($this->session->has("logado")){
          $this->flash->error("Usuario ja logado");
          return $this->dispatcher->forward(array('controller' => 'index','action' => 'index'));
        }else{
          $this->view->form = new LoginForm();
      }
    }

    public function logarAction(){
      if($this->request->isPost()){
          $usuario  = new Usuarios();
          $form = new LoginForm();
          if(!$form->isValid($this->request->getPost(),$usuario)){
              $this->flash->error("Usuario nao autenticado");
              return $this->dispatcher->forward(array('controller' => 'session','action' => 'index'));
          }else{
            $res = $usuario->checkLogin();
            if($res == false){
              $this->flash->error("Usuário não autenticado");
              return $this->dispatcher->forward(array('controller' => 'session','action' => 'index'));

            }else{
              $this->session->set("logado",true);
              $this->flash->success("Usuário validado com sucesso");
              return $this->dispatcher->forward(array('controller' => 'index','action' => 'index'));
            }


          }

      }
    }

    public function deslogarAction(){
        if($this->session->has("logado")){
          $this->session->remove("logado");
          $this->flash->success("Usuário deslogado com sucesso");
          return $this->dispatcher->forward(array('controller' => 'index','action' => 'index'));
        }else{

          $this->flash->error("Usuário já havia se deslogado ");
          $this->dispatcher->forward(array('controller' => 'index','action' => 'index'));
        }
    }

}
