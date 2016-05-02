<?php

use Phalcon\Mvc\Controller;
use Phalcon\Paginator\Adapter\Model as Paginator;

class TesteController extends Controller
{

    public function indexAction()
    {
        echo "<h1>index</h1>";  
       $this->view->testa = "Isto é um INDEX"; 
    }
    public function testeAction()
    {
        echo "<h1>teste</h1>";
        $this->view->listagem = array(
           array('nome' => 'wawa','idade' => '10' ),
          array('nome' => 'Pedro','idade' => '20' ), 
         ); 
    }


    public function cadastroAction()
    {
      if($this->request->isPost()){
     try{ 
         $new = new Noticias();
         $new->nome = $this->request->get("nome");
         $new->descricao = $this->request->get("descricao");
         $new->data_publicacao = date("Y-m-d H:i:s");
         $new->status = "PUBLICADO"; 
         $new->save();
         echo "NOticia cadatrada com sucesso"; 
         return $this->dispatcher->forward(array("controller" => "teste","action" => "listagem"));
     }catch(Exception $e){
     echo "Erro"; 
          } 
       }else{
           
       }
         
    }
public function editarAction($id){
$noticia = Noticias::findFirstById($id);
if($noticia){
   $this->view->noticia = $noticia;
}else{
   echo "Noticia nao encontrada";
   return $this->dispatcher->forward(array("controller" => "teste","action" => "listagem"));
}

}

public function editandoAction(){
      if($this->request->isPost()){
     try{
         $new = new Noticias();
         $new->id = $this->request->get("id"); 
         $new->nome = $this->request->get("nome");
         $new->descricao = $this->request->get("descricao");
         $new->data_publicacao = date("Y-m-d H:i:s");
         $new->status =  $this->request->get("status");
         $new->save();
         echo "NOticia editada com sucesso";
         return $this->dispatcher->forward(array("controller" => "teste","action" => "listagem"));
     }catch(Exception $e){
         echo "Erro";
           
      }
       }else{
            
       }

}


    public function listagemAction(){
      $listagem = Noticias::find();
       $numberPage = $this->request->getQuery("page", "int") or 1;
            $paginator = new Paginator(array(
            "data"  => $listagem,
            "limit" => 10,
            "page"  => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
      
    }

public function deleteAction($id){
  $noticias = Noticias::findFirstById($id);
      if (!$noticias) {
          echo "Noticia nao encontrada";
          return $this->dispatcher->forward(array('controller' => 'teste','action' => 'listagem')); 
        }

      if (!$noticias->delete()) {

         echo "NÃO FOI POSSÍVEL DELETAR A NOTÍCIA"; 
          return $this->dispatcher->forward(array('controller' => 'teste','action' => 'listagem')); 
        }
     echo "Noticia deletada ";
     return $this->dispatcher->forward(array('controller' => 'teste','action' => 'listagem'));
}



}
