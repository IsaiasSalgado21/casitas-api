<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabin;

class CabinController extends Controller
{
    public function index()
    {
        return response()->json(Cabin::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'required|integer',
            'size_m2' => 'required|integer',
            'price_per_night' => 'required|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'active' => 'boolean',
        ]);

        $cabin = Cabin::create($request->all());

        return response()->json($cabin, 201);
    }

    public function show($id)
    {
        $cabin = Cabin::find($id);
        if (!$cabin) return response()->json(['message' => 'Cabin not found'], 404);
        return response()->json($cabin);
    }

    public function update(Request $request, $id)
    {
        $cabin = Cabin::find($id);
        if (!$cabin) return response()->json(['message' => 'Cabin not found'], 404);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'capacity' => 'sometimes|integer',
            'size_m2' => 'sometimes|integer',
            'price_per_night' => 'sometimes|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'active' => 'boolean',
        ]);

        $cabin->update($request->all());

        return response()->json($cabin);
    }

    public function destroy($id)
    {
        $cabin = Cabin::find($id);
        if (!$cabin) return response()->json(['message' => 'Cabin not found'], 404);

        $cabin->delete();

        return response()->json(['message' => 'Cabin deleted']);
    }
}
