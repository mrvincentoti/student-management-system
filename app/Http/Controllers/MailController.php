<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendMail()
   {    
        Mail::to('vincent.oti@layer3.com.ng')->send(new OrderShipped());
   }
}
