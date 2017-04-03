<?php

class Default_TramitesWebController extends Zend_Controller_Action {

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
        $layout->setLayout('layout');

        $this->_doctrineContainer = Zend_Registry::get('doctrine');
        $this->_em = $this->_doctrineContainer->getEntityManager();

        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction() {
        // action body
    }

    public function guiaAction() {
        $this->view->headTitle('Guia de Tramites'); 
        // action body
    }

    public function licitacionesAction() {
        $this->view->headTitle('Licitaciones'); 
        $query = $this->_em->createQuery("SELECT l FROM My\Entity\Licitacion l WHERE l.activo = ?1 ORDER BY l.id DESC");
        $query->setParameter(1, true);
        $licitaciones = $query->getResult();
        
        $this->view->licns = $licitaciones;
    }

    public function reclamosYSugerenciasAction() {
        $this->view->headTitle('Reclamos y Sujerencias'); 
       
            
        $form = new Default_Form_Contacto();

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $this->_em->getConnection()->beginTransaction();
                try {
                    $mensaje = new My\Entity\Mensaje();
                    $mensaje->setEmail($form->email->getValue());
                    $mensaje->setNombre($form->nombre->getValue());
                    $mensaje->setAsunto($form->asunto->getValue());
                    $mensaje->setContenido($form->descripcion->getValue());
                    
                    $this->_em->merge($mensaje);
                    $this->_em->flush();
                    $this->_em->getConnection()->commit();
                    
                    $this->_helper->redirector('mensaje-enviado');
                } catch (Exception $ex) {
                    $this->_em->getConnection()->rollback();
                    $this->_em->close();
                    var_dump($ex);
                    die();
                }


            }
        }

        
    }
    
    public function mensajeEnviadoAction(){
        
    }
    
    public function licitacionPdfAction()
    {
        $this->view->headTitle('Licitación'); 
        $this->_helper->layout()->disableLayout();
    	$id = $this->_getParam('id');

        $licitacion = $this->_em->find('My\Entity\Licitacion', $id);
        $fechaLic = new DateTime($licitacion->getFechaDeApertura());


        
		$pdf = new TCPDF_Application_Resource_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		
		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage();


		// Set some content to print
		$html = '<table border="0" cellspacing="3" cellpadding="4">
			<tr><td colspan="4" align="center"><h1>Certificado de Publicación</h1></td></tr>
			 <tr>
		        <td></td>
		        <td></td>
		        <td></td>
		        <td>
		        Fecha:'.date('d-m-Y').'<br>
		        Hora:'.date('H:i').'<br>
		        Página: 1</td>
		    </tr>
		    <tr>
		        <td colspan="4" style="text-decoration: underline">Datos de Licitación</td>
		    </tr>
		    <tr>
		    	<td>Número:</td>
		    	<td colspan="3">'.$licitacion->getNumero() . '/' . $licitacion->getAnio().'</td>
		    </tr>
		    <tr>
		    	<td>Descripción:</td>
		    	<td colspan="3">'.$licitacion->getDescripcion().'</td>
		    </tr>
		    <tr>
		    	<td>Fecha de apertura: </td>
		    	<td>'.$fechaLic->format('d-m-Y').'</td>
		    	<td>Hora:</td>
		    	<td>'.$licitacion->getHoraDeApertura() . ':00</td>
		    </tr>
		    <tr>
		    	<td>Tipo de contratación:</td>
		    	<td colspan="3">'.$licitacion->getTipoDeContratacion().'</td>
		    </tr>
		</table>';

		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

		// ---------------------------------------------------------

		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output('example_001.pdf', 'I');

       
    }

}
