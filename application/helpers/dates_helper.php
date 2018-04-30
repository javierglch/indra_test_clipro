<?php

if(!function_exists('parse_date')){
    /**
     * divide una fecha tipo 20/10/2017 y la transforma en un objeto de tipo DateTime
     * @param type $date
     * @return \DateTime
     */
    function parse_date($date){
        $aDate = explode('/',$date);
        
        $dt = new DateTime();
        $dt->setDate($aDate[2], $aDate[1]-1, $aDate[0]);
        
        return $dt;
    }
}