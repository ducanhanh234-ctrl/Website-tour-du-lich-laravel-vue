<?php

namespace App\Http\Controllers;

use App\Http\Requests\TourResquest;
use App\Models\Category;
use App\Models\Tour;
use App\Models\TourVersion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $tours = Tour::with('category')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        return Inertia::render('products/index', [
            'tours' => $tours,
            'filters' => [
                'search' => $search,
            ],
        ]);
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
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $hasTour = TourVersion::where('tour_id', $tour->id)->exists();

        if ($hasTour) {
            return back()->with('error', 'Tour đang có đơn hàng nên không thể xóa');
        }
        $tour->delete();
        return redirect()->route('tours.index')->with('success', 'Tour deleted successfully.');
    }
}
