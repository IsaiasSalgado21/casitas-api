<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservationHistory;

class ReservationHistoryController extends Controller
{
    public function index()
    {
        return response()->json(ReservationHistory::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'reservation_id' => 'required|exists:reservations,id',
            'previous_status' => 'required|string',
            'new_status' => 'required|string',
            'event_date' => 'nullable|date',
            'details' => 'nullable|string',
        ]);

        $history = ReservationHistory::create($request->all());

        return response()->json($history, 201);
    }

    public function show($id)
    {
        $history = ReservationHistory::find($id);
        if (!$history) return response()->json(['message' => 'Reservation History not found'], 404);
        return response()->json($history);
    }

    public function update(Request $request, $id)
    {
        $history = ReservationHistory::find($id);
        if (!$history) return response()->json(['message' => 'Reservation History not found'], 404);

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'reservation_id' => 'sometimes|exists:reservations,user_id',
            'previous_status' => 'sometimes|string',
            'new_status' => 'sometimes|string',
            'event_date' => 'nullable|date',
            'details' => 'nullable|string',
        ]);

        $history->update($request->all());

        return response()->json($history);
    }

    public function destroy($id)
    {
        $history = ReservationHistory::find($id);
        if (!$history) return response()->json(['message' => 'Reservation History not found'], 404);

        $history->delete();

        return response()->json(['message' => 'Reservation History deleted']);
    }
}
