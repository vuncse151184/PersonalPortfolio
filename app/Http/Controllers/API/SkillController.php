<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
class SkillController extends Controller
{
    public function get_all_skill(){
        $skills = Skill::with('service')->orderBy('id','DESC')->get();

        return response()->json([
            'skills'=>$skills
            ],200);
    }

    public function create_skill(Request $request){

        $skill = new Skill();
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->service_id = $request->service_id;
        $skill->save();
    }

    public function update_skill(Request $request,$id){
        $skill = Skill::find($id);
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->service_id = $request->service_id;
        $skill->save();
    }

    public function delete_skill( $id){
        $skill= Skill::findOrFail($id);
        $skill->delete();
    }
}
