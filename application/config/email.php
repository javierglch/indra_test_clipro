<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| EMAIL
| -------------------------------------------------------------------
| This file contains the configuration of emails for the web app
|
| Please see user guide for more info:
| https://www.codeigniter.com/user_guide/libraries/email.html
|
*/

/*	
 * DefaultValue: CodeIgniter
 * Options: None 	
 * Description: The “user agent”.
 */
#$config["email"]["useragent"]="";


/*	
 * DefaultValue: mail 	
 * Options: mail, sendmail, or smtp 	
 * Description: The mail sending protocol.
 */
#$config["email"]["protocol"]=""; 


/* 	
 * DefaultValue: /usr/sbin/sendmail 	
 * Options: None 	
 * Description: The server path to Sendmail.
 */
#$config["email"]["mailpath"]=""; 


/* 	
 * DefaultValue: No Default 	
 * Options: None 	
 * Description: SMTP Server Address.
 */
#$config["email"]["smtp_host"]=""; 


/* 	
 * DefaultValue: No Default 	
 * Options: None 	
 * Description: SMTP Username.
 */
#$config["email"]["smtp_user"]=""; 


/* 	
 * DefaultValue: No Default 	
 * Options: None 	
 * Description: SMTP Password.
 */
#$config["email"]["smtp_pass"]="";


 /* 	
  * DefaultValue: 25 	
  * Options: None 	
  * Description: SMTP Port.
  */
#$config["email"]["smtp_port"]="";


/* 	
 * DefaultValue: 5 	
 * Options: None 	
 * Description: SMTP Timeout (in seconds).
 */
#$config["email"]["smtp_timeout"]=""; 


/* 	
 * DefaultValue: FALSE 	
 * Options: TRUE or FALSE (boolean) 	
 * Description: Enable persistent SMTP connections.
 */
#$config["email"]["smtp_keepalive"]="";


/* 	
 * DefaultValue: No Default 	
 * Options: tls or ssl 	
 * Description: SMTP Encryption
 */
#$config["email"]["smtp_crypto"]="";


/* 	
 * DefaultValue: TRUE 	
 * Options: TRUE or FALSE (boolean) 	
 * Description: Enable word-wrap.
 */
#$config["email"]["wordwrap"]=FALSE; 


/* 	
 * DefaultValue: 76 
 * Options: None	  	
 * Description: Character count to wrap at.
 */
#$config["email"]["wrapchars"]="";


/* 	
 * DefaultValue: text 	
 * text or html 	
 * Description: Type of mail. If you send HTML email you must send it as a complete web page. 
 *              Make sure you don’t have any relative links or relative image paths otherwise they will not work.
 */
$config["email"]["mailtype"]="html";


/* 	
 * DefaultValue: $config['charset'] 
 * Options: No info	  	
 * Description: Character set (utf-8, iso-8859-1, etc.).
 */
$config["email"]["charset"]="utf-8"; 


/* 	
 * DefaultValue: FALSE 	
 * Options: TRUE or FALSE (boolean) 	
 * Description: Whether to validate the email address.
 */
#$config["email"]["validate"]=""; 


/* 	
 * DefaultValue: 3 	
 * Options: 1, 2, 3, 4, 5 	
 * Description: Email Priority. 1 = highest. 5 = lowest. 3 = normal.
 */
#$config["email"]["priority"]=""; 


/* 	
 * DefaultValue: \n 	
 * Options: “\r\n” or “\n” or “\r” 
 * Description: Newline character. (Use “\r\n” to comply with RFC 822).
 */
#$config["email"]["crlf"]=""; 


/* 	
 * DefaultValue: \n 	
 * Options: “\r\n” or “\n” or “\r” 
 * Description: Newline character. (Use “\r\n” to comply with RFC 822).
 */
#$config["email"]["newline"]=""; 


/* 	
 * DefaultValue: FALSE 	
 * Options: TRUE or FALSE (boolean) 	
 * Description: Enable BCC Batch Mode.
 */
#$config["email"]["bcc_batch_mode"]=""; 


/* 	
 * DefaultValue: 200 	
 * Options: None 	
 * Description: Number of emails in each BCC batch.
 */
#$config["email"]["bcc_batch_size"]=""; 


/* 	
 * DefaultValue: FALSE 	
 * Options: TRUE or FALSE (boolean) 	
 * Description: Enable notify message from server
 */
#$config["email"]["dsn"]="";  