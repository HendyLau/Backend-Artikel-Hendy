<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateHelper
{
    /**
     * Translate text from source to target language.
     * Auto detect source if kosong.
     * Cache hasil terjemahan selama 7 hari.
     * Fallback ke Google Translate jika LibreTranslate gagal.
     *
     * @param string $text
     * @param string $source  Language code (default empty = auto detect)
     * @param string $target  Language code (default 'id')
     * @return string
     */
    public static function translate(string $text, string $source = '', string $target = 'id'): string
    {
        if (trim($text) === '') {
            return $text; // kosong langsung return
        }

        if ($source === $target && $source !== '') {
            return $text; // sama bahasa, return text
        }

        $cacheKey = 'translation_' . md5($text . $source . $target);

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($text, $source, $target) {
            try {
                $sourceLang = $source === '' ? 'auto' : $source;

                $response = Http::timeout(5)->post('https://libretranslate.de/translate', [
                    'q' => $text,
                    'source' => $sourceLang,
                    'target' => $target,
                    'format' => 'text',
                ]);

                if ($response->successful() && isset($response->json()['translatedText'])) {
                    return $response->json()['translatedText'];
                }

                Log::warning('LibreTranslate failed', [
                    'text' => $text,
                    'response' => $response->body(),
                ]);
            } catch (\Exception $e) {
                Log::error('LibreTranslate exception', ['error' => $e->getMessage()]);
            }

            // fallback ke Google Translate via Stichoza
            try {
                $tr = new GoogleTranslate($target);
                if ($source !== '') {
                    $tr->setSource($source);
                }

                return $tr->translate($text);
            } catch (\Exception $e) {
                Log::error('Fallback Google Translate failed', ['error' => $e->getMessage()]);
                return $text;
            }
        });
    }
}
