<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\ImageUploadTrait;

class ProductController extends Controller
{

     use ImageUploadTrait;

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

  
    public function productStore(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name'          => 'required|string|max:255',
                'code'          => 'required|string|max:100|unique:products,code',
                'category_id'   => 'required|exists:categories,id',
                'brand_id'      => 'required|exists:brands,id',
                'price'         => 'nullable|numeric|min:0|max:999999.99',
                'stock_alert'   => 'required|integer|min:0',
                'note'          => 'nullable|string',
                'image'         => 'required',
                'image.*'       => 'image|mimes:jpg,jpeg,png|max:2048',
                'warehouse_id'  => 'required|exists:ware_houses,id',
                'supplier_id'   => 'required|exists:suppliers,id',
                'product_qty'   => 'required|integer|min:0',
                'status'        => 'required|in:Received,Pending',
                'discount'      => 'nullable|numeric|min:0|max:999999.99',
            ]);

            // Upload images
            $uploadedImages = $this->uploadMultiImage($request, 'image', 'uploads/brand');

            // Create product
            $product = new Product();
            $product->name          = $request->name;
            $product->code          = $request->code;
            $product->category_id   = $request->category_id;
            $product->brand_id      = $request->brand_id;
            $product->warehouse_id  = $request->warehouse_id;
            $product->supplier_id   = $request->supplier_id;
            $product->price         = $request->price ?? 0;
            $product->stock_alert   = $request->stock_alert;
            $product->note          = $request->note;
            $product->product_qty   = $request->product_qty;
            $product->discount      = $request->discount ?? 0;
            $product->status        = $request->status;
            $product->active        = '1';
            $product->image         = json_encode([$uploadedImages[0]]);
            $product->save();

            // Store extra images if any
            if (count($uploadedImages) > 1) {
                foreach (array_slice($uploadedImages, 1) as $imgPath) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $imgPath,
                    ]);
                }
            }

            return response()->json([
                'status'  => 'success',
                'message' => 'Product created successfully',
                'data'    => $product
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function productDelete(string $id){
        $product = Product::findOrFail($id);
        $this->deleteImage($product->image);

        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully!',
        ]);

    }

}
