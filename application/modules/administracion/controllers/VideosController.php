<?php

class Administracion_VideosController extends Zend_Controller_Action {

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
        $videos = $this->_em->getRepository('My\Entity\Videos')->findAll();
        $this->view->videos = $videos;
    }

    public function nuevoAction() {

        $form = new Administracion_Form_VideoForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {

                    $video = new My\Entity\Videos();
                    $video->setTitulo($form->titulo->getValue());
                    $video->setIdyoutube($form->identificador->getValue());

                    $this->_em->merge($video);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }

                $this->_helper->redirector('index');
            }
        }
    }

    public function editarAction() {
        $id = $this->getParam('id');
        $video = $this->_em->getRepository('My\Entity\Videos')->find($id);
        //$video = new My\Entity\Videos();
        $form = new Administracion_Form_VideoForm();
        $form->titulo->setValue($video->getTitulo());
        $form->identificador->setValue($video->getIdyoutube());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {

                    $video->setTitulo($form->titulo->getValue());
                    $video->setIdyoutube($form->identificador->getValue());

                    $this->_em->merge($video);
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

}
