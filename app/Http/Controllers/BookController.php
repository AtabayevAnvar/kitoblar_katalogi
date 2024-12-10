<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Book;


class BookController extends Controller
{
    

    public function store(Request $request)
    {
    
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $imgUrl = $request->file('image')->store('books', 'public');
        } else {
            $imgUrl = 'img/standart-book.png'; // Standart rasm
        }

        if ($user) {
            DB::table("books")->insert([
                'user_id' => $user->id,
                'name' => $request->name,
                'author' => $request->author,
                'genre' => $request->genre,
                'year' => $request->year,
                'img_url' =>$imgUrl,
                'book_url' => $request->file('pdf')->store('pdf', 'public'),
                'description' => $request->description,
                'rate' => 0,
            ]);



            // $request->file('image')->store('images', 'public'),
                // Rasmni saqlash yoki standart rasmni qo‘llash
    

        } else {
            return redirect('login/');
        }

        return redirect('/');
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
        // Kitobni topamiz
    $book = Book::find($id);

    if ($book) {
        $book->delete(); // Ma'lumotlar bazasidan o'chirish
        return redirect()->back()->with('success', 'Kitob muvaffaqiyatli o‘chirildi.');
    }

    return redirect()->back()->with('error', 'Kitob topilmadi.');
    }
}
