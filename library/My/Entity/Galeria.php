<?php

namespace My\Entity;

/**
 * @Entity
 */

class Galeria {
    
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
     * @Column(type="string", length=255)
     */
    private $titulo;
    /**
     *
     * @var string
     * @Column(type="string", length=255)
     */
    private $url;
    /**
     *
     * @var string
     * @Column(type="string", length=255)
     */
    private $galeria;
    /**
     *
     * @var boolean
     * @Column(type="boolean", length=255)
     */
    private $estado;
    function __construct() {
        
    }
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getUrl() {
        return $this->url;
    }

    function getGaleria() {
        return $this->galeria;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setGaleria($galeria) {
        $this->galeria = $galeria;
    }

    function setEstado($estado = true){
        $this->estado = $estado;
    }

    function getEstado(){
         return $estado;
    }

    
}
