<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json(Notification::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'message' => 'required|string',
            'read' => 'boolean',
            'sent_at' => 'nullable|date',
        ]);

        $notification = Notification::create($request->all());

        return response()->json($notification, 201);
    }

    public function show($id)
    {
        $notification = Notification::find($id);
        if (!$notification) return response()->json(['message' => 'Notification not found'], 404);
        return response()->json($notification);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        if (!$notification) return response()->json(['message' => 'Notification not found'], 404);

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'type' => 'sometimes|string',
            'message' => 'sometimes|string',
            'read' => 'boolean',
            'sent_at' => 'nullable|date',
        ]);

        $notification->update($request->all());

        return response()->json($notification);
    }

    public function destroy($id)
    {
        $notification = Notification::find($id);
        if (!$notification) return response()->json(['message' => 'Notification not found'], 404);

        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }
}
