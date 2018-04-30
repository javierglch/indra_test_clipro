<?php

define('LOGIN', 'login');
define('AUTHENTICATED', 'auth');
define('ROLE', 'role');
define('CREDENTIALS', 'credentials');
define('FORM_LLAMADME', 'llamando');
define('CREDENTIAL_ADMIN', 'admin');
define('PARTNER_ID', 'puuid');
define('LANGUAGE', 'language');
define('COOKIES', 'cookies_ok');
define('ROLE_ADMIN', 14);
define('ROLE_ANALYST', 3);
define('ROLE_USER', 1);
define('ROLE_BLOGGER', 2);

/**
 * Description of UserSession
 *
 * @author Javier
 */
class Usersession {

    /**
     * @var CI_Controller 
     */
    private $ci;

    /**
     * @var Users
     */
    private $objUser;

    function __construct() {
        $this->ci = get_instance();
    }

    /**
     * Loguea el usuario
     * @param Object $objUser
     */
    public function loginUser($objUser) {
        $this->setAuthenticated(true);
        $columnName_login = $this->ci->config->item(CFG_User_LoginColumn);
        $columnName_role = $this->ci->config->item(CFG_User_RoleColumn);
        $this->setLogin($objUser->$columnName_login);
        $this->setRole($objUser->$columnName_role);
        $this->setAdmin($objUser->$columnName_role == ROLE_ADMIN);
        $this->setUser($objUser);
    }

    /**
     * Desloguea el usuario
     * @param Object $objUser
     */
    public function logoutUser() {
        $this->setAuthenticated(false);
        $this->setLogin(null);
        $this->setRole(null);
        $this->setAdmin(false);
        $this->setUser(null);
    }

    /**
     * pone al usuario en la sesion (esta variable no se puede guardar, hay que inicializarla siempre)
     * @param object $objUser
     */
    public function setUser($objUser) {
        $this->objUser = $objUser;
    }

    /**
     * 
     * @return Accounts
     */
    public function getUser() {
        return $this->objUser;
    }

    public function addCredential($credential) {
        $credentials = $this->ci->session->userdata(CREDENTIALS);
        if (!$credentials) {
            $credentials = [];
        }
        $credentials[$credential] = true;
        $this->ci->session->set_userdata(CREDENTIALS, $credentials);
    }

    public function removeCredential($credential) {
        $credentials = $this->ci->session->userdata(CREDENTIALS);
        if (!$credentials) {
            $credentials = [];
        }
        $credentials[$credential] = false;
        $this->ci->session->set_userdata(CREDENTIALS, $credentials);
    }

    public function hasCredential($credential) {
        $credentials = $this->ci->session->userdata(CREDENTIALS);
        return isset($credentials[$credential]) && $credentials[$credential];
    }

    public function setAdmin($bool = true) {
        $credentials = $this->ci->session->userdata(CREDENTIALS);
        $credentials[CREDENTIAL_ADMIN] = $bool;
        return $this->ci->session->set_userdata(CREDENTIALS, $credentials);
    }

    public function isAdmin() {
        $credentials = $this->ci->session->userdata(CREDENTIALS);
        return isset($credentials[CREDENTIAL_ADMIN]) && $credentials[CREDENTIAL_ADMIN];
    }

    public function isAuthenticated() {
        return $this->ci->session->userdata(AUTHENTICATED);
    }

    public function getRole() {
        return $this->ci->session->userdata(ROLE);
    }

    public function setRole($role) {
        return $this->ci->session->set_userdata(ROLE, $role);
    }

    public function getLogin() {
        return $this->ci->session->userdata(LOGIN);
    }

    public function setLogin($login) {
        $this->ci->session->set_userdata(LOGIN, $login);
    }

    public function getAttributes() {
        return $this->ci->session->userdata();
    }

    public function getAttribute($attr) {
        return $this->ci->session->userdata($attr);
    }

    public function getFlash($key) {
        return $this->ci->session->flashdata($key);
    }

    public function removeFlash($key) {
        return $this->ci->session->unmark_flash($key);
    }

    public function removeAttribute($key) {
        return $this->ci->session->unset_userdata($key);
    }

    public function setFlashAlert($key = 'alert-success', $value = '') {
        if (!preg_match("/^(alert-success|alert-warning|alert-danger|alert-info)$/", $key)) {
            throw new Exception('La alerta debe de ser de tipo alert-success, alert-warning, alert-danger o alert-info.');
        }
        return $this->ci->session->set_flashdata($key, $value);
    }

    public function setFlash($key, $value) {
        return $this->ci->session->set_flashdata($key, $value);
    }

    public function setAuthenticated($bool) {
        return $this->ci->session->set_userdata(AUTHENTICATED, $bool);
    }

    public function setAttribute($key, $value) {
        return $this->ci->session->set_userdata($key, $value);
    }

    public function setTempdata($key, $value = true, $seconds = 86400) {
        return $this->ci->session->set_tempdata($key, $value, $seconds);
    }

    public function getTempdata($key) {
        return $this->ci->session->tempdata($key);
    }

    public function clearCredentials() {
        return $this->ci->session->sess_destroy();
    }

    public function getIp() {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    public function getLanguage() {
        return $this->ci->session->userdata(LANGUAGE) ? $this->ci->session->userdata(LANGUAGE) : 'es';
    }

    public function setLanguage($language = 'es') {
        $languages = array_map(function($e) {
            return basename($e);
        }, glob(APPPATH . 'language/*'));
        if (!in_array($language, $languages)) {
            throw new Exception('Incorrect Language: ' . $language . '. It is only permited: ' . implode(', ', $languages), 503);
        }
        $this->ci->session->set_userdata(LANGUAGE, $language);
        $this->loadLanguage();
    }

    public function loadLanguage() {
        $files = array_map(function($e) {
            return basename($e);
        }, glob(APPPATH . 'language/' . $this->getLanguage() . '/*_lang.php'));
        $this->ci->load->language($files, $this->getLanguage());
        //$this->ci->config->set_item('language', $this->getLanguage());
    }

}
