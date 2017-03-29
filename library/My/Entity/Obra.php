<?php
namespace My\Entity;

/**
 * @Entity
 */
class Obra {
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
     * @var boolean
     * @Column(type="boolean", nullable=true)
     */
    private $activo;
    function __construct() {
        
    }
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function setTitulo($titulo){
    	$this->titulo = $titulo;
    }

    function getActivo() {
        return $this->activo;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }
    function getContenido() {
        return $this->contenido;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }



}
