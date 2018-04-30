<?php

/**
 * ClientsController
 *
 * @author Javier javiergordoweb.ess
 */
class ClientsController extends MY_Controller {
    // <editor-fold defaultstate="collapsed" desc="FormActions">

    /**
     * Elimina un cliente existente
     * @route delete-client-action
     */
    function deleteAction() {
        if (count($errors = $this->form->validateDeleteClientForm()) > 0) {
            return $this->render_json(['form_uuid' => $this->input->post('form_uuid'), 'errors' => $errors, 'csrf_token_name' => $this->security->get_csrf_token_name(), 'csrf_token_hash' => $this->security->get_csrf_hash()]);
        }

        $this->Clientes->constructFromArray($this->input->post(Clientes::class));

        if ($this->Clientes->delete()) {
            $this->usersession->setFlash('alert-success', 'Se ha eliminado el cliente correctamnete.');
        } else {
            $this->usersession->setFlash('alert-danger', 'Se ha producido una excepción desconocida, contacte con el adminsitrador.');
        }

        return $this->render_json(['form_uuid' => $this->input->post('form_uuid')]);
    }

    /**
     * Edita el cliente
     * @route edit-client-action
     */
    function editAction() {
        if (count($errors = $this->form->validateEditClientForm()) > 0) {
            return $this->render_json(['form_uuid' => $this->input->post('form_uuid'), 'errors' => $errors, 'csrf_token_name' => $this->security->get_csrf_token_name(), 'csrf_token_hash' => $this->security->get_csrf_hash()]);
        }

        $this->Clientes->constructFromArray($this->input->post(Clientes::class));

        if ($this->Clientes->update()) {
            $this->usersession->setFlash('alert-success', 'Se ha editado el cliente correctamnete.');
        } else {
            $this->usersession->setFlash('alert-danger', 'Se ha producido una excepción desconocida, contacte con el adminsitrador.');
        }

        return $this->render_json(['form_uuid' => $this->input->post('form_uuid')]);
    }

    /**
     * Crea un nuevo cliente
     * @route create-client-action
     */
    function createAction() {
        if (count($errors = $this->form->validateCreateClientForm()) > 0) {
            return $this->render_json(['form_uuid' => $this->input->post('form_uuid'), 'errors' => $errors, 'csrf_token_name' => $this->security->get_csrf_token_name(), 'csrf_token_hash' => $this->security->get_csrf_hash()]);
        }

        $this->Clientes->constructFromArray($this->input->post(Clientes::class));

        if ($this->Clientes->insert()) {
            $this->usersession->setFlash('alert-success', 'Se ha registrado el nuevo cliente correctamnete.');
        } else {
            $this->usersession->setFlash('alert-danger', 'Se ha producido una excepción desconocida, contacte con el adminsitrador.');
        }

        return $this->render_json(['form_uuid' => $this->input->post('form_uuid')]);
    }

    /**
     * Asocia los productos con un cliente
     * @route assoc-client-products-action
     */
    public function assocClientProductsAction() {
        if (count($errors = $this->form->validateAssocClientProductsForm()) > 0) {
            return $this->render_json(['form_uuid' => $this->input->post('form_uuid'), 'errors' => $errors, 'csrf_token_name' => $this->security->get_csrf_token_name(), 'csrf_token_hash' => $this->security->get_csrf_hash()]);
        }

        $this->Clientes->constructFromArray($this->input->post(Clientes::class));
        $this->Clientes->findOne();
        
        //eliminamos los productos que ya tiene asociados, para re-asociarlos todos
        $this->ClientesProductos->delete([ClientesProductos::COLUMN_IDCLIENTE => $this->Clientes->getID()]);


        $aProductosIds = $this->input->post('Products');

        //insertamos todos los productos asociados en la base de datos.
        foreach ($aProductosIds as $IDProducto) {
            $this->ClientesProductos->insert([
                ClientesProductos::COLUMN_IDCLIENTE => $this->Clientes->getID(),
                ClientesProductos::COLUMN_IDPRODUCTOS => $IDProducto
            ]);
        }

        $this->usersession->setFlash('alert-success', 'Se han añadido <strong>' . count($aProductosIds) . '</strong> productos a <strong>' . $this->Clientes->getNombre() . '</strong>');
        return $this->render_json(['form_uuid' => $this->input->post('form_uuid')]);
    }

    // </editor-fold>
}
