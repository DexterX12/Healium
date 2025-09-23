<?php

/*
* Author: Delvin - Miguel Salinas
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
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
            ->with('success', __('Supplier created successfully'));
    }

    public function delete(Request $request): RedirectResponse
    {
        try {
            $supplier = Supplier::findOrFail($request->input('id'));
            $supplier->delete();
        } catch (QueryException $exception) {
            if ($exception->getCode() === '23000') {
                return redirect()
                    ->route('admin.supplier.index')
                    ->with('error', __('This supplier has drugs related to it.'));
            }

            throw $exception;
        }

        return redirect()
            ->route('admin.supplier.index')
            ->with('success', __('Supplier deleted successfully'));
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
            ->with('success', __('Supplier updated successfully'));
    }
}
