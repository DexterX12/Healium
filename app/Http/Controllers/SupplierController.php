<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Http\View\View;

class SupplierController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['suppliers'] = Supplier::al();

        return view('supplier.index')->with('viewData', $viewData);
    }
    public function save(Request $request): View
    {
        $dataSupplierValidated = Supplier::validate($request->all());
        Supplier::create($dataSupplierValidated);

        return redirect()
            ->route('supplier.save')
            ->with('success', 'Supplier created successfully');
    }

    public function delete(int $id): View
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier deleted successfully');
    }

    public function show(int $id): View
    {
        $viewData = [];
        $selectedSupplier = Supplier::findOrFail($id);
        $viewData['supplier'] = $selectedSupplier;

        return view('supplier.show')->with('viewData', $viewData);
    }
}
