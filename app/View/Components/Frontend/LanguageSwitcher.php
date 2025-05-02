<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Component;
use Throwable;

class LanguageSwitcher extends Component
{
    public array $availableLocales;
    public string $currentLocale;
    public array $currentLanguage;

    /**
     * Create a new component instance.
     */
    public function __construct(public string $type = 'dropdown')
    {
        $locales = Config::get('languages.available', []);
        $this->currentLocale = App::getLocale();

        $this->availableLocales = collect($locales)->map(function ($properties, $localeCode) {
            if (isset($properties['flag'])) {
                try {
                    $properties['flag_url'] = Vite::asset('resources/assets/frontend/media/images/flags/' . $properties['flag']);
                } catch (Throwable $e) {
                    report($e);
                    $properties['flag_url'] = null;
                    unset($properties['flag']);
                }
            }
            return $properties;
        })->all();

        $this->currentLanguage = $this->availableLocales[$this->currentLocale]
            ?? ['name' => $this->currentLocale, 'native' => $this->currentLocale];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.language-switcher');
    }
}
