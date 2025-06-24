<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        return response()->json(Chat::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $chat = Chat::create($request->all());

        return response()->json($chat, 201);
    }

    public function show($id)
    {
        $chat = Chat::find($id);
        if (!$chat) return response()->json(['message' => 'Chat not found'], 404);
        return response()->json($chat);
    }

    public function update(Request $request, $id)
    {
        $chat = Chat::find($id);
        if (!$chat) return response()->json(['message' => 'Chat not found'], 404);

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'reservation_id' => 'sometimes|exists:reservations,id',
        ]);

        $chat->update($request->all());

        return response()->json($chat);
    }

    public function destroy($id)
    {
        $chat = Chat::find($id);
        if (!$chat) return response()->json(['message' => 'Chat not found'], 404);

        $chat->delete();

        return response()->json(['message' => 'Chat deleted']);
    }
}
