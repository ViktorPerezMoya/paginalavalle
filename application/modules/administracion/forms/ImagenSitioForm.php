<?php

class Administracion_Form_ImagenSitioForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Imagen Sitio');


        $upload = new Zend_Form_Element_File('upload');
        $upload->setLabel('Elegir Imagen')
                ->setRequired()
                ->setDestination(APPLICATION_PATH . '/../public/img/turismo/sitios')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, array('jpg','jpeg'))
                ->addValidator('NotExists', false, array(APPLICATION_PATH . '\..\public\img\turismo\sitios'));

        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class' => 'btn btn-success btn-lg'));

        $this->addElements(array($upload, $submit));
    }


}

