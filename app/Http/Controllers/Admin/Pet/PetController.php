<?php

namespace App\Http\Controllers\Admin\Pet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(){
        return view('Admin.Pet.index'); 
    }

    public function add(){
        return view('Admin.Pet.add-pet'); 
    }
}
