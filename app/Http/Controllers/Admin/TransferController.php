<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        $allData = Transfer::with(['transferItems.product'])->orderBy('id', 'desc')->get();
        return view('admin.transfer.index', compact('allData'));
    }
}
