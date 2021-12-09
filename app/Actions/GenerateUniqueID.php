<?php

namespace App\Actions;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Str;

class GenerateUniqueID
{
    public static function staffID(): string
    {
        $id =  'STA-' .Str::of(Str::random(3) . '-')->upper() . rand(10, 99);

        if( User::where('staff_id', $id)->exists()) {
            return self::staffID();
        }

        return $id;
    }


    public static function rnNumber(): string
    {
        $id = str_pad(rand(10, 1000000), 12, '0', STR_PAD_LEFT);

        if( Patient::where('rn', $id)->exists()) {
            return self::rnNumber();
        }

        return $id;
    }
}
