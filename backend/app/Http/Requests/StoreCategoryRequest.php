<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Nếu bạn có kiểm tra quyền, hãy điều chỉnh ở đây
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường tên là bắt buộc.',
            'name.unique' => 'Trường tên đã tồn tại.',
            'description.max' => 'Mô tả tối đa 50 ký tự.',
        ];
    }
}
