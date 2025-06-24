<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CabinImage;

class CabinImageController extends Controller
{
    public function index()
    {
        return response()->json(CabinImage::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'cabin_id' => 'required|exists:cabins,id',
            'url' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $cabinImage = CabinImage::create($request->all());

        return response()->json($cabinImage, 201);
    }

    public function show($id)
    {
        $cabinImage = CabinImage::find($id);
        if (!$cabinImage) return response()->json(['message' => 'Cabin Image not found'], 404);
        return response()->json($cabinImage);
    }

    public function update(Request $request, $id)
    {
        $cabinImage = CabinImage::find($id);
        if (!$cabinImage) return response()->json(['message' => 'Cabin Image not found'], 404);

        $request->validate([
            'cabin_id' => 'sometimes|exists:cabins,id',
            'url' => 'sometimes|string',
            'description' => 'nullable|string',
        ]);

        $cabinImage->update($request->all());

        return response()->json($cabinImage);
    }

    public function destroy($id)
    {
        $cabinImage = CabinImage::find($id);
        if (!$cabinImage) return response()->json(['message' => 'Cabin Image not found'], 404);

        $cabinImage->delete();

        return response()->json(['message' => 'Cabin Image deleted']);
    }
}
