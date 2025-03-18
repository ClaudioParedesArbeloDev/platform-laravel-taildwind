<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMailable;
use App\Rules\Recaptcha;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => ['required', new Recaptcha],

        ]);


        Mail::to('claudioparedesarbelo@gmail.com')
            ->send(new ContactMailable($request->all()));

            session()->flash('message', 'Su mensaje ha sido enviado');


            return redirect()->route('contact.index');


    }
}
