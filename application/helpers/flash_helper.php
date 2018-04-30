<?php

if (!function_exists("flash_message")) {

    /**
     * Crea la estrucutra html para un alert de tipo bootstrap
     * @param string $type key del mensaje flash
     */
    function flash_message($type) {
        $ci = & get_instance();
        if ($ci->session->flashdata($type)) {
            echo '<div class="alert ' . $type . '">';
            echo '<button class="close" data-dismiss="alert" type="button">×</button>';
            echo $ci->session->flashdata($type);
            echo '</div>';
        }
    }

}

if (!function_exists("print_all_flash_messages")) {

    /**
     * Devuelve la estrucutra html para cada key de flash_session en formato de alertas bootstrap
     */
    function print_all_flash_messages($canClose = true) {
        $ci = & get_instance();
        $aFlashKeys = $ci->session->get_flash_keys();
        foreach ($aFlashKeys as $type) {
            if ($ci->session->flashdata($type)) {
                echo '<div class="alert ' . $type . '">';
                if ($canClose) {
                    echo '<button class="close" data-dismiss="alert" type="button">×</button>';
                }
                echo $ci->session->flashdata($type);
                echo '</div>';
            }
        }
    }

}


if (!function_exists("print_all_form_errors")) {

    /**
     * Devuelve la estrucutra html para cada key de flash_session en formato de alertas bootstrap
     */
    function print_all_form_errors() {
        $aFormErrors = get_instance()->session->flashdata('form-errors');
        $str = "";
        if (is_array($aFormErrors) && count($aFormErrors) > 0) {
            foreach ($aFormErrors as $campo => $msg) {
                $str.= alert_html($msg);
            }
        }
        return $str;
    }

}


if (!function_exists("alert_html")) {

    /**
     * crea un objeto de alerta bootstrap
     * @param string $text texto de la alerta
     * @param string success, info, warning, danger, default
     * @return string html
     */
    function alert_html($text, $type = 'danger') {
        $str = '';
        if (is_string($text)) {
            $str = '<div class="alert alert-' . $type . ' alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . $text . '</div>';
        } elseif (is_array($text)) {
            foreach ($text as $part) {
                $str .= '<div class="alert alert-' . $type . ' alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>' . $part . '</div>';
            }
        }
        return $str;
    }

}

