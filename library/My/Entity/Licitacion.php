<?php

namespace My\Entity;

/**
 * @Entity
 */
class Licitacion {
    
    /**
     * @var integer 
     * @Column (type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     *
     * @var integer
     * @Column (type="integer")
     */
    protected $numero;
    
    /**
     *
     * @var integer
     * @Column (type="integer")
     */
    protected $anio;
    
    /**
     *
     * @var string
     * @Column (type="string", length="255")
     */
    protected $descripcion;
    
    /**
     *
     * @var date
     * @Column (type="date")
     */
    protected $fechaDeApertura;
    
    /**
     *
     * @var datetime
     * @Column (type="datetime")
     */
    protected $horaDeApertura;
    
    /**
     *
     * @var date
     * @Column (type="date", nullable="true")
     */
    protected $fechaDeCierre;
    
    /**
     *
     * @Column (type="datetime", nullable="true")
     */
    protected $horaDeCierre;
    
    /**
     *
     * @var string
     * @Column (type="string", length="255")
     */
    protected $tipoDeContratacion;
    
    /**
     *
     * @var date
     * @Column (type="datetime")
     */
    protected $creado;
    
    /**
     *
     * @Column (type="datetime", nullable="true")
     */
    protected $modificado;
    
    /**
     *
     * @var boolean
     * @column (type="boolean")
     */
    protected $activo;
    
    public function __construct() {
        $this->creado = new \DateTime(date('Y-m-d H:i:s'));
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getNumero() {
        return $this->numero;
    }
    
    public function setNumero($numero) {
        $this->numero = $numero;
    }
    
    public function getAnio() {
        return $this->anio;
    }
    
    public function setAnio($anio) {
        $this->anio = $anio;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    
    public function getFechaDeApertura() {
        return date('Y-m-d', date_timestamp_get($this->fechaDeApertura));
    }
    
    public function setFechaDeApertura($fecha) {
        $this->fechaDeApertura = new \DateTime($fecha);
    }
    
    public function getHoraDeApertura() {
        //return $this->horaDeApertura;
        return date_format($this->horaDeApertura,'H:i:s');
    }
    
    public function setHoraDeApertura($hora) {
        $this->horaDeApertura = new \DateTime($hora);
    }
    
    public function getFechaDeCierre() {
        return date('Y-m-d',$this->fechaDeCierre);
    }
    
    public function setFechaDeCierre($fecha) {
        $this->fechaDeCierre = new \DateTime($fecha);
    }
    
    public function getHoraDeCierre() {
        return $this->horaDeCierre;
    }
    
    public function setHoraDeCierre($hora) {
        $this->horaDeCierre = $hora;
    }
    
    public function getTipoDeContratacion() {
        return $this->tipoDeContratacion;
    }
    
    public function setTipoDeContratacion($tipoDeContratacion) {
        $this->tipoDeContratacion = $tipoDeContratacion;
    }
    
    public function getCreado() {
        return date('Y-m-d H:i:s',$this->creado);
    }
    
    public function setModificado() {
        $this->modificado = new date('Y-m-d H:i:s');
    }
    
    public function getModificado() {
        return date_format($this->modificado, 'Y-m-d H:i:s');
    }
    
    public function getActiva() {
        return $this->activo;
    }
    
    public function setActiva($activa) {
        $this->activo = $activa;
    }
}

