<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }
    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => ['required']
            ]);

            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function delete(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully!',
        ]);
    }

    public function update(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id' => ['required', 'exists:categories,id'],
                'name' => ['required']
            ]);

            $category = Category::findOrfail($request->id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Updated created successfully',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // Product Method
    public function productIndex()
    {
        $allData = Product::orderBy('id', 'desc')->get();
        return view('admin.product.index', compact('allData'));
    }


    public function productCreate()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        return view('admin.product.create', compact('categories', 'brands', 'suppliers', 'warehouses'));
    }
}
