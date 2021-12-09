<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function pharmacyIndex(): \Inertia\Response
    {
        return Inertia::render('Pharmacy/Orders/Index');
    }
}
