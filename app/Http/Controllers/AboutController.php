<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;



class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        //get about data
        $about_data = About::first();
        return view('backend.about.edit',[
            'about' => $about_data
        ]);
    }

    public function edit(Request $request){

        // dd($request->all());
        $about = About::first();
        $mycv = '';
        $myphoto = '';

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
            'cv' => 'file|mimes:pdf',
            'photo' => 'image|mimes:jpeg,png,jpg',
            'skill1' => 'required',
            'skill2' => 'required',
            'skill3' => 'required',
            'range1' => 'required',
            'range2' => 'required',
            'range3' => 'required',
        ]);
        
        if($validator->fails()){
            Alert::error('Erreur', "Error validation... ");
            return redirect()->back();
        }
     
        if ($request->hasFile('cv')){
            //get image extension and add time to its name 
            $mycv = time() . '.' . $request->cv->extension();
            //move the image to public folder in the desired path with the name generated above ($mycv)
            $request->cv->move(public_path('cv_attachments/'), $mycv);
            //get the path of the uploaded cv in order to delete it in case new cv is being uploaded to avoid having many images stored in the app without using them
            if(!empty($about)){
                $cv_path = public_path('cv_attachments/'. $about->cv);
                //check wether the cv exists in the folder of application 
                if (File::exists($cv_path)) {
                    // delete it
                    File::delete($cv_path);
                } 
            }
        }

        if ($request->hasFile('photo')){
            //get image extension and add time to its name 
            $myphoto = time() . '.' . $request->photo->extension();
            //move the image to public folder in the desired path with the name generated above ($myphoto)
            $request->photo->move(public_path('photo_attachments/'), $myphoto);
            //get the path of the uploaded cv in order to delete it in case new photo is being uploaded to avoid having many images stored in the app without using them
            if(!empty($about)){
                $photo_path = public_path('photo_attachments/'. $about->photo);
                //check wether the photo exists in the folder of application 
                if (File::exists($photo_path)) {
                    // delete it
                    File::delete($photo_path);
                } 
            }
        }
        if(!empty($about)){
            $about = About::first();
            
            $about->title = $request->title;
            $about->description = $request->description;
            $about->photo = $request->photo == null ? $about->photo : $myphoto ;
            $about->cv = $request->cv == null ? $about->cv : $mycv ;
            $about->skill1 = $request->skill1;
            $about->range1 = $request->range1;
            $about->skill2 = $request->skill2;
            $about->range2 = $request->range2;
            $about->skill3 = $request->skill3;
            $about->range3 = $request->range3;

            $about->save();
        }else{
            $about = About::create([
                'title' => $request->title,
                'description' => $request->description,
                'photo' => $request->photo,
                'cv' => $request->cv,
                'skill1' => $request->skill1,
                'range1' => $request->range1,
                'skill2' => $request->skill2,
                'range2' => $request->range2,
                'skill3' => $request->skill3,
                'range3' => $request->range3,
            ]);
        }

        Alert::success('Success', "Done ... ");
        return redirect()->back();
      

    }
}
