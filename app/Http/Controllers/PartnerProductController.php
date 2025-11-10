<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class PartnerProductController extends Controller
{
    public function index(): View
    {
        $viewData = [];

        $url = 'http://104.197.250.210/api/products';
        $response = Http::timeout(20)->get($url);
        $data = $response->json();

        $viewData['products'] = $data['data'];
        $viewData['store_info'] = $data['additionalData'];

        return view('partner.index')->with('viewData', $viewData);
    }
}
