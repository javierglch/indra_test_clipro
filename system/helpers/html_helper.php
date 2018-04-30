<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter HTML Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/html_helper.html
 */
// ------------------------------------------------------------------------

if (!function_exists('heading')) {

    /**
     * Heading
     *
     * Generates an HTML heading tag.
     *
     * @param	string	content
     * @param	int	heading level
     * @param	string
     * @return	string
     */
    function heading($data = '', $h = '1', $attributes = '') {
        return '<h' . $h . _stringify_attributes($attributes) . '>' . $data . '</h' . $h . '>';
    }

}

// ------------------------------------------------------------------------

if (!function_exists('ul')) {

    /**
     * Unordered List
     *
     * Generates an HTML unordered list from an single or multi-dimensional array.
     *
     * @param	array
     * @param	mixed
     * @return	string
     */
    function ul($list, $attributes = '') {
        return _list('ul', $list, $attributes);
    }

}

// ------------------------------------------------------------------------

if (!function_exists('ol')) {

    /**
     * Ordered List
     *
     * Generates an HTML ordered list from an single or multi-dimensional array.
     *
     * @param	array
     * @param	mixed
     * @return	string
     */
    function ol($list, $attributes = '') {
        return _list('ol', $list, $attributes);
    }

}

// ------------------------------------------------------------------------

if (!function_exists('_list')) {

    /**
     * Generates the list
     *
     * Generates an HTML ordered list from an single or multi-dimensional array.
     *
     * @param	string
     * @param	mixed
     * @param	mixed
     * @param	int
     * @return	string
     */
    function _list($type = 'ul', $list = array(), $attributes = '', $depth = 0) {
        // If an array wasn't submitted there's nothing to do...
        if (!is_array($list)) {
            return $list;
        }

        // Set the indentation based on the depth
        $out = str_repeat(' ', $depth)
                // Write the opening list tag
                . '<' . $type . _stringify_attributes($attributes) . ">\n";


        // Cycle through the list elements.  If an array is
        // encountered we will recursively call _list()

        static $_last_list_item = '';
        foreach ($list as $key => $val) {
            $_last_list_item = $key;

            $out .= str_repeat(' ', $depth + 2) . '<li>';

            if (!is_array($val)) {
                $out .= $val;
            } else {
                $out .= $_last_list_item . "\n" . _list($type, $val, '', $depth + 4) . str_repeat(' ', $depth + 2);
            }

            $out .= "</li>\n";
        }

        // Set the indentation for the closing tag and apply it
        return $out . str_repeat(' ', $depth) . '</' . $type . ">\n";
    }

}

// ------------------------------------------------------------------------

if (!function_exists('img')) {

    /**
     * Image
     *
     * Generates an <img /> element
     *
     * @param	mixed
     * @param	bool
     * @param	mixed
     * @return	string
     */
    function img($src = '', $attributes = '', $boolIncludeSRCSET = false) {
        if (!is_array($src)) {
            $src = array('src' => 'assets/images/' . $src);
        }
        if ($boolIncludeSRCSET) {
            $srcset = create_responsive_images($src['src']);
            if ($srcset) {
                $src['srcset'] = implode(', ', $srcset['srcset']);
                $src['src'] = $srcset['src_default'];
            }
        }

        $img = '<img';

        foreach ($src as $k => $v) {
            if ($k === 'src' && !preg_match('#^(data:[a-z,;])|(([a-z]+:)?(?<!data:)//)#i', $v)) {
                $img .= ' src="' . get_instance()->config->slash_item('base_url') . $v . '"';
            } else {
                $img .= ' ' . $k . '="' . $v . '"';
            }
        }

        return $img . _stringify_attributes($attributes) . ' />';
    }

}

// ------------------------------------------------------------------------

