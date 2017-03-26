<?php

namespace My\Entity;

/**
 * @Entity
 */
class Subcontenido {
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
    private $titulo;
    
    
    /**
     * 
     * @var string
     * @Column(type="text", nullable=true)
     */
    private $contenido;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $imagen;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $url;
    /**
     *
     * @var boolean
     * @column (type="boolean")
     */
    private $mostrar;
    
    
    
    /**
     * @ManyToOne(targetEntity="Seccion", inversedBy="subcontenido", cascade={"persist"}, fetch="EAGER")
     * @JoinColumn(name="seccion_id", referencedColumnName="id")
     */
    private $seccion_id;
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getSeccion_id() {
        return $this->seccion_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setSeccion_id($seccion_id) {
        $this->seccion_id = $seccion_id;
    }

    function isMostrar() {
        return $this->mostrar;
    }

    function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
    }
    function getUrl() {
        return $this->url;
    }

    function setUrl($url) {
        $this->url = $url;
    }




}
