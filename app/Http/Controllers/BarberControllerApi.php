<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarberControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $barberRoleId = Role::where('name', 'barber')->value('id');

        $barbers = User::where('role_id', $barberRoleId)
            ->limit($request->perpage ?? 5)
            ->offset(($request->perpage ?? 5) * ($request->page ?? 0))
            ->get()
            ->map(function ($barber) {
                if ($barber->start_work_at) {
                    $years = round(Carbon::parse($barber->start_work_at)->diffInYears(Carbon::now()));
                    if ($years == 0) {
                        $barber->experience = "Меньше года";
                    } else if ($years % 10 == 1) {
                        $barber->experience = "{$years} год";
                    } else if (in_array($years % 10, [2, 3, 4])){
                        $barber->experience = "{$years} года";
                    }
                    else {
                        $barber->experience = "{$years} лет";
                    }
                }
                return $barber;
            });

        return response($barbers);
    }

    public function total()
    {
        $barberRoleId = Role::where('name', 'barber')->value('id');

        $count = User::where('role_id', $barberRoleId)->count();

        return response($count);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
