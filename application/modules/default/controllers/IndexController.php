<?php

class Default_IndexController extends Zend_Controller_Action
{
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

    public function indexAction()
    {
        
        //$this->_helper->layout->disableLayout();
        
        $this->view->headTitle('Municipalidad de Lavalle'); 
        
        $query = $this->_em->createQuery("SELECT n FROM My\Entity\Noticia n WHERE n.mostrar = 1 AND n.imagenportada IS NOT NULL ORDER BY n.id DESC");
        $query->setMaxResults(10);
        $this->view->noticiasportada = $query->getResult();
        
        $query2 = $this->_em->createQuery("SELECT n FROM My\Entity\Noticia n WHERE n.mostrar = 1 AND n.imagenportada IS NULL ORDER BY n.id DESC");
        $query2->setMaxResults(20);
        $this->view->noticias = $query2->getResult();
        
        $query3 = $this->_em->createQuery("SELECT v FROM My\Entity\Videos v ORDER BY v.id DESC");
        $query3->setMaxResults(4);
        $videos = $query3->getResult();
        $this->view->videos = $videos;
        
        
        
    }
    
    public function bienvenidoAction(){
        $this->view->headTitle('Bienvenido Contribuyente'); 
        
        $rol = Zend_Auth::getInstance()->getIdentity()->getRol();
        $this->view->rol = $rol;
    }
    
}













