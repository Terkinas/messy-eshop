<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function contact()
    {
        return view('pages.support.contact');
    }

    public function faq()
    {
        return view('pages.support.DUK');
    }

    public function termsandagreements()
    {
        return view('pages.support.terms');
    }

    public function returns()
    {
        return view('pages.support.returns');
    }

    public function privacy()
    {
        return view('pages.support.privacypolicy');
    }
}
