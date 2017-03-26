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
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $nombre->setLabel('Nombre: ');

        $distrito = new Zend_Form_Element_Text('distrito');
        $distrito->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $distrito->setLabel('Distrito: ');
        
        $edad = new Zend_Form_Element_Text('edad');
        $edad->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm','min'=>0))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $edad->setLabel('Edad: ');
        
        
        $ojos = new Zend_Form_Element_Text('ojos');
        $ojos->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $ojos->setLabel('Ojos: ');
        
        $cabello = new Zend_Form_Element_Text('cabello');
        $cabello->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $cabello->setLabel('Cabello: ');
        
        $estudios = new Zend_Form_Element_Text('estudios');
        $estudios->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $estudios->setLabel('Estudios: ');
        
        $hobby = new Zend_Form_Element_Text('hobby');
        $hobby->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $hobby->setLabel('Hobby: ');

        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($nombre, $distrito,$edad,$ojos,$cabello,$estudios,$hobby, $submit));

        $this->setElementDecorators(array(
            'ViewHelper',
            //'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array('ErrorsHtmlTag', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $submit->setDecorators(array('ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
            array(array('emptyrow' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $this->setDecorators(
                array(
                    "FormElements",
                    array("HtmlTag", array("tag" => "table")),
                    "Form"
                )
        );
    }


}

