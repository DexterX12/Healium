<?php

namespace App\Http\Controllers\Admin;

use App\Models\Drug;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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

    public function create(): View | RedirectResponse
    {
        $viewData = [];
        $suppliers = Supplier::all();
        $viewData['suppliers'] = $suppliers;

        if ($suppliers->count() < 1)
        {
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

        if ($request->hasFile('image'))
        {
            $imageName = $newDrug->getId().".".$request->file('image')->extension();
            
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );

            $newDrug->setImage($imageName);
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

        if ($request->hasFile('image'))
        {
            $imageName = $drugToUpdate->getId().".".$request->file('image')->extension();
            
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );

            $drugToUpdate->setImage($imageName);
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
