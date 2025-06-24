<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailabilityController extends Controller
{
    public function index()
    {
        return response()->json(Availability::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'cabin_id' => 'required|exists:cabins,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
        ]);

        $availability = Availability::create($request->all());

        return response()->json($availability, 201);
    }

    public function show($id)
    {
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json(['message' => 'Availability not found'], 404);
        }

        return response()->json($availability);
    }

    public function update(Request $request, $id)
    {
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json(['message' => 'Availability not found'], 404);
        }

        $request->validate([
            'cabin_id' => 'sometimes|exists:cabins,id',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'sometimes|string',
        ]);

        $availability->update($request->all());

        return response()->json($availability);
    }

    public function destroy($id)
    {
        $availability = Availability::find($id);
        if (!$availability) {
            return response()->json(['message' => 'Availability not found'], 404);
        }

        $availability->delete();

        return response()->json(['message' => 'Availability deleted']);
    }
}
