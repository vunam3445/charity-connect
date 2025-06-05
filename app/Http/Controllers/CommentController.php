<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    public function storeAjax(Request $request, $result_id)
    {
        if (!auth('volunteer')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để bình luận.'
            ], 401);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $volunteer = auth('volunteer')->user();

        $comment = Comment::create([
            'result_id' => $result_id,
            'volunteer_id' => $volunteer->volunteer_id,
            'name' => $volunteer->username,
            'content' => $request->content,
        ]);

        $comment->load('volunteer');

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'name' => $comment->name,
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
                'volunteer_id' => $volunteer->volunteer_id,
                'avatar' => $volunteer->avatar ? asset('images/' . $volunteer->avatar) : '/api/placeholder/40/40?text='.urlencode($comment->name),
            ]
        ]);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (auth('volunteer')->id() == $comment->volunteer_id) {
            $comment->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Bạn không có quyền xóa bình luận này.'], 403);
    }
}
