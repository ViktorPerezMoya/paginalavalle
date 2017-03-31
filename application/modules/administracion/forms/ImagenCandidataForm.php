<?php

class Administracion_Form_ImagenCandidataForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Imagen Candidata');


        $upload = new Zend_Form_Element_File('upload');
        $upload->setLabel('Elegir Imagen')
                ->setRequired()
                ->setDestination(APPLICATION_PATH . '/../public/img/candidatas')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, array('jpg','jpeg'))
                ->addValidator('NotExists', false, array(APPLICATION_PATH . '\..\public\img\candidatas'))
                ->addValidator(new Zend_Validate_File_ImageSize(array(
                    'minheight' => 300, 'minwidth' => 200,
                    'maxheight' => 1000, 'maxwidth' => 666)));

        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class' => 'btn btn-success btn-lg'));

        $this->addElements(array($upload, $submit));
    }


}

