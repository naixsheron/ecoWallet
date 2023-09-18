<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Code;

use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CodeController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $codes = Code::orderByDesc('id')->paginate(8);

        $data = Code::select('id', 'created_at', 'hours')->get()->groupBy(function ($code) {
            return Carbon::parse($code->created_at)->format('Y');
        });
        $months = [];
        $monthCount = [];
        foreach ($data as $month => $values) {
            $months[] = $month;
            $monthCount[] = $values->sum('hours');;
        }
        $totalGolds = \App\Models\Code::count();
        // dd($monthCount);
        return view('layouts.code.index', [
            'codes' => $codes,
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
        return view('layouts.code.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'max:2000', 'image'],
            'title' => ['required', 'string', 'max:200'],

            'hours' => ['max:200'],
            'details' => ['max:500']
        ]);
        $code = new Code();

        $imagePath =  $this->uploadImage($request, 'banner', 'uploads');
        $code->banner =  $imagePath;
        $code->title = $request->title;
        $code->hours = $request->hours;

        $code->details = $request->details;
        $code->save();

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
