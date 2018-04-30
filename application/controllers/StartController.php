<?php

/**
 * Description of AdminController
 *
 * @author Javier
 */
class StartController extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->setTitle('IndraTest', true);
        $this->usersession->setLanguage('es');
    }

    public function indexView() {
        $this->setTitle('Bienvenido administrador');

        $aProducts = $this->Products->selectAll();
        $aClientes = $this->Clientes->selectAll();

        $this->addStylesheets(['https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css']);
        $this->addJavascripts(['pluggins/datatables.min.js', 'short-scripts/get-modal-window.js','web-scripts/custom.js']);
        $this->render_html('start/index_view',['aProducts' => $aProducts, 'aClientes' => $aClientes]);
    }

}
