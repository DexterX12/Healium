<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDrugController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['drugs'] = Drug::all();

        return view('admin.drug.index')->with('viewData', $viewData);
    }
}
