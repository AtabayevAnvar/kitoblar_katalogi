<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class MybookController extends Controller
{
    public function mybookindex(){

        $user = Auth::user(); // Joriy autentifikatsiya qilingan foydalanuvchini oling

        $books = DB::table('books')
        ->leftJoin('rates', function ($join) use ($user) {
            $join->on('books.id', '=', 'rates.book_id')
                 ->where('rates.user_id', '=', $user->id); // User's rating for the book
        })
        ->where('books.user_id', $user->id) // Only books added by the user
        ->select('books.*', 'rates.number as user_rating')
        ->get();
    return view('mybook', compact('books'));
    }
}
