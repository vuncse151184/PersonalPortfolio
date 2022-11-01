<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    function get_all_education(){
        $educations =Education::orderBy('id','desc')->get();
        return response()->json([
            'educations'=>$educations
        ],200);
    }

    function create_education(Request $request){
        $education = new Education();
        $education-> instituation = $request->instituation;
        $education-> period = $request->period;
        $education-> degree = $request->degree;
        $education-> department = $request->department;
        $education->save();
    }

    function update_education(Request $request,$id){
        $education = Education::find($id);

        $education-> instituation = $request->instituation;
        $education-> period = $request->period;
        $education-> degree = $request->degree;
        $education-> department = $request->department;
        $education->save();
    }

    function delete_education($id){
        $education= Education::findOrFail($id);
        $education->delete();
    }

}
