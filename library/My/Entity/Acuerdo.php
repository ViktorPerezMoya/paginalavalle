<?php

namespace My\Entity;

/**
 * @Entity
 */
class Acuerdo {
    /**
     * @var integer 
     * @Column (type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $descripcion;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $url;
    /**
     * 
     * @var integer
     * @Column(type="integer")
     */
    private $ejercicio;
    /**
     * 
     * @var integer
     * @Column(type="integer")
     */
    private $periodo;  
    /**
     * @var boolean
     * @Column (type="boolean", nullable=false)
     * 
     */
    private $estado;
    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getUrl() {
        return $this->url;
    }

    function getEjercicio() {
        return $this->ejercicio;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setEjercicio($ejercicio) {
        $this->ejercicio = $ejercicio;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }
    function isMostrar() {
        return $this->estado;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }



}
