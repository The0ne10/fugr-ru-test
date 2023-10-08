<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRequest;
use App\Http\Requests\Api\UpdateRequest;
use App\Http\Resources\NotebookResource;
use App\Models\Image;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        return NotebookResource::collection(Notebook::query()->latest()->paginate(10));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
            unset($data['image_url']);
        }

        if (is_file($data['image'])) {
            $image_url = Storage::disk('public')->put('/images', $request['image']);
            $data['image'] = $image_url;
        }
        $notebook = Notebook::create($data);
        return new NotebookResource($notebook);

    }


    public function show($id)
    {
        return NotebookResource::make(Notebook::query()->where('id', $id)->first());
    }

    public function update($id, UpdateRequest $request)
    {
        $data = $request->validated();
        $notebook = Notebook::query()->where('id', $id)->first();
        if (!empty($data['image_url'])) {
            $data['image'] = $data['image_url'];
            unset($data['image_url']);
        }

        if (is_file($data['image'])) {
            $image_url = Storage::disk('public')->put('/images', $request['image']);
            $data['image'] = $image_url;
        }

        $notebook->update($data);
        return new NotebookResource($notebook);
    }

    public function delete($id)
    {
        $notebook = Notebook::query()->where('id', $id)->first();
        $image = Image::query()->where('url', $notebook->image)->first();
        if (!is_null($image)) {
            $path = $image->toArray()['path'];
            Storage::disk('public')->delete($path);
        }
        $notebook->delete();

        return response()->json(['message' => 'done']);
    }
}

