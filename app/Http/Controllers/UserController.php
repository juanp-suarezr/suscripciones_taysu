<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate();
        
        return Inertia::render('Users/Index', [
            'users' => User::all()
        ]);
    }
}
