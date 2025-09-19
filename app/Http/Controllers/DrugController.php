<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DrugController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['drugs'] = Drug::all();

        return view('drug.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        return view('drug.create');
    }

    public function show(int $id): View
    {
        $viewData = [];
        $selectedDrug = Drug::findOrFail($id);
        $viewData['drug'] = $selectedDrug;

        return view('drug.show')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $drugDataValidated = $request->validate($request->all());
        Drug::create($drugDataValidated);

        return redirect()
            ->route('drug.index')
            ->with('success', 'Drug created successfully');
    }

    public function delete(int $id): RedirectResponse
    {
        $drug = Drug::findOrFail($id);
        $drug->delete();

        return redirect()
            ->route('drug.index')
            ->with('success', 'Drug deleted successfully');
    }

    public function searchByName(Request $request): RedirectResponse
    {
        $searchName= $request->query('name');
        $viewData = [];
        $viewData['drugs'] = Drug::searchByName($searchName);

        return redirect()
            ->route('drug.index')
            ->with('success', 'Drug has been found successfully');
    }
}
