<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Volunteer;
use Illuminate\Support\Str;
use App\Models\Organization;
use App\Services\NotificationService;
use App\Models\Admin;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function showLoginForm()
    {
        return view('login_signin.login');
    }

    public function showRegisterForm()
    {
        return view('login_signin.register');
    }

    public function showRegisterFormOrganization()
    {
        return view('login_signin.registerOrganization');
    }

    public function login(Request $request)
    {
        $request->validate([
            'type' => 'required|in:volunteer,organization',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $type = $request->input('type');

        // Nếu là tổ chức thì kiểm tra thêm 'approved' = 'approved'
        if ($type === 'organization') {
            $credentials['approved'] = 'approved';
        }

        if (Auth::guard($type)->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard($type)->user();

            session([
                'user_id' => $user->volunteer_id ?? $user->organization_id,
                'avatar' => $user->avatar ?? null,
                'user_type' => $type
            ]);
            return redirect()->intended('/');
        }

        // Nếu là tổ chức và chưa được duyệt
        if ($type === 'organization') {
            $org = \App\Models\Organization::where('email', $request->email)->first();
            if ($org && $org->approved !== 'approved') {
                return back()->with('error', 'Tài khoản tổ chức của bạn chưa được duyệt.');
            }
        }
        return back()->with('error', 'sai thông tin đăng nhập');
    }




    public function register(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:volunteers,email',
                'password' => 'required|confirmed|min:6',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
            ]);

            $volunteer = new Volunteer();
            $volunteer->volunteer_id = (string) Str::uuid();
            $volunteer->username = $request->username;
            $volunteer->email = $request->email;
            $volunteer->password = Hash::make($request->password);
            $volunteer->phone = $request->phone;
            $volunteer->address = $request->address;
            $volunteer->avatar = 'default-avatar.png'; // Mặc định không có ảnh đại diện
            $volunteer->cover = 'default-avatar.png'; // Mặc định không có ảnh bìa
            $volunteer->role = 'volunteer';
            $volunteer->point = 0;
            $volunteer->save();

            $this->notificationService->sendWelcomeNotificationToVolunteer($volunteer->volunteer_id);

            return redirect()->route('login.form')->with('success', 'Đăng ký thành công, vui lòng đăng nhập để tiếp tục!');
        } catch (\Exception $e) {
            return redirect()->route('register.form')->with('error', 'Đăng ký không thành công! Vui lòng thử lại sau.');
        }
    }

    public function registerOrganization(Request $request)
    {
        try {

            $request->validate([
                'username' => 'required|string|max:255|unique:organizations,username',
                'email' => 'required|email|unique:organizations,email',
                'password' => 'required|confirmed|min:6',
                'representative' => 'required|string|max:255',
                'founded_at' => 'required|date|before_or_equal:today', // Kiểm tra nếu ngày thành lập không lớn hơn ngày hiện tại
                'website' => 'nullable|url|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'description' => 'nullable|string|max:500',
            ]);

            $organization = new Organization();
            $organization->organization_id = (string) Str::uuid();
            $organization->username = $request->username;
            $organization->email = $request->email;
            $organization->password = Hash::make($request->password);
            $organization->representative = $request->representative;
            $organization->address = $request->address;
            $organization->phone = $request->phone;
            $organization->founded_at = $request->founded_at;
            $organization->description = $request->description;
            $organization->website = $request->website;
            $organization->approved = 'pending'; // Mặc định là chưa được duyệt
            $organization->role = 'organization';

            // avatar sẽ được cập nhật sau, nên mặc định có thể để null hoặc ảnh mặc định
            $organization->avatar = 'default-avatar.png'; // Mặc định không có ảnh đại diện
            $organization->cover = 'default-avatar.png'; // Mặc định không có ảnh bìa
            $organization->save();

            return redirect()->route('login.form')->with('success', 'Đăng ký tổ chức thành công, vui lòng chờ duyệt!');
        } catch (\Exception $e) {
            return redirect()->route('register.organization.form')->with('error', 'Đăng ký không thành công! Vui lòng thử lại');
        }
    }



    public function logout(Request $request)
    {
        if (Auth::guard('volunteer')->check()) {
            Auth::guard('volunteer')->logout();
        } elseif (Auth::guard('organization')->check()) {
            Auth::guard('organization')->logout();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Hiển thị form đăng nhập admin
    public function showAdminLoginForm()
    {
        return view('admin.login.login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();
            return redirect()->route('admin.home');
        }
        return back()->with('error', 'sai thông tin đăng nhập');
    }
    // Đăng xuất admin
    public function adminlogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }


    // public function adminlogin(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $credentials = $request->only('username', 'password');


    //     if (Auth::guard(admin)->attempt($credentials)) {
    //         $request->session()->regenerate();

    //         $user = Auth::guard(admin)->user();
    //         return redirect()->intended('/admin');
    //     }
    // }
}
