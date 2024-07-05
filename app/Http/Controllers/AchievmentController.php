<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Achievment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AchievmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        //get achievment data
        $achievment_data = Achievment::first();
        return view('backend.achievments.edit',[
            'achievment' => $achievment_data
        ]);
    }

    public function edit(Request $request){

        // dd($request->all());
        $achievment = Achievment::first();

        $validator = Validator::make($request->all(),[
            'projects' => 'required',
            'coffees' => 'required',
            'satisfied' => 'required',
            'feedback' => 'required',
        ]);

        
        if($validator->fails()){
            Alert::error('Erreur', "Error validation... ");
            return redirect()->back();
        }
     
        if(!empty($achievment)){
            $achievment = Achievment::first();
            
            $achievment->projects = $request->projects;
            $achievment->coffees = $request->coffees;
            $achievment->satisfied = $request->satisfied;
            $achievment->feedback = $request->feedback;

            $achievment->save();
        }else{
            $achievment = Achievment::create([
                'projects' => $request->projects,
                'coffees' => $request->coffees,
                'satisfied' => $request->satisfied,
                'feedback' => $request->feedback,
            ]);
        }

        Alert::success('Success', "Done ... ");
        return redirect()->back();
      
    }
}
