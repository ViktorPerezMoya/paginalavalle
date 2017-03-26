<?php

class Administracion_TramitesController extends Zend_Controller_Action {

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
        // action body
    }

    public function tramitesWebAction() {
        $query = $this->_em->createQuery('SELECT a FROM My\Entity\Seccion a WHERE a.id = ?1');
        $query->setParameter(1, 3);
        $seccion = $query->getSingleResult();

        $tram = $seccion->getSubcontenidos()->toArray();

        $this->view->tram = $tram;
    }

    public function nuevoTramiteAction() {

        $form = new Administracion_Form_TramiteForm();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {




                    $distrito = new My\Entity\Subcontenido();
                    $distrito->setSeccion_id(
                            $this->_em->find('My\Entity\Seccion', 3)
                    );
                    $distrito->setTitulo($form->titulo->getValue());
                    $distrito->setContenido($form->contenido->getValue());
                    $distrito->setMostrar(true);

                    $this->_em->merge($distrito);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();


                    $this->_helper->redirector('tramites-web', 'taramites', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarTramiteAction() {

        $id = $this->getParam('id');
        $distrito = $this->_em->find('My\Entity\Subcontenido', $id);
        //$distrito = new My\Entity\Subcontenido();

        $form = new Administracion_Form_TramiteForm();
        $form->titulo->setValue($distrito->getTitulo());
        $form->contenido->setValue($distrito->getContenido());

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {

                    $distrito->setTitulo($form->titulo->getValue());
                    $distrito->setContenido($form->contenido->getValue());

                    $this->_em->merge($distrito);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();


                    $this->_helper->redirector('tramites-web', 'tramites', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function eliminarTramiteAction() {

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

    public function licitacionesAction() {
        $query = $this->_em->createQuery('SELECT l FROM My\Entity\Licitacion l WHERE l.activo = 1 ORDER BY l.id DESC');
        $licitaciones = $query->getResult();

        $this->view->lics = $licitaciones;
    }

    public function nuevaLicitacionAction() {

        $form = new Administracion_Form_LicitacionForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {
                    $lic = new My\Entity\Licitacion();

                    $lic->setNumero($form->numero->getValue());
                    $lic->setDescripcion($form->descripcion->getValue());
                    $lic->setFechaDeApertura($form->fecha->getValue());
                    $lic->setHoraDeApertura($form->hora->getValue());
                    $lic->setTipoDeContratacion($form->tipo->getValue());
                    $lic->setAnio(date('Y'));
                    $lic->setActiva(true);

                    $this->_em->merge($lic);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('licitaciones', 'tramites', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarLicitacionAction() {
        $id = $this->getParam('id');
        $lic = $this->_em->find('My\Entity\Licitacion', $id);
        //$lic = new My\Entity\Licitacion();

        $form = new Administracion_Form_LicitacionForm();
        $form->numero->setValue($lic->getNumero());
        $form->descripcion->setValue($lic->getDescripcion());
        $form->fecha->setValue($lic->getFechaDeApertura());
        $form->hora->setValue($lic->getHoraDeApertura());
        $form->tipo->setValue($lic->getTipoDeContratacion());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {

                    $lic->setNumero($form->numero->getValue());
                    $lic->setDescripcion($form->descripcion->getValue());
                    $lic->setFechaDeApertura($form->fecha->getValue());
                    $lic->setHoraDeApertura($form->hora->getValue());
                    $lic->setTipoDeContratacion($form->tipo->getValue());
                    $lic->setAnio(date('Y'));
                    $lic->setActiva(true);

                    $this->_em->merge($lic);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('licitaciones', 'tramites', 'administracion');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }
    
    public function eliminarLicitacionAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $id = $this->getRequest()->getPost('id');
        $lici = $this->_em->find('My\Entity\Licitacion', $id);
        //$lici = new My\Entity\Licitacion();
        
        $this->_em->getConnection()->beginTransaction();
        try {

            $lici->setActiva(false);

            $this->_em->merge($lici);
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
