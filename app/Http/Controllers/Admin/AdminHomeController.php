<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Drug;
use App\Models\User;
use Illuminate\View\View;

class AdminHomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['total_users'] = User::count();
        $viewData['top_drugs'] = Drug::getTopSales(5);

        return view('admin.home.index')->with('viewData', $viewData);
    }
}
