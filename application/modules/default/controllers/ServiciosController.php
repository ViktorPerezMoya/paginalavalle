<?php

class Default_ServiciosController extends Zend_Controller_Action
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
        // action body
    }

    public function jardinesMaternalesAction()
    {
        // action body
    }

    public function delegacionesAction()
    {
        // action body
    }

    public function cdrAction()
    {
        // action body
    }

    public function bibliotecaPublicaAction()
    {
        // action body
    }
    
    //otros servicios
    
    public function telefonosAction()
    {
        $this->view->headTitle('Telefonos'); 
    }

    public function colectivosAction()
    {
        $this->view->headTitle('Colectivos'); 
        $query = $this->_em->createQuery("SELECT s FROM My\Entity\Seccion s WHERE s.titulo = 'Colectivos'");
        $this->view->horarios = $query->getSingleResult()->getArchivos();
    }

    public function hospitalAction()
    {
        // action body
    }

    public function educacionAction()
    {
        // action body
    }

    public function acuerdo3949Action()
    {
        // action body
    }

    public function familiaAction()
    {
        // action body
    }
    
    public function viviendaAction(){
        
    }
    
    public function cicAction(){
        
    }

    public function desarrolloHumanoAction(){
        
    }
    
    public function culturaAction(){
        
    }
    
    public function ventanillaUnicaAction(){
        
    }
    
    public function farmaciasAction(){
        
    }
}









