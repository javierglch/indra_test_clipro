<?php

/**
 * Description of ModalWindowController
 *
 * @author Javier
 */
class ModalWindowController extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->usersession->setLanguage('es');
    }

    /**
     * Recupera la ventana modal según la configuración recibida.
     * @throws Exception
     */
    public function getModalView() {
        $this->db->cache_off();

        $modal_template = $this->input->get('modal_template');
        if (!$modal_template) {
            throw new Exception('Falta template para la ventana modal.', 503);
        }
        $modal_id = uniqid();
        $modal_params = [];
        if ($params_json = $this->input->get('params_json')) {
            $modal_params = json_decode($params_json, true);
            foreach ($modal_params as $class => $aVars) {
                if (class_exists($class)) { // aquí debería de haber un si implementa constructfromarray... entonces... 
                    $modal_params['o' . $class] = (new $class())->constructFromArray($aVars)->findOne();
                }
            }

            $modal_params['params'] = $modal_params;
        }
        $this->render_json(['modal_id' => $modal_id, 'html' => $this->load->view('modals/_layout_window_template', [
                'modal_id' => $modal_id,
                'title' => $this->input->get('modal_title'),
                'body' => $this->load->view($modal_template, $modal_params, true)
                    ], true)]);
    }

    
}
