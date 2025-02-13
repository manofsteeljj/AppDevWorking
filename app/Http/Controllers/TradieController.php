<?php
namespace App\Http\Controllers;

use App\Models\Tradie;
use Illuminate\Http\Request;

class TradieController extends Controller
{
    public function index()
    {
        return response()->json(Tradie::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'contact_number' => 'required|string',
            'occupation' => 'required|string',
        ]);

        $tradie = Tradie::create($validated);

        return response()->json($tradie, 201);
    }

    public function show($id)
    {
        $tradie = Tradie::findOrFail($id);
        return response()->json($tradie, 200);
    }

    public function update(Request $request, $id)
    {
        $tradie = Tradie::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'birthdate' => 'date',
            'address' => 'string',
            'contact_number' => 'string',
            'occupation' => 'string',
        ]);

        $tradie->update($validated);

        return response()->json($tradie, 200);
    }

    public function destroy($id)
    {
        $tradie = Tradie::findOrFail($id);
        $tradie->delete();

        return response()->json(['message' => 'Tradie deleted'], 200);
    }
}
