<?php

use App\Helpers\TranslateHelper;

if (!function_exists('translate')) {
    function translate($text, $source = 'en', $target = null) {
        $target = $target ?? session('user_locale', 'en');

        if ($source === $target) {
            return $text;
        }

        return TranslateHelper::translate($text, $source, $target);
    }
}
