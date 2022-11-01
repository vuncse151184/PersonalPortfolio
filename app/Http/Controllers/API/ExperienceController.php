<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    function get_all_experience(){
        $experiences = Experience::orderBy('id','desc')->get();
        return response()->json([
            'experiences'=> $experiences,200
        ]);
    }

    function create(){
        
    }
}
