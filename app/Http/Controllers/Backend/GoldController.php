<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gold;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GoldController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $golds = Gold::orderByDesc('id')->paginate(5);

        $data = Gold::select('id', 'created_at')->get()->groupBy(function ($gold) {
            return Carbon::parse($gold->created_at)->format('Y');
        });
        $months = [];
        $monthCount = [];
        foreach ($data as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }
        $totalGolds = \App\Models\Gold::count();

        return view('layouts.gold.index', [
            'golds' => $golds,
            'data' => $data,
            'months' => $months,
            'monthCount' => $monthCount,
            ['totalGolds' => $totalGolds]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.gold.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'max:2000', 'image'],
            'title' => ['required', 'string', 'max:200'],
            'author' => ['required', 'string', 'max:200'],
            'price' => ['max:200'],
            'details' => ['max:500']
        ]);
        $gold = new Gold();

        $imagePath =  $this->uploadImage($request, 'banner', 'uploads');
        $gold->banner =  $imagePath;
        $gold->title = $request->title;
        $gold->author = $request->author;
        $gold->price = $request->price;
        $gold->details = $request->details;
        $gold->save();

        toastr('Created successfuly!', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
