<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        return response()->json(User::all());
    }

    // Ver un usuario específico
    public function show($id)
    {
        $user = User::find($id);

        if (!$user)
            return response()->json(['message' => 'Usuario no encontrado'], 404);

        return response()->json($user);
    }

    // Actualizar datos de un usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user)
            return response()->json(['message' => 'Usuario no encontrado'], 404);

        $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'sometimes|string|min:6',
        ]);

        $data = $request->only(['first_name', 'last_name', 'email', 'phone']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json($user);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user)
            return response()->json(['message' => 'Usuario no encontrado'], 404);

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
