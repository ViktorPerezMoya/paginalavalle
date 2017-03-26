<?php

namespace My\Entity;

/**
 * @Entity
 */
class Seccion {
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
     * @Column(type="string", nullable=true)
     */
    private $copete;
    
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
    private $imagenportada;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $usuario;
    
    /**
     * @var Collection
     * @OneToMany(targetEntity="Imagen", mappedBy="seccion_id", cascade={"persist"}, fetch="EAGER")
     */
    private $imagenes;
    
    /**
     * @var Collection
     * @OneToMany(targetEntity="Archivo", mappedBy="seccion_id", cascade={"persist"}, fetch="EAGER")
     */
    private $archivos;  
    
    /**
     * @var Collection
     * @OneToMany(targetEntity="Subcontenido", mappedBy="seccion_id", cascade={"persist"}, fetch="EAGER")
     */
    private $subcontenidos; 
    
    public function __construct() {
        $this->imagenes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->archivos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subcontenidos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
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

    function getImagenportada() {
        return $this->imagenportada;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getImagenes() {
        return $this->imagenes;
    }

    function getArchivos() {
        return $this->archivos;
    }

    function getSubcontenidos() {
        return $this->subcontenidos;
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

    function setImagenportada($imagenportada) {
        $this->imagenportada = $imagenportada;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setImagenes(Collection $imagenes) {
        $this->imagenes = $imagenes;
    }

    function setArchivos(Collection $archivos) {
        $this->archivos = $archivos;
    }

    function setSubcontenidos(Collection $subcontenidos) {
        $this->subcontenidos = $subcontenidos;
    }


}
