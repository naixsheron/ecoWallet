<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Obțineți toate înregistrările din tabela 'books', sortate după id în ordine descrescătoare
        $books = Book::orderByDesc('id')->paginate(8);

        // Obțineți datele cărților grupate în funcție de lună
        $data = Book::select('id', 'created_at')
            ->get()
            ->groupBy(function ($book) {
                return Carbon::parse($book->created_at)->format('Y');
            });

        // Inițializați un array pentru lunile și numărul de cărți
        $months = [];
        $monthCount = [];

        // Parcurgeți datele și adăugați lunile și numărul de cărți în array-urile corespunzătoare
        foreach ($data as $month => $values) {
            $months[] = $month;
            $monthCount[] = count($values);
        }

        // Puteți utiliza doar o singură dată 'return view' pentru a trimite toate datele la șablon
        return view('layouts.book.index', [
            'books' => $books,
            'data' => $data,
            'months' => $months,
            'monthCount' => $monthCount,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.book.create');
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
            'pages' => ['max:200'],
            'details' => ['max:500']
        ]);
        $book = new Book();

        $imagePath =  $this->uploadImage($request, 'banner', 'uploads');
        $book->banner =  $imagePath;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->pages = $request->pages;
        $book->details = $request->details;
        $book->save();

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
