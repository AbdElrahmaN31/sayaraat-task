<?php

use App\Models\User;

if (!function_exists('user')) {
    function user(): User
    {
        return auth()->user();
    }
}

if (!function_exists('lang')) {
    function lang(): string
    {
        return App()->getLocale();
    }
}

if (!function_exists('generateRandomCode')) {
    function generateRandomCode(): string
    {
        return '1234';
        return rand(1111, 4444);
    }
}

if (!function_exists('randomBy')) {
    function randomBy($num = 6): int
    {
        $start = (int)str_repeat(1, $num);
        $end   = (int)str_repeat(9, $num);
        return rand($start, $end);
    }
}

/**
 * round number to 2 precision
 */
if (!function_exists('round2')) {
    function round2($number): float
    {
        return round($number, 2);
    }
}

if (!function_exists('round1')) {
    function round1($number): float
    {
        return round($number, 1);
    }
}

if (!function_exists('perPage')) {
    function perPage($perPage = 10)
    {
        if (request('per_page') == 'all') {
            return 999;
        }

        return request('per_page') ? (int)request('per_page') : $perPage;
    }
}

?>
