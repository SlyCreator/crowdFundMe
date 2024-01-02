<?php

namespace App\Utils;

class Utilities
{
    public static function customAbort($message,$code)
    {
        abort(response()->json(['message' => $message], $code));
    }
}
