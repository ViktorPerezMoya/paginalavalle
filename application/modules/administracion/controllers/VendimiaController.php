<?php

class Administracion_VendimiaController extends Zend_Controller_Action {

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

    public function candidatasAction() {


        //$candidatas = $this->_em->getRepository('My\Entity\Candidata')->findBy(array('periodo'=>date('Y'),'estado'=>false));
        $candidatas = $this->_em->getRepository('My\Entity\Candidata')->findBy(array('periodo' => date('Y'), 'estado' => false));
        $this->view->candidatas = $candidatas;
    }

    public function nuevaCandidataAction() {
        $form = new Administracion_Form_CandidataForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    $candidata = new My\Entity\Candidata();
                    $candidata->setNombre($form->nombre->getValue());
                    $candidata->setCabello($form->cabello->getValue());
                    $candidata->setDistrito($form->distrito->getValue());
                    $candidata->setEdad($form->edad->getValue());
                    $candidata->setEstado(false);
                    $candidata->setEstudios($form->estudios->getValue());
                    $candidata->setHobby($form->hobby->getValue());
                    $candidata->setOjos($form->ojos->getValue());
                    $candidata->setPeriodo(date('Y'));
                    $candidata->setReina(false);
                    $candidata->setVotos(0);

                    $this->_em->merge($candidata);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('candidatas');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function agregarImagenAction() {
        $id = $this->getParam('id');
        $candidata = $this->_em->find('My\Entity\Candidata', $id);
        $this->view->candidata = $candidata;

        $form = new Administracion_Form_ImagenCandidataForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                    $url = substr(strrchr($form->upload->getFileName(), '\\'), 1); //localhost


                    $form->upload->receive(); //subimos el archivo
                    if (!$form->upload->isReceived()) {//se subio? 
                        die();
                    }

                    $momento = date('Ymdhis'); //obtengo el moemnto
                    if (!rename('./img/candidatas/' . $url, './img/candidatas/CANDIDATA_ID' . $candidata->getId_candidata() . '_' . $momento . '.jpg')) {//renombro el archivo
                        die();
                    }


                    $imagen = new My\Entity\Imagen();
                    $imagen->setUrl('CANDIDATA_ID' . $candidata->getId_candidata() . '_' . $momento . '.jpg');
                    $imagen->setCandidata_id($candidata);
                    $imagen->setTipo('Candidata');

                    $this->_em->merge($imagen);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('candidatas');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }
            }
        }
    }

    public function editarCandidataAction() {
        $id = $this->getParam('id');
        $candidata = $this->_em->find('My\Entity\Candidata', $id);

        $form = new Administracion_Form_CandidataForm();
        $form->nombre->setValue($candidata->getNombre());
        $form->cabello->setValue($candidata->getCabello());
        $form->distrito->setValue($candidata->getDistrito());
        $form->edad->setValue($candidata->getEdad());
        $form->estudios->setValue($candidata->getEstudios());
        $form->hobby->setValue($candidata->getHobby());
        $form->ojos->setValue($candidata->getOjos());
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {
                    $candidata->setNombre($form->nombre->getValue());
                    $candidata->setCabello($form->cabello->getValue());
                    $candidata->setDistrito($form->distrito->getValue());
                    $candidata->setEdad($form->edad->getValue());
                    $candidata->setEstudios($form->estudios->getValue());
                    $candidata->setHobby($form->hobby->getValue());
                    $candidata->setOjos($form->ojos->getValue());

                    $this->_em->merge($candidata);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();

                    $this->_helper->redirector('candidatas');
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
        $id = $this->getRequest()->getPost('id');
        $candidata = $this->_em->find('My\Entity\Candidata', $id);

        $this->_em->getConnection()->beginTransaction();
        try {

            $candidata->setEstado(true);

            $this->_em->merge($candidata);
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
        $id = $this->getRequest()->getPost('id');
        $candidata = $this->_em->find('My\Entity\Candidata', $id);

        $this->_em->getConnection()->beginTransaction();
        try {

            $candidata->setEstado(false);

            $this->_em->merge($candidata);
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

    public function reinaAction() {
        $candidatas = $this->_em->getRepository('My\Entity\Candidata')->findBy(array('periodo' => date('Y'), 'periodo' => date('Y')));

        $queryreina = $this->_em->createQuery('SELECT c FROM My\Entity\Candidata c WHERE c.reina = 1 AND c.estado = 0 ORDER BY c.periodo ASC');
        $reinas = $queryreina->getResult();

        if (sizeof($reinas) > 0) {
            $reina = $reinas[sizeof($reinas) - 1];
        } else {
            $reina = null;
        }

        //var_dump($reina);die();

        $this->view->candidatas = $candidatas;
        $this->view->reina = $reina;

        /*         * ***** */
        $form = new Administracion_Form_NuevaReinaForm();
        $form->candidatavieja->setValue($reina->getId_candidata());

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                if (null != $form->candidatavieja->getValue()) {
                    $idvja = $form->candidatavieja->getValue();
                    $rvja = $this->_em->find('My\Entity\Candidata', $idvja);
                }

                $idnva = $form->candidatanueva->getValue();
                $rnva = $this->_em->find('My\Entity\Candidata', $idnva);

                $this->_em->getConnection()->beginTransaction();
                try {
                    if ($rvja->getPeriodo() == date('Y')) {
                        $rvja->setReina(false);
                        $this->_em->merge($rvja);
                    }

                    $rnva->setReina(true);
                    $this->_em->merge($rnva);

                    $this->_em->getConnection()->commit();
                    $this->_em->flush();

                    $this->_helper->redirector('reina');
                } catch (Exception $ex) {

                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                }
            }
        }
    }

    public function galeriaAction() {
        $query = $this->_em->createQuery("select i from My\Entity\Galeria i where i.galeria = ?1 ORDER BY i.id DESC");
        $query->setParameter(1, 'vendimia');

        $imagenes = $query->getResult();


        $this->view->imagenes = $imagenes;
    }

    public function nuevaImagenAction() {
        $form = new Administracion_Form_NuevaImagenVendimiaForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                $this->_em->getConnection()->beginTransaction();
                try {

                    //$url = substr(strrchr($form->upload->getFileName(),   '/'), 1);//web

                    $url = substr(strrchr($form->uploadgrande->getFileName(), '\\'), 1); //localhost
                    $url2 = substr(strrchr($form->uploadchica->getFileName(), '\\'), 1); //localhost


                    $form->uploadgrande->receive(); //subimos el archivo
                    if (!$form->uploadgrande->isReceived()) {//se subio? 
                        die();
                    }

                    $form->uploadchica->receive(); //subimos el archivo
                    if (!$form->uploadchica->isReceived()) {//se subio? 
                        die();
                    }

                    $momento = date('Ymdhis'); //obtengo el moemnto
                    if (!rename('./img/galeria/' . $url, './img/galeria/IMG_VENDIMIA_' . $momento . '.jpg')) {//renombro el archivo
                        die();
                    }
                    if (!rename('./img/galeria/thumbnails/' . $url2, './img/galeria/thumbnails/IMG_VENDIMIA_' . $momento . '.jpg')) {//renombro el archivo
                        die();
                    }
                    $i = new My\Entity\Galeria();
                    $i->setTitulo($form->titulo->getValue());
                    $i->setUrl('IMG_VENDIMIA_' . $momento . '.jpg');
                    $i->setGaleria('vendimia');

                    $this->_em->merge($i);
                    $this->_em->getConnection()->commit();
                    $this->_em->flush();

                    $this->_helper->redirector('galeria');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                }
            }
        }
    }

    public function eliminarImagenAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $id = $this->getRequest()->getPost('idimagen');
        $imagen = $this->_em->find('My\Entity\Galeria', $id);

        $this->_em->getConnection()->beginTransaction();
        try {
            if (!rename('./img/galeria/' . $imagen->getUrl(), './img/galeria/DELETED_' . $imagen->getUrl() . '.jpg')) {//renombro el archivo
                die();
            }

            $this->_em->remove($imagen);
            $this->_em->getConnection()->commit();
            $this->_em->flush();
            echo 'Se elimino la imagen exitosamente!!';
        } catch (Exception $ex) {
            $this->_em->getConnection()->rollback();
            $this->_em->close();
            //var_dump($ex);die();
            echo 'ERROR: Problemas al relaizar cambios.' . $ex;
            print_r($ex);
        }
    }

}
