<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\ImageUploadTrait;
use App\Models\Money;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MoneyController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $moneys = Money::orderByDesc('id')->paginate(8);

        $data = Money::select('id', 'created_at', 'price')->get()->groupBy(function ($money) {
            return Carbon::parse($money->created_at)->format('Y');
        });

        $months = [];
        $monthPrice = []; // Folosim $monthPrice în loc de $monthCount
        foreach ($data as $month => $values) {
            $months[] = $month;
            $monthPrice[] = $values->sum('price'); // Sumăm prețurile pentru fiecare lună
        }

        $totalGolds = \App\Models\Money::count();

        return view('layouts.money.index', [
            'moneys' => $moneys,
            'data' => $data,
            'months' => $months,
            'monthPrice' => $monthPrice, // Am schimbat numele variabilei aici
            'totalGolds' => $totalGolds // Am corectat acest array asociativ
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.money.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'banner' => ['required', 'max:2000', 'image'],
                'title' => ['required', 'string', 'max:200'],
                'price' => ['max:200'],
                'details' => ['max:500']
            ]);
            $money = new Money();

            $imagePath =  $this->uploadImage($request, 'banner', 'uploads');
            $money->banner =  $imagePath;
            $money->title = $request->title;
            $money->price = $request->price;
            $money->details = $request->details;
            $money->save();

            toastr('Created successfuly!', 'success');

            return redirect()->back();
        }
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
