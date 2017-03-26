<?php

class Administracion_IndexController extends Zend_Controller_Action {

    public function init() {
        //cambio de layout
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layoutadmin');
    }

    public function indexAction() {
        $this->view->headTitle("Administración");
        
        
    }

}
