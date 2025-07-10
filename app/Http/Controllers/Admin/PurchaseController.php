<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
  public function index()
  {
    $allData = Purchase::orderBy('id', 'desc')->get();
    return view('admin.purchase.index', compact('allData'));
  }

  public function create()
  {
    $suppliers = Supplier::all();
    $warehouses = WareHouse::all();
    return view('admin.purchase.create', compact('suppliers', 'warehouses'));
  }

  public function purchaseProductSearch(Request $request)
  {
    $query = trim($request->input('query'));
    $warehouse_id = $request->input('warehouse_id');

    $products = Product::where(function ($q) use ($query) {
      $q->where('name', 'like', "%{$query}%")
        ->orWhere('code', 'like', "%{$query}%");
    })
      ->when($warehouse_id, function ($q) use ($warehouse_id) {
        $q->where('warehouse_id', $warehouse_id);
      })
      ->select('id', 'name', 'code', 'price', 'product_qty')
      ->orderBy('name')
      ->limit(10)
      ->get();
  }
}
