<?php

class Default_Form_Contacto extends Zend_Form
{

    public function init()
    {
        $this->setName('Contacto');
        $mail_contacto = new Zend_Form_Element_Text('email');
        $mail_contacto->setLabel('E-mail')->setAttribs(array('class'=> 'form-control','placeholder'=>'Ingrese su e-mail:'));
        
        $nombre_contacto = new Zend_Form_Element_Text('nombre');
        $nombre_contacto->setLabel('Nombre:')->setAttribs(array('class'=> 'form-control','placeholder'=>'Ingrese su nombre'));
        
        $asunto = new Zend_Form_Element_Text('asunto');
        $asunto->setLabel('Asunto:')->setAttribs(array('class'=> 'form-control','placeholder'=>'Asunto del mensaje'));
        
        $descripcion = new Zend_Form_Element_Textarea('descripcion');
        $descripcion->setLabel('Descripción:')->setAttribs(array('class'=> 'form-control',
                                                            'rows'=>6));
        
        $submit = new Zend_Form_Element_Submit('Enviar');
        $submit->setAttribs(array('class'=>'btn btn-success btn-lg'));
        
        $this->addElements(array($mail_contacto,$nombre_contacto,$asunto,$descripcion,$submit));
    }


}

