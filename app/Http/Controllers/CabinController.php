<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabin;

class CabinController extends Controller
{
    public function index()
    {
        return response()->json(\App\Models\Cabin::where('active', true)->get());
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
          $cabin = Cabin::with(['reviews.user'])->findOrFail($id);

        return response()->json([
            'id' => $cabin->id,
            'name' => $cabin->name,
            'pricePerNight' => $cabin->price_per_night,
            'capacity' => $cabin->capacity,
            'reviwes' => $cabin->reviews->map(function ($review) {
                return [
                    'fisrt_name' => $review->user->name ?? 'user',
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'date' => \Carbon\Carbon::parse($review->review_date)->toDateString(),
                ];
            }),
        ]);
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

