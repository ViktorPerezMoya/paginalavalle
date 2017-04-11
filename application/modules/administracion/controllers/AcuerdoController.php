<?php

class Administracion_AcuerdoController extends Zend_Controller_Action {

    /**
     * Redirector - defined for code completion
     *
     * @var Zend_Controller_Action_Helper_Redirector
     */
    protected $_redirector = null;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $_em = null;

    public function init() {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layoutadmin');

        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();

        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction() {
        $query = $this->_em->createQuery("SELECT a FROM My\Entity\Acuerdo a");
        $acuerdos = $query->getResult();

        $this->view->acuerdos = $acuerdos;
        ///var_dump($archs);
    }

    public function nuevoRegistroAction() {

        $form = new Administracion_Form_AcuerdoForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {

                    $acu = new My\Entity\Acuerdo();
                    $acu->setPeriodo($form->periodo->getValue());
                    $acu->setEjercicio($form->ejercicio->getValue());
                    $acu->setEstado(true);



                    if (sizeof($form->upload->getFileName()) > 0) {
                        //$url = substr(strrchr($form->upload->getFileName(), '/'), 1);//web

                        $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost
                        $acu->setDescripcion(explode(".pdf", $url)[0]);

                        $form->upload->receive(); //subimos el archivo
                        if (!$form->upload->isReceived()) {//se subio? 
                            die();
                        }

                        if (!rename('./pdf/acuerdo3949/' . $url, './pdf/acuerdo3949/'.$url.'('. $acu->getEjercicio() . '-' . $acu->getPeriodo() . ')'.'.pdf')) {//renombro el archivo
                            die();
                        }


                        $acu->setUrl($url.'('. $acu->getEjercicio() . '-' . $acu->getPeriodo() . ')'.'.pdf');
                    }else{
                        $acu->setDescripcion("Documento sin descripcion");
                    }
                    
                    $this->_em->merge($acu);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->getRequest()->clearParams(); //borra los parametros
                    $this->_helper->redirector('index', 'acuerdo', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarRegistroAction(){
        $id = $this->getParam('id');
        $acu = $this->_em->find('My\Entity\Acuerdo', $id);
        //$acu = new My\Entity\Acuerdo();
        
        //var_dump($acu);die();
        
        $form = new Administracion_Form_AcuerdoForm();
        $form->periodo->setValue($acu->getPeriodo());
        $form->ejercicio->setValue($acu->getEjercicio());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {

                    //$acu = new My\Entity\Acuerdo();
                    $acu->setPeriodo($form->periodo->getValue());
                    $acu->setEjercicio($form->ejercicio->getValue());
                    $acu->setEstado(true);

                    $docuanterior = $acu->getUrl();

                    if (sizeof($form->upload->getFileName()) > 0) {
                        //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                        $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost
                        $acu->setDescripcion(explode(".pdf", $url)[0]);
                        
                        
                        if (!unlink('./pdf/acuerdo3949/' . $docuanterior)) {//borro la imagen anterior
                            //die(); //se detiene la ejecucion para observar la excepcion [[san martin 1834]]
                        }


                        $form->upload->receive(); //subimos el archivo
                        if (!$form->upload->isReceived()) {//se subio? 
                            die();
                        }

                        if (!rename('./pdf/acuerdo3949/' . $url, './pdf/acuerdo3949/' . $url.'('. $acu->getEjercicio() . '-' . $acu->getPeriodo() . ')'.'.pdf')) {//renombro el archivo
                            die();
                        }


                        $acu->setUrl($url.'('. $acu->getEjercicio() . '-' . $acu->getPeriodo() . ')'.'.pdf');
                    }else{
                        //$momento = date('Ymdhis'); //obtengo el moemnto
                        if (!rename('./pdf/acuerdo3949/' . $docuanterior, './pdf/acuerdo3949/' .  $acu->getDescripcion().'('. $acu->getEjercicio() . '-' . $acu->getPeriodo() . ')'.'.pdf')) {//renombro el archivo
                            die();
                        }
                        $acu->setUrl( $acu->getDescripcion().'('. $acu->getEjercicio() . '-' . $acu->getPeriodo() . ')'.'.pdf');
                    }
                    
                    $this->_em->merge($acu);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->getRequest()->clearParams(); //borra los parametros
                    $this->_helper->redirector('index', 'acuerdo', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }
    
    public function eliminarRegistroAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        //$id = $this->getParam('idnoticia');
        $id = $this->getRequest()->getPost('id');
        $noticia = $this->_em->find('My\Entity\Acuerdo', $id);
        
        $this->_em->getConnection()->beginTransaction();
        try {

            $noticia->setEstado(false);

            $this->_em->merge($noticia);
            $this->_em->flush();
            $this->_em->getConnection()->commit();
            
            echo 'Cambio realizado exitosamente!!';
            
        } catch (Exception $ex) {
            $this->_em->getConnection()->rollback();
            $this->_em->close();
            //var_dump($ex);die();
            echo 'ERROR: Problemas al relaizar cambios.';
        }
    }
}
/*

if (sizeof($form->upload->getFileName()) > 0) {
                        //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                        $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost
                        $acu->setDescripcion(explode(".pdf", $url)[0]);

                        $form->upload->receive(); //subimos el archivo
                        if (!$form->upload->isReceived()) {//se subio? 
                            die();
                        }

                        $momento = date('Ymdhis'); //obtengo el moemnto
                        if (!rename('./pdf/acuerdo3949/' . $url, './pdf/acuerdo3949/ACUERDO_' . $acu->getEjercicio() . '_' . $acu->getPeriodo() . '_' . $momento . '.pdf')) {//renombro el archivo
                            die();
                        }


                        $acu->setUrl('ACUERDO_' . $acu->getEjercicio() . '_' . $acu->getPeriodo() . '_' . $momento . '.pdf');
                    }else{
                        $acu->setDescripcion("Documento sin descripcion");
                    }
                    */