if (!function_exists('smart_resize_image')) {

    /**
     * Hace el resize de la imagen para transformarla con las dimensiones especificadas
     * @param path $file archivo para hacer resize
     * @param path $file_dest archivo de destino sobre el que se guarda el resize
     * @param type $width ancho maximo
     * @param type $height altura maxima
     * @param type $proportional si quieres que se mantengan las proporciones ponlo a true, default:false
     * @param type $output puede ser 'file', 'browser' y 'return'
     * @param type $delete_original si deseas eliminar la imagen original
     * @param type $use_linux_commands si deseas eliminar la imagen original con un comando de linux
     * @return boolean
     */
    function smart_resize_image($file, $file_dest, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false) {

        if ($height <= 0 && $width <= 0)
            return false;
        # Setting defaults and meta
        $info = getimagesize($file);
        $image = '';
        $final_width = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;
        # Calculating proportionality
        if ($proportional) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);
            $final_width = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        }
        else {
            $final_width = ( $width <= 0 ) ? $width_old : $width;
            $final_height = ( $height <= 0 ) ? $height_old : $height;
        }
        # Loading image to memory according to type
        switch ($info[2]) {
            case IMAGETYPE_GIF: $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG: $image = imagecreatefrompng($file);
                break;
            default: return false;
        }


        # This is the resizing/resampling/transparency-preserving magic
        $image_resized = imagecreatetruecolor($final_width, $final_height);
        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $transparency = imagecolortransparent($image);
            if ($transparency >= 0) {
                $transparent_color = imagecolorsforindex($image, $trnprt_indx);
                $transparency = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                imagefill($image_resized, 0, 0, $transparency);
                imagecolortransparent($image_resized, $transparency);
            } elseif ($info[2] == IMAGETYPE_PNG) {
                imagealphablending($image_resized, false);
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
                imagefill($image_resized, 0, 0, $color);
                imagesavealpha($image_resized, true);
            }
        }
        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

        # Taking care of original, if needed
        if ($delete_original) {
            if ($use_linux_commands)
                exec('rm ' . $file);
            else
                @unlink($file);
        }
        # Preparing a method of providing result
        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = $file_dest;
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }

        # Writing image according to type to the output destination
        switch ($info[2]) {
            case IMAGETYPE_GIF: imagegif($image_resized, $output);
                break;
            case IMAGETYPE_JPEG: imagejpeg($image_resized, $output, 100);
                break;
            case IMAGETYPE_PNG: imagepng($image_resized, $output, 0);
                break;
            default: return false;
        }
        return true;
    }

}

// ------------------------------------------------------------------------

if (!function_exists('create_responsive_images')) {

    /**
     * Crea imagenes responsive para mobil y tablet partiendo del src de una imagen
     * Se ejecuta dinamicamente al ejecutar la funcion 'img' para cargar tags de imagenes
     * @param path $src
     * @return array or false
     */
    function create_responsive_images($src) {
        $file = FCPATH . $src;
        if (!file_exists($file)) {
            return false;
        }
        $dirname = pathinfo($file, PATHINFO_DIRNAME);
        $nombreArchivo = pathinfo($file, PATHINFO_FILENAME);
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        //hacemos los resizes:
        $info = getimagesize($file);
        $pixels = $info[0] * $info[1];
        if ($pixels > 122500 && !file_exists($dirname . '/' . $nombreArchivo . '-mobile.' . $ext)) {
            smart_resize_image($file, $dirname . '/' . $nombreArchivo . '-mobile.' . $ext, 350, 350, true, 'file', false, false);
        }
        if ($pixels > 562500 && !file_exists($dirname . '/' . $nombreArchivo . '-tablet.' . $ext)) {
            smart_resize_image($file, $dirname . '/' . $nombreArchivo . '-tablet.' . $ext, 750, 750, true, 'file', false, false);
        }

        $srcset['original'] = base_url($src) . ' 993w';
        $src_default = base_url($src);
        preg_match("/(.*)" . $nombreArchivo . "\." . $ext . "/", $src, $matches);
        $prefixpath = $matches[1];
        if (file_exists($dirname . '/' . $nombreArchivo . '-tablet.' . $ext)) {
            $srcset['tablet'] = base_url($prefixpath . $nombreArchivo . '-tablet.' . $ext) . ' 750w';
            $src_default = base_url($prefixpath . $nombreArchivo . '-tablet.' . $ext);
        }
        if (file_exists($dirname . '/' . $nombreArchivo . '-mobile.' . $ext)) {
            $srcset['mobile'] = $prefixpath . $nombreArchivo . '-mobile.' . $ext . ' 414w';
            $src_default = base_url($prefixpath . $nombreArchivo . '-mobile.' . $ext);
        }

        return ['srcset' => $srcset, 'src_default' => $src_default];
    }

}

// ------------------------------------------------------------------------

