<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of PreControllerHookController
 *
 * @author Javier
 */
class PostControllerConstructorHook extends CI_Hooks {

    /**
     *
     * @var CI_Controller 
     */
    private $ci;

    function __construct() {
        $this->ci = & get_instance();
    }

    /**
     * inicializa el usuario buscandolo en la base de datos
     */
    public function inicializeUser() {
        $login = $this->ci->usersession->getLogin();
        if ($login) {
            $userClass = $this->ci->config->item(CFG_User_Class);
            $userLoginColumn = $this->ci->config->item(CFG_User_LoginColumn);
            $user = $this->ci->$userClass->findOneBy([$userLoginColumn => $login]);
            if($user->getId()){
                $this->ci->usersession->setUser($user);
                $user->updateVisitParms();
            }
        }
    }

    /**
     * comprueba si el usuario tiene los permisos necesarios para acceder a la funcionalidad de la peticion
     * @return void
     */
    public function checkSecurity() {
        $security_enabled = $this->ci->config->item("security_enabled");

        if (!$security_enabled) {
            return;
        }

        $security = $this->ci->config->item(CFG_security);

        $boolForbbiden = false;
        foreach ($security as $uri_pattern => $aAccGroups) {
            if (preg_match($uri_pattern, $this->ci->uri->uri_string())) { // si existe una regla
                $boolForbbiden = (($this->ci->usersession->isAuthenticated() && (!in_array($this->ci->usersession->getRole(), $aAccGroups) || in_array(-1, $aAccGroups)))  //esta logado y no tiene permisos y es una web de acceso
                        || (!$this->ci->usersession->isAuthenticated() && (!in_array(0, $aAccGroups) && !in_array(-1, $aAccGroups)))); //no esta logado y no es una web publica ni de acceso
            }
        }

        if ($boolForbbiden) {
            if (!$this->ci->usersession->isAuthenticated()) {
                $this->ci->session->set_tempdata('redirect-on-login', $this->ci->uri->uri_string(), 300 * 1000); //5 minutos
                redirect('login');
            }
            show_error('403 - No tiene acceso a esta página. <a onclick="window.history.back()" href="#">volver atrás</a> o <a href="'.base_url('logout-action').'">logarse de nuevo</a>', 403);
        }
    }

    public function loadStructureData() {
        $this->ci->load->library('StructuredData');
    }

}
