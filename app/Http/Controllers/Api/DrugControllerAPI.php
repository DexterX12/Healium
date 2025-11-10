<?php

/*
* Author: Miguel Salinas
*/

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DrugResource;
use App\Models\Drug;
use Illuminate\Http\JsonResponse;

class DrugControllerAPI extends Controller
{
    public function show(int $id): JsonResponse
    {
        $drug = new DrugResource(Drug::findOrFail($id));
        return response()->json($drug, 200);
    }
}
