<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletters;

class NewsletterController extends Controller
{

    public function SubscriberEmailSave(Request $request){
    	$this->validate(request(), [
            'subscriberEmail' => 'required|email|unique:newsletters',
        ]);

         $contact = Newsletters::create( [     
            'subscriberEmail' => $request->subscriberEmail,             

        ]);

         return redirect(route('home.index'))->with('msg','You are Successfully Subscribed');

    }
}
