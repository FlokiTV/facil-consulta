<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validator extends Model
{
    public static function cpf($cpf){
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($i = 9, $j = 0, $sum = 0; $i > 0; $i--, $j++) {
            $sum += $cpf[$j] * $i;
        }

        $res = $sum % 11;
        $dig1 = ($res < 2) ? 0 : 11 - $res;

        for ($i = 10, $j = 0, $sum = 0; $i > 1; $i--, $j++) {
            $sum += $cpf[$j] * $i;
        }

        $res = $sum % 11;
        $dig2 = ($res < 2) ? 0 : 11 - $res;

        if ($cpf[9] != $dig1 || $cpf[10] != $dig2) {
            return false;
        }

        return true;
    }
    public static function tel($number) {
        $number = preg_replace('/[^0-9]/', '', $number);
    
        if (strlen($number) < 10 || strlen($number) > 11) {
            return false;
        }
    
        return true;
    }
}
