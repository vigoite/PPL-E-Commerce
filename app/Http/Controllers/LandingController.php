<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'B-Craft'
        ];
        return view('landing', $data);
    }
}
