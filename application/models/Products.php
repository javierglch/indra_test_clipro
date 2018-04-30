<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'models/BaseModels/ProductsBase.php';

/**
 * [Clase generada automáticamente desde el script script_createClassModels.php]<br>
 * <br>
 * Puedes utiliar esta clase para añadir metodos y gestionar el modelo a tu antojo, en caso de
 * actualización, esta clase no sera eliminada (solo se crea automaticamente con el script en caso de no existir).<br>
 * 
 * Información sobre la tabla products
 * -Versión: 10
 * -Fecha de creación: 2018-04-30 15:37:29
 * -Última modificación: 
 * -Comentario lista de productos
 * -Numero de columnas: 4
 * 
 * @author Javier
 */
class Products extends ProductsBase {

    /**
     * Constructor
     * @param $ID int(11) id del la fila
     * @param $Codigo varchar(20) codigo del producto
     * @param $Nombre varchar(50) nombre del producto
     * @param $Descripcion varchar(255) descripción del producto
     * 
     */
    function __construct($ID = null, $Codigo = null, $Nombre = null, $Descripcion = null) {
        parent::__construct($ID, $Codigo, $Nombre, $Descripcion);
    }

    ## AÑADIR A PARTIR DE AQUÍ NUEVAS FUNCIONES

    /**
     * Actualiza el listado de productos en la base de datos por los proporcionados
     * en la url
     * @param string $url https://...
     * @throws Exception si la petición pdoruce un error.
     */
    public function updateFromURL($url) {
        $ch = curl_init();
        $headers = [
            'Accept: application/json',
            'Content-Type: application/json',
        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $productos = json_decode(curl_exec($ch), true);

        if (curl_errno($ch) > 0) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        if (!$productos || !is_array($productos) || count($row = current($productos)) != 3 || !isset($row['Nombre']) || !isset($row['Codigo']) || !isset($row['Descripcion'])) {
            throw new Exception('La respuesta devuelta no es correcta: <iframe src="' . $url . '"></iframe>', curl_errno($ch));
        }

        $aProductos = $this->constructObjsFromRows($productos);

        $result['update'] = 0;
        $result['insert'] = 0;
        $result['errors'] = 0;

        foreach ($aProductos as $oProduct) {
            $this->findOneBy([self::COLUMN_CODIGO => $oProduct->getCodigo()]);
            if ($this->getID() && $oProduct->update([self::COLUMN_ID => $this->getID()])) {
                $result['update'] ++;
                log_message('info', ' - Producto[' . $oProduct->getCodigo() . '] actualizado.');
            } elseif ($oProduct->insert()) {
                $result['insert'] ++;
                log_message('info', ' - Producto[' . $oProduct->getCodigo() . '] insertado.');
            } else {
                $result['errors'] ++;
                log_message('info', ' - Producto[' . $oProduct->getCodigo() . '] ERROR.');
            }
        }

        return $result;
    }

}
