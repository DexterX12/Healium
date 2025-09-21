<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommentController extends Controller
{

    public function save(Request $request): RedirectResponse
    {
        $data = $request->only(['description', 'drug_id']);
        $data['user_id'] = auth()->id();
        $commentDataValidated = Comment::validate($data);
        Comment::create($commentDataValidated);

        return back()
            ->with('success', 'Comment created successfully');
    }

    public function delete(int $id): RedirectResponse
    {
        $comment = Comment::findOrFail($id);
        if ($comment->getUserId() !== auth()->id()) {
            return back()->with('error', 'You are not allowed to delete this comment');
        }
        $comment->delete();

        

        return back()
            ->with('success', 'Comment deleted successfully');
    }
}
