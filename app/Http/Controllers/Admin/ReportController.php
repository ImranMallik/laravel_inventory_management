<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SaleReturn;
use App\Models\SaleReturnItem;
use App\Models\ReturnPurchase;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['purchaseItems.product', 'supplier', 'warehouse'])->get();
        return view('admin.report.index', compact('purchases'));
    }

    // Filter Purchase
    public function filterPurchase(Request $request)
    {
        $query = Purchase::with(['supplier', 'warehouse', 'purchaseItems.product']);
        $today = Carbon::today();
        $filter = $request->input('filter');
        switch ($filter) {
            case 'today':
                $query->whereDate('date', $today);
                break;
            case 'this_week':
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereMonth('date', Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('date', Carbon::now()->subMonth()->month);
                break;
            case 'custom':
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                $query->whereBetween('date', [$start, $end]);
                break;
        }

        $purchases = $query->get();

        $data = [];

        foreach ($purchases as $purchase) {
            foreach ($purchase->purchaseItems as $item) {
                $data[] = [
                    'date' => $purchase->date,
                    'supplier' => $purchase->supplier->name ?? 'N/A',
                    'warehouse' => $purchase->warehouse->name ?? 'N/A',
                    'product' => $item->product->name ?? 'N/A',
                    'quantity' => $item->quantity ?? 'N/A',
                    'net_unit_cost' => $item->net_unit_cost ?? 'N/A',
                    'status' => $purchase->status ?? 'N/A',
                    'grand_total' => $purchase->grand_total ?? 'N/A',
                ];
            }
        }

        return response()->json(['data' => $data]);
    }

    public function purchaseReturn()
    {
        $returnPurchases = ReturnPurchase::with(['return_purchase_items.product', 'supplier', 'warehouse'])->get();
        return view('admin.report.purchase_return', compact('returnPurchases'));
    }

    public function filterPurchaseReturn(Request $request)
    {
        $query = ReturnPurchase::with(['return_purchase_items.product', 'supplier', 'warehouse']);
        $today = Carbon::today();
        $filter = $request->input('filter');
        switch ($filter) {
            case 'today':
                $query->whereDate('date', $today);
                break;
            case 'this_week':
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereMonth('date', Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('date', Carbon::now()->subMonth()->month);
                break;
            case 'custom':
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                $query->whereBetween('date', [$start, $end]);
                break;
        }

        $purchaseReturns = $query->get();

        $data = [];

        foreach ($purchaseReturns as $puchaseReturns) {
            foreach ($puchaseReturns->return_purchase_items as $item) {
                $data[] = [
                    'date' => $puchaseReturns->date,
                    'supplier' => $puchaseReturns->supplier->name ?? 'N/A',
                    'warehouse' => $puchaseReturns->warehouse->name ?? 'N/A',
                    'product' => $item->product->name ?? 'N/A',
                    'quantity' => $item->quantity ?? 'N/A',
                    'net_unit_cost' => $item->net_unit_cost ?? 'N/A',
                    'status' => $puchaseReturns->status ?? 'N/A',
                    'grand_total' => $puchaseReturns->grand_total ?? 'N/A',
                ];
            }
        }

        return response()->json(['data' => $data]);
    }

    public function saleReport(){
         $sales = Sale::with(['saleItems.product', 'customer', 'warehouse'])->get();
        return view('admin.report.sale', compact('sales'));
    }
    public function filterSale(Request $request){
          $query = Sale::with(['saleItems.product', 'customer', 'warehouse']);
        $today = Carbon::today();
        $filter = $request->input('filter');
        switch ($filter) {
            case 'today':
                $query->whereDate('date', $today);
                break;
            case 'this_week':
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereMonth('date', Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('date', Carbon::now()->subMonth()->month);
                break;
            case 'custom':
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                $query->whereBetween('date', [$start, $end]);
                break;
        }

        $sales = $query->get();

        $data = [];

        foreach ($sales as $sale) {
            foreach ($sale->saleItems as $item) {
                $data[] = [
                    'date' => $sale->date,
                    'customer' => $sale->customer->name ?? 'N/A',
                    'warehouse' => $sale->warehouse->name ?? 'N/A',
                    'product' => $item->product->name ?? 'N/A',
                    'quantity' => $item->quantity ?? 'N/A',
                    'net_unit_cost' => $item->net_unit_cost ?? 'N/A',
                    'status' => $sale->status ?? 'N/A',
                    'grand_total' => $sale->grand_total ?? 'N/A',
                ];
            }
        }

        return response()->json(['data' => $data]);
    }

    public function saleReturnReports(){
         $returnSales = SaleReturn::with(['saleReturnItems.product', 'customer', 'warehouse'])->get();
        return view('admin.report.sale_return', compact('returnSales'));
    }
    public function saleReturnFilter(Request $request){
           $query = SaleReturn::with(['saleReturnItems.product', 'customer', 'warehouse']);
        $today = Carbon::today();
        $filter = $request->input('filter');
        switch ($filter) {
            case 'today':
                $query->whereDate('date', $today);
                break;
            case 'this_week':
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereMonth('date', Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('date', Carbon::now()->subMonth()->month);
                break;
            case 'custom':
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                $query->whereBetween('date', [$start, $end]);
                break;
        }

        $saleReturns = $query->get();

        $data = [];

        foreach ($saleReturns as $saleReturn) {
            foreach ($saleReturn->saleReturnItems as $item) {
                $data[] = [
                    'date' => $saleReturn->date,
                    'customer' => $saleReturn->customer->name ?? 'N/A',
                    'warehouse' => $saleReturn->warehouse->name ?? 'N/A',
                    'product' => $item->product->name ?? 'N/A',
                    'quantity' => $item->quantity ?? 'N/A',
                    'net_unit_cost' => $item->net_unit_cost ?? 'N/A',
                    'status' => $saleReturn->status ?? 'N/A',
                    'grand_total' => $saleReturn->grand_total ?? 'N/A',
                ];
            }
        }

        return response()->json(['data' => $data]);
    }
}
