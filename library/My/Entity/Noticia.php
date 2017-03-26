<?php

namespace My\Entity;
/**
 * @Entity
 */
class Noticia {
    
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
     * @Column(type="string")
     */
    private $titulo;
    
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $copete;
    
    /**
     * 
     * @var string
     * @Column(type="text")
     */
    private $contenido;
    
    /**
     *
     * @var datetime
     * @Column (type="datetime", nullable=true)
     * @Timestamp
     */
    private $fecha;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $imagenportada;
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $imagennota;
    
    /**
     *
     * @var boolean
     * @column (type="boolean")
     */
    private $mostrar;
    
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $usuario;
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getCopete() {
        return $this->copete;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getFecha() {
        return date_format($this->fecha, 'Y-m-d H:i:s');
    }

    function getImagenportada() {
        return $this->imagenportada;
    }

    function getImagennota() {
        return $this->imagennota;
    }

    function isMostrar() {
        return $this->mostrar;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setCopete($copete) {
        $this->copete = $copete;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setFecha($fecha) {
        $this->fecha = new \DateTime($fecha);
    }

    function setImagenportada($imagenportada) {
        $this->imagenportada = $imagenportada;
    }

    function setImagennota($imagennota) {
        $this->imagennota = $imagennota;
    }

    function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }


    
}
