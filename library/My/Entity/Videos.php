<?php

namespace My\Entity;
/**
 * @Entity
 */
class Videos {
    
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
    private $idyoutube;
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getIdyoutube() {
        return $this->idyoutube;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setIdyoutube($idyoutube) {
        $this->idyoutube = $idyoutube;
    }


}
