<?php

class Default_GobiernoController extends Zend_Controller_Action
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

    public function intendenciaAction()
    {
        // action body
    }

    public function asesoriaLegalAction()
    {
        // action body
    }

    public function areasMunicipalesAction()
    {   
        $query = $this->_em->createQuery("SELECT a FROM My\Entity\AreaMunicipal a WHERE a.activo = ?1 AND a.vista = 'areas'");
        $query->setParameter(1, true);
        $areas = $query->getResult();
        $this->view->areas = $areas;
    }

    public function secretariaDeObrasYServiciosPublicosAction()
    {
        $query = $this->_em->createQuery("SELECT o FROM My\Entity\Obra o WHERE o.activo = ?1");
        $query->setParameter(1,true);
        $obras = $query->getResult();
        $this->view->obras = $obras;

        $query = $this->_em->createQuery("SELECT a FROM My\Entity\AreaMunicipal a WHERE a.activo = ?1 AND a.vista = 'secretaria-obras'");
        $query->setParameter(1, true);
        $direcciones = $query->getResult();
        $this->view->direcciones = $direcciones;
    }

    public function concejoAction()
    {
        $query = $this->_em->createQuery("SELECT c FROM My\Entity\ProyectoHCD c WHERE c.tipo = ?1");
        $query->setParameter(1,"Declaracion");
        $this->view->declaraciones = $query->getResult();

        $query->setParameter(1,"Ordenanza");
        $this->view->ordenanzas = $query->getResult(); 

        $query->setParameter(1,"Ordenanza Tarifaria");
        $this->view->ordTarifarias = $query->getResult();

        $query->setParameter(1,"Resolucion");
        $this->view->resoluciones = $query->getResult();       
    }


}











