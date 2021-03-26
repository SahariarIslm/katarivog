<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimonial;

class TestimonialController extends Controller
{
    
    public function index()
    {
        $testimonials = Testimonial::orderBy('orderBy','ASC')->get();
        $title = 'Manage All Testimonial';
        return view('admin.testimonials.index')->with(compact('testimonials','title'));
    }

    public function add(Request $request){
        $title = 'Add Testimonial';
        if(count($request->all()) > 0){
            if (isset($request->image)) {
                $image = \App\helperClass::UploadImage($request->image,'testimonials','images/testimonials/','270','270');
            }
           $testimonial = Testimonial::create( [     
                'name' => $request->name,
                'department' => $request->department,
                'institute' => $request->institute,
                'country' => $request->country,
                'title' => $request->title,        
                'image' => @$image,        
                'description' => $request->description,                 
                'orderBy' => $request->orderBy,
                'status' => $request->status,      
            ]); 

           return redirect(route('testimonial.index'))->with('msg','Testimonial Created Successfully');
        }else{
            return view('admin.testimonials.add')->with(compact('title'));
        }
        
    }

    public function edit(Request $request, $id=NULL){
        $title = 'Edit Testimonial';
        $testimonial = Testimonial::find($id);
        if(count($request->all()) > 0){
            if($request->image){
                @unlink($testimonial->image);
                $image = \App\helperClass::UploadImage($request->image,'testimonials','images/testimonials/','270','270');
                $testimonial->update( [
                    'image' => @$image,          
            ]);
        }
            $testimonial->update( [
                'name' => $request->name,
                'department' => $request->department,
                'institute' => $request->institute,
                'country' => $request->country,
                'title' => $request->title,       
                'description' => $request->description,                 
                'orderBy' => $request->orderBy,
                'status' => $request->status,          
            ]);

            return redirect(route('testimonial.index'))->with('msg','Testimonial Updated Successfully'); 
        }else{
            return view('admin.testimonials.edit')->with(compact('testimonial','title'));
        }
    }


    public function status(Request $request)
    {
        if($request->ajax())
        {   
            $data = Testimonial::find($request->testimonialId);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }

    }

    public function delete(Request $request,$id = NULL)
    {   
        if($request->testimonialId){
            $testimonialId = $request->testimonialId; 
        }else{
            $testimonialId = $id;
        }

        $testimonial = Testimonial::find($testimonialId);
        @unlink($testimonial->image); 
        Testimonial::where('id',$testimonialId)->delete();
        return redirect(route('testimonial.index'))->with('msg','Testimonial Deleted Successfully'); 
    }
  
}
