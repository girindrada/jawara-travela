<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageTourRequest;
use App\Http\Requests\UpdatePackageTourRequest;
use App\Models\Category;
use App\Models\PackageTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PackageTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageTours = PackageTour::with('category')->latest()->paginate(10);
        return view('admin.package_tours.index', compact('packageTours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.package_tours.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageTourRequest $request)
    {
        // dd($request);
        DB::transaction(function() use ($request){
            $validated = $request->validated();

            if($request->hasFile('thumbnail')){
                $tourThumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
                $validated['thumbnail'] = $tourThumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $newPackageTour = PackageTour::create($validated);

            if($request->hasFile('photos')){
                // attribute photos di-blade create merupakan array karena membawa data lebih dari 1
                foreach($request->file('photos') as $photo){
                    $photoTourPath = $photo->store('package_photos/' . date('Y/m/d'), 'public');
                    
                    /**
                     * relasi yang dibuat pada Model bisa digunakan untuk melakukan operasi CRUD
                     * jadi tidak hanya untuk retrieve data saja, tapi bisa untuk operasi create, update dan delete
                     */
                    $newPackageTour->package_photos()->create([
                        'photo' => $photoTourPath,
                    ]);
                }
            }
        });

        return redirect()->route('admin.package_tours.index')->with('success', 'tour data added succsesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageTour $packageTour)
    {
        $latestPhotos = $packageTour->package_photos()->latest()->take(2)->get();
        return view('admin.package_tours.show', compact('packageTour', 'latestPhotos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageTour $packageTour)
    {
        $categories = Category::latest()->get();
        $latestPhotos = $packageTour->package_photos()->latest()->take(2)->get();
        
        return view('admin.package_tours.edit', compact('packageTour', 'latestPhotos', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageTourRequest $request, PackageTour $packageTour)
    {
         DB::transaction(function() use ($request, $packageTour){
            $validated = $request->validated();

            if($request->hasFile('thumbnail')){
                $tourThumbnailPath = $request->file('thumbnail')->store('thumbnail', 'public');
                $validated['thumbnail'] = $tourThumbnailPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $packageTour->update($validated);

            if($request->hasFile('photos')){
                // attribute photos di-blade create merupakan array karena membawa data lebih dari 1
                foreach($request->file('photos') as $photo){
                    $photoTourPath = $photo->store('package_photos/' . date('Y/m/d'), 'public');
                    $packageTour->package_photos()->create([
                        'photo' => $photoTourPath,
                    ]);
                }
            }
        });

        return redirect()->route('admin.package_tours.index')->with('success', 'tour data updated succsesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageTour $packageTour)
    {
        DB::transaction(function() use ($packageTour){
            $packageTour->delete();
        });

        return redirect()->route('admin.package_tours.index')->with('success', 'tour data deleted succsesfully');
    }
}
