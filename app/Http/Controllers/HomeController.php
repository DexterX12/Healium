<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {

        $viewData = [];
        $viewData['drugs'] = Drug::orderBy('created_at')->get();

        return view('home.index')->with('viewData', $viewData);
    }
}
