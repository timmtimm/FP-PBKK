<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserSubscribed;
use Illuminate\Support\Facades\Cache;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('newsletter.index');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' =>'required|unique:newsletter,email'
        ]);
        event(new UserSubscribed($request->input('email')));
        return back();
    }
}
