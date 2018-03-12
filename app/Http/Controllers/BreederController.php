<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreederController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:breeder');
    }

    /**
     * Show Breeder's homepage view
     *
     * @return void
     */
    public function index()
    {
        return view('users.breeder.home');
    }

    /**
     * Show Breeder's swines connected to the
     * SwineCart application
     *
     * @return void
     */
    public function viewSwineCartPage()
    {
        return view('users.breeder.swinecart');
    }
}
