<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'models/BaseModels/ClientesBase.php';

/**
 * [Clase generada automáticamente desde el script script_createClassModels.php]<br>
 * <br>
 * Puedes utiliar esta clase para añadir metodos y gestionar el modelo a tu antojo, en caso de
 * actualización, esta clase no sera eliminada (solo se crea automaticamente con el script en caso de no existir).<br>
 * 
 * Información sobre la tabla clientes
 * -Versión: 10
 * -Fecha de creación: 2018-04-30 15:40:46
 * -Última modificación: 
 * -Comentario lista de los clientes
 * -Numero de columnas: 7
 * 
 * @author Javier
 */
class Clientes extends ClientesBase {

    /**
     * Constructor
     * @param $ID int(11) 
     * @param $Nombre varchar(25) nombre del cliente
     * @param $Apellidos varchar(65) apellidos del cliente
     * @param $DNI varchar(9) nif del cliente
     * @param $Direccion varchar(200) direccion postal del cliente, incluye calle, numero, provincia, codigo postal (todo)
     * @param $Email varchar(30) email del cliente
     * @param $Telefono varchar(20) telefono, por ejemplo +34 600 600 600. Puede contener espacios
     * 
     */
    function __construct($ID = null, $Nombre = null, $Apellidos = null, $DNI = null, $Direccion = null, $Email = null, $Telefono = null) {
        parent::__construct($ID, $Nombre, $Apellidos, $DNI, $Direccion, $Email, $Telefono);
    }

    ## AÑADIR A PARTIR DE AQUÍ NUEVAS FUNCIONES

    /**
     * Cuenta si está asociado el producto al usuario
     * @param Products $oProduct
     */
    public function hasProductAssoc(Products $oProduct): bool {
        return (new ClientesProductos())->countRows([
                    ClientesProductos::COLUMN_IDCLIENTE => $this->getID(),
                    ClientesProductos::COLUMN_IDPRODUCTOS => $oProduct->getID()
                ]) > 0;
    }

}
