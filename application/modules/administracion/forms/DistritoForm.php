<?php

class Administracion_Form_DistritoForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Subseccion');
        
        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $titulo->setLabel('Titulo: ');
        
        $contenido = new Zend_Form_Element_Textarea('contenido');
        $contenido ->setAttribs(array('class'=>'input-sm','rows'=>15))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $contenido->setLabel('Contenido: ');
        
        $upload = new Zend_Form_Element_File('upload');
        $upload->setLabel('Elegir Imagen:')
                ->setRequired(false)
                ->setDestination(APPLICATION_PATH . '/../public/img/distritos')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, array('jpg','png'))
                ->addValidator('NotExists', false, array(APPLICATION_PATH . '\..\public\img\distritos'))
                ->addValidator(new Zend_Validate_File_ImageSize(array(
                    'minheight' => 80, 'minwidth' => 80,
                    'maxheight' => 5000, 'maxwidth' => 500)));
        
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($titulo, $contenido,$upload,$submit));
    }


}

