<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;


use App\Http\Requests\Api\Image\StoreRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class NotebookImageController extends Controller
{
    public function store(StoreRequest $request)
    {
        $path = Storage::disk('public')->put('/images', $request['image']);
        $url = $request->root() . '/storage/' . $path;
        $image = Image::create([
            'path' => $path,
            'url' => $url,
        ]);

        return new ImageResource($image);
    }
}
