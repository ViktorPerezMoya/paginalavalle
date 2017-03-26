<?php

class Default_Form_RegistrarUsuarioForm extends Zend_Form
{

    public function init()
    {
        
        $this->setName('Regisrar usuario');
        $this->addPrefixPath('My_Form_Decorator', 'My/Form/Decorator/', 'decorator');

        $nombre = new Zend_Form_Element_Text('nombre');
        $nombre->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $nombre->setLabel('Nombre: ');
        
        $cuil = new Zend_Form_Element_Text('cuil');
        $cuil->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $cuil->setLabel('CUIL: ');
        
        $email = new Zend_Form_Element_Text('email');
        $email->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $email->setLabel('E-mail: ');
        
        $usuario = new Zend_Form_Element_Text('usuario');
        $usuario->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                ->addErrorMessage('Campo requerido');
        $usuario->setLabel('Usuario: ');

        $contrasenia = new Zend_Form_Element_Password('clave');
        $contrasenia->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm'))
                ->setRequired()
                //->addErrorMessage('Campo requerido')
                ->addValidator('Regex', false, array('/^[a-z0-9]{6,}$/i'));
        $contrasenia->setLabel('Clave: ');

        
        $repetircontraseñia = new Zend_Form_Element_Password('repetirclave');
        $repetircontraseñia->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->setAttribs(array('class'=>'input-sm',))
                ->setRequired()
                //->addErrorMessage('Campo requerido')
                ->addValidator('Regex', false, array('/^[a-z0-9]{6,}$/i'));
        $repetircontraseñia->setLabel('Repita su clave: ');
        
        $submit = new Zend_Form_Element_Submit('Registrar');
        $submit->setAttribs(array('class'=>'btn btn-primary'));

        $this->addElements(array($nombre,$cuil, $email,$usuario, $contrasenia,$repetircontraseñia, $submit));

        $this->setElementDecorators(array(
            'ViewHelper',
            //'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array('ErrorsHtmlTag', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $submit->setDecorators(array('ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
            array(array('emptyrow' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $this->setDecorators(
                array(
                    "FormElements",
                    array("HtmlTag", array("tag" => "table")),
                    "Form"
                )
        );
    }


}

