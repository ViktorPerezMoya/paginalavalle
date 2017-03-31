<?php

class Default_DepartamentoController extends Zend_Controller_Action
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

    public function ubicacionAction()
    {
        $this->view->headTitle('Ubicación'); 
    }

    public function historiaAction()
    {
        $this->view->headTitle('Historía del departamento'); 
    }

    public function economiaAction()
    {
        $this->view->headTitle('Economía'); 
    }

    public function galeriaImagenesAction()
    {
        $this->view->headTitle('Galeria de Imagenes'); 
        $query = $this->_em->createQuery("select i from My\Entity\Galeria i where i.galeria = ?1 and i.estado = true ORDER BY i.id DESC");
        $query->setParameter(1, 'vendimia');

        $imagenes = $query->getResult();


        $this->view->imagenes = $imagenes;// action body
    }


}









