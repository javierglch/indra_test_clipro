<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * [Clase generada automáticamente desde el script script_createClassModels.php]
 * 
 * Esta clase base es utilizada para el acceso a la base de datos y trae consigo
 * todas las funcionalidades genericas necesarias para ello.
 * 
 * NO MODIFIQUE ESTE ARCHIVO! Si desea agregar propiedades a la base de datos, 
 * hagalo en la clase del modelo, no en la base. La base es generada automaticamente.
 * 
 * Información sobre la tabla clientes_productos
 * - Versión: 10
 * - Fecha de creación: 2018-04-30 15:41:52
 * - Última modificación: 
 * - Comentario Asociacion de productos con los clientes<
 * - Numero de columnas: 3
 * 
 * @author Javier
 */
class ClientesProductosBase extends CI_Model {

    /**
     * Nombre de la tabla a la que hace referencia el modelo.
     */
    const TABLE_NAME = 'clientes_productos';

    ### ----------------------------------------------------------------------
    ### Listado de constantes para alojar el nombre de las columnas de la tabla 
    ### -----------------------------------------------------------------------
    
    /**  */ 
    const COLUMN_ID="ID";
    
    /** ID del cliente al que se le asocia el producto */ 
    const COLUMN_IDCLIENTE="IDCliente";
    
    /** id del producto asociado al cliente */ 
    const COLUMN_IDPRODUCTOS="IDProductos";
       
    
    
    ### -----------------------
    ### Listado de variables 
    ### ----------------------
    
    /**  @var int(11) */ 
    public $ID;
    
    /** ID del cliente al que se le asocia el producto @var int(11) */ 
    public $IDCliente;
    
    /** id del producto asociado al cliente @var int(11) */ 
    public $IDProductos;
        

    ### -----------------------

    
    
    ### -----------------------
    ### CONSTRUCTOR
    ### ----------------------

    /**
     * Constructor
     * @param $ID int(11) 
     * @param $IDCliente int(11) ID del cliente al que se le asocia el producto
     * @param $IDProductos int(11) id del producto asociado al cliente
     * 
     */
    function __construct($ID=null,$IDCliente=null,$IDProductos=null) {
        $this->ID = $ID;
        $this->IDCliente = $IDCliente;
        $this->IDProductos = $IDProductos;
        
    }

    ### -----------------------

    
    
    ### -----------------------
    ### GETTERS Y SETTERS Y TOSTRING
    ### ----------------------

    
    
    /**
     * Devuelve la variable ID<br>
     * Descripcion de la variable: 
     * @return int(11)
     */
    public function getID(){
        return $this->ID;
    }
    /**
     * Devuelve la variable IDCliente<br>
     * Descripcion de la variable: ID del cliente al que se le asocia el producto
     * @return int(11)
     */
    public function getIDCliente(){
        return $this->IDCliente;
    }
    /**
     * Devuelve la variable IDProductos<br>
     * Descripcion de la variable: id del producto asociado al cliente
     * @return int(11)
     */
    public function getIDProductos(){
        return $this->IDProductos;
    }

    
    /**
     * Pone el valor a la variable ID<br>
     * Descripcion de la variable: 
     * @param int(11) $value
     */
    public function setID($value){
        $this->ID=$value;
    }
    /**
     * Pone el valor a la variable IDCliente<br>
     * Descripcion de la variable: ID del cliente al que se le asocia el producto
     * @param int(11) $value
     */
    public function setIDCliente($value){
        $this->IDCliente=$value;
    }
    /**
     * Pone el valor a la variable IDProductos<br>
     * Descripcion de la variable: id del producto asociado al cliente
     * @param int(11) $value
     */
    public function setIDProductos($value){
        $this->IDProductos=$value;
    }

    function __toString() {
        return '<pre>' . print_r($this, true) . '</pre>';
    }

    ### -----------------------
    
    
    
    ### -----------------------
    ### Funciones genericas para el acceso a la base de datos 
    ### -----------------------

    /**
     * 
     * @param array $aVars <pre>array asociativo con los nombres de las variables y su valor, ejemplo:
     * $aVars = [
     * "nombreVariableDeLaClase" => "valor de la variable"
     * ]</pre>
     * @return ClientesProductos
     */
     public function constructFromArray($aVars) {
        $av = get_class_vars(self::class.'');
        foreach ($av as $v => $d) {
            $this->$v=null;
        }
        if(isset($aVars)){
            foreach ($aVars as $column => $value) {
                $this->$column = $value;
            }
        }
        return $this;
    }

