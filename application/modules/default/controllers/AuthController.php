<?php

class Default_AuthController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function loginAction() {
        //cambio de layout
        //$layout = Zend_Layout::getMvcInstance();
        //$layout->setLayout('layoutlogin');
        $this->view->headTitle('Inicio de sesion');


        $form = new Default_Form_LoginForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {

            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {

                $usuario = $form->getValue('usuario');
                $clave = $form->getValue('clave');

                $authAdapter = new My_Auth_Adapter($usuario, $clave);
                $result = Zend_Auth::getInstance()->authenticate($authAdapter);
//                var_dump($result);die();
                if (Zend_Auth::getInstance()->hasIdentity()) {
                    $sesion = new Zend_Session_Namespace('paginaguardada');
//                    var_dump($sesion);die();
                    if (isset($sesion->pagina)) {
                        $this->_helper->redirector($sesion->action, $sesion->controlador, $sesion->module);
                    } else {
                        $this->_helper->redirector('bienvenido', 'index', 'default');
                    }
                } else {
                    $this->view->message = implode('  ', $result->getMessages());
                }
            }
            $this->view->errors = $form->getErrorMessages();
        }
    }

    public function salirAction() {
        if (Zend_Auth::getInstance()->hasIdentity()) {
            Zend_Auth::getInstance()->clearIdentity();
        }
        $this->_helper->redirector('login', 'auth', 'default');
    }

    public function cambiarClaveAction() {
        $this->view->headTitle('Cambiar Clave'); 
        $form = new Administracion_Form_ClaveForm();
        $this->view->form = $form;


        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();

            if ($form->isValid($data)) {

                $usuario = $this->_em->find('My\Entity\Usuario', Zend_Auth::getInstance()->getIdentity()->getId());

                if ($usuario) {
                    $usuario->setClave(sha1($form->clave->getValue()));

                    $this->_em->flush();

                    $this->_helper->redirector('index', 'index', 'default');
                }
            }
        }
    }

    public function registrarseAction() {
        $this->view->headTitle('Registar');

        $form = new Default_Form_RegistrarUsuarioForm();
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost();
            if ($form->isValid($data)) {
                if ($form->clave->getValue() == $form->repetirclave->getValue()) {
                    $this->enviarMail($form);
                } else {
                    var_dump("las claves no coinciden");
                }
            }
        }
    }

    public function enviarMail($form) {
        $mail = new PHPMailer_Application_Resource_PHPMailer();
        $mail->isSMTP();                                      // Activamos SMTP para mailer
        $mail->Host = 'mail.lavallemendoza.gov.ar';                       // Especificamos el host del servidor SMTP
        $mail->SMTPAuth = true;                               // Activamos la autenticacion
        $mail->Username = 'vperez@lavallemendoza.gov.ar';       // Correo SMTP
        $mail->Password = 'pereico250690';                // Contraseña SMTP
        $mail->SMTPSecure = 'SSL/TLS';                            // Activamos la encriptacion ssl
        $mail->Port = 465;                                    // Seleccionamos el puerto del SMTP
        $mail->From = 'vperez@lavallemendoza.gov.ar';
        $mail->FromName = 'Municipalidad de Lavalle';                       // Nombre del que envia el correo
        $mail->isHTML(true); //Decimos que lo que enviamos es HTML
        $mail->CharSet = 'UTF-8';  // Configuramos el charset 
        
		$mail->addAddress($form->email->getValue(),$form->nombre->getValue());
 
	//Añadimos el asunto del mail
	$mail->Subject = "Activacion delcuenta"; 
 
	//Mensaje del email
	$mail->Body    = '<div align="center"><img src="http://netosolis.com/wp-content/uploads/2015/01/cropped-oie_226731bFv7qr4Q.png"/></div><br /><br />'.
	$mensaje = "Su cuenta fue activada!!!";
 
	//comprobamos si el mail se envio correctamente y devolvemos la respuesta al servidor
	if(!$mail->send()) {
		return false;
	} else {
		return true;
	} 
    }

}
