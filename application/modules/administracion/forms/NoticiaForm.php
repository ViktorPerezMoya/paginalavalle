<?php

class Administracion_Form_NoticiaForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Nueva Noticia');
        
        $idnoticia = new Zend_Form_Element_Hidden('idnoticia');
        
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
        $contenido->setLabel('Nota: (Los videos subir como https://www.youtube.com/embed/C0d1g0_V1d30)');
        
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($idnoticia,$titulo,$copete, $contenido,$submit));

        
    }


}

