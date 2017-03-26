<?php

class Administracion_Model_Candidata
{/**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_em = null;

    public function __construct() {
        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();
        
        
    }

    public function getCandidatas() {

        $query = $this->_em->createQuery('SELECT a.id_candidata, a.nombre FROM My\Entity\Candidata a WHERE a.periodo = ?1');
        $query->setParameter(1, date('Y'));

        $familias = $query->getResult();
//        var_dump($familias);
//        die();
        return $familias;
    }
    

}

