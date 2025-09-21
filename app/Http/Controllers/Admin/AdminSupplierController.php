<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSupplierController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['suppliers'] = Supplier::all();

        return view('admin.supplier.index')->with('viewData', $viewData);
    }

    public function create(): View
    {
        return view('admin.supplier.create');
    }

    public function save(Request $request): RedirectResponse
    {
        $dataSupplierValidated = Supplier::validate($request->all());
        Supplier::create($dataSupplierValidated);

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', 'Supplier created successfully');
    }

    public function delete(int $id): RedirectResponse
    {
        dd($id);
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', 'Supplier deleted successfully');
    }

    public function edit(int $id): View
    {
        $viewData = [];
        $selectedSupplier = Supplier::findOrFail($id);
        $viewData['supplier'] = $selectedSupplier;

        return view('admin.supplier.edit')->with('viewData', $viewData);
    }

    public function update(Request $request): RedirectResponse
    {
        $dataSupplierValidated = Supplier::validate($request->all());
        $supplierToUpdate = Supplier::findOrFail($request->input('id'));
        
        $supplierToUpdate->fill($dataSupplierValidated);
        $supplierToUpdate->save();

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', 'Supplier updated successfully');
    }

}
