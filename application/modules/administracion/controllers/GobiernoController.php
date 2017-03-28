<?php

class Administracion_GobiernoController extends Zend_Controller_Action
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
        $layout->setLayout('layoutadmin');

        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();

        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction()
    {
        // action body
    }

    public function areasMunicipalesAction()
    {
        $query = $this->_em->createQuery("SELECT a FROM My\Entity\AreaMunicipal a WHERE a.activo = ?1");
        $query->setParameter(1, true);
        $areas = $query->getResult();
        $this->view->areas = $areas;
    }

    public function nuevaAreaAction()
    {
        $form  = new Administracion_Form_AreaMunicipalForm();
        $this->view->form = $form;
        
        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            if($form->isValid($data)){
                $this->_em->getConnection()->beginTransaction();
                try {
                    $area = new My\Entity\AreaMunicipal();
                    $area->setTitulo($form->titulo->getValue());
                    $area->setAcargode($form->acargode->getValue());
                    $area->setCargoanterior($form->cargoanterior->getValue());
                    $area->setDireccion($form->direccion->getValue());
                    $area->setTelefono($form->telefono->getValue());
                    $area->setFunciones($form->funciones->getValue());
                    $area->setActivo(true);
                    
                    $this->_em->merge($area);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('areas-municipales');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarAreaAction()
    {
        // action body
    }


}







