<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    public function setLocale(Request $request): RedirectResponse
    {
        $locale = $request->input('lang');
        session(['app_locale' => $locale]);

        return redirect()->back();
    }
}
