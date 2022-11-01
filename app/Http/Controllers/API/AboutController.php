<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function edit_about(){
        return About::orderBy('id','desc')->first();
    }

    public function update_about(Request $request,$id){
        //   dd($id, $request->all());
        $about = About::find($id);
         //dd( $request);
         //dd($id, $about->all());
        $this -> validate($request,[
            'name'=>'required',
            'email'=> 'required'
        ]);

        if($about->photo != $request->photo){
            $strpos= strpos($request->photo,";");

            $sub = substr($request->photo,0,$strpos);

            $ex = explode('/',$sub)[1];
            $time = time();
            $namecv = "$time.$ex";
            //dd($namecv);
            $img = Image::make($request->photo)->resize(700,500);

            $upload_path = public_path("/img/upload/");
            $image = $upload_path.$about->photo;
            $img->save($upload_path.$namecv);

            // if (!empty($about->photo)) {
            //     if(file_exists($about->photo)){
            //         @unlink($about->photo);

            //     }
            // }
        }
        // echo("requeesst item:".$request->all());
        //dd($request->namecv);
        $about->name        = $request->name;
        $about->email       = $request->email;
        $about->phone       = $request->phone;
        $about->address     = $request->address;
        $about->description = $request->description;
        $about->tagline     = $request->tagline;
        $about->photo       =  isset($namecv) ? $namecv : $about->photo;
        $about->cv          =  isset($request->namecv) ? $request->namecv : 'null-photo';
        //echo("about :".$about->all());
        //dd($about->description,$about->tagline,$about->photo,$about->cv);
        $about->save();


    }


}
