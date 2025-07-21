<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $allData = Sale::orderBy('id', 'desc')->get();
        return view('admin.sale.index', compact('allData'));
    }
}
