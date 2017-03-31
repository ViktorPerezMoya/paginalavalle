<?php

class Administracion_Form_ColectivoForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Acuerdo3949');
        $this->setAttrib('enctype', 'multipart/form-data');
        
         $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Ingrese titulo'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $titulo->setLabel('Titulo: ');
        
        $upload = new Zend_Form_Element_File('upload');
        $upload->setLabel('Archivo')
                ->setRequired(false)
                ->setDestination('pdf/colectivo/')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, 'pdf')
                ->addValidator('NotExists', false, 
                        array(APPLICATION_PATH . '\..\public\pdf\colectivo'));
        
        $submit = new Zend_Form_Element_Submit('Crear!');
        $submit->setAttrib('class', 'btn btn-success');
        
        $this->addElements(array($titulo,$upload,$submit));
    }


}

