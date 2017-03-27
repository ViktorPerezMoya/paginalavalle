<?php

namespace My\Entity;

/**
 * @Entity
 */
class Sitios {

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
     * @Column(type="string", length=55)
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
     * @Column(type="string", length=55)
     */
    private $tipo;

    /**
     * @var Collection
     * @OneToMany(targetEntity="Imagen", mappedBy="sitios_id", cascade={"persist"}, fetch="EAGER")
     */
    private $imagenes;

    function __construct() {
        $this->imagenes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getImagenes() {
        return $this->imagenes;
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

    function setImagenes(Collection $imagenes) {
        $this->imagenes = $imagenes;
    }
    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }


}
