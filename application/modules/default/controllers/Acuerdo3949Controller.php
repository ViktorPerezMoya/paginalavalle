<?php

class Default_Acuerdo3949Controller extends Zend_Controller_Action {

    /**
     * @var Bisna\Application\Container\DoctrineContainer
     */
    protected $_doctrineContainer = null;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_em = null;

    public function init() {
        /* Initialize action controller here */
        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();
    }

    public function indexAction() {
        $this->view->headTitle('Acuerdo 3949'); 
//        $resultado = new My\Entity\DocumentoAcuerdo();
        $var = $this->getRequest()->getPost('acuerdo');
        $this->view->var = $var;
        if (isset($var)) {
            $ejercicio = substr($var, 0, 4);
            $periodo = substr($var, 4, 1);
            $resultado = $this->getAcuerdos3949($ejercicio, $periodo);
            $this->view->acuerdosResult = $resultado;
//            var_dump($resultado);
//            die();
        }
//        var_dump($var);
//        die();

        $query = $this->_em->createQuery("SELECT acuerdo.ejercicio, acuerdo.periodo FROM My\Entity\Acuerdo acuerdo GROUP BY acuerdo.ejercicio, acuerdo.periodo ORDER BY acuerdo.id DESC");
        $result = $query->getResult();

        $this->view->acuerdos = $result;
    }

    public function getAcuerdos3949($eje, $per) {
        $query = $this->_em->createQuery("SELECT acuerdo FROM My\Entity\Acuerdo acuerdo WHERE acuerdo.ejercicio = ?1 AND acuerdo.periodo = ?2");
        $query->setParameter(1, $eje);
        $query->setParameter(2, $per);
        $result = $query->getResult();

        return $result;
    }

}
