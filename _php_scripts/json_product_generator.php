<?php

class Product {
    public $Nombre;
    public $Codigo;
    public $Descripcion;
    
    function __construct($Nombre, $Codigo, $Descripcion) {
        $this->Nombre = $Nombre;
        $this->Codigo = $Codigo;
        $this->Descripcion = $Descripcion;
    }

}

$aProducts[]=new Product(
        'Remington IPL6250 i-Light Essential - Depiladora de luz pulsada, tecnología Propulse, color blanco y negro',
        'B00T2XX7CO',
        'Rápido: resultados permanentes en 3 tratamientos. Seguro: clínicamente probado, aprobado por la FDA (Agencia de alimentos y medicamentos de EEUU), recomendado por dermatólogos. Efectivo: Tecnología ProPulse. Uso: Cuerpo. Unisex. Resultados: Permanentes. Pantalla un 50 % más amplia: 3cm². 5 niveles de intensidad. Sensor de piel integrado. Modo de disparo único y múltiple. Voltaje universal.Bombilla ilimitada: no se requiere reemplazo / ventana de aplicación 50% más ampl '
        );
$aProducts[]=new Product(
        'Gafas de protección contra láser, color rojo ',
        'B003E7T9MQ',
        'Par de gafas de protección ante láser. Un accesorio necesario para proteger los ojos de la exposición al láser. Proporciona una protección completa para los ojos frente al láser. '
        );
$aProducts[]=new Product(
        'Braun Venus Braun Venus - Gel activador para depilación IPL ',
        'B00AMAJZ8G',
        'El gel activador Naked Skin V favorece un tratamiento suave y una reducción más efectiva del vello. '
        );
$aProducts[]=new Product(
        'SafeLightPro - Gafas de protección para depilación HPL/IPL ',
        'B009GFML20',
        'Las gafas SafeLightPro F5 protegen sus ojos de los impulsos de luz muy intensos (destellos) emitidos por los dispositivos HPL e IPL que se utilizan para la eliminación definitiva del vello. Por este motivo se establece un determinado nivel de oscuridad.'
        );
$aProducts[]=new Product(
        'Silk\'n Glide Rapid para la depilación',
        'B073T4BKRX',
        'La novedad mundial de Silkn, el Glide Rapid con 400.000 PULSOS DE LUZ, el último modelo de la serie Silk\'n Glide!'
        );
$aProducts[]=new Product(
        'Mujer Botas Zapatos, Gracosy Nieve Invierno Cortas Fur Aire Libre Boots',
        'B07649JJBW',
        'DENGBOSN Botas para mujer Botas de invierno Botas de nieve'
        );
$aProducts[]=new Product(
        'Shiatsu Masajeador de Espalda Cuello y Hombros con Calor ',
        'B0785L376C',
        'Nuestro objetivo en InvoSpa es proporcionarte placer y confort que puedes llevarte a donde quieras. Usamos pelotas de masaje con presión 3D para darte masajes con beneficios para tu cuello, hombros, espalda, lumbares, cintura, muslos, pantorrillas, piernas, pies y brazos.'
        );
$aProducts[]=new Product(
        'Logitech MK235 - Teclado y ratón inalámbrico, color negro ',
        'B01C4HCV58',
        'Logitech MK235 - Teclado y ratón inalámbrico, color negro. Teclado y ratón inalámbrico  '
        );

file_put_contents('json_products.json', json_encode($aProducts));