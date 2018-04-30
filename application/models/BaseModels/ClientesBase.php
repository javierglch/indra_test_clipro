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
 * Información sobre la tabla clientes
 * - Versión: 10
 * - Fecha de creación: 2018-04-30 15:40:46
 * - Última modificación: 
 * - Comentario lista de los clientes<
 * - Numero de columnas: 7
 * 
 * @author Javier
 */
class ClientesBase extends CI_Model {

    /**
     * Nombre de la tabla a la que hace referencia el modelo.
     */
    const TABLE_NAME = 'clientes';

    ### ----------------------------------------------------------------------
    ### Listado de constantes para alojar el nombre de las columnas de la tabla 
    ### -----------------------------------------------------------------------
    
    /**  */ 
    const COLUMN_ID="ID";
    
    /** nombre del cliente */ 
    const COLUMN_NOMBRE="Nombre";
    
    /** apellidos del cliente */ 
    const COLUMN_APELLIDOS="Apellidos";
    
    /** nif del cliente */ 
    const COLUMN_DNI="DNI";
    
    /** direccion postal del cliente, incluye calle, numero, provincia, codigo postal (todo) */ 
    const COLUMN_DIRECCION="Direccion";
    
    /** email del cliente */ 
    const COLUMN_EMAIL="Email";
    
    /** telefono, por ejemplo +34 600 600 600. Puede contener espacios */ 
    const COLUMN_TELEFONO="Telefono";
       
    
    
    ### -----------------------
    ### Listado de variables 
    ### ----------------------
    
    /**  @var int(11) */ 
    public $ID;
    
    /** nombre del cliente @var varchar(25) */ 
    public $Nombre;
    
    /** apellidos del cliente @var varchar(65) */ 
    public $Apellidos;
    
    /** nif del cliente @var varchar(9) */ 
    public $DNI;
    
    /** direccion postal del cliente, incluye calle, numero, provincia, codigo postal (todo) @var varchar(200) */ 
    public $Direccion;
    
    /** email del cliente @var varchar(30) */ 
    public $Email;
    
    /** telefono, por ejemplo +34 600 600 600. Puede contener espacios @var varchar(20) */ 
    public $Telefono;
        

    ### -----------------------

    
    
