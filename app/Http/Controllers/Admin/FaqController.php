<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Faq;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::all();
        $title = 'Frequenlty Aksed and Questions';
        return view('admin.faq.index')->with(compact('faqs','title'));
    }


    public function addfaq(){
        return view('admin.faq.addfaq');
    }

    public function savefaq(Request $request){
        $this->validation($request);

        $faq = Faq::create( [
            'title' => $request->title,
            'description' => $request->description,
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
            'orderBy' => $request->orderBy, 
            'status' => $request->status,
                   
        ]);

        return redirect(route('faqs.index'))->with('msg','Faq Added Successfully');     
    }

    public function editfaq($id){
        $faq = Faq::where('id',$id)->first();
       
        return view('admin.faq.updatefaq')->with(compact('faq'));
    }

    public function updatefaq(Request $request){
        $this->validation($request);
        $faqId = $request->faqId;

        $faq = Faq::find($faqId);

        $faq->update( [
           	'title' => $request->title,
            'description' => $request->description,
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
            'orderBy' => $request->orderBy, 
            'status' => $request->status,           
        ]);

        // $faq = faq::create($request->all());

        return redirect(route('faqs.index'))->with('msg','FAQ Updated Successfully');     
    }

    public function destroy(Faq $faq, Request $request)
    {
        if($request->ajax())
        {
            $faq->delete();
            print_r(1);       
            return;
        }

        $faq->delete();
        return redirect(route('faqs.index')) -> with( 'message', 'Deleted Successfully');
    }

    

    public function changeStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = Faq::find($request->faq_id);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('faqs.index')) -> with( 'message', 'Wrong move!');
    }

    public function validation(Request $request)
    {
        $this->validate(request(), [
             'title' => 'required',
            'description' => 'required',    
        ]);
    }
}