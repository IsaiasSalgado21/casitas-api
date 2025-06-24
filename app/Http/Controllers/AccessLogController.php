<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessLog;

class AccessLogController extends Controller
{
    public function index()
    {
        return response()->json(AccessLog::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ip_address' => 'required|string',
            'browser' => 'required|string',
            'login_at' => 'nullable|date',
        ]);

        $accessLog = AccessLog::create($request->all());

        return response()->json($accessLog, 201);
    }

    public function show($id)
    {
        $accessLog = AccessLog::find($id);
        if (!$accessLog) return response()->json(['message' => 'Access Log not found'], 404);
        return response()->json($accessLog);
    }

    public function update(Request $request, $id)
    {
        $accessLog = AccessLog::find($id);
        if (!$accessLog) return response()->json(['message' => 'Access Log not found'], 404);

        $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'ip_address' => 'sometimes|string',
            'browser' => 'sometimes|string',
            'login_at' => 'nullable|date',
        ]);

        $accessLog->update($request->all());

        return response()->json($accessLog);
    }

    public function destroy($id)
    {
        $accessLog = AccessLog::find($id);
        if (!$accessLog) return response()->json(['message' => 'Access Log not found'], 404);

        $accessLog->delete();

        return response()->json(['message' => 'Access Log deleted']);
    }
}
