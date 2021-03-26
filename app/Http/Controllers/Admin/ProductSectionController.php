<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\ProductSection;

class ProductSectionController extends Controller
{
    
    public function index()
    {
        $title = "Product Section List";
        $product_section_list = ProductSection::orderBy('order_by','ASC')->get();

        return view('admin.productSection.index')->with(compact('title','product_section_list'));
    }

    public function add(Request $request){
        $title = "Add New Product Section";
        if(count($request->all()) > 0){
            $this->validate(request(), [
                'name' => 'required|unique:product_sections',
                'image_width' => 'nullable|numeric',
                'image_height' => 'nullable|numeric',
                'order_by' => 'required|numeric',
                'status' => 'required|numeric',
            ]);

            $product_section = ProductSection::create( [
                'name' => $request->name,   
                'image_width' => $request->image_width,   
                'image_height' => $request->image_height, 
                'content_section' => $request->content_section,   
                'order_by' => $request->order_by,   
                'status' => $request->status,   
            ]);

           return redirect(route('productsection.index'))->with('msg','Product Section Created Successfully');
        }else{
            return view('admin.productSection.add')->with(compact('title'));
        }
    }

    public function edit(Request $request,$id){
        $title = "Edit Product Section";
        $product_section = ProductSection::find($id);
        if(count($request->all()) > 0){
            $this->validate(request(), [
                'name' => 'required',
                'image_width' => 'nullable|numeric',
                'image_height' => 'nullable|numeric',
                'order_by' => 'required|numeric',
                'status' => 'required|numeric',
            ]);

            $product_section->update( [
                'name' => $request->name,   
                'image_width' => $request->image_width,   
                'image_height' => $request->image_height, 
                'content_section' => $request->content_section,
                'order_by' => $request->order_by,   
                'status' => $request->status,   
            ]);

           return redirect(route('productsection.index'))->with('msg','Product Section Updated Successfully');
        }else{
            return view('admin.productSection.edit')->with(compact('title','product_section'));
        }
    }

    public function status(Request $request)
    {
        if($request->ajax())
        {
            $data = ProductSection::find($request->section_id);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('productSection.index')) -> with( 'message', 'Wrong move!');
    }

    public function delete(Request $request,$id = NULL)
    {   
        if($request->section_id){
            $section_id = $request->section_id; 
        }else{
            $section_id = $id;
        }

        $product_section = ProductSection::find($section_id);
        ProductSection::where('id',$section_id)->delete(); 
        return redirect(route('productsection.index'))->with('msg','Product Section Deleted Successfully');
    }

}
