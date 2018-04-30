<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Form {

    private $ci;

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('form_validation');
        $this->ci->load->helper('security');

        # Reglas por defecto de validación
        $this->ci->form_validation->set_message('required', "El campo <strong>%s</strong> es obligatorio.");
        $this->ci->form_validation->set_message('exact_length', "El campo <strong>%s</strong> debe tener <strong>%s</strong> caracteres.");
        $this->ci->form_validation->set_message('max_length', "El campo <strong>%s</strong> no puede exceder de <strong>%s</strong> caracteres.");
        $this->ci->form_validation->set_message('exist', "El valor del campo <strong>%s</strong> no es válido.");
        $this->ci->form_validation->set_message('is_natural', "El valor del campo <strong>%s</strong> debe ser un número natural.");
        $this->ci->form_validation->set_message('decimal', "El valor del campo <strong>%s</strong> no es un décimal válido. Formato 00.00 o 00,00");
        $this->ci->form_validation->set_message('is_cif', "El <strong>%s</strong> no es un CIF válido.");
        $this->ci->form_validation->set_message('is_nif', "El <strong>%s</strong> no es un NIF válido.");
        $this->ci->form_validation->set_message('is_vat', "El <strong>%s</strong> no es un número VAT válido.");
        $this->ci->form_validation->set_message('exact_length', "El campo <strong>%s</strong> no es válido.");
        $this->ci->form_validation->set_message('max_length', "El campo <strong>%s</strong> no puede exceder de <strong>%s</strong> caracteres.");
        $this->ci->form_validation->set_message('exist', "El valor del campo <strong>%s</strong> no es válido.");
        $this->ci->form_validation->set_message('min_length', "El campo <strong>%s</strong> debe contener más de <strong>%s</strong> caracteres.");
        $this->ci->form_validation->set_message('max_length', "El campo <strong>%s</strong> no puede contener más de <strong>%s</strong> caracteres.");
        $this->ci->form_validation->set_message('is_unique', "Ya existe un <strong>%s</strong> con ese valor, escoge uno diferente.");
        $this->ci->form_validation->set_message('is_unique_or_one', "El valor de <strong>%s</strong> ya existe, escoge uno diferente.");
        $this->ci->form_validation->set_message('valid_email', "El <strong>%s</strong> no parece un email válido.");
        $this->ci->form_validation->set_message('matches', "Los campos <strong>%s</strong> y <strong>%s</strong> no coinciden.");
        $this->ci->form_validation->set_message('is_datetime', "El valor del campo <strong>%s</strong> no tiene un formato de fecha válida. Formato: dd-mm-yyyy hh:ii");
        $this->ci->form_validation->set_message('is_date', "El valor del campo <strong>%s</strong> no tiene un formato de fecha válida. Formato: dd-mm-yyyy");
        $this->ci->form_validation->set_message('is_numeric', "El valor del campo <strong>%s</strong> no es de tipo numérico.");
        $this->ci->form_validation->set_message('min_date', "El valor del campo <strong>%s</strong> debe ser superior a la fecha <strong>%s</strong>");
        $this->ci->form_validation->set_message('max_date', "El valor del campo <strong>%s</strong> debe ser inferior a la fecha <strong>%s</strong>");
        $this->ci->form_validation->set_message('min_datetime', "El valor del campo <strong>%s</strong> debe ser superior a la fecha <strong>%s</strong>");
        $this->ci->form_validation->set_message('max_datetime', "El valor del campo <strong>%s</strong> debe ser inferior a la fecha <strong>%s</strong>");
        $this->ci->form_validation->set_message('not_null', "El campo <strong>%s</strong> debe ser rellenado");
        $this->ci->form_validation->set_message('checkLogin', "El usuario o la contraseña son incorrectos.");
    }

    public function validate__Form($result = true) {
        return $result;
    }

    # ==================================== #
    #         FORMULARIOS DE START         #
    # ==================================== #

    /**
     * valida el formulario al eliminar el cliente
     * @return array con errores si los hubiera
     */
    public function validateDeleteClientForm() {
        $this->ci->form_validation->set_data($this->ci->input->post(Clientes::class));
        $this->ci->form_validation->set_rules(Clientes::COLUMN_ID, 'id del cliente', 'required|trim|is_numeric|exists[' . Clientes::TABLE_NAME . '.' . Clientes::COLUMN_ID . ']');

        $this->ci->form_validation->run();

        $errors = [];
        foreach ($this->ci->form_validation->error_array() as $key => $value1) {
            $errors[Clientes::class . '[' . $key . ']'] = alert_html($value1);
        }

        return $errors;
    }

    /**
     * valida el formulario al editar el cliente
     * @return array con errores si los hubiera
     */
    public function validateEditClientForm() {
        $this->ci->form_validation->set_data($this->ci->input->post(Clientes::class));
        $this->ci->form_validation->set_rules(Clientes::COLUMN_ID, 'id del cliente', 'required|trim|is_numeric|exists[' . Clientes::TABLE_NAME . '.' . Clientes::COLUMN_ID . ']');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_NOMBRE, 'nombre', 'required|trim|min_length[3]|max_length[25]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_APELLIDOS, 'apellidos', 'required|trim|min_length[3]|max_length[65]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_DNI, 'dni', 'required|trim|exact_length[9]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_EMAIL, 'email', 'required|trim|min_length[3]|max_length[30]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_TELEFONO, 'telefono', 'required|min_length[9]|trim|max_length[20]');

        $this->ci->form_validation->run();

        $errors = [];
        foreach ($this->ci->form_validation->error_array() as $key => $value1) {
            $errors[Clientes::class . '[' . $key . ']'] = alert_html($value1);
        }

        return $errors;
    }

    /**
     * valida el formulario al crear el cliente
     * @return array con errores si los hubiera
     */
    public function validateCreateClientForm() {
        $this->ci->form_validation->set_data($this->ci->input->post(Clientes::class));
        $this->ci->form_validation->set_rules(Clientes::COLUMN_ID, 'id del cliente', 'trim|is_numeric|is_unique[' . Clientes::TABLE_NAME . '.' . Clientes::COLUMN_ID . ']');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_NOMBRE, 'nombre', 'required|trim|min_length[3]|max_length[25]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_APELLIDOS, 'apellidos', 'required|trim|min_length[3]|max_length[65]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_DNI, 'dni', 'required|trim|exact_length[9]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_EMAIL, 'email', 'required|trim|min_length[3]|max_length[30]');
        $this->ci->form_validation->set_rules(Clientes::COLUMN_TELEFONO, 'telefono', 'required|trim|min_length[9]|max_length[20]');

        $this->ci->form_validation->run();

        $errors = [];
        foreach ($this->ci->form_validation->error_array() as $key => $value1) {
            $errors[Clientes::class . '[' . $key . ']'] = alert_html($value1);
        }

        return $errors;
    }

    /**
     * valida una url dada por parametro url_products_json
     * @return bool true si es correcto, false si no lo es
     */
    public function validateURLForm() {
        $this->ci->form_validation->set_rules('url_products_json', 'url', 'required|trim|valid_url');

        return $this->ci->form_validation->run();
    }

    public function validateAssocClientProductsForm() {
        $this->ci->form_validation->set_data($this->ci->input->post(Clientes::class));
        $this->ci->form_validation->set_rules(Clientes::COLUMN_ID, 'id del cliente', 'required|trim|is_numeric|exists[' . Clientes::TABLE_NAME . '.' . Clientes::COLUMN_ID . ']');

        $this->ci->form_validation->run();

        $errors = [];
        foreach ($this->ci->form_validation->error_array() as $key => $value1) {
            $errors[Clientes::class . '[' . $key . ']'] = alert_html($value1);
        }

        $productos_ids = $this->ci->input->post('Products');

        foreach ($productos_ids as $id) {
            if ($this->ci->Products->countRows([Products::COLUMN_ID => $id]) == 0) {
                $errors['#formValidation'] = alert_html('El producto pasado con id ' . $id . ' no existe.');
            }
        }

        return $errors;
    }

}
