<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
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
    public function store(StoreCategoryRequest $request)
    {
        // Lấy dữ liệu từ request
        $data = $request->validated();

        // Tạo danh mục mới
        $category = Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        // Trả về response nếu tạo thành công
        return response()->json([
            'message' => 'Thêm danh mục thành công',
            'category' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // Lấy dữ liệu từ request đã được xác thực
        $data = $request->validated();

        // Cập nhật danh mục
        $category->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        // Trả về phản hồi nếu cập nhật thành công
        return response()->json([
            'message' => 'Cập nhật danh mục thành công',
            'category' => $category,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // Kiểm tra nếu danh mục có sản phẩm liên quan
        if ($category->products()->exists()) {
            return response()->json([
                'message' => 'Không thể xóa vì có sản phẩm đang thuộc danh mục này.'
            ], 400);
        }

        // Xóa danh mục
        $category->delete();

        return response()->json([
            'message' => 'Danh mục đã được xóa thành công.'
        ], 200);
    }
}
