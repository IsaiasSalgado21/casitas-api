<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewAlert;

class ReviewAlertController extends Controller
{
    public function index()
    {
        return response()->json(ReviewAlert::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reservation_id' => 'required|exists:reservations,id',
            'event_type' => 'required|string',
            'alert_date' => 'nullable|date',
            'sent' => 'boolean',
        ]);

        $alert = ReviewAlert::create($request->all());

        return response()->json($alert, 201);
    }

    public function show($id)
    {
        $alert = ReviewAlert::find($id);
        if (!$alert) return response()->json(['message' => 'Review Alert not found'], 404);
        return response()->json($alert);
    }

    public function update(Request $request, $id)
    {
        $alert = ReviewAlert::find($id);
        if (!$alert) return response()->json(['message' => 'Review Alert not found'], 404);

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'reservation_id' => 'sometimes|exists:reservations,id',
            'event_type' => 'sometimes|string',
            'alert_date' => 'nullable|date',
            'sent' => 'boolean',
        ]);

        $alert->update($request->all());

        return response()->json($alert);
    }

    public function destroy($id)
    {
        $alert = ReviewAlert::find($id);
        if (!$alert) return response()->json(['message' => 'Review Alert not found'], 404);

        $alert->delete();

        return response()->json(['message' => 'Review Alert deleted']);
    }
}
