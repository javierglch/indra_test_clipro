<?php

##### CREACION DE LAS RUTAS DONDE SE VAN A GUARDAR LOS ARCHIVOS ######
$replaceModels = false; //poner a true para reemplazar todos los modelos
$models_path = '../../application/models/';
$base_models_path = '../../application/models/BaseModels/';
$database = 'indra_test';
$user = 'root';
$pass = '';

if (!is_dir($base_models_path)) {
    mkdir($base_models_path, 0755);
}

##### RECUPERACION DE LOS DATOS DE TABLA DESDE LA BASE DE DATOS ######
try {
    $PDO = new PDO('mysql:host=localhost;dbname='.$database, $user, $pass);
    if ($PDO->errorCode()) {
        echo 'Error: ' . $PDO->errorCode();
        exit;
    }
} catch (\Exception $e) {
    echo 'Error '.$e->getCode().' - '.$e->getMessage();
    die();
}
$aTableNames = $PDO->query('select * from information_schema.tables where TABLE_SCHEMA="'.$database.'";')->fetchAll();

//echo '<pre>'.print_r($aTableNames,true).'</pre>';

$aClassesInfo = [];

foreach ($aTableNames as $key => $tableInfo) {
    $className = tableToClassName($tableInfo['TABLE_NAME']);
    $aColumnsInfo = $PDO->query('SHOW FULL COLUMNS FROM ' . $tableInfo['TABLE_NAME'])->fetchAll();
    $aClassVars = [];
    foreach ($aColumnsInfo as $columnInfo) {
//        echo '<pre>'.print_r($columnInfo,true);
        array_push($aClassVars, $columnInfo);
    }
    $aClassesInfo[$className] = ["vars" => $aClassVars, "tableinfo" => $tableInfo];
}

//mostramos la información
//echo '<pre>' . print_r($aClassesInfo, true);
//hora de generar los archivos
#### CREACION DE LOS FICHEROS PARA LA BASE DE DATOS ####


