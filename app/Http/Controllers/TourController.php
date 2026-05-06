<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourResquest;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('category')->get();
        return Inertia::render("products/index", compact('tours'));
    }
    public function create()
    {
        $categories = Category::all();
        return Inertia::render("products/create", compact('categories'));
    }
    public function store(TourResquest $request)
    {
        Tour::create($request->validated());
        return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
    }
    public function show($id)
    {
        $tour = Tour::with('category')->findOrFail($id);
        return Inertia::render("products/show", compact('tour'));
    }
    public function edit(Tour $tour)
    {
        $categories = Category::all();
        return Inertia::render("products/edit", compact('tour', 'categories'));
    }
    public function update(TourResquest $request, Tour $tour)
    {
        $tour->update($request->validated());
        return redirect()->route('tours.index')->with('success', 'Tour updated successfully.');
    }
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('tours.index')->with('success', 'Tour deleted successfully.');
    }
}
