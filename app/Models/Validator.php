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

        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int)$cpf[$i] * (10 - $i);
        }

        $res = $sum % 11;
        $dig1 = ($res < 2) ? 0 : 11 - $res;

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += (int)$cpf[$i] * (11 - $i);
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
