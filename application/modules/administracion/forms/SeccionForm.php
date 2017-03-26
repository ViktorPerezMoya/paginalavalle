<?php

class Administracion_Form_SeccionForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Seccion');
        
        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $titulo->setLabel('Titulo: ');
        
        $copete = new Zend_Form_Element_Textarea('copete');
        $copete->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm','rows'=>5,'maxLenght'=>255))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $copete->setLabel('Copete: ');
        
        $contenido = new Zend_Form_Element_Textarea('contenido');
        $contenido ->setAttribs(array('class'=>'input-sm','rows'=>15))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $contenido->setLabel('Contenido: ');
        
//        $upload = new Zend_Form_Element_File('upload');
//        $upload->setLabel('Elegir Imagen:')
//                ->setRequired()
//                ->setDestination(APPLICATION_PATH . '/../public/img/noticias')
//                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
//                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
//                ->addValidator('Extension', false, 'jpg')
//                ->addValidator('NotExists', false, array(APPLICATION_PATH . '\..\public\img\noticias'))
//                ->addValidator(new Zend_Validate_File_ImageSize(array(
//                    'minheight' => 480, 'minwidth' => 1350,
//                    'maxheight' => 480, 'maxwidth' => 1350)));
        
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($titulo,$copete, $contenido,$submit));

        
    }


}

