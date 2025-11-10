<?php

/*
* Author: Miguel Salinas
*/

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;

class SupplierControllerAPI extends Controller
{
    public function index(): JsonResponse
    {
        $suppliers = SupplierResource::collection(Supplier::all());
        return response()->json($suppliers, 200);
    }
}
