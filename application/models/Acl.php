<?php

class Application_Model_Acl
{
    public function __construct() {
        $this->addRole(new Zend_Acl_Role('invitado'));
        $this->addRole(new Zend_Acl_Role('supervisor'), 'invitado');
        $this->addRole(new Zend_Acl_Role('administrador'), 'invitado');

        $this->addResource(new Zend_Acl_Resource('default'))
                ->addResource(new Zend_Acl_Resource('default:index'), 'default')/* voy agregando todos los controladores de cada mudulo */
                ->addResource(new Zend_Acl_Resource('default:error'), 'default')/* voy agregando todos los controladores de cada mudulo */
                ->addResource(new Zend_Acl_Resource('default:acuerdo3949'), 'default')
                ->addResource(new Zend_Acl_Resource('default:auth'), 'default')
                ->addResource(new Zend_Acl_Resource('default:departamento'), 'default')
                ->addResource(new Zend_Acl_Resource('default:gobierno'), 'default')
                ->addResource(new Zend_Acl_Resource('default:noticias'), 'default')
                ->addResource(new Zend_Acl_Resource('default:servicios'), 'default')
                ->addResource(new Zend_Acl_Resource('default:tramites'), 'default')
                ->addResource(new Zend_Acl_Resource('default:turismo'), 'default')
                ->addResource(new Zend_Acl_Resource('default:vendimia'), 'default');
        $this->addResource(new Zend_Acl_Resource('administracion'))
                ->addResource(new Zend_Acl_Resource('administracion:login'), 'administracion')
                ->addResource(new Zend_Acl_Resource('administracion:index'), 'administracion')
                ->addResource(new Zend_Acl_Resource('administracion:error'), 'administracion');


        /* Y AHORA DOY LOS PERMISOS PARA CADA USUARIO */

//        $this
//                ->allow('invitado', 'default:index', array('index'))
//                ->allow('invitado', 'default:error', array('error'))
//                ->allow('invitado', 'default:asla', array('index', 'cursos', 'galeria', 'guia-de-aves', 'objetivos'))
//                ->allow('invitado', 'default:calendario', array('evento', 'index'))
//                ->allow('invitado', 'default:educacion-ambiental', array('ambientalita','galeria-del-proyecto', 'index', 'material-de-consulta', 'proyectos'))
//                ->allow('invitado', 'default:gestionambiental', array('index'))
//                ->allow('invitado', 'default:programas', array('index'))
//                ->allow('invitado', 'administracion:index', array('login'));
//        $this
//                ->allow('usuario', 'administracion:index', array('index', 'salir', 'home','cambiar-clave'))
//                ->allow('usuario', 'administracion:error', array('error'))
//                ->allow('usuario', 'administracion:asla', array('index', 'registro-de-aves','nuevo-registro-de-ave','editar-registro-de-ave','guia-aves'))
//                
//        ;
//
//        $this
//                ->allow('administrador', 'administracion:index', array('index', 'salir', 'home','cambiar-clave'))
//                ->allow('administrador', 'administracion:error', array('error'))
//                ->allow('administrador', 'administracion:asla', array('index', 'registro-de-aves','nuevo-registro-de-ave','editar-registro-de-ave','cursos','editar-curso', 'editar-imagen','editar-guia-aves', 'galeria', 'guia-aves', 'nvo-curso', 'nvo-imagen', 'objetivos-asla'))
//                ->allow('administrador', 'administracion:calendario', array('index', 'evento','editar-evento'))
//                ->allow('administrador', 'administracion:educacion-ambiental', array('index','galeria','editar-ambientalita','editar-material','nvo-material','nueva-imagen','editar-imagen','editar-proyecto' ,'ambientalita', 'material-de-consulta', 'nvo-ambientalita', 'nvo-proyecto', 'proyectos'))
//                ->allow('administrador', 'administracion:secciones', array('index', 'gestion-ambiental', 'nvo-doc-ges-amb', 'nvo-programas', 'programas','editar-gestion-ambiente','editar-programa'))
//                
//
//        ;
    }
}

