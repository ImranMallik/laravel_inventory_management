<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    public function index()
    {
        $warehouses = WareHouse::latest()->get();
        return view('admin.ware-house.index', compact('warehouses'));
    }

    public function create()
    {
        return view('admin.ware-house.create');
    }
}
