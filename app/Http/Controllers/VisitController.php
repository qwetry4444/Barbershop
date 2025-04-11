<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('visits', [
            'visits' => Visit::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visit_create', [
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barber_id' => 'required',
            'datetime' => 'required'
        ]);

        $visit = new Visit($validated);
        $visit->save();
        return redirect('visits');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('visit_services', [
            'visit' => Visit::all()->where('id', $id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('visit_edit', [
            'visit' => Visit::all()->where('id', $id)->first(),
            'users' => User::all(),
            'services' => Service::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'services.*' => 'exists:services,id'
        ]);

        $visit = Visit::all()->where('id', $id)->first();
        $visit->user_id = $validated['client_id'];
        $visit->start_at = $validated['start_at'];
        $visit->end_at = $validated['end_at'];
        $visit->save();

        $visit->service()->sync($validated['services'] ?? []);

        return redirect('visits');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visit = Visit::all()->where('id', $id)->first();

        if ($visit->service()->exists())
            return redirect('visits')->with('error_delete', "Ну удалось удалить запись, так как с ней связаны услуги");

        Visit::destroy($id);
        return redirect('visits')->with('success_delete', "Запись успешно удалена");
    }
}
