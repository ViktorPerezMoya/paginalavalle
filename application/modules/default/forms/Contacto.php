<?php

class Default_Form_Contacto extends Zend_Form
{

    public function init()
    {
        $this->setName('Contacto');
        $mail_contacto = new Zend_Form_Element_Text('email');
        $mail_contacto->setLabel('Ingrese su e-mail:')->setAttribs(array('class'=> 'input-sm'));
        
        $nombre_contacto = new Zend_Form_Element_Text('nombre');
        $nombre_contacto->setLabel('Ingrese su nombre:')->setAttribs(array('class'=> 'input-sm'));
        
        $asunto = new Zend_Form_Element_Text('asunto');
        $asunto->setLabel('Asunto:')->setAttribs(array('class'=> 'input-sm'));
        
        $descripcion = new Zend_Form_Element_Textarea('descripcion');
        $descripcion->setLabel('Descripción:')->setAttribs(array('class'=> 'input-sm',
                                                            'rows'=>6));
        
        $submit = new Zend_Form_Element_Submit('Enviar');
        $submit->setAttribs(array('class'=>'btn btn-success btn-lg'));
        
        $this->addElements(array($mail_contacto,$nombre_contacto,$asunto,$descripcion,$submit));
    }


}

