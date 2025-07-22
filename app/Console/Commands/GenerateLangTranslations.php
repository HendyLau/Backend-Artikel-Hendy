<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GenerateLangTranslations extends Command
{
    protected $signature = 'lang:generate';
    protected $description = 'Generate translated language files for app.php and JSON frontend';

    public function handle()
    {
        $source = resource_path('lang/en/app.php');
        if (!file_exists($source)) {
            $this->error("File lang/en/app.php not found.");
            return;
        }

        $original = require $source;

        $locales = ['id', 'es', 'fr', 'de', 'ar', 'zh', 'ja', 'ko', 'hi', 'ru', 'pt', 'tr', 'it', 'th', 'nl', 'vi', 'pl', 'ro', 'uk'];

        foreach ($locales as $locale) {
            $this->info("Translating to: $locale");

            $tr = new GoogleTranslate($locale, 'en');

            $translated = [];
            foreach ($original as $key => $text) {
                try {
                    $translated[$key] = $tr->translate($text);
                } catch (\Throwable $e) {
                    $translated[$key] = $text;
                    $this->error("Failed to translate '$text' to $locale");
                }
            }

            $langPath = resource_path("lang/$locale");
            if (!is_dir($langPath)) {
                mkdir($langPath, 0755, true);
            }

            // app.php for backend
            file_put_contents(
                "$langPath/app.php",
                "<?php\n\nreturn " . var_export($translated, true) . ";\n"
            );

            // JSON file for frontend
            file_put_contents(
                resource_path("lang/$locale.json"),
                json_encode($translated, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );
        }

        $this->info("✅ Translations generated successfully.");
    }
}
