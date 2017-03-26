<?php

class Administracion_Form_ImagenPortadaForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Imagen Portada');


        $upload = new Zend_Form_Element_File('upload');
        $upload->setLabel('Elegir Imagen')
                ->setRequired()
                ->setDestination(APPLICATION_PATH . '/../public/img/noticias')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, 'jpg')
                ->addValidator('NotExists', false, array(APPLICATION_PATH . '\..\public\img\noticias'))
                ->addValidator(new Zend_Validate_File_ImageSize(array(
                    'minheight' => 480, 'minwidth' => 1350,
                    'maxheight' => 480, 'maxwidth' => 1350)));

        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class' => 'btn btn-success btn-lg'));

        $this->addElements(array($upload, $submit));
    }


}

