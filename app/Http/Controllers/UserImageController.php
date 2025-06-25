<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserImage;

class UserImageController extends Controller
{
    public function index()
    {
        return response()->json(UserImage::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'url' => 'required|string',
            'type' => 'nullable|string',
        ]);

        $userImage = UserImage::create($request->all());

        return response()->json($userImage, 201);
    }

    public function show($id)
    {
        $userImage = UserImage::find($id);
        if (!$userImage) return response()->json(['message' => 'User Image not found'], 404);
        return response()->json($userImage);
    }

    public function update(Request $request, $id)
    {
        $userImage = UserImage::find($id);
        if (!$userImage) return response()->json(['message' => 'User Image not found'], 404);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'url' => 'sometimes|string',
            'type' => 'nullable|string',
        ]);

        $userImage->update($request->all());

        return response()->json($userImage);
    }

    public function destroy($id)
    {
        $userImage = UserImage::find($id);
        if (!$userImage) return response()->json(['message' => 'User Image not found'], 404);

        $userImage->delete();

        return response()->json(['message' => 'User Image deleted']);
    }
}
