<?php

class Administracion_Form_AcuerdoForm extends Zend_Form
{

    public function init()
    {
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');
        $this->setName('Acuerdo3949');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $ejercicio = new Zend_Form_Element_Select('ejercicio');
        $ejercicio->setLabel('Ejercicio')->setAttribs(array('class'=> 'input-sm'))
                ->setRequired();
        $añoActual = date('Y');
        for($i = 0; $i<10; $i++) {
        $ejercicio->addMultiOptions(array(
            $añoActual-$i => $añoActual-$i,
        ));
        }
        
        $periodo = new Zend_Form_Element_Select('periodo');
        $periodo->setLabel('Periodo')->setAttribs(array('class'=> 'input-sm'))
                ->setRequired();
        
        $periodo->addMultiOptions(array(
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4
        ));
        
        $upload = new Zend_Form_Element_File('upload');
        $upload->setLabel('Archivo')
                ->setRequired(false)
                ->setDestination('pdf/acuerdo3949/')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, 'pdf')
                ->addValidator('NotExists', false, 
                        array(APPLICATION_PATH . '\..\public\pdf\acuerdo3949'));
        
        $submit = new Zend_Form_Element_Submit('Crear!');
        $submit->setAttrib('class', 'btn btn-success');
        
        $this->addElements(array($ejercicio,$periodo,$upload,$submit));
    }


}

