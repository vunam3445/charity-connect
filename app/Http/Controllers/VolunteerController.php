<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VolunteerService;
use App\Models\Volunteer;
use Illuminate\Support\Facades\File;
use App\Models\Follow;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    protected $volunteerService;

    public function __construct(VolunteerService $volunteerService)
    {
        $this->volunteerService = $volunteerService;
    }

    public function profile($id)
    {
        $volunteer = $this->volunteerService->getProfileWithEvents($id);

        return view('volunteer.profile', compact('volunteer'));
    }

    public function getTopVolunteersLastMonth()
    {
        $volunteers = $this->volunteerService->getTopVolunteersLastMonth();

        return $volunteers;
    }

    public function uploadCover(Request $request, $id)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB
        ]);

        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return redirect()->back()->with('error', 'Không tìm thấy tình nguyện viên.');
        }

        // Xóa ảnh cũ nếu có
        if ($volunteer->cover && File::exists(public_path('images/' . $volunteer->cover))) {
            File::delete(public_path('images/' . $volunteer->cover));
        }

        // Lưu ảnh mới
        $file = $request->file('cover_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);

        $volunteer->cover = $filename;
        $volunteer->save();

        return redirect()->back()->with('success', 'Ảnh bìa đã được cập nhật!');
    }

    public function uploadAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return redirect()->back()->with('error', 'Không tìm thấy tình nguyện viên.');
        }

        // Xóa ảnh avatar cũ nếu có
        if ($volunteer->avatar && File::exists(public_path('images/' . $volunteer->avatar))) {
            File::delete(public_path('images/' . $volunteer->avatar));
        }

        // Lưu ảnh avatar mới
        $file = $request->file('avatar_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);

        $volunteer->avatar = $filename;
        $volunteer->save();

        return redirect()->back()->with('success', 'Ảnh đại diện đã được cập nhật!');
    }

    public function listFollowed($id)
    {
        $volunteer = Volunteer::find($id);

        if (!$volunteer) {
            return response()->json(['error' => 'Không tìm thấy tình nguyện viên'], 404);
        }

        // Lấy các organization_id mà volunteer đã follow
        $organizationIds = Follow::where('volunteer_id', $id)->pluck('organization_id');

        // Lấy dữ liệu chi tiết của các tổ chức dựa trên organization_id
        $followedOrganizations = Organization::whereIn('organization_id', $organizationIds)->get();
        return response()->json([
            'organizations' => $followedOrganizations
        ]);
    }
}
