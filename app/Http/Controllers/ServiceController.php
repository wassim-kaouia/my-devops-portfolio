<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Laravel\Ui\Presets\React;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $services = Service::All();

        return view('backend.services.index',[
            'services' => $services
        ]);
    }

    public function show(Request $request, $id){
        $service = Service::find($id);
        // dd($service->title);

        return view('backend.services.edit',[
            'service' => $service
        ]);
    }

    public function edit(Request $request){

        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
        ]);

        
        if($validator->fails()){
            Alert::error('Erreur', "Error validation... ");
            return redirect()->back();
        }

        $service = Service::find($request->id);

        if ($request->hasFile('service_image')){
            //get image extension and add time to its name 
            $myservice_image = time() . '.' . $request->service_image->extension();
            //move the image to public folder in the desired path with the name generated above ($myphoto)
            $request->service_image->move(public_path('service_images_attachments/'), $myservice_image);
            //get the path of the uploaded cv in order to delete it in case new photo is being uploaded to avoid having many images stored in the app without using them
            if(!empty($service)){
                $service_image_path = public_path('service_images_attachments/'. $service->service_image);
                //check wether the photo exists in the folder of application 
                if (File::exists($service_image_path)) {
                    // delete it
                    File::delete($service_image_path);
                } 
            }
        }

        $service->service_image = $request->service_image == null ? $service->service_image : $myservice_image;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->save();

        Alert::success('Success', "Done ... ! ");
        return redirect()->back();

    }

    public function showCreatePage(Request $request){
        return view('backend.services.create');
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(),[
            'service_image' => 'required|image|mimes:png,jpg,jpeg',
            'title' => 'required',
            'description' => 'required',
        ]);

        
        if($validator->fails()){
            Alert::error('Erreur', "Error validation... ");
            return redirect()->back();
        }

        if ($request->hasFile('service_image')){
            //get image extension and add time to its name 
            $myservice_image = time() . '.' . $request->service_image->extension();
            //move the image to public folder in the desired path with the name generated above ($myphoto)
            $request->service_image->move(public_path('service_images_attachments/'), $myservice_image);      
        }

        $service = new Service();
        $service->service_image = $myservice_image;
        $service->title = $request->title;
        $service->description = $request->description;

        $service->save();

        Alert::success('Success', "Done ... ! ");
        return redirect()->back();

    }

}
