<?php

class Default_TurismoController extends Zend_Controller_Action
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

    public function sitiosAction()
    {
        // action body
    }

    public function alojamientoAction()
    {
        // action body
    }

    public function gastronomiaAction()
    {
        // action body
    }

    public function contactoInformesAction()
    {
        // action body
    }

    public function agendaCulturalAction()
    {
        // action body
    }


}











