<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Organization;


class Account extends Controller
{
    public function editvolunteerShow()
    {
        $volunteer = Auth::guard('volunteer')->user();

        if (!$volunteer) {
            return redirect()->route('login.form')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        return view('account.editvolunteer', compact('volunteer'));
    }

    public function editvolunteer(Request $request, $id)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $volunteer = Volunteer::findOrFail($id);

    // Cập nhật thông tin cơ bản
    $volunteer->username = $request->username;
    $volunteer->email = $request->email;
    $volunteer->phone = $request->phone;
    $volunteer->address = $request->address;

    // ✅ Nếu người dùng upload avatar mới
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        // Xóa avatar cũ nếu cần
        if ($volunteer->avatar && file_exists(public_path('images/' . $volunteer->avatar))) {
            unlink(public_path('images/' . $volunteer->avatar));
        }

        $volunteer->avatar = $filename;
    }

    // ✅ Nếu người dùng upload ảnh bìa mới
    if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        // Xóa ảnh bìa cũ nếu cần
        if ($volunteer->cover && file_exists(public_path('images/' . $volunteer->cover))) {
            unlink(public_path('images/' . $volunteer->cover));
        }

        $volunteer->cover = $filename;
    }

    // Lưu thông tin cập nhật vào database
    $volunteer->save();

    return redirect()->back()->with('success', 'Cập nhật thành công!');
}


    public function editorganizationShow()
    {
        $organization = Auth::guard('organization')->user();
        if (!$organization) {
            return redirect()->route('login.form')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        return view('account.editorganization', compact('organization'));
    }

public function editorganization(Request $request, $id)
{
    // Validate các trường dữ liệu
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email',
        'representative' => 'required|string|max:255', // Trường tên tổ chức
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'description' => 'nullable|string',
        'founded_at' => 'nullable|date|before_or_equal:' . now()->toDateString(), // Ngày thành lập không lớn hơn ngày hiện tại
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Trường ảnh đại diện
        'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Trường ảnh bìa
        'website' => 'nullable|url', // Trường website
    ]);

    // Tìm tổ chức theo ID
    $organization = Organization::findOrFail($id);

    // Cập nhật các trường thông tin
    $organization->username = $request->username;
    $organization->email = $request->email;
    $organization->representative = $request->representative; // Sửa tên tổ chức
    $organization->phone = $request->phone;
    $organization->address = $request->address;
    $organization->description = $request->description;
    $organization->founded_at = $request->founded_at; // Cập nhật ngày thành lập
    $organization->website = $request->website; // Cập nhật website

    // ✅ Xử lý ảnh đại diện nếu có upload mới
    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        // Xóa ảnh cũ nếu tồn tại
        if ($organization->avatar && file_exists(public_path('images/' . $organization->avatar))) {
            unlink(public_path('images/' . $organization->avatar));
        }

        $organization->avatar = $filename;
    }

    // ✅ Xử lý ảnh bìa nếu có upload mới
    if ($request->hasFile('cover')) {
        $file = $request->file('cover');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);

        // Xóa ảnh bìa cũ nếu tồn tại
        if ($organization->cover && file_exists(public_path('images/' . $organization->cover))) {
            unlink(public_path('images/' . $organization->cover));
        }

        $organization->cover = $filename;
    }

    // Lưu thông tin tổ chức đã cập nhật
    $organization->save();

    return redirect()->back()->with('success', 'Cập nhật thông tin tổ chức thành công!');
}

}

