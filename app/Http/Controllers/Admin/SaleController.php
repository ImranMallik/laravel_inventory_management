<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $allData = Sale::orderBy('id', 'desc')->get();
        return view('admin.sale.index', compact('allData'));
    }

    public function create()
    {
        $customers = Customer::all();
        $warehouses = WareHouse::all();
        return view('admin.sale.create', compact('customers', 'warehouses'));
    }
}
