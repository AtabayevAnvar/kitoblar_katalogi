<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RateController extends Controller
{
    public function rate(Request $request)
    {
        $user = Auth::user(); // Hozirgi tizimga kirgan foydalanuvchini olish
        if(!$user){
            return redirect('/login');
        }
        // Foydalanuvchi bahosi va kitob ID sini so'rovdan olish
        $num = $request->input('num');
        $id = $request->input('id');

        // Mazkur foydalanuvchi ushbu kitobni baholagan-baholamaganligini tekshirish
        $rated = DB::table("rates")->where('book_id', $id)->where('user_id', $user->id)->first();
        if ($rated) {
            DB::table("rates")->where('id', $rated->id)->update([     // Agar foydalanuvchi bu kitobni baholagan bo'lsa, bahoni yangilash
                'number' => $num     //Yangi bahoni kirtish
            ]);
        } else {
            DB::table("rates")->insert([
                'book_id' => $id,
                'user_id' => $user->id,
                'number' => $num
            ]);
        }
            // Ushbu kitob uchun barcha baholarni olish
        $rates = DB::table("rates")->where('book_id', $id)->get();
        $sum = 0;
        $c = 0;
        foreach ($rates as $rate) {
            $sum += $rate->number;
            $c += 1;
        }

        DB::table("books")->where('id', $id)->update([
            'rate' => $sum / $c,
        ]);

        //DB::table("rate")->where('')
        return response()->json([
            'message' => "You rated $id, $num stars!",
            'status' => 'success',
        ]);
    }
}
