<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'cabin_id' => 'required|exists:cabins,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'total' => 'required|numeric',
            'notes' => 'nullable|string',
            'reminder_sent' => 'boolean',
        ]);

        $reservation = Reservation::create($request->all());

        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) return response()->json(['message' => 'Reservation not found'], 404);
        return response()->json($reservation);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) return response()->json(['message' => 'Reservation not found'], 404);

        $request->validate([
            'verification_code' => 'sometimes|string',
            'user_id' => 'sometimes|exists:users,id',
            'cabin_id' => 'sometimes|exists:cabins,id',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'sometimes|string',
            'total' => 'sometimes|numeric',
            'notes' => 'nullable|string',
            'reminder_sent' => 'boolean',
        ]);

        $reservation->update($request->all());

        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if (!$reservation) return response()->json(['message' => 'Reservation not found'], 404);

        $reservation->delete();

        return response()->json(['message' => 'Reservation deleted']);
    }
}
