<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if($user){
            if($user->hasRole('user boshqarish')){
                $users = User::all(); // Foydalanuvchilarni olish
                return view('users.index', compact('users'));
            }
        }
        return redirect('/');
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy($id)
    {
        // $this->authorize('delete', $user); // Admin uchun o'chirish ruxsati

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Foydalanuvchi o‘chirildi!');
    }

}
