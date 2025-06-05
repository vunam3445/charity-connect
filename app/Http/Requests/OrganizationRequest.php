<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    /**
     * Xác nhận người dùng có quyền gửi request này không
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Các rules validate khi gửi request
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:50|unique:organizations,username',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:organizations,email',
            'fullname' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
            'founded_at' => 'required|date|before_or_equal:today',
            'representative' => 'required|string|max:100',
            'description' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'role' => 'required|string|in:organization,admin',
        ];
    }

    /**
     * (Tùy chọn) Tùy biến thông báo lỗi
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã được sử dụng',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'avatar.image' => 'Ảnh đại diện phải là hình ảnh',
            'avatar.mimes' => 'Định dạng ảnh hợp lệ: jpg, jpeg, png, gif',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'role.in' => 'Vai trò không hợp lệ',
        ];
    }
}
