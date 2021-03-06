<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Newsletters;

class NewsletterController extends Controller
{
	public function index()
    {
        $title = "News Letters Subscriber";
        $subscribers = Newsletters::all();
        return view('admin.newsletters.index')->with(compact('title','subscribers'));
    }
    
    public function destroy(Newsletters $newsletters, Request $request)
    {
        if($request->ajax())
        {
            $newsletters->delete();
            print_r(1);       
            return;
        }

        $newsletters->delete();
        return redirect(route('subscribers.index')) -> with( 'message', 'Deleted Successfully');
    }
}
