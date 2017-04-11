<?php
namespace My\Entity;

/**
 * @Entity
 */
class AreaMunicipal {
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
    private $acargode;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $cargoanterior;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $direccion;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $telefono;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $email;
    
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $vista;
    
    
    /**
     * 
     * @var string
     * @Column(type="text", nullable=true)
     */
    private $funciones;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $tipo;
    
    /**
     * 
     * @var integer
     * @Column(type="integer", nullable=true)
     */
    private $areasuperior;
    
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

    function getAcargode() {
        return $this->acargode;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }


    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAcargode($acargode) {
        $this->acargode = $acargode;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }


    function getCargoanterior() {
        return $this->cargoanterior;
    }

    function setCargoanterior($cargoanterior) {
        $this->cargoanterior = $cargoanterior;
    }

    function getActivo() {
        return $this->activo;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }
    function getFunciones() {
        return $this->funciones;
    }

    function setFunciones($funciones) {
        $this->funciones = $funciones;
    }

    function setVista($vista){
        $this->vista = $vista;
    }

    function getVista(){
        return $this->vista;
    }
    function getTipo() {
        return $this->tipo;
    }

    function getAreasuperior() {
        return $this->areasuperior;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setAreasuperior($areasuperior) {
        $this->areasuperior = $areasuperior;
    }

    function getEmail(){
        return $this->email;
    }

    function setEmail($email){
        $this->email = $email;
    }
}
