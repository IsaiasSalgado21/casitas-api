<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json(Review::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'cabin_id' => 'required|exists:cabins,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'review_date' => 'nullable|date',
            'status' => 'required|string',
        ]);

        $review = Review::create($request->all());

        return response()->json($review, 201);
    }

    public function show($id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['message' => 'Review not found'], 404);
        return response()->json($review);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['message' => 'Review not found'], 404);

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'cabin_id' => 'sometimes|exists:cabins,id',
            'rating' => 'sometimes|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'review_date' => 'nullable|date',
            'status' => 'sometimes|string',
        ]);

        $review->update($request->all());

        return response()->json($review);
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) return response()->json(['message' => 'Review not found'], 404);

        $review->delete();

        return response()->json(['message' => 'Review deleted']);
    }
}
