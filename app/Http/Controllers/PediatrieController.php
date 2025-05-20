<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PediatrieController extends Controller
{
    public function index()
    {
        return view('pediatrie.dashboard');
    }
   
}
