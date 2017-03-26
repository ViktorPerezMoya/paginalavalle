<?php
namespace My\Entity;

/**
 * @Entity
 */
class Mensaje {
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
    private $email;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $nombre;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $asunto;
    
    /**
     * 
     * @var string
     * @Column(type="string", nullable=true)
     */
    private $contenido;
    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getAsunto() {
        return $this->asunto;
    }

    function getContenido() {
        return $this->contenido;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }


}
