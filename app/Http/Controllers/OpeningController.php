<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Opening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OpeningController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        //get opening data
        $opening_data = Opening::first();
        return view('backend.opening.edit',[
            'opening' => $opening_data
        ]);
    }

    public function edit(Request $request){

        // dd($request->all());
        $opening = Opening::first();

        $validator = Validator::make($request->all(),[
            'full_name' => 'required',
            'first_role' => 'required',
            'second_role' => 'required',
            'third_role' => 'required',
        ]);

        
        if($validator->fails()){
            Alert::error('Erreur', "Error validation... ");
            return redirect()->back();
        }
     
        if(!empty($opening)){
            $opening = Opening::first();
            
            $opening->full_name = $request->full_name;
            $opening->first_role = $request->first_role;
            $opening->second_role = $request->second_role;
            $opening->third_role = $request->third_role;
            $opening->github = $request->github;
            $opening->linkedin = $request->linkedin;
            $opening->youtube = $request->youtube;
            $opening->instagram = $request->instagram;

            $opening->save();
        }else{
            $opening = Opening::create([
                'full_name' => $request->full_name,
                'first_role' => $request->first_role,
                'second_role' => $request->second_role,
                'third_role' => $request->third_role,
                'youtube' => $request->youtube,
                'github' => $request->github,
                'linkedin' => $request->linkedin,
                'instagram' => $request->instagram,
            ]);
        }

        Alert::success('Success', "Done ... ");
        return redirect()->back();
      

    }
}
