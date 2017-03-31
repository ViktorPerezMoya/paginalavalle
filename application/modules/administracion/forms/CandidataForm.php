<?php

class Administracion_Form_CandidataForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Candidata');
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');

        $nombre = new Zend_Form_Element_Text('nombre');
        $nombre->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Ingrese nombre'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $nombre->setLabel('Nombre: ');

        $distrito = new Zend_Form_Element_Text('distrito');
        $distrito->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Ingrese localidad'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $distrito->setLabel('Localidad: ');
        
        $edad = new Zend_Form_Element_Text('edad');
        $edad->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','min'=>0,'placeholder'=>'Ingrese edad'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $edad->setLabel('Edad: ');
        
        
        $ojos = new Zend_Form_Element_Text('ojos');
        $ojos->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Ingrese color de ojos'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $ojos->setLabel('Ojos: ');

        $estatura = new Zend_Form_Element_Text('estatura');
        $estatura->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Ingrese estatura ej.: 1,70'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $estatura->setLabel('Estatura: ');
        
        $cabello = new Zend_Form_Element_Text('cabello');
        $cabello->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Color de cabello'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $cabello->setLabel('Cabello: ');
        
        $estudios = new Zend_Form_Element_Text('estudios');
        $estudios->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Estudios de la candidata'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $estudios->setLabel('Estudios: ');
        
        $hobby = new Zend_Form_Element_Text('hobby');
        $hobby->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control','placeholder'=>'Hobby de la candidata'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $hobby->setLabel('Hobby: ');

        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($nombre, $distrito,$edad,$ojos,$cabello,$estatura,$estudios,$hobby, $submit));

        
    }


}

