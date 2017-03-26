<?php

namespace My\Entity\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class MyEntityNoticiaProxy extends \My\Entity\Noticia implements \Doctrine\ORM\Proxy\Proxy
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

    public function getCopete()
    {
        $this->_load();
        return parent::getCopete();
    }

    public function getContenido()
    {
        $this->_load();
        return parent::getContenido();
    }

    public function getFecha()
    {
        $this->_load();
        return parent::getFecha();
    }

    public function getImagenportada()
    {
        $this->_load();
        return parent::getImagenportada();
    }

    public function getImagennota()
    {
        $this->_load();
        return parent::getImagennota();
    }

    public function isMostrar()
    {
        $this->_load();
        return parent::isMostrar();
    }

    public function getUsuario()
    {
        $this->_load();
        return parent::getUsuario();
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

    public function setCopete($copete)
    {
        $this->_load();
        return parent::setCopete($copete);
    }

    public function setContenido($contenido)
    {
        $this->_load();
        return parent::setContenido($contenido);
    }

    public function setFecha($fecha)
    {
        $this->_load();
        return parent::setFecha($fecha);
    }

    public function setImagenportada($imagenportada)
    {
        $this->_load();
        return parent::setImagenportada($imagenportada);
    }

    public function setImagennota($imagennota)
    {
        $this->_load();
        return parent::setImagennota($imagennota);
    }

    public function setMostrar($mostrar)
    {
        $this->_load();
        return parent::setMostrar($mostrar);
    }

    public function setUsuario($usuario)
    {
        $this->_load();
        return parent::setUsuario($usuario);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'titulo', 'copete', 'contenido', 'fecha', 'imagenportada', 'imagennota', 'mostrar', 'usuario');
    }
}