<?php

class MY_Controller extends CI_Controller {

    public $layoutName;

    function __construct() {
        parent::__construct();
        $this->layoutName = $this->config->item(CFG_layout);
        if ($this->usersession->isAdmin()) {
            error_reporting(-1);
            ini_set('display_errors', 1);
        }
    }

    /**
     * 
     * @param string $template
     * @param array $aData 
     */
    public function render_html($template = null, $aData = []) {
        if (!file_exists(APPPATH . 'views/' . $template . '.php')) {
            file_put_contents(APPPATH . 'views/' . $template . '.php', $this->uri->uri_string() . ' - view under construction.');
        }
        $this->load->view('layouts/' . $this->layoutName . '/layout', [
            'main_section' => $template ? $this->load->view($template, $aData, true) : ''
        ]);
        
    }

    public function render_json($aDada) {
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode($aDada));
    }

    public function render_img64($img64) {
        $params = explode(',', $img64);
        
        //recojemos codificacion:
        preg_match("/^data:(.*);/", $params[0], $matches);
        $this->output->set_header('Content-type: ' . $matches[1]);
        
        //output
        $this->output->set_output(base64_decode($params[1]));
    }

    public function render_text($text) {
        $this->output->set_header('Content-type: plain/txt');
        $this->output->set_output($text);
    }

    public function setTitle($string, $boolReplace = false) {
        $separator = $this->config->item(CFG_title_separator);
        $currentTitle = $this->config->item(CFG_title);
        $newTitle = $string . ($boolReplace ? '' : $separator . $currentTitle);
        $this->config->set_item(CFG_title, $newTitle);

        $cfg_metas = $this->config->item(CFG_metas);
        $cfg_metas['twitter:title'] = $newTitle;
        $this->config->set_item(CFG_metas, $cfg_metas);

        $cfg_metas_properties = $this->config->item(CFG_metas_properties);
        $cfg_metas_properties['og:title'] = $newTitle;
        $this->config->set_item(CFG_metas_properties, $cfg_metas_properties);
    }

    public function getTitle() {
        return $this->config->item(CFG_title);
    }

    public function setDescription($newDescription) {
        $metas = $this->config->item(CFG_metas);
        $metas['description'] = $newDescription;
        $this->config->set_item(CFG_metas, $metas);


        $cfg_metas = $this->config->item(CFG_metas);
        $cfg_metas['twitter:description'] = $newDescription;
        $this->config->set_item(CFG_metas, $cfg_metas);

        $cfg_metas_properties = $this->config->item(CFG_metas_properties);
        $cfg_metas_properties['og:description'] = $newDescription;
        $this->config->set_item(CFG_metas_properties, $cfg_metas_properties);
    }

    public function getDescription() {
        return $metas = $this->config->item(CFG_metas)['description'];
    }

    /**
     * Coloca la imagen en los metas para que salga en twitter y facebook
     * @param url $urlImage url completa de la imagen https://leagueof.hexania.com/assets/....
     * @param int $width ancho preferido
     * @param int $heigh alto preferido
     */
    public function setMetaImage($urlImage, $width = 80, $heigh = 80) {
        $cfg_metas = $this->config->item(CFG_metas);
        $cfg_metas['twitter:image'] = $urlImage;
        $this->config->set_item(CFG_metas, $cfg_metas);

        $cfg_metas_properties = $this->config->item(CFG_metas_properties);
        $cfg_metas_properties['og:image'] = $urlImage;
        $cfg_metas_properties['og:image:width'] = $width;
        $cfg_metas_properties['og:image:height'] = $heigh;
        $this->config->set_item(CFG_metas_properties, $cfg_metas_properties);
    }

    /**
     * Crea la card para twitter
     * @param array $array configuración para twitter
     */
    public function setTwitterConfigCard($array) {
        $cfg_metas = $this->config->item(CFG_metas);

        foreach ($array as $key => $value) {
            $cfg_metas['twitter:' . $key] = $value;
        }
        $this->config->set_item(CFG_metas, $cfg_metas);
    }
    /**
     * Crea la card para twitter
     * @param array $array configuración para twitter
     */
    public function setFacebookConfigCard($array) {
        $cfg_metas = $this->config->item(CFG_metas_properties);

        foreach ($array as $key => $value) {
            $cfg_metas['og:' . $key] = $value;
        }
        $this->config->set_item(CFG_metas_properties, $cfg_metas);
    }

    public function addKeywords($string) {
        $metas = $this->config->item(CFG_metas);
        $metas['keywords'] .= ', ' . $string;
        $this->config->set_item(CFG_metas, $metas);
    }

    public function setKeywords($string) {
        $metas = $this->config->item(CFG_metas);
        $metas['keywords'] = $string;
        $this->config->set_item(CFG_metas, $metas);
    }

    public function setJavascripts(array $aJavascripts) {
        $this->config->set_item(CFG_javascripts, $aJavascripts);
    }

    public function setStylesheets(array $aStylesheets) {
        $this->config->set_item(CFG_stylesheets, $aStylesheets);
    }

    public function addJavascripts(array $aJavascripts) {
        $this->config->set_item(CFG_javascripts, array_merge($this->config->item(CFG_javascripts), $aJavascripts));
    }

    public function addStylesheets(array $aStylesheets) {
        $this->config->set_item(CFG_stylesheets, array_merge($this->config->item(CFG_stylesheets), $aStylesheets));
    }

    /**
     * Actualiza los metas segun los parametros proporcionados en el parametro
     * @param array $aMetasUpdated
     */
    public function setMetas(array $aMetasUpdated) {
        $metas = $this->config->item(CFG_metas);
        foreach ($aMetasUpdated as $key => $value) {
            $metas[$key] = $value;
        }
        $this->config->set_item(CFG_metas, $metas);
    }

    public function forward404Unless($boolean) {
        if (!$boolean)
            show_404();
    }

    public function forward404If($boolean) {
        if ($boolean)
            show_404();
    }

    public function forwardToIf($to, $boolean) {
        if ($boolean)
            redirect($to);
    }

    public function forwardToUnless($to, $boolean) {
        if (!$boolean)
            redirect($to);
    }
}
