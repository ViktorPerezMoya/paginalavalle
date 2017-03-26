<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LicitacionForm
 *
 * @author Viktor
 */
class Administracion_Form_LicitacionForm extends Zend_Form {
    
    public function init()
    {
        $this->setName('licitacion');
        
        $numero = new Zend_Form_Element_Text('numero');
        $numero->setLabel('Numero')->setRequired()->addFilter('Int')->addValidator('Int')
                ->setAttribs(array('placeholder' => 'Solo Número, sin el año','class'=>'input-sm'));
        
        $descripcion = new Zend_Form_Element_Textarea('descripcion');
        $descripcion->setLabel('Descripcion')->setRequired()->setAttribs(array(
            'rows' => 4,
            'class'=> 'form-control'));
        
        $fechaDeApertura = new Zend_Form_Element_Text('fecha');
        $fechaDeApertura->setLabel('Fecha de apertura')->setAttribs(array(
            'type'=>'date','class' => 'input-sm' ));
        $fechaDeApertura->setValue(date('d-m-Y'));
        
        $hora = new Zend_Form_Element_Text('hora');
        $hora->setLabel('Hora de apertura')->setAttribs(array(
            'type'=>'time','class' => 'input-sm' ));
        $hora->setValue(date('H:m:s'));
        
        $tipoDeContratacion = new Zend_Form_Element_Text('tipo');
        $tipoDeContratacion->setLabel('Tipo de contratación')->setRequired()
                ->setAttribs(array('class'=> 'input-sm'));
        
        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttrib('class', 'btn btn-danger');
        
        $this->addElements(array($numero,$descripcion,$fechaDeApertura,$hora,$tipoDeContratacion,$submit));
        
      
    }
    
}
