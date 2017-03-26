<?php

class Administracion_NoticiaController extends Zend_Controller_Action {

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
        $query = $this->_em->createQuery("SELECT n FROM My\Entity\Noticia n ORDER BY n.id DESC");
        
        $noticias = $query->getResult();
        $this->view->noticias = $noticias;
    }

    public function nuevaNoticiaAction() {

        $form = new Administracion_Form_NoticiaForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {
                    $noticia = new My\Entity\Noticia();
                    $noticia->setTitulo($form->titulo->getValue());
                    $noticia->setCopete($form->copete->getValue());
                    $noticia->setContenido($form->contenido->getValue());
                    $noticia->setMostrar(false);
                    $noticia->setUsuario(Zend_Auth::getInstance()->getIdentity()->getUsuario());
                    $noticia->setFecha(date("Y-m-d H:i:s"));

                    $this->_em->merge($noticia);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('index');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function modificarNoticiaAction() {
        $id = $this->getParam('idnoticia');
        $noticia = $this->_em->find('My\Entity\Noticia', $id);

        $form = new Administracion_Form_NoticiaForm();
        $form->titulo->setValue($noticia->getTitulo());
        $form->copete->setValue($noticia->getCopete());
        $form->contenido->setValue($noticia->getContenido());

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    $noticia->setTitulo($form->titulo->getValue());
                    $noticia->setCopete($form->copete->getValue());
                    $noticia->setContenido($form->contenido->getValue());
                    //var_dump($form->contenido->getValue());die();
                    $this->_em->merge($noticia);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->getRequest()->clearParams();
                    $this->_helper->redirector('index');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function cambiarImagenNotaAction() {
        $id = $this->getParam('idnoticia');
        $noticia = $this->_em->find('My\Entity\Noticia', $id);

        $this->view->noticia = $noticia;
        //$noticia = new My\Entity\Noticia();

        $form = new Administracion_Form_ImagenNotaForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {
                    $imagenanterior = $noticia->getImagennota();
                    //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                    $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost

                    if (!unlink('./img/noticias/' . $imagenanterior)) {//borro la imagen anterior
                        //die(); //se detiene la ejecucion para observar la excepcion [[san martin 1834]]
                    }
                    $form->upload->receive(); //subimos el archivo
                    if (!$form->upload->isReceived()) {//se subio? 
                        die();
                    }

                    $momento = date('Ymdhis'); //obtengo el moemnto
                    if (!rename('./img/noticias/' . $url, './img/noticias/IMG_NOTA_' . $momento . '.jpg')) {//renombro el archivo
                        die();
                    }


                    $noticia->setImagennota('IMG_NOTA_' . $momento . '.jpg');

                    $this->_em->merge($noticia);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->getRequest()->clearParams(); //borra los parametros
                    $this->_helper->redirector('index', 'noticia', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function cambiarImagenPortadaAction() {

        $id = $this->getParam('idnoticia');
        $noticia = $this->_em->find('My\Entity\Noticia', $id);

        $this->view->noticia = $noticia;
        //$noticia = new My\Entity\Noticia();

        $form = new Administracion_Form_ImagenPortadaForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {
                    $imagenanterior = $noticia->getImagenportada();
                    //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                    $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost

                    if (!unlink('./img/noticias/' . $imagenanterior)) {
                        //die(); //se detiene la ejecucion para observar la excepcion [[san martin 1834]]
                    }
                    $form->upload->receive(); //subimos el archivo
                    if (!$form->upload->isReceived()) {//se subio? 
                        die();
                    }

                    $momento = date('Ymdhis'); //obtengo el moemnto
                    if (!rename('./img/noticias/' . $url, './img/noticias/IMG_PORT_' . $momento . '.jpg')) {//renombro el archivo
                        die();
                    }


                    $noticia->setImagenportada('IMG_PORT_' . $momento . '.jpg');


                    $this->_em->merge($noticia);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->getRequest()->clearParams(); //borra los parametros
                    $this->_helper->redirector('index', 'noticia', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function mostrarAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        //$id = $this->getParam('idnoticia');
        $id = $this->getRequest()->getPost('idnoticia');
        $noticia = $this->_em->find('My\Entity\Noticia', $id);
        
        $this->_em->getConnection()->beginTransaction();
        try {

            $noticia->setMostrar(true);

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

    public function ocultarAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        //$id = $this->getParam('idnoticia');
        $id = $this->getRequest()->getPost('idnoticia');
        $noticia = $this->_em->find('My\Entity\Noticia', $id);
        
        $this->_em->getConnection()->beginTransaction();
        try {

            $noticia->setMostrar(false);

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
