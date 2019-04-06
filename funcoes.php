<?php
function ConverteData($str){
    $ano = substr($str, 0, 4);
    $mes = substr($str, 4, 2);
    $dia = substr($str, 6, 2);
    $hora = substr($str, 8, 2);

    $hora2 = str_pad($hora, 2, 0, STR_PAD_LEFT);

    return array($ano, $mes, $dia, $hora2);
    //return "ano: ".$ano." mes: ".$mes." data: ".$data." hora: ".$hora;
}

function ConverteHora($str){
    $str = str_pad($str, 2, 0, STR_PAD_LEFT);

    return $str;
}