    /**
     * 
     * @param array $aRows <pre>array de arrays, asociativo con los nombres de las variables y su valor, ejemplo:
     * $aRows = [
     * ["nombreVariableDeLaFila" => "valor de la variable", .. más columnas],
     * ["nombreVariableDeOtraFila" => "valor de la variable", .. más columnas],
     * ]</pre>
     * @return ClientesProductos array
     */
    public function constructObjsFromRows(array $aRows){
        $aResults = [];
        foreach ($aRows as $aRow) {
            $o = new ClientesProductos();
            $o->constructFromArray($aRow);
            $aResults[]=$o;
        }
        return $aResults;
    }
    
    ##SENTENCIAS SELECT##

    /**
     * Recupera la primera fila del registro teniendo en cuenta los valores dados
     * a las variables y creando automaticamente la clausula where.
     * @return ClientesProductos it returns a new object, but also it modified the own class
     */
    public function findOne() {
        $aWhereClause=[];
        
            if (isset($this->ID)) {
                $aWhereClause["ID"] = $this->ID;
            }
        
            if (isset($this->IDCliente)) {
                $aWhereClause["IDCliente"] = $this->IDCliente;
            }
        
            if (isset($this->IDProductos)) {
                $aWhereClause["IDProductos"] = $this->IDProductos;
            }
        
        $aResult = $this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME, 1)->row_array(0);
        $this->constructFromArray($aResult);
        $o = new ClientesProductos();
        $o->constructFromArray($aResult);
        return $o;
    }
    
    /**
     * Recupera una fila de los registros seleccionados por la clausula where<br>
     * Un ejemplo de consulta seria: select * from table limit 1
     * @param array $aWhereClause array asociativo para la clausula where, por ejemplo, si
     * escribimos ["id"=>5], se traduce en el select al estilo: select * from table where id=5 limit 1.
     * @return ClientesProductos it returns a new object, but also it modified the own class
     */
    public function findOneBy(array $aWhereClause) {
        $aResult = $this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME, 1)->row_array(0);
        $this->constructFromArray($aResult);
        $o = new ClientesProductos();
        $o->constructFromArray($aResult);
        return $o;
    }

    /**
     * Recupera una fila de los registros seleccionados por la clausula where<br>
     * Un ejemplo de consulta seria: select * from table limit 1
     * @param int $id id de la fila que queremos recuperar (en caso de ser diferente
     * al paremetro que se almacena en el objeto de la clase con la variable idclientes_productos
     * @return ClientesProductos
     */
    public function findOneById($id = null) {
        return $this->findOneBy(["ID" => ($id != null) ? $id : $this->ID]);
    }

   
    /**
     * Recupera la todas las filas teniendo en cuenta los valores dados
     * a las variables y creando automaticamente la clausula where.
     * @return ClientesProductos
     */
    public function find() {
        $aWhereClause=[];
        
            if (isset($this->ID)) {
                $aWhereClause["ID"] = $this->ID;
            }
        
            if (isset($this->IDCliente)) {
                $aWhereClause["IDCliente"] = $this->IDCliente;
            }
        
            if (isset($this->IDProductos)) {
                $aWhereClause["IDProductos"] = $this->IDProductos;
            }
        
        return $this->constructObjsFromRows($this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME)->result_array());
    }
    
    /**
     * Recupera todos los registros seleccionados por la clausula where<br>
     * Un ejemplo de consulta seria: select * from table.<br>
     * Además construye los objetos
     * @param array $aWhereClause array asociativo para la clausula where, por ejemplo, si
     * escribimos ["name"=>"juan"], se traduce en el select al estilo: select * from table name="juan"
     * @return ClientesProductos array con todos los objetos construidos a partir de las filas que devolvio la consulta
     */
    public function findBy(array $aWhereClause) {
        return $this->constructObjsFromRows($this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME)->result_array());
    }

    
    /**
     * Recupera todos los registros de la tabla
     * @return ClientesProductos array con todos los objetos construidos a partir de las filas que devolvio la consulta
     */
    public function selectAll($orderBy='ID ASC') {
        return $this->constructObjsFromRows($this->db->select('*')->order_by($orderBy)->get(self::TABLE_NAME)->result_array());
    }
    
    /**
     * Cuenta el nº de registros segun la condicion o todos los registros
     * @return int
     */
    public function countRows($where=[]) {
        return current($this->db->select('count(*) as c')->where($where)->get(self::TABLE_NAME)->row_array());
    }

    ##SENTENCIAS INSERT##

    /**
     * Inserta un registro en la base de datos. Si no se pasa parametro, se toma como valores
     * los valores que contienen las varaibles de la clase.
     * @param array $aData es el array con los valores que desean ser insertados, es importante
     * el nombrar la clave / key del array exactamente igual a la columna en la base de datos
     * @return bool TRUE on success, FALSE on failure
     */
    public function insert(array $aData = []) {
        if (count($aData) == 0) {
            
            if (isset($this->ID)) {
                $aData["ID"] = $this->ID;
            }
        
            if (isset($this->IDCliente)) {
                $aData["IDCliente"] = $this->IDCliente;
            }
        
            if (isset($this->IDProductos)) {
                $aData["IDProductos"] = $this->IDProductos;
            }
        
        }

        return $this->db->insert(self::TABLE_NAME, $aData);
    }

    /**
     * Inserta un registro en la base de datos en caso de que no exista.
     * <br>Si no se pasa parametro, se toma como valores
     * los valores que contienen las varaibles de la clase.
     * @param array $aData es el array con los valores que desean ser insertados, es importante
     * el nombrar la clave / key del array exactamente igual a la columna en la base de datos
     * @throws Exception En caso de que el valor ya exista, lanza una excepcion con codigo 10000
     * @return bool TRUE on success, FALSE on failure
     */
    public function insertUnique(array $aData = []) {
        if (count($aData) == 0) {
            
            if (isset($this->ID)) {
                $aData["ID"] = $this->ID;
            }
        
            if (isset($this->IDCliente)) {
                $aData["IDCliente"] = $this->IDCliente;
            }
        
            if (isset($this->IDProductos)) {
                $aData["IDProductos"] = $this->IDProductos;
            }
        
        }

        //comprobamos si el resgistro ya existe. En caso de existir pega un throw
        if ($this->db->select('count(*) as c')->where($aData)->get(self::TABLE_NAME)->first_row()->c > 0) {
            throw new Exception('No se puede insertar el registro porque ya existe.',10000);
        }
        //si no se ha producido el throw entonces, lo insertamos.
        return $this->db->insert(self::TABLE_NAME, $aData);
    }

    ##SENTENCIAS UPDATE##

    /**
     * Actualiza la base de datos con los valores pasados.<br>
     * Si la clausula hwere esta vacia o nula, se actualizan todos los registros de la tabla
     * @param array $aWithData dato que se desea actualizar, la key del array debe ser igual
     * a la columna que se quiere actualizar.
     * @param array $aWhereClause clausula where, key=>valor
     * @return bool TRUE on success, FALSE on failure
     */
    public function update(array $aWithData = [], $aWhereClause = null) {
        if (count($aWithData) == 0) {
            
            if (isset($this->IDCliente)) {
                $aWithData["IDCliente"] = $this->IDCliente;
            }
            
            if (isset($this->IDProductos)) {
                $aWithData["IDProductos"] = $this->IDProductos;
            }
            
        }
        if ($aWhereClause == null) {
            $aWhereClause["ID"] = $this->ID;
        }
        return $this->db->update(self::TABLE_NAME, $aWithData, $aWhereClause);
    }

    /**
     * Actualiza explicitamente todos los registros con los datos pasados a traves del parametro $aWithData
     * @param array $aWithData son los parametros a actualizar junto con sus valores
     * @return bool TRUE on success, FALSE on failure
     */
    public function updateAll(array $aWithData = []) {
        if (count($aWithData) == 0) {
            
            if (isset($this->IDCliente)) {
                $aWithData["IDCliente"] = $this->IDCliente;
            }
            
            if (isset($this->IDProductos)) {
                $aWithData["IDProductos"] = $this->IDProductos;
            }
            
        }
        return $this->db->update(self::TABLE_NAME, $aWithData);
    }

    ##SENTENCIAS DELETE##

    /**
     * Elimina las filas de la base de datos que cumplan la condicion pasada en $aWhereClause,
     * recuerda que las claves del array deben ser iguales a las columnas en la tabla.
     * @param array $aWhereClause 
     * @return bool TRUE on success, FALSE on failure
     */
    public function delete(array $aWhereClause = null) {
        if ($aWhereClause == null) {
            
            if (isset($this->ID)) {
                $aWhereClause["ID"] = $this->ID;
            }
        
            if (isset($this->IDCliente)) {
                $aWhereClause["IDCliente"] = $this->IDCliente;
            }
        
            if (isset($this->IDProductos)) {
                $aWhereClause["IDProductos"] = $this->IDProductos;
            }
        
        }
        return $this->db->delete(self::TABLE_NAME, $aWhereClause);
    }

    /**
     * Elimina todos los registros de la tabla.<br>
     * delete from table;
     * @return bool TRUE on success, FALSE on failure
     */
    public function deleteAll() {
        return $this->db->delete(self::TABLE_NAME);
    }

    public function get($var){
        return $this->$var;
    }
    
    public function set($var,$value){
        $this->$var=$value;
    }
    
    public function save(){
        return $this->ID?$this->update():$this->insert();
    }
}
