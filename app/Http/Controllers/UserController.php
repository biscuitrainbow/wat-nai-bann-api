<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;


class UserController extends Controller
{
    public function print()
    {
        //return view('user.card');

        $pdf = PDF::loadView('user.card');
        return $pdf->download('invoice.pdf');
    }
}
