<?php

class Administracion_Form_NuevaImagenVendimiaForm extends Zend_Form {

    public function init() {
        $this->setName('Nueva Imagen ');

        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->setLabel('Titulo')->setAttribs(array('class' => 'input-sm'))->setRequired();

        $upload = new Zend_Form_Element_File('uploadgrande');
        $upload->setLabel('Elegir Imagen')
                ->setRequired()
                ->setDestination(APPLICATION_PATH . '/../public/img/galeria')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, 'jpg')
                ->addValidator('NotExists', false, array(APPLICATION_PATH . '\..\public\img\galeria'))
                ->addFilter(new My_Filter_File_Resize(array(
                    'width' => 1000,
                    'height' => 600,
                    'keepRatio' => false,
                    'keepSmaller' => false
                )))
                ->addValidator(new Zend_Validate_File_ImageSize(array(
                    'minheight' => 600, 'minwidth' => 1000,
                    'maxheight' => 600, 'maxwidth' => 1000)));
        $uploadmin = new Zend_Form_Element_File('uploadchica');
        $uploadmin->setLabel('Vuelve a Elegir Imagen')
                ->setRequired()
                ->setDestination(APPLICATION_PATH . '/../public/img/galeria/thumbnails')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, 'jpg')
                ->addValidator('NotExists', false, array(APPLICATION_PATH . '\..\public\img\galeria\thumbnails'))
                ->addFilter(new My_Filter_File_Resize(array(
                    'height' => 120,
                    'width' => 200,
                    'keepRatio' => false,
                    'keepSmaller' => false
        )));

        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class' => 'btn btn-success btn-lg'));

        $this->addElements(array($titulo, $upload, $uploadmin, $submit));
    }

}
