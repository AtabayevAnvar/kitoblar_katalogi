<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if($user){
            if($user->hasRole('admin')){
                $users = User::all(); // Foydalanuvchilarni olish
                return view('users.index', compact('users'));
            }
        }
        return redirect('/');
    }

    public function destroy($id)
    {
        // $this->authorize('delete', $user); // Admin uchun o'chirish ruxsati

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Foydalanuvchi o‘chirildi!');
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);

        // Foydalanuvchidan 'active' ruxsatini olib tashlash
        $user->revokePermissionTo('active');

        // Foydalanuvchiga 'passive' ruxsatini berish
        $user->givePermissionTo('passive');

        return redirect()->back()->with('success', "Foydalanuvchi bloklandi!");
    }

    
    public function unblockUser($id)
    {
        $user = User::findOrFail($id);

        // Foydalanuvchidan 'passive' ruxsatini olib tashlash
        $user->revokePermissionTo('passive');

        // Foydalanuvchiga 'active' ruxsatini berish
        $user->givePermissionTo('active');

        return redirect()->back()->with('success', "Foydalanuvchi blokdan chiqarildi!");
    }
}
