<?php

class Administracion_Form_SitioForm extends Zend_Form
{

    public function init()
    {
        $this->setName('Sitos');
        
        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'form-control'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $titulo->setLabel('Titulo: ');
        
        
        $contenido = new Zend_Form_Element_Textarea('contenido');
        $contenido ->setAttribs(array('class'=>'form-control','rows'=>15))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $contenido->setLabel('Contenido: ');
        
        
        $tipo = new Zend_Form_Element_Select('tipo');
        $tipo->setLabel('Seleccione tipo de lugar:')
                                ->setAttrib('class', 'form-control')
                                ->setRequired(true);
        $tipo->addMultiOption("? undefined:undefined ?","");
        $tipo->addMultiOption('sitios', 'Sitios de Interes');
        $tipo->addMultiOption('alojamiento', 'Alojamiento');
        $tipo->addMultiOption('gastronomia', 'Gastronomia');
        
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($titulo, $contenido,$tipo,$submit));

    }


}

