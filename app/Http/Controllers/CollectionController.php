<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CollectionController extends Controller
{
    public function pharmacyIndex(): \Inertia\Response
    {
        return Inertia::render('Pharmacy/Collections/Index');
    }
}
