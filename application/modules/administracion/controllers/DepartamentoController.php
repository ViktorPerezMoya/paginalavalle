<?php

class Administracion_DepartamentoController extends Zend_Controller_Action {

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
        
    }

    public function historiaAction() {
        $query = $this->_em->createQuery('SELECT s FROM My\Entity\Seccion s WHERE s.id = 1');
        $noticia = $query->getSingleResult();

        $this->view->noticia = $noticia;
    }

    public function editarHistoriaAction() {
        $query = $this->_em->createQuery('SELECT s FROM My\Entity\Seccion s WHERE s.id = 1');
        $noticia = $query->getSingleResult();

        $form = new Administracion_Form_SeccionForm();
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

    public function distritosAction() {
        $query = $this->_em->createQuery('SELECT a FROM My\Entity\Seccion a WHERE a.id = ?1');
        $query->setParameter(1, 2);
        $seccion = $query->getSingleResult();

        $subcontenidos = $seccion->getSubcontenidos()->toArray();

        $this->view->distritos = $subcontenidos;
    }

    public function nuevoDistritoAction() {
        $form = new Administracion_Form_DistritoForm();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {


                    if (sizeof($form->upload->getFileName()) > 0) {
                        //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                        $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost

                        $form->upload->receive(); //subimos el archivo
                        if (!$form->upload->isReceived()) {//se subio? 
                            die();
                        }

                        $momento = date('Ymdhis'); //obtengo el moemnto
                        if (!rename('./img/distritos/' . $url, './img/distritos/IMG_DISTRITO_' . $momento . '.jpg')) {//renombro el archivo
                            die();
                        }


                        $distrito = new My\Entity\Subcontenido();
                        $distrito->setImagen('IMG_DISTRITO_' . $momento . '.jpg');
                    }
                    $distrito->setSeccion_id(
                            $this->_em->find('My\Entity\Seccion', 2)
                    );
                    $distrito->setTitulo($form->titulo->getValue());
                    $distrito->setContenido($form->contenido->getValue());
                    $distrito->setMostrar(true);

                    $this->_em->merge($distrito);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();


                    $this->_helper->redirector('distritos', 'departamento', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarDistritoAction() {
        $id = $this->getParam('id');
        $distrito = $this->_em->find('My\Entity\Subcontenido', $id);
        //$distrito = new My\Entity\Subcontenido();

        $form = new Administracion_Form_DistritoForm();
        $form->titulo->setValue($distrito->getTitulo());
        $form->contenido->setValue($distrito->getContenido());

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {
                    $imagenanterior = $distrito->getImagen();

                    if (sizeof($form->upload->getFileName()) > 0) {
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
                        if (!rename('./img/distritos/' . $url, './img/distritos/IMG_DISTRITO_' . $momento . '.jpg')) {//renombro el archivo
                            die();
                        }


                        $distrito->setImagen('IMG_DISTRITO_' . $momento . '.jpg');
                    }

                    $distrito->setTitulo($form->titulo->getValue());
                    $distrito->setContenido($form->contenido->getValue());

                    $this->_em->merge($distrito);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();


                    $this->_helper->redirector('distritos', 'departamento', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function eliminarDistritoAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $id = $this->getRequest()->getPost('id');
        $subc = $this->_em->find('My\Entity\Subcontenido', $id);

        $this->_em->getConnection()->beginTransaction();
        try {

            $subc->setMostrar(false);

            $this->_em->merge($subc);
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
