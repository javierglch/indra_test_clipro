<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileUpload
 *
 * @author Javier
 */
class FileUpload {

    const DESTINY_IMAGES = '/images/';
    const DESTINY_UPLOADS = '/uploads/';

    /**
     * nombre del archivo
     * @var string 
     */
    public $name;
    /**
     * tipo del archivo, por ejemplo: image/png
     * @var string
     */
    public $type;
    /**
     * nombre del archivo temporal
     * @var string
     */
    private $tmp_name;
    /**
     * codigo de error en la subida
     * @var int
     */
    public $error;
    /**
     * tamaño del archivo en bits
     * @var int
     */
    public $size;

    /**
     * ruta y archivo subidos.
     * @var string
     */
    private $file_upload_path;
    
    /**
     * link externo hacia el archivo
     * @var string
     */
    private $uploaded_file_link;
    
    function __construct(array $aFileParams) {
        $this->name = $aFileParams["name"];
        $this->type = $aFileParams["type"];
        $this->tmp_name = $aFileParams["tmp_name"];
        $this->error = $aFileParams["error"];
        $this->size = $aFileParams["size"];
        $this->setTests();
    }

    /**
     * 
     * @param string $destination carepta destino, por ejemplo: /uploads
     * @param bool $doTests si se pone a true entonces se hacen los tests que estén 
     * almacenados ne la variable privada $this->tests. Si se pone a true, pero no 
     * se han añadido test, entonces no se hace nada.
     * @return bool
     * @throws Exception En caso de que no pase los tests (siendo este true) 
     * puede saltar una excepcepcion con el mensaje de error para controlar la subida de la imagen
     */
    function uploadFile($destination = self::DESTINY_UPLOADS, $doTests = true) {

        if ($doTests) {
            $this->doTests();
        }
        $this->file_upload_path=FCPATH.'assets'.$destination.$this->name;
        
        $this->uploaded_file_link = 'http://'.$_SERVER['HTTP_HOST'].'/assets'.$destination.$this->name;
        
        return move_uploaded_file($this->tmp_name, $this->file_upload_path);
        
    }

    function eraseUploadedFile(){
        if($this->file_upload_path!==null){
            unlink($this->file_upload_path);
        }
    }
    
    /**
     * Devuelve el path de fichero destino
     * @return string
     */
    public function getUploadLink(){
        return $this->uploaded_file_link;
    }
    
    ################ tests part  ################
    
    private $tests;

    #tests types
    const CHECK_IS_FILE_TYPE_PERMITED = 1;
    const CHECK_SIZE = 2;
    const CHECK_IMG_DIMENSIONS = 3;

    #test errors code
    const ERROR_IS_NOT_IMG_TYPE = 901;
    const ERROR_SIZE_OVERFLOW = 902;
    const ERROR_IMG_DIMENSIONS_OVERFLOW = 903;
    const ERROR_FILE_TYPE_FORBIDDEN = 904;
    
    
    #defaults
    static $FILE_TYPES_PERMITED = ['image/jpeg', 'image/jpg', 'image/png', 'image/ico', 'image/bmp', 'image/gif'];
    static $MAX_SIZE = 10000000; //10Mb
    static $MAX_WIDTH = 300;
    static $MIN_WIDTH = 200;
    static $MAX_HEIGHT = 300;
    static $MIN_HEIGHT = 200;

    /**
     * @param array $fileTypes
     */
    function setRequiredFileTypes(array $fileTypes){
        static::$FILE_TYPES_PERMITED=$fileTypes;
    }
    /**
     * @param int $size
     */
    function setRequiredSize($size){
        static::$MAX_SIZE=$size;
    }
    /**
     * @param int $width
     * @param int $height
     */
    function setRequiredDimensions($width,$height){
        static::$MAX_HEIGHT=$height;
        static::$MIN_HEIGHT=$height;
        static::$MAX_WIDTH=$width;
        static::$MIN_WIDTH=$width;
    }
    
    
    #doTests
    
    /**
     * Añade un test para comprobar a la hora de subir la imagen
     * Para cambiar los valores del test, hay que recurrir a las variables estaticas
     * @param int $testtype
     */
    function setTests(array $testtype = [self::CHECK_IS_FILE_TYPE_PERMITED, self::CHECK_SIZE, self::CHECK_IMG_DIMENSIONS]) {
        $this->tests = $testtype;
    }

    /**
     * realiza los tests añadidos en la variable a traves del emtodo setTests al archivo en cuestion
     */
    function doTests(){
        foreach ($this->tests as $testId){
            switch($testId){
                case self::CHECK_IS_FILE_TYPE_PERMITED:
                    $this->checkIsFileTypePermited();
                    break;
                case self::CHECK_SIZE:
                    $this->checkSize();
                    break;
                case self::CHECK_IMG_DIMENSIONS:
                    $this->checkImgDimensions();
                    break;
            }
        }
    }
    
    /**
     * Comprueba si es una imagen del tipo almacenada en la variable estatica $IMG_TYPES
     * @throws Exception en caso de que no sea
     */
    function checkIsFileTypePermited(){
        if (!in_array($this->type, static::$FILE_TYPES_PERMITED)) {
            throw new Exception('El archivo no es de un tipo permitido (' . implode(', ', static::$IMG_TYPES) . '). Tipo del archivo: '.$this->type, self::ERROR_FILE_TYPE_FORBIDDEN);
        }
    }
    
    /**
     * 
     * @throws Exception En caso de que no tenga el tamaño permitido
     */
    function checkSize(){
        if ($this->size > static::$MAX_SIZE) {
            throw new Exception('El tamaño del archivo es mayor al permitido (' . static::$MAX_SIZE . '). Tamaño del archivo: '.$this->size, self::ERROR_SIZE_OVERFLOW);
        }
    }
    /**
     * 
     * @throws Exception en caso de que las dimensiones no sean las permitidas
     */
    function checkImgDimensions(){
        $params = getimagesize($this->tmp_name);
        if(isset($params) && count($params)>0){
            $imgWidth=$params[0];
            $imgHeight=$params[1];

            if($imgWidth < static::$MIN_WIDTH || $imgWidth > static::$MAX_WIDTH || $imgHeight < static::$MIN_HEIGHT || $imgHeight > static::$MAX_HEIGHT){
                throw new Exception('El tamaño de la imagen no esta en los límites permitidos ( desde '.static::$MIN_WIDTH.'x'.static::$MIN_HEIGHT.' hasta '.static::$MAX_WIDTH.'x'.static::$MAX_HEIGHT.' ). Dimensiones del archivo: width='.$imgWidth.', height='.$imgHeight, self::ERROR_IMG_DIMENSIONS_OVERFLOW);
            }
        } else {
            throw new Exception('Imposible saber de las dimensiones de un archivo que no es una imagen.', self::ERROR_IS_NOT_IMG_TYPE);
        }
    }

}
