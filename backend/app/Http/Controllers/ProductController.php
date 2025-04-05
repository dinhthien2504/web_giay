<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreProductRequest $request)
    // {
    //     //
    // }
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Lấy tên file gốc
            $imageName = time() . '_' . $image->getClientOriginalName();
            // Xác định đường dẫn tuyệt đối đến thư mục frontend/public/img/
            $frontendPath = base_path('../frontend/public/img/' . $imageName);

            // Di chuyển ảnh vào thư mục frontend
            $image->move(dirname($frontendPath), basename($frontendPath));
            // Tạo sản phẩm
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'image' => $imageName
            ]);
        }
        return response()->json(['message' => 'Sản phẩm đã được thêm!', 'product' => $product], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Sản phẩm không tồn tại'
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'product' => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Đã xảy ra lỗi server.',
                'error' => $e->getMessage() // có thể bỏ dòng này khi lên production
            ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
