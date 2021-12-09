<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StockController extends Controller
{
    public function pharmacyIndex(): \Inertia\Response
    {
        return Inertia::render('Pharmacy/Stock/Index');
    }
}
