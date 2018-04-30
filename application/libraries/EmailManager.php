<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailHelper
 *
 * @author Javier
 */
class EmailManager {

    /**
     * si esta habilitado enviara los emails, sino no.
     * @var bool
     */
    private $boolSendEnabled;

    /**
     *
     * @var CI_Controller 
     */
    private $ci;

    /**
     * email de quien envia el mensaje
     * @var string 
     */
    private $from;

    /**
     * nombre de la persona que dirije el mensaje
     * @var string 
     */
    private $name;

    /**
     * clave unica para identificar el correo
     * @var string 
     */
    private $uuid;

    /**
     * Parametros de campaña para google analytics
     * @var array 
     */
    private $campaing_params;

    /**
     * hacia quien va dirigido el mensaje
     * @var string 
     */
    private $to;

    /**
     * asunto del mensaje
     * @var string 
     */
    public $subject;

    /**
     * contenido del correo (va dentro del layout)
     * @var string 
     */
    private $innerContent;

    /**
     * contenido del correo (con el layout inlcuido), se construye una vez que se ejecuta el prepare
     * @var string 
     */
    private $message;

    /**
     * Template usada para generar el correo
     * @var string 
     */
    private $email_template;

    /**
     * parametros pasados a la template
     * @var array 
     */
    private $template_params;

    /**
     * layout
     * @var string 
     */
    private $layout;
    
    function __construct($to = '', $subject = '', $innerContent = '') {
        $this->ci = & get_instance();

        $this->boolSendEnabled = $this->ci->config->item(CFG_mailing)['enabled'];

        //inicializaciones
        $this->ci->load->library('email');
        $this->ci->load->config('email');
        $this->ci->email->initialize($this->ci->config->item('email'));
        $this->layout='default_layout';
        
        //headers
        $this->from = $this->ci->config->item(CFG_mailing)['from'];
        $this->name = $this->ci->config->item(CFG_mailing)['your_name'];
        $this->to = $to;

        //content
        $this->subject = $subject;
        $this->innerContent = $innerContent;
    }

    public function setLayout($layout){
        $this->layout=$layout;
    }
    
    /**
     * prepara el correo electronico para ser enviado construyendo la vista y añadiendo 
     * todos los parametros al helper 'email' de codeigniter
     */
    private function prepare() {

        //construct headers
        $this->ci->email->from($this->from, $this->name, $this->from);
        $this->ci->email->reply_to($this->from, $this->name);
        $this->ci->email->to($this->to);
        $this->uuid = uniqid();

        //content
        $this->ci->email->subject($this->subject);

        $this->innerContent = $this->ci->load->view('emails/templates/' . $this->email_template, $this->template_params, true);

        $this->message = $this->ci->load->view('emails/'.$this->layout, [
            "name" => $this->name,
            "from" => $this->from,
            "to" => $this->to,
            "subject" => $this->subject,
            "innerContent" => $this->innerContent,
            'uuid' => $this->uuid,
            'campaing_params' => $this->campaing_params
                ], true);
        $this->ci->email->message($this->message);
    }

    /**
     * El envio de emails debe de estar habilitado, consultar la configuracion de la app
     * Envia el correo electronico y lo inserta en la base de datos
     * @return bool true si el correo fue enviado o false si no
     */
    public function send() {
        if ($this->boolSendEnabled) {
            //construimos y enviamos
            $this->prepare();
            $this->saveInDatabase();
            return $this->ci->email->send();
        }
    }

