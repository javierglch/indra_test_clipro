<?php

if (!function_exists('include_http_metas')) {

    function include_http_metas() {
        $html = "";
        $aMetas = get_instance()->config->item(CFG_http_metas);
        foreach ($aMetas as $name => $content) {
            $html .= meta($name, $content);
        }
        return $html;
    }

}

if (!function_exists('include_metas')) {

    function include_metas() {
        $html = "";
        $aMetas = get_instance()->config->item(CFG_metas);
        foreach ($aMetas as $name => $content) {
            $html .= meta($name, $content);
        }
        return $html;
    }

}

if (!function_exists('include_metas_properties')) {

    function include_metas_properties() {
        $html = "";
        $aMetas = get_instance()->config->item(CFG_metas_properties);
        foreach ($aMetas as $name => $content) {
            $html .= meta($name, $content, 'property');
        }
        return $html;
    }

}

if (!function_exists('include_title')) {

    function include_title() {
        return '<title>' . get_instance()->config->item(CFG_title) . '</title>';
    }

}
if (!function_exists('include_stylesheets')) {

    function include_stylesheets() {
        return stylesheet_tag(get_instance()->config->item(CFG_stylesheets));
    }

}
if (!function_exists('stylesheet_tag')) {

    function stylesheet_tag(array $stylesheets) {
        $html = "";
        foreach ($stylesheets as $stylesheet) {
            $html .= '<link rel="stylesheet" type="text/css" media="screen" href="' . (!preg_match("/\/\//", $stylesheet) ? base_url('assets/css/' . $stylesheet) : $stylesheet) . '">';
        }
        return $html;
    }

}
if (!function_exists('include_javascripts')) {

    function include_javascripts() {
        return javascript_tag(get_instance()->config->item(CFG_javascripts));
    }

}
if (!function_exists('javascript_tag')) {

    function javascript_tag(array $javascripts) {
        $html = "";
        foreach ($javascripts as $javascript) {
            $html .= '<script type="text/javascript" src="' . (!preg_match("/\/\//", $javascript) ? base_url('assets/js/' . $javascript) : $javascript) . '"></script>';
        }
        return $html;
    }

}
if (!function_exists('include_view')) {

    function include_view($view, $params = []) {
        return get_instance()->load->view($view, $params, true);
    }

}
if (!function_exists('include_structure_data')) {

    function include_structure_data() {
        return '<script type="application/ld+json">' . get_instance()->structureddata . '</script>';
    }

}
if (!function_exists('superimg')) {

    /**
     * carga una imagen que se carga automaticamente responsiva
     * @param string $location after assets/images/[this route]
     * @param int $width default auto
     * @param array $aClasses clases a incluir, por ejemplo, img-fluid
     */
    function superimg($location, $width = 'auto', $height = 'auto', $aClasses = ['img-fluid']) {
        return '<img load-src="' . superimg_url($location, $width, $height) . '" class="' . implode(' ', $aClasses) . '">';
    }

}

if (!function_exists('superimg_url')) {

    /**
     * carga una imagen que se carga automaticamente responsiva
     * @param string $location after assets/images/[this route]
     * @param int $width default auto
     */
    function superimg_url($location, $width = 'auto', $height = 'auto') {
        return base_url('img?path=' . $location . '&width=' . $width . '&height=' . $height);
    }

}