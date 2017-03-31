<?php


namespace My\Entity;

/**
 * @Entity
 * @Table(name="candidata")
 */
class Candidata {
    /**
     * @var integer 
     * @Column (type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id_candidata;
    /**
     *
     * @var string
     * @Column(type="string", length=255)
     */
    private $nombre;
    /**
     * 
     * @var string
     * @Column(type="integer", nullable=true)
     */
    private $edad;
    /**
     *
     * @var string
     * @Column(type="string", length=55, nullable=true)
     */
    private $ojos;
    /**
     *
     * @var string
     * @Column(type="string", length=55, nullable=true)
     */
    private $cabello;
    /**
     *
     * @var string
     * @Column(type="string", length=55, nullable=true)
     */
    private $estatura;
    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    private $estudios;
    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    private $hobby;
    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    private $distrito;
    /**
     * 
     * @var string
     * @Column(type="integer")
     */
    private $votos;
    /**
     * 
     * @var string
     * @Column(type="integer")
     */
    private $periodo;
    /**
     * @var boolean
     * @Column (type="boolean", nullable=false)
     * 
     */
    private $reina;
    /**
     * @var boolean
     * @Column (type="boolean", nullable=false)
     * 
     */
    private $estado;
    
    /**
     * @var Collection
     * @OneToMany(targetEntity="Imagen", mappedBy="candidata_id", cascade={"persist"}, fetch="EAGER")
     */
    private $imagenes;
    
     public function __construct() {
        $this->imagenes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    function getId_candidata() {
        return $this->id_candidata;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getEdad() {
        return $this->edad;
    }

    function getOjos() {
        return $this->ojos;
    }

    function getCabello() {
        return $this->cabello;
    }

    function getEstudios() {
        return $this->estudios;
    }

    function getHobby() {
        return $this->hobby;
    }

    function getDistrito() {
        return $this->distrito;
    }

    function getVotos() {
        return $this->votos;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function getReina() {
        return $this->reina;
    }

    function getEstado() {
        return $this->estado;
    }

    function getImagenes() {
        return $this->imagenes;
    }

    function setId_candidata($id_candidata) {
        $this->id_candidata = $id_candidata;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setEdad($edad) {
        $this->edad = $edad;
    }

    function setOjos($ojos) {
        $this->ojos = $ojos;
    }

    function setCabello($cabello) {
        $this->cabello = $cabello;
    }

    function setEstudios($estudios) {
        $this->estudios = $estudios;
    }

    function setHobby($hobby) {
        $this->hobby = $hobby;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    function setVotos($votos) {
        $this->votos = $votos;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    function setReina($reina) {
        $this->reina = $reina;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setImagenes(Collection $imagenes) {
        $this->imagenes = $imagenes;
    }

    function setEstatura($estatura){
        $this->estatura = $estatura;
    }

    function getEstatura(){
        return $this->estatura;
    }

}


