<?php

namespace My\Entity;


/**
 * @Entity
 */
class Usuario {
    
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
    private $usuario;
    
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $clave;
    
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $nombre;
    
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $cuil;
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $rol;
    
    /**
     * @var boolean
     * @Column (type="boolean", nullable="false")
     * 
     */
    private $estado;
    
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $email;
    
    /**
     * @var boolean
     * @Column (type="boolean", nullable="false")
     * 
     */
    private $validado;
    
    /**
     * 
     * @var string
     * @Column(type="string")
     */
    private $codigovalidacion;
    
    function getId() {
        return $this->id;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getRol() {
        return $this->rol;
    }

    function getEstado() {
        return $this->estado;
    }

    function getEmail() {
        return $this->email;
    }

    function getValidado() {
        return $this->validado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setValidado($validado) {
        $this->validado = $validado;
    }
    function getCuil() {
        return $this->cuil;
    }

    function setCuil($cuil) {
        $this->cuil = $cuil;
    }
    function getCodigovalidacion() {
        return $this->codigovalidacion;
    }

    function setCodigovalidacion($codigovalidacion) {
        $this->codigovalidacion = $codigovalidacion;
    }




}
