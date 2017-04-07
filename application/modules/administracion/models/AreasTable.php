<?php

class Administracion_Model_AreasTable {

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_em = null;

    public function __construct() {
        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();
    }

    public function getAreas($tipo) {

        $query = $this->_em->createQuery('SELECT a.id, a.titulo FROM My\Entity\AreaMunicipal a WHERE a.tipo <> ?1 AND a.tipo <> ?2 AND a.activo = true ORDER BY a.tipo ASC');

        switch ($tipo) {
            case "Secretaria":
                return NULL;
            case "Dirección":
                $query->setParameter(1, "Dirección");
                $query->setParameter(2, "Jefatura");

                $rowset = $query->getArrayResult();
                return $rowset;
            case "Jefatura":
                $query->setParameter(1, "Jefatura");
                $query->setParameter(2, "Jefatura");

                $rowset = $query->getArrayResult();
                return $rowset;
        }
    }

}
