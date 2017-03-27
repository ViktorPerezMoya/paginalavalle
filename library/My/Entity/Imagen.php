<?php

namespace My\Entity;
/**
 * @Entity
 */
class Imagen {
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
    private $url;
    /**
     *
     * @var string
     * @Column(type="string", length=55)
     */
    private $tipo;
    
    /**
     * @ManyToOne(targetEntity="Candidata", inversedBy="imagen", cascade={"persist"}, fetch="EAGER")
     * @JoinColumn(name="candidata_id", referencedColumnName="id_candidata")
     */
    private $candidata_id;
    /**
     * @ManyToOne(targetEntity="Seccion", inversedBy="imagen", cascade={"persist"}, fetch="EAGER")
     * @JoinColumn(name="seccion_id", referencedColumnName="id")
     */
    private $seccion_id;
    /**
     * @ManyToOne(targetEntity="Sitios", inversedBy="imagen", cascade={"persist"}, fetch="EAGER")
     * @JoinColumn(name="sitios_id", referencedColumnName="id")
     */
    private $sitios_id;
    
    
    public function __construct()
    {
    }
    function getId() {
        return $this->id;
    }

    function getUrl() {
        return $this->url;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getCandidata_id() {
        return $this->candidata_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCandidata_id($candidata_id) {
        $this->candidata_id = $candidata_id;
    }

    function getSeccion_id() {
        return $this->seccion_id;
    }

    function getSitios_id() {
        return $this->sitios_id;
    }

    function setSeccion_id($seccion_id) {
        $this->seccion_id = $seccion_id;
    }

    function setSitios_id($sitios_id) {
        $this->sitios_id = $sitios_id;
    }


}
