<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;

class NoticiasController extends Controller
{

    public function indexAction()
    {
            //Listando noticias

            $numberPage = $this->request->getQuery("page", "int") or 1;
            $noticias = Noticias::find();

            $paginator = new Paginator(array(
            "data"  => $noticias,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();

    }

    public function cadAction()
    {

        if($this->request->isPost()){

            $noticia = new Noticias();
            $form = new NoticiaForm();
            if(!$form->isValid($this->request->getPost(),$noticia)){
              foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }


              return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'cad'));
            }else{
              $dta = str_replace("/","-",$this->request->getPost("data_publicacao"));
              $dta = date("Y-m-d",strtotime($dta));
              $noticia->data_publicacao = $dta;

              if($noticia->save() == false){

                $this->flash->error("Erro de base de dados");
              }else{

                $this->flash->success("Sucesso");
              }

              return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'index'));
            }

        }else{
          $this->view->form = new NoticiaForm();
        }
    }

    public function editarAction($id){
        if(!$this->request->isPost()){
          $noticia = Noticias::findFirstById($id);
        if (!$noticia) {
            $this->flash->error("Noticia nao encontrada");
            return $this->forward("noticias/index");
        }
        $this->view->form = new EditarNoticiaForm($noticia,array());
    }else{
      $noticia = new Noticias();
      $form = new EditarNoticiaForm();
      if(!$form->isValid($this->request->getPost(),$noticia)){
        foreach ($form->getMessages() as $message) {
          $this->flash->error($message);
      }

       return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'editar','params' => array('id' => $id) ));

    }else{

      if($noticia->save() == false){
          $this->flash->error("Erro de base de dados");
          return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'editar','params' => array('id' => $id) ));
      }
      return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'index'));
    }

  }
}

public function updateNoticiaAction(){
  if($this->request->isPost()){
    $noticia = new Noticias();
    $form = new EditarNoticiaForm();
    if(!$form->isValid($this->request->getPost(),$noticia)){
      foreach ($form->getMessages() as $message) {
        $this->flash->error($message);
    }

     return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'editar','params' => array('id' => $id) ));

  }else{
    $noticia->id = $this->request->getPost("id");
    $dta = str_replace("/","-",$this->request->getPost("data_publicacao"));
    $dta = date("Y-m-d",strtotime($dta));
    $noticia->data_publicacao = $dta;


    if($noticia->save() == false){
        $this->flash->error("Erro de base de dados");
        return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'editar','params' => array('id' => $id) ));
    }else{
      $this->flash->success("Sucesso");
      return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'index'));

    }
    return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'index'));
  }

  }
}

public function deleteNoticiaAction($id){
  $noticias = Noticias::findFirstById($id);
      if (!$noticias) {
          $this->flash->error("Noticia nao foi encontrada");
          return $this->forward("noticias/index");
      }

      if (!$noticias->delete()) {
          foreach ($noticias->getMessages() as $message) {
              $this->flash->error($message);
          }
          return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'index'));
      }

      $this->flash->success("Noticia deletada");
      return $this->dispatcher->forward(array('controller' => 'noticias','action' => 'index'));

}

}
