<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_users = User::all();
        return view('home', compact('all_users'));
    }

    function contactmessageview()
    {
        $contact_messages = Contact::all();
        return view('contact/view', compact('contact_messages'));
    }

    function changemenustatus($category_id)
    {
        if (Category::find($category_id)->menu_status == 0) {
            Category::find($category_id)->update([
                'menu_status' => 1,
            ]);
        }

        else {
            Category::find($category_id)->update([
                'menu_status' => 0,
            ]);
        }
        return back();
    }

    function changemessagestatus($contact_id)
    {
        if (Contact::find($contact_id)->read_status == 1) {
            Contact::find($contact_id)->update([
                'read_status' => 2,
            ]);    
        }

        else {
            Contact::find($contact_id)->update([
                'read_status' => 1,
            ]);
        }
        return back();
    }
}
