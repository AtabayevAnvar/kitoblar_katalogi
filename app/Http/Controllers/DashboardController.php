<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Joriy foydalanuvchi, agar tizimga kirmagan bo'lsa, null bo'ladi

        if($user){
            $books = DB::table('books')
            ->leftJoin('rates', function ($join) use ($user) {
                $join->on('books.id', '=', 'rates.book_id');
                if ($user) {
                    $join->where('rates.user_id', '=', $user->id); // Faqat tizimga kirgan foydalanuvchi uchun baholarni bog'lash
                }
            })
            ->select('books.*', 'rates.number as user_rating')
            ->get();
        }else{
            $books = DB::table('books')->get();
        }

        return view('dashboard', compact('books', 'user')); // `user`ni ham viewga yuboramiz
    }
}
