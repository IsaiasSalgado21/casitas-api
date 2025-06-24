<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatMessageController extends Controller
{
    public function index()
    {
        return response()->json(ChatMessage::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'sender' => 'required|string',
            'message' => 'required|string',
            'sent_at' => 'nullable|date',
        ]);

        $chatMessage = ChatMessage::create($request->all());

        return response()->json($chatMessage, 201);
    }

    public function show($id)
    {
        $chatMessage = ChatMessage::find($id);
        if (!$chatMessage) return response()->json(['message' => 'Chat Message not found'], 404);
        return response()->json($chatMessage);
    }

    public function update(Request $request, $id)
    {
        $chatMessage = ChatMessage::find($id);
        if (!$chatMessage) return response()->json(['message' => 'Chat Message not found'], 404);

        $request->validate([
            'chat_id' => 'sometimes|exists:chats,id',
            'sender' => 'sometimes|string',
            'message' => 'sometimes|string',
            'sent_at' => 'nullable|date',
        ]);

        $chatMessage->update($request->all());

        return response()->json($chatMessage);
    }

    public function destroy($id)
    {
        $chatMessage = ChatMessage::find($id);
        if (!$chatMessage) return response()->json(['message' => 'Chat Message not found'], 404);

        $chatMessage->delete();

        return response()->json(['message' => 'Chat Message deleted']);
    }
}