if (!function_exists('doctype')) {

    /**
     * Doctype
     *
     * Generates a page document type declaration
     *
     * Examples of valid options: html5, xhtml-11, xhtml-strict, xhtml-trans,
     * xhtml-frame, html4-strict, html4-trans, and html4-frame.
     * All values are saved in the doctypes config file.
     *
     * @param	string	type	The doctype to be generated
     * @return	string
     */
    function doctype($type = 'xhtml1-strict') {
        static $doctypes;

        if (!is_array($doctypes)) {
            if (file_exists(APPPATH . 'config/doctypes.php')) {
                include(APPPATH . 'config/doctypes.php');
            }

            if (file_exists(APPPATH . 'config/' . ENVIRONMENT . '/doctypes.php')) {
                include(APPPATH . 'config/' . ENVIRONMENT . '/doctypes.php');
            }

            if (empty($_doctypes) OR ! is_array($_doctypes)) {
                $doctypes = array();
                return FALSE;
            }

            $doctypes = $_doctypes;
        }

        return isset($doctypes[$type]) ? $doctypes[$type] : FALSE;
    }

}

// ------------------------------------------------------------------------

if (!function_exists('link_tag')) {

    /**
     * Link
     *
     * Generates link to a CSS file
     *
     * @param	mixed	stylesheet hrefs or an array
     * @param	string	rel
     * @param	string	type
     * @param	string	title
     * @param	string	media
     * @param	bool	should index_page be added to the css path
     * @return	string
     */
    function link_tag($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE) {
        $CI = & get_instance();
        $link = '<link ';

        if (is_array($href)) {
            foreach ($href as $k => $v) {
                if ($k === 'href' && !preg_match('#^([a-z]+:)?//#i', $v)) {
                    if ($index_page === TRUE) {
                        $link .= 'href="' . $CI->config->site_url($v) . '" ';
                    } else {
                        $link .= 'href="' . $CI->config->slash_item('base_url') . $v . '" ';
                    }
                } else {
                    $link .= $k . '="' . $v . '" ';
                }
            }
        } else {
            if (preg_match('#^([a-z]+:)?//#i', $href)) {
                $link .= 'href="' . $href . '" ';
            } elseif ($index_page === TRUE) {
                $link .= 'href="' . $CI->config->site_url($href) . '" ';
            } else {
                $link .= 'href="' . $CI->config->slash_item('base_url') . $href . '" ';
            }

            $link .= 'rel="' . $rel . '" type="' . $type . '" ';

            if ($media !== '') {
                $link .= 'media="' . $media . '" ';
            }

            if ($title !== '') {
                $link .= 'title="' . $title . '" ';
            }
        }

        return $link . "/>\n";
    }

}

// ------------------------------------------------------------------------

if (!function_exists('meta')) {

    /**
     * Generates meta tags from an array of key/values
     *
     * @param	array
     * @param	string
     * @param	string
     * @param	string
     * @return	string
     */
    function meta($name = '', $content = '', $type = 'name', $newline = "\n") {
        // Since we allow the data to be passes as a string, a simple array
        // or a multidimensional one, we need to do a little prepping.
        if (!is_array($name)) {
            $name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
        } elseif (isset($name['name'])) {
            // Turn single array into multidimensional
            $name = array($name);
        }

        $str = '';
        foreach ($name as $meta) {
            $type = isset($meta['type']) ? $meta['type'] : '';
            $name = isset($meta['name']) ? $meta['name'] : '';
            $content = isset($meta['content']) ? $meta['content'] : '';
            $newline = isset($meta['newline']) ? $meta['newline'] : "\n";

            $str .= '<meta ' . $type . '="' . $name . '" content="' . $content . '" />' . $newline;
        }

        return $str;
    }

}

// ------------------------------------------------------------------------

if (!function_exists('br')) {

    /**
     * Generates HTML BR tags based on number supplied
     *
     * @deprecated	3.0.0	Use str_repeat() instead
     * @param	int	$count	Number of times to repeat the tag
     * @return	string
     */
    function br($count = 1) {
        return str_repeat('<br />', $count);
    }

}

// ------------------------------------------------------------------------

if (!function_exists('nbs')) {

    /**
     * Generates non-breaking space entities based on number supplied
     *
     * @deprecated	3.0.0	Use str_repeat() instead
     * @param	int
     * @return	string
     */
    function nbs($num = 1) {
        return str_repeat('&nbsp;', $num);
    }

}
