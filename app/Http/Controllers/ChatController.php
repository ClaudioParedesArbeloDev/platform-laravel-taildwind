<?php

namespace App\Http\Controllers;
use App\Events\SendMessage;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return view('dashboard.chat');
    }

    public function broadcast(Request $request)
    {
        broadcast(new SendMessage($request->get('message')))->toOthers();
        return view('dashboard.chat', ['message'=> $request->get('message')]);
    }

    public function receive(Request $request)
    {
        return view('Livewire.ChatList', ['message' => $request->get('message')]);
    }
}
