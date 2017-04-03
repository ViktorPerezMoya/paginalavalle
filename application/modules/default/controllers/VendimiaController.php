<?php

class Default_VendimiaController extends Zend_Controller_Action
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
        $this->view->headTitle("Vendimia");
    }

    public function indexAction()
    {
        $this->view->headTitle('Vendimia'); 
        $queryreina = $this->_em->createQuery('SELECT c FROM My\Entity\Candidata c WHERE c.reina = 1 AND c.estado = 0 ORDER BY c.periodo ASC');
        $reinas = $queryreina->getResult();

        if (sizeof($reinas) > 0) {
            $reina = $reinas[sizeof($reinas) - 1];
        } else {
            $reina = null;
        }

        $this->view->reina = $reina;
        
        // GALERIA
        $query = $this->_em->createQuery("select i from My\Entity\Galeria i where i.galeria = ?1 and i.estado = true ORDER BY i.id DESC");
        $query->setParameter(1, 'vendimia');

        $imagenes = $query->getResult();


        $this->view->imagenes = $imagenes;
    }

    public function candidatasAction()
    {
        $this->view->headTitle('Candidatas'); 
        $candidatas = $this->_em->getRepository('My\Entity\Candidata')->findBy(array('periodo' => date('Y'), 'estado' => false));
        $this->view->candidatas = $candidatas;
    }


}



