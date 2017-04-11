<?php

class Administracion_GobiernoController extends Zend_Controller_Action {

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

    public function areasMunicipalesAction() {
        $query = $this->_em->createQuery("SELECT a FROM My\Entity\AreaMunicipal a WHERE a.activo = ?1 AND a.vista = 'areas'");
        $query->setParameter(1, true);
        $areas = $query->getResult();
        $this->view->areas = $areas;
    }

    public function getAreasAction(){
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
      
      $tipo = $this->getParam('tipo');
      $modelModelo = new Administracion_Model_AreasTable();
      $results = $modelModelo->getAreas($tipo);
      $this->_helper->json($results);
    }


    public function nuevaAreaAction() {
        $form = new Administracion_Form_AreaMunicipalForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    $area = new My\Entity\AreaMunicipal();
                    $area->setTitulo($form->titulo->getValue());
                    $area->setAcargode($form->acargode->getValue());
                    $area->setCargoanterior($form->cargoanterior->getValue());
                    $area->setDireccion($form->direccion->getValue());
                    $area->setTelefono($form->telefono->getValue());
                    $area->setEmail($form->email->getValue());
                    $area->setFunciones($form->funciones->getValue());
                    $area->setActivo(true);
                    $area->setTipo($form->tipo->getValue());
                    $area->setAreasuperior($form->dependede->getValue());
                    $area->setVista("areas");

                    $this->_em->merge($area);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('areas-municipales');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarAreaAction() {
        $id = $this->getParam('id');
        $area = $this->_em->find('My\Entity\AreaMunicipal', $id);
        $form = new Administracion_Form_AreaMunicipalForm();
        $form->titulo->setValue($area->getTitulo());
        $form->acargode->setValue($area->getAcargode());
        $form->cargoanterior->setValue($area->getCargoanterior());
        $form->direccion->setValue($area->getDireccion());
        $form->telefono->setValue($area->getTelefono());
        $form->email->setValue($area->getEmail());
        $form->funciones->setValue($area->getFunciones());
        $form->tipo->setValue($area->getTipo());
        $form->dependede->setValue($area->getAreasuperior());

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    //$area = new My\Entity\AreaMunicipal();
                    $area->setTitulo($form->titulo->getValue());
                    $area->setAcargode($form->acargode->getValue());
                    $area->setCargoanterior($form->cargoanterior->getValue());
                    $area->setDireccion($form->direccion->getValue());
                    $area->setTelefono($form->telefono->getValue());
                    $area->setEmail($form->email->getValue());
                    $area->setFunciones($form->funciones->getValue());
                    $area->setTipo($form->tipo->getValue());
                    $area->setAreasuperior($form->dependede->getValue());
                    $area->setActivo(true);

                    $this->_em->merge($area);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('areas-municipales');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function borrarAreaAction() {

        $id = $this->getParam('id');
        $area = $this->_em->find('My\Entity\AreaMunicipal', $id);

        $this->_em->getConnection()->beginTransaction();
        try {
            $area->setActivo(false);

            $this->_em->merge($area);
            $this->_em->flush();
            $this->_em->getConnection()->commit();

            $this->getRequest()->clearParams();
            $this->_helper->redirector('areas-municipales', 'gobierno', 'administracion');
        } catch (Exception $ex) {
            $this->_em->getConnection()->rollback();
            $this->_em->close();
        }
    }

    public function secretariaObrasServiciosPublicosAction() {
        
    }

    public function obrasAction() {
        $query = $this->_em->createQuery("SELECT o FROM My\Entity\Obra o WHERE o.activo = ?1");
        $query->setParameter(1, true);
        $obras = $query->getResult();
        $this->view->obras = $obras;
    }

    public function nuevaObraAction() {
        $form = new Administracion_Form_ObraForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    $area = new My\Entity\Obra();
                    $area->setTitulo($form->tituloobra->getValue());
                    $area->setContenido($form->contenido->getValue());
                    $area->setActivo(true);

                    $this->_em->merge($area);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('obras');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarObraAction() {
        $id = $this->getParam('id');
        $area = $this->_em->find('My\Entity\Obra', $id);
        $form = new Administracion_Form_ObraForm();
        $form->tituloobra->setValue($area->getTitulo());
        $form->contenido->setValue($area->getContenido());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    //$area = new My\Entity\Obra();
                    $area->setTitulo($form->tituloobra->getValue());
                    $area->setContenido($form->contenido->getValue());
                    $area->setActivo(true);

                    $this->_em->merge($area);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('obras');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function borrarObraAction() {
        $id = $this->getParam('id');
        $area = $this->_em->find('My\Entity\Obra', $id);

        $this->_em->getConnection()->beginTransaction();
        try {
            $area->setActivo(false);

            $this->_em->merge($area);
            $this->_em->flush();
            $this->_em->getConnection()->commit();

            $this->getRequest()->clearParams();
            $this->_helper->redirector('obras', 'gobierno', 'administracion');
        } catch (Exception $ex) {
            $this->_em->getConnection()->rollback();
            $this->_em->close();
        }
    }

    public function direccionesObrasAction() {
        $query = $this->_em->createQuery("SELECT a FROM My\Entity\AreaMunicipal a WHERE a.activo = ?1 AND a.vista = 'secretaria-obras'");
        $query->setParameter(1, true);
        $direcciones = $query->getResult();
        $this->view->areas = $direcciones;
    }

    public function nuevaDireccionObrasAction() {
        $form = new Administracion_Form_DireccionObrasForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    $area = new My\Entity\AreaMunicipal();
                    $area->setTitulo($form->titulodireccion->getValue());
                    $area->setFunciones($form->contenidodireccion->getValue());
                    $area->setActivo(true);
                    $area->setVista("secretaria-obras");

                    $this->_em->merge($area);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('direcciones-obras');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarDireccionObrasAction() {
        $id = $this->getParam('id');
        $area = $this->_em->find('My\Entity\AreaMunicipal', $id);
        $form = new Administracion_Form_DireccionObrasForm();
        $form->titulodireccion->setValue($area->getTitulo());
        $form->contenidodireccion->setValue($area->getFunciones());

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    //$area = new My\Entity\AreaMunicipal();
                    $area->setTitulo($form->titulodireccion->getValue());
                    $area->setFunciones($form->contenidodireccion->getValue());

                    $this->_em->merge($area);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('direcciones-obras');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function borrarDireccionObrasAction() {

        $id = $this->getParam('id');
        $area = $this->_em->find('My\Entity\AreaMunicipal', $id);

        $this->_em->getConnection()->beginTransaction();
        try {
            $area->setActivo(false);

            $this->_em->merge($area);
            $this->_em->flush();
            $this->_em->getConnection()->commit();

            $this->getRequest()->clearParams();
            $this->_helper->redirector('direcciones-obras', 'gobierno', 'administracion');
        } catch (Exception $ex) {
            $this->_em->getConnection()->rollback();
            $this->_em->close();
        }
    }

    public function archivosConsejoAction() {
        $query = $this->_em->createQuery("SELECT a FROM My\Entity\ProyectoHCD a");
        $this->view->archivos = $query->getResult();
    }

    public function nuevoDocumentoConsejoAction() {

        $form = new Administracion_Form_DocumentoConsejolForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    $documento = new My\Entity\ProyectoHCD();

                    $documento->setTipo($form->tipodoc->getValue());
                    $documento->setTitulo($form->titulodoc->getValue());
                    $documento->setResumen($form->resumendoc->getValue());

                    if (sizeof($form->upload->getFileName()) > 0) {
                        //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                        $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost

                        $form->upload->receive(); //subimos el archivo
                        if (!$form->upload->isReceived()) {//se subio? 
                            var_dump('El documeno no se subio operacion cancelada');
                            die();
                        }

                        $documento->setDocumento($url);
                    } else {
                        var_dump('No se ha seleccionado documento');
                        die();
                    }
                    
                    $this->_em->merge($documento);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();
                    
                    $this->_helper->redirector('archivos-consejo');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }
    
    public function editarDocumentoConsejoAction(){
        
        $id = $this->getParam('id');
        $documento = $this->_em->find('My\Entity\ProyectoHCD',$id);
        $form = new Administracion_Form_DocumentoConsejolForm();
        $form->titulodoc->setValue($documento->getTitulo());
        $form->tipodoc->setValue($documento->getTipo());
        $form->resumendoc->setValue($documento->getResumen());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {

                    $documento->setTipo($form->tipodoc->getValue());
                    $documento->setTitulo($form->titulodoc->getValue());
                    $documento->setResumen($form->resumendoc->getValue());

                    if (sizeof($form->upload->getFileName()) > 0) {
                        //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                        $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost

                        $form->upload->receive(); //subimos el archivo
                        if (!$form->upload->isReceived()) {//se subio? 
                            var_dump('El documeno no se subio operacion cancelada');
                            die();
                        }

                        $documento->setDocumento($url);
                    } else {
                        var_dump('No se ha seleccionado documento');
                    }
                    
                    $this->_em->merge($documento);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();
                    
                    $this->_helper->redirector('archivos-consejo');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }
    
    public function borrarDocumentoConsejoAction() {

        $id = $this->getParam('id');
        $doc = $this->_em->find('My\Entity\ProyectoHCD', $id);

        $this->_em->getConnection()->beginTransaction();
        try {

            $this->_em->remove($doc);
            $this->_em->flush();
            $this->_em->getConnection()->commit();

            $this->getRequest()->clearParams();
            $this->_helper->redirector('archivos-consejo', 'gobierno', 'administracion');
        } catch (Exception $ex) {
            $this->_em->getConnection()->rollback();
            $this->_em->close();
        }
    }

}
