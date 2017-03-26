<?php

namespace My\Entity\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class MyEntityUsuarioProxy extends \My\Entity\Usuario implements \Doctrine\ORM\Proxy\Proxy
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

    public function getUsuario()
    {
        $this->_load();
        return parent::getUsuario();
    }

    public function getClave()
    {
        $this->_load();
        return parent::getClave();
    }

    public function getNombre()
    {
        $this->_load();
        return parent::getNombre();
    }

    public function getRol()
    {
        $this->_load();
        return parent::getRol();
    }

    public function getEstado()
    {
        $this->_load();
        return parent::getEstado();
    }

    public function getEmail()
    {
        $this->_load();
        return parent::getEmail();
    }

    public function getValidado()
    {
        $this->_load();
        return parent::getValidado();
    }

    public function setId($id)
    {
        $this->_load();
        return parent::setId($id);
    }

    public function setUsuario($usuario)
    {
        $this->_load();
        return parent::setUsuario($usuario);
    }

    public function setClave($clave)
    {
        $this->_load();
        return parent::setClave($clave);
    }

    public function setNombre($nombre)
    {
        $this->_load();
        return parent::setNombre($nombre);
    }

    public function setRol($rol)
    {
        $this->_load();
        return parent::setRol($rol);
    }

    public function setEstado($estado)
    {
        $this->_load();
        return parent::setEstado($estado);
    }

    public function setEmail($email)
    {
        $this->_load();
        return parent::setEmail($email);
    }

    public function setValidado($validado)
    {
        $this->_load();
        return parent::setValidado($validado);
    }

    public function getCuil()
    {
        $this->_load();
        return parent::getCuil();
    }

    public function setCuil($cuil)
    {
        $this->_load();
        return parent::setCuil($cuil);
    }

    public function getCodigovalidacion()
    {
        $this->_load();
        return parent::getCodigovalidacion();
    }

    public function setCodigovalidacion($codigovalidacion)
    {
        $this->_load();
        return parent::setCodigovalidacion($codigovalidacion);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'usuario', 'clave', 'nombre', 'cuil', 'rol', 'estado', 'email', 'validado', 'codigovalidacion');
    }
}