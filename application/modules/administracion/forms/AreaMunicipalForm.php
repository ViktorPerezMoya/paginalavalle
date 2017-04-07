<?php

class Administracion_Form_AreaMunicipalForm extends Zend_Form {

    public function init() {
        $this->setName('Postulante');

        /* DATOS PERSONALES */
        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class' => 'form-control', 'placeholder' => 'Ingrese Nombre'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $titulo->setLabel('Nombre del area: ');

        $acargode = new Zend_Form_Element_Text('acargode');
        $acargode->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class' => 'form-control', 'placeholder' => 'Ingrese nombre de encargado de area'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $acargode->setLabel('Acargo de: ');

        $cargoanterior = new Zend_Form_Element_Text('cargoanterior');
        $cargoanterior->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class' => 'form-control', 'placeholder' => 'Ingrese cargo anterior'));
        $cargoanterior->setLabel('Cargo anterior: ');

        $direccion = new Zend_Form_Element_Text('direccion');
        $direccion->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class' => 'form-control', 'placeholder' => 'Ingrese direccion del area'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $direccion->setLabel('Direccion: ');


        $telefono = new Zend_Form_Element_Text('telefono');
        $telefono->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class' => 'form-control', 'placeholder' => 'Ingrese telefono de contacto'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $telefono->setLabel('Teléfono: ');

        $funciones = new Zend_Form_Element_Textarea('funciones');
        $funciones->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class' => 'form-control', 'min' => 0, 'rows' => 6, 'placeholder' => 'Ingrese fucniones separadas por ";"'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $funciones->setLabel('Funciones del area: ');


        $tipo = new Zend_Form_Element_Select('tipo');
        $tipo->setLabel('Tipo de Área:')->setAttribs(array('class' => 'form-control'))
                ->setRequired();
        $tipo->addMultiOptions(array(
            "? undefined:undefined ?" => "",
            "Secretaria" => "Secretaria",
            "Dirección" => "Dirección",
            "Jefatura" => "Jefatura"
        ));

        $dependede = new Zend_Form_Element_Select('dependede');
        $dependede->setLabel('Depende de:')->setAttribs(array('class' => 'form-control'))
                ->setRequired();
        $dependede->setValidators(array());
        $dependede->addMultiOptions(array(
            "0" => "Seleccione..."
        ));
        $dependede->setRegisterInArrayValidator(false);



        /* CONFIRMACION */
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class' => 'btn btn-primary'));
        $this->addElements(array($titulo, $acargode, $cargoanterior, $direccion, $telefono, $telefono, $funciones, $tipo, $dependede, $submit));
    }

}
