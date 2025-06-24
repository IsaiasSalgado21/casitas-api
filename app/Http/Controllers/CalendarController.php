<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calendar;

class CalendarController extends Controller
{
    public function index()
    {
        return response()->json(Calendar::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'cabin_id' => 'required|exists:cabins,id',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);

        $calendar = Calendar::create($request->all());

        return response()->json($calendar, 201);
    }

    public function show($id)
    {
        $calendar = Calendar::find($id);
        if (!$calendar) return response()->json(['message' => 'Calendar not found'], 404);
        return response()->json($calendar);
    }

    public function update(Request $request, $id)
    {
        $calendar = Calendar::find($id);
        if (!$calendar) return response()->json(['message' => 'Calendar not found'], 404);

        $request->validate([
            'cabin_id' => 'sometimes|exists:cabins,id',
            'date' => 'sometimes|date',
            'status' => 'sometimes|string',
        ]);

        $calendar->update($request->all());

        return response()->json($calendar);
    }

    public function destroy($id)
    {
        $calendar = Calendar::find($id);
        if (!$calendar) return response()->json(['message' => 'Calendar not found'], 404);

        $calendar->delete();

        return response()->json(['message' => 'Calendar deleted']);
    }
}
