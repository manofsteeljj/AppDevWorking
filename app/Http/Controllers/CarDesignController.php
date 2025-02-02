<?php
namespace App\Http\Controllers;

use App\Models\CarDesign;
use Illuminate\Http\Request;

class CarDesignController extends Controller
{
    public function index()
    {
        $carDesigns = CarDesign::all();
        return view('car_designs.index', compact('carDesigns'));
    }

    public function create()
    {
        return view('car_designs.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'model' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    CarDesign::create($request->only(['name', 'model', 'description'])); // Only pass these fields
    return redirect()->route('car_designs.index')->with('success', 'Car design created successfully.');
    }


    public function show(CarDesign $carDesign)
    {
        return view('car_designs.show', compact('carDesign'));
    }

    public function edit(CarDesign $carDesign)
    {
        return view('car_designs.edit', compact('carDesign'));
    }

    public function update(Request $request, CarDesign $carDesign)
    {
    $request->validate([
        'name' => 'required',
        'model' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    $carDesign->update($request->only(['name', 'model', 'description'])); // Only pass these fields
    return redirect()->route('car_designs.index')->with('success', 'Car design updated successfully.');
    }


    public function destroy(CarDesign $carDesign)
    {
        $carDesign->delete();
        return redirect()->route('car_designs.index')->with('success', 'Car design deleted successfully.');
    }
}
