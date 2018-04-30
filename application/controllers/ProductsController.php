<?php

/**
 * ProductsController
 *
 * @author Javier javiergordoweb.es
 */
class ProductsController extends MY_Controller {
    // <editor-fold defaultstate="collapsed" desc="FormActions">

    /**
     * Actualiza la base de datos con los productos.
     * @route update-produts-list-action
     */
    function updateProductsListAction() {
        if (!$this->form->validateURLForm()) {
            $this->usersession->setFlash('alert-danger', 'La url proporcionada no es válida.');
            redirect($this->uri->uri_string());
        }

        $result = $this->Products->updateFromURL($this->input->post('url_products_json'));

        if ($result['update'] > 0) {
            $this->usersession->setFlash('alert-success', 'Se han actualizado ' . $result['update'] . ' prodcutos.');
        }
        if ($result['insert'] > 0) {
            $this->usersession->setFlash('alert-success', 'Se han insertado ' . $result['insert'] . ' nuevos productos.');
        }
        if ($result['errors'] > 0) {
            $this->usersession->setFlash('alert-danger', 'Ha habido ' . $result['errors'] . ' erorres en la ejecución, consultar el log de la aplicación para más información de los productos con errores.');
        }
        redirect('/');
    }

    // </editor-fold>
}
