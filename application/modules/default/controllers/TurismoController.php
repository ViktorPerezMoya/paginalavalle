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
        $query = $this->_em->createQuery("SELECT s FROM My\Entity\Sitios s WHERE s.tipo = ?1");
        $query->setParameter(1, "sitios");
        
        $sitios = $query->getResult();
        $this->view->sitios = $sitios;
    }

    public function alojamientoAction()
    {
        $query = $this->_em->createQuery("SELECT s FROM My\Entity\Sitios s WHERE s.tipo = ?1");
        $query->setParameter(1, "alojamiento");
        
        $sitios = $query->getResult();
        $this->view->alojamiento = $sitios;
    }

    public function gastronomiaAction()
    {
        $query = $this->_em->createQuery("SELECT s FROM My\Entity\Sitios s WHERE s.tipo = ?1");
        $query->setParameter(1, "gastronomia");
        
        $sitios = $query->getResult();
        $this->view->gastronomia = $sitios;
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