$db_code_completion = "";
$aModelsNames = [];
foreach ($aClassesInfo as $class_name => $classInfo) {

    //comenzamos

    $TABLE_NAME = $classInfo["tableinfo"]["TABLE_NAME"];
    $VERSION = $classInfo["tableinfo"]["VERSION"];
    $CREATE_TIME = $classInfo["tableinfo"]["CREATE_TIME"];
    $UPDATE_TIME = $classInfo["tableinfo"]["UPDATE_TIME"];
    $TABLE_COMMENT = utf8_encode($classInfo["tableinfo"]["TABLE_COMMENT"]);

    $num_columns = count($classInfo["vars"]);

    $consts_definition = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $consts_definition .= '
    /** ' . utf8_encode($columnInfo['Comment']) . ' */ 
    const COLUMN_' . strtoupper($columnInfo['Field']) . '="' . $columnInfo['Field'] . '";
    ';
    }

    $vars_definition = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $vars_definition .= '
    /** ' . utf8_encode($columnInfo['Comment']) . ' @var ' . $columnInfo['Type'] . ' */ 
    public $' . $columnInfo['Field'] . ';
    ';
    }

    $construct_params_doc = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $construct_params_doc .= ' * @param $' . $columnInfo['Field'] . ' ' . $columnInfo['Type'] . ' ' . utf8_encode($columnInfo['Comment']) . '
    ';
    }
    $construct_params_doc .= ' * ';

    $aConstructParamsNames = [];
    foreach ($classInfo["vars"] as $columnInfo) {
        array_push($aConstructParamsNames, '$' . $columnInfo['Field'] . '=null');
    }
    $construct_params = implode(",", $aConstructParamsNames);

    $construct_body = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $construct_body .= '$this->' . $columnInfo['Field'] . ' = $' . $columnInfo['Field'] . ';
        ';
    }

    $construct_params_values = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $construct_params_values .= '$this->' . $columnInfo['Field'] . ' = $' . $columnInfo['Field'] . ';';
    }

    $aConstructParamsNames = [];
    foreach ($classInfo["vars"] as $columnInfo) {
        array_push($aConstructParamsNames, '$' . $columnInfo['Field']);
    }
    $construct_params_values = implode(", ", $aConstructParamsNames);


    $getters = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $getters .= '
    /**
     * Devuelve la variable ' . $columnInfo['Field'] . '<br>
     * Descripcion de la variable: ' . utf8_encode($columnInfo['Comment']) . '
     * @return ' . $columnInfo['Type'] . '
     */
    public function get' . ucfirst($columnInfo['Field']) . '(){
        return $this->' . $columnInfo['Field'] . ';
    }';
    }

    $setters = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $setters .= '
    /**
     * Pone el valor a la variable ' . $columnInfo['Field'] . '<br>
     * Descripcion de la variable: ' . utf8_encode($columnInfo['Comment']) . '
     * @param ' . $columnInfo['Type'] . ' $value
     */
    public function set' . ucfirst($columnInfo['Field']) . '($value){
        $this->' . $columnInfo['Field'] . '=$value;
    }';
    }

    $pk_key = "ID";

    $insert_aData = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $insert_aData .= '
            if (isset($this->' . $columnInfo['Field'] . ')) {
                $aData["' . $columnInfo['Field'] . '"] = $this->' . $columnInfo['Field'] . ';
            }
        ';
    }

    $update_aWithData = "";
    foreach ($classInfo["vars"] as $key => $columnInfo) {
        if ($key != 0) {
            $update_aWithData .= '
            if (isset($this->' . $columnInfo['Field'] . ')) {
                $aWithData["' . $columnInfo['Field'] . '"] = $this->' . $columnInfo['Field'] . ';
            }
            ';
        }
    }

    $delete_aWhereClause = "";
    foreach ($classInfo["vars"] as $columnInfo) {
        $delete_aWhereClause .= '
            if (isset($this->' . $columnInfo['Field'] . ')) {
                $aWhereClause["' . $columnInfo['Field'] . '"] = $this->' . $columnInfo['Field'] . ';
            }
        ';
    }


    //RESUMEN DE LA CONFIGURACION Y CREACION DE FICHEROS

    $model_base_file_name = $class_name . "Base.php";
    $config_model_base = [
        "<@class_name_base>" => $class_name . "Base",
        "<@class_name>" => $class_name,
        "<@TABLE_NAME>" => $TABLE_NAME,
        "<@VERSION>" => $VERSION,
        "<@CREATE_TIME>" => $CREATE_TIME,
        "<@UPDATE_TIME>" => $UPDATE_TIME,
        "<@TABLE_COMMENT>" => $TABLE_COMMENT,
        "<@num_columns>" => $num_columns,
        "<@consts_definition>" => $consts_definition,
        "<@vars_definition>" => $vars_definition,
        "<@construct_params_doc>" => $construct_params_doc,
        "<@construct_params>" => $construct_params,
        "<@construct_body>" => $construct_body,
        "<@getters>" => $getters,
        "<@setters>" => $setters,
        "<@pk_key>" => $pk_key,
        "<@insert_aData>" => $insert_aData,
        "<@update_aWithData>" => $update_aWithData,
        "<@delete_aWhereClause>" => $delete_aWhereClause,
    ];
    $contents = file_get_contents("./template_ModelBase.php");
    foreach ($config_model_base as $key => $value) {
        $contents = str_replace($key, $value, $contents);
    }
    file_put_contents($base_models_path . $model_base_file_name, $contents);
    echo '<li>Creando el archivo ' . $base_models_path . $model_base_file_name . '</li>';


    $model_file_name = $class_name . ".php";
    $config_model = [
        "<@class_name>" => $class_name,
        "<@TABLE_NAME>" => $TABLE_NAME,
        "<@VERSION>" => $VERSION,
        "<@CREATE_TIME>" => $CREATE_TIME,
        "<@UPDATE_TIME>" => $UPDATE_TIME,
        "<@TABLE_COMMENT>" => $TABLE_COMMENT,
        "<@num_columns>" => $num_columns,
        "<@construct_params_doc>" => $construct_params_doc,
        "<@construct_params>" => $construct_params,
        "<@construct_params_values>" => $construct_params_values
    ];
    $contents = file_get_contents("./template_Model.php");
    foreach ($config_model as $key => $value) {
        $contents = str_replace($key, $value, $contents);
    }
    if (!file_exists($models_path . $model_file_name) || $replaceModels) {
        file_put_contents($models_path . $model_file_name, $contents);
        echo '<li>Creando el archivo ' . $models_path . $model_file_name . '</li>';
    }

    $db_code_completion .= '
 * @property ' . $class_name . ' $' . $class_name . ' Model for table ' . $TABLE_NAME . ' in database. ';

    array_push($aModelsNames, $class_name);
}

$contents = file_get_contents("./template_codeCompletion.php");
$contents = str_replace("<@db_code_completion>", $db_code_completion, $contents);
file_put_contents($models_path . "db_code_completion.php", $contents);

echo '<p>Insertar en autoload: "' . implode("\", \"", $aModelsNames) . '"</p>';





#### FUNCIONES ####

function tableToClassName($name) {
    $split = explode("_", $name);
    $finalName = "";
    foreach ($split as $str) {
        $finalName .= ucfirst($str);
    }
    return $finalName;
}
