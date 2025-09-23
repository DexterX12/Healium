<?php

/*
* Author: Delvin - Miguel Salinas
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ImageStorage;
use App\Models\Drug;
use App\Models\Supplier;
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

    public function edit(int $id): View
    {
        $viewData = [];

        $selectedDrug = Drug::findOrFail($id);
        $suppliers = Supplier::all();
        $viewData['drug'] = $selectedDrug;
        $viewData['suppliers'] = $suppliers;

        return view('admin.drug.edit')->with('viewData', $viewData);
    }

    public function create(): View|RedirectResponse
    {
        $viewData = [];
        $suppliers = Supplier::all();
        $viewData['suppliers'] = $suppliers;

        if ($suppliers->count() < 1) {
            return redirect()
                ->route('admin.drug.index')
                ->with('error', 'There are no suppliers stored. Please add suppliers before creating a new drug.');
        }

        return view('admin.drug.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $drugDataValidated = Drug::validate($request->all());
        $newDrug = Drug::create($drugDataValidated);

        $imageStorage = app(ImageStorage::class);
        $imagePath = $imageStorage->store($request);

        if ($imagePath) {
            $newDrug->setImage($imagePath);
            $newDrug->save();
        }

        return redirect()
            ->route('admin.drug.index')
            ->with('success', 'Drug created successfully.');
    }

    public function update(Request $request): RedirectResponse
    {
        $drugDataValidated = Drug::validate($request->all());
        $drugToUpdate = Drug::findOrFail($request->input('id'));
        $drugToUpdate->fill($drugDataValidated);

        $imageStorage = app(ImageStorage::class);
        $imagePath = $imageStorage->store($request);

        if ($imagePath) {
            $drugToUpdate->setImage($imagePath);
        }
        $drugToUpdate->save();

        return redirect()
            ->route('admin.drug.index')
            ->with('success', 'Drug created successfully.');
    }

    public function delete(int $id): RedirectResponse
    {
        $drug = Drug::findOrFail($id);
        $drug->delete();

        return redirect()
            ->route('drug.index')
            ->with('success', 'Drug deleted successfully.');
    }
}
