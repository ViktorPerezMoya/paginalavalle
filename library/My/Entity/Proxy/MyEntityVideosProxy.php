<?php

namespace My\Entity\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class MyEntityVideosProxy extends \My\Entity\Videos implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    private function _load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    
    public function getId()
    {
        $this->_load();
        return parent::getId();
    }

    public function getTitulo()
    {
        $this->_load();
        return parent::getTitulo();
    }

    public function getIdyoutube()
    {
        $this->_load();
        return parent::getIdyoutube();
    }

    public function setId($id)
    {
        $this->_load();
        return parent::setId($id);
    }

    public function setTitulo($titulo)
    {
        $this->_load();
        return parent::setTitulo($titulo);
    }

    public function setIdyoutube($idyoutube)
    {
        $this->_load();
        return parent::setIdyoutube($idyoutube);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'titulo', 'idyoutube');
    }
}