<?php

class Administracion_ColectivosController extends Zend_Controller_Action {

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
        $query = $this->_em->createQuery("SELECT s FROM My\Entity\Seccion s where s.id = ?1");
        $query->setParameter(1,5);

        $this->view->horarios = $query->getSingleResult()->getArchivos();
    }

    public function cambiarHorarioAction() {
        $id = $this->getParam('id');
        $a = $this->_em->find('My\Entity\Archivo',$id);

        $form = new Administracion_Form_ColectivoForm();
        $form->titulo->setValue($a->getTitulo());
        $this->view->form = $form;

        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost();
            if($form->isValid($data)){
                $this->_em->getConnection()->beginTransaction();
                try {

                    $a->setTitulo($form->titulo->getValue());

                    if (sizeof($form->upload->getFileName()) > 0) {
                        //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                        $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost

                        $form->upload->receive(); //subimos el archivo
                        if (!$form->upload->isReceived()) {//se subio? 
                            var_dump('El documeno no se subio operacion cancelada');
                            die();
                        }

                        $a->setUrl($url);
                    } else {
                        var_dump('No se ha seleccionado documento');
                        die();
                    }
                    
                    $this->_em->merge($a);
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
}