<?php
namespace My\Entity;

/**
 * @Entity
 */
class Archivo {
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
     * @Column(type="string", length=255)
     */
    private $url;
    
    /**
     * @ManyToOne(targetEntity="Seccion", inversedBy="archivo", cascade={"persist"}, fetch="EAGER")
     * @JoinColumn(name="seccion_id", referencedColumnName="id")
     */
    private $seccion_id;
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getUrl() {
        return $this->url;
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

    function setUrl($url) {
        $this->url = $url;
    }

    function setSeccion_id($seccion_id) {
        $this->seccion_id = $seccion_id;
    }


}
