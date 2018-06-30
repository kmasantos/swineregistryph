<?php

namespace App\Http\Controllers;

use App\Models\Breeder;
use Illuminate\Http\Request;

class ManageBreedersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Show manage breeders page
     *
     * @return View
     */
    public function index()
    {
        $breeders = Breeder::with('farms', 'users')->get();

        foreach ($breeders as $breeder) {
            $breeder->name = $breeder->users->first()->name;
            $breeder->email = $breeder->users->first()->email;
        }

        return view('users.admin.manageBreeders', compact('breeders'));
    }
}
