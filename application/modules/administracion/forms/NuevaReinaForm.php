<?php

class Administracion_Form_NuevaReinaForm extends Zend_Form {

    public function init() {


        $this->setName('Candidatas');


        $candidataDB = new Administracion_Model_Candidata();
        
        
        $id = new Zend_Form_Element_Hidden('candidatavieja');
        
        $candidatas = new Zend_Form_Element_Select('candidatanueva');
        $candidatas->setLabel('Seleccione reina actual:')
                ->setAttrib('class', 'input-sm')
                ->setRequired(true);
        
        $candidatas->addMultiOption(0, 'Seleccione...');
        
        $candidatasList = $candidataDB->getCandidatas();
        foreach ($candidatasList as $cnd):
            $candidatas->addMultiOption($cnd['id_candidata'], $cnd['nombre']);
        endforeach;

        $submit = new Zend_Form_Element_Submit('Guardar');
        $submit->setAttribs(array('class' => 'btn btn-success btn-lg'));

        $this->addElements(array($id,$candidatas, $submit));
    }


}
