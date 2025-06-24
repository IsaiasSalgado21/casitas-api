<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Refund;

class RefundController extends Controller
{
    public function index()
    {
        return response()->json(Refund::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'refund_amount' => 'required|numeric',
            'reason' => 'nullable|string',
            'refund_date' => 'nullable|date',
        ]);

        $refund = Refund::create($request->all());

        return response()->json($refund, 201);
    }

    public function show($id)
    {
        $refund = Refund::find($id);
        if (!$refund) return response()->json(['message' => 'Refund not found'], 404);
        return response()->json($refund);
    }

    public function update(Request $request, $id)
    {
        $refund = Refund::find($id);
        if (!$refund) return response()->json(['message' => 'Refund not found'], 404);

        $request->validate([
            'payment_id' => 'sometimes|exists:payments,id',
            'refund_amount' => 'sometimes|numeric',
            'reason' => 'nullable|string',
            'refund_date' => 'nullable|date',
        ]);

        $refund->update($request->all());

        return response()->json($refund);
    }

    public function destroy($id)
    {
        $refund = Refund::find($id);
        if (!$refund) return response()->json(['message' => 'Refund not found'], 404);

        $refund->delete();

        return response()->json(['message' => 'Refund deleted']);
    }
}
    