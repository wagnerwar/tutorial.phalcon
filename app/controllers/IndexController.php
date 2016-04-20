<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

    public function indexAction()
    {
      $this->view->noticias = $this->db->query("SELECT * FROM noticias WHERE status = 'PUBLICADO'")->fetchAll();
    }


}
