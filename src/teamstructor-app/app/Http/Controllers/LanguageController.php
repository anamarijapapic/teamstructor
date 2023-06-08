<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLocale($locale)
    {
        if (array_key_exists($locale, config('locales'))) {
            Session::put('locale', $locale);
        }

        return Redirect::back();
    }
}
