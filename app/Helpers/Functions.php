<?php

namespace App\Helpers;

class Functions{
    public static function formatDate($date){
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
        $date = explode('-', $date);
        $dia = intval($date[2]);
        $mes = intval($date[1]-1);
        $anio = intval($date[0]);
        $f_date = "$meses[$mes] del $anio";
        return $f_date;
    }



    public static function extractColor($color){
        return explode("-", $color)[0];
    }

    public static function enumarateModify($number){
        if (strlen(strval($number)) == 1) {
            return "0$number";
        } else {
            return $number;
        }
    }

    public static function verifyStateTema($estado, $estadoActual){
        if($estado == $estadoActual){
            return 'current-item';
        }
        else{
            return '';
        }
    }

    public static function adjustTags($tags){
        $count = 1;
        $tag_list = '';
        foreach($tags as $tag){
            $tag_list .= "$tag->nombre";
            if($count != count($tags)){
                $tag_list .= ", ";
            }
            $count++;
        }
        return $tag_list;
    }

    public static function getTagIcon($type){
        return 'fa-solid fa-file-lines';
        
    }

    public static function convertToRoman($number)
    {
        $romans = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        ];

        $result = '';

        foreach ($romans as $roman => $value) {
            while ($number >= $value) {
                $result .= $roman;
                $number -= $value;
            }
        }

        return $result;
    }

    public static function getDateRange($libro){
        $oldest = $libro->actas->min('fecha');
        $newest = $libro->actas->max('fecha');

        $oldest_str = Functions::formatDate($oldest);
        $newest_str = Functions::formatDate($newest);
        if($oldest_str != $newest_str)
            return "($oldest_str - $newest_str)";
        else
            return "($oldest_str)";
    }
}