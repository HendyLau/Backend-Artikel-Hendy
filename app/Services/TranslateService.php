<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class TranslateService
{
    public static function translate($text, $target = 'id', $source = 'en')
    {
        if ($target === $source) return $text;

        $response = Http::post('https://libretranslate.de/translate', [
            'q' => $text,
            'source' => $source,
            'target' => $target,
            'format' => 'text'
        ]);

        if ($response->ok()) {
            return $response->json()['translatedText'] ?? $text;
        }

        return $text;
    }
}
