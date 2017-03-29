<?php

class Administracion_Form_ObraForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Obra');
        
        $titulo = new Zend_Form_Element_Text('tituloobra');
        $titulo->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Ingrese nombre de la obra'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $titulo->setLabel('Titulo: ');
        
        
        $contenido = new Zend_Form_Element_Textarea('contenido');
        $contenido ->setAttribs(array('class'=>'form-control','rows'=>15))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $contenido->setLabel('Contenido: ');
        
        
        
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($titulo, $contenido,$submit));

    }


}

