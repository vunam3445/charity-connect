<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Xác định người dùng có được phép gửi request không.
     */
    public function authorize()
    {
        return auth('organization')->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'min_quantity' => 'required|integer|min:1',
            'max_quantity' => 'required|integer|gte:min_quantity',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,png,jpeg|max:2048',
            'organization_id' => 'required|string|exists:organizations,organization_id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên chiến dịch là bắt buộc.',
            'description.required' => 'Mô tả là bắt buộc.',
            'start_date.required' => 'Ngày bắt đầu là bắt buộc.',
            'start_date.after_or_equal' => 'Ngày bắt đầu phải từ hôm nay trở đi.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau ngày bắt đầu.',
            'location.required' => 'Địa điểm là bắt buộc.',
            'min_quantity.required' => 'Số lượng tối thiểu là bắt buộc.',
            'min_quantity.min' => 'Số lượng tối thiểu phải lớn hơn 0.',
            'max_quantity.required' => 'Số lượng tối đa là bắt buộc.',
            'max_quantity.gte' => 'Số lượng tối đa phải lớn hơn hoặc bằng số lượng tối thiểu.',
            'images.*.image' => 'File phải là hình ảnh.',
            'images.*.mimes' => 'Hình ảnh phải có định dạng jpg, png hoặc jpeg.',
            'images.*.max' => 'Hình ảnh không được vượt quá 2MB.',
            'organization_id.required' => 'Mã tổ chức là bắt buộc.',
            'organization_id.exists' => 'Tổ chức không tồn tại.',
        ];
    }
}
