<?php

/**
 * errors actions.
 */
class ErrorsController extends MY_Controller {

    /**
     * pagina 404
     */
    public function executeError404() {
        $this->setDescription('404 not found - leagueof.hexania.com');
        $this->setKeywords('404 not found - leagueof.hexania.com');
        $this->output->set_status_header(404);
        $this->render_html('errors/error404_view');
    }

}
