<?php

if (!function_exists('tracklink')) {


    /**
     * Genera una url para trackear el link en la base de datos
     * @param string $url url final de destino
     * @param int $accid IDAccount: id de la cuenta que esta haciendo click al link
     * @param string $ref Referencia: valor de grupo o nombre de campaña para identificar el link
     * @return string url generada
     */
    function tracklink($url, $accid, $ref) {
        return base_url('linkto/' . base64_encode(json_encode(['url' => $url, 'accid' => $accid, 'ref' => $ref])));
    }

}