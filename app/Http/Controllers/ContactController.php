<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Contact;
use App\Menu;
use App\Settings;

class ContactController extends Controller
{
    public function contacts(Request $request){
        $this->validate(request(), [
            'contactName' => 'required',
            'contactEmail' => 'required|email',
            'contactTitle' => 'required',
            'contactMessage' => 'required',
        ],
        [
           'contactName.required'=>'Please write your full name', 
           'contactEmail.required'=>'Please give your valid emaill address', 
           'contactTitle.required'=>'Please write your email subject', 
           'contactMessage.required'=>'Please write your message in message body', 
           'contactEmail.email'=>'Your email address not valid', 
        ]
    );
    
        $information = Settings::where('id',1)->first();
        $to = $information->siteEmail1;
        $subject = $request->contactTitle;
        $message = $request->contactMessage;
    
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: '.$request->contactName.'<$information->siteEmail1>' . PHP_EOL;
        $headers .= 'Reply-To: '.$request->contactEmail. "\r\n";
            
       if(mail($to, $subject, $message,$headers)){
            $contact = Contact::create( [     
                'contactName' => $request->contactName,             
                'contactPhone' => $request->contactPhone, 
                'contactEmail' => $request->contactEmail, 
                'contactTitle' => $request->contactTitle,            
                'contactMessage' => $request->contactMessage,            
                          
            ]);
       }

    }

}