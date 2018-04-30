<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'models/BaseModels/ClientesProductosBase.php';

/**
 * [Clase generada automáticamente desde el script script_createClassModels.php]<br>
 * <br>
 * Puedes utiliar esta clase para añadir metodos y gestionar el modelo a tu antojo, en caso de
 * actualización, esta clase no sera eliminada (solo se crea automaticamente con el script en caso de no existir).<br>
 * 
 * Información sobre la tabla clientes_productos
 * -Versión: 10
 * -Fecha de creación: 2018-04-30 15:41:52
 * -Última modificación: 
 * -Comentario Asociacion de productos con los clientes
 * -Numero de columnas: 3
 * 
 * @author Javier
 */
class ClientesProductos extends ClientesProductosBase {
    
    /**
     * Constructor
     * @param $ID int(11) 
     * @param $IDCliente int(11) ID del cliente al que se le asocia el producto
     * @param $IDProductos int(11) id del producto asociado al cliente
     * 
     */
    function __construct($ID=null,$IDCliente=null,$IDProductos=null) {
        parent::__construct($ID, $IDCliente, $IDProductos);
    }
    
    ## AÑADIR A PARTIR DE AQUÍ NUEVAS FUNCIONES
    

}