    ### -----------------------
    ### CONSTRUCTOR
    ### ----------------------

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
    function __construct($ID=null,$Nombre=null,$Apellidos=null,$DNI=null,$Direccion=null,$Email=null,$Telefono=null) {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->DNI = $DNI;
        $this->Direccion = $Direccion;
        $this->Email = $Email;
        $this->Telefono = $Telefono;
        
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
     * Devuelve la variable Nombre<br>
     * Descripcion de la variable: nombre del cliente
     * @return varchar(25)
     */
    public function getNombre(){
        return $this->Nombre;
    }
    /**
     * Devuelve la variable Apellidos<br>
     * Descripcion de la variable: apellidos del cliente
     * @return varchar(65)
     */
    public function getApellidos(){
        return $this->Apellidos;
    }
    /**
     * Devuelve la variable DNI<br>
     * Descripcion de la variable: nif del cliente
     * @return varchar(9)
     */
    public function getDNI(){
        return $this->DNI;
    }
    /**
     * Devuelve la variable Direccion<br>
     * Descripcion de la variable: direccion postal del cliente, incluye calle, numero, provincia, codigo postal (todo)
     * @return varchar(200)
     */
    public function getDireccion(){
        return $this->Direccion;
    }
    /**
     * Devuelve la variable Email<br>
     * Descripcion de la variable: email del cliente
     * @return varchar(30)
     */
    public function getEmail(){
        return $this->Email;
    }
    /**
     * Devuelve la variable Telefono<br>
     * Descripcion de la variable: telefono, por ejemplo +34 600 600 600. Puede contener espacios
     * @return varchar(20)
     */
    public function getTelefono(){
        return $this->Telefono;
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
     * Pone el valor a la variable Nombre<br>
     * Descripcion de la variable: nombre del cliente
     * @param varchar(25) $value
     */
    public function setNombre($value){
        $this->Nombre=$value;
    }
    /**
     * Pone el valor a la variable Apellidos<br>
     * Descripcion de la variable: apellidos del cliente
     * @param varchar(65) $value
     */
    public function setApellidos($value){
        $this->Apellidos=$value;
    }
    /**
     * Pone el valor a la variable DNI<br>
     * Descripcion de la variable: nif del cliente
     * @param varchar(9) $value
     */
    public function setDNI($value){
        $this->DNI=$value;
    }
    /**
     * Pone el valor a la variable Direccion<br>
     * Descripcion de la variable: direccion postal del cliente, incluye calle, numero, provincia, codigo postal (todo)
     * @param varchar(200) $value
     */
    public function setDireccion($value){
        $this->Direccion=$value;
    }
    /**
     * Pone el valor a la variable Email<br>
     * Descripcion de la variable: email del cliente
     * @param varchar(30) $value
     */
    public function setEmail($value){
        $this->Email=$value;
    }
    /**
     * Pone el valor a la variable Telefono<br>
     * Descripcion de la variable: telefono, por ejemplo +34 600 600 600. Puede contener espacios
     * @param varchar(20) $value
     */
    public function setTelefono($value){
        $this->Telefono=$value;
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
     * @return Clientes
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
     * @return Clientes array
     */
    public function constructObjsFromRows(array $aRows){
        $aResults = [];
        foreach ($aRows as $aRow) {
            $o = new Clientes();
            $o->constructFromArray($aRow);
            $aResults[]=$o;
        }
        return $aResults;
    }
    
    ##SENTENCIAS SELECT##

    /**
     * Recupera la primera fila del registro teniendo en cuenta los valores dados
     * a las variables y creando automaticamente la clausula where.
     * @return Clientes it returns a new object, but also it modified the own class
     */
    public function findOne() {
        $aWhereClause=[];
        
            if (isset($this->ID)) {
                $aWhereClause["ID"] = $this->ID;
            }
        
            if (isset($this->Nombre)) {
                $aWhereClause["Nombre"] = $this->Nombre;
            }
        
            if (isset($this->Apellidos)) {
                $aWhereClause["Apellidos"] = $this->Apellidos;
            }
        
            if (isset($this->DNI)) {
                $aWhereClause["DNI"] = $this->DNI;
            }
        
            if (isset($this->Direccion)) {
                $aWhereClause["Direccion"] = $this->Direccion;
            }
        
            if (isset($this->Email)) {
                $aWhereClause["Email"] = $this->Email;
            }
        
            if (isset($this->Telefono)) {
                $aWhereClause["Telefono"] = $this->Telefono;
            }
        
        $aResult = $this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME, 1)->row_array(0);
        $this->constructFromArray($aResult);
        $o = new Clientes();
        $o->constructFromArray($aResult);
        return $o;
    }
    
    /**
     * Recupera una fila de los registros seleccionados por la clausula where<br>
     * Un ejemplo de consulta seria: select * from table limit 1
     * @param array $aWhereClause array asociativo para la clausula where, por ejemplo, si
     * escribimos ["id"=>5], se traduce en el select al estilo: select * from table where id=5 limit 1.
     * @return Clientes it returns a new object, but also it modified the own class
     */
    public function findOneBy(array $aWhereClause) {
        $aResult = $this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME, 1)->row_array(0);
        $this->constructFromArray($aResult);
        $o = new Clientes();
        $o->constructFromArray($aResult);
        return $o;
    }

    /**
     * Recupera una fila de los registros seleccionados por la clausula where<br>
     * Un ejemplo de consulta seria: select * from table limit 1
     * @param int $id id de la fila que queremos recuperar (en caso de ser diferente
     * al paremetro que se almacena en el objeto de la clase con la variable idclientes
     * @return Clientes
     */
    public function findOneById($id = null) {
        return $this->findOneBy(["ID" => ($id != null) ? $id : $this->ID]);
    }

   
    /**
     * Recupera la todas las filas teniendo en cuenta los valores dados
     * a las variables y creando automaticamente la clausula where.
     * @return Clientes
     */
    public function find() {
        $aWhereClause=[];
        
            if (isset($this->ID)) {
                $aWhereClause["ID"] = $this->ID;
            }
        
            if (isset($this->Nombre)) {
                $aWhereClause["Nombre"] = $this->Nombre;
            }
        
            if (isset($this->Apellidos)) {
                $aWhereClause["Apellidos"] = $this->Apellidos;
            }
        
            if (isset($this->DNI)) {
                $aWhereClause["DNI"] = $this->DNI;
            }
        
            if (isset($this->Direccion)) {
                $aWhereClause["Direccion"] = $this->Direccion;
            }
        
            if (isset($this->Email)) {
                $aWhereClause["Email"] = $this->Email;
            }
        
            if (isset($this->Telefono)) {
                $aWhereClause["Telefono"] = $this->Telefono;
            }
        
        return $this->constructObjsFromRows($this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME)->result_array());
    }
    
