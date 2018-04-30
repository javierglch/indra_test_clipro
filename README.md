El proyecto esta configurado para abrirse con un servidor apache, con mysql 5.7 y php 7.0.

Lo primero es instalar la base de datos, se encontrará en el archivo db_dump.sql, simplemente realizar la importación sobre mysql para instalarla. La base de datos se creará automáticamente y se llamará indra_test.

Despues hay que configurar el hosting virtual en apache, para ello vamos a C:\xampp\apache\conf\extra\httpd-vhosts.conf

Y escribimos:

<VirtualHost 127.0.0.1:80>
	DocumentRoot "[RUTA-AL-ROOT-DOCUMENT]"
	ServerName indratest.com.localhost
	ServerAlias indratest.com.localhost
</VirtualHost>

Luego vamos al archivo host: C:\Windows\System32\drivers\etc\hosts

Y escribimos:

127.0.0.1 		indratest.com.localhost

Reiniciamos nuestro servidor apache. y accedemos a la url: http://indratest.com.localhost/

Debería funcionar sin mayor problemas.

La aplicación está basada en el un framework MVC Codeigniter 3.1 con algunas ampliaciones para mejorar procesos, como la creación de los modelos de la base de datos.

Para más información sobre el framework se puede consultar https://codeigniter.com/user_guide/
