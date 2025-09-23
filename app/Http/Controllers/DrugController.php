<?php

/*
* Author: Miguel Salinas
*/

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DrugController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [];
        $searchName = $request->query('name');
        $salesFilter = $request->query('sales_filter');

        if ($searchName)
        {
            $viewData['drugs'] = Drug::searchByName($searchName);
        } elseif ($salesFilter)
        {
            $viewData['drugs'] = Drug::filterBySales($salesFilter);
        } else
        {
            $viewData['drugs'] = Drug::all();
        }

        return view('drug.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $viewData = [];
        $selectedDrug = Drug::with('comments')->findOrFail($id);
        $viewData['drug'] = $selectedDrug;

        return view('drug.show')->with('viewData', $viewData);
    }
}