    /**
     * Recupera todos los registros seleccionados por la clausula where<br>
     * Un ejemplo de consulta seria: select * from table.<br>
     * Además construye los objetos
     * @param array $aWhereClause array asociativo para la clausula where, por ejemplo, si
     * escribimos ["name"=>"juan"], se traduce en el select al estilo: select * from table name="juan"
     * @return Clientes array con todos los objetos construidos a partir de las filas que devolvio la consulta
     */
    public function findBy(array $aWhereClause) {
        return $this->constructObjsFromRows($this->db->select('*')->where($aWhereClause)->get(self::TABLE_NAME)->result_array());
    }

    
    /**
     * Recupera todos los registros de la tabla
     * @return Clientes array con todos los objetos construidos a partir de las filas que devolvio la consulta
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
        
            if (isset($this->Nombre)) {
                $aData["Nombre"] = $this->Nombre;
            }
        
            if (isset($this->Apellidos)) {
                $aData["Apellidos"] = $this->Apellidos;
            }
        
            if (isset($this->DNI)) {
                $aData["DNI"] = $this->DNI;
            }
        
            if (isset($this->Direccion)) {
                $aData["Direccion"] = $this->Direccion;
            }
        
            if (isset($this->Email)) {
                $aData["Email"] = $this->Email;
            }
        
            if (isset($this->Telefono)) {
                $aData["Telefono"] = $this->Telefono;
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
        
            if (isset($this->Nombre)) {
                $aData["Nombre"] = $this->Nombre;
            }
        
            if (isset($this->Apellidos)) {
                $aData["Apellidos"] = $this->Apellidos;
            }
        
            if (isset($this->DNI)) {
                $aData["DNI"] = $this->DNI;
            }
        
            if (isset($this->Direccion)) {
                $aData["Direccion"] = $this->Direccion;
            }
        
            if (isset($this->Email)) {
                $aData["Email"] = $this->Email;
            }
        
            if (isset($this->Telefono)) {
                $aData["Telefono"] = $this->Telefono;
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
            
            if (isset($this->Nombre)) {
                $aWithData["Nombre"] = $this->Nombre;
            }
            
            if (isset($this->Apellidos)) {
                $aWithData["Apellidos"] = $this->Apellidos;
            }
            
            if (isset($this->DNI)) {
                $aWithData["DNI"] = $this->DNI;
            }
            
            if (isset($this->Direccion)) {
                $aWithData["Direccion"] = $this->Direccion;
            }
            
            if (isset($this->Email)) {
                $aWithData["Email"] = $this->Email;
            }
            
            if (isset($this->Telefono)) {
                $aWithData["Telefono"] = $this->Telefono;
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
            
            if (isset($this->Nombre)) {
                $aWithData["Nombre"] = $this->Nombre;
            }
            
            if (isset($this->Apellidos)) {
                $aWithData["Apellidos"] = $this->Apellidos;
            }
            
            if (isset($this->DNI)) {
                $aWithData["DNI"] = $this->DNI;
            }
            
            if (isset($this->Direccion)) {
                $aWithData["Direccion"] = $this->Direccion;
            }
            
            if (isset($this->Email)) {
                $aWithData["Email"] = $this->Email;
            }
            
            if (isset($this->Telefono)) {
                $aWithData["Telefono"] = $this->Telefono;
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
        
            if (isset($this->Nombre)) {
                $aWhereClause["Nombre"] = $this->Nombre;
            }
        
            if (isset($this->Apellidos)) {
                $aWhereClause["Apellidos"] = $this->Apellidos;
            }
        
            if (isset($this->DNI)) {
                $aWhereClause["DNI"] = $this->DNI;
            }
        
            if (isset($this->Direccion)) {
                $aWhereClause["Direccion"] = $this->Direccion;
            }
        
            if (isset($this->Email)) {
                $aWhereClause["Email"] = $this->Email;
            }
        
            if (isset($this->Telefono)) {
                $aWhereClause["Telefono"] = $this->Telefono;
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
