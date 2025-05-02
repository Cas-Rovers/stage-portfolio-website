<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        $availableLocales = config('languages.available', []);

        if (array_key_exists($locale, $availableLocales)) {
            Session::put('locale', $locale);
        } else {
            // something
        }

        return redirect()->back();
    }
}
