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
        $this->view->headTitle('Jardines Maternales'); 
    }

    public function delegacionesAction()
    {
        $this->view->headTitle('Delegaciones'); 
    }

    public function cdrAction()
    {
        $this->view->headTitle('C.D.R.'); 
    }

    public function bibliotecaPublicaAction()
    {
        $this->view->headTitle('Biblioteca Publica'); 
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
        $this->view->headTitle('Hospital'); 
    }

    public function educacionAction()
    {
        $this->view->headTitle('Educación'); 
    }

    public function acuerdo3949Action()
    {
        // action body
    }

    public function familiaAction()
    {
        $this->view->headTitle('Familia'); 
    }
    
    public function viviendaAction(){
        $this->view->headTitle('Vivienda'); 
        
    }
    
    public function cicAction(){
        $this->view->headTitle('C.I.C.'); 
        
    }

    public function desarrolloHumanoAction(){
        $this->view->headTitle('Desarrollo Humano'); 
        
    }
    
    public function culturaAction(){
        $this->view->headTitle('Cultura'); 
        
    }
    
    public function ventanillaUnicaAction(){
        $this->view->headTitle('Ventanilla Única'); 
        
    }
    
    public function farmaciasAction(){
        $this->view->headTitle('Farmacias'); 
        
    }
}









