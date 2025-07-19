<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\ReturnPurchase;
use Illuminate\Http\Request;

class ReturnPurchaseController extends Controller
{
    public function index()
    {
        $allData = ReturnPurchase::orderBy('id', 'desc')->get();
        return view('admin.purchase.purchase-return.index', compact('allData'));
    }
}
