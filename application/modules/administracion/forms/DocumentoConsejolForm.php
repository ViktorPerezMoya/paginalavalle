<?php

class Administracion_Form_DocumentoConsejolForm extends Zend_Form {

    public function init() {
        $titulodoc = new Zend_Form_Element_Text('titulodoc');
        $titulodoc->setRequired()
                ->addFilter('StringTrim')
                ->setAttribs(array('class' => 'form-control', 'placeholder' => 'Ingrese titulo de documento'))
                ->setLabel('Titulo: ')
                ->addErrorMessage('Campo requerido');
        $resumendoc = new Zend_Form_Element_Textarea('resumendoc');
        $resumendoc->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm','rows'=>5,'maxLenght'=>255))
                ->setRequired()
                ->addErrorMessage('Campo requerido')
                ->setLabel('Resumen: ');
        
        $tipodoc = new Zend_Form_Element_Select('tipodoc');
        $tipodoc->setLabel('Seleccione tipo de documento:')
                                ->setAttrib('class', 'form-control')
                                ->setRequired(true);
        $tipodoc->addMultiOption("? undefined:undefined ?","");
        $tipodoc->addMultiOption('Declaracion', 'Declaracion');
        $tipodoc->addMultiOption('Ordenanza', 'Ordenanza');
        $tipodoc->addMultiOption('Ordenanza Tarifaria', 'Ordenanza Tarifaria');
        $tipodoc->addMultiOption('Resolucion', 'Resolucion');
        
        $upload = new Zend_Form_Element_File('upload');
        $upload->setLabel('Documento (pdf)')
                ->setRequired(false)
                ->setDestination('pdf/proyectohcd/')
                ->addValidator('Count', false, 1)//Asegura que sea solo un archivo
                ->addValidator('Size', false, 10240000)//Limite al tamaño del archivo
                ->addValidator('Extension', false, 'pdf')
                ->addValidator('NotExists', false, 
                        array(APPLICATION_PATH . '\..\public\pdf\proyectohcd'));
        
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($titulodoc,$resumendoc,$tipodoc, $upload,$submit));
    }

}
