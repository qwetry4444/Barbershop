<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ServiceControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response(Service::limit($request->perpage ?? 5)
            ->offset(($request->perpage ?? 5) * ($request->page ?? 0))
            ->get());
    }

    public function total()
    {
        return response(Service::all()->count());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response(Service::class::find($id));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 1,
                'message' => 'Необходима авторизация'
            ], 401);
        }
        if (!Gate::allows('create-service')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на добавление услуги'
            ]);
        }
        $validated = $request->validate([
            'name' => 'required|unique:services|max:255',
            'price' => 'required|numeric',
            'image' => 'required|file'
        ]);

        $file = $request->file('image');
        $fileName = rand(1, 100000). '_' . $file->getClientOriginalName();

        try {
            $path = Storage::disk('s3')->putFileAs('servicesPictures', $file, $fileName);
            $fileUrl = Storage::disk('s3')->url($path);
        }
        catch (\Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => "Ошибка при загрузке S3",
            ]);
        };
        $service = new Service();
        $service->fill($validated);
        $service->picture_url = $fileUrl;
        $service->save();


        return response()->json([
            'code' => 0,
            'message' => 'Услуга успешно добавлена'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
