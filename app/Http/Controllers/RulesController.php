<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RulesController extends Controller
{
    //

    public function purchases()
    {
        return view('pages.documentation.shopping-rules');
    }

    public function ageconfirm(Request $request)
    {
        $request->session()->put('ageconfirmation', true);
        return redirect()->back();
    }

    public function cookieAgreement(Request $request)
    {
        $request->session()->put('cookieAgreement', true);
        return redirect()->back();
    }
}
