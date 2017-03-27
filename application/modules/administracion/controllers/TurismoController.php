<?php

class Administracion_TurismoController extends Zend_Controller_Action
{

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

    public function init()
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('layoutadmin');

        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();

        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction()
    {
        // action body
    }

    public function sitiosAction()
    {
        $query = $this->_em->createQuery("SELECT s FROM My\Entity\Sitios s");
        $sitios = $query->getResult();

        $this->view->sitios = $sitios;
    }

    public function nuevoSitioAction()
    {

        $form = new Administracion_Form_SitioForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                //var_dump($data);var_dump($form);die();
                $this->_em->getConnection()->beginTransaction();
                try {
                    $sitio = new My\Entity\Sitios();
                    $sitio->setTitulo($form->titulo->getValue());
                    $sitio->setContenido($form->contenido->getValue());
                    $sitio->setTipo($form->tipo->getValue());

                    $this->_em->merge($sitio);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('sitios', 'turismo', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                }
            }
        }
    }

    public function editarSitioAction()
    {
        $id = $this->getParam('id');
        $sitio = $this->_em->find('My\Entity\Sitios', $id);

        $form = new Administracion_Form_SitioForm();
        $form->titulo->setValue($sitio->getTitulo());
        $form->contenido->setValue($sitio->getContenido());
        $form->tipo->setValue($sitio->getTipo());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                //var_dump($data);var_dump($form);die();
                $this->_em->getConnection()->beginTransaction();
                try {
                    $sitio->setTitulo($form->titulo->getValue());
                    $sitio->setContenido($form->contenido->getValue());
                    $sitio->setTipo($form->tipo->getValue());

                    $this->_em->merge($sitio);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->getRequest()->clearParams();
                    $this->_helper->redirector('sitios', 'turismo', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                }
            }
        }
    }

    public function eliminarSitioAction()
    {

        $id = $this->getParam('id');
        $sitio = $this->_em->find('My\Entity\Sitios', $id);

        $this->_em->getConnection()->beginTransaction();
        try {
            $this->_em->remove($sitio);
            $this->_em->flush();
            $this->_em->getConnection()->commit();

            $this->getRequest()->clearParams();
            $this->_helper->redirector('sitios', 'turismo', 'administracion');
        } catch (Exception $ex) {
            $this->_em->getConnection()->rollback();
            $this->_em->close();
        }
    }

    public function agregarImagenSitioAction()
    {

        $id = $this->getParam('id');
        $sitio = $this->_em->find('My\Entity\Sitios', $id);
        
        $form = new Administracion_Form_ImagenSitioForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                //var_dump($data);var_dump($form);die();
                $this->_em->getConnection()->beginTransaction();
                try {
                    
                    
                    //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                    $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost


                    $form->upload->receive(); //subimos el archivo
                    if (!$form->upload->isReceived()) {//se subio? 
                        die();
                    }

                    $momento = date('Ymdhis'); //obtengo el moemnto
                    if (!rename('./img/turismo/sitios/' . $url, './img/turismo/sitios/' . $sitio->getTipo() . '_' . $momento . '.jpg')) {//renombro el archivo
                        die();
                    }


                    $imagen = new My\Entity\Imagen();
                    $imagen->setUrl($sitio->getTipo() . '_' . $momento . '.jpg');
                    $imagen->setSitios_id($sitio);
                    $imagen->setTipo('turismo');

                    $this->_em->merge($imagen);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('sitios', 'turismo', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                }
            }
        }
    }


}


