<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use App\Mail\ContactMailable;


class ContactController extends Controller
{
    public function index(){
        return view('pages.contacto');
    }

    public function store(Request $request){


        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:3000',


        ]);


        Mail::to('claudioparedesarbelo@gmail.com')
            ->send(new ContactMailable($request->all()));

            session()->flash('message', 'Su mensaje ha sido enviado');


            return redirect()->route('contact.index');


    }
}