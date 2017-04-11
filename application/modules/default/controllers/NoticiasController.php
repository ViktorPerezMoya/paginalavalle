<?php

class Default_NoticiasController extends Zend_Controller_Action {

    /**
     * Redirector - defined for code completion
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_em = null;

    public function init() {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layout');

        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();

        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction() {
        // action body
    }

    public function novedadesAction() {
        $this->view->headTitle('Novedades'); 
        $query = $this->_em->createQuery("SELECT n FROM My\Entity\Noticia n ORDER BY n.fecha DESC");
        $query->setMaxResults(8);
        $nots = $query->getResult();

        $this->view->nots = $nots;
    }

    public function todasAction() {
        $this->view->headTitle('Todas las Noticias'); 

        $query = $this->_em->createQuery("SELECT n FROM My\Entity\Noticia n ORDER BY n.fecha DESC");
        $query->setMaxResults(8);
        $nots = $query->getResult();

        $this->view->nots = $nots;
    }

    public function crecemosAction() {
        $this->view->headTitle('Revista Crecemos'); 
    }

    public function noticiaAction() {

        $id = $this->getParam('idnoticia');
        $noticia = $this->_em->find('My\Entity\Noticia', $id);
        $this->view->headTitle($noticia->getTitulo()); 
        //var_dump($noticia);die();
        $this->view->noticia = $noticia;
    }

    public function masNoticiasAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $stringHtml = "";
        $ultimoid = $this->getParam('ultimoid');
        $accion = $this->getParam('accion');
        //var_dump($accion);die();
        
        $query = $this->_em->createQuery();
        if($accion == "siguiente"){
            $query = $this->_em->createQuery("SELECT n FROM My\Entity\Noticia n WHERE n.id < ?1 ORDER BY n.id DESC");
        }else if($accion == "anterior"){
            $query = $this->_em->createQuery("SELECT n FROM My\Entity\Noticia n WHERE n.id > ?1 ORDER BY n.id ASC");
        }
        
        $query->setParameter(1, $ultimoid);
        $query->setMaxResults(8);
        $nots = $query->getResult();
        //var_dump($nots);die();
        $n = new My\Entity\Noticia();
        $cont = 0;
        foreach ($nots as $n):
            if ($n === end($nots)) {
                $stringHtml .= '<input type="hidden" id="ultimoid" value="' . $n->getId() . '"/>';
            }
            if ($cont == 0 || $cont == 4) {

                $stringHtml .= '<div class="row">'
                        . '<div class="col-sm-6 col-md-3">' .
                        '<div class="thumbnail thumbnail-noticia">' .
                        '<a href="/paginamuni/public/noticias/noticia/idnoticia/' . $n->getId() . '">' .
                        '<img src="/paginamuni/public/img/noticias/' . $n->getImagennota() . '" style="height: 225px; width: 300px;" class="img_not_sec"></a>' .
                        '<div class="caption">' .
                        '<h3>' . $n->getTitulo() . '</h3>' .
                        '<p style="text-align: right; margin: 2px;"><strong>Fecha: '.  date_format(new DateTime($n->getFecha()), 'd-m-Y').'</strong></p>'.
                        '<p>' . $n->getCopete() . '</p>' .
                        '</div>' .
                        '</div>' .
                        '</div>';
            } else if ($cont == 3 || $cont == 7) {

                $stringHtml .= '<div class="col-sm-6 col-md-3">' .
                        '<div class="thumbnail thumbnail-noticia">' .
                        '<a href="/paginamuni/public/noticias/noticia/idnoticia/' . $n->getId() . '">' .
                        '<img src="/paginamuni/public/img/noticias/' . $n->getImagennota() . '" style="height: 225px; width: 300px;" class="img_not_sec"></a>' .
                        '<div class="caption">' .
                        '<h3>' . $n->getTitulo() . '</h3>' .
                        '<p style="text-align: right; margin: 2px;"><strong>Fecha: '.  date_format(new DateTime($n->getFecha()), 'd-m-Y').'</strong></p>'.
                        '<p>' . $n->getCopete() . '</p>' .
                        '</div>' .
                        '</div>' .
                        '</div>'
                        . '</div>';
            } else {

                $stringHtml .= '<div class="col-sm-6 col-md-3">' .
                        '<div class="thumbnail thumbnail-noticia">' .
                        '<a href="/paginamuni/public/noticias/noticia/idnoticia/' . $n->getId() . '">' .
                        '<img src="/paginamuni/public/img/noticias/' . $n->getImagennota() . '" style="height: 225px; width: 300px;" class="img_not_sec"></a>' .
                        '<div class="caption">' .
                        '<h3>' . $n->getTitulo() . '</h3>' .
                        '<p style="text-align: right; margin: 2px;"><strong>Fecha: '.  date_format(new DateTime($n->getFecha()), 'd-m-Y').'</strong></p>'.
                        '<p>' . $n->getCopete() . '</p>' .
                        '</div>' .
                        '</div>' .
                        '</div>';
            }
            
            $cont++;
        endforeach;
        //var_dump($stringHtml);
        echo $stringHtml;
    }

}
