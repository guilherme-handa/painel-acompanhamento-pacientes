<?php

namespace App\Helpers;

use Carbon\Carbon;

class CalculaIdade
{
    public static function calcularIdade($dataNascimento)
    {
        if (!$dataNascimento) {
            return '';
        }

        try {
            return Carbon::parse($dataNascimento)->age;
        } catch (\Exception $e) {
            return '';
        }
    }
}
