<?php

namespace Softage\Http\Controllers;

use Illuminate\Http\Request;

use Softage\Http\Requests;
use Softage\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return view('default.index');
    }
}
