<?php

/*
* Author: Miguel Salinas
*/

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ImageStorage
{
    public function store(Request $request): ?string;
}
