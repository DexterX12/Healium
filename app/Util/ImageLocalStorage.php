<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageLocalStorage implements ImageStorage
{
    public function store(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            $filename = Str::uuid()->toString().'.'.$request->file('image')->extension();
            Storage::disk('public')->put(
                $filename,
                file_get_contents($request->file('image')->getRealPath())
            );

            return $filename;
        }

        return null;
    }
}