    private function saveInDatabase() {
        $this->ci->EmailsHistory->insert([
            EmailsHistory::COLUMN_ID => null,
            EmailsHistory::COLUMN_UUID => $this->uuid,
            EmailsHistory::COLUMN_TO => $this->to,
            EmailsHistory::COLUMN_SUBJECT => $this->subject,
            EmailsHistory::COLUMN_EMAIL_TEMPLATE => $this->email_template,
            EmailsHistory::COLUMN_JSON_TEMPLATE_PARAMS => json_encode($this->template_params),
            EmailsHistory::COLUMN_CREATIONDATE => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * @param string $uuid clave unica en formato string de la base de datos
     * @return EmailsHistory
     */
    public function constructFromDatabase($uuid) {
        $oEmailsHistory = new EmailsHistory();

        $oEmailsHistory = $this->ci->EmailsHistory->findOneBy([
            EmailsHistory::COLUMN_UUID => $uuid
        ]);

        $this->email_template = $oEmailsHistory->get('email_template');
        $this->template_params = json_decode($oEmailsHistory->get('json_template_params'), true);
        $this->to = $oEmailsHistory->get('to');
        $this->subject = $oEmailsHistory->get('subject');

        return $this;
    }

    public function __toString() {
        $this->innerContent = $this->ci->load->view('emails/templates/' . $this->email_template, $this->template_params, true);
        $this->message = $this->ci->load->view('emails/'.$this->layout, [
            "name" => $this->name,
            "from" => $this->from,
            "to" => $this->to,
            "subject" => $this->subject,
            "innerContent" => $this->innerContent,
            'uuid' => '',
            'campaing_params' => []
                ], true);
        return $this->message;
    }

    # ---------------------------------------------- #
    # CONTROLADORES PARA LOS CORREOS Y SU CONTENIDO  #
    # Añadir aquí las funciones para generar correos #
    # ---------------------------------------------- #

    /**
     * Metodo por defecto para crear y enviar emails. <br>
     * Crea el email con la plantilla seleccionada y lo envia automaticamente
     * @param string $toEmail email de destino
     * @param string $subject asunto del email
     * @param string $template plantilla del email para construirla ( o vista del email, se guarda en emails/...)
     * @param array $aDataForTemplate este array se le pasa a la plantilla, así que debe de contener las variables de la plantilla. El formato del array debe de ser un array de arrays, no puede contener objetos!
     * @param array $campaing_params parametros de campaña en formato array para google analytics más info sobre parametros en: https://ga-dev-tools.appspot.com/campaign-url-builder/
     * @return bool true si lo envio, false si no.
     */
    public function sendMailTo($toEmail, $subject, $template = self::TEMPLATE_DEFAULT, $aDataForTemplate = [], $campaing_params = []) {
        $this->to = $toEmail;
        $this->subject = $subject;
        $this->email_template = $template;
        $this->template_params = $aDataForTemplate;
        $this->campaing_params = $campaing_params;
        return $this->send();
    }

    /**
     * Metodo para testear la creacion de emails y su plantilla para su edicion
     * @param string $toEmail email de destino
     * @param string $subject asunto del email
     * @param string $template plantilla del email para construirla ( o vista del email, se guarda en emails/...)
     * @param array $aDataForTemplate este array se le pasa a la plantilla, así que debe de contener las variables de la plantilla
     * @param bool $boolSend true y el email se envia al destion, false y no. default: false.
     * @return si $boolSend==true, bool true si lo envio, false si no. en caso de que sea false, devuelve la misma instancia del objeto ($this)
     */
    public function test($toEmail = 'ejemplo@dominio.com', $subject = 'TEST', $template = 'test', $aDataForTemplate = ['test_content' => 'contenido'], $campaing_params = [], $boolSend = false) {
        $this->to = $toEmail;
        $this->subject = $subject;
        $this->template_params = $aDataForTemplate;
        $this->email_template = $template;
        if ($boolSend) {
            return $this->send();
        }
        return $this;
    }

    public function installTableInDataBase() {
        $query = "CREATE TABLE `EmailsHistory` (
            `ID` int(11) NOT NULL AUTO_INCREMENT,
            `uuid` varchar(36) NOT NULL,
            `to` varchar(255) NOT NULL,
            `subject` varchar(255) NOT NULL,
            `email_template` varchar(100) NOT NULL,
            `json_template_params` text NOT NULL,
            `creationdate` datetime NOT NULL,
            `viewdate` datetime DEFAULT NULL,
            `viewcount` int(11) NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`,`uuid`),
            UNIQUE KEY `id_UNIQUE` (`id`)
          ) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;
          ";
        return get_instance()->db->query($query);
    }

}
