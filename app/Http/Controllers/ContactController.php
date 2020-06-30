<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'subject' => 'required|min:8',
            'message' => 'required',
        ]);
        
        DB::table('contacts')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => now()
        ]);
        return redirect()->to('/contact')->with('message', 'Your message has been sent. Thank you!');
    }

   //for admins

    public function indexTable()
    {
        return view('layouts.AdminPanel.messages', ['contacts' => DB::table("contacts")->latest("created_at")->paginate(5)]);
    }
    public function destroy($id)
    {
        DB::table("contacts")->delete($id);
        return redirect()->to('/allmessages');
    }
